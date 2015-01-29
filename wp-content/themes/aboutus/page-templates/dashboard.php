<?php get_header(); ?>

<?php get_template_part( 'inc/dashboard', 'stats'); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<section id="business_profile">
		        <div id="logo-upload">
		            <?= get_the_post_thumbnail($biz->ID,'thumbnail',array('id'=>'logo-image')) ?>
            		<input id="logo-upload-file" type="file" value="Update Logo" name="logo" style="position:absolute;top:0;z-index:2;height:60px;opacity:0"/>
		        </div>

			     <div class="profile_header">
			        <div class="profile_name">
						<h1>The Fold</h1>
						<a href="#" class="view_profile">View profile</a>
					</div>


					<div class="your_apps">
						<h3>Available Apps</h3>
						 <ul class="app_icons">

							<?php
							    $active_icons = array();
							    foreach( $active as $provider ):
							        $sms_post = $provider->get_sms_post();
							        $active_icons[] = $provider->get_sms_post_name();
							            // Loop active SM services
							?>
							            <li class="<?=$sms_post->post_title?> active">
							            <a href="<?=$provider->profileURL?>"><?=$sms_post->post_title?></a> <?php // todo, this is still hitting the api ?>
							            </li>

							        <?php endforeach;?>
							<?php
							foreach( $sms as $sms_post ):
							        if(in_array($sms_post->post_title,$active_icons)) continue;
							            // Loop inactive SM services
							?>
							            <li class="<?=$sms_post->post_title?> notactive">
							                <a href="/auth?s=<?=$sms_post->post_title?>"><?=$sms_post->post_title?></a>
							            </li>

							        <?php endforeach;?>
							    </ul>
			        	<div class="app_info">Click an app to activate</div>
		        	</div><?php // .your_apps ?>
				</div><?php // .profile_header ?>



				<div id="percent_complete">
       			 	<strong><?=$percent_complete?>%</strong>
    			</div>

				<div class="overview_stats ajax-load" data-url="/overview-stats">
					 <?// ajax loads views/overview_stats.php ?>
				</div>

			</section><!-- #business_profile -->

			</div><!-- #content -->
		</div><!-- #primary -->
	</div><!-- #main -->
</div><!-- #page -->

<div id="offers_main">
	<section id="apps_offers">
	    <div id='social_engagement'>
	        <h2>Social Engagement</h2>



	        <div class="tab-content">
	            <?php foreach( $active as $provider ): $sms_post = $provider->get_sms_post();
	            (isset($first)) ? $first= '' : $first = 'active';
	            ?>
	            <div class="tab-pane <?=$first?>" id="stats_<?=$sms_post->post_title?>">

	                <div class="stats ajax-load" data-url="/provider-stats?provider=<?=$sms_post->post_title?>">
	                    <p>Ajax here ? </p>
	                    <?// ajax here ?>
	                </div>

	                <?php /* if($tut = TheFold\AboutUs\get_tutorial($social_media,'setup') ):?>
	                    <a href="<?=get_permalink($tut->ID)?>">Setup Help</a><br/>
	                <?php endif; */ ?>

	            </div><!-- .tab-pane -->
	            <?php endforeach; $first = null;?>

	        </div><!-- .tab-content -->

	        <ul class="nav nav-tabs">
        		<?php foreach( $active as $provider ): $sms_post = $provider->get_sms_post(); ?>
           		 <li id="stats_tab_<?=$sms_post->post_title?>">
	                <a href="#stats_<?=$sms_post->post_title?>" data-toggle="tab"><?=$sms_post->post_title?></a>
	            </li>
		        <?php endforeach;?>
	        </ul>

	    </div>

	    <div id="offers">
	        <h2>Business Applications</h2>

	        <div class="tab-content">
	        <?php foreach( $offers as $offer ):
	            (isset($first)) ? $first= '' : $first = 'active';
	            ?>
	            <div class="tab-pane <?=$first?>" id="offer-<?=$offer->post_title?>">
	            <?= get_the_post_thumbnail($offer->ID, 'medium') ;?>
	            <?= $offer->post_content ?>
	            </div>
	        <?php endforeach; ?>
	        </div>

	    	<ul class="nav nav-tabs">
      		  <?php foreach( $offers as $offer ):?>
           		 <li><a href="#offer-<?=$offer->post_title?>" data-toggle="tab"><?=$offer->post_title?></a></li>
       			 <?php endforeach;?>
        	</ul>

	    </div>
	</section><!-- #business_profile -->
