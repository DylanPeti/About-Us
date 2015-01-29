<?php 
/* Benefits template. 3 blue dots with text in them */ 
?>

<section id="benefits">
  <h2><?php the_field('benefits_section_title'); ?></h2>
  <p class="intro"><?php the_field('benefits_intro'); ?></p>
  
    <?php if(get_field('benefits_section_title')): ?>
    <ul>
   
    <?php while(has_sub_field('add_benefits')): ?>
   
      <li>
        <h3><?php the_sub_field('benefit_title'); ?></h3>
        <p><?php the_sub_field('benefit_content'); ?></p>
      </li>
   
    <?php endwhile; ?>
   
    </ul>
  <?php endif; ?>


</section>
<!-- START Nielsen Online SiteCensus V6.0 -->
<!-- COPYRIGHT 2012 Nielsen Online -->
<script type="text/javascript" src="//secure-nz.imrworldwide.com/v60.js">
</script>
<script type="text/javascript">
 var pvar = { cid: "nz-adhub", content: "0", server: "secure-nz" };
 var trac = nol_t(pvar);
 trac.record().post();
</script>
<noscript>
 <div>
 <img src="//secure-nz.imrworldwide.com/cgi-bin/m?ci=nz-adhub&amp;cg=0&amp;cc=1&amp;ts=noscript"
 width="1" height="1" alt="" />
 </div>
</noscript>
<!-- END Nielsen Online SiteCensus V6.0 -->