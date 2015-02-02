<?php
namespace TheFold\AboutUs;
use TheFold\WordPress as WordPress;
use TheFold\Cache as Cache;

set_include_path(
    implode(PATH_SEPARATOR, array(
        get_include_path(),
        realpath(__DIR__.'/lib')
)));

require 'lib/Hybrid/Auth.php';
require 'lib/Hybrid/Endpoint.php';

require 'lib/TheFold/SplClassLoader.php';
$loader = new \SplClassLoader('TheFold', __DIR__.'/lib');
$loader->register();

$hauth = get_hauth();
/*
Plugin Name: AboutUs
Plugin URI: http://www.thefold.co.nz/
Description: Core About Us functionality
Version: 0.0.1
Author: The Fold
Author URI: http://www.thefold.co.nz
*/

include 'include/setup-posts.php';
include 'include/setup-scripts.php';
include 'include/setup-common-variables.php';

add_action('gform_user_registered',function($user_id, $user_config, $entry, $user_pass){

    // If the registration has been completed with a profile set in the session,
    // make sure it has been linked to the user.
    if(isset($_SESSION['hauth_user_profile'])) {
        $profile = $_SESSION['hauth_user_profile'];
        $service = $_SESSION['hauth_profile_service'];
        \update_user_meta($user_id, $service, $profile->identifier);
        \p2p_type( 'sms_to_biz' )->connect( $entry['post_id'], $user_id, array(
            'date' => \current_time('mysql')
        ));

        $sms = get_sms_by_name($service);
        $hauth = get_hauth();
        $adapter = $hauth->getAdapter($service);

        \p2p_type( 'sms_to_biz' )->connect( $sms->ID, $entry['post_id'], array(
            'date' => current_time('mysql'),
            'identifier' => $profile->identifier,
            'profileURL' => $profile->profileURL,
            'token' => $adapter->token( "access_token" )
        ));


    }

    Wordpress::log(func_get_args());

    \update_user_meta( $user_id, 'show_admin_bar_front', 'false' );

    \update_post_meta($entry['post_id'], COMPLETE_STEP_ADDRESS, 1);

    // Add additional registration fields
    if(isset($_POST['background'])) {
        \update_post_meta($entry['post_id'], 'profile_background', $_POST['background']);
    }

    \wp_update_post( array(
        'ID' => $entry['post_id'],
        'post_author' => $user_id,
        'post_status'=>'publish'
    ));

    //associate with biz now.
    \p2p_type( 'biz_to_user' )->connect( $entry['post_id'], $user_id, array(
        'date' => \current_time('mysql')
    ));

    \wp_set_auth_cookie( $user_id, false, \is_ssl() );

    $ismobile = check_user_agent('mobile');
if(!$ismobile) {

    \wp_redirect( \site_url( 'upload-image' ) );
} else{

     \wp_redirect( \site_url() );
}

},10,4);

add_filter('gform_validation_4', function($validation_result){
    if($_POST['input_27'] != '') {
        $validation_result['is_valid'] = false;
    }
    return $validation_result;
});


add_filter('gform_update_post_options',function($options){

 if(isset(get_biz_from_user()->ID)){
    $_REQUEST['biz_id'] = get_biz_from_user()->ID;
}
    

    $options['request_id'] = 'biz_id'; // pass a ?b=12 in the url
    $options['capabilities']['update'] = 'author'; // must be author of the post to update

    return $options;
});

add_action('wp_login', function($user_login,$user){
    restore_hauth($user->ID);
},10,2);


add_filter( 'get_avatar', function($avatar, $user_id, $size, $default, $alt){

    if(is_numeric($user_id)) {
        $single = True;
        $custom_avatar = get_user_meta($user_id, 'avatar',$single);

        if ($custom_avatar)
            $return = '<img src="'.$custom_avatar.'" width="'.$size.'" height="'.$size.'" alt="'.$alt.'" />';

        elseif($biz = get_biz_from_user())
            $return = get_the_post_thumbnail($biz->ID,'biz_avatar',array('width'=>$size,'height'=>$size));
        elseif ($avatar)
            $return = $avatar;
        else
            $return = '<img src="'.$default.'" width="'.$size.'" height="'.$size.'" alt="'.$alt.'" />';

        return $return;
    }

    return $avatar;

},10,5);

