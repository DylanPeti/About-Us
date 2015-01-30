<?php
// Docs as to what is in this are here
// http://hybridauth.sourceforge.net/userguide/Profile_Data_User_Activity.html
?>
<?php if($feedOnly !== 'true'): ?>
<?php if($sms->post_name == 'facebook'): ?>
<div class="activity-header-facebook">
	<div style="width: 240px; float: right; padding: 5px 0 0 0;">
	<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode($profileUrl) ?>&amp;width=240&amp;height=35&amp;colorscheme=light&amp;layout=standard&amp;action=like&amp;show_faces=false&amp;send=false&amp;appId=378291748965451" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:240px; height:35px;" allowTransparency="true"></iframe>
	</div>
	<a href="<?php echo $profileUrl ?>" class="btn" target="_blank"><?php echo $biz->post_title ?>'s Facebook Profile</a>
</div>
<?php endif ?>
<h2>Latest Activity</h2>

<?php if($sms->post_name == 'twitter'): ?>
<div class="activity-header-facebook">
	<div style="float: right; width: 240px; height: 20px; padding: 10px 0 0 0;">
		<iframe allowtransparency="true" frameborder="0" scrolling="no"
  src="//platform.twitter.com/widgets/follow_button.html?screen_name=<?php echo str_replace('https://twitter.com/', '', str_replace('http://twitter.com/', '', $profileUrl)) ?>"
  style="width:240px; height:20px;"></iframe>
	</div>
	<a href="<?php echo $profileUrl ?>" class="btn" target="_blank"><?php echo $biz->post_title ?>'s Twitter Profile</a>
</div>
<?php endif ?>
<?php if($sms->post_name == 'linkedin'): ?>
<div class="activity-header-facebook">
	<a href="<?php echo $profileUrl ?>" class="btn" target="_blank"><?php echo $biz->post_title ?>'s LinkedIn Profile</a>
</div>
<?php endif ?>

<ul class="activity_feed">
<?php endif ?>
    <?php if(count($activity)): foreach($activity as $item):?>
       <li>
			<img src="<?php echo $item->user->photoURL?>"  class="thumb"/>
			<div class="item">
				<span class="date"><?php if($item->date): echo TheFold\AboutUs\time_elapsed_string($item->date) . ' ago'; endif ?></span>
				<h3><?php echo $item->user->displayName ?></h3>
                <div class="content">
				    <p><?php echo TheFold\AboutUs\urls_to_hrefs( $item->text ) ?></p>
                </div>
                <div class="published"><!--<?php if($item->date):?><?=TheFold\AboutUs\time_elapsed_string($item->date)?> ago <?php endif;?>--><div class="activity_type <?php strtolower(isset($item->provider)) ?>_activity"><?php isset($item->provider) ?></div></div>
			</div>
		</li>
    <?php endforeach; else: ?>
    <li><p>No current activity</p></li>
    <?php endif ?>
<?php if($feedOnly !== 'true'): ?>
</ul>
<?php endif ?>