<?php
/**
 * Plugin Name: Searching-With-Ajax
 * Plugin URI: aboutus.co.nz
 * Description: Load your websites search results faster
 * Version: 1.0
 * Author: Dylan Peti
 * Author URI: www.example.com
 * License: GPL2
 */

if(isset($_GET['q'])){
$q = intval($_GET['q']);
}
function query_search_results(){
// require_once( ABSPATH . 'wp-load.php' );
global $wpdb;  
//wpdb::get_result() 
// $sql="SELECT * FROM wp_postmeta WHERE meta_key = 'locality' AND meta_value = '".$q."'";
if (is_object($wpdb) && is_a($wpdb, 'wpdb')) {
$sql = "SELECT * FROM wp_postmeta WHERE meta_key='locality'";
$result = $wpdb->get_results($sql);
return $result;
}
}

// var_dump(query_search_results());

?>