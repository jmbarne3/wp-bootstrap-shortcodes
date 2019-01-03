<?php
/**
 * Registers the container shortcode
 */
if ( ! class_exists( 'WPBSSC_Container_Shortcode' ) ) {
    class WPBSSC_Container_Shortcode {
        /**
         * The callback for the container shortcode
         * @author Jim Barnes
         * @since 1.0.0
         * @param array $atts The argument array
         * @param string $content The inner content
         * @return string The returned markup
         */
        public static function callback( $atts=array(), $content='' ) {
            $atts = shortcode_atts( array(
                'class' => false,
                'fluid' => false,
                'style' => false
            ), $atts );

            $fluid = filter_var( $atts['fluid'], FILTER_VALIDATE_BOOLEAN );

            $classes = $fluid ? array( 'container-fluid' ) : array( 'container' );

            if ($atts['class'] ) {
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