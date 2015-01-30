<?php
$stylesVersion = 19;


/* ------- SET UP THE ADMIN WITH SOME WP GOODNESS -------- */

function my_wp_default_styles($styles)
{
	global $stylesVersion;
	//use release date for version
	
	$styles->default_version = $stylesVersion;
}

add_action("wp_default_styles", "my_wp_default_styles");




function thefold_setup() {
 

  // This theme styles the visual editor with editor-style.css to match the theme style.
  add_editor_style();

  // Adds RSS feed links to <head> for posts and comments.
  add_theme_support( 'automatic-feed-links' );

  // This theme supports a variety of post formats.
  add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status') );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menu( 'primary', __( 'Primary Menu', 'thefold' ) );

  /*
   * This theme supports custom background color and image, and here
   * we also set up the default background color.
   */
  add_theme_support( 'custom-background', array(
    'default-color' => 'e6e6e6',
  ) );
  set_post_thumbnail_size('200', '200', true ); 

  // This theme uses a custom image size for featured images, displayed on "standard" posts.
  add_theme_support( 'post-thumbnails' );
  //set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
  //set_post_thumbnail_size( 900, 9999 );
  add_image_size( 'homepage-thumb-top', 780, 390);
  add_image_size( 'homepage-thumb-middle', 526, 266);
  add_image_size( 'homepage-thumb-middle-right', 234, 117);
  add_image_size( 'homepage-thumb', 374, 300);
  add_image_size( 'single-img', 540, 366);

  // add_image_size('postimagewhat','600',false,false);
}
add_action( 'after_setup_theme', 'thefold_setup' );

/* Hide the admin bar from logged in users */
add_filter('show_admin_bar', '__return_false');



function is_ie(){
    if(preg_match('/(?i)msie [2-9]/',$_SERVER['HTTP_USER_AGENT'])){
      return true;
    } else{
      return false;
    }
}

/* ------- LOAD OUR SCRIPTS -------- */


function thefold_scripts_styles() {

  /*
  * Adds JavaScript for handling the navigation menu hide-and-show behavior.

  */

wp_enqueue_script( 'load-offers', get_template_directory_uri() . '/js/load-offers.js', array(), '1.0', false );
wp_enqueue_script( 'adhub', '/core/admotion/_021_adhub_server_v4.js', array(), '1.0', false );
wp_enqueue_script( 'jssor-slider', '/wp-content/themes/aboutus/vendor/slider-master/js/jssor.slider.min.js', array(), '1.0', false );
wp_enqueue_script( 'load-offers', get_template_directory_uri() . '/js/load-offers.js', array(), '1.0', false );
wp_enqueue_script( 'modernizr-source', '/wp-content/themes/aboutus/js/modernizr.custom.js', array(), '1.0', false );



  

  //jquery
  wp_enqueue_script('querydb', get_template_directory_uri() . '/search/search.js',array('jquery'),'1.0',false);
  wp_enqueue_script('ajaxthis', get_template_directory_uri() . '/ajax/ajax.js',array('jquery'),'1.0',false);
  wp_enqueue_script('jquerycookie', get_template_directory_uri() . '/js/jquery.cookie.js',array('jquery'),'1.0',false);
  wp_enqueue_script('requirejs', get_template_directory_uri() . '/js/require.js',array('jquery'),'1.0',false);
  // wp_enqueue_script( 'jqueryui', '/js/jquery-ui-1.11.2/jquery-ui.js', array('jquery'), '1.0', false );
  wp_enqueue_script( 'advertslider', get_template_directory_uri() . '/js/slider.js', array('jquery'), '1.0', false );
  wp_enqueue_script("uploadimae", get_template_directory_uri() . '/js/upload-image.js', array('jquery','ajaxfileupload','ajaxfileuploadui'), '1.0', false);
  
//quirks mode

  if(is_ie()){
      wp_enqueue_style( 'custom-ie-style', get_template_directory_uri() . '/css/custom-ie.css', null, '4.0.1', false);

  }
 
  wp_enqueue_style( 'thefolds-styles', get_stylesheet_uri() );
  wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/custom.css', null, '4.0.1', false);
  wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', null, '4.0.1', false);

 
}

