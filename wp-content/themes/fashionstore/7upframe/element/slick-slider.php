<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 31/08/15
 * Time: 10:00 AM
 */
/************************************Main Carousel*************************************/
if(!function_exists('s7upf_vc_slick_slider'))
{
    function s7upf_vc_slick_slider($attr, $content = false)
    {
        $html = '';
        extract(shortcode_atts(array(
            'style'     => 'testimo-slider10'
        ),$attr));
        $html .=    '<div class="'.esc_attr($style).'">
                        <div class="center slider">';
        $html .=            wpb_js_remove_wpautop($content, false);
        $html .=        '</div>';
        $html .=    '</div>';
        return $html;
    }
}
stp_reg_shortcode('sv_slick_slider','s7upf_vc_slick_slider');
vc_map(
    array(
        'name'              => esc_html__( 'Slick Slider', 'fashionstore' ),
        'base'              => 'sv_slick_slider',
        'category'          => esc_html__( '7Up-theme', 'fashionstore' ),
        'icon'              => 'icon-st',
        'as_parent'         => array( 'only' => 'vc_column_text,sv_slick_item,sv_slick_banner_item' ),
        'content_element'   => true,
        'js_view'           => 'VcColumnView',
        'params'            => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "heading" => esc_html__("Style",'fashionstore'),
                "param_name" => "style",
                "value"     => array(
                    esc_html__("Home 10",'fashionstore')   => 'testimo-slider10',
                    esc_html__("Home 11",'fashionstore')   => 'banner-slider11',
                    )
            ),
        )
    )
);

/*******************************************END MAIN*****************************************/

/************************************ITEM CONTENT*************************************/

if(!function_exists('s7upf_vc_slick_item'))
{
    function s7upf_vc_slick_item($attr, $content = false)
    {
        $html = $css_class = '';
        extract(shortcode_atts(array(
            'image'         => '',
            'name'          => '',
            'des'           => '',
            'link'          => '',
        ),$attr));
        $html .=    '<div class="item-testimo10">
                        <div class="testimo-thumb">
                            <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                        </div>
                        <div class="testimo-info">
                            <p class="desc">'.esc_html($des).'</p>
                            <h3 class="testimo-author"><a href="'.esc_url($link).'">'.esc_html($name).'</a></h3>
                        </div>
                    </div>';
        return $html;
    }
}
stp_reg_shortcode('sv_slick_item','s7upf_vc_slick_item');
vc_map(
    array(
        "name"              => esc_html__("Testimonial Item", "fashionstore"),
        "base"              => "sv_slick_item",
        "content_element"   => true,
        "as_child"          => array('only' => 'sv_slick_slider'),
        "icon"              => "icon-st",
        "category"          => esc_html__( '7Up-theme', 'fashionstore' ),
        "params"            => array(
            array(
                "type"          => "attach_image",
                "heading"       => esc_html__("Image",'fashionstore'),
                "param_name"    => "image",
            ),
            array(
                "type"          => "textfield",
                "holder"        => 'h3',
                "heading"       => esc_html__("Name",'fashionstore'),
                "param_name"    => "name",
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Link",'fashionstore'),
                "param_name"    => "link",
            ),
            array(
                "type"          => "textarea",
                "holder"        => 'div',
                "heading"       => esc_html__("Description",'fashionstore'),
                "param_name"    => "des",
            ),
        ),
    )
);
/**************************************END ITEM************************************/

/************************************ITEM CONTENT*************************************/

if(!function_exists('s7upf_vc_slick_banner_item'))
{
    function s7upf_vc_slick_banner_item($attr, $content = false)
    {
        $html = $css_class = '';
        extract(shortcode_atts(array(
            'image'         => '',
            'title'          => '',
            'price'           => '',
            'price2'           => '',
            'time'           => '',
            'des'           => '',
            'link'          => '',
        ),$attr));
        $html .=    '<div class="item-banner11">
                        <div class="banner-thumb">
                            <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                        </div>
                        <div class="banner-info">
                            <h2 class="big-title">'.esc_html($title).'</h2>
                            <p>'.esc_html($des).'</p>';
        if(!empty($price) || !empty($price2)){
            $html .=            '<div class="product-price">';
            if(!empty($price)) $html .=            '<ins><span>'.esc_html($price).'</span></ins>';
            if(!empty($price2)) $html .=            '<del><span>'.esc_html($price2).'</span></del>';
            $html .=            '</div>';
        }
        $html .=            '<div class="bigsale-countdown" data-date="'.esc_attr($time).'"></div>
                            <a href="'.esc_url($link).'" class="btn-link11" data-hover="'.esc_attr__("Shop now","fashionstore").'"><span>'.esc_html__("Shop now","fashionstore").'</span></a>
                        </div>
                    </div>';
        return $html;
    }
}
stp_reg_shortcode('sv_slick_banner_item','s7upf_vc_slick_banner_item');
vc_map(
    array(
        "name"              => esc_html__("Banner Item", "fashionstore"),
        "base"              => "sv_slick_banner_item",
        "content_element"   => true,
        "as_child"          => array('only' => 'sv_slick_slider'),
        "icon"              => "icon-st",
        "category"          => esc_html__( '7Up-theme', 'fashionstore' ),
        "params"            => array(
            array(
                "type"          => "attach_image",
                "heading"       => esc_html__("Image",'fashionstore'),
                "param_name"    => "image",
            ),
            array(
                "type"          => "textfield",
                "holder"        => 'h3',
                "heading"       => esc_html__("Title",'fashionstore'),
                "param_name"    => "title",
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Price",'fashionstore'),
                "param_name"    => "price",
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Price 2",'fashionstore'),
                "param_name"    => "price2",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Time Countdown",'fashionstore'),
                "param_name" => "time",
                'description'   => esc_html__( 'EntertTime for countdown. Format is mm/dd/yyyy. Example: 12/15/2016.', 'fashionstore' ),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Link",'fashionstore'),
                "param_name"    => "link",
            ),
            array(
                "type"          => "textarea",
                "holder"        => 'div',
                "heading"       => esc_html__("Description",'fashionstore'),
                "param_name"    => "des",
            ),
        ),
    )
);
/**************************************END ITEM************************************/


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Sv_Slick_Slider extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Sv_Slick_Item extends WPBakeryShortCode {}
    class WPBakeryShortCode_Sv_Slick_Banner_Item extends WPBakeryShortCode {}
}