<?php
/**
 * Template Name: Newsroom Page
 * Static page displayed in Newsroom format.
 */

global $newsroom_globals;
$newsroom_globals['newsroom_current_category'] = 'Hot News';

$twitter_feed_hashtags = '#aboutus';
if(count($news_feed)) {
	$twitter_feed_hashtags = get_field('twitter_feed_hashtag', $news_feed['0']->ID);
}

get_header();
?>

<div class="newsroom-container clearfix">

<?php include(locate_template('inc/newsroom/archive-feed.php')); ?>
	<div class="newsroom-article">
		<div class="article">
			<div class="article-content">
			
<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
<?php endwhile; // end of the loop. ?>
			</div>
		</div>
<?php if(count($news_feed)): foreach($news_feed as $news): ?>
		<div class="article">
			<div class="article-header">
				<h1><a href="<?php echo get_permalink($news->ID) ?>"><?php echo $news->post_title ?></a></h1>
				<div class="meta">By <a href="<?php echo get_author_posts_url($news->post_author) ?>"><?php echo get_the_author_meta('user_nicename', $news->post_author) ?></a>   |   <?php echo date('d/m/Y', strtotime($news->post_date)) ?>   |   <?php the_category(', ', '', $news->ID) ?></div>
			</div>
			<div class="article-hero">
				<?php echo get_the_post_thumbnail($news->ID,'large')?>
			</div>
			<div class="article-content">
			<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style" addthis:url="<?php echo get_permalink($news->ID); ?>" addthis:title="<?php echo $news->post_title; ?>" style="margin-bottom:25px;">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<!-- AddThis Button END -->
				<?php echo $news->post_content ?>
			</div>
		</div>
<?php endforeach; endif ?>
	</div>
</div>

<div id="paging"><?php global $wp_query; echo get_next_posts_link('Next Page', $wp_query->max_num_pages); ?></div>

<?php get_footer('newsroom'); ?>