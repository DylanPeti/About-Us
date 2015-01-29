<?php
namespace TheFold\AboutUs\Providers;

abstract class Provider 
{
    
    protected $adapter;
    protected $profile;

    function __construct(\Hybrid_Provider_Adapter $adapter){
        $this->adapter = $adapter;   
    }

    abstract function get_count();
    abstract function get_stats();
    // static function get_activity_statically($sms_id,$token,$user_id){ return static::get_public_activity($sms_id,$token,$user_id);}

    // abstract static function get_public_acrtivity($sms_id,$token,$user_id);

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function logout()
    {
        return $this->adapter->logout();
    }

    function get_profile()
    {
        if(!$this->profile) { //maybe just cache this ? 

            $this->profile = $this->adapter->getUserProfile();
        }

        return $this->profile;
    }

    function provider_name()
    {
        return $this->adapter->id;
    }

    function get_sms_post()
    {
        return \TheFold\AboutUs\get_sms_by_name($this->get_sms_post_name());
    }

    static function get_sms_post_name()
    {
            return static::denamespace(get_called_class()); 
    }

    function __get($name)
    {
        if(!$value = $this->get_from_meta_cache($name)){
            $value = $this->get_profile()->$name; // this will talk to the api, which is slow
            $this->set_meta_cache($name,$value);
        }

        return $value;
    }

    function __call($name,$params)
    {
        return call_user_func_array(array($this->get_profile(),$name),$params);
    }

    protected function get_from_meta_cache($name)
    {
        $user_id = \get_current_user_id();

        if(\get_user_meta( $user_id ,'hauth-profile-no-cache',true))//maybe pull from somewhere else ? get string ?
        {
            return null;
        }

        return \get_user_meta( $user_id ,$this->get_meta_key($name),true);
    }

    protected function set_meta_cache($name,$value)
    {
        \update_user_meta( \get_current_user_id() ,$this->get_meta_key($name),$value);
    }

    protected function get_meta_key($name)
    {
        return 'hauth-profile-feed-'.$this->adapter->id.'-'.$name;
    }
    
    function getActivityFeed($stream='timeline')
    {
        return $this->adapter->getUserActivity($stream);
    }

    static function denamespace($value)
    {
        $className = trim($value, '\\');
        if ($lastSeparator = strrpos($className, '\\')) {
            $className = substr($className, 1 + $lastSeparator);
        }

        return $className;
    }

}
