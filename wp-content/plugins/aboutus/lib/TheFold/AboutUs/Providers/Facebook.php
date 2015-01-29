<?php
namespace TheFold\AboutUs\Providers;

class Facebook extends Provider {

    function get_count() {

        $stats = $this->get_stats();

        return isset($stats['likes']) ? $stats['likes'] : 0;
    }

    function get_stats() {
        
        $all_stats = $this->adapter->api()->api( '/me' );

        return @array(
            'name' => $all_stats['name'],
            'link' => $all_stats['link'],
            'location' => $all_stats['location']['name'],
            'bio' => $all_stats['bio'],
            'likes' => $all_stats['likes'],
            'quotes' => $all_stats['quotes']);
    }

    /**
     * Override default activity feed - we want to use the page feed only.
     */
    public function getActivityFeed($stream='timeline')
    {
        $biz = \TheFold\AboutUs\get_biz_from_user();
        $page_id = get_post_meta( $biz->ID, 'facebook_page_id', true );
        $response = $this->adapter->api()->api('/' . $page_id . '/feed');
        $activities = array();

        if(count($response['data'])) {
            foreach( $response['data'] as $item ){

                $ua = new \Hybrid_User_Activity();

                $ua->id                 = (isset($item['id']))?$item['id']:"";
                $ua->date               = (isset($item['created_time']))?strtotime($item['created_time']):"";

                if( $item['type'] == "video" ){
                    $ua->text           = (isset($item['link']))?$item['link']:"";
                }

                if( $item['type'] == "link" ){
                    $ua->text           = (isset($item['link']))?$item['link']:"";
                }

                if( $item['type'] == 'status') {
                    if(isset($item['message'])){
                    $ua->text = $item['message'];
                    }
                }

                if( empty( $ua->text ) && isset( $item['story'] ) ){
                    //$ua->text           = (isseproperty_exists($item,'link'))?$item->link:"";
                    $ua->text = $item['story'];
                }

                if( empty( $ua->text ) && isset( $item['message'] ) ){
                    //$ua->text           = (property_exists($item,'message'))?$item->message:"";
                    $ua->text = $item['message'];
                }

                if( ! empty( $ua->text ) ){
                    $ua->user->identifier   = (isset($item['from']['id'])) ? $item['from']['id'] : "";
                    $ua->user->displayName  = (isset($item['from']['name']))? $item['from']['name'] : "";
                    $ua->user->profileURL   = "https://www.facebook.com/profile.php?id=" . $ua->user->identifier;
                    $ua->user->photoURL     = "https://graph.facebook.com/" . $ua->user->identifier . "/picture?type=square";

                    $ua->provider = static::get_sms_post_name();
                    $activities[] = $ua;
                }
                
            }
        }

        return $activities;
    }

    static function get_public_activity($sms_id, $token, $user_id, $biz = false)
    {

        //TODO cache this ? 
        $page_id = get_post_meta( $biz->ID, 'facebook_page_id', true );
        $result = file_get_contents("https://graph.facebook.com/$page_id/feed?limit=25&access_token=".$token);
		
        $response = $this->adapter->api()->api('/' . $page_id . '/feed?limit=25');
        $activities = array();

        //$response= json_decode($result);

        $activities = array();

        if(count($response['data'])) {
            foreach( $response['data'] as $item ){

                $ua = new \Hybrid_User_Activity();

                $ua->id                 = (isset($item['id']))?$item['id']:"";
                $ua->date               = (isset($item['created_time']))?strtotime($item['created_time']):"";

                if( $item['type'] == "video" ){
                    $ua->text           = (isset($item['link']))?$item['link']:"";
                }

                if( $item['type'] == "link" ){
                    $ua->text           = (isset($item['link']))?$item['link']:"";
                }

                if( $item['type'] == 'status') {
                    $ua->text           = $item['message'];
                }

                if( empty( $ua->text ) && isset( $item['story'] ) ){
                    //$ua->text           = (isseproperty_exists($item,'link'))?$item->link:"";
                    $ua->text = $item['story'];
                }

                if( empty( $ua->text ) && isset( $item['message'] ) ){
                    //$ua->text           = (property_exists($item,'message'))?$item->message:"";
                    $ua->text = $item['message'];
                }

                if( ! empty( $ua->text ) ){
                    $ua->user->identifier   = (isset($item['from']['id'])) ? $item['from']['id'] : "";
                    $ua->user->displayName  = (isset($item['from']['name']))? $item['from']['name'] : "";
                    $ua->user->profileURL   = "https://www.facebook.com/profile.php?id=" . $ua->user->identifier;
                    $ua->user->photoURL     = "https://graph.facebook.com/" . $ua->user->identifier . "/picture?type=square";

                    $ua->provider = static::get_sms_post_name();
                    $activities[] = $ua;
                }
                
            }
        }

        return $activities;
    }

