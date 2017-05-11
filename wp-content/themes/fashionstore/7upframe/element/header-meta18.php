<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */
// Start at 16/6/2016
if(!function_exists('s7upf_vc_header_meta18'))
{
    function s7upf_vc_header_meta18($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'check_list'        => '',
            'language_text'     => '',
            'language_content'  => '',
            'currency_text'     => '',
            'currency_content'  => '',
            'ac_icon'           => 'fa-user',
            'cart_icon'         => 'fa-opencart',
            'account_content'   => '',
            'placeholder'       => '',
        ),$attr));
        $check_array = explode(',', $check_list);
        $html .=    '<div class="info-total18">';
        if(in_array('language', $check_array)){
            $html .=    '<div class="language-box">
                            <a class="language-link" href="#">'.esc_html($language_text).'<i class="fa fa-angle-down" aria-hidden="true"></i></a>';
            if(!empty($language_content)){
                $html .=    '<ul class="language-list">';
                parse_str(urldecode($language_content), $language_list);
                foreach ($language_list as $value) {                        
                    $html .=    '<li><a href="'.esc_url($value['link']).'">'.$value['title'].'</a></li>';
                }
                $html .=    '</ul>';
            }
            $html .=    '</div>';
        }
        if(in_array('currency', $check_array)){
            $html .=    '<div class="currency-box">
                            <a class="currency-link" href="#">'.esc_html($language_text).'<i class="fa fa-angle-down" aria-hidden="true"></i></a>';
            if(!empty($currency_content)){
                $html .=    '<ul class="currency-list">';
                parse_str(urldecode($currency_content), $currency_list);
                foreach ($currency_list as $value) {                        
                    $html .=    '<li><a href="'.esc_url($value['link']).'">'.$value['title'].'</a></li>';
                }
                $html .=    '</ul>';
            }
            $html .=    '</div>';
        }
        if(in_array('account', $check_array)){
            $html .=        '<div class="my-account my-account18">
                                <a href="#" class="my-account-link"><i class="fa '.esc_attr($ac_icon).'" aria-hidden="true"></i></a>';
            if(!empty($account_content)){
                $html .=        '<ul class="list-account list-unstyled">';
                parse_str(urldecode($account_content), $account_list);
                foreach ($account_list as $value) {
                    $icon_html = '';
                    if(!empty($value['icon'])){
                        if(strpos($value['icon'],'lnr') !== false) $icon_html = '<span class="lnr '.$value['icon'].'"></span>';
                        else $icon_html =   '<i class="fa '.$value['icon'].'"></i>';
                    }
                    $html .=        '<li><a href="'.esc_url($value['url']).'">'.$icon_html.' '.$value['title'].'</a></li>';
                }
                $html .=        '</ul>';
            }
            $html .=        '</div>';
        }
        if(in_array('search', $check_array)){
            $search_val = get_search_query();
            if(!empty($search_val)) $search_val = $placeholder;
            ob_start();?>
                <form class="search-form-hover" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
                    <input name="s" type="text" value="<?php echo esc_attr($search_val);?>" placeholder="<?php echo esc_attr($placeholder)?>">
                    <input type="submit" value="">
                    <input type="hidden" name="post_type" value="product" />
                </form>
            <?php
            $html .=        '<div class="search-hover search-hover18">
                                <a class="search-link" href="#"><i aria-hidden="true" class="fa fa-search"></i></a>
                                '.ob_get_clean().'
                            </div>';
        }
        $html .=        '</div>';
        return $html;
    }
}

stp_reg_shortcode('sv_header_meta18','s7upf_vc_header_meta18');

vc_map( array(
    "name"      => esc_html__("SV Header meta 18", 'fashionstore'),
    "base"      => "sv_header_meta18",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(        
        array(
            "type" => "checkbox",
            "holder" => "div",
            "heading" => esc_html__("Box Display",'fashionstore'),
            "param_name" => "check_list",
            "value"     => array(
                esc_html__("Language",'fashionstore')   => 'language',
                esc_html__("Currency",'fashionstore')   => 'currency',
                esc_html__("Account",'fashionstore')   => 'account',
                esc_html__("Search",'fashionstore')    => 'search',
                )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Language text",'fashionstore'),
            "param_name" => "language_text",
        ),
        array(
            "type" => "add_text_link",
            "heading" => esc_html__("Language Content",'fashionstore'),
            "param_name" => "language_content",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Currency text",'fashionstore'),
            "param_name" => "currency_text",
        ),
        array(
            "type" => "add_text_link",
            "heading" => esc_html__("Currency Content",'fashionstore'),
            "param_name" => "currency_content",
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Account Icon",'fashionstore'),
            "param_name" => "ac_icon",
            'edit_field_class'=>'vc_col-sm-12 vc_column sv_iconpicker',
        ), 
        array(
            "type" => "add_icon_link",
            "heading" => esc_html__("Account Content",'fashionstore'),
            "param_name" => "account_content",
        ),       
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Place holder input",'fashionstore'),
            "param_name" => "placeholder",
        ),
    )
));