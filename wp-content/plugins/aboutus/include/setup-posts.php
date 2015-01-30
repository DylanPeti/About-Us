<?php
use TheFold\WordPress as WordPress;
use TheFold\Cache as Cache;

// Custom Post Types
const TYPE_BUSINESS = 'aboutus_business';
const TYPE_SMS      = 'aboutus_sms';
const TYPE_TUTORIAL = 'aboutus_tutorial';
const TYPE_OFFER    = 'aboutus_offer';
const TYPE_CITIE    = 'aboutus_citie';
const TYPE_ADVERTS   = 'aboutus_adverts';
const TYPE_P_BANNER = 'aboutus_p_banner';
const TYPE_MARKETPLACE = 'aboutus_marketplace';
//const TYPE_OFFERS = 'aboutus_business';

const COMPLETE_STEP_ADDRESS = 'step_address_updated';
const COMPLETE_STEP_SMS     = 'step_sms_set';
const COMPLETE_LOGO_UPDATE  = 'step_logo_updated';

new WordPress\CustomPostType( TYPE_BUSINESS, 'Business', array(
    'plural'=>'Businesses',
    'slug' => 'about' ));

new WordPress\CustomPostType( TYPE_SMS, 'Social Media Service', array(
    'slug'=>'service'
    ));
new wordpress\CustomPostType( TYPE_CITIE, 'Town Directory');
// new WordPress\CustomPostType( TYPE_TUTORIAL, 'Tutorial' );
new WordPress\CustomPostType( TYPE_OFFER, 'Advert' );
new WordPress\CustomPostType( TYPE_MARKETPLACE, 'Offers' );
new WordPress\CustomPostType( TYPE_ADVERTS, 'Advert rotator' );
// new WordPress\CustomPostType( TYPE_P_BANNER, 'Profile Banner' );

\add_image_size( 'biz_avatar', 20, 20, true );

\add_action( 'p2p_init', function(){

    \p2p_register_connection_type( array(
        'name' => 'sms_to_tutorial',
        'from' => TYPE_SMS,
        'to' => TYPE_TUTORIAL,
        'admin_box' => array(
            'show' => 'any',
            'context' => 'advanced'
        ),
        'fields' => array(
            'type' => array(
                'title' => 'Type',
                'type' => 'select',
                'values' => array( 'setup', 'basic', 'advanced' )
            ),
        ),
        'sortable' => 'any'
    ));

    \p2p_register_connection_type( array(
        'name' => 'sms_to_biz',
        'from' => TYPE_SMS,
        'to' => TYPE_BUSINESS,
        'admin_box' => array(
            'show' => 'any',
            'context' => 'advanced'
        ),
        'fields' => array(
            'profileURL' => array(
                'title' => 'Profile URL',
                'type' => 'text',
            ),
            'identifier' => array(
                'title' => 'Identifier',
                'type' => 'text',
            ),
            'token' => array(
                'title' => 'Oauth Token',
                'type' => 'text',
            ),
        ),
        'sortable' => 'any'
    ));

    \p2p_register_connection_type( array(
        'name' => 'biz_to_user',
        'from' => TYPE_BUSINESS,
        'to' => 'user',
        'admin_box' => array(
            'show' => 'any',
            'context' => 'advanced'
        ),
        'fields' => array(
            'created' => array(
                'title' => 'Setup Date',
                'type' => 'text',
            ),
        ),
        'sortable' => 'any'
    ));

    \p2p_register_connection_type( array(
        'name' => 'biz_to_offer',
        'from' => TYPE_BUSINESS,
        'to' => TYPE_OFFER,
        'admin_box' => array(
            'show' => 'any',
            'context' => 'advanced'
        ),
        'sortable' => 'any'
    ));
});


\add_action('init',function(){
    if ( is_user_logged_in() && is_front_page() ) {
        wp_redirect( site_url( 'dash' ) );
        exit;
    }
});





