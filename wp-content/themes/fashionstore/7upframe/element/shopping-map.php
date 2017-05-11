<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_shopping_map'))
{
    function s7upf_vc_shopping_map($attr)
    {
        $html = $brand_html = '';
        extract(shortcode_atts(array(
            'logo_img'          => '',
            'logo_link'         => '',
            'title'             => '',
            'brands'            => '',
            'brand_link'        => '',
            'image'             => '',
            'image_link'        => '',
            'title1'            => '',
            'price1'            => '',
            'link1'             => '',
            'title2'            => '',
            'price2'            => '',
            'link2'             => '',
            'title3'            => '',
            'price3'            => '',
            'link3'             => '',
            'title4'            => '',
            'price4'            => '',
            'link4'             => '',
            'title5'            => '',
            'price5'            => '',
            'link5'             => '',
        ),$attr));
        parse_str( urldecode( $brands ), $data);
        if(is_array($data)){
            foreach ($data as $key => $value) {
                $brand_html .= '<a href="'.esc_url($value['link']).'">'.wp_get_attachment_image($value['image'],'full').'</a>';
            }
        }
        $html .=    '<div class="body-point">
                        <div class="fashion-brand">
                            <div class="inner-fashion-brand">
                                <div class="fashion-logo">
                                    <a href="'.esc_url($logo_link).'">'.wp_get_attachment_image($logo_img,'full').'</a>
                                </div>
                                <p>'.esc_html($title).'</p>
                                <div class="list-brand18">
                                    '.$brand_html.'
                                </div>
                                <a href="'.esc_url($brand_link).'" class="view-brand">'.esc_html__("View Brands","fashionstore").'</a>
                            </div>
                        </div>
                        <div class="content-body-point">
                            <div class="body-point-thumb">
                                <a href="'.esc_url($image_link).'">'.wp_get_attachment_image($image,'full').'</a>
                            </div>
                            <div class="body-point-info">
                                <div class="bdp-element bdp-glass">
                                    <h2>'.esc_html($title1).'</h2>
                                    <p>'.esc_html($price1).'</p>
                                    <a href="'.esc_url($link1).'" class="shopnow">'.esc_html__("Shop now","fashionstore").'<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                </div>  
                                <div class="bdp-element bdp-shirt">
                                    <h2>'.esc_html($title2).'</h2>
                                    <p>'.esc_html($price2).'</p>
                                    <a href="'.esc_url($link2).'" class="shopnow">'.esc_html__("Shop now","fashionstore").'<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                </div>  
                                <div class="bdp-element bdp-blaze">
                                    <h2>'.esc_html($title3).'</h2>
                                    <p>'.esc_html($price3).'</p>
                                    <a href="'.esc_url($link3).'" class="shopnow">'.esc_html__("Shop now","fashionstore").'<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                </div>  
                                <div class="bdp-element bdp-pant">
                                    <h2>'.esc_html($title4).'</h2>
                                    <p>'.esc_html($price4).'</p>
                                    <a href="'.esc_url($link4).'" class="shopnow">'.esc_html__("Shop now","fashionstore").'<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                </div>  
                                <div class="bdp-element bdp-shoe">
                                    <h2>'.esc_html($title5).'</h2>
                                    <p>'.esc_html($price5).'</p>
                                    <a href="'.esc_url($link5).'" class="shopnow">'.esc_html__("Shop now","fashionstore").'<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                                </div>  
                            </div>
                        </div>
                    </div>';
        
        return $html;
    }
}

stp_reg_shortcode('sv_shopping_map','s7upf_vc_shopping_map');

vc_map( array(
    "name"      => esc_html__("SV Shopping Map", 'fashionstore'),
    "base"      => "sv_shopping_map",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Logo image",'fashionstore'),
            "param_name" => "logo_img",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Logo Link",'fashionstore'),
            "param_name" => "logo_link",
        ),
        array(
            "type" => "textfield",
            "holder" => "h3",
            "heading" => esc_html__("Title",'fashionstore'),
            "param_name" => "title",
        ),
        array(
            "type" => "attach_image",
            "holder" => "div",
            "heading" => esc_html__("Main Image",'fashionstore'),
            "param_name" => "image",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Main Image Link",'fashionstore'),
            "param_name" => "image_link",
        ),
        array(
            "type" => "add_brand",
            "heading" => esc_html__("Brands",'fashionstore'),
            "param_name" => "brands",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Brands Link",'fashionstore'),
            "param_name" => "brand_link",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title 1",'fashionstore'),
            "param_name" => "title1",
            "group" => esc_html__("Point Settings",'fashionstore'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Price 1",'fashionstore'),
            "param_name" => "price1",
            "group" => esc_html__("Point Settings",'fashionstore'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Link 1",'fashionstore'),
            "param_name" => "link1",
            "group" => esc_html__("Point Settings",'fashionstore'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title 2",'fashionstore'),
            "param_name" => "title2",
            "group" => esc_html__("Point Settings",'fashionstore'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Price 2",'fashionstore'),
            "param_name" => "price2",
            "group" => esc_html__("Point Settings",'fashionstore'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Link 2",'fashionstore'),
            "param_name" => "link2",
            "group" => esc_html__("Point Settings",'fashionstore'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title 3",'fashionstore'),
            "param_name" => "title3",
            "group" => esc_html__("Point Settings",'fashionstore'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Price 3",'fashionstore'),
            "param_name" => "price3",
            "group" => esc_html__("Point Settings",'fashionstore'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Link 3",'fashionstore'),
            "param_name" => "link3",
            "group" => esc_html__("Point Settings",'fashionstore'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title 4",'fashionstore'),
            "param_name" => "title4",
            "group" => esc_html__("Point Settings",'fashionstore'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Price 4",'fashionstore'),
            "param_name" => "price4",
            "group" => esc_html__("Point Settings",'fashionstore'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Link 4",'fashionstore'),
            "param_name" => "link4",
            "group" => esc_html__("Point Settings",'fashionstore'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title 5",'fashionstore'),
            "param_name" => "title5",
            "group" => esc_html__("Point Settings",'fashionstore'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Price 5",'fashionstore'),
            "param_name" => "price5",
            "group" => esc_html__("Point Settings",'fashionstore'),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Link 5",'fashionstore'),
            "param_name" => "link5",
            "group" => esc_html__("Point Settings",'fashionstore'),
        ),
    )
));