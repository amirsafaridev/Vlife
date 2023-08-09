<?php
/*
Plugin Name:Promotion
Description:  USe [all_promotions] to show all promotions in one page and use [page_promotions] to show current page promotions
Version: 1.1
Author: Artacode
Author URI: http://artacode.net
License: A "Slug" license name e.g. GPL2
*/


if ( ! defined( 'arta_vlife_promotion_PLUGIN_DIR' ) ) {
    define( 'arta_vlife_promotion_TRACKING_PLUGIN_FILE', __FILE__ );
    define( 'arta_vlife_promotion_PLUGIN_DIR', untrailingslashit( dirname( arta_vlife_promotion_TRACKING_PLUGIN_FILE ) ) );
}

// Main Function And Hook
require __DIR__ . '/includes/main.php';


