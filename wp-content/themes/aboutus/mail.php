<?php
/**
 * The template for displaying mail documents.
 *
 * 
 *
 * @package WordPress
 * @subpackage Twenty_fourteen
 * @since Twenty Fourteen 1.0
 */

include '/users/home/websites/aboutus/core/wp-blog-header.php';
$var = "fefe";
$user = \wp_get_current_user();
$the_user = $user->user_login;
$subjectPara1 = "Looks like you're ready to start listing your business with About Us";
$subjectPara2 = "Begin by taking a look at your dashboard and connecting your social accounts";
$imgSrc = 'http://dev.aboutus.co.nz/wp-content/uploads/2014/07/logos-complete.png';
$subjectPara3 = "Your dashboard";
$subjectPara3a = "Latest news";
$subjectPara3b = "Profile";
$html = '<!DOCTYPE HTML>'. 
'<head>'. 
'<meta http-equiv="content-type" content="text/html">'. 
'<title>Email notification</title>'. 
'</head>'. 
'<body>'. 
'<div id="header" style="width: 80%;height: 40px;margin: 0 auto;padding: 10px;color: #fff;text-align: center; font-family: Open Sans,Arial,sans-serif;">'.                                                              
 '<div style="border-width:0; float: left; width: 170px; height: 50px; background: url(' .$imgSrc. ') no-repeat; background-size:contain; " alt="'.$imgDesc.'" title="'.$imgTitle.'">'. 
'</div>'.'</div>'.
 

'<div id="outer" style="width: 80%;margin-left: 8px; margin-top: 10px;">'.  
   '<div id="inner" style="width: 78%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px;">'. 
       '<p>'.$subjectPara1.'</p>'. 
       '<p>'.$subjectPara2.'</p>'. 
       '<p><a href="http://dev.aboutus.co.nz/dash" style="text-decoration:none;" target="_blank">'.$subjectPara3 . '</a></p>' . '<p><a href="http://dev.aboutus.co.nz" style="text-decoration:none;>' . $subjectPara3a . '</a></p>' . '<p><a href="http://dev.aboutus.co.nz/about/" style="text-decoration:none;>' . $subjectPara3b .'</a></p>'. 
       '<p>'.$subjectPara4.'</p>'. 
       '<p>'.$subjectPara5.'</p>'. 
   '</div>'.   
'</div>'. 

'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena;background-color: #E2E2E2;">'. 

'</div>'. 
'</body>'; 

echo $html;