add_action( 'wp_enqueue_scripts', 'thefold_scripts_styles' );




/*

  wp_enqueue_script( 'thefold-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', false );

*/







function my_login_stylesheet() {

	global $stylesVersion;

 ?>
    <link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/style-login.css?v=' . $stylesVersion; ?>" type="text/css" media="all" />
<?php }
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );


/* ------- REGISTER OUR SIDEBARS -------- */


function thefold_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Main Sidebar', 'thefold' ),
    'id' => 'sidebar-1',
    'description' => __( 'Default sidebar that will appear on most pages', 'thefold' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  register_sidebar( array(
    'name' => __( 'Footer', 'thefold' ),
    'id' => 'footer',
    'description' => __( 'Global Footer area', 'thefold' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
}
add_action( 'widgets_init', 'thefold_widgets_init' );




/* ------- ADD OUR CUSTOM POST TYPES -------- */




/* ------- ADD OUR CUSTOM TAXONOMIES -------- */

add_action( 'init', 'events_tax' );
function events_tax()
{
   register_taxonomy(
      'events',
      'post',
      array(
         'label' => __( 'Events' ),
         'rewrite' => array( 'slug' => 'event' ),
         'hierarchical' => true
      )
   );
}



/**
 *  Install Add-ons
 *
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *
 *  All fields must be included during the 'acf/register_fields' action.
 *  Other types of Add-ons (like the options page) can be included outside of this action.
 *
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme as outlined in the terms and conditions.
 *  However, they are NOT to be included in a premium / free plugin.
 *  For more information, please read http://www.advancedcustomfields.com/terms-conditions/
 */

// Fields
add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
	//include_once('add-ons/acf-repeater/repeater.php');
	//include_once('add-ons/acf-gallery/gallery.php');
	//include_once('add-ons/acf-flexible-content/flexible-content.php');
}

// Options Page
//include_once( 'add-ons/acf-options-page/acf-options-page.php' );


/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_business',
		'title' => 'Business',
		'fields' => array (
			array (
				'key' => 'field_517903292094a',
				'label' => 'Slogan',
				'name' => 'slogan',
				'type' => 'text',
				'instructions' => 'Your one liner',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_50bff04b7369a',
				'label' => 'Phone',
				'name' => 'phone',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_50bff05f7369b',
				'label' => 'Mobile',
				'name' => 'mobile',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_50bff07f7369c',
				'label' => 'Email',
				'name' => 'email',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_50bff09f7369d',
				'label' => 'Website',
				'name' => 'website',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_50bff09f7369e',
				'label' => 'Region',
				'name' => 'region',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_1',
				'label' => 'Street Number',
				'name' => 'street_number',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_7',
				'label' => 'Street',
				'name' => 'route',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_2',
				'label' => 'Suburb',
				'name' => 'sublocality',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_3',
				'label' => 'City',
				'name' => 'locality',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_4',
				'label' => 'Post Code',
				'name' => 'postal_code',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
			array (
				'key' => 'field_6',
				'label' => 'Google Place ID',
				'name' => 'google_place_id',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
			),
		),
		'location' => array (
			'rules' => array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'aboutus_business',
					'order_no' => 0,
				),
			),
			'allorany' => 'all',
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

/*----------------------------------------
THIS IS DEVELOPMENT TESTING
------------------------------------------*/


function get_custom_cat_template_three($single_template_three) {
     global $post;
 
       if ( in_category( 'About Us' )) {
          $single_template_three = dirname( __FILE__ ) . '/category-about-us.php';
     }
     return $single_template_three;
}

add_filter( "single_template_three", "get_custom_cat_template_three" ) ;

 
function get_custom_cat_template($single_template) {
     global $post;
 
       if ( in_category( 'blogging' )) {
          $single_template = dirname( __FILE__ ) . '/category-blogging.php';
     }
     return $single_template;

}
 
add_filter( "single_template", "get_custom_cat_template" ) ;


function get_custom_cat_template_two($single_template_two) {
     global $post;
 
       if ( in_category( 'hot news' )) {
          $single_template_two = dirname( __FILE__ ) . '/category-news.php';
     }
     return $single_template_two;
}
 
add_filter( "single_template_two", "get_custom_cat_template_two" ) ;



function mini_post($categorys, $do_not_duplicate, $posts_in = 1, $excluded_items = array(''), $any = 'any'){
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
if( in_array($categorys, $excluded_items) ) continue;
$flower = array( 'category_name' => $categorys, 
                'posts_per_page' => $posts_in, 
                  'post__not_in' => $do_not_duplicate, 
                     'post_type' => $any,
                         'paged' => $paged, 
                         'order' => 'DESC',
                         'orderby' => 'post_date',
                        
                         );
return $flower;
}


function mini_post_custom($categorys, $do_not_duplicate, $posts_in = 1, $excluded_items = array(''), $any = 'any'){
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
if( in_array($categorys, $excluded_items) ) continue;
$flower = array( 'category__and' => $categorys, 
                'posts_per_page' => $posts_in, 
                  'post__not_in' => $do_not_duplicate, 
                     'post_type' => $any,
                         'paged' => $paged, 
                         'order' => 'DESC',
                         'orderby' => 'post_date',
                        
                         );
return $flower;
}


function thumbnail_in_style($ID = null){
          if($ID){


             $minithumb = get_post_thumbnail_id($ID);

          } else {
          $minithumb = get_post_thumbnail_id();
           }
          $thethumb = wp_get_attachment_image_src($minithumb,'thumbnail-size', true);
          $link = "http://" . "$_SERVER[HTTP_HOST]" . "/";
          $awsLink = "http://d1v3jyvmwzvll7.cloudfront.net/";
          $file = str_replace($link, $awsLink, $thethumb[0]);
          $file_headers = @get_headers($file);
          if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
           return $thethumb[0];
          } 
          return $file;
} 

// function thumbnail_styles($id){
//           $minithumb = get_post_thumbnail_id($id);
//           $thethumb = wp_get_attachment_image_src($minithumb,'thumbnail-size', true);

//           return $thethumb[0];
// } 


function trim_the_content($word_number = 5, $ID = null, $field = null){
  if(empty($field)){

         $field = get_post_field('post_content', $ID, '');

  }
         $trimmed = wp_trim_words($field, $word_number); 

         return $trimmed; 
}

function trim_the_excerpt($word_number = 5){
         $field = get_post_field('post_excerpt', '');
         $trimmed = wp_trim_excerpt($field, $word_number); 

         return $trimmed; 
}

function myTemplateSelect() {
    if (is_category() && !is_feed()) {
        if (cat_is_ancestor_of(1368, get_query_var('cat'))) {
            load_template(TEMPLATEPATH . '/category-marketplace.php');
            exit;
        }
    }
}

add_action('template_redirect', 'myTemplateSelect');



function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/*--------------------------------------------
ADDING JQUERY TO THE ENTIRE SITE 
----------------------------------------------*/


 
/*--------------------------------------------
ADDING AJAX FUNCTION
----------------------------------------------*/
/*function register_ajaxLoop_script() {
    wp_register_script(
      'ajaxLoop',
      get_stylesheet_uri() . '/js/ajaxLoop.js',
       array('jquery')
    );
    wp_enqueue_script('ajaxLoop');
}
add_action('wp_enqueue_scripts', 'register_ajaxLoop_script');*/


function excerpt_string_length($length = 10, $wrapper_length){
	$string = get_the_excerpt();
if (strlen($string) > $length) 
{
    $wrap = wordwrap($string, $wrapper_length) ;
    $i = strpos($wrap, "\n");
    $excerpt = substr($wrap, 0, $i);
    
}
return $excerpt;
}


function trim_mini_title_length($length = 10, $wrapper_length, $cat_title){
  $string = $cat_title;
if (strlen($string) > $length) 
{
    $wrap = wordwrap($string, $wrapper_length) ;
    $i = strpos($wrap, "\n");
    $mini_title = substr($wrap, 0, $i);
    
}

if(!isset($mini_title)){
  return false;
}

return $mini_title;
}



function my_sort_custom( $orderby, $query ){
    global $wpdb;

    if(!is_admin() && is_search()) 
        $orderby =  $wpdb->prefix."posts.post_type ASC, {$wpdb->prefix}posts.post_date DESC";

    return  $orderby;
}

add_filter('posts_orderby','my_sort_custom',10,2);



// function add_opengraph_doctype( $output ) {
//     return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
//   }
// add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

function insert_fb_in_head() {
  global $post;
  if ( !is_singular()) //if it is not a post or a page
    return;





        echo '<meta property="fb:admins" content="' . TheFold\AboutUs\get_biz_from_user($current_user->ID)->ID . '"/>';
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="About Us"/>';
  if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
    $default_image="http://wp.aboutus.s3.amazonaws.com/assets/home/background.jpg"; //replace this with a default image on your server or an image in your media library
    echo '<meta property="og:image" content="' . $default_image . '"/>';
  }
  else{
    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
    echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
  }
  echo "
";
}
// add_action( 'wp_head', 'insert_fb_in_head', 5 );

