<?php
/**
 * Registers the column shortcode
 */
if ( ! class_exists( 'WPBSSC_Col_Shortcode' ) ) {
    class WPBSSC_Col_Shortcode {

        private static
            $prefixes = array(
                'xs',
                'sm',
                'md',
                'lg',
                'xl'
            ),
            $suffixes = array(
                '',
                '_offset',
                '_pull',
                '_push'
            );

        /**
         * The callback for the column shortcode
         * @author Jim Barnes
         * @since 1.0.0
         * @param array $atts The argument array
         * @param string $content The inner content
         * @return string The returned markup
         */
        public static function callback( $atts=array(), $content='' ) {
            $atts = shortcode_atts( array(
                'class'     => false,
                'style'     => false,
                'xs'        => '',
                'sm'        => '',
                'md'        => '',
                'lg'        => '',
                'xl'        => '',
                'xs_offset' => '',
                'sm_offset' => '',
                'md_offset' => '',
                'lg_offset' => '',
                'xl_offset' => '',
                'xs_push'   => '',
                'sm_push'   => '',
                'md_push'   => '',
                'lg_push'   => '',
                'xl_push'   => '',
                'xs_pull'   => '',
                'sm_pull'   => '',
                'md_pull'   => '',
                'lg_pull'   => '',
                'xl_pull'   => '',
            ), $atts );

            $classes = array();

            if ( $atts['class'] ) {
                $items = explode( ' ', $atts['class'] );
                $classes = array_merge( $classes, $items );
            }

            /**
             * Thanks to @cj89 for this block of code!
             */
            foreach( self::$prefixes as $prefix ) {
                foreach( self::$suffixes as $suffix ) {
                    $field_key = $prefix.$suffix;
                    $field_val = $atts[$field_key];

                    if ( isset( $field_val ) && $field_val !== '' ) {
                        $modifier   = $suffix === '' ? 'col' : str_replace( '_', '', $suffix );
                        $breakpoint = $prefix === 'xs' ? '' : '-' . $prefix;
                        $size       = ( in_array( $field_val, array( '', 'none' ), true ) ) ? '' : '-' . $field_val;

                        $classes[] = $modifier . $breakpoint . $size;
                    }
                }
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