add_filter('gform_field_content',function($content,$field,$value,$lead_id,$form_id){

   if(isset($field['cssClass'])){
    if($field['cssClass'] == 'avatar'){

        return '<div>'.get_avatar(wp_get_current_user()->ID).'</div>'. $content;
    }
}

    return $content;

},10,5);

include 'include/setup-routes.php';

add_filter('login_redirect',function($redirect_to,$request,$user){

    if( empty($user->ID) || in_array("administrator",$user->roles) ){
        return $redirect_to; //maybe this should go to /login ?
    }else{
        update_user_meta( $user->ID, 'show_admin_bar_front', 'false' );
    }

    $biz = get_biz_from_user($user);

    redirect('dash/'.$biz->ID);

},10,3);

add_filter('authenticate',function($user, $username, $password) {

    if ( is_a($user, 'WP_User')) {

        return $user;
    }

    if( isset($_SESSION['hauth_service']) ) { //serviceName set login-hauth url method

        $service_name = $_SESSION['hauth_service']; //actually probably shouldn't be a sessions, but a global var

        unset($_SESSION['hauth_service']);

        if ( $username || $password ) {
            return new \WP_Error('invalid','Not using hauth as username and password provided');
        }

        $wp_user = hauth_authenticate($service_name);

        if( is_a($wp_user, 'WP_User' )) {

            return $wp_user;
        }
    }

    return $user;

},999,3);

function get_signup_form()
{
    $form = get_user_form();
    $form->setAction('signup');
    return $form;
}




function check_auth($post, $user = null) {

    if(!$user)
        $user = \wp_get_current_user();

    WordPress::log('checking auth, user level :'.$user->user_level.' >=8 && post_author:'.$post->post_author.' ==  user_id:'.$user->ID );

    return $user->user_level >= 8 || ($post->post_author == $user->ID);

}

function get_tutorial($sms_post,$type=null) {

    $params = array(
        'suppress_filters' => false,
        'connected_type' => 'sms_to_tutorial',
        'connected_items' => $sms_post,
    );

    if($type)
        $params['connected_meta'] = array( 'type' => $type );

    return current(\get_posts($params));
}

function get_profile_url($sms, $biz)
{
    $params = array(
        'suppress_filters' => false,
        'connected_type' => 'sms_to_tutorial',
        'connected_items' => $sms_post,
    );

    if($type)
        $params['connected_meta'] = array( 'type' => $type );
}

function get_all_sms() {

    static $posts;

    if(!$posts){

        $hauth_config = get_hauth_config();

        $posts = array_filter(

            \get_posts( array(
                'post_type' => TYPE_SMS,
                'nopaging' => true,
                'suppress_filters' => false,
            )),

            function($post) use ($hauth_config) {

                return isset( $hauth_config['providers'][ get_provider_id( $post ) ] );
            }
        );
    }

    return $posts;
}

/**
 * Get SMS connections for the specified business
 */
function get_biz_sms($biz){
	//die (var_dump($biz));
    $active = array();
    $allSms = get_posts( array(
        'connected_type' => 'sms_to_biz',
        'connected_items' => $biz,
        'nopaging' => true,
    ));
    
    foreach($allSms as $sms) {
    
        if($sms->post_name === 'facebook') {
			
			
			//MMMMMM
            $provider = get_sms_connection($sms,$biz);
            
            if($provider && $provider->hasConnectedPage()) {
                //$active[] = $provider;
                $active[] = $sms;
            }
            
        } else {
            $active[] = $sms;
        }
    }
    
    return $active;
}

function get_active_sms_conections()
{
    $all = get_all_sms();
    $biz = get_biz_from_user();
    $active = array();

    foreach ($all as $sms) {

        if($provider = get_sms_connection($sms,$biz)) {
            if($sms->post_name === 'facebook') {
                if($provider->hasConnectedPage()) {
                    $active[] = $provider;
                }
            } else {
                $active[] = $provider;
            }
        }
    }

    return $active;
}

