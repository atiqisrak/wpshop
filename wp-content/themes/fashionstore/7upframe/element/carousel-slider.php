<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 31/08/15
 * Time: 10:00 AM
 */
/************************************Main Carousel*************************************/
if(!function_exists('s7upf_vc_slide_carousel'))
{
    function s7upf_vc_slide_carousel($attr, $content = false)
    {
        $html = $css_class = '';
        extract(shortcode_atts(array(
            'item'      => '1',
            'speed'     => '',
            'itemres'   => '',
            'nav_slider'=> 'nav-hidden',
            'animation' => '',
            'custom_css' => '',
        ),$attr));
        if(!empty($custom_css)) $css_class = vc_shortcode_custom_css_class( $custom_css );
            $html .=    '<div class="'.$nav_slider.'">';
            $html .=        '<div class="wrap-item sv-slider '.$css_class.'" data-item="'.$item.'" data-speed="'.$speed.'" data-itemres="'.$itemres.'" data-animation="'.$animation.'" data-nav="'.$nav_slider.'" data-prev="'.esc_attr__("Prev","fashionstore").'" data-next="'.esc_attr__("Next","fashionstore").'">';
            $html .=            wpb_js_remove_wpautop($content, false);
            $html .=        '</div>';
            $html .=    '</div>';
        return $html;
    }
}
stp_reg_shortcode('slide_carousel','s7upf_vc_slide_carousel');
vc_map(
    array(
        'name'     => esc_html__( 'Carousel Slider', 'fashionstore' ),
        'base'     => 'slide_carousel',
        'category' => esc_html__( '7Up-theme', 'fashionstore' ),
        'icon'     => 'icon-st',
        'as_parent' => array( 'only' => 'vc_column_text,vc_single_image,slide_banner_item,slide_testimonial_item,slide_adv_item,slide_banner_item17' ),
        'content_element' => true,
        'js_view' => 'VcColumnView',
        'params'   => array(                       
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
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Navigation style', 'fashionstore' ),
                'param_name'  => 'nav_slider',
                'value'       => array(
                    esc_html__( 'Hidden', 'fashionstore' )   => 'nav-hidden',
                    esc_html__( 'Default', 'fashionstore' )   => 'testimo-slider',
                    esc_html__( 'Default Navigation', 'fashionstore' )   => 'banner-slider4',
                    esc_html__( 'Top Arrow Navigation', 'fashionstore' )   => 'shoplook-slider7',
                    esc_html__( 'Bottom Arrow Navigation', 'fashionstore' )   => 'testimo-slide7',
                    esc_html__( 'Pagination Home 10', 'fashionstore' )   => 'banner-slider10',
                    esc_html__( 'Pagination Home 17', 'fashionstore' )   => 'banner-slider17',
                    esc_html__( 'Navigation Home 17', 'fashionstore' )   => 'brand-slider17 owl-direct17',
                    esc_html__( 'Pagination Home 18', 'fashionstore' )   => 'banner-slider18',
                    esc_html__( 'Navigation Home 18', 'fashionstore' )   => 'adv-slider18',
                    esc_html__( 'Navigation Home 19', 'fashionstore' )   => 'banner-slider19',
                    esc_html__( 'Navigation Home 19(2)', 'fashionstore' )   => 'owl-directnav19',
                ),
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


/**************************************BEGIN ITEM************************************/
//Banner item Frontend
if(!function_exists('s7upf_vc_slide_banner_item'))
{
    function s7upf_vc_slide_banner_item($attr, $content = false)
    {
        $html = $view_html = $view_html2 = '';
        extract(shortcode_atts(array(
            'style'         => 'style1',
            'image'         => '',
            'link'          => '',
        ),$attr));
        if(!empty($image)){            
            switch ($style) {
                case 'home10 style1':
                case 'home10 style2':
                    $html .=    '<div class="item-banner10">
                                    <div class="banner-thumb">
                                        <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                    </div>
                                    <div class="banner-info '.esc_attr($style).'">
                                        '.wpb_js_remove_wpautop($content, true).'
                                    </div>
                                </div>';
                    break;

                case 'item-banner4':
                    $html .=    '<div class="'.esc_attr($style).'">
                                    <div class="banner-thumb">
                                        <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                    </div>
                                    <div class="banner-info">
                                        '.wpb_js_remove_wpautop($content, true).'
                                    </div>
                                </div>';
                    break;

                case 'home1 style1':
                case 'home1 style2':
                case 'home1 style3':
                case 'home1 style4':
                    $html .=    '<div class="item-banner item-banner1">
                                    <div class="banner-thumb">
                                        <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                    </div>
                                    <div class="banner-info '.esc_attr($style).'">
                                        '.wpb_js_remove_wpautop($content, true).'
                                    </div>
                                </div>';
                    break;
                
                default:
                    $html .=    '<div class="item-slider19">
                                    <div class="banner-thumb">
                                        <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                    </div>
                                    <div class="banner-thumb-hidden hidden">'.wp_get_attachment_image($image,array(60,60)).'</div>';
                    if(!empty($content)){
                    $html .=        '<div class="banner-info">
                                        <div class="container">
                                            <div class="inner-banner-info '.esc_attr($style).'">
                                                '.wpb_js_remove_wpautop($content, true).'
                                            </div>
                                        </div>
                                    </div>';
                                }
                    $html .=    '</div>';
                    break;
            }            
        }
        return $html;
    }
}
stp_reg_shortcode('slide_banner_item','s7upf_vc_slide_banner_item');

// Banner item
vc_map(
    array(
        'name'     => esc_html__( 'Banner Item', 'fashionstore' ),
        'base'     => 'slide_banner_item',
        'icon'     => 'icon-st',
        'content_element' => true,
        'as_child' => array('only' => 'slide_carousel'),
        'params'   => array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Style', 'fashionstore' ),
                'param_name'  => 'style',
                'value'       => array(
                    esc_html__( 'Home 19', 'fashionstore' ) => 'style1',
                    esc_html__( 'Home 19(2)', 'fashionstore' ) => 'style2',
                    esc_html__( 'Home', 'fashionstore' ) => 'home1 style1',
                    esc_html__( 'Home(2)', 'fashionstore' ) => 'home1 style2',
                    esc_html__( 'Home(3)', 'fashionstore' ) => 'home1 style3',
                    esc_html__( 'Home(4)', 'fashionstore' ) => 'home1 style4',
                    esc_html__( 'Home 4', 'fashionstore' ) => 'item-banner4',
                    esc_html__( 'Home 10', 'fashionstore' ) => 'home10 style1',
                    esc_html__( 'Home 10(2)', 'fashionstore' ) => 'home10 style2',
                    )
            ),            
            array(
                'type'        => 'attach_image',
                'heading'     => esc_html__( 'Image', 'fashionstore' ),
                'param_name'  => 'image',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Link Banner', 'fashionstore' ),
                'param_name'  => 'link',
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => esc_html__("Content",'fashionstore'),
                "param_name" => "content",
            ),
        )
    )
);

/**************************************END ITEM************************************/

/**************************************BEGIN ITEM************************************/
//Banner item Frontend
if(!function_exists('s7upf_vc_slide_banner_item17'))
{
    function s7upf_vc_slide_banner_item17($attr, $content = false)
    {
        $html = $view_html = $view_htmll = $view_htmlr = '';
        extract(shortcode_atts(array(
            'image'         => '',
            'title'         => '',
            'sub_title'     => '',
            'des'           => '',
            'uptext'        => '',
            'ptext'         => '',
            'link'          => '',
            'imagel'         => '',
            'titlel'         => '',
            'sub_titlel'     => '',
            'desl'           => '',
            'uptextl'        => '',
            'ptextl'         => '',
            'linkl'          => '',
            'imager'         => '',
            'titler'         => '',
            'sub_titler'     => '',
            'desr'           => '',
            'uptextr'        => '',
            'ptextr'         => '',
            'linkr'          => '',
        ),$attr));
        if(!empty($image)){
            $link_image = $link_imagel = $link_imager =  '#';
            $view_link = vc_build_link( $link );
            if(!empty($view_link['url']) && !empty($view_link['title'])){               
                if(!empty($view_link['target'])) $target_html = 'target="'.$view_link['target'].'"';
                else $target_html = '';
                $view_html = '<a class="shopnow" href="'.esc_url($view_link['url']).'" '.$target_html.'>'.$view_link['title'].'</a>';
                $link_image = $view_link['url'];
            }
            $view_link = vc_build_link( $linkl );
            if(!empty($view_link['url']) && !empty($view_link['title'])){               
                if(!empty($view_link['target'])) $target_html = 'target="'.$view_link['target'].'"';
                else $target_html = '';
                $view_htmll = '<a class="shopnow" href="'.esc_url($view_link['url']).'" '.$target_html.'>'.$view_link['title'].'</a>';
                $link_imagel = $view_link['url'];
            }
            $view_link = vc_build_link( $linkr );
            if(!empty($view_link['url']) && !empty($view_link['title'])){               
                if(!empty($view_link['target'])) $target_html = 'target="'.$view_link['target'].'"';
                else $target_html = '';
                $view_htmlr = '<a class="shopnow" href="'.esc_url($view_link['url']).'" '.$target_html.'>'.$view_link['title'].'</a>';
                $link_imager = $view_link['url'];
            }
            $html .=    '<div class="item">
                            <div class="row">
                                <div class="col-md-3 col-sm-4 hidden-xs">
                                    <div class="item-banner17 item-left">
                                        <div class="banner-thumb">
                                            <a href="'.esc_url($link_imagel).'">'.wp_get_attachment_image($imagel,'full').'</a>
                                            <div class="banner-thumb-info">
                                                <h2>'.esc_html($titlel).'</h2>
                                                <h3>'.esc_html($sub_titlel).'</h3>
                                            </div>
                                        </div>
                                        <div class="banner-info">
                                            <h2>'.esc_html($titlel).'</h2>
                                            <h3>'.esc_html($sub_titlel).'</h3>
                                            <p>'.esc_html($desl).'</p>
                                            <div class="uptosale">
                                                <span>'.esc_html($uptextl).'</span>
                                                <strong>'.esc_html($ptextl).'</strong>
                                            </div>
                                            '.$view_htmll.'
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-8 col-xs-12">
                                    <div class="item-banner17 item-center">
                                        <div class="banner-thumb">
                                            <a href="'.esc_url($link_image).'">'.wp_get_attachment_image($image,'full').'</a>
                                            <div class="banner-thumb-info">
                                                <h2>'.esc_html($title).'</h2>
                                                <h3>'.esc_html($sub_title).'</h3>
                                            </div>
                                        </div>
                                        <div class="banner-info">
                                            <h2>'.esc_html($title).'</h2>
                                            <h3>'.esc_html($sub_title).'</h3>
                                            <p>'.esc_html($des).'</p>
                                            <div class="uptosale">
                                                <span>'.esc_html($uptext).'</span>
                                                <strong>'.esc_html($ptext).'</strong>
                                            </div>
                                            '.$view_html.'
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3  hidden-sm hidden-xs">
                                    <div class="item-banner17 item-right">
                                        <div class="banner-thumb">
                                            <a href="'.esc_url($link_imager).'">'.wp_get_attachment_image($imager,'full').'</a>
                                            <div class="banner-thumb-info">
                                                <h2>'.esc_html($titler).'</h2>
                                                <h3>'.esc_html($sub_titler).'</h3>
                                            </div>
                                        </div>
                                        <div class="banner-info">
                                            <h2>'.esc_html($titler).'</h2>
                                            <h3>'.esc_html($sub_titler).'</h3>
                                            <p>'.esc_html($desr).'</p>
                                            <div class="uptosale">
                                                <span>'.esc_html($uptextr).'</span>
                                                <strong>'.esc_html($ptextr).'</strong>
                                            </div>
                                            '.$view_htmlr.'
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
        }
        return $html;
    }
}
stp_reg_shortcode('slide_banner_item17','s7upf_vc_slide_banner_item17');

// Banner item
vc_map(
    array(
        'name'     => esc_html__( 'Banner Item(17)', 'fashionstore' ),
        'base'     => 'slide_banner_item17',
        'icon'     => 'icon-st',
        'content_element' => true,
        'as_child' => array('only' => 'slide_carousel'),
        'params'   => array(
            array(
                'type'        => 'attach_image',
                'heading'     => esc_html__( 'Image', 'fashionstore' ),
                'param_name'  => 'image',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Title', 'fashionstore' ),
                'param_name'  => 'title',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Sub Title', 'fashionstore' ),
                'param_name'  => 'sub_title',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Description', 'fashionstore' ),
                'param_name'  => 'des',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Extra text 1', 'fashionstore' ),
                'param_name'  => 'uptext',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Extra text 2', 'fashionstore' ),
                'param_name'  => 'ptext',
            ),
            array(
                'type'        => 'vc_link',
                'heading'     => esc_html__( 'Link Banner', 'fashionstore' ),
                'param_name'  => 'link',
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => esc_html__( 'Image', 'fashionstore' ),
                'param_name'  => 'imagel',
                'group'       => esc_html__( 'Banner Left', 'fashionstore' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Title', 'fashionstore' ),
                'param_name'  => 'titlel',
                'group'       => esc_html__( 'Banner Left', 'fashionstore' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Sub Title', 'fashionstore' ),
                'param_name'  => 'sub_titlel',
                'group'       => esc_html__( 'Banner Left', 'fashionstore' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Description', 'fashionstore' ),
                'param_name'  => 'desl',
                'group'       => esc_html__( 'Banner Left', 'fashionstore' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Extra text 1', 'fashionstore' ),
                'param_name'  => 'uptextl',
                'group'       => esc_html__( 'Banner Left', 'fashionstore' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Extra text 2', 'fashionstore' ),
                'param_name'  => 'ptextl',
                'group'       => esc_html__( 'Banner Left', 'fashionstore' ),
            ),
            array(
                'type'        => 'vc_link',
                'heading'     => esc_html__( 'Link Banner', 'fashionstore' ),
                'param_name'  => 'linkl',
                'group'       => esc_html__( 'Banner Left', 'fashionstore' ),
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => esc_html__( 'Image', 'fashionstore' ),
                'param_name'  => 'imager',
                'group'       => esc_html__( 'Banner right', 'fashionstore' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Title', 'fashionstore' ),
                'param_name'  => 'titler',
                'group'       => esc_html__( 'Banner right', 'fashionstore' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Sub Title', 'fashionstore' ),
                'param_name'  => 'sub_titler',
                'group'       => esc_html__( 'Banner right', 'fashionstore' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Description', 'fashionstore' ),
                'param_name'  => 'desr',
                'group'       => esc_html__( 'Banner right', 'fashionstore' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Extra text 1', 'fashionstore' ),
                'param_name'  => 'uptextr',
                'group'       => esc_html__( 'Banner right', 'fashionstore' ),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Extra text 2', 'fashionstore' ),
                'param_name'  => 'ptextr',
                'group'       => esc_html__( 'Banner right', 'fashionstore' ),
            ),
            array(
                'type'        => 'vc_link',
                'heading'     => esc_html__( 'Link Banner', 'fashionstore' ),
                'param_name'  => 'linkr',
                'group'       => esc_html__( 'Banner right', 'fashionstore' ),
            ),
        )
    )
);

/**************************************END ITEM************************************/


/**************************************BEGIN ITEM************************************/
//Banner item Frontend
if(!function_exists('s7upf_vc_slide_testimonial_item'))
{
    function s7upf_vc_slide_testimonial_item($attr, $content = false)
    {
        $html = $view_html = $view_html2 = '';
        extract(shortcode_atts(array(
            'style'         => '',
            'image'         => '',
            'name'          => '',
            'link'          => '',
            'des'           => '',
            'pos'           => '',
        ),$attr));
        switch ($style) {
            case 'home2':
                $html .=    '<div class="item-testimo">
                                <div class="zoom-image">
                                    <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                </div>
                                <p>'.$des.'</p>
                                <h3><a href="'.esc_url($link).'">'.esc_html($name).'</a></h3>
                            </div>';
                break;

            case 'home7':
                $html .=    '<div class="item-testimo7">
                                <p>'.esc_html($des).'</p>
                                <div class="testimo-author7">
                                    <div class="author-thumb7">
                                        <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                    </div>
                                    <div class="author-info7">
                                        <h3><a href="'.esc_url($link).'">'.esc_html($name).'</a></h3>
                                        <span>'.esc_html($pos).'</span>
                                    </div>
                                </div>
                            </div>';
                break;
            
            default:
                $html .=    '<div class="item-testimo4">
                                <div class="testimo-thumb">
                                    <div class="zoom-image">
                                        <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                    </div>
                                </div>
                                <div class="testimo-info">
                                    <h3><a href="'.esc_url($link).'">'.esc_html($name).'</a></h3>
                                    <p>'.$des.'</p>
                                </div>
                            </div>';
                break;
        }        
        return $html;
    }
}
stp_reg_shortcode('slide_testimonial_item','s7upf_vc_slide_testimonial_item');

// Banner item
vc_map(
    array(
        'name'     => esc_html__( 'Testimonial Item', 'fashionstore' ),
        'base'     => 'slide_testimonial_item',
        'icon'     => 'icon-st',
        'content_element' => true,
        'as_child' => array('only' => 'slide_carousel'),
        'params'   => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Type",'fashionstore'),
                "param_name" => "style",
                "value"     => array(
                    esc_html__("Default",'fashionstore')   => '',
                    esc_html__("Home 2",'fashionstore')   => 'home2',
                    esc_html__("Home 7",'fashionstore')   => 'home7',
                    ),
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => esc_html__( 'Image', 'fashionstore' ),
                'param_name'  => 'image',
            ),
            array(
                'type'        => 'textfield',                
                "holder"      => "h3",
                'heading'     => esc_html__( 'Name', 'fashionstore' ),
                'param_name'  => 'name',
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "heading" => esc_html__("Position",'fashionstore'),
                "param_name" => "pos",
                "dependency"    => array(
                    "element"   => 'style',
                    "value"   => array('home7'),
                    )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Link', 'fashionstore' ),
                'param_name'  => 'link',
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "heading" => esc_html__("Description",'fashionstore'),
                "param_name" => "des",
            ),
        )
    )
);

/**************************************END ITEM************************************/

/**************************************BEGIN ITEM************************************/
//Banner item Frontend
if(!function_exists('s7upf_vc_slide_adv_item'))
{
    function s7upf_vc_slide_adv_item($attr, $content = false)
    {
        $html = '';
        extract(shortcode_atts(array(
            'style'         => '',
            'image'         => '',
            'name'          => '',
            'link'          => '',
            'des'           => '',
            'bg_info'       => '',
            'label'         => '',
        ),$attr));
        switch ($style) {
            case 'home19':
                $html .=    '<div class="item-collect19">
                                <div class="zoom-image">
                                    <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                </div>
                                <a href="'.esc_url($link).'" class="shopnow">'.esc_html($label).'</a>
                            </div>';
                break;

            case 'home18':
                $html .=    '<div class="item-adv18">
                                <div class="adv-thumb">
                                    <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                </div>
                                <div class="adv-info">
                                    <h2><a href="'.esc_url($link).'">'.esc_html($name).'</a></h2>
                                    <p>'.esc_html($des).'</p>
                                    <a href="'.esc_url($link).'" class="shopnow"><i class="fa fa-plus" aria-hidden="true"></i>'.esc_html($label).'</a>
                                </div>
                            </div>';
                break;

            case 'home11':
                if(!empty($bg_info)) $bg_info = S7upf_Assets::build_css('background: '.$bg_info.';');
                $html .=    '<div class="item-adv11">
                                <div class="adv-thumb">
                                    <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                </div>
                                <div class="adv-info '.esc_attr($bg_info).'">
                                    <h2>'.esc_html($name).'</h2>
                                    <h3>'.esc_html($des).'</h3>
                                    <a href="'.esc_url($link).'" class="explore">'.esc_html($label).'</a>
                                </div>
                            </div>';
                break;
            
            default:
                $html .=    '<div class="item-shoplook7">
                                <div class="thumb-shoplook7">
                                    <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                </div>
                                <div class="info-shoplook7">
                                    <h2>'.esc_html($name).'</h2>
                                    <a href="'.esc_url($link).'" class="shopnow"><span>'.esc_html($label).'</span></a>
                                </div>
                            </div>';
                break;
        }        
        return $html;
    }
}
stp_reg_shortcode('slide_adv_item','s7upf_vc_slide_adv_item');

// Banner item
vc_map(
    array(
        'name'     => esc_html__( 'Advantage Item', 'fashionstore' ),
        'base'     => 'slide_adv_item',
        'icon'     => 'icon-st',
        'content_element' => true,
        'as_child' => array('only' => 'slide_carousel'),
        'params'   => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Style",'fashionstore'),
                "param_name" => "style",
                "value"     => array(
                    esc_html__("Home 7",'fashionstore')   => '',
                    esc_html__("Home 11",'fashionstore')   => 'home11',
                    esc_html__("Home 18",'fashionstore')   => 'home18',
                    esc_html__("Home 19",'fashionstore')   => 'home19',
                    ),
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => esc_html__( 'Image', 'fashionstore' ),
                'param_name'  => 'image',
            ),
            array(
                'type'        => 'textfield',                
                "holder"      => "h3",
                'heading'     => esc_html__( 'Title', 'fashionstore' ),
                'param_name'  => 'name',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Description', 'fashionstore' ),
                'param_name'  => 'des',
                "dependency"    => array(
                    "element"   => 'style',
                    "value"   => array('home11','home18'),
                    )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Link', 'fashionstore' ),
                'param_name'  => 'link',
            ),
            array(
                'type'        => 'colorpicker',
                'heading'     => esc_html__( 'Info Background', 'fashionstore' ),
                'param_name'  => 'bg_info',
                "dependency"    => array(
                    "element"   => 'style',
                    "value"   => array('home11'),
                    )
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Label Button', 'fashionstore' ),
                'param_name'  => 'label',
            ),
        )
    )
);

/**************************************END ITEM************************************/


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Slide_Carousel extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Slide_Banner_Item extends WPBakeryShortCode {}
    class WPBakeryShortCode_Slide_Testimonial_Item extends WPBakeryShortCode {}
    class WPBakeryShortCode_Slide_Adv_Item extends WPBakeryShortCode {}
}