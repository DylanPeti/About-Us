<?php
namespace TheFold\AboutUs\Providers;

class Google extends Provider {

    function get_count() {

        //TODO can't find any stats to use here
        return 0;
    }

    function get_stats()
    {
        //TODO can't find any stats to use here
        //return array();
        //$res = $this->adapter->api()->get('https://www.googleapis.com/youtube/v3/channels?part=contentDetails&mine=true');
        
        //This will get the activity feed
        $res = $this->adapter->api()->get('https://www.googleapis.com/plus/v1/people/me/activities/public');

        //print_r($res);
        return false;
    }
    
    static function get_public_activity($user_id,$token)
    {
        return array();
    }
}
