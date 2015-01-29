<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------


return
	array(
		"base_url" => 'http://'.$_SERVER['SERVER_NAME'].'/hybridauth/',
		// "base_url" => 'http://localhost/hybridauth/',


		"providers" => array (
			// openid providers
			"OpenID" => array (
				"enabled" => true
			),
						/*
			"Yahoo" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" ),
			),

			"AOL"  => array (
				"enabled" => true
			),

						 */
			"Google" => array (
				"enabled" => true,
					"keys"    => array (
						"id" => "83453985626.apps.googleusercontent.com",
						"secret" => "z1P7JlwUxT2KEHchy6uFe4-p"
					),
					"scope"  => "https://www.googleapis.com/auth/youtube ".
								"https://www.googleapis.com/auth/plus.me ".
								"https://www.googleapis.com/auth/userinfo.profile ".
								"https://www.googleapis.com/auth/userinfo.email ".
								"https://www.googleapis.com/auth/yt-analytics.readonly".
								"https://www.googleapis.com/auth/analytics.readonly",
					"access_type" => "online"
				),

			"Facebook" => array (
				"enabled" => true,
				"keys"    => array (
					// "id" => "1411478155751945",
					// "secret" => "4fe65a606d88129c68ff7ad2e70c0524"
					   "id" => "1537167169848949",
					   "secret" => "1caa0ab94f909d76e11652ffdcfa4529"
				),
				"scope" => "email, user_about_me, user_birthday, user_hometown, user_website, read_stream, offline_access, publish_stream, read_friendlists, manage_pages",
				
			),

			"Twitter" => array (
				"enabled" => true,
				//"authorize"  => true,
				"keys"    => array (
					"key" => "xrqYaPrt2H8KusAYXA7NwYNeu",
					"secret" => "yk1Q2yoktRDRQAIXvBNajQIck67uzqghwCYtMJ70VRIGwkFPIy"
				)
			),

			"LinkedIn" => array (
				"enabled" => true,
				"keys"    => array (
					"key" => "75x5gxw86sxvbx",
					"secret" => "nGODZGaz8PDgPvZ1"
				)
			),
			// windows live
			/*"Live" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" )
			),

			"MySpace" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "", "secret" => "" )
			),



			"Foursquare" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "", "secret" => "" )
							),*/
		),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => false,

		"debug_file" => __DIR__."/auth.log",
	);
