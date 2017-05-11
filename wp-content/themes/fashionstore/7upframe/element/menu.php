<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 18/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_menu'))
{
    function s7upf_vc_menu($attr,$content = false)
    {
        $html = '';
        extract(shortcode_atts(array(
            'style'     => 'main-nav1',
            'menu'      => '',
        ),$attr));
        if(!empty($menu)){
            $html .= '<nav class="main-nav '.esc_attr($style).'">';
                ob_start();
                wp_nav_menu( array(
                    'menu' => $menu,
                    'container'=>false,
                    'walker'=>new S7upf_Walker_Nav_Menu(),
                ));
            $html .=    @ob_get_clean();
            $html .=    '<a class="toggle-mobile-menu" href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>';
            $html .= '</nav>';
        }
        else{
            $html .= '<nav class="main-nav '.esc_attr($style).'">';
                ob_start();
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'=>false,
                    'walker'=>new S7upf_Walker_Nav_Menu(),
                ));
            $html .= @ob_get_clean();
            $html .=    '<a class="toggle-mobile-menu" href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>';
            $html .= '</nav>';
        }        
        return $html;
    }
}

stp_reg_shortcode('sv_menu','s7upf_vc_menu');

vc_map( array(
    "name"      => esc_html__("SV Menu", 'fashionstore'),
    "base"      => "sv_menu",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style",'fashionstore'),
            "param_name" => "style",
            "value"     => array(
                esc_html__("Home 1",'fashionstore')   => 'main-nav1',
                esc_html__("Home 2",'fashionstore')   => 'main-nav2',
                esc_html__("Home 4",'fashionstore')   => 'main-nav4',
                esc_html__("Home 7",'fashionstore')   => 'main-nav7',
                esc_html__("Home 10",'fashionstore')   => 'main-nav10',
                esc_html__("Home 11",'fashionstore')   => 'main-nav3',
                esc_html__("Home 12",'fashionstore')   => 'main-nav12',
                esc_html__("Home 17",'fashionstore')   => 'main-nav17',
                esc_html__("Home 18",'fashionstore')   => 'main-nav18',
                esc_html__("Home 19",'fashionstore')   => 'main-nav19',
                )
        ),
        array(
            'type' => 'dropdown',
            'holder' => 'div',
            'heading' => esc_html__( 'Menu name', 'fashionstore' ),
            'param_name' => 'menu',
            'value' => s7upf_list_menu_name(),
            'description' => esc_html__( 'Select Menu name to display', 'fashionstore' )
        ),
    )
));