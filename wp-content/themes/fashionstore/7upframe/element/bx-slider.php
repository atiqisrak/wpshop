<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 31/08/15
 * Time: 10:00 AM
 */
/************************************Main Carousel*************************************/
if(!function_exists('s7upf_vc_bx_slider'))
{
    function s7upf_vc_bx_slider($attr, $content = false)
    {
        $html = '';
        extract(shortcode_atts(array(
            'style'     => 'banner-slider12'
        ),$attr));
        $html .=    '<div class="'.esc_attr($style).'">
                        <ul class="bxslider">';
        $html .=            wpb_js_remove_wpautop($content, false);
        $html .=        '</ul>';
        if($style == 'banner-slider2') $html .= '<div class="bx-pager"></div>';
        $html .=    '</div>';
        return $html;
    }
}
stp_reg_shortcode('sv_bx_slider','s7upf_vc_bx_slider');
vc_map(
    array(
        'name'              => esc_html__( 'BX Slider', 'fashionstore' ),
        'base'              => 'sv_bx_slider',
        'category'          => esc_html__( '7Up-theme', 'fashionstore' ),
        'icon'              => 'icon-st',
        'as_parent'         => array( 'only' => 'vc_column_text,sv_bx_item' ),
        'content_element'   => true,
        'js_view'           => 'VcColumnView',
        'params'            => array(
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__("Style",'fashionstore'),
                "param_name"    => "style",
                "value"         => array(
                    esc_html__("Home 12",'fashionstore')     => 'banner-slider12',
                    esc_html__("Home 2",'fashionstore')     => 'banner-slider2',
                    )
            ),
        )
    )
);

/*******************************************END MAIN*****************************************/

/************************************ITEM CONTENT*************************************/

if(!function_exists('s7upf_vc_bx_item'))
{
    function s7upf_vc_bx_item($attr, $content = false)
    {
        $html = $css_class = '';
        extract(shortcode_atts(array(
            'style'         => '',
            'image'         => '',
            'image_pager'   => '',
            'link'          => '',
        ),$attr));
        switch ($style) {
            case 'home2':
                if(!empty($image_pager))$image_page_html =  wp_get_attachment_image($image_pager,array(90,150));
                else $image_page_html = wp_get_attachment_image($image,array(90,150));

                $html .=    '<li>
                                <div class="item-banner2">
                                    <div class="banner-thumb"><a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a></div>
                                    <div class="banner-info">
                                        '.wpb_js_remove_wpautop($content, true).'
                                    </div>
                                </div>
                                <div class="hidden item-pager"><a data-slide-index="0" href="#">'.$image_page_html.'</a></div>
                            </li>';
                break;
            
            default:
                $html .=    '<li>
                                <div class="item-slider12">
                                    <div class="banner-thumb"><a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a></div>
                                    <div class="banner-info '.esc_attr($style).'">
                                        '.wpb_js_remove_wpautop($content, true).'
                                    </div>
                                </div>
                            </li>';
                break;
        }        
        return $html;
    }
}
stp_reg_shortcode('sv_bx_item','s7upf_vc_bx_item');
vc_map(
    array(
        "name"              => esc_html__("Bx Item", "fashionstore"),
        "base"              => "sv_bx_item",
        "content_element"   => true,
        "as_child"          => array('only' => 'sv_bx_slider'),
        "icon"              => "icon-st",
        "category"          => esc_html__( '7Up-theme', 'fashionstore' ),
        "params"            => array(
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__("Style",'fashionstore'),
                "param_name"    => "style",
                "value"         => array(
                    esc_html__("Home 12 Style 1",'fashionstore')     => '',
                    esc_html__("Home 12 Style 2",'fashionstore')     => 'style2',
                    esc_html__("Home 2",'fashionstore')     => 'home2',
                    )
            ),
            array(
                "type"          => "attach_image",
                "heading"       => esc_html__("Image",'fashionstore'),
                "param_name"    => "image",
            ),
            array(
                "type"          => "attach_image",
                "heading"       => esc_html__("Image Pager",'fashionstore'),
                "param_name"    => "image_pager",
                "dependency"    => array(
                    "element"   => "style",
                    "value"     => "home2",
                    )
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Link",'fashionstore'),
                "param_name"    => "link",
            ),
            array(
                "type"          => "textarea_html",
                "holder"        => 'div',
                "heading"       => esc_html__("Content",'fashionstore'),
                "param_name"    => "content",
            ),
        ),
    )
);
/**************************************END ITEM************************************/


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Sv_Bx_Slider extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Sv_Bx_Item extends WPBakeryShortCode {}
}