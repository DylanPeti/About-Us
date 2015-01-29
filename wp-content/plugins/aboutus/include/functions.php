<?php
function get_profile_banners() {
    return get_posts(array(
        'post_type' => TYPE_P_BANNER
    ));
}



function get_profile_banner() {
    $banners = get_posts(array(
        'post_type' => TYPE_P_BANNER,
        'posts_per_page' => 1,
        'orderby'=> 'rand'
    ));

    return $banners[0];
}

// function get_sponsor() {
//     $sponsors = get_posts(array(
//         'post_type' => TYPE_SPONSOR,
//         'posts_per_page' => 7,
//         'orderby'=> 'DESC',
//     ));

//     return $sponsors;
// }

function get_marketplace() {
    $marketplace = get_posts(array(
        'post_type' => TYPE_MARKETPLACE,
        'orderby'=> 'DESC',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments' ),
    ));
 return $marketplace;
}


function get_citie() {
   $citie = get_posts(array(
        'post_type' => TYPE_CITIE,
        'orderby'=> 'DESC',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments' ),
    ));
 return $citie;
}


function directory_images() {
    
    echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
        echo '<h2>Directory Images</h2>';
    echo '</div>';

}

function register_my_custom_submenu_page() {
add_submenu_page('edit.php?post_type=aboutus_citie','Images', 'Images', 'manage_options', 'Images', 'directory_images');
}

add_action('admin_menu', 'register_my_custom_submenu_page');



