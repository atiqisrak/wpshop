<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_intro_box'))
{
    function s7upf_vc_intro_box($attr)
    {
        $html = $html_thumb = $html_info = '';
        extract(shortcode_atts(array(
            'style'      => 'style1',
            'image'      => '',
            'title'      => '',
            'title2'     => '',
            'des'        => '',
            'link'       => '',
        ),$attr));
        $html_thumb =   '<div class="collection-thumb">
                            <a href="'.esc_url($link).'" class="collection-thumb-link">'.wp_get_attachment_image($image,'full').'</a>
                            <a href="'.esc_url($link).'" class="shopnow">'.esc_html__("shop now","fashionstore").'</a>
                        </div>';
        $html_info =    '<h3>'.esc_html($title).'</h3>
                        <h2><a href="'.esc_url($link).'">'.esc_html($title2).'</a></h2>
                        <p>'.esc_textarea($des).'</p>
                        <a href="'.esc_url($link).'" class="btn-plus shopnow">'.esc_html__("shop now","fashionstore").'</a>';
        switch ($style) {
            case 'style4':
                $html .=    '<div class="list-collection">
                                <div class="item-collection style4">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="collection-info text-right">
                                                '.$html_info.'
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            '.$html_thumb.'
                                        </div>
                                    </div>
                                </div>
                            </div>';
                break;

            case 'style3':
                $html .=    '<div class="list-collection">
                                <div class="item-collection style3">
                                    <div class="row">
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            '.$html_thumb.'
                                        </div>
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <div class="collection-info text-left">
                                                '.$html_info.'
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                break;

            case 'style2':
                $html .=    '<div class="list-collection">
                                <div class="item-collection style2">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-6">
                                            <div class="collection-info text-right">
                                                '.$html_info.'
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-6">
                                            '.$html_thumb.'
                                        </div>
                                    </div>
                                </div>
                            </div>';
                break;
            
            default:
                $html .=    '<div class="list-collection">
                                <div class="item-collection style1">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            '.$html_thumb.'
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                            <div class="collection-info text-left">
                                                '.$html_info.'
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                break;
        }        
        return $html;
    }
}

stp_reg_shortcode('sv_intro_box','s7upf_vc_intro_box');

vc_map( array(
    "name"      => esc_html__("SV Intro Box", 'fashionstore'),
    "base"      => "sv_intro_box",
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
                esc_html__("Style 4",'fashionstore')   => 'style4',
                )
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Image",'fashionstore'),
            "param_name" => "image",
        ),
        array(
            "type" => "textfield",
            "holder" => "h3",
            "heading" => esc_html__("Pre Title",'fashionstore'),
            "param_name" => "title",
        ),
        array(
            "type" => "textfield",
            "holder" => "h2",
            "heading" => esc_html__("Title",'fashionstore'),
            "param_name" => "title2",
        ),
        array(
            "type" => "textarea",
            "holder" => "p",
            "heading" => esc_html__("Description",'fashionstore'),
            "param_name" => "des",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Link",'fashionstore'),
            "param_name" => "link",
        )
    )
));