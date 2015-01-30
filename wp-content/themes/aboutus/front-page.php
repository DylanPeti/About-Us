<?php
global $post;
 if (!is_user_logged_in()){ 
get_header();





require 'inc/onboard-intro.php'; 
require 'inc/welcome.php'; 

$ismobile = check_user_agent('mobile');
if(!$ismobile || is_user_logged_in()) {
require 'inc/left-section.php'; 

}

 get_footer(); 

} else {
wp_redirect("http://$_SERVER[HTTP_HOST]/dash");
exit;

}






















