<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_team'))
{
    function s7upf_vc_team($attr)
    {
        $html = $icon_html = $c_class = '';
        extract(shortcode_atts(array(
            'image'      => '',
            'name'       => '',
            'pos'        => '',
            'des'        => '',
            'list'       => '',
            'link'       => '',
            'color'      => '',
        ),$attr));
        if(!empty($color)) $c_class = S7upf_Assets::build_css('color:'.$color.';');
        parse_str( urldecode( $list ), $data);
        if(is_array($data)){
            foreach ($data as $key => $value) {
                $url = '#';
                if(isset($value['url'])) $url = $value['url'];
                $icon_html .= '<a href="'.esc_url($url).'"><i class="fa '.$value['social'].'"></i></a>';
            }
        }
        $html .=    '<div class="item-designer clearfix">
                        <div class="designer-thumb">
                            <div class="zoom-image"><a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a></div>
                            <div class="social-designer">
                                '.$icon_html.'
                            </div>
                        </div>
                        <div class="design-info">
                            <h3><a href="'.esc_url($link).'">'.esc_html($name).'</a></h3>
                            <span class="'.esc_attr($c_class).'">'.esc_html($pos).'</span>
                            <p>'.esc_html($des).'</p>
                        </div>
                    </div>';
        return $html;
    }
}

stp_reg_shortcode('vc_team','s7upf_vc_team');

vc_map( array(
    "name"      => esc_html__("SV Team", 'fashionstore'),
    "base"      => "vc_team",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Avatar",'fashionstore'),
            "param_name" => "image",
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Name",'fashionstore'),
            "param_name" => "name",
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Position",'fashionstore'),
            "param_name" => "pos",
        ),
        array(
            "type" => "textarea",
            "holder" => "div",
            "heading" => esc_html__("Description",'fashionstore'),
            "param_name" => "des",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Link",'fashionstore'),
            "param_name" => "link",
        ),
        array(
            "type" => "add_social",
            "heading" => esc_html__("Add Social List",'fashionstore'),
            "param_name" => "list",
        ),
        array(
            "type" => "colorpicker",
            "heading" => esc_html__("Position Color",'fashionstore'),
            "param_name" => "color",
        ),
    )
));