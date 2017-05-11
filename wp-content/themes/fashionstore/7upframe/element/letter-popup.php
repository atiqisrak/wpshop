<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_letter_popup'))
{
    function s7upf_vc_letter_popup($attr,$content = false)
    {
        $html = $icon_html = '';
        extract(shortcode_atts(array(
            'title'             => '',
            'title_last'        => '',
            'des'               => '',
            'image'             => '',
            'form_id'           => '',
            'placeholder'       => '',
            'submit'            => '',
            'social_title'      => '',
            'social_list'       => '',
        ),$attr));
            parse_str( urldecode( $social_list ), $data);
            if(is_array($data)){
                foreach ($data as $key => $value) {
                    $url = '#';
                    if(isset($value['url'])) $url = $value['url'];
                    $icon_html .= '<li><a href="'.esc_url($url).'"><i class="fa '.$value['social'].'" aria-hidden="true"></i></a></li>';
                }
            }
            if(!empty($image)) $image = S7upf_Assets::build_css('background-image: url('.wp_get_attachment_image_url($image,'full').');');
            $form_html = apply_filters('sv_remove_autofill',do_shortcode('[mc4wp_form id="'.$form_id.'"]'));
            $html .=    '<div  id="boxes-content">
                            <div class="window" id="dialog">
                                <div class="window-popup '.esc_attr($image).'"> 
                                    <a href="#" class="close-popup"><i class="fa fa-times" aria-hidden="true"></i> '.esc_html__("Close","fashionstore").'</a>
                                    <div class="content-popup">
                                        <h2>'.esc_html($title).' <strong>'.esc_html($title_last).'</strong></h2>';
            if(!empty($des)) $html .=    '<p>'.esc_html($des).'</p>';
            $html .=                    '<div class="sv-mailchimp-form" data-placeholder="'.$placeholder.'" data-submit="'.$submit.'">
                                            '.$form_html.'
                                        </div>';
            $html .=                '</div>
                                    <div class="social-popup">';
            $html .=    '<h2>'.esc_html($social_title).'</h2>';
            $html .=                    '<ul>';
            $html .=                        $icon_html;
            $html .=                    '</ul>
                                    </div>
                                </div>
                            </div>
                            <div id="mask" ></div>
                        </div>';
        return $html;
    }
}

stp_reg_shortcode('sv_letter_popup','s7upf_vc_letter_popup');

vc_map( array(
    "name"      => esc_html__("SV Letter Popup", 'fashionstore'),
    "base"      => "sv_letter_popup",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "textfield",
            "holder"    => 'h3',
            "heading" => esc_html__("Title",'fashionstore'),
            "param_name" => "title",
        ),
        array(
            "type" => "textfield",
            "holder"    => 'h3',
            "heading" => esc_html__("Title Last",'fashionstore'),
            "param_name" => "title_last",
        ),
        array(
            "type" => "textfield",
            "holder"    => 'p',
            "heading" => esc_html__("Description",'fashionstore'),
            "param_name" => "des",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Form ID",'fashionstore'),
            "param_name" => "form_id",
        ),        
        array(
            "type" => "textfield",
            "heading" => esc_html__("Placeholder Input",'fashionstore'),
            "param_name" => "placeholder",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Submit Label",'fashionstore'),
            "param_name" => "submit",
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Image Background",'fashionstore'),
            "param_name" => "image",
        ),
        array(
            "type" => "textfield",
            "holder"    => 'h3',
            "heading" => esc_html__("Title Social",'fashionstore'),
            "param_name" => "social_title",
        ),
        array(
            "type" => "add_social",
            "heading" => esc_html__("Add Social List",'fashionstore'),
            "param_name" => "social_list",
        )
    )
));