	<ul class="newsroom-feed">
<?php
$archive_feed = TheFold\AboutUs\get_news_feed(15, 1, $archive_feed_category);

 if(count($archive_feed)): foreach($archive_feed as $post): ?>	
		<li>
			<a href="<?php echo get_permalink($post->ID) ?>">
				<?php /*<div class="thumb">
					<?php echo get_the_post_thumbnail($post->ID,'small')?>
				</div>*/ ?>
				<span class="date"><?php echo date('d/m/Y', strtotime($post->post_date)) ?></span>
				<h4><?php echo $post->post_title ?></h4>
			</a>
		</li>
<?php endforeach; endif ?>
	</ul>