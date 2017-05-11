<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */
if(class_exists("woocommerce")){
    if(!function_exists('s7upf_vc_mini_cart'))
    {
        function s7upf_vc_mini_cart($attr,$content = false)
        {
            $html = $header_cart_html = $info_content = '';
            extract(shortcode_atts(array(
                'style'         => 'mini-cart17',
            ),$attr));
            switch ($style) {
                case 'mini-cart2':
                
                    break;
                
                default:
                    $header_cart_html = '<a href="'.esc_url(WC()->cart->get_cart_url()).'" class="mini-cart-link">
                                            <span class="mini-cart-icon"><i class="fa fa-shopping-bag" aria-hidden="true"></i>'.esc_html__("Shopping Cart","fashionstore").'</span>
                                            <span class="mini-cart-number cart-item-count">0</span>
                                        </a>';
                    $html .=    '<div class="mini-cart '.$style.'">
                                    '.$header_cart_html.'
                                    <div class="mini-cart-content content-mini-cart">                                    
                                        <div class="mini-cart-main-content">'.s7upf_mini_cart().'</div>                    
                                        <input id="num-decimal" type="hidden" value="'.get_option("woocommerce_price_num_decimals").'">
                                        <input id="currency" type="hidden" value=".'.get_option("woocommerce_currency").'">
                                    </div>
                                </div>';
                    break;
            }
            return $html;
        }
    }

    stp_reg_shortcode('s7upf_mini_cart','s7upf_vc_mini_cart');

    vc_map( array(
        "name"      => esc_html__("SV Mini Cart", 'fashionstore'),
        "base"      => "s7upf_mini_cart",
        "icon"      => "icon-st",
        "category"  => '7Up-theme',
        "params"    => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Style",'fashionstore'),
                "param_name" => "style",
                "value"     => array(
                    esc_html__("Default",'fashionstore')   => 'mini-cart17',
                    )
            ),            
        )
    ));
}