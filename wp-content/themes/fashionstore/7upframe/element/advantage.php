<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_advantage'))
{
    function s7upf_vc_advantage($attr,$content = false)
    {
        $html = $view_html = $link_item = '';
        extract(shortcode_atts(array(
            'style'      => 'style1',
            's_style'    => 'style1',
            'h7_style'   => 'style1',
            'image'      => '',
            'images'     => '',
            'title'      => '',
            'title2'     => '',
            'des'        => '',
            'link'       => '',
            'view_link'  => '',
            'info_color' => '',
            'info_pos'   => 'pst-bottom',
            'cat'        => '',
        ),$attr));
        $view_link = vc_build_link( $view_link );        
        switch ($style) {
            case 'mega-banner':
            case 'mega-banner2':
                if(!empty($view_link['url']) && !empty($view_link['title'])){
                    if(!empty($view_link['target'])) $target_html = 'target="'.$view_link['target'].'"';
                    else $target_html = '';
                    $view_html = '<a class="shopnow" href="'.esc_url($view_link['url']).'" '.$target_html.'>'.$view_link['title'].'</a>';
                    $link_item = $view_link['url'];                    
                }
                $html .=    '<div class="'.esc_attr($style).'">
                                <div class="zoom-image"><a href="'.esc_url($link_item).'">'.wp_get_attachment_image($image,'full').'</a></div>
                                <div class="banner-info">
                                    '.wpb_js_remove_wpautop($content, true).'
                                    '.$view_html.'
                                </div>
                            </div>';
                break;

            case 'home19-2':
                $html .=    '<div class="item-shopcat19">
                                <a href="'.esc_url($link).'">
                                    '.wp_get_attachment_image($image,'full').'
                                    <h2 class="cat-title">'.esc_html($title).'</h2>
                                </a>
                            </div>';
                break;

            case 'home19':
                if(!empty($info_color)) $info_color = S7upf_Assets::build_css('color:'.$info_color.';');
                $html .=    '<div class="item-adv19">
                                <div class="adv-thumb">
                                    <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                </div>
                                <div class="adv-info '.esc_attr($info_pos.' '.$info_color).'">
                                    <h2>'.esc_html($title).'</h2>
                                    <p>'.esc_html($des).'</p>
                                </div>
                            </div>';
                break;

            case 'home19-service':
                $html .=    '<div class="item-service19">
                                <div class="service-icon">
                                    <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                </div>
                                <div class="service-info">
                                    <h2>'.esc_html($title).'</h2>
                                    <p>'.esc_html($des).'</p>
                                </div>
                            </div>';
                break;

            case 'home18-2':
                if(!empty($view_link['url']) && !empty($view_link['title'])){
                    if(!empty($view_link['target'])) $target_html = 'target="'.$view_link['target'].'"';
                    else $target_html = '';
                    $view_html = '<a class="buynow" href="'.esc_url($view_link['url']).'" '.$target_html.'>'.$view_link['title'].'</a>';
                    $link_item = $view_link['url'];
                    $html .=    '<div class="banner-adv18">
                                    <div class="banner-thumb">
                                        <a href="'.esc_url($link_item).'">'.wp_get_attachment_image($image,'full').'</a>
                                    </div>
                                    <div class="banner-info">
                                        '.wpb_js_remove_wpautop($content, true).'
                                        '.$view_html.'
                                    </div>
                                </div>';
                }
                break;

            case 'home18-gallery':
                if(!empty($view_link['url']) && !empty($view_link['title'])){
                    if(!empty($view_link['target'])) $target_html = 'target="'.$view_link['target'].'"';
                    else $target_html = '';
                    $view_html = '<a class="shopnow" href="'.esc_url($view_link['url']).'" '.$target_html.'>'.$view_link['title'].'</a>';
                    $link_item = $view_link['url'];
                }
                $images_html = '';
                parse_str( urldecode( $images ), $data);
                if(is_array($data)){
                    foreach ($data as $key => $value) {
                        $images_html .= '<div class="banner-thumb"><a href="'.esc_url($value['link']).'">'.wp_get_attachment_image($value['image'],'full').'</a></div>';
                    }
                }
                $html .=    '<div class="collect-content18">
                                <div class="collect-slider18">
                                    <div class="wrap-item">
                                        '.$images_html.'
                                    </div>
                                </div>
                                <div class="collect-info18">
                                    '.wpb_js_remove_wpautop($content, true).'
                                    '.$view_html.'
                                </div>
                            </div>';
                break;

            case 'home18':
                $html .=    '<div class="fall-winter">
                                <div class="winter-thumb">
                                    <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                </div>
                                <div class="winter-info">
                                    '.wpb_js_remove_wpautop($content, true).'
                                </div>
                            </div>';
                break;

            case 'home17-3':
                if(!empty($view_link['url']) && !empty($view_link['title'])){
                    if(!empty($view_link['target'])) $target_html = 'target="'.$view_link['target'].'"';
                    else $target_html = '';
                    $view_html = '<a class="shopnow" href="'.esc_url($view_link['url']).'" '.$target_html.'>'.$view_link['title'].'</a>';
                    $link_item = $view_link['url'];
                }
                $html .=    '<div class="access-banner">
                                <div class="banner-thumb zoom-image">
                                    <a href="'.esc_url($link_item).'">'.wp_get_attachment_image($image,'full').'</a>
                                </div>
                                <div class="banner-info">
                                    <div class="container">
                                        <div class="banner-access-info">
                                            '.wpb_js_remove_wpautop($content, true).'
                                            '.$view_html.'
                                        </div>
                                    </div>
                                </div>
                            </div>';
                break;

            case 'home17':
            case 'home17-2':
                $el_class = '';
                if($style == 'home17-2') $el_class = 'item-center';
                if(!empty($view_link['url']) && !empty($view_link['title'])){
                    if(!empty($view_link['target'])) $target_html = 'target="'.$view_link['target'].'"';
                    else $target_html = '';
                    $view_html = '<a class="shopnow" href="'.esc_url($view_link['url']).'" '.$target_html.'>'.$view_link['title'].'</a>';
                    $link_item = $view_link['url'];
                }
                $html .=    '<div class="item-banner-image17 '.esc_attr($el_class).'">
                                <div class="banner-thumb">
                                    <a href="'.esc_url($link_item).'">'.wp_get_attachment_image($image,'full').'</a>
                                </div>
                                <div class="banner-info">
                                    <h2>'.esc_html($title).'</h2>
                                    '.$view_html.'
                                </div>
                            </div>';
                break;

            case 'home17-service':
                if(!empty($view_link['url']) && !empty($view_link['title'])){
                    if(!empty($view_link['target'])) $target_html = 'target="'.$view_link['target'].'"';
                    else $target_html = '';
                    $view_html = '<a class="shopnow" href="'.esc_url($view_link['url']).'" '.$target_html.'>'.$view_link['title'].'</a>';
                    $link_item = $view_link['url'];
                }
                $html .=    '<div class="item-adv17">
                                <div class="adv-thumb">
                                    <a href="'.esc_url($link_item).'">'.wp_get_attachment_image($image,'full').'</a>
                                </div>
                                <div class="adv-info">
                                    <h3 class="product-title"><a href="'.esc_url($link_item).'">'.esc_html($title).'</a></h3>
                                    <div class="product-price">
                                        <ins><span>'.esc_html($des).'</span></ins>
                                    </div>
                                    '.$view_html.'
                                </div>
                            </div>';
                break;

            case 'home12-service2':
                $html .=    '<div class="item-service12 box-center">
                                <div class="service-icon"><a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a></div>
                                <div class="service-info">
                                    <h3><a href="'.esc_url($link).'">'.esc_html($title).'</a></h3>
                                    <p>'.esc_html($des).'</p>
                                </div>
                            </div>';
                break;

            case 'home12-service':
                $html .=    '<div class="item-service12">
                                <div class="service-icon"><a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a></div>
                                <div class="service-info">
                                    <h3><a href="'.esc_url($link).'">'.esc_html($title).'</a></h3>
                                    <p>'.esc_html($des).'</p>
                                </div>
                            </div>';
                break;

            case 'home12':
                if(!empty($view_link['url']) && !empty($view_link['title'])){
                    if(!empty($view_link['target'])) $target_html = 'target="'.$view_link['target'].'"';
                    else $target_html = '';
                    $view_html = '<a class="shopnow" href="'.esc_url($view_link['url']).'" '.$target_html.'>'.$view_link['title'].'</a>';
                    $link_item = $view_link['url'];
                }
                $html .=    '<div class="item-cat-adv12">
                                <div class="cat-thumb zoom-image"><a href="'.esc_url($link_item).'">'.wp_get_attachment_image($image,'full').'</a></div>
                                <div class="cat-info">
                                    <h2>'.esc_html($title).'</h2>
                                    '.$view_html.'
                                </div>
                            </div>';
                break;

            case 'home11':
                $html .=    '<div class="shipping-member-box">
                                <h2>'.esc_html($title).'</h2>
                                <a class="shipping-member-link" href="'.esc_url($link).'">
                                    '.wp_get_attachment_image($image,'full' ).'
                                </a>
                            </div>';
                break;

            case 'home7-3':
                switch ($h7_style) {
                    case 'style4':
                        $html .=    '<div class="item-banner7 style4">
                                        <h2>'.esc_html($title).'</h2>
                                        <div class="text-special7">
                                            '.wpb_js_remove_wpautop($content, true).'
                                        </div>
                                    </div>';
                        break;

                    case 'style3':
                        if(!empty($image)) $image = S7upf_Assets::build_css('background-image: url('.wp_get_attachment_image_url($image,'full').') !important;');
                        $html .=    '<div class="item-banner7 style3 '.esc_attr($image).'">
                                        '.wpb_js_remove_wpautop($content, true).'
                                    </div>';
                        break;
                    
                    default:
                        $html .=    '<div class="item-banner7 '.esc_attr($h7_style).'">
                                        <div class="zoom-image">
                                            <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a>
                                        </div>
                                        <div class="banner-info">
                                            '.wpb_js_remove_wpautop($content, true).'
                                        </div>
                                    </div>';
                        break;
                }                
                break;

            case 'home7-2':
                $html .=    '<div class="collect-banner">
                                <div class="collect-banner-info">
                                    '.wpb_js_remove_wpautop($content, true).'
                                </div>
                                <div class="collect-banner-thumb">
                                    <div class="zoom-image"><a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a></div>
                                </div>
                            </div>';
                break;

            case 'home7-image':                
                $html .=    '<div class="perfect-banner style2">
                                <div class="perfect-banner-info">
                                    '.wpb_js_remove_wpautop($content, true).'
                                </div>
                                <div class="perfect-banner-thumb">
                                    <div class="zoom-image"><a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a></div>
                                </div>
                            </div>';
                break;

            case 'home7-slider':
                $images_html = '';
                parse_str( urldecode( $images ), $data);
                if(is_array($data)){
                    foreach ($data as $key => $value) {
                        $images_html .= '<div class="perfect-thumb"><a href="'.esc_url($value['link']).'">'.wp_get_attachment_image($value['image'],'full').'</a></div>';
                    }
                }
                $html .=    '<div class="perfect-banner">
                                <div class="perfect-banner-info">
                                    '.wpb_js_remove_wpautop($content, true).'
                                </div>
                                <div class="perfect-banner-thumb">
                                    <div class="perfect-banner-slider">
                                        <div class="wrap-item">
                                            '.$images_html.'
                                        </div>
                                    </div>
                                </div>
                            </div>';
                break;

            case 'home7':
                if(!empty($view_link['url']) && !empty($view_link['title'])){
                    if(!empty($view_link['target'])) $target_html = 'target="'.$view_link['target'].'"';
                    else $target_html = '';
                    $view_html = '<a class="btn-link7" href="'.esc_url($view_link['url']).'" '.$target_html.'>'.$view_link['title'].'</a>';
                    $link_item = $view_link['url'];
                }
                if(!empty($image)) $image = S7upf_Assets::build_css('background-image: url('.wp_get_attachment_image_url($image,'full').');');
                $html .=    '<div class="item-banner-parallax '.esc_attr($image).'">
                                <div class="container">
                                    <div class="banner-paral-info '.esc_attr($s_style).'">
                                        '.wpb_js_remove_wpautop($content, true).'
                                        '.$view_html.'
                                    </div>
                                </div>
                            </div>';
                break;

            case 'home4-2':
                if(!empty($view_link['url']) && !empty($view_link['title'])){
                    if(!empty($view_link['target'])) $target_html = 'target="'.$view_link['target'].'"';
                    else $target_html = '';
                    $view_html = '<a class="shopnow" href="'.esc_url($view_link['url']).'" '.$target_html.'>'.$view_link['title'].'</a>';
                    $link_item = $view_link['url'];
                }
                $html .=    '<div class="item-fashion-adv style2 clearfix">
                                <div class="fashion-adv-thumb">
                                    <a href="'.esc_url($link_item).'">'.wp_get_attachment_image($image,'full').'</a>
                                </div>
                                <div class="fashion-adv-info">
                                    <h2>'.esc_html($title).'</h2>
                                    <p>'.$des.'</p>
                                    '.$view_html.'
                                </div>
                            </div>';
                break;

            case 'home4':
                if(!empty($view_link['url']) && !empty($view_link['title'])){
                    if(!empty($view_link['target'])) $target_html = 'target="'.$view_link['target'].'"';
                    else $target_html = '';
                    $view_html = '<a class="shopnow" href="'.esc_url($view_link['url']).'" '.$target_html.'>'.$view_link['title'].'</a>';
                    $link_item = $view_link['url'];
                }
                $html .=    '<div class="item-fashion-adv style1 clearfix">
                                <div class="fashion-adv-thumb">
                                    <a href="'.esc_url($link_item).'">'.wp_get_attachment_image($image,'full').'</a>
                                </div>
                                <div class="fashion-adv-info">
                                    <h2>'.esc_html($title).'</h2>
                                    <p>'.$des.'</p>
                                    '.$view_html.'
                                </div>
                            </div>';
                break;

            case 'product-cat':
                if(!empty($view_link['url']) && !empty($view_link['title'])){
                    if(!empty($view_link['target'])) $target_html = 'target="'.$view_link['target'].'"';
                    else $target_html = '';
                    $view_html = '<a class="readmore btn-plus" href="'.esc_url($view_link['url']).'" '.$target_html.'>'.$view_link['title'].'</a>';
                    $link_item = $view_link['url'];
                }
                $html .=    '<div class="item-category">
                                <div class="zoom-image"><a href="'.esc_url($link_item).'">'.wp_get_attachment_image($image,'full').'</a></div>
                                <div class="cat-info">
                                    <h3><a href="'.esc_url($link_item).'">'.esc_html($title).'</a></h3>
                                    '.$view_html.'
                                </div>
                            </div>';
                break;
            
            default:
                $html .=    '<div class="item-adv-wc">
                                <div class="content-adv-wc '.esc_attr($style).'">
                                    <div class="adv-wc-thumb"><a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a></div>
                                    <div class="adv-wc-info">
                                        <h3><a href="'.esc_url($link).'">'.esc_html($title).'</a></h3>
                                        <p>'.esc_html($des).'</p>
                                    </div>
                                </div>
                            </div>';
                break;
        }        
        
        return $html;
    }
}

