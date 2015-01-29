<?php
//Docs as to what is in this are here
// http://hybridauth.sourceforge.net/userguide/Profile_Data_User_Activity.html
?>
<?php if(!count($activity)): ?>
    <div class="latest-activity-tips">
        <p><strong>Your recent social activity will appear here after you have linked your accounts!</strong></p>
        <p>You can do this using the 'Connect' panel above.</p>
    </div>
<?php else: foreach($activity as $item): ?>
       <li class="<?php echo strtolower($item->provider) ?>">
			<img src="<?php echo $item->user->photoURL ?>" alt="" class="thumb" />
            <div class="item">
                <span class="date"><?php if($item->date): echo TheFold\AboutUs\time_elapsed_string($item->date) . ' ago'; endif ?></span>
                <h3><?php echo $item->user->displayName ?></h3>
                <div class="content">
				    <p><?php echo TheFold\AboutUs\urls_to_hrefs( $item->text ) ?></p>
                </div>
			</div>
		</li>
<?php endforeach; endif ?>