<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */
if(!function_exists('s7upf_vc_payment'))
{
    function s7upf_vc_payment($attr, $content = false)
    {
        $html = $icon_html = '';
        extract(shortcode_atts(array(
            'style'         => '',
            'list'          => '',
        ),$attr));
		parse_str( urldecode( $list ), $data);        
        switch ($style) {
            case 'brand-home4':
               
                break;

            default:
                if(is_array($data)){
                    foreach ($data as $key => $value) {
                        $icon_html .= '<a href="'.esc_url($value['link']).'">'.wp_get_attachment_image($value['image'],'full').'</a>';
                    }
                }
                $html .=    '<div class="paymment-method '.esc_attr($style).'">';
                $html .=        $icon_html;
                $html .=    '</div>';
                break;
        }
          
		return  $html;
    }
}

stp_reg_shortcode('sv_payment','s7upf_vc_payment');


vc_map( array(
    "name"      => esc_html__("SV Image link", 'fashionstore'),
    "base"      => "sv_payment",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style",'fashionstore'),
            "param_name" => "style",
            "value"     => array(
                esc_html__("Payment footer",'fashionstore')    => '',
                esc_html__("Payment footer 7",'fashionstore')    => 'payment-method7',
                esc_html__("Payment footer 17",'fashionstore')    => 'payment payment17',
                )
        ),
		array(
            "type" => "add_brand",
            "heading" => esc_html__("Add Image List",'fashionstore'),
            "param_name" => "list",
        )
    )
));