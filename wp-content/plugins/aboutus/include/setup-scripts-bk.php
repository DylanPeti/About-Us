<?php




$uploadImage = "http://$_SERVER[HTTP_HOST]" . "/upload-image";

/***** UI *****/

if(preg_match('/(?i)msie [2-9]/',$_SERVER['HTTP_USER_AGENT'])){

   \add_action('wp_enqueue_scripts', function(){
    wp_enqueue_script("uploadimageie", plugins_url( '/../js/upload-image-ie.js', __FILE__), array('jquery'));
    wp_enqueue_script("blueimp", '/js/jquery.ui.widget.js', array('jquery') );

    });

  }

/***** UPLOAD IMAGE *****/

if($uploadImage == "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"){

    \add_action('wp_enqueue_scripts', function(){
    wp_enqueue_script("blueimp", '/js/jquery.ui.widget.js', array('jquery') );
    wp_enqueue_script("uploadimage", plugins_url( '/../js/upload-image.js', __FILE__), array('jquery'));
    wp_enqueue_script("iframetransport", '/js/jquery.iframe-transport.js', array('jquery') );
    wp_enqueue_script("ajaxfileupload", '/js/jquery.fileupload.js', array('jquery') );
    wp_enqueue_script("ajaxfileuploadui", '/js/jquery.fileupload-ui.js', array('jquery') );
    wp_enqueue_script("xdomaintransport", '/js/x-domain-transport.js', array('jquery') );

    });

}

/***** FRONT PAGE *****/

if(is_front_page()){

   \add_action('wp_enqueue_scripts', function(){

    wp_enqueue_style( 'bootstrap',"//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css");
    wp_enqueue_script( 'bootstrap',"/js/bootstrap.min.js");
    
    });

}  


\add_action('wp_enqueue_scripts', function(){

    wp_deregister_script( 'jquery' );
    // jquery-1.10.1.min.js goes inbetween these two
    wp_register_script( 'jquery','/js/jquery-1.10.1.min.js');
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script("uploadimage", plugins_url( '/../js/upload-image.js', __FILE__), array('jquery'));
    wp_register_script( 'jquery','/js/jquery-1.10.1.min.js');
    wp_enqueue_style( 'bootstrap',"//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css");
    wp_enqueue_script( 'bootstrap',"/js/bootstrap.min.js");
    wp_enqueue_script( 'jquery-validate',"/js/jquery.validate.min.js");
    wp_enqueue_script( 'jquery-validate-methods',"/js/additional-methods.min.js");
    wp_enqueue_script( 'bootstrap-select',"/js/bootstrap-select.min.js");
    wp_enqueue_script( 'jquery-scrollto', "js/jquery.scrollTo.min.js");
    wp_enqueue_script("google_places","http://maps.googleapis.com/maps/api/js?key=AIzaSyDk4Y6ae4Ot4Nr9a_wYHimEyZxZVDIOD6s&sensor=false&libraries=places&region=nz",array('jquery'));
    wp_enqueue_script("geocomplete", plugins_url( 'aboutus/js/geocomplete/jquery.geocomplete.min.js'), array('google_places','jquery') );
    // wp_enqueue_script("jquerymigrate", '/js/jquery-migrate.js', array('jquery') );
    wp_enqueue_style( 'jqueryfileupload', '/css/jquery.fileupload-ui.css');
    wp_enqueue_script("aboutusjs", plugins_url( '../js/aboutus.js', __FILE__), array('geocomplete','jquery','ajaxfileupload','youtubin','knob','flexslider') );
    wp_enqueue_script('aboutus','/js/aboutus.js');
    wp_localize_script('aboutus', 'AboutUs', array('ajaxurl' => admin_url( 'admin-ajax.php' ), 'is_user_logged_in'=> is_user_logged_in(), 'site_url'  => site_url(), ));



});










// wp_deregister_script( 'jquery-ui-core' );
    // wp_register_script( 'jquery-ui-core','//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
    // wp_enqueue_script( 'jquery-ui-core' );
        // wp_register_script( 'jquery-ui-core','//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
    /*wp_enqueue_script("youtubin",
        plugins_url( '/../js/jquery.youtubin.js', __FILE__),
        array('jquery')
    );*/
//wp_deregister_script( 'jquery' );
    // jquery-1.10.1.min.js goes inbetween these two
   // wp_enqueue_script( 'jquery' );
    /*wp_enqueue_script("flexslider",
        get_template_directory_uri().'/js/jquery.flexslider.js',
        array('jquery')
    );
        // global $js_labels;
    // wp_enqueue_script('tb-lib', '/' . PLUGINDIR . '/tweet-blender/js/lib.js',array('jquery'), false, true);
    // wp_localize_script('tb-lib', 'TB_labels', $js_labels);
    // $dependencies[] = 'tb-lib';
    // wp_enqueue_script('tb-main', '/' . PLUGINDIR . '/tweet-blender/js/main.js', $dependencies, false, true);

    wp_enqueue_style( 'flexslider',get_template_directory_uri().'/css/flexslider.css');*/

    // wp_enqueue_style( 'fontello',get_template_directory_uri().'/css/fontello.css');
    // wp_enqueue_style( 'fontello',get_template_directory_uri().'/css/chart.css');

   

    /*wp_enqueue_script("knob",
        plugins_url( '/../js/jquery.knob.js', __FILE__),
        array('jquery')
    );*/

    



    /*<script src="/js/jquery.cycle2.min.js"></script>
    <script src="/js/jquery.cycle2.carousel.min.js"></script>*/

    //wp_enqueue_script('skype','//cdn.dev.skype.com/uri/skype-uri.js');