function get_sms_connection(\WP_Post $sms, \WP_Post $biz = null)
{

    //if($cache = Cache::s()) return $cache;
    if(!$biz) $biz = get_biz_from_user();
	
    if( $p2p_id = \p2p_type( 'sms_to_biz' )->get_p2p_id( $sms, $biz ))
    {
    	
        $hauth = get_hauth();
		
		//check if the session has been created (if not and user is connected, create )
		/*if( !$hauth->isConnectedWith( get_provider_id($sms) ) )
	    {
	    	//check if they have connected page
	    	//die (var_dump($biz->post_author));
	    	//$usrid = '';
	    	$bizx = get_biz_from_user( get_userdata( $biz->post_author ) );
	    	$connected_page = get_post_meta( $biz->ID, 'facebook_page_id', true );
	    	
	    	if ( $connected_page ) {
	    		$fb = new Providers\Facebook;
	   			die (get_provider_id($sms));
	   		}
	   		//do something to fix the issue 
	   			
		}*/
		
		
			return get_provider_object(
            	$sms->post_title,
				$hauth->authenticate( get_provider_id($sms) )
			);
			
		/*if ($sms->post_title === "Facebook") {
		
			if( $hauth->isConnectedWith( get_provider_id($sms) ) )
	        {
	            /*return Cache::s( get_provider_object(
	                $sms->post_name,
	            $hauth->authenticate( $sms->post_name )) );*/
	           /* return get_provider_object(
	                $sms->post_title,
	                $hauth->authenticate( get_provider_id($sms) )
	            );    
			}
			
		
        	return \p2p_get_meta( $p2p_id, 'endpoint', true );
        
		} else {*/

		//}
		
        /*return get_provider_object(
            $sms->post_title,
            $hauth->authenticate( get_provider_id($sms) )
        );*/
		
    }
	
    return null;
}

function handle_wp_error($obj)
{
    if(\is_wp_error($obj)){
        throw new \Exception($post_id->get_error_message());
    }
}

function get_biz_from_user($user=null)
{
    if(!$user) {
        $user = \wp_get_current_user();

	}
   

    return current(\get_posts( array(
        'post_type' => TYPE_BUSINESS,
        'author' => $user->ID,
        'numberposts' => 1,
        'suppress_filters' => false,
    )));

}

function get_sms_by_name($post_name)
{
    //if($cache = Cache::s()) return $cache;

    $post =  current(\get_posts( array(
        'post_type' => TYPE_SMS,
        'name' => $post_name,
        'numberposts' => 1,
        'suppress_filters' => false,
    )));

    if(!$post){
        throw new \Exception('SMS '.$post_name.' not found. Make sure you\'ve got these setup in the admin');
    }

    return $post;
}

function get_sms_by_provider_id($provider_id, $name_fallback = true)
{
     $posts = \get_posts( array(
        'post_type' => TYPE_SMS,
        'meta_key' => 'hauth_provider_id',
        'meta_value' => $provider_id,
        'nopaging' => true,
        'suppress_filters' => false,
    ));

     if(!$posts){

         if($name_fallback)
             return array(get_sms_by_name($provider_id));
         else
             throw new \Exception('SMS not found. Make sure you\'ve got these setup in the admin');
    }

     return $posts;
}


function get_hauth()
{
    static $hauth;

    if(!$hauth)
        $hauth = new \Hybrid_Auth(get_hauth_config());

    return $hauth;
}

function get_hauth_config()
{
    static $config;

    if( ! is_array( $config ) ){
        $config = include __DIR__.'/hauth_config.php';
    }

    return $config;
}

function restore_hauth($user_id=null)
{
    if(!$user_id)
        $user_id = \get_current_user_id();

    if( $session_data = \get_user_meta($user_id, 'hauth_session_data', true) )
    {
        WordPress::log('got some session_data '.$session_data);

        $hauth = get_hauth();
        $hauth->restoreSessionData($session_data);
    }
}

