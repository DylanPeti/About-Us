<?php
/*
Template Name: Search Page
*/

/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

global $wpdb;
global $query_string;
global $wp_query;

get_header();?>
</div>
<!-- <div class="extend-background"> -->

<?php 
if(!is_user_logged_in()){
include 'inc/welcome.php'; 
}
?>
<!-- </div> -->




<!-- <body style="background-color:#eee"> -->

<!-- <div class="search-by"> -->
<?php 

$auckland = "Auckland";
$Hamilton = "Hamilton";

function select_city($city){
 return $city;
}


?>

<!-- <form class="filter-form" action="" name="myform" method="POST">
<select class="search-options" id="citypost">
	<option><?php echo select_city('auckland'); ?></option>
	<option><?php echo $Hamilton; ?></option>
	<option><?php echo "Auckland"; ?></option>
	<option>Wellington</option>
	<option>Christchurch</option>
	<option>Remuera</option>
</select>
<input type="submit" name="submit" id="submit">
</form> -->
<!-- </div> -->
    <div class="section default" style="background: #eee; min-height:500px">
      
      	<?php //get_sidebar();
          $query_args = explode("&", $query_string);
          $search_query = array();

foreach($query_args as $key => $string) {
	$query_split = explode("=", $string);
	$search_query[$query_split[0]] = urldecode($query_split[1]);
} // foreach



$search = new WP_Query($search_query);
$total_results = $wp_query->found_posts;
$args = array(
    'post_type'=> 'aboutus_business',
    'areas'    => 'painting',
    'order'    => 'ASC'
    );              

$the_query = new WP_Query( $args );
if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();


$object_to_arrays = get_object_vars($the_query);

foreach($object_to_arrays['posts'] as $item){

	$user_identifier = $item->ID;
	$full_business_adress = implode('<br />',TheFold\AboutUs\get_biz_address( $user_identifier ));
    $to = TheFold\AboutUs\get_biz_address( $user_identifier );


}


endwhile; endif;


$sql = "SELECT user_login FROM wp_users";
$result = $wpdb->get_results($sql);
//print_r($result, OBJECT);
?>


<!--///////// LOOP ONE //////////-->

<?php $post_type_list = array(); ?>
<?php while ($search->have_posts()) : $search->the_post(); 
 
$post_type_list[] = get_post_type($post->ID);

endwhile; ?>

<?php if(in_array("aboutus_business", $post_type_list)){ ?>
<header class="bottom-half-header search-results-header"><h1 class="custom-font">Business Results</h1></header>
   <div class="search-container business-search-results">
<?php while ($search->have_posts()) : $search->the_post(); ?>
	<?php $user_post = get_post( $post->post_id); ?>
	 <?php $current_post_id = $user_post->post_ID; ?>
	 <?php $post_type = get_post_type( $current_post_id ); 


    if ( $post_type == "aboutus_business" && count($post) >= 1) {

	 ?>

	<div class="search-content business-page-results" style="background-color:#fff">

	  <div style=" width: 150px; height: 50px; background-image: url(<?php echo $get_profile_image ?>); background-repeat:no-repeat; background-position:right center; background-size: contain; position: absolute; right: 0; top:30%;"></div>
		 
		    <div class="content-hold" id="content-hold-this" style=" width: 220px;">
                
                 <a href="<?php echo get_permalink(get_the_ID()) ?>" id="linker"> <h3 class="custom-font"><?php echo $user_post->post_title; ?>&nbsp<span style="color:red" class="custom-font"><?php if($search->post->post_type == 'aboutus_business'){ echo "Visit"; } ?></span>
                 <span style="color:#00a3d3"><?php if($search->post->post_type == 'aboutus_marketplace'){ echo "View Offer"; } ?></span></h3></a>
                
       	        <ul>
	               <?php
	               $phones = get_field('phone', $item->post_id);
                   $phonesa = substr($phones, 1);
                   $phone =  "+64 " . $phonesa;
	               $email = get_field('email', $item->post_id);
		           echo (implode('</br>',TheFold\AboutUs\get_biz_address( $id )));
	               echo "<br /> <br />";
	               ?>
  
	               <?php if(!empty($phone)){ ?>	 <li id="search-profile-phone"><?php   echo $phone; ?></li> <?php } else { ?> <li id="search-profile-phone"><?php echo "-"; ?></li> <?php }?>
	               <?php if(!empty($email)){ ?>	 <li id="search-profile-email"><?php   echo $email; ?></li> <?php } else { ?> <li id="search-profile-email"><?php echo "-"; ?></li> <?php } ?>
	            
	            </ul>
	
                <?php $post_name = $user_post->post_name;
                $actual_link = "http://$_SERVER[HTTP_HOST]/about/$post_name"; ?>

           </div>

   </div>  <?php }


    endwhile; ?> </div> <?php } ?>
    
   




