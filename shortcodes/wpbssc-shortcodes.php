<?php
/**
 * Handles the registration and includes of all shortcodes
 */
include_once 'wpbssc-container-sc.php';
include_once 'wpbssc-row-sc.php';
include_once 'wpbssc-col-sc.php';
include_once 'wpbssc-button-sc.php';
include_once 'wpbssc-icon-sc.php';

if ( ! class_exists( 'WPBSSC_Shortcodes' ) ) {
    class WPBSSC_Shortcodes {
        public static
            $prefix  = 'WPBSSC',
            $classes = array(
                'container' => 'Container',
                'row'       => 'Row',
                'col'       => 'Col',
                'button'    => 'Button',
                'icon'      => 'Icon'
            );

        /**
         * Registers all the shortcodes
         * @author Jim Barnes
         * @since 1.0.0
         */
        public static function register_shortcodes() {
            $shortcodes = self::get_class_names();

            foreach( $shortcodes as $shortcode=>$class ) {
                add_shortcode( $shortcode, array( $class, 'callback' ) );
            }
        }

        /**
         * Helper function that returns all registered shortcodes.
         * @author Jim Barnes
         * @since 1.0.0
         * @return array
         */
        private static function get_class_names() {
            $prefix = self::$prefix;
            $retval = array();

            foreach( self::$classes as $shortcode=>$class ) {
                $retval[$shortcode] = "{$prefix}_{$class}_Shortcode";
            }

            return $retval;
        }
    }
}
