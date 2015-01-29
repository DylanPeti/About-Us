<?php
/**
 * Template Name: Profile Default
 * Default admin pages.
 */


get_header();


?>




    <div class="section default">
      <div class="container">
      	<?php get_sidebar('profile'); ?>
	     	<div class="content">
		  	
          <?php while ( have_posts() ) : the_post(); ?>
				  <?php get_template_part( 'content', 'profile' ); ?>
		  	  <?php endwhile; // end of the loop. ?>

          <?php //require '/Users/Dylan/Applications/aboutus/wp-content/plugins/aboutus/views/privacy-settings.php'; ?>
		
       </div>
      </div>
    </div>

<?php get_footer(); ?>