function fb_change_search_url_rewrite() {
  if ( is_search() && ! empty( $_GET['s'] ) ) {
    wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
    exit();
  } 
}
add_action( 'template_redirect', 'fb_change_search_url_rewrite' );

function test(){
  echo "hi";
}


function filter_search_by_town(){
global $wpdb;
$sql = "SELECT * FROM wp_postmeta WHERE meta_key='locality'";
$result = $wpdb->get_results($sql);
return $result;
}

function store_user_post($user_id, $post_title = ''){
  global $wpdb;
  if (is_user_logged_in()){
  $sql = "SELECT * FROM wp_posts WHERE post_author= '".$user_id."'";
  $results = $wpdb->get_results($sql);
  foreach ($results as $result) {
  add_post_meta($result->ID, 'suggested', $post_title ); 
  break;
  }
 } 
}

function baseUrl($url = ''){
  $link = "http://" . "$_SERVER[HTTP_HOST]" . "/" . "$url"; 
  return $link;
}

function curl_get($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    $return = curl_exec($curl);
    curl_close($curl);
    return $return;
}





function postArgSingle($type = null, $child_of = null, $orderby = null, $order = null, $hide_empty = null, $hierarchical = null, $taxonomy = null, $pad_counts = null, $title= '', $include = null, $exclude = null, $parent =''){
$args = array(
  'type'                     => $type,
  'child_of'                 => $child_of,
  'orderby'                  => $orderby,
  'parent'                   => $parent,
  'order'                    => $order,
  'hide_empty'               => $hide_empty,
  'hierarchical'             => $hierarchical,
  'taxonomy'                 => $taxonomy,
  'pad_counts'               => $pad_counts,
  'title_li'                 => '',
  'include'                  => '',
  'exclude'                  => ''

); 

return $args;

}



