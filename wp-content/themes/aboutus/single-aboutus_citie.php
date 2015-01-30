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

global $query_string;
global $wp_query;
?>
<?php $selected = $_GET['selected']; ?>

<?php get_header(); ?>
<div class="search-by">
<?php 

$auckland = "Auckland";
$Hamilton = "Hamilton";

function select_city($city){
 return $city;
}

?>


</div>
 <div class="section default" style="background: #eee; min-height:500px">
   <div class="town-thumbnail" id="directory-image" style="margin-bottom:20px; width:100%; height: 320px; background-image: url('<?php echo thumbnail_in_style() ?>')">
     <h1 id ="searching-title" style="color:#fff; font-size: 52px; width:100%; text-align:center; position:relative; top:60px;"><?php echo the_title() . " Directory"; ?></h1>
     <?php $args = array( 'post_type' => 'aboutus_citie'); ?>
     <?php foreach (filter_search_by_town() as $item) { 
           $cities_no_duplicate[] = $item->meta_value;
     }  ?>


  <form class="filter-form" name="myform">
    <select class="search-options" id="citypost" onchange="showUser(this.value);directoryImage(this.value);" name="Search Town">
      <?php $i = array(); ?> 
      <option value=""><strong><?php echo select_city('Search Town'); ?></strong></option>
      <?php foreach (array_unique($cities_no_duplicate) as $value) { ?>
      <?php if ($value != 0 || $value != 'a:0:{}'){ ?>
      <option value="<?php echo $value; ?>"><?php echo $value; ?></option> 
      <?php } } ?>
   </select>

   <select class="search-keyword" id="citypost" onchange="keywordSelection(this.value)" name="Search Town">
    <option value="Keyword">Keyword</option> 
    <option value="internet">Internet</option> 
    <option value="cars">cars</option> 
    <option value="business">business</option> 
   </select>
  </form>
</div>
      <div class="search-container" id="custom-search-container" style="width:100%; clear:both;">

    <?php
    foreach (filter_search_by_town() as $item) {
    if($item->meta_value == $selected){ ?>
    <?php  
    $id = $item->post_id;	?>
    <?php  $background_image = TheFold\AboutUs\get_biz_background_src($id); 
           $get_profile_image =  TheFold\AboutUs\get_biz_logo_src($id); ?>

  <div class="search-content" style="position:relative; background-color:#fff">
   <div style=" width: 150px; height: 50px; background-image: url(<?php echo $get_profile_image ?>); background-repeat:no-repeat; background-position:right center; background-size: contain; position: absolute; right: 0; top:30%;"></div>
		<div class="content-hold" id="content-hold-this" style=" width: 260px;">
		  <h2><?php 	$user_post = get_post( $item->post_id); echo $user_post->post_title; ?></h2> <?php $current_post_id = $user_post->post_ID; ?>
	     <ul>
	        <?php
	        $phones = get_field('phone', $item->post_id);
          $phonesa = substr($phones, 1);
          $phone =  "+64 " . $phonesa;
	        $email = get_field('email', $item->post_id);
	        echo (implode('</br>',TheFold\AboutUs\get_biz_address( $id )));
	        echo "<br /> <br />";  ?>
	        <?php if(!empty($phone)){ ?>	 <li id="search-profile-phone"><?php   echo $phone; ?></li> <?php } else { ?> <li id="search-profile-phone"><?php echo "-"; ?></li> <?php }?>
	        <?php if(!empty($email)){ ?>	 <li id="search-profile-email"><?php   echo $email; ?></li> <?php } else { ?> <li id="search-profile-email"><?php echo "-"; ?></li> <?php } ?>
       </ul>
	    </div>
  </div>



<script>
   $('#citypost').on('change', function() {
   	// var optionSelected = $("option:selected", this);
    // var valueSelected = this.value;
    var changedTitle = $( "#citypost option:selected" ).text();
   	// console.log(changedTitle);
   $('#searching-title').html(changedTitle + " Directory");
})
</script>
<?php }  } ?>



<?php get_footer(); ?>




