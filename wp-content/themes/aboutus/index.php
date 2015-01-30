<?php get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<div id="logo_home">
				<h1 class="logo_home">About us</h1>
				<h2 class="site_desc"><?php echo get_bloginfo ( 'description' );  ?></h2>
			</div>

			<div id="apps_home">
				From the land of the long white cloud.
			</div>

			<?php get_template_part( 'inc/home', 'slider'); ?>

                        <?php if(!get_current_user_id()):?>
                            <?php get_template_part( 'inc/home', 'login'); ?>
                        <?php else:?>
                            <a href='/dash'>View my profile</a>
                        <?php endif;?>

		 	<?php get_template_part( 'inc/home', 'benefits'); ?>

		 	<?php get_template_part( 'inc/partners'); ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
