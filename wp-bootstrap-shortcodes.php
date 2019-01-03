<?php
/**
 * Plugin Name: WP Bootstrap Shortcodes
 * Version: 1.0.0
 * Plugin URI: https://github.com/jmbarne3/wp-bootstrap-shortcodes/
 * Author: Jim Barnes
 * Author URI: https://github.com/jmbarne3/
 * Description: Provides shortcodes for common Bootstrap 4 grid components.
 * Github Plugin URI: jmbarne3/wp-bootstrap-shortcodes
 */
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'WPBSSC__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPBSSC__PLUGIN_URL', plugins_url( basename( dirname( __FILE__ ) ) ) );
define( 'WPBSSC__PLUGIN_FILE', __FILE__ );

include_once 'shortcodes/wpbssc-shortcodes.php';

if ( ! function_exists( 'wpbssc_init' ) ) {
    function wpbssc_init() {
        WPBSSC_Shortcodes::register_shortcodes();
    }

    add_action( 'init', 'wpbssc_init' );
}