function save_hauth($user_id=null, $session_data=null)
{
    if(!$user_id)
        $user_id = \get_current_user_id();

    if(!$session_data) {
        $hauth = get_hauth();
        $session_data = $hauth->getSessionData();
    }

    WordPress::log('saving some some session_data '.$session_data);
    \update_user_meta( $user_id, 'hauth_session_data', $session_data );
}

function forget_hauth($user_id=null)
{
    if(!$user_id)
        $user_id = \get_current_user_id();

    \update_user_meta( $user_id, 'hauth_session_data', '');
}

function sms_to_hauth_id($public_name)
{
    return ucfirst($public_name);
}

function redirect($path=null)
{
    Wordpress::log( \site_url($path) );
    \wp_redirect( \site_url($path) );
    exit();
}

function get_provider_object($name, \Hybrid_Provider_Adapter $adapter)
{
    $class_name = get_provider_class($name);
	return new $class_name($adapter,$name);
}

function get_provider_class($name)
{
    $class_name = "TheFold\AboutUs\Providers\\".ucfirst($name);

    if(! class_exists($class_name) )
        throw new \Exception('Can\'t find a provider class for '.$name);

    return $class_name;
}

/**
 * Load statistics for /overview-stats
 * Retrieves info for the logged in user
 */
function get_over_stats()
{
    $stats = array();

    $post = get_biz_from_user();

    if(class_exists('\GADWidgetData')){
        $data = new \GADWidgetData();        
        $link_uri = '/about/' . $post->post_name;
        $stats[] = array(
            'key'   => 'user',
            'title' => 'Page Views',
            'value' => $data->gad_pageviews_text($link_uri)
        );
    }

 

    // $stats[] = array(
    //     'key'   => 'emails',
    //     'title' => 'Emails',
    //     'value' => (int) get_post_meta($post->ID, 'email_count', true)
    // );

    if(isset($data)){

        // Hack out a GALib object
        if($data->auth_type == 'oauth')
        {
          $ga = new \GALib('oauth', NULL, $data->oauth_token, $data->oauth_secret, $data->account_id);
        }
        else
        {
          $ga = new \GALib('client', $data->auth_token, NULL, NULL, $data->account_id);
        }

        $start_date = date('Y-m-d', time() - (60 * 60 * 24 * 30));
        $end_date = date('Y-m-d');

        $result = $ga->simple_report_query(
            $start_date,
            $end_date,
            'ga:eventCategory, ga:eventAction, ga:eventLabel',
            'ga:totalEvents',
            '',
            'ga:eventCategory==Social Modal'
        );

        $stats[] = array(
            'key'   => 'map-marker',
            'title' => 'Social Feed Views',
            'value' => (int) $result
        );
    }

    try{
        $fb = get_sms_connection( get_sms_by_name('facebook') );
        if( $fb && $fb->hasConnectedPage() )
        {
            $page = $fb->getConnectedPage();
            $stats[] = array(
                'key'   => 'facebook',
                'title' => 'Facebook Fans',
                'value' => $page['likes']
            );
        }

        if( $twitter = get_sms_connection( get_sms_by_name('twitter') ) )
        {
            $stats[] = array(
                'key'   => 'twitter',
                'title' => 'Twitter Followers',
                'value' => $twitter->get_count()
            );
        }

        if( $LinkedIn = get_sms_connection( get_sms_by_name('LinkedIn') ) )
        {
            $stats[] = array(
                'key'   => 'linkedin',
                'title' => 'LinkedIn Connections',
                'value' => $LinkedIn->get_count()
            );
        }

    } catch(\Exception $e) {

        WordPress::log($e->getMessage());
    }

    return $stats;
}

function get_completion_steps()
{
    return array(COMPLETE_STEP_SMS, COMPLETE_LOGO_UPDATE, COMPLETE_STEP_SMS);
}

function get_completion_percent($biz=null)
{
    $biz = get_biz_from_user();
    $all_steps = get_completion_steps();
    $have_steps = array();

    $total = count($all_steps);

    foreach($all_steps as $step) {
        if(\get_post_meta($biz->ID, $step, true))
            $have_steps[] = $step;
    }

    return array(
        'percent'=> round((count($have_steps) / count($all_steps)) * 100),
        'have_steps' => $have_steps,
        'all_steps' => $all_steps
    );
}

