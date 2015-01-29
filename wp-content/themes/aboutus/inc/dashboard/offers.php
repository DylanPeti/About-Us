<?php /*
// Calculate the selected offer. Should be the second for visual reasons,
// but we will select the first if there is only one.
$activeOffer = 1;

// Filter offers by regions
$region = end(get_post_meta($biz->ID, 'region'));

if($region) {
  $tempOffers = $offers;
  $offers = array();
  if(count($tempOffers)) {
    foreach($tempOffers as $o) {
      $regions = get_field('target_regions', $o->ID);
      if(is_array($regions)) {
        if(in_array($region, $regions)) {
          $offers[] = $o;
        }
      } else {
        $offers[] = $o;
      }
    }
  }
}

if(count($offers) === 1) $activeOffer = 0;
*/ ?>
<?php /*
    <div class="section dashboard-offers">
      <div class="container">
        <!--<h2>From The Cloudstore</h2>-->
        <ul id="offers-slider-buttons" class="buttons">
          <li class="pull-right"><a class="btn" href="http://thecloudsto.re">VIEW ALL APPS</a></li>
<?php if(count($offers)): foreach( $offers as $count => $offer ): ?>
          <li<?php echo($count === $activeOffer)?' class="active"':'' ?>><a href="javascript:;" class="btn slide-trigger" data-id="<?php echo $offer->post_name ?>"><?php echo the_field('display_title', $offer->ID) ?></a></li>
<?php endforeach; endif; ?>
        </ul>
      </div>
      <div id="offers-slider" class="offers-slider">
        <ul id="offers-slider-content" class="offers-slider-content" style="width: <?php echo 624 * count($offers) ?>px; margin-left: -624px;">
<?php if(count($offers)): foreach( $offers as $count => $offer ): ?>
          <li data-id="<?php echo $offer->post_name ?>"<?php echo($count === $activeOffer)?' class="active"':'' ?> data-title="<?php echo strip_tags($offer->post_content) ?>" data-url="<?php echo strip_tags($offer->offer_url) ?>">
            <a href="<?php echo $offer->offer_url ?>"><?php echo get_the_post_thumbnail($offer->ID) ?></a>
          </li>
<?php endforeach; endif ?>
        </ul>
      </div>
      <div class="container">
        <div id="offers-slider-info" class="offers-slider-info">
          <a class="btn pull-right" href="<?php if(count($offers)): echo $offers[$activeOffer]->offer_url; else: echo 'javascript:;'; endif ?>" target="_blank">Find out more</a>
          <h3><?php if(count($offers)): echo $offers[$activeOffer]->post_content; endif ?></h3>
        </div>
      </div>
    </div>
*/ ?>