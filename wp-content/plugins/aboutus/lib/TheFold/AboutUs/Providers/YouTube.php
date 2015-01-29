<?php
namespace TheFold\AboutUs\Providers;

class YouTube extends Provider{

    function get_count()
    {
        return 10;
    }

    function get_stats()
    {
        //$res = $this->adapter->api()->get('https://www.googleapis.com/youtube/v3/activities?part=snippet&mine=true');
        $res = $this->adapter->api()->get('http://gdata.youtube.com/feeds/api/users/timemmafield');
        
        //$res = $this->adapter->api()->get('https://www.googleapis.com/plus/v1/people/me/activities/public');
        //

        $res = $this->adapter->api()->get('https://www.googleapis.com/youtube/v3/channels?part=contentDetails&mine=true');

        print_r($res);

        //this should probably be saved against the user 
        $uploads_channel = $res->items[0]->contentDetails->relatedPlaylists->uploads;
        $likes_channel = $res->items[0]->contentDetails->relatedPlaylists->likes;

        echo $uploads_channel;
        
        echo 'Uploads';
        $res = $this->adapter->api()->get('https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId='.$uploads_channel);

        // get video from each here, you could then sum statistics->viewcount 
        //
        //now another freaken one to get the likes for this video

        print_r($res);

        echo 'Likes';
        $res = $this->adapter->api()->get('https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId='.$likes_channel);

        print_r($res);
        exit();

    }

    static function get_public_activity($user_id, $token)
    {
        return array();
    }
}
