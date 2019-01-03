<?php
/**
 * Registers the row shortcode
 */
if ( ! class_exists( 'WPBSSC_Row_Shortcode' ) ) {
    class WPBSSC_Row_Shortcode {
        /**
         * The callback for the row shortcode
         * @author Jim Barnes
         * @since 1.0.0
         * @param array $atts The argument array
         * @param string $content The inner content
         * @return string The returned markup
         */
        public static function callback( $atts=array(), $content='' ) {
            $atts = shortcode_atts( array(
                'class' => false,
                'style' => false
            ), $atts );

            $classes = array( 'row' );

            if ( $atts['class'] ) {
                $items = explode( ' ', $atts['class'] );
                $classes = array_merge( $classes, $items );
            }

            $class_string = implode( ' ', $classes );
            $style_string = $atts['style'] ? ' style="' . $atts['style'] . '"' : '';

            ob_start();
        ?>
            <div class="<?php echo $class_string; ?>"<?php echo $style_string; ?>>
                <?php echo do_shortcode( $content ); ?>
            </div>
        <?php
            return ob_get_clean();
        }
    }
}