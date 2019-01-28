<?php
/**
 * Registers the button shortcode
 */
if ( ! class_exists( 'WPBSSC_Button_Shortcode' ) ) {
    class WPBSSC_Button_Shortcode {
        private static
            $colors = array(
                'primary',
                'secondary',
                'success',
                'danger',
                'warning',
                'info',
                'light',
                'dark'
            ),
            $sizes = array(
                'sm',
                'md',
                'lg'
            );

        /**
         * The callback for the button shortcode
         * @author Jim Barnes
         * @since 1.0.0
         * @param array $atts The argument array
         * @param string $content The inner content
         * @return string The returned markup
         */
        public static function callback( $atts=array(), $content='' ) {
            $atts = shortcode_atts( array(
                'href'        => '#',
                'new_window'  => false,
                'rel'         => false,
                'class'       => false,
                'id'          => false,
                'style'       => false,
                'data_toggle' => false,
                'color'       => 'primary',
                'outline'     => false,
                'block'       => false,
                'size'        => false
            ), $atts );

            $colors = apply_filters( 'wpbssc_btn_colors', self::$colors );
            $sizes  = apply_filters( 'wpbssc_btn_sizes', self::$sizes );

            $outline = filter_var( $atts['outline'], FILTER_VALIDATE_BOOLEAN );
            $block   = filter_var( $atts['block'], FILTER_VALIDATE_BOOLEAN );

            $classes = array( 'btn' );

            if ($atts['class'] ) {
                $items = explode( ' ', $atts['class'] );
                $classes = array_merge( $classes, $items );
            }

            $btn_class = 'btn-';

            if ( $outline ) {
                $btn_class .= 'outline-';
            }

            // Add color class
            if ( in_array( $atts['color'], $colors ) ) {
                $btn_class .= $atts['color'];
            } else {
                $btn_class .= 'primary';
            }

            // Add block class
            if ( $block ) {
                $classes[] = 'btn-block';
            }

            // Add color size
            if ( $size && in_array( $atts['size'], $sizes ) ) {
                if ( $atts['size'] !== 'md' ) {
                    $classes[] = 'btn-' . $atts['size'];
                }
            }

            $classes[] = $btn_class;
            $class_string = implode( ' ', $classes );

            $href = $atts['href'];

            $style_string = $atts['style'] ? ' style="' . $atts['style'] . '"' : '';
            $new_window   = $atts['new_window'] ? ' target="_blank"' : '';
            $rel          = $atts['rel'] ? ' rel="' . $atts['rel'] . '"' : '';

            $additional_atts = $style_string . $new_window . $rel;

            ob_start();
        ?>
            <a href="<?php echo $href; ?>" class="<?php echo $class_string; ?>"<?php echo $additional_atts; ?>>
                <?php echo do_shortcode( $content ); ?>
            </a>
        <?php
            return ob_get_clean();
        }
    }
}