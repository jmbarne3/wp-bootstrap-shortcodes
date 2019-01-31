<?php
/**
 * Registers the icon shortcode
 */
if ( ! class_exists( 'WPBSSC_Icon_Shortcode' ) ) {
    class WPBSSC_Icon_Shortcode {
        /**
         * The callback for the icon shortcode
         * @author Jim Barnes
         * @since 1.0.0
         * @param array $atts The argument array
         * @param string $content The inner content
         * @return string The returned markup
         */
        public static function callback( $atts, $content='' ) {
            $allowed_elements = array(
                'i',
                'span'
            );

            $atts = shortcode_atts( array(
                'icon'    => false,
                'element' => 'span',
                'color'   => false,
                'class'   => false
            ), $atts );

            $icon = $atts['icon'];
            $element = in_array( $atts['element'], $allowed_elements ) ? $atts['element'] : 'span';
            $color = $atts['color'];
            $class = $atts['class'];

            if ( ! $icon ) return '';

            $classes = array(
                'fa',
                'fa-' . $icon
            );

            if ( $color ) {
                $classes[] = 'text-' . $color;
            }

            if ( $class ) {
                $extra = explode( ' ', $class );
                $classes = array_merge( $classes, $extra );
            }

            $classes = implode( ' ', $classes );

            ob_start();
        ?>
            <<?php echo $element; ?> class="<?php echo $classes; ?>"></<?php echo $element; ?>>
        <?php
            return ob_get_clean();
        }
    }
}