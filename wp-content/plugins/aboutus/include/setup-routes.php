<?php
namespace TheFold\AboutUs;
use TheFold\WordPress as WordPress;
use TheFold\Cache as Cache;

//URL Access
WordPress::init_url_access(array(

    'dash(/[0-9]+)?' => function($request) {

        if( ! is_user_logged_in() ) {
            redirect('/');
        }

        if (current_user_can( 'manage_options' )) {
            WordPress::render_view('oops-admin.php', array());
            die();
        }

        //load biz & check auth
        global $post, $wp_query;

        if(preg_match('#([0-9]+)/?$#',$request,$m)){

            $post_id = $m[1];
            $post = \get_post($post_id);
			
            if(!check_auth($post)){

                return redirect();
            }
        } else {
        	$post = get_biz_from_user(); // pull from current user
        }

        if(!$post){

            redirect('signup');
        }

        $completion = get_completion_percent();

        \setup_postdata($post);

        Wordpress::render_view('dash.php',array(
            'biz' => $post,
            'user' => wp_get_current_user(),
            'sms'  => get_all_sms(),
            'active' => get_active_sms_conections(),
            'percent_complete' => $completion['percent'],
            'completion' => $completion,
            'offers' => get_offers(),
            'news_feed' => get_news_feed(),
            'is_dashboard' => true
        ));
    },

    'login' => function() {

        if( \is_user_logged_in() ){
            redirect('dash/'.$biz->ID);
        }

        Wordpress::render_view('login.php', array(
            'form' => wp_login_form(array(
                'echo'=>false,
		        'label_username' => __( 'Email' ),
	            'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . '/dash',
            ))
        ));
    },

    'hybridauth' => function() {
    	
        try {
        	\Hybrid_Endpoint::process();
        }
        catch(Exception $e){
            Wordpress::log($e->getMessage());
        }
    },

    'auth' => function() {
		
        $user = \wp_get_current_user();

        if ( ! $user->exists() ) {
            redirect('login');
        }

        $hauth = get_hauth();

        $serviceName = $_GET['s'];

        //issue for linkedIn
        $service = $hauth->authenticate( $serviceName );
        //issue

        $profile = $service->getUserProfile();
        $biz = get_biz_from_user();

        $all_sms = get_sms_by_provider_id($serviceName);

        foreach($all_sms as $sms){

            WordPress::log('connecting biz '.$biz->ID.' with sms '. $sms->ID );

            // Ok here I need to associate with a user as well
            \p2p_type( 'sms_to_biz' )->connect( $sms->ID, $biz->ID , array(
                'date' => current_time('mysql'),
                'identifier' => $profile->identifier,
                'profileURL' => $profile->profileURL,
                'token' => $service->adapter->token( "access_token" )
            ));

            \update_user_meta($user->ID, $serviceName, $profile->identifier);

            \update_post_meta($post_id, COMPLETE_STEP_SMS, 1);
        }

        save_hauth($user->ID, $hauth->getSessionData());

        redirect('dash/'. $biz->ID . '?connected=' . $serviceName);
    },

    'login-hauth' => function() {

        $hauth = get_hauth();

        $_SESSION['hauth_service'] = $_GET['s'];

        $res = \wp_signon(array('remember' => true));

        if( is_a($res, 'WP_User' )) {

            redirect('dash');
        }

        redirect('signup');

    },

    'provider-stats' => function() { //todo cache the shit out of

        try {

            $hauth = get_hauth();

            //throw new \Exception('forget');
            $sms = get_sms_by_name($_GET['provider']);

            $provider = get_provider_object(
                $sms->post_title,
                $hauth->authenticate( get_provider_id($sms) ));

            $stats = $provider->get_stats();


        } catch(\Exception $e) {
            $hauth->logoutAllProviders();
            forget_hauth();
            $stats = array();
        }

        WordPress::render_view('provider-stats.php',array(
            'stats' => $stats,
            'name' => $provider->provider_name()
        ));
    },

    'logout-hauth' => function() {

        $hauth = get_hauth();
        $hauth->logoutAllProviders();
        forget_hauth();

    },
//todo cache the shit out of
    'overview-stats' => function() 
    {
        WordPress::render_view('overview-stats.php',array(
            'stats' => get_over_stats(),
            'connect' => get_pending_social_connections()
        ));
    },

    'analytics' => function() 
    {
        WordPress::render_view('metrics.php',array(
            'nothing' => 'empty',
        ));
    },


    'transport-result' => function() 
    {
        WordPress::render_view('result.php',array(
            'nothing' => 'empty',
        ));
    },


    'profile-stats' => function()
    {
        WordPress::render_view('profile-stats.php',array(
            'stats' => get_over_stats()
        ));
    },

    'upload-image' => function() {

        $biz =  get_biz_from_user();

        if($_SERVER['REQUEST_METHOD'] !== 'POST') {

            if(isset($_GET['delete'])) {

                $response = array(
                    'status' => 'error',
                    'message' => 'An error occurred, your logo was not uploaded.'
                );



                if($_GET['delete'] === 'logo') {
                    delete_post_thumbnail($biz);
                    $response['status']  = 'success';
                } elseif($_GET['delete'] === 'background') {
                    $attach_id = get_post_meta( $biz->ID, 'background_image_id', true);
                    wp_delete_attachment($attach_id);
                    delete_post_meta ( $biz->ID, 'background_image_id');
                    $response['status']  = 'success';
                }

          if(preg_match('/(?i)msie [2-9]/',$_SERVER['HTTP_USER_AGENT'])){
         //   header('Content-type: text/plain');
          } else { 
            header('Content-type: application/json');
          }
                echo json_encode($response);
                exit;
            }

            WordPress::render_view('upload-image.php',array(
                'background' => get_biz_background_src($biz->ID),
                'logo' => get_biz_logo_src($biz->ID)
            ));

        } else  {

            require_once( \ABSPATH . 'wp-admin/includes/file.php' );
            require_once( \ABSPATH . 'wp-admin/includes/image.php');

            $response = array(
                'status' => 'error',
                'message' => 'An error occurred, your logo was not uploaded.'
            );

            $movefile = wp_handle_upload($_FILES['image'],array('test_form'=>false));

            if($movefile && empty($movefile['error'])){

                $biz_id = $biz->ID;

                $file = $movefile['file'];
                $filename = basename($file);

                $wp_filetype = wp_check_filetype($filename, null );

                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => $biz->post_title,
                    'post_content' => '',
                    'post_status' => 'inherit'
                );

                $attach_id = wp_insert_attachment( $attachment, $file, $biz_id);

                $attach_data = wp_generate_attachment_metadata( $attach_id, $file);
                wp_update_attachment_metadata( $attach_id, $attach_data );

                if(isset($_GET['bg'])) {
                    update_post_meta ( $biz_id, 'background_image_id', $attach_id );
                } else {
                    set_post_thumbnail( $biz_id, $attach_id );
                }

                $response['status']  = 'success';
                $response['image']   = wp_get_attachment_image_src( $attach_id, array(222, 222));
                $response['message'] = 'Upload successful.';

                update_post_meta( $biz_id, COMPLETE_LOGO_UPDATE, 1);

            } else {
                Wordpress::log($movefile['error']);
            }
          if(preg_match('/(?i)msie [2-9]/',$_SERVER['HTTP_USER_AGENT'])){

           // header('Content-type: text/plain');
          } else { 

            header('Content-type: application/json');
          }
            echo json_encode($response);
        }

        /*$movefile = wp_handle_upload($_FILES['image'],array('test_form'=>false));

        if($movefile && empty($movefile['error'])){

            $biz = get_biz_from_user();
            $biz_id = $biz->ID;

            $file = $movefile['file'];
            $filename = basename($file);

            $wp_filetype = wp_check_filetype($filename, null );

            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => $biz->post_title,
                'post_content' => '',
                'post_status' => 'inherit',
            );

            $attach_id = wp_insert_attachment( $attachment, $file, $biz_id);

            $attach_data = wp_generate_attachment_metadata( $attach_id, $file);
            wp_update_attachment_metadata( $attach_id, $attach_data );

            if(isset($_GET['bg'])){
                update_post_meta ( $biz_id, 'background_image_id', $attach_id );
            }else{
                set_post_thumbnail( $biz_id, $attach_id );
            }

            echo json_encode(wp_get_attachment_image_src( $attach_id, isset($_GET['size'])?$_GET['size']:'thumbnail'));

            update_post_meta( $biz_id, COMPLETE_LOGO_UPDATE, 1);

        }else{
            Wordpress::log($movefile['error']);
            echo  false;
        }*/
    },

    'completion-stats' => function()
    {
        echo json_encode(get_completion_percent());
    },

    'latest-activity' => function()
    {
        WordPress::render_view('activity_feed.php',array(
            'activity' => get_latest_activity(10)
        ));
    },

    'activity(/[0-9]+)?(/[0-9]+)?' => function()
    {
    	
        if(!$biz = \get_post($_GET['bizid'])) {

            echo 'invalid bizid';exit();
            throw new \Exception('invalid bizid');
        }

        if(!$sms = \get_post($_GET['provider'])) {

            echo 'invalid provider';exit();
            throw new \Exception('invalid provider');
        }

        @$feedOnly = $_GET['feedonly'];
		
        try {
       
            $user_id = $biz->post_author;
            $curr_user_id = get_current_user_id(); 
            
            //check if this user is logged in and owner of the page accessing
            //issue is here, when logged in it works fine, when not it doesn't
            $provider = get_sms_connection($sms, $biz); //MM
			///
			///
						 
            if(!$provider) {
                throw new \Exception('Error loading provider');
            }

            if($sms->post_name === 'facebook') {
            	
            	if($provider->hasConnectedPage()) {					
                    $profileUrl = 'http://facebook.com/' . get_post_meta( $biz->ID, 'facebook_page_id', true );    
                    //FOR THE LOGGED IN USER
                    if ( intval($user_id) == $curr_user_id) {
	                    $activity = $provider->getActivityFeed('me');                    
                    } else {
	                    //NOT FOR�THE LOGGED IN USER
	                    $p2p_id = \p2p_type( 'sms_to_biz' )->get_p2p_id( $sms, $biz );
						$identifier = \p2p_get_meta( $p2p_id, 'identifier', true );
						//$profileUrl = \p2p_get_meta($p2p_id, 'profileURL', true);
						$token = \p2p_get_meta($p2p_id, 'token', true);
						$activity = \TheFold\AboutUs\Providers\Facebook::get_public_activity_user($sms_id, $token, $user_id, $biz);
					}
					
                } else {
                    $activity = array();
                    $profileUrl = \p2p_get_meta($p2p_id, 'profileURL', true);
                }
                
                $p2p_id = \p2p_type( 'sms_to_biz' )->get_p2p_id( $sms, $biz );
                
            } elseif($sms->post_name === 'linkedin') {
            	$curr_user_id = get_current_user_id();     
	            $p2p_id = \p2p_type( 'sms_to_biz' )->get_p2p_id( $sms, $biz );
                $profileUrl = \p2p_get_meta($p2p_id, 'profileURL', true);

                //FOR THE LOGGED IN USER
                if ( intval($user_id) == $curr_user_id) {
                	$activity = $provider->getActivityFeed("me");
                } else {
	                //$token = \p2p_get_meta($p2p_id, 'token', true);                
	                $activity = NULL; //\TheFold\AboutUs\Providers\LinkedIn::get_public_activity($sms_id, $token, $user_id, $biz);
                }
            
            } elseif($sms->post_name === 'twitter') {
                //$twitter_id =
                $p2p_id = \p2p_type( 'sms_to_biz' )->get_p2p_id( $sms, $biz );
                $identifier = \p2p_get_meta( $p2p_id, 'identifier', true );
                $profileUrl = \p2p_get_meta($p2p_id, 'profileURL', true);
                $activity = \TheFold\AboutUs\Providers\Twitter::get_public_activity($identifier, false, false, false);
            }

            //$activity = $provider->getActivityFeed('timeline');
            //$p2p_id = \p2p_type( 'sms_to_biz' )->get_p2p_id( $sms, $biz );
            //$sms_id = \p2p_get_meta($p2p_id,'identifier',true);
            //$token = \p2p_get_meta($p2p_id,'token',true);
            //$Provider = get_provider_class($sms->post_title);
            //$activity = $Provider::get_public_activity($sms_id, $token, $biz->post_author, $biz);

        } catch(\Exception $e) {

            WordPress::log('Can\'t public timeline for ' . $_GET['provider']);
            exit();
        }
		
		//die (var_dump($activity));
		
        //check for a template based on the sms slug
        Wordpress::render_template('activity', $sms->post_name, array(
            'activity'=> $activity,
            'sms' => $sms,
            'biz' => $biz,
            'sms_id' => isset($sms_id),
            'feedOnly' => $feedOnly,
            'profileUrl' => $profileUrl
        ));
    },

    'signup' => function()
    {
        // Check if the user is logged in - if the have completed signup,
        // redirect to the dashboard. Otherwise, populate any possible fields.
        /*if( is_user_logged_in() ) {
            redirect('dash');
        }*/

        /*if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(is_user_logged_in()) {
                // Update user meta fields
                $current_user = wp_get_current_user();
                $user_id = $current_user->ID;
                update_user_meta( $user_id, 'first_name', $_POST['firstname']);
                update_user_meta( $user_id, 'last_name', $_POST['lastname']);

                //$biz = get_biz_from_user();
                //$biz_id = $biz->ID;

            }

            redirect('dash');
        }*/



        if (current_user_can( 'manage_options' )) {
            WordPress::render_view('oops-admin.php', array());
            die();
        }

        // Hack - stdClass doesn't work with loader.
        $profile = (object) array();

        if(isset($_SESSION['hauth_user_profile'])) {
            $profile = $_SESSION['hauth_user_profile'];
        }

        WordPress::render_view('custom-signup.php', array(
            'profile' => $profile
        ));

    },

    'account-details' => function()
    {
        if( ! is_user_logged_in() ) {
            redirect('signup');
        }

        WordPress::render_view('account-details.php', array(

        ));
    },

    'check-recaptcha' => function()
    {
        header('Content-type: application/json');
        require_once(get_template_directory() . '/recaptchalib.php');
        $private_key = get_option("rg_gforms_captcha_private_key");
        $response = recaptcha_check_answer (
            $private_key,
            $_SERVER["REMOTE_ADDR"],
            $_POST["recaptcha_challenge_field"],
            $_POST["recaptcha_response_field"]
        );
        echo json_encode($response->is_valid);
        exit;
    },

    'check-email' => function()
    {
        header('Content-type: application/json');
        $response = '';
        if(isset($_GET['email'])) {
            $email = $_GET['email'];
            if( email_exists( $email ) ) {
                $response = false; // 'An account already exists with that email address. Please log in instead.';
            } else {
                $response = true;
            }
        }
        echo json_encode($response);
        exit;
    },

    'social-post(/[0-9]+)?(/[0-9]+)?' => function()
    {
        if(!$biz = \get_post($_GET['bizid'])) {

            echo 'invalid bizid';exit();
            throw new \Exception('invalid bizid');
        }

        if(!$sms = get_post($_GET['provider'])) {

            echo 'invalid provider';exit();
            throw new \Exception('invalid provider');
        }

        try{

            $p2p_id = \p2p_type( 'sms_to_biz' )->get_p2p_id( $sms, $biz );
            $sms_id = \p2p_get_meta($p2p_id,'identifier',true);
            $token = \p2p_get_meta($p2p_id,'token',true);

            $Provider = get_provider_class($sms->post_title);

            $activity = $Provider::get_public_activity($sms_id, $token, $biz->post_author);

        }catch(\Exception $e){

            WordPress::log('Can\'t public timeline for '.$_GET['provider']);
        }

        //check for a template based on the sms slug

        Wordpress::render_template('activity',$sms->post_name,array(
            'activity'=>$activity,
            'sms' => $sms,
            'biz' => $biz,
            'sms_id' => $sms_id
        ));
    },

    'email-business' => function() {
        $response = array(
            'status' => 'error',
            'message' => 'An error occurred, your message was not sent'
        );

        try {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $business = $_POST['business'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $message = $_POST['message'];

                if(!$biz = \get_post($business)) {
                    throw new Exception('Could not load business, please try again.');
                }

                $users = get_users( array(
                  'connected_type' => 'biz_to_user',
                  'connected_items' => $business,
                  'nopaging' => true
                ) );

                $to = $users['0']->data->user_email;
                $subject = 'About Us - Contact Form Enquiry';
                $content =
                    "Name:\r\n" .
                    $name . "\r\n\r\n" .
                    "Email:\r\n" .
                    $email . "\r\n\r\n" .
                    "Message:\r\n" .
                    $message;

                $headers = array(
                    'From: "About Us" <noreply@aboutus.co.nz>'
                );

                wp_mail(
                    $to,
                    $subject,
                    $content,
                    $headers,
                    $attachments = false
                );

                // Increment statistics
                $count = (int) get_post_meta($biz->ID, 'email_count', true);
                $count++;
                update_post_meta($biz->ID, 'email_count', $count);

                $response['status'] = 'success';
                $response['message'] = 'Thanks for contacting us!';



            }
        } catch(Exception $e) {
            $response['message'] = $e->getMessage();
        }

        header('Content-type: application/json');
        header("HTTP/1.0 200 OK");
        echo json_encode($response);
        exit;
    },

    'connect-facebook-page' => function() {

        if( ! is_user_logged_in() ) {
            redirect('signup');
        }

        $biz = get_biz_from_user();

        if(!isset($_REQUEST['page_id'])) {

            WordPress::render_view('connect-facebook-page.php',array(
                'fb' => get_sms_connection( get_sms_by_name('facebook') )
            ));

        } else  {

            $response = array(
                'status' => 'error',
                'message' => 'An error occurred, your page was not connected'
            );

            $biz_id = $biz->ID;

            $response['status']  = 'success';
            $response['message'] = 'Facebook Business page connected.';

            update_post_meta( $biz_id, 'facebook_page_id' , $_REQUEST['page_id']);

            header("HTTP/1.1 200 OK");
            echo json_encode($response);
            exit;
        }
    },

    'create-social-post' => function() {
        if( ! is_user_logged_in() ) {
            redirect('signup');
        }

        $response = array(
            'status' => 'error',
            'message' => 'An error occurred, unable to post'
        );

        // Right now, just post to Facebook.
        // @todo: enable passing social platform

        try {

            $providerName = $_REQUEST['social_post_provider'];
            $biz = get_biz_from_user();
            $sms = get_sms_by_name($providerName);
            $provider = get_sms_connection($sms,$biz);

            $result = $provider->setUserStatus(
                array(
                  "message" => $_REQUEST['post-content'], // status or message content
                   //"link"    => "", // webpage link
                   //"picture" => "", // a picture link
                )
               

            );

            if($result) {
                $response['status'] = 'success';
                $response['message'] = 'Update posted.';
            }

        } catch (\Exception $e) {
            // @todo, log?
            $response['code'] = $e->getCode();
            $response['debug_message'] = $e->getMessage();
        }

        header('Content-type: application/json');
        header("HTTP/1.1 200 OK");
        echo json_encode($response);
        exit;
    },

    'dashboard-feed' => function() {
        if( ! is_user_logged_in() ) {
            redirect('signup');
        }

        $category = $_REQUEST['category'];
        $page     = $_REQUEST['page'];
        $limit    = $_REQUEST['limit'];

        if(!$category) {
            die('No category provided');
        }

        if($category === 'all') {
            $category = false;
            $limit = 20;
        }

        if(!$limit) {
            $limit = 10;
        }

        if($category === 'latest') {
            $limit = 5;
            $category = false;
        }

        if(!$page) {
            $page = 1;
        }
        Wordpress::render_view('dashboard-feed.php',array(
            'news_feed' => get_news_feed(10, $page, $category)
        ));
    },

    'social-settings' => function() {
        if( ! is_user_logged_in() ) {
            redirect('signup');
        }

        $biz = get_biz_from_user();


        if(isset($_GET['disconnect']) && $_GET['disconnect'] !== '') {
            $response = array(
                'status' => 'error',
                'message' => 'An error occurred, your settings have not been updated'
            );

            try {

                $smsName = $_GET['disconnect'];

                if(!$sms = get_sms_by_name(strtolower($smsName))) {
                    throw new \Exception('Invalid social media service');
                }

                $hauth = get_hauth();

                $provider = get_sms_connection($sms, $biz);
                $provider->logout();

                save_hauth($user->ID, $hauth->getSessionData());

                if(strtolower($smsName) === 'facebook') {
                    delete_post_meta($biz->ID, 'facebook_page_id');
                }

                // Remove posts2posts link
                p2p_type( 'sms_to_biz' )->disconnect( $sms->ID, $biz->ID );

                $response['service'] = $smsName;
                $response['status'] = 'success';
                $response['message'] = $smsName . ' disconnected successfully.';

            } catch(\Exception $e) {
                $response['message'] = $e->getMessage();
            }

            header('Content-type: application/json');
            header("HTTP/1.0 200 OK");
            echo json_encode($response);
            exit;
        }

//print all, it returns a funy url in the guid row
        $all = get_all_sms();
        $biz = get_biz_from_user();

        $activeSMSConnections = array();

        foreach ($all as $sms) {

            if($provider = get_sms_connection($sms,$biz)) {

                $activeSMSConnections[] = $provider;
            }
        }

        Wordpress::render_view('privacy-settings.php',array(
            'providers' => $activeSMSConnections
        ));
    },








    'newsroom(/[a-z0-9\-]+)?(/[a-z0-9\-]+)?' => function($request) {

        //load biz & check auth
        global $post, $wp_query;

        /*$page = (int) $_GET['page'];
        if(!$page) {
            $page = 1;
        }*/

        preg_match('#newsroom/page/([a-z0-9\-]+)?/{0,1}$#', $request, $matches);

        $page = 1;

        if(isset($matches['1'])) {
            $page = $matches['1'];
        }

        // Three cases:
        // 1. Newsroom article: /newsroom/my-category/my-article
        // 2. Newsroom category: /newsroom/my-category
        // 3. Newsroom landing page: /newsroom


        /*if(isset($matches['2'])) {
            Wordpress::render_view('newsroom-article.php',array(
                'providers' => get_active_sms_conections()
            ));
        } elseif(isset($matches['1'])) {
            Wordpress::render_view('newsroom.php',array(
                'providers' => get_active_sms_conections()
            ));
        } else {*/

        $args =  array(
            'posts_per_page'=> 2,
            'paged'=> $page
        );

        /*if($category) {
            $args['category'] = $category;
        }*/


        $news_feed = query_posts($args);

        // Display 404 if we have no posts.
        if(!have_posts()) {
            status_header(404);
            nocache_headers();
            include( get_404_template() );
            exit;
        }

        Wordpress::render_view('newsroom.php',array(
            'news_feed' => $news_feed,
            'archive_feed' => get_news_feed(15)
        ));

    }

)); ?>