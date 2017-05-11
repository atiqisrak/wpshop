<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 31/08/15
 * Time: 10:00 AM
 */
/************************************Main Carousel*************************************/
if(!function_exists('s7upf_vc_single_carousel'))
{
    function s7upf_vc_single_carousel($attr, $content = false)
    {
        $html = $css_class = '';
        extract(shortcode_atts(array(
            'title'      => '',
            'des'       => '',
            'item'      => '1',
            'speed'     => '',
            'itemres'   => '',
            'animation' => '',
            'custom_css' => '',
        ),$attr));
        if(!empty($custom_css)) $css_class = vc_shortcode_custom_css_class( $custom_css );
            $html .=    '<div class="single-image-slide">';
            if(!empty($title)) $html .=    '<h2 class="title-default">'.esc_html($title).'</h2>';
            $html .=        '<div class="wrap-item sv-slider '.$css_class.'" data-item="'.$item.'" data-speed="'.$speed.'" data-itemres="'.$itemres.'" data-animation="'.$animation.'" data-nav="single-image-slide">';
            $html .=            wpb_js_remove_wpautop($content, false);
            $html .=        '</div>';
            $html .=        '<p class="caption-slider">'.esc_html($des).'</p>';
            $html .=    '</div>';
        return $html;
    }
}
stp_reg_shortcode('single_carousel','s7upf_vc_single_carousel');
vc_map(
    array(
        'name'     => esc_html__( 'Single Slider', 'fashionstore' ),
        'base'     => 'single_carousel',
        'category' => esc_html__( '7Up-theme', 'fashionstore' ),
        'icon'     => 'icon-st',
        'as_parent' => array( 'only' => 'vc_column_text,vc_single_image' ),
        'content_element' => true,
        'js_view' => 'VcColumnView',
        'params'   => array( 
            array(
                'heading'     => esc_html__( 'Title', 'fashionstore' ),
                'holder'      => 'h3',
                'type'        => 'textfield',
                'param_name'  => 'title',
            ),
            array(
                'heading'     => esc_html__( 'Description', 'fashionstore' ),
                'holder'      => 'div',
                'type'        => 'textarea',
                'param_name'  => 'des',
            ),
            array(
                'heading'     => esc_html__( 'Item slider display', 'fashionstore' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter number of item. Default is 1.', 'fashionstore' ),
                'param_name'  => 'item',
            ),
            array(
                'heading'     => esc_html__( 'Speed', 'fashionstore' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter time slider go to next item. Unit (ms). Example 5000. If empty this field autoPlay is false.', 'fashionstore' ),
                'param_name'  => 'speed',
            ),
            array(
                'heading'     => esc_html__( 'Custom Item', 'fashionstore' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter custom item for each window 360px,480px,768px,992px. Default is auto. Example: "2,3,4,5"', 'fashionstore' ),
                'param_name'  => 'itemres',
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Animation', 'fashionstore' ),
                'param_name'  => 'animation',
                'value'       => array(
                    esc_html__( 'None', 'fashionstore' )        => '',
                    esc_html__( 'Fade', 'fashionstore' )        => 'fade',
                    esc_html__( 'BackSlide', 'fashionstore' )   => 'backSlide',
                    esc_html__( 'GoDown', 'fashionstore' )      => 'goDown',
                    esc_html__( 'FadeUp', 'fashionstore' )      => 'fadeUp',
                    )
            ),
            array(
                "type"          => "css_editor",
                "heading"       => esc_html__("Custom Block",'fashionstore'),
                "param_name"    => "custom_css",
                'group'         => esc_html__('Advanced','fashionstore')
            )
        )
    )
);

/*******************************************END MAIN*****************************************/

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Single_Carousel extends WPBakeryShortCodesContainer {
    }
}