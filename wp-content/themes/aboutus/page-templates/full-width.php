<?php
/**
 * Template Name: Full Width
 * No sidebar
 */

get_header(); ?>

<div class="page-template-container">
			<?php while ( have_posts() ) : the_post(); ?>
				<h1 class="custom-font"><?php the_title(); ?></h1>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>
</div>


<?php get_footer(); ?>