</div><!-- #offers_main -->

<div id="lower_content">
	<section id="latest_activity">
		<h2>Latest Activity</h2>
		<ul>
			<li>
				<a href="#" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/images/activitylogo.png"></a>
				<div class="published">3 hours ago <div class="activity_type facebook_activity">facebook</div></div>
				<p><a href="#">@xero</a> Nullam auctor dolor nec mi hendrerit ut suscipit velit consectetu</p>
			</li>
			<li>
				<a href="#" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/images/activitylogo.png"></a>
				<div class="published">3 hours ago <div class="activity_type facebook_activity">facebook</div></div>
				<p><a href="#">@xero</a> Nullam auctor dolor nec mi hendrerit ut suscipit velit consectetu</p>
			</li>
			<li>
				<a href="#" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/images/activitylogo.png"></a>
				<div class="published">3 hours ago <div class="activity_type twitter_activity">facebook</div></div>
				<p><a href="#">@xero</a> Nullam auctor dolor nec mi hendrerit ut suscipit velit consectetu</p>
			</li>
			<li>
				<a href="#" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/images/activitylogo.png"></a>
				<div class="published">3 hours ago <div class="activity_type facebook_activity">facebook</div></div>
				<p><a href="#">@xero</a> Nullam auctor dolor nec mi hendrerit ut suscipit velit consectetu</p>
			</li>
			<li>
				<a href="#" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/images/activitylogo.png"></a>
				<div class="published">3 hours ago <div class="activity_type twitter_activity">facebook</div></div>
				<p><a href="#">@xero</a> Nullam auctor dolor nec mi hendrerit ut suscipit velit consectetu</p>
			</li>
		</ul>
	</section>

	<section id="news">
		<div id="banner_news"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/banner.png"></a></div>

		<div class="news">
			<h2>About us <span>&ndash; Tips, news &amp; updates <a href="#">view all</a></span></h2>
			<article class="post">
				<a href="#" class="news_thumb"><img src="<?php echo get_template_directory_uri(); ?>/images/news_thumb.png"></a>
				<h3><a href="#">Lorem ipsum dolor sit amet consectetur?</a></h3>
				<p class="post_meta">Published 28.01.13</p>
				<p>Nullam auctor dolor nec mi hendrerit ut suscipit velit consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere egestas sapien sed tristique. Nulla sollicitudin, leo id venenatis viverra, risus diam mollis ipsum, vel rhoncus libero odio a massa. <a href="#">Continue reading&hellip;</a></p>
			</article>

			<article class="post">
				<a href="#" class="news_thumb"><img src="<?php echo get_template_directory_uri(); ?>/images/news_thumb.png"></a>
				<h3><a href="#">Lorem ipsum dolor sit amet consec?</a></h3>
				<p class="post_meta">Published 28.01.13</p>
				<p>Nullam auctor dolor nec mi hendrerit ut suscipit velit consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere egestas sapien sed tristique. Nulla sollicitudin, leo id venenatis viverra, risus diam mollis ipsum, vel rhoncus libero odio a massa. <a href="#">Continue reading&hellip;</a></p>
			</article>

			<article class="post">
				<a href="#" class="news_thumb"><img src="<?php echo get_template_directory_uri(); ?>/images/news_thumb.png"></a>
				<h3><a href="#">Lorem ipsum dolor sit amet consec tetur adipi?</a></h3>
				<p class="post_meta">Published 28.01.13</p>
				<p>Nullam auctor dolor nec mi hendrerit ut suscipit velit consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce posuere egestas sapien sed tristique. Nulla sollicitudin, leo id venenatis viverra, risus diam mollis ipsum, vel rhoncus libero odio a massa. <a href="#">Continue reading&hellip;</a></p>
			</article>
	</section>


</div>

<?php get_template_part( 'inc/partners'); ?>

<?php get_footer(); ?>