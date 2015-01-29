<?php
namespace TheFold\AboutUs\Providers;

class LinkedIn extends Provider {

    const META_KEY = 'linkedin-profile';

    function get_count() {
    	$s = json_decode($this->init_profile(), true);
        return $s['num-connections'];
    }

    function get_stats() {
        return $this->format_profile($this->init_profile());

    }

    static function format_profile($profile)
    {
    	$profile = json_decode($profile, true);

        $return['Name'] = $profile['first-name'].' '.$profile['last-name'];
        $return['Industry'] = $profile['industry'];
		
		/*if(count($profile->threeCurrentPositions->values)) {
            foreach($profile->threeCurrentPositions->values as $current) {
                $return['Current'][] = $current->title.' at '. $current->company->name;
            }
        }

        if(count($profile->threePastPositions->values)) {
            foreach($profile->threePastPositions->values as $position){
                $return['Past Experience'][] = $position->title.' at '.$position->company->name;
            }
        }

        if(count($profile->educations->values)) {
            foreach($profile->educations->values as $education)
                $return['Education'][] = $education->schoolName;
        }*/

        return $return;
    }

    static function get_public_activity($sms_id,$token,$user_id, $biz = false)
    {
     	
        if($profile = get_user_meta( $user_id, self::META_KEY, true )){

            return static::format_profile($profile);
        }
    }

    protected function init_profile()
    {
    	
    	if($profile = get_user_meta( get_current_user_id(), self::META_KEY, true ))
        {
          //  http://api.linkedin.com/v1/people/~/:(first-name,last-name,relation-to-viewer:(distance,related-connections:(distance)),num-connections,num-connections-capped,num-recommenders,three-current-positions:(title,company:(name)),three-past-positions:(title,company:(name)),educations:(degree,school-name),skills:(skill:(name),proficiency:(name)))
//faulty line..
          // $res = $this->adapter->api()->profile('~:(id, first-name,last-name,num-connections,industry,three-current-positions:(title,company:(name)),three-past-positions:(title,company:(name)),educations:(degree,school-name))') ;

             $res = $this->adapter->api()->profile('~:(first-name,last-name,num-connections)') ;
			//die(var_dump($res));
			//$profile = \xml2json::transformXmlStringToJson($res['linkedin']);
            //$profile = \json_decode( $res['linkedin'] );
			$resso = str_replace(array("\n", "\r", "\t"), '', $res['linkedin']);
			$ress = trim(str_replace('"', "'", $resso));
			@$sXml = simplexml_load_string($ress);
			$profile = json_encode($sXml);
			//die(var_dump($profile));
			
         //   update_user_meta( get_current_user_id(), self::META_KEY, $profile );
        }
      
        return $profile;
    }

    /**
    * update user status
    */
    function setUserStatus( $status )
    {
        $parameters = array();
        $private    = true; // share with your connections only


        if( is_array( $status ) ){
            if( isset( $status[0] ) && ! empty( $status[0] ) ) $parameters["title"]               = $status[0]; // post title
            if( isset( $status[1] ) && ! empty( $status[1] ) ) $parameters["comment"]             = $status[1]; // post comment
            if( isset( $status[2] ) && ! empty( $status[2] ) ) $parameters["submitted-url"]       = $status[2]; // post url
            if( isset( $status[3] ) && ! empty( $status[3] ) ) $parameters["submitted-image-url"] = $status[3]; // post picture url
            if( isset( $status[4] ) && ! empty( $status[4] ) ) $private                           = $status[4]; // true or false
        }
        else{
            $parameters["comment"] = "hello";
        }

      /*  try{
            $response  = $this->api()->api->share( 'new', $parameters, $private );
        }
        catch( LinkedInException $e ){
            throw new Exception( "Update user status update failed!  {$this->providerId} returned an error: $e" );
            return false;
        }
/*
        if ( ! $response || ! $response['success'] )
        {
            throw new Exception( "Update user status update failed! {$this->providerId} returned an error." );
            return false;
        }

        return true;*/
        var_dump($parameters["comment"]);
    }

}
