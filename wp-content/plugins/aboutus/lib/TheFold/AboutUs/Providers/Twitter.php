<?php
namespace TheFold\AboutUs\Providers;
class Twitter extends Provider {

    function get_count() {

        if($response = $this->get_stats())
        {	
			//print_r($response->ids);
            //updated (23/09/2013) by Mark Mikloska - de-construct
			//this is also limited to 5000 per request, needs to be fixed
			return sizeof($response->ids);
        }

        return 0;
    }

    function get_stats() {

		//depriciated functionality
        //return $this->adapter->api()->get( 'account/totals.json' );
        //updated (23/09/2013) by Mark Mikloska - de-construct
        return $this->adapter->api()->get( 'followers/ids.json' );
		//https://api.twitter.com/1.1/followers/ids.json
    }

    /**
     *
     */
    static function get_public_activity($sms_id,$token,$user_id, $biz = false)
    {

        require_once('Twitter/TwitterAPIExchange.php');

        // $settings = array(
        //     'oauth_access_token' => "1526984312-Td67zp5HDzc27EY7VVWsqeCx8NrA22PwIsGGOaJ",
        //     'oauth_access_token_secret' => "BU6npDbVwtGp3caPZJAMda1wtKrxf02KSkURaiWHsUM",
        //     'consumer_key' => "vZViGdar3qgdGtrCt52Isw",
        //     'consumer_secret' => "kEjfqRoqX7apkQrUY7HkBI6SJl9l3o4a1p55u8Nn2I0"
        // );
				
        $settings = array(
            'oauth_access_token' => "328889741-HcC9nbYVUpkao5eI1NvucAgLYRnjR9QxkKQTRmPn",
            'oauth_access_token_secret' => "0CySVXKO59XwrukpyAviG7Ez13hvs6TWhdHxPittL7Hdk",
            'consumer_key' => "xrqYaPrt2H8KusAYXA7NwYNeu",
            'consumer_secret' => "yk1Q2yoktRDRQAIXvBNajQIck67uzqghwCYtMJ70VRIGwkFPIy"
        );
        
                
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?include_entities=true&include_rts=true&user_id=' . $sms_id . '&count=10';
		$requestMethod = 'GET';

        $twitter = new \TwitterAPIExchange($settings);
        $response = $twitter->setGetfield($getfield)
                            ->buildOauth($url, $requestMethod)
                            ->performRequest();



        $results = array();

        if($response) {
            $json = json_decode($response, true);
            /*if(isset($json['statuses'])) {
                $results = $json['statuses'];
            }*/
				
				/*$a1 = json_decode( $json1, true );
				$a2 = json_decode( $json2, true );
				$res = array_merge_recursive( $a1, $a2 );
				$resJson = json_encode( $res );	
				*/
            $results = $json;
        }

        /**
         * I pulled this code from
         * wp-content/plugins/aboutus/lib/Hybrid/Providers/Twitter.php"
         */
        foreach( $results as $item ){
            $ua = new \Hybrid_User_Activity();

            $ua->id                 = (array_key_exists('id', $item))?$item['id']:"";
            $ua->date               = (array_key_exists('created_at', $item))?strtotime($item['created_at']):"";
            $ua->text               = (array_key_exists('text', $item))?$item['text']:"";

            $ua->user->identifier   = (array_key_exists('id', $item['user']))?$item['user']['id']:"";
            $ua->user->displayName  = (array_key_exists('name', $item['user']))?$item['user']['name']:"";
            $ua->user->profileURL   = (array_key_exists('screen_name', $item['user']))?("http://twitter.com/".$item['user']['screen_name']):"";
            $ua->user->photoURL     = (array_key_exists('profile_image_url', $item['user']))?$item['user']['profile_image_url']:"";

            $activities[] = $ua;
        }

        return $activities;
    }

    /**
    * update user status
    */
    function setUserStatus( $status )
    {
        $parameters = array( 'status' => $status );
        $response  = $this->adapter->api()->post( 'statuses/update.json', $parameters );

        // check the last HTTP status code returned
        if ( $this->adapter->api()->http_code != 200 ){
            //echo "Update user status failed! {$this->providerId} returned an error. " . $this->errorMessageByStatus( $this->api->http_code );
            return false;
            //throw new Exception( "Update user status failed! {$this->providerId} returned an error. " . $this->errorMessageByStatus( $this->api->http_code ) );
        }

        return true;
    }
}
