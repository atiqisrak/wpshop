<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_video'))
{
    function s7upf_vc_video($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'image'      => '',
            'link'       => '',
            'width'      => '870',
            'height'     => '400',
        ),$attr));
        if(!empty($link)){
            $html .=    '<video class="video-intro video-js vjs-default-skin" controls preload="none" width="870" height="400" poster="'.wp_get_attachment_image_url($image,'full').'" data-setup="{}">
                            <source src="'.esc_url($link).'" type="video/mp4"/>
                        </video>';
        }        
        return $html;
    }
}

stp_reg_shortcode('sv_video','s7upf_vc_video');

vc_map( array(
    "name"      => esc_html__("SV Video", 'fashionstore'),
    "base"      => "sv_video",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Image Preload",'fashionstore'),
            "param_name" => "image",
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Link Video",'fashionstore'),
            "param_name" => "link",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Video Width",'fashionstore'),
            "param_name" => "width",
            "description"   => esc_html__("Default is 870.",'fashionstore'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Video Height",'fashionstore'),
            "param_name" => "height",
            "description"   => esc_html__("Default is 400.",'fashionstore'),
        ),
    )
));