function postArgs($numberposts = null, $offset = null, $category = null, $orderby = null, $order = null,  $include = null, $exclude = null, $post_type = null, $post_status = null, $suppress_filters = null){
     $args = array(
    'numberposts' => $numberposts,
    'offset' => $offset,
    'category' => $category,
    'orderby' => $orderby,
    'order' => $order,
    'include' => $include,
    'exclude' => $exclude,
    'post_type' => $post_type,
    'post_status' => $post_status,
    'suppress_filters' => $suppress_filters );


     return $args;
}


function articles($postArgs){
 
   foreach ($postArgs as $item) {  
    $postID = $item['ID'];     
    $tag = get_the_category($postID); ?>

    

           <section class="bottom-section-one">
                <a href="<?php echo get_permalink($postID); ?>"> 
                   <div class="left-section-image" id="image" style="background-image: url('<?php echo thumbnail_in_style($postID); ?>')"></div>
                 </a>
                    <?php $base_url = "http://$_SERVER[HTTP_HOST]"; ?>
                   <a href="<?php echo $base_url . '/category/' . $category[0]->name ?>">
                   <span id="tag"><?php echo $tag[0]->name; ?></span>
                   </a>

                   <div class="left-section-description">
                
                   <h3><?php echo $item['post_title']; ?></h3>
                   <p id="large-content"><?php echo trim_the_content(50, $postID, ''); ?></p>
                   <p id="small-content"><?php echo trim_the_content(10, $postID, ''); ?></p>
                   
                 </div>
                 <a href="<?php echo get_permalink($postID); ?>"> 
                 <span id="read-more">Read More ›</span>
                  </a>
             </section>









   <?php  }
 }

 function articlesSmall($postArgs = null){
if(!$postArgs){
  $postArgs = array(
  'type'                     => 'post',
  'child_of'                 => 0,
  'parent'                   => '',
  'orderby'                  => 'name',
  'order'                    => 'ASC',
  'hide_empty'               => 1,
  'hierarchical'             => 1,
  'exclude'                  => array(1375, 1374, 1247, 1249, 1007, 994, 1189, 1014, 1008, 1246, 1247),
  'include'                  => '',
  'number'                   => '',
  'taxonomy'                 => 'category',
  'pad_counts'               => false 

); 
}
 $trim_the_results  = (!is_category()) ? array_slice(get_categories($postArgs), 0, 8) : (is_category() ? array_slice(get_categories($postArgs), 0, 8) : false);  


  $count = array(); 
      foreach ($trim_the_results as $item) { 
      if(!empty($item->name)){ ?>

          <div class="column">

            <ul>               
               <?php $post_item = new WP_Query( mini_post($item->name, '', 3)); 
          

               $postCount = count($post_item->posts);
               // if($postCount >= 3)  {
  
               if( $post_item->have_posts() ) : while ($post_item->have_posts()) : $post_item->the_post(); ?>
              
               <?php $linkID = $post_item->posts[0]->ID; ?>
               <?php $post_count = $post_item->current_post +1; 
               if($post_count == 1){ ?>    
               <?php if (empty($item->name)) {
                 echo "yes";
               }   ?>

               <h3 id="mini-heading"> <?php $length = 3; $wrapper_length = 3; $mini_heading = trim_mini_title_length($length, $wrapper_length, $item->name); echo $item->name;   ?> </h3> 
                <?php } ?>
                 <li id="post-item">
                 <a href="<?php echo get_post_permalink($linkID); ?>"> 

                 <div id="image" style="background-image: url('<?php echo thumbnail_in_style() ?>')"></div>
                 <div class="extra-post-content">
                 <h5 class="custom-font"><?php the_title(); ?></h5>
                 <h6 class="custom-font"><?php echo trim_the_content(); ?></h6>
                 </div>
                 </a>
                 </li>
              <?php  endwhile; endif; ?>
              <?php //} ?>
           </ul> 

      </div>
    <?php }  }  


 }















 function postType($type = null, $ID){
 $actual = get_post_type($ID);

 if ($actual == $type){

  return false;

 }

 return true;

 }



