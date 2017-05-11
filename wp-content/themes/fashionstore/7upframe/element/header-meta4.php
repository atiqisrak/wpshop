<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */
// Start at 16/6/2016
if(!function_exists('s7upf_vc_header_meta4'))
{
    function s7upf_vc_header_meta4($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'style'             => 'list-cart-search4',
            'check_list'        => '',
            'ac_icon'           => 'fa-user',
            'cart_icon'         => 'fa-opencart',
            'account_content'   => '',
            'placeholder'       => '',
        ),$attr));
        $check_array = explode(',', $check_list);
        $html .=    '<ul class="'.esc_attr($style).' list-inline">';
        if(in_array('search', $check_array)){
            $search_val = get_search_query();
            if(!empty($search_val)) $search_val = $placeholder;
            ob_start();?>
                <form action="<?php echo esc_url( home_url( '/'  ) ); ?>">
                    <input name="s" type="text" value="<?php echo esc_attr($search_val);?>" placeholder="<?php echo esc_attr($placeholder)?>">
                    <input type="submit" value="">
                    <input type="hidden" name="post_type" value="product" />
                </form>
            <?php
            $html .=        '<li>
                                <div class="search-form4">
                                    '.ob_get_clean().'
                                </div>
                            </li>';
        }
        if(in_array('account', $check_array)){
            $html .=        '<li>
                                <div class="my-account style4">
                                    <a href="#" class="my-account-link"><i class="fa '.esc_attr($ac_icon).'" aria-hidden="true"></i></a>';
            if(!empty($account_content)){
                $html .=            '<ul class="list-account list-unstyled">';
                parse_str(urldecode($account_content), $account_list);
                foreach ($account_list as $value) {
                    $icon_html = '';
                    if(!empty($value['icon'])){
                        if(strpos($value['icon'],'lnr') !== false) $icon_html = '<span class="lnr '.$value['icon'].'"></span>';
                        else $icon_html =   '<i class="fa '.$value['icon'].'"></i>';
                    }
                    $html .=            '<li><a href="'.esc_url($value['url']).'">'.$icon_html.' '.$value['title'].'</a></li>';
                }
                $html .=            '</ul>';
            }
            $html .=            '</div>
                            </li>';
        }    
        if(in_array('cart', $check_array)){
            $html .=    '<li><div class="mini-cart style4">
                            <a class="mini-cart-link" href="'.esc_url(WC()->cart->get_cart_url()).'">
                                <span class="mini-cart-icon"><i class="fa '.esc_attr($cart_icon).'" aria-hidden="true"></i></span>
                                <span class="mini-cart-number"><span class="cart-item-count">0</span></span>
                            </a>';
            $html .=        '<div class="mini-cart-content content-mini-cart">                                    
                                <div class="mini-cart-main-content">'.s7upf_mini_cart().'</div>                    
                                <input id="num-decimal" type="hidden" value="'.get_option("woocommerce_price_num_decimals").'">
                                <input id="currency" type="hidden" value=".'.get_option("woocommerce_currency").'">
                            </div>';
            $html .=    '</div></li>';
        }
        $html .=        '</ul>';
        return $html;
    }
}

stp_reg_shortcode('sv_header_meta4','s7upf_vc_header_meta4');

vc_map( array(
    "name"      => esc_html__("SV Header meta 4", 'fashionstore'),
    "base"      => "sv_header_meta4",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => esc_html__("Style",'fashionstore'),
            "param_name" => "style",
            "value"     => array(
                esc_html__("Default",'fashionstore')   => 'list-cart-search4',
                )
        ),
        array(
            "type" => "checkbox",
            "holder" => "div",
            "heading" => esc_html__("Box Display",'fashionstore'),
            "param_name" => "check_list",
            "value"     => array(
                esc_html__("Account",'fashionstore')   => 'account',
                esc_html__("Search",'fashionstore')    => 'search',
                esc_html__("Mini Cart",'fashionstore') => 'cart',
                )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Account Icon",'fashionstore'),
            "param_name" => "ac_icon",
            'edit_field_class'=>'vc_col-sm-12 vc_column sv_iconpicker',
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Cart Icon",'fashionstore'),
            "param_name" => "cart_icon",
            'edit_field_class'=>'vc_col-sm-12 vc_column sv_iconpicker',
        ),        
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Place holder input",'fashionstore'),
            "param_name" => "placeholder",
        ),
        array(
            "type" => "add_icon_link",
            "heading" => esc_html__("Account Content",'fashionstore'),
            "param_name" => "account_content",
        ),
    )
));