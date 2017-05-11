<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_social'))
{
    function s7upf_vc_social($attr, $content = false)
    {
        $html = $icon_html = '';
        extract(shortcode_atts(array(
            'style'         => 'social-footer',
            'title'          => '',
            'list'          => '',
            'align'         => 'text-left',
        ),$attr));
		parse_str( urldecode( $list ), $data);
        if(is_array($data)){
            foreach ($data as $key => $value) {
                $url = '#';
                if(isset($value['url'])) $url = $value['url'];
                $icon_html .= '<a href="'.esc_url($url).'"><i class="fa '.$value['social'].'"></i></a>';
            }
        }
        $html .=    '<div class="block-social '.$style.' '.$align.'">';
        if(!empty($title)) $html .= '<h2 class="title-footer">'.esc_html($title).'</h2>';
        $html .=        $icon_html;
        $html .=    '</div>';   
		return  $html;
    }
}

stp_reg_shortcode('sv_social','s7upf_vc_social');


vc_map( array(
    "name"      => esc_html__("SV Social", 'fashionstore'),
    "base"      => "sv_social",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            'type'        => 'dropdown',
            'heading'     => esc_html__( 'Style', 'fashionstore' ),
            'param_name'  => 'style',
            'value'       => array(
                esc_html__( 'Footer', 'fashionstore' )   => 'social-footer',
                esc_html__( 'Footer 4', 'fashionstore' )   => 'social-footer4',
                esc_html__( 'Footer 7', 'fashionstore' )   => 'social-footer7',
                esc_html__( 'Footer 17', 'fashionstore' )   => 'social-footer9 social-footer17',
                )
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Title', 'fashionstore' ),
            'param_name'  => 'title',
        ),
        array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Align', 'fashionstore' ),
			'value' => array(
				esc_html__( 'Align Left', 'fashionstore' ) => 'text-left',
				esc_html__( 'Align Center', 'fashionstore' ) => 'text-center',
				esc_html__( 'Align Right', 'fashionstore' ) => 'text-right',
			),
			'param_name' => 'align',
			'description' => esc_html__( 'Select social layout', 'fashionstore' ),
		),
		array(
            "type" => "add_social",
            "heading" => esc_html__("Add Social List",'fashionstore'),
            "param_name" => "list",
        )
    )
));