function check_user_agent ( $type = NULL ) {
        $user_agent = strtolower ( $_SERVER['HTTP_USER_AGENT'] );
        if ( $type == 'bot' ) {
                // matches popular bots
                if ( preg_match ( "/googlebot|adsbot|yahooseeker|yahoobot|msnbot|watchmouse|pingdom\.com|feedfetcher-google/", $user_agent ) ) {
                        return true;
                        // watchmouse|pingdom\.com are "uptime services"
                }
        } else if ( $type == 'browser' ) {
                // matches core browser types
                if ( preg_match ( "/mozilla\/|opera\//", $user_agent ) ) {
                        return true;
                }
        } else if ( $type == 'mobile' ) {
                // matches popular mobile devices that have small screens and/or touch inputs
                // mobile devices have regional trends; some of these will have varying popularity in Europe, Asia, and America
                // detailed demographics are unknown, and South America, the Pacific Islands, and Africa trends might not be represented, here
                if ( preg_match ( "/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent ) ) {
                        // these are the most common
                        return true;
                } else if ( preg_match ( "/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent ) ) {
                        // these are less common, and might not be worth checking
                        return true;
                }
        }
        return false;
}




function meta_current_url(){
  global $wp;
  return home_url(add_query_arg(array(),$wp->request));
}






