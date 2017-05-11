<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 05/09/15
 * Time: 10:00 AM
 */
if(class_exists("woocommerce")){
    if(!function_exists('s7upf_vc_product_tab'))
    {
        function s7upf_vc_product_tab($attr, $content = false)
        {
            $html = $el_class = $html_wl = $html_cp = '';
            extract(shortcode_atts(array(
                'style'             => '',
                'tabs'              => '',
                'number'            => '',
                'cats'              => '',
                'order_by'          => 'date',
                'order'             => 'DESC',
                'item'          => '',
                'item_res'      => '',
                'speed'         => '',
                'size'          => '',
            ),$attr)); 
            if(!empty($size)) $size = explode('x', $size);
            $args=array(
                'post_type'         => 'product',
                'posts_per_page'    => $number,
                'orderby'           => $order_by,
                'order'             => $order
            );
            if(!empty($cats)) {
                $custom_list = explode(",",$cats);
                $args['tax_query'][]=array(
                    'taxonomy'=>'product_cat',
                    'field'=>'slug',
                    'terms'=> $custom_list
                );
            }
            $pre = rand(1,100);
            if(!empty($tabs)){
                $tabs = explode(',', $tabs);
                $tab_html = $content_html = '';
                foreach ($tabs as $key => $tab) {
                    switch ($tab) {
                        case 'bestsell':
                            $tab_title =    esc_html__("Popular","fashionstore");
                            $args['meta_key'] = 'total_sales';
                            $args['orderby'] = 'meta_value_num';
                            break;

                        case 'toprate':
                            $tab_title =    esc_html__("Most review","fashionstore");
                            unset($args['meta_key']);
                            $args['orderby'] = $order_by;
                            add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
                            $args['no_found_rows'] = 1;
                            $args['meta_query'] = WC()->query->get_meta_query();
                            break;
                        
                        case 'mostview':
                            $tab_title =    esc_html__("Most View","fashionstore");
                            unset($args['no_found_rows']);
                            unset($args['meta_query']);
                            $args['meta_key'] = 'post_views';
                            $args['orderby'] = 'meta_value_num';
                            break;

                        case 'featured':
                            $tab_title =    esc_html__("Featured","fashionstore");
                            $args['orderby'] = $order_by;
                            $args['meta_key'] = '_featured';
                            $args['meta_value'] = 'yes';
                            break;

                        case 'trendding':
                            unset($args['meta_key']);
                            unset($args['meta_value']);
                            $tab_title =    esc_html__("Tredding","fashionstore");
                            $args['meta_query'][] = array(
                                'key'     => 'trending_product',
                                'value'   => 'on',
                                'compare' => '=',
                            );
                            break;
                        
                        case 'onsale':
                            $tab_title =    esc_html__("On sale","fashionstore");
                            unset($args['meta_query']);
                            unset($args['meta_key']);
                            unset($args['meta_value']);
                            $args['meta_query']['relation']= 'OR';
                            $args['meta_query'][]=array(
                                'key'   => '_sale_price',
                                'value' => 0,
                                'compare' => '>',                
                                'type'          => 'numeric'
                            );
                            $args['meta_query'][]=array(
                                'key'   => '_min_variation_sale_price',
                                'value' => 0,
                                'compare' => '>',                
                                'type'          => 'numeric'
                            );
                            break;
                        
                        default:
                            $tab_title =    esc_html__("New arrivals","fashionstore");
                            $args['orderby'] = 'date';
                            break;
                    }
                    if($key == 0) $f_class = 'active';
                    else $f_class = '';
                    $product_query = new WP_Query($args);
                    $count = 1;
                    $count_query = $product_query->post_count;
                    switch ($style) {
                        case 'home4':
                            if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,960:3';
                            if(empty($item)) $item = 3;
                            if(empty($size)) $size = array(370,472);
                            $tab_html .=    '<li class="'.$f_class.'"><a href="#" data-id="'.esc_attr($pre.$tab).'">'.$tab_title.'</a></li>';
                            $content_html .=    '<div id="'.$pre.$tab.'" class="gal-pro-slider '.$f_class.'">
                                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="true" data-navigation="">';
                            if($product_query->have_posts()) {
                                while($product_query->have_posts()) {
                                    $product_query->the_post();
                                    global $product;
                                    $thumb_id = array(get_post_thumbnail_id());
                                    $attachment_ids = $product->get_gallery_attachment_ids();
                                    $attachment_ids = array_merge($thumb_id,$attachment_ids);
                                    $ul_block = $pager_html = $ul_block2 = ''; $i = 1;
                                    foreach ( $attachment_ids as $attachment_id ) {
                                        $image_link = wp_get_attachment_url( $attachment_id );
                                        if ( ! $image_link )
                                            continue;
                                        $image_title    = esc_attr( get_the_title( $attachment_id ) );
                                        $image_caption  = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
                                        $image       = wp_get_attachment_image( $attachment_id, $size, 0, $attr = array(
                                            'title' => $image_title,
                                            'alt'   => $image_title
                                            ) );
                                        $image_pager  = wp_get_attachment_image( $attachment_id, array(70,89), 0, $attr = array(
                                            'title' => $image_title,
                                            'alt'   => $image_title
                                            ) );
                                        if($i == 1) $active = 'active';
                                        else $active = '';
                                        $page_index = $i-1;
                                        $ul_block .= '<li>'.$image.'</li>';
                                        $pager_html .=  '<a data-slide-index="'.$page_index.'" href="#">'.$image.'</a>';
                                        $i++;
                                    }
                                    $content_html .=        '<div class="item-gal-pro">
                                                                <div class="gal-pro-tab">
                                                                    '.s7upf_get_sale_label().'
                                                                    <ul class="bxslider">
                                                                        '.$ul_block.'
                                                                    </ul>
                                                                    <div class="bx-pager">
                                                                        '.$pager_html.'
                                                                    </div>
                                                                    '.s7upf_product_link('home4').'
                                                                </div>
                                                                <div class="product-info">
                                                                    <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                                    '.s7upf_get_price_html().'
                                                                    '.s7upf_get_rating_html().'
                                                                </div>
                                                            </div>';
                                    $count++;
                                }
                            }
                            $content_html .=        '</div>
                                                </div>';
                            break;
                        
                        default:
                        if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,800:3';
                        if(empty($item)) $item = 3;
                        if(empty($size)) $size = array(370,472);
                            $tab_html .=    '<li class="'.$f_class.'"><a href="'.esc_url('#'.$pre.$tab).'" data-toggle="tab">'.$tab_title.'</a></li>';
                            $content_html .=    '<div id="'.$pre.$tab.'" class="tab-pane '.$f_class.'">
                                                    <div class="product-tab-slider">
                                                        <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                            if($product_query->have_posts()) {
                                while($product_query->have_posts()) {
                                    $product_query->the_post();
                                    global $product;
                                    if($count % 2 == 1) $content_html .=    '<div class="item">';
                                    $content_html .=        '<div class="item-product">
                                                                '.s7upf_product_thumb_hover($size,'show-label').'
                                                                <div class="product-info">
                                                                    <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                                    '.s7upf_get_price_html().'
                                                                    '.s7upf_get_rating_html().'
                                                                    '.s7upf_product_link().'
                                                                </div>
                                                            </div>';
                                    if($count % 2 == 0 || $count == $count_query) $content_html .=    '</div>';
                                    $count++;
                                }
                            }
                            $content_html .=            '</div>
                                                    </div>
                                                </div>';
                            break;
                    }                    
                }
                switch ($style) {
                    case 'home4':
                        $html .=    '<div class="product-tab4">
                                        <div class="title-gal-pro-tab">';
                        $html .=            '<ul>
                                                '.$tab_html.'
                                            </ul>
                                        </div>
                                        <div class="content-gal-pro-tab">
                                            '.$content_html.'
                                        </div>
                                    </div>';
                        break;
                    
                    default:
                        $html .=    '<div class="product-tab">
                                        <div class="product-tab-title">';
                        $html .=            '<ul>
                                                '.$tab_html.'
                                            </ul>
                                        </div>
                                        <div class="product-tab-content">
                                            <div class="tab-content">
                                                '.$content_html.'
                                            </div>
                                        </div>
                                    </div>';
                        break;
                }                
            }
            wp_reset_postdata();
            return $html;
        }
    }

    stp_reg_shortcode('sv_product_tab','s7upf_vc_product_tab');
    add_action( 'vc_before_init_base','s7upf_add_product_tab',10,100 );
    if ( ! function_exists( 's7upf_add_product_tab' ) ) {
        function s7upf_add_product_tab(){
            vc_map( array(
                "name"      => esc_html__("SV Product Tab", 'fashionstore'),
                "base"      => "sv_product_tab",
                "icon"      => "icon-st",
                "category"  => '7Up-theme',
                "params"    => array(
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Style",'fashionstore'),
                        "param_name" => "style",
                        "value"     => array(
                            esc_html__("Default",'fashionstore')   => '',
                            esc_html__("Home 4",'fashionstore')   => 'home4',
                            )
                    ),
                    array(
                        'heading'     => esc_html__( 'Number', 'fashionstore' ),
                        'type'        => 'textfield',
                        'description' => esc_html__( 'Enter number of product. Default is 10.', 'fashionstore' ),
                        'param_name'  => 'number',
                    ),
                    array(
                        'holder'     => 'div',
                        'heading'     => esc_html__( 'Product Categories', 'fashionstore' ),
                        'type'        => 'checkbox',
                        'param_name'  => 'cats',
                        'value'       => s7upf_list_taxonomy('product_cat',false)
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__( 'Order By', 'fashionstore' ),
                        'value' => s7upf_get_order_list(),
                        'param_name' => 'orderby',
                        'description' => esc_html__( 'Select Orderby Type ', 'fashionstore' ),
                        'edit_field_class'=>'vc_col-sm-6 vc_column',
                    ),
                    array(
                        'heading'     => esc_html__( 'Order', 'fashionstore' ),
                        'type'        => 'dropdown',
                        'param_name'  => 'order',
                        'value' => array(                   
                            esc_html__('Desc','fashionstore')  => 'DESC',
                            esc_html__('Asc','fashionstore')  => 'ASC',
                        ),
                        'description' => esc_html__( 'Select Order Type ', 'fashionstore' ),
                        'edit_field_class'=>'vc_col-sm-6 vc_column',
                    ),
                    array(
                        "type" => "checkbox",
                        "heading" => esc_html__("Tabs",'fashionstore'),
                        "param_name" => "tabs",
                        "value" => array(
                            esc_html__("New Arrivals",'fashionstore')    => 'newarrival',
                            esc_html__("Best Seller",'fashionstore')     => 'bestsell',
                            esc_html__("Most Review",'fashionstore')     => 'toprate',
                            esc_html__("Most View",'fashionstore')       => 'mostview',
                            esc_html__("Featured",'fashionstore')        => 'featured',
                            esc_html__("Trendding",'fashionstore')       => 'trendding',
                            esc_html__("On Sale",'fashionstore')         => 'onsale',
                            ),
                    ),                    
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__("Size Thumbnail",'fashionstore'),
                        "param_name"    => "size",
                        "group"         => esc_html__("Advanced",'fashionstore'),
                        'description' => esc_html__( 'Enter site thumbnail to crop. [width]x[height]. Example is 300x300', 'fashionstore' ),
                    ),
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__("Item",'fashionstore'),
                        "param_name"    => "item",
                        "group"         => esc_html__("Advanced",'fashionstore'),
                    ),
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__("Item Responsive",'fashionstore'),
                        "param_name"    => "item_res",
                        "group"         => esc_html__("Advanced",'fashionstore'),
                        'description' => esc_html__( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.', 'fashionstore' ),
                    ),
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__("Speed",'fashionstore'),
                        "param_name"    => "speed",
                        "group"         => esc_html__("Advanced",'fashionstore'),                    
                    ),
                )
            ));
        }
    }
}
