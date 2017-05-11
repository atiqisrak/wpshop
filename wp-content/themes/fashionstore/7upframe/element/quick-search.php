<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_q_search'))
{
    function s7upf_vc_q_search($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'title'      => '',
        ),$attr));
        $char = 'a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z';
        $char_array = explode(',', $char);
        $html .=    '<div class="search-alphabet">
                        <label>'.esc_html($title).'</label>
                        <a href="#">#</a>';
                        foreach ($char_array as $value) {
                            $html .= '<a href="'.get_home_url('/').'?s='.$value.'&amp;post_type=product">'.$value.'</a>';
                        }
        $html .=    '</div>'; 
        return $html;
    }
}

stp_reg_shortcode('sv_q_search','s7upf_vc_q_search');

vc_map( array(
    "name"      => esc_html__("SV Quick Search", 'fashionstore'),
    "base"      => "sv_q_search",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Title",'fashionstore'),
            "param_name" => "title",
        )
    )
));