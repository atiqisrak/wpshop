<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */
// Start at 16/6/2016
if(!function_exists('s7upf_vc_icon_box'))
{
    function s7upf_vc_icon_box($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'style'     => 'home-2',
            'icon'      => '',
            'title'     => '',
            'des2'    => '',
            'des'       => '',
            'link'      => '',
        ),$attr));
        switch ($style) {
            case 'style2':
                
                break;
            
            default:
                $html .=    '<div class="item-contact-box">
                                <a href="'.esc_url($link).'" class="contact-icon"><i class="fa '.esc_attr($icon).'" aria-hidden="true"></i></a>
                                <h2 class="contact-title">'.esc_html($title).'</h2>
                                <p class="contact-info">'.esc_html($des).'<br>'.esc_html($des2).'</p>
                            </div>';
                break;
        }
        return $html;
    }
}

stp_reg_shortcode('sv_icon_box','s7upf_vc_icon_box');

vc_map( array(
    "name"      => esc_html__("SV Icon Box", 'fashionstore'),
    "base"      => "sv_icon_box",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style",'fashionstore'),
            "param_name" => "style",
            "value"     => array(
                esc_html__("Home 2",'fashionstore') => 'home-2',
                )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Icon",'fashionstore'),
            "param_name" => "icon",            
            'edit_field_class'=>'vc_col-sm-12 vc_column sv_iconpicker',
        ),
        array(
            "type" => "textfield",
            "holder" => "h3",
            "heading" => esc_html__("Title",'fashionstore'),
            "param_name" => "title",
        ),
        array(
            "type" => "textfield",
            "holder" => "p",
            "heading" => esc_html__("Description",'fashionstore'),
            "param_name" => "des",
        ),
        array(
            "type" => "textfield",
            "holder" => "p",
            "heading" => esc_html__("Description 2",'fashionstore'),
            "param_name" => "des2",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Link",'fashionstore'),
            "param_name" => "link",
        )
    )
));