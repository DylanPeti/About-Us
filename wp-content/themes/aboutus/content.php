<?php /*	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">


			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-breadcrumb"><a href="/newsroom">Newsroom</a> / <?php the_category(' ', '') ?> / <?php the_title(); ?></div>

			<div class="article_meta">
			By <a href="#"><?php the_author() ?></a>  |  <?php the_time('dS F Y') ?>  |  <?php the_category(', '); ?></div>
				<?php if ( comments_open() ) : ?>
					<div class="comments-link">

					</div><!-- .comments-link -->
				<?php endif; // comments_open() ?>
			</div>

		</header><!-- .entry-header -->


		<div class="entry-content">
			<?php the_content( ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">

		</footer><!-- .entry-meta -->
	</article><!-- #post -->*/

global $hide_meta;

	?>



		<div id="post-<?php the_ID(); ?>" class="article">
		<!-- 	<div class="article-header">
				<h1><a href="<?php echo get_permalink(get_the_ID()) ?>"><?php the_title(); ?></a></h1>
<?php if(!$hide_meta): ?>
				<div class="meta">By <?php the_author_posts_link() ?>   |   <?php the_time('d/m/Y') ?>   |   <?php the_category(', ') ?></div>
<?php endif ?>
			</div> -->
			<!--<div class="article-hero">
				<?php //echo the_post_thumbnail('large')?>
			</div>-->
			<div class="article-content">
			<!-- AddThis Button BEGIN -->
<!-- <div class="addthis_toolbox addthis_default_style" addthis:url="<?php the_permalink(); ?>" addthis:title="<?php echo $news->post_title; ?>" style="margin-bottom:25px;">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div> -->
<!-- AddThis Button END -->
				<?php the_content() ?>
			</div>
		</div>