<!--///////// LOOP TWO //////////-->

<?php if(in_array("aboutus_marketplace", $post_type_list)){ ?>
   <header class="bottom-half-header search-results-header"><h1 class="custom-font">Offer Results</h1></header>
  <div class="search-container business-search-results"> 

   <?php while ($search->have_posts()) : $search->the_post(); ?>
	 
	 <?php $post_type = get_post_type( $current_post_id ); 
    if ($post_type == "aboutus_marketplace"  && count($post) >= 1) {  ?>

	<div class="search-content" style="background-color:#fff">

	  <div style=" width: 150px; height: 50px; background-image: url(<?php echo $get_profile_image ?>); background-repeat:no-repeat; background-position:right center; background-size: contain; position: absolute; right: 0; top:30%;"></div>
		 
		    <div class="content-hold" id="content-hold-this" style=" width: 220px;">
            
                
       	      

            <?php
            
            $meta_values = array();
            $meta_values[] = get_post_meta($post->ID, 'video', true );
            $meta_values[] = get_post_meta($post->ID, 'description', true );
            $meta_values[] = get_post_meta($post->ID, 'link', true );
            $meta_values[] = get_post_meta($post->ID, 'button', true );
            $meta_values[] = get_post_meta($post->ID, 'image', true );


            ?>
<!-- 	<div class="marketplace-sidebar-image" id="image" style="background-image: url('<?php echo thumbnail_in_style() ?>')"></div>
 -->   <div class="marketplace-sidebar-description">
 <h3 class="custom-font"><?php the_title(); ?></h3>
                 <p id="large-content cont"  class="cont"><?php 
                 $length = 160;
                 $wrapper_length = 160;
                 echo excerpt_string_length($length, $wrapper_length) . "...";   ?>
                 </p>
                 <a href="<?php echo get_the_permalink($post->ID); ?>">
                 <p id="tagthree" class="custom-font"> <?php echo $meta_values[3]; ?></p>
                 </a>
             </div>
	            
	          




           </div>

   </div>   <?php  } 

  endwhile; ?> </div> <?php } ?>






<!--///////// LOOP THREE //////////-->
<?php if(in_array("post", $post_type_list)){ ?>
 <header class="bottom-half-header search-results-header"><h1 class="custom-font">Article Results</h1></header>
 <div class="search-container business-search-results">
   <?php while ($search->have_posts()) : $search->the_post(); ?>
	 <?php $current_post_id = $user_post->post_ID; ?>
	 <?php $post_type = get_post_type( $current_post_id ); ?>
	

    	 <?php if ($post_type == "post" && count($post) >= 1) { ?>



	<div class="search-content" style="background-color:#fff">

	  <div style=" width: 150px; height: 50px; background-image: url(<?php echo $get_profile_image ?>); background-repeat:no-repeat; background-position:right center; background-size: contain; position: absolute; right: 0; top:30%;"></div>
		 
		    <div class="content-hold" id="content-hold-this" style=" width: 220px;">
                
                 <a href="<?php echo get_permalink(get_the_ID()) ?>" id="linker"> <h3 class="custom-font"><?php $user_post = get_post( $item->post_id); echo $user_post->post_title; ?>&nbsp<span style="color:red" class="custom-font"><?php if($search->post->post_type == 'aboutus_business'){ echo "Visit"; } ?></span>
                 <span style="color:#00a3d3"><?php if($search->post->post_type == 'aboutus_marketplace'){ echo "View Offer"; } ?></span></h3></a>
                
             <p id="search-article-content">  <?php

                $trimmed = strip_tags(get_the_content());

               echo wp_trim_words($trimmed, 25); ?> </p>
               <a href="<?php echo the_permalink() ?>">
             <p id="tagfour" class="custom-font">Read More</p>
             </a>

           </div>

   </div>  <?php  } 
   	endwhile; ?> </div>  <?php } ?>




</div>



<!--///////// END //////////-->



<script type="text/javascript">
$("#citypost").change(function() {
	var action = $(this).val();
  $(".filter-form").attr("action", "/cities/" + action);
});
</script>



<?php  get_footer(); ?>