function get_offers($biz = null)
{
    return get_posts(array(
        'post_type'=>TYPE_OFFER,
    ));
}

/**
 * Load activity feed for /latest-activity
 * Retrieves social activity feed for the logged in user
 */
function get_latest_activity($limit=null)
{
    $providers = get_active_sms_conections();
    $activity = array();

    foreach($providers as $provider) {

        try {
            $user_timeline = $provider->getActivityFeed('timeline');

        } catch(\Exception $e) {
            continue;
        }

        foreach( $user_timeline as $item ) {
            $item->provider = $provider->provider_name();
            $activity[] = $item;
        }
    }

    usort($activity,function($a, $b){

        $d1 = $a->date;
        $d2 = $b->date;

        if($d1 == $d2) return 0;

        return ($d1 > $d2) ? -1 : 1;

    });

    if($limit)
        $activity = array_slice( $activity, 0, $limit );

    return $activity;
}

function urls_to_hrefs($text){

    //convert text links to a tags
    $html = preg_replace("#(https?://[^\s]+)#",'<a href="$1" target="_blank">$1</a>',$text);

    //do you tube videos for fun
    preg_match_all("/v\=([\-\w]+)/",$html,$out);

    $out[1]=array_unique($out[1]);

    foreach($out[1] as $o){

        $reg="/(<a).*(youtube.com).*($o).*(\/a>)/";

        $embed= <<<HTML
        <object width="640" height="505"><param name="movie" value="http://www.youtube.com/v/$o=1&amp;hl=es_ES&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/$o?fs=1&amp;hl=es_ES&amp;rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="320" height="252"></embed></object>
HTML;

        $html=preg_replace($reg,$embed, $html);

    }

    return $html;
}

function get_news_feed($limit=3, $page=1, $category = false){

    $args =  array(
        'posts_per_page'=>$limit,
        'paged'=>$page
    );

    if($category) {
        $args['category'] = $category;
    }

    return get_posts($args);
}

//TODO .. potentially could return more than one user
function get_user_from_hauth($hauth_name, $identifier){

    $users = \get_users(array(
        'meta_key' => $hauth_id,
        'meta_value' => $identifier
    ));

    if($users) return current($users);
}

function hauth_authenticate($service_name)
{
    WordPress::log('in hauth authenticate with service_name '. $service_name);

    $wp_user = null;

    $hauth = get_hauth();

    $service = $hauth->authenticate( $service_name );

    // Try to get the user profile. If this fails at this point, we probably
    // need to get a new access token - ask the user to log in again.
    try {
        $user_profile = $service->getUserProfile();
    } catch(OAuthException $e) {
        wp_redirect('/login-hauth?s=' . $service_name );
        exit;
    }

    if( !$wp_user = get_user_from_hauth( $service_name, $user_profile->identifier) )
    {
        if (!empty($user_profile->email)) {

            $wp_user = \get_user_by('email', $user_profile->email);
            WordPress::log('Found user with email : '.$user_profile->email.' user has id of '.$current_user->ID);
        }
    }

    if( is_a($wp_user, 'WP_User' )) {

        \update_user_meta($wp_user->ID, $service_name, $user_profile->identifier);

        // Get social post ID
        $sms = get_sms_by_name($service_name);
        // Get business post ID
        $biz = get_biz_from_user();
        // Get relation ID
        $p2p_id = \p2p_type( 'sms_to_biz' )->get_p2p_id( $sms, $biz );
        // Update the user's token - this can change
        \p2p_update_meta($p2p_id, 'token', $service->adapter->token( "access_token" ));

        return $wp_user;
    }
    else {

        WordPress::log('Can\'t find a user with email : '.$user_profile->ID.' redirecting to signup ');

        // Store both the hauth profile and service in the session - so they can
        // be picked up after signup.
        $_SESSION['hauth_user_profile'] = $user_profile;
        $_SESSION['hauth_profile_service'] = $service_name;


        redirect('/signup');
    }

    return $wp_user;
}