    static function get_public_activity_user($sms_id, $token, $user_id, $biz)
    {
        //TODO cache this ? 
        $page_id = get_post_meta( $biz->ID, 'facebook_page_id', true );
        //$result=file_get_contents("https://graph.facebook.com/$sms_id/posts?limit=25&access_token=".$token);
		$result = file_get_contents("https://graph.facebook.com/$page_id/feed?limit=25&access_token=".$token);
		
        $response= json_decode($result);

        $activities = ARRAY();

        foreach( $response->data as $item ){

            $ua = new \Hybrid_User_Activity();

            $ua->id                 = (property_exists($item,'id'))?$item->id:"";
            $ua->date               = (property_exists($item,'created_time'))?strtotime($item->created_time):"";

            if( $item->type == "video" ){
                $ua->text           = (property_exists($item,'link'))?$item->link:"";
            }

            if( $item->type == "link" ){
                $ua->text           = (property_exists($item,'link'))?$item->link:"";
            }

            if( empty( $ua->text ) && isset( $item->story ) ){
                $ua->text           = (property_exists($item,'link'))?$item->link:"";
            }

            if( empty( $ua->text ) && isset( $item->message ) ){
                $ua->text           = (property_exists($item,'message'))?$item->message:"";
            }

            if( ! empty( $ua->text ) ){
                $ua->user->identifier   = (property_exists($item->from,'id')) ? $item->from->id : "";
                $ua->user->displayName  = (property_exists($item->from,'name'))? $item->from->name : "";
                $ua->user->profileURL   = "https://www.facebook.com/profile.php?id=" . $ua->user->identifier;
                $ua->user->photoURL     = "https://graph.facebook.com/" . $ua->user->identifier . "/picture?type=square";

                $ua->provider = static::get_sms_post_name();
                $activities[] = $ua;
            }
            
        }

        return $activities;
    }

    /**
     * Load the available business pages the user has access to.
     */
    public function getPages()
    {
        $result = $this->adapter->api()->api('/me/accounts');
        return $result['data'];
    }

    /**
     * Get the page the user is has connected.
     */
    public function getConnectedPage()
    {
        $biz = \TheFold\AboutUs\get_biz_from_user();
        $page_id = get_post_meta( $biz->ID, 'facebook_page_id', true );
        return $this->adapter->api()->api('/' . $page_id);
    }

    /**
     * Does the user have a connected Facebook business page?
     */
    public function hasConnectedPage()
    {
    	//MM
        $biz = \TheFold\AboutUs\get_biz_from_user();
        return get_post_meta( $biz->ID, 'facebook_page_id', true );
    }

    /**
    * update user status
    */
    //user status is updated here 
    public function setUserStatus( $status )
    {
        
        $parameters = array();

        if( is_array( $status ) ){
            $parameters = $status;
        }
        else{
            $parameters["message"] = $status; 
        }

        // Look up the business for the current user, so we can grab the Facebook page_id.
        $biz = \TheFold\AboutUs\get_biz_from_user();
        $page_id = get_post_meta( $biz->ID, 'facebook_page_id', true );

        // With the page_id, we need to request the account to pull an access token, 
        // then pass it to the request. This gives us admin permissions to post to the page.
        $account = $this->adapter->api()->api('/me/accounts/' . $page_id);
        $parameters['access_token'] = $account['data']['0']['access_token'];

        try{ 
            $response = $this->adapter->api()->api( "/" . $page_id . "/feed", "post", $parameters );
            return $response;
        }
        catch( FacebookApiException $e ){
            throw new Exception( "Update user status failed! {$this->providerId} returned an error: $e" );
        }
    }

    /**
    * update user status
    */
    public function setProfileUserStatus( $status )
    {
        $parameters = array();

        if( is_array( $status ) ){
            $parameters = $status;
        }
        else{
            $parameters["message"] = $status; 
        }

        try{ 
            $response = $this->adapter->api()->api( "/me/feed", "post", $parameters );
            return true;
        }
        catch( FacebookApiException $e ){
            throw new Exception( "Update user status failed! {$this->providerId} returned an error: $e" );
            return false;
        }
    }

}
