
<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

global $newsroom_globals;

if ( is_day() ) :
	$newsroom_globals['newsroom_current_category'] = sprintf( __( 'Daily Archives: %s', 'twentytwelve' ), '<span>' . get_the_date() . '</span>' );
elseif ( is_month() ) :
	$newsroom_globals['newsroom_current_category'] = sprintf( __( 'Monthly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );
elseif ( is_year() ) :
	$newsroom_globals['newsroom_current_category'] = sprintf( __( 'Yearly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentytwelve' ) ) . '</span>' );
else :
	$newsroom_globals['newsroom_current_category'] = __( 'Archives', 'twentytwelve' );
endif;

$category = get_the_category();
$archive_feed_category = $category['0']->cat_ID;

$twitter_feed_hashtags = '';
if(have_posts()) {
	global $wp_query;
	$twitter_feed_hashtags = get_field('twitter_feed_hashtag', $wp_query->post->ID);
}

get_header('newsroom'); ?>

<div class="newsroom-container clearfix">
<?php include(locate_template('inc/newsroom/twitter-feed.php')); ?>
<?php include(locate_template('inc/newsroom/archive-feed.php')); ?>
	<div class="newsroom-article" style="margin-left:20px;">
<?php if ( have_posts() ) : ?>
<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;

			?>
<?php /*if(count($news_feed)): foreach($news_feed as $news): ?>
		<div class="article">
			<div class="article-header">
				<h1><a href="<?php echo get_permalink($news->ID) ?>"><?php echo $news->post_title ?></a></h1>
				<div class="meta">By <a href="<?php echo get_author_posts_url($news->post_author) ?>"><?php echo get_the_author_meta('user_nicename', $news->post_author) ?></a>   |   <?php echo date('d/m/Y', strtotime($news->post_date)) ?>   |   <?php the_category(', ', '', $news->ID) ?></div>
			</div>
			<div class="article-hero">
				<?php echo get_the_post_thumbnail($news->ID,'large')?>
			</div>
			<div class="article-content">
				<?php echo $news->post_content ?>
			</div>
		</div>
<?php endforeach; endif*/ ?>
<?php endif ?>
	</div>
</div>

<div id="paging"><?php global $wp_query; echo get_next_posts_link('Next Page', $wp_query->max_num_pages); ?></div>

<?php get_footer('newsroom'); ?>