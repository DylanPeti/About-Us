<?php 
/* Slider template. Requires Slider CPT to be activated */ 
?>

 <section class="slider">
  <div class="flexslider">

<?php if(get_field('add_slides')): ?>
 
    <ul class="slides">
 
    <?php while(has_sub_field('add_slides')): ?>
 
        <li>
         <div class="slider_image"><img src="<?php the_sub_field('upload_image'); ?>" /></div>
         <div class="slider_content"><h3><?php the_sub_field('slide_content'); ?></h3></div>
        </li>
    <?php endwhile; ?>
 
    </ul>
 
<?php endif; ?>


  </div>
</section>
