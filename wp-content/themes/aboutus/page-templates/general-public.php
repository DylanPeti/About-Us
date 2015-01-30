<?php
/**
 * Template Name: General Public
 * Public end of site. Not logged in to see. With Sidebar
 */

get_header(); ?>

    <div class="section default">
      <div class="container">
      	<?php get_sidebar(); ?>
		<div class="content">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>
		</div>
      </div>
    </div>

<?php get_footer(); ?>