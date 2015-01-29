<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */


get_header();

?>


      <div class="container-newsroom">
      	<?php //get_sidebar(); ?>
		<div class="content">
			<header class="entry-header" id="error-header">
				<h1 class="entry-title"><?php _e( "Ooops, it seems that the page you're looking for doesn't exist!", 'twentytwelve' ); ?></h1>
			</header>

			<div class="entry-content" id="error-content">
				<h3><?php _e( "But don't give up. Please try again.", 'twentytwelve' ); ?></h3>
				  <a href="/"><button id="error-redirect" style="margin-bottom:20px;">Home</button></a>
			</div>
		</div>
		<?php get_footer(); ?>
      </div>