// Gonna pull from hauth profile if we got it.
// hook on form ;load
add_filter('gform_pre_render',function($form){

    if(! \is_user_logged_in() ) {

        $hauth = get_hauth();

        foreach($hauth->getConnectedProviders() as $service_name){

            if($hauth->isConnectedWith($service_name)) {

                $profile = $hauth->authenticate($service_name)->getUserProfile();

                foreach(array('firstName','lastName','email','phone','websiteURL','description') as $field) { //todo photoURL

                    add_filter('gform_field_value_'.$field, function($value) use ($field, $profile){

                        return $profile->$field;
                    });
                }
            }
        }

        foreach(array('email','business_name') as $field){

            if(isset($_POST[$field])) {

                add_filter('gform_field_value_'.$field, function($value) use ($field){

                    return $_POST[$field];
                });
            }
        }
    }

    return $form;
});

add_filter("gform_post_data", function($post_data, $form, $entry){

    //these need to save against the user as well

    foreach($form['fields'] as $field){

        if(isset($field['inputName']) && $field['inputName'] == 'email')
            $post_data['post_custom_fields']['email'] = $entry[$field['id']];
    }

    return $post_data;

}, 10, 3);

function get_biz_logo_src($biz_id,$size=null){

    $thumb_id = \get_post_thumbnail_id($biz_id);

    list( $src, $width, $height ) = wp_get_attachment_image_src($thumb_id,$size);

    return $src;
}

/**
 * Get background image source
 *
 */
function get_biz_background_src($biz_id = false) {

    $size = null;

    if(!$biz_id) {
        $biz_id = get_biz_from_user()->ID;
    }

    $thumb_id = get_post_meta($biz_id, 'background_image_id', $single = true);

    list( $src, $width, $height ) = wp_get_attachment_image_src($thumb_id, $size);

    return $src;
}

function get_biz_address($biz_id){

    $i = 0;

    foreach(array(
        array('street_number','route'),
        array('sublocality'),
        array('locality','postal_code')) as $line){

            $address_line = array();
            foreach($line as $field){
            $address_line[] = get_field($field,$biz_id);
            $address_line = array_filter($address_line); 
            }
    
//var_dump($address[$i]);
          $address[$i] = implode(' ',$address_line);
          //var_dump($address[$i]);
            
            $i++;
        }

   return array_filter($address);


}

function time_elapsed_string($ptime) {
    $etime = time() - $ptime;

    if ($etime < 1) {
        return '0 seconds';
    }

    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
                );

    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? 's' : '');
        }
    }
}

function get_provider_id(\WP_Post $sms){

    return \get_field('hauth_provider_id',$sms->ID) ?: $sms->post_title;
 
}

/**
 * Retrieve pending social connections.
 * For Twitter + Linkedin, we check if the user has connected their account.
 * For Facebook, we need to check if they have linked a page, not just their account.
 */
function get_pending_social_connections() {

    $pending = array();

    try{
        $fb = get_sms_connection( get_sms_by_name('facebook') );
        if(!$fb)
        {
            $pending[] = array(
                'title' => 'Add Facebook',
                'url' => '/auth?s=Facebook'
            );
        } else {
            if( !$fb->hasConnectedPage() )
            {
                $pending[] = array(
                    'class' => 'connect-facebook-page',
                    'title' => 'Connect Facebook Page',
                    'url' => '/connect-facebook-page'
                );
            }
        }

        if( !($twitter = get_sms_connection( get_sms_by_name('twitter') )) )
        {
            $pending[] = array(
                'title' => 'Add Twitter',
                'url' => '/auth?s=Twitter'
            );
        }

        if( !($LinkedIn = get_sms_connection( get_sms_by_name('LinkedIn') )) )
        {
            $pending[] = array(
                'title' => 'Add LinkedIn',
                'url' => '/auth?s=LinkedIn'
            );
        }

    } catch(\Exception $e) {

        WordPress::log($e->getMessage());
    }

    return $pending;
}

include 'include/functions.php';