stp_reg_shortcode('sv_advantage','s7upf_vc_advantage');

vc_map( array(
    "name"      => esc_html__("SV Advantage", 'fashionstore'),
    "base"      => "sv_advantage",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style",'fashionstore'),
            "param_name" => "style",
            "value"     => array(
                esc_html__("Style 1",'fashionstore')   => 'style1',
                esc_html__("Style 2",'fashionstore')   => 'style2',
                esc_html__("Style 3",'fashionstore')   => 'style3',
                esc_html__("Product category",'fashionstore')   => 'product-cat',
                esc_html__("Home 4",'fashionstore')   => 'home4',
                esc_html__("Home 4 style 2",'fashionstore')   => 'home4-2',
                esc_html__("Home 7",'fashionstore')   => 'home7',
                esc_html__("Home 7(Slider)",'fashionstore')   => 'home7-slider',
                esc_html__("Home 7(image zoom)",'fashionstore')   => 'home7-image',
                esc_html__("Home 7(style 2)",'fashionstore')   => 'home7-2',
                esc_html__("Home 7(style 3)",'fashionstore')   => 'home7-3',
                esc_html__("Home 11",'fashionstore')   => 'home11',
                esc_html__("Home 12",'fashionstore')   => 'home12',
                esc_html__("Home 12(Service)",'fashionstore')   => 'home12-service',
                esc_html__("Home 12(Service 2)",'fashionstore')   => 'home12-service2',
                esc_html__("Home 17(Service)",'fashionstore')   => 'home17-service',
                esc_html__("Home 17",'fashionstore')   => 'home17',
                esc_html__("Home 17(2)",'fashionstore')   => 'home17-2',
                esc_html__("Home 17(3)",'fashionstore')   => 'home17-3',
                esc_html__("Home 18",'fashionstore')   => 'home18',
                esc_html__("Home 18 gallery",'fashionstore')   => 'home18-gallery',
                esc_html__("Home 18(2)",'fashionstore')   => 'home18-2',
                esc_html__("Home 19(Service)",'fashionstore')   => 'home19-service',
                esc_html__("Home 19",'fashionstore')   => 'home19',
                esc_html__("Home 19(2)",'fashionstore')   => 'home19-2',
                esc_html__("Mega banner",'fashionstore')   => 'mega-banner',
                esc_html__("Mega banner 2",'fashionstore')   => 'mega-banner2',
                )
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Type",'fashionstore'),
            "param_name" => "s_style",
            "value"     => array(
                esc_html__("Style 1",'fashionstore')   => 'style1',
                esc_html__("Style 2",'fashionstore')   => 'style2',
                esc_html__("Style 3",'fashionstore')   => 'style3',
                ),
            "dependency"    => array(
                "element"   => 'style',
                "value"   => array('home7'),
                )
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Type Home 7(style 3)",'fashionstore'),
            "param_name" => "h7_style",
            "value"     => array(
                esc_html__("Style 1",'fashionstore')   => 'style1',
                esc_html__("Style 2",'fashionstore')   => 'style2',
                esc_html__("Style 3",'fashionstore')   => 'style3',
                esc_html__("Style 4",'fashionstore')   => 'style4',
                ),
            "dependency"    => array(
                "element"   => 'style',
                "value"   => array('home7-3'),
                )
        ),
        array(
            "type" => "add_brand",
            "heading" => esc_html__("Add Image List",'fashionstore'),
            "param_name" => "images",
            "dependency"    => array(
                "element"   => 'style',
                "value"   => array('home18-gallery','home7-slider'),
                )
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Image",'fashionstore'),
            "param_name" => "image",
            "dependency"    => array(
                "element"   => 'style',
                "value"   => array('mega-banner2','mega-banner','home19-2','home19','home19-service','home18-2','home18','home17-3','home17','home17-2','home17-service','home12-service','home12-service2','home12','home11','home7-3','style1','style2','style3','home7','product-cat','home4','home4-2','home7-2','home7-image'),
                )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Title",'fashionstore'),
            "param_name" => "title",
            "dependency"    => array(
                "element"   => 'style',
                "value"   => array('home19-2','home19','home19-service','home17','home17-2','home17-service','home12-service','home12-service2','home12','home11','home7-3','style1','style2','style3','product-cat','home4','home4-2'),
                )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Description",'fashionstore'),
            "param_name" => "des",
            "dependency"    => array(
                "element"   => 'style',
                "value"   => array('home19','home19-service','home17-service','home12-service','home12-service2','style1','style2','style3','home4','home4-2'),
                )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Link",'fashionstore'),
            "param_name" => "link",
            "dependency"    => array(
                "element"   => 'style',
                "value"   => array('home19-2','home19','home19-service','home18','home12-service','home12-service2','home11','home7-3','style1','style2','style3','home7-2','home7-image'),
                )
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Info Position",'fashionstore'),
            "param_name" => "info_pos",
            "value"     => array(
                esc_html__("Bottom",'fashionstore')   => 'pst-bottom',
                esc_html__("Top",'fashionstore')   => 'pst-top',
                esc_html__("Left Middle",'fashionstore')   => 'pst-left-middle',
                esc_html__("Right Middle",'fashionstore')   => 'pst-right-middle',
                esc_html__("Center Middle",'fashionstore')   => 'pst-center-middle',
                ),
            "dependency"    => array(
                "element"   => 'style',
                "value"   => array('home19'),
                )
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Info Color",'fashionstore'),
            "param_name" => "info_color",
            "dependency"    => array(
                "element"   => 'style',
                "value"     => array('home19'),
                )
        ),       
        array(
            'type'        => 'vc_link',
            'heading'     => esc_html__( 'Link Banner', 'fashionstore' ),
            'param_name'  => 'view_link',
            "dependency"    => array(
                "element"   => 'style',
                "value"   => array('mega-banner2','mega-banner','home18-2','home18-gallery','home17-3','home17','home17-2','home17-service','home12','product-cat','home4','home4-2','home7'),
                )
        ), 
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => esc_html__("Content",'fashionstore'),
            "param_name" => "content",
            "dependency"    => array(
                "element"   => 'style',
                "value"   => array('mega-banner2','mega-banner','home18-2','home18-gallery','home18','home17-3','home7-3','home7','home7-slider','home7-2','home7-image'),
                )
        ),
    )
));