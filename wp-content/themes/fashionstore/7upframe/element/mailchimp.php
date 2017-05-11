<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 26/12/15
 * Time: 10:00 AM
 */

if(!function_exists('sv_vc_mailchimp'))
{
    function sv_vc_mailchimp($attr)
    {
        $html = $bg_class = '';
        extract(shortcode_atts(array(
            'style'         => 'newsletter-form',
            'title'         => '',
            'des'           => '',
            'placeholder'   => '',
            'submit'        => '',
            'form_id'       => '',
        ),$attr));
        $form_html = apply_filters('sv_remove_autofill',do_shortcode('[mc4wp_form id="'.$form_id.'"]'));
        switch ($style) {
            case 'newsletter9 newsletter17':
                $html .=    '<div class="'.esc_attr($style).' sv-mailchimp-form" data-placeholder="'.$placeholder.'" data-submit="'.$submit.'">
                                <h2 class="title-footer9">'.esc_html($title).'</h2>
                                '.$form_html.'
                            </div>';
                break;

            case 'newsletter-form7':
                $html .=    '<div class="'.esc_attr($style).' sv-mailchimp-form" data-placeholder="'.$placeholder.'" data-submit="'.$submit.'">
                                <h2 class="title-footer7">'.esc_html($title).'</h2>
                                '.$form_html.'
                                <p>'.esc_html($des).'</p>
                            </div>';
                break;
            
            default:
                $html .=    '<div class="'.esc_attr($style).' sv-mailchimp-form" data-placeholder="'.$placeholder.'" data-submit="'.$submit.'">
                                <label>'.esc_html($title).'</label>
                                '.$form_html.'
                            </div>';
                break;
        }        
        return $html;
    }
}

stp_reg_shortcode('sv_mailchimp','sv_vc_mailchimp');

vc_map( array(
    "name"      => esc_html__("SV MailChimp", 'fashionstore'),
    "base"      => "sv_mailchimp",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            'holder'      => 'div',
            "heading" => esc_html__("Style",'fashionstore'),
            "param_name" => "style",
            "value"     => array(
                esc_html__("Home 2",'fashionstore')     => 'newsletter-form',
                esc_html__("Home 4",'fashionstore')     => 'newsletter-form4',
                esc_html__("Home 7",'fashionstore')     => 'newsletter-form7',
                esc_html__("Home 10",'fashionstore')     => 'newsletter-form newsletter-form10',
                esc_html__("Home 11",'fashionstore')     => 'newsletter-form newsletter-form11',
                esc_html__("Home 17",'fashionstore')     => 'newsletter9 newsletter17',
                esc_html__("Home 18",'fashionstore')     => 'newsletter newsletter18',
                esc_html__("Home 19",'fashionstore')     => 'newsletter-form newsletter-form19',                
                )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Form ID",'fashionstore'),
            "param_name" => "form_id",
        ),
        array(
            "type" => "textfield",
            'holder'      => 'div',
            "heading" => esc_html__("Title",'fashionstore'),
            "param_name" => "title",
        ),
        array(
            "type" => "textfield",
            'holder'      => 'div',
            "heading" => esc_html__("Description",'fashionstore'),
            "param_name" => "des",
            "dependency"     => array(
                "element"   => 'style',
                "value"   => 'newsletter-form7',
                )
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
    )
));