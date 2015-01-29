<?php 

include $_SERVER['DOCUMENT_ROOT'] . 'core/wp-blog-header.php';

global $post;


$info = $_GET['info'];
$args = array( 'post_type' => 'aboutus_marketplace');
$loop = new WP_Query( $args );

while ( $loop->have_posts() ) : $loop->the_post();
$lower = strtolower($post->post_name);
$lowerTwo = strtolower($info);


$result = get_post( $info, ARRAY_A, '');	


endwhile;


print_r($result['ID']);

