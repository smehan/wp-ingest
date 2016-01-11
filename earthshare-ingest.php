<?php
/**
 * Created by PhpStorm.
 * User: shawnmehan
 * Date: 1/7/16
 * Time: 2:22 PM
 */
/*
Plugin Name: Earthshare Ingest
Plugin URI: http://powersettech.com
Version: 0.1
Description: This is a plugin that ingests a pre-compiled corpus of articles as posts into the earthshare.org WP instance.
Author: smehan
Author URI: http://powersettech.com
License: Proprietary
*/

/*
This program is software owned by powersettech; you can not redistribute it and/or
modify it without the express permission of Power Set.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

Copyright 2015-2016 Power Set Technical Consulting.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

define( 'ES_VERSION', '0.1' );
define( 'ES__MINIMUM_WP_VERSION', '4.0' );
define( 'ES__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'ES__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

register_activation_hook( __FILE__, array( 'earthshare-ingest', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'earthshare-ingest', 'plugin_deactivation' ) );

//require_once( DUMMY__PLUGIN_DIR . 'class.earthshare-ingest.php' );
//require_once( DUMMY__PLUGIN_DIR . 'class.earthshare-ingest.php' );

//add_action( 'init', array( 'dummy', 'init' ) );

if ( is_admin() ) {
    require_once( ES__PLUGIN_DIR . 'class.earthshare-ingest-admin.php' );
    add_action( 'init', array( 'Earthshare_Ingest_Admin', 'init' ) );
}
