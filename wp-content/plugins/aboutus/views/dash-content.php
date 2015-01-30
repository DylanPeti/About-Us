<div class="dash-content">
  <div class="dash-latest-news-tips">

   <h1>Latest News</h1>
    <div class="dash-news">
     <?php query_posts( 'posts_per_page=4' ); ?>
     <?php  if ( have_posts() ) : while ( have_posts() ) : the_post();?>

     <article id="image" class="dash-news-feed" style="background-image: url('<?php echo thumbnail_in_style(); ?>')">  </article>

     <?php endwhile; endif;  ?>

      <?php wp_reset_query(); ?>
    </div>
    
    <div id="dash-tip-of-the-day">
    <?php $do_not_duplicate = array(); ?>
    <?php $query_tips = new WP_Query( array('post_type' => 'aboutus_tips') ); ?>
    <?php if( $query_tips->have_posts() ) : while ( $query_tips->have_posts() ) : $query_tips->the_post();  ?>
    <?php $do_not_duplicate[] = $post->ID; ?>
      <h1>Tip of the day - <span><?php the_title(); ?></span></h1>
       <div class="dash-tip-image" id="image" style="background-image: url('<?php echo thumbnail_in_style(); ?>')"></div>
      <?php the_content(); ?>

        <?php  endwhile; endif; ?>

        <p id="more-tips">Read More ›</p>
    </div>
  </div>
  
  <div class="dash-tools-tips">
    <div id="dash-advert">
              <a href="http://www.chorus.co.nz">
              <img src="http://aboutus.co.nz/wp-content/uploads/2014/02/cho_502x68_ticker.gif" alt="">
              </a>
    </div>
    <div class="dash-tips-left">
    <h5>Use the internet better</h5>
  
<?php         $query_social  = new wp_query( mini_post('social media 2', $do_not_duplicate, 5) );
             
              if( $query_social->have_posts() ) : while( $query_social->have_posts() ) : $query_social->the_post(); ?>
              <?php $do_not_duplicate[] = $post->ID; ?>
         <div class="dash-social-item">
              <div class="dash-social-image" id="image" style="background-image: url('<?php echo thumbnail_in_style(); ?>')"></div>
              <h6><?php the_title(); ?></h6>
              <p><?php echo trim_the_content(); ?></p>

        </div>

     <?php    endwhile; endif; 
              wp_reset_query();  ?>
               <p id="read-more">Read More ›</p>
     
      </div>
    <div class="dash-tips-right">
       <h5>Tools you need</h5>
  
<?php         $query_social  = new wp_query( mini_post('marketplace', $do_not_duplicate, 5) );
             
              if( $query_social->have_posts() ) : while( $query_social->have_posts() ) : $query_social->the_post(); ?>
         <div class="dash-social-item">
              <div class="dash-social-image" id="image" style="background-image: url('<?php echo thumbnail_in_style(); ?>')"></div>
              <h6><?php the_title(); ?></h6>
              <p><?php echo trim_the_content(); ?></p>

        </div>

     <?php    endwhile; endif; 
              wp_reset_query();  ?>
               <p id="read-more">Read More ›</p>
     
    </div>
      <div id="connect-facebook-page-modal" class="modal hide fade connect-facebook-page-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header modal-header-center">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h2>Connect Facebook Page</h2>
        </div>
        <div class="modal-body modal-body-center">
          Loading...
        </div>
    </div>
      <?php include('footer.php'); ?>
  </div>

</div>
