
</div>
</div>
</div>
<?php


?>   
<div class="extend-background gray">
<section class="extra-posts center">   
<?php 



$current_cat = ( get_category( get_query_var( 'cat' ) ) ) ? get_category( get_query_var( 'cat' ) ) : null; 
$cities = get_cat_ID( 'cities' );
$industries = get_cat_ID( 'industries' );
$advertising_and_creative = get_cat_ID( 'advertising-and-creative' );
$construction = get_cat_ID( 'construction' );
$farm_hort = get_cat_ID( 'farm-hort' );
$financial = get_cat_ID( 'financial' );
$freelancers = get_cat_ID( 'freelancers' );
$retail = get_cat_ID( 'retail' );
$sales = get_cat_ID( 'sales' );
$tourism = get_cat_ID( 'tourism' );
$trades = get_cat_ID( 'trades' );


echo articlesSmall();
                

 ?>                              
</section>
</div>