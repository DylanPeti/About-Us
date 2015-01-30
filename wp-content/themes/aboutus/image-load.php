<?php 
include '/Users/Dylan/Applications/aboutus/core/wp-blog-header.php';
global $post;

$q = $_GET['q'];

$args = array( 'post_type' => 'aboutus_citie');
$loop = new WP_Query( $args );

while ( $loop->have_posts() ) : $loop->the_post();
$lower = strtolower($post->post_name);
$lowerTwo = strtolower($q);

	$yes = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

endwhile;
echo $yes;
