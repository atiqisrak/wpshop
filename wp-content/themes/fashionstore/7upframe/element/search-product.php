<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_search_form'))
{
    function s7upf_vc_search_form($attr)
    {
        $html = $label_sm = '';
        extract(shortcode_atts(array(
            'style' => 'smart-search1',
            'placeholder' => '',
        ),$attr));
        ob_start();
        $search_val = get_search_query();
        if(!empty($search_val)) $search_val = $placeholder;
        switch ($style) {
            case 'home12':
                ?>
                <div class="search-hover search-hover12">
                    <a href="#" class="search-hover-icon"><i class="fa fa-search" aria-hidden="true"></i></a>
                    <div class="smart-search <?php echo esc_attr($style)?>">
                        <div class="select-category">
                            <a href="#" class="category-toggle-link"><span><?php esc_html_e("Categories","fashionstore")?></span></a>
                            <ul class="list-category-toggle list-unstyled">
                                <li class="active"><a href="#" data-filter=""><?php esc_html_e("Categories",'fashionstore')?></a></li>
                                <?php 
                                    $product_cat_list = get_terms('product_cat');
                                    if(is_array($product_cat_list) && !empty($product_cat_list)){
                                        foreach ($product_cat_list as $cat) {
                                            echo '<li><a href="#" data-filter=".'.$cat->slug.'">'.$cat->name.'</a></li>';
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                        <form class="smart-search-form smart-search-form6" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
                            <input name="s" type="text" value="<?php echo esc_attr($search_val);?>" placeholder="<?php echo esc_attr($placeholder)?>">
                            <input type="hidden" name="post_type" value="product" />
                            <input type="submit" value="">
                            <input class="cat-value" type="hidden" name="product_cat" value="" />
                        </form>
                    </div>
                </div>
                <?php
                break;

            case 'home10':
                ?>
                <div class="search-form10">
                    <form action="<?php echo esc_url( home_url( '/'  ) ); ?>">
                        <input name="s" type="text" value="<?php echo esc_attr($search_val);?>" placeholder="<?php echo esc_attr($placeholder)?>">
                        <input type="submit" value="">
                        <input type="hidden" name="post_type" value="product" />
                    </form>
                </div>
                <?php
                break;

            case 'home7':
                ?>
                <div class="search-hover search-hover7">
                    <a href="#" class="search-hover-icon"><i class="fa fa-search" aria-hidden="true"></i></a>
                    <div class="smart-search <?php echo esc_attr($style)?>">
                        <div class="select-category">
                            <a href="#" class="category-toggle-link"><span><?php esc_html_e("Categories","fashionstore")?></span></a>
                            <ul class="list-category-toggle list-unstyled">
                                <li class="active"><a href="#" data-filter=""><?php esc_html_e("Categories",'fashionstore')?></a></li>
                                <?php 
                                    $product_cat_list = get_terms('product_cat');
                                    if(is_array($product_cat_list) && !empty($product_cat_list)){
                                        foreach ($product_cat_list as $cat) {
                                            echo '<li><a href="#" data-filter=".'.$cat->slug.'">'.$cat->name.'</a></li>';
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                        <form class="smart-search-form" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
                            <input name="s" type="text" value="<?php echo esc_attr($search_val);?>" placeholder="<?php echo esc_attr($placeholder)?>">
                            <input type="hidden" name="post_type" value="product" />
                            <input type="submit" value="">
                            <input class="cat-value" type="hidden" name="product_cat" value="" />
                        </form>
                    </div>
                </div>
                <?php
                break;
            
            default:
                ?>
                <div class="smart-search <?php echo esc_attr($style)?>">
                    <div class="select-category">
                        <a href="#" class="category-toggle-link">
                            <span><?php esc_html_e("Categories","fashionstore")?></span>                            
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="list-category-toggle list-unstyled">
                            <li class="active"><a href="#" data-filter=""><?php esc_html_e("Categories",'fashionstore')?></a></li>
                            <?php 
                                $product_cat_list = get_terms('product_cat');
                                if(is_array($product_cat_list) && !empty($product_cat_list)){
                                    foreach ($product_cat_list as $cat) {
                                        echo '<li><a href="#" data-filter=".'.$cat->slug.'">'.$cat->name.'</a></li>';
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                    <form class="smart-search-form" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
                        <input name="s" type="text" value="<?php echo esc_attr($search_val);?>" placeholder="<?php echo esc_attr($placeholder)?>">
                        <input type="hidden" name="post_type" value="product" />
                        <input type="submit" value="">
                        <input class="cat-value" type="hidden" name="product_cat" value="" />
                    </form>
                </div>
                <?php
                break;
        }        
        $html .=    ob_get_clean();
        return $html;
    }
}

stp_reg_shortcode('sv_search_form','s7upf_vc_search_form');

vc_map( array(
    "name"      => esc_html__("SV Search Form", 'fashionstore'),
    "base"      => "sv_search_form",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Style",'fashionstore'),
            "param_name" => "style",
            "value"     => array(
                esc_html__("Home 1",'fashionstore')   => 'home1',
                esc_html__("Home 7",'fashionstore')   => 'home7',
                esc_html__("Home 10",'fashionstore')   => 'home10',
                esc_html__("Home 12",'fashionstore')   => 'home12',
                esc_html__("Home 17",'fashionstore')   => 'smart-search17',
                esc_html__("Home 19",'fashionstore')   => 'smart-search19',
                )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => esc_html__("Place holder input",'fashionstore'),
            "param_name" => "placeholder",
        ),
    )
));