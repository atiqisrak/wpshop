<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 05/09/15
 * Time: 10:00 AM
 */
if(class_exists("woocommerce")){
if(!function_exists('sv_vc_product_list'))
{
    function sv_vc_product_list($attr, $content = false)
    {
        $html = $view_html = '';
        extract(shortcode_atts(array(
            'style'         => 'tab-cat',
            'title'         => '',
            'number'        => '8',
            'cats'          => '',
            'order_by'      => 'date',
            'order'         => 'DESC',
            'product_type'  => '',
            'advs'          => '',
            'time'          => '',
            'link'          => '',
            'item'          => '',
            'item_res'      => '',
            'speed'         => '',
            'size'          => '',
            'show_attr'     => '',
        ),$attr));
        global $s7upf_time;
        $s7upf_time = $time;
        $custom_list = array();
        $args = array(
            'post_type'         => 'product',
            'posts_per_page'    => $number,
            'orderby'           => $order_by,
            'order'             => $order,
            'paged'             => 1,
            );
        if($product_type == 'trendding'){
            $args['meta_query'][] = array(
                    'key'     => 'trending_product',
                    'value'   => 'on',
                    'compare' => '=',
                );
        }
        if($product_type == 'toprate'){
            add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
            $args['no_found_rows'] = 1;
            $args['meta_query'] = WC()->query->get_meta_query();
        }
        if($product_type == 'mostview'){
            $args['meta_key'] = 'post_views';
            $args['orderby'] = 'meta_value_num';
        }
        if($product_type == 'bestsell'){
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
        }
        if($product_type=='onsale'){
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
        }
        if($product_type == 'featured'){
            $args['meta_key'] = '_featured';
            $args['meta_value'] = 'yes';
        }
        if(!empty($cats)) {
            $custom_list = explode(",",$cats);
            $args['tax_query'][]=array(
                'taxonomy'=>'product_cat',
                'field'=>'slug',
                'terms'=> $custom_list
            );
        }
        $product_query = new WP_Query($args);
        $count = 1;
        $count_query = $product_query->post_count;
        if(!empty($size)) $size = explode('x', $size);
        switch ($style) {
            case 'list-mega':
                if(empty($item) && empty($item_res)) $item_res = '0:1,480:1,700:2,1200:2';
                if(empty($item)) $item = 4;
                if(empty($size)) $size = array(370,472);
                if(empty($size)) $size = array(370,472);
                $html .=    '<div class="mega-best-sale">';
                if(!empty($title)) $html .=    '<h2>'.esc_html($title).'</h2>';
                $html .=        '<div class="mega-slider">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="true" data-navigation="">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        global $product;
                        $html .=        '<div class="item-mega-bestsale">
                                            <div class="product-thumb zoom-image"><a href="'.esc_url(get_the_permalink()).'" title="'.get_the_title().'">'.get_the_post_thumbnail(get_the_ID(),$size).'</a></div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                '.s7upf_get_price_html().'
                                            </div>
                                        </div>';
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'tab-cat-detail-home18':
                if(!empty($cats)){
                    if(empty($size)) $size = array(470,600);
                    $pre = rand(1,100);
                    $tabs = explode(",",$cats);
                    $tab_html = $tab_content = '';
                    parse_str( urldecode( $advs ), $data);
                    foreach ($tabs as $key => $tab) {
                        $term = get_term_by( 'slug',$tab, 'product_cat' );
                        if(!empty($term) && is_object($term)){
                            if($key == 0) $active = 'active';
                            else $active = '';
                            $tab_html .=    '<li class="'.esc_attr($active).'"><a href="#'.esc_attr($pre.$term->slug).'" data-toggle="tab">
                                                <span>0'.esc_html($key+1).'</span>
                                                <h3>'.esc_html($term->name).'</h3>                                                
                                            </a></li>';
                            $tab_content .=    '<div class="tab-pane '.esc_attr($active).'" id="'.esc_attr($pre.$term->slug).'">
                                                    <div class="trend-content18">
                                                        <div class="row">';
                            unset($args['tax_query']);
                            $args['tax_query'][]=array(
                                'taxonomy'=>'product_cat',
                                'field'=>'slug',
                                'terms'=> $tab
                            );
                            $product_query = new WP_Query($args);
                            $count = 1;
                            if($product_query->have_posts()) {
                                while($product_query->have_posts()) {
                                    $product_query->the_post();
                                    global $product;
                                    $thumb_id = array(get_post_thumbnail_id());
                                    $attachment_ids = $product->get_gallery_attachment_ids();
                                    $attachment_ids = array_merge($thumb_id,$attachment_ids);
                                    $thumbs_html = ''; $i = 1;
                                    foreach ( $attachment_ids as $attachment_id ) {
                                        $image_link = wp_get_attachment_url( $attachment_id );
                                        if ( ! $image_link )
                                            continue;                                        
                                        if($i == 1) $active = 'active';
                                        else $active = '';
                                        $image_title    = esc_attr( get_the_title( $attachment_id ) );
                                        $image_caption  = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
                                        $image       = wp_get_attachment_image( $attachment_id, $size, 0, $attr = array(
                                            'title' => $image_title,
                                            'alt'   => $image_title,
                                            'class' => $active
                                            ) );
                                        $thumbs_html .= '<div>'.$image.'</div>';
                                        $i++;
                                    }
                                    $available_data = array();
                                    if( $product->is_type( 'variable' ) ) $available_data = $product->get_available_variations();        
                                    if(!empty($available_data)){
                                        foreach ($available_data as $available) {
                                            if(!empty($available['image_link'])){
                                                $thumbs_html .= '<div data-variation_id="'.$available['variation_id'].'">'.s7upf_get_image_by_url($available['image_link'],$size).'</div>';
                                            }
                                        }
                                    }
                                    $tab_content .=     '<div class="item-detail18">';
                                    $tab_content .=         '<div class="col-md-12 hidden get-cat-thumb">'.get_the_post_thumbnail(get_the_ID(),array(47,60)).'</div>';
                                    $tab_content .=         '<div class="col-md-7 col-sm-6 col-12">
                                                                <div class="trend-thumb18">
                                                                    <a href="'.esc_url(get_the_permalink()).'">
                                                                        '.$thumbs_html.'
                                                                    </a>
                                                                </div>
                                                            </div>';
                                    $tab_content .=         '<div class="col-md-5 col-sm-6 col-12">
                                                                <div class="tren-info18 detail-info">
                                                                    <h2 class="title-detail">'.get_the_title().'</h2>
                                                                    <ul class="list-rate-review list-inline">
                                                                        <li>
                                                                            '.s7upf_get_rating_html().'
                                                                        </li>
                                                                        <li><span class="number-review">'.$product->get_review_count().' '.esc_html__("Review(s)","fashionstore").'</span></li>
                                                                    </ul>
                                                                    '.s7upf_get_price_html();
                                                                    ob_start();
                                                                    woocommerce_template_single_add_to_cart();
                                                                    $tab_content .=    ob_get_clean();                                                                    
                                    $tab_content .=             '</div>
                                                            </div>';
                                    $tab_content .=     '</div>';
                                    $count++;
                                }
                            }
                            $tab_content .=             '</div>
                                                    </div>
                                                </div>';
                        }
                    }
                    $html .=    '<div class="trend-box18">';
                    if(!empty($title)) $html .=    '<h2>'.esc_html($title).'</h2>';
                    $html .=        '<div class="inner-trend-box18">
                                        <div class="trend-title18">
                                            <ul>
                                            '.$tab_html.'
                                            </ul>                                    
                                        </div>
                                        <div class="tab-content">
                                            '.$tab_content.'
                                        </div>
                                    </div>
                                </div>';
                }
                break;

            case 'list-home19':
                if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,700:3,1200:4';
                if(empty($item)) $item = 4;
                if(empty($size)) $size = array(370,472);
                $html .=    '<div class="new-product19">';
                if(!empty($title)) $html .=    '<h2 class="title19"><span>'.esc_html($title).'</span></h2>';
                $html .=        '<div class="product-slider19 owl-directnav19">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        global $product;
                        $html .=    '<div class="item-product19">
                                        <div class="product-thumb">
                                            <a class="product-thumb-link" href="'.esc_url(get_the_permalink()).'" title="'.get_the_title().'">'.get_the_post_thumbnail(get_the_ID(),$size).'</a>
                                            <a data-product-id="'.get_the_id().'" href="'.esc_url(get_the_permalink()).'" class="product-quick-view quickview-link">
                                                '.esc_html__("Quick View","fashionstore").'
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            '.s7upf_get_price_html().'
                                            <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                            <p class="product-desc">'.s7upf_substr(get_the_excerpt(),0,60).'</p>
                                            '.s7upf_product_link().'
                                        </div>
                                    </div>';
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'tab-cat-home18':
                if(!empty($cats)){
                    if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,667:3,840:4,1200:5';
                    if(empty($item)) $item = 5;
                    if(empty($size)) $size = array(210,268);
                    $pre = rand(1,100);
                    $tabs = explode(",",$cats);
                    $tab_html = $tab_content = '';
                    parse_str( urldecode( $advs ), $data);
                    foreach ($tabs as $key => $tab) {
                        $term = get_term_by( 'slug',$tab, 'product_cat' );
                        if(!empty($term) && is_object($term)){
                            if($key == 0) $active = 'active';
                            else $active = '';
                            $tab_html .=    '<li class="'.$active.'"><a href="#'.$pre.$term->slug.'" data-toggle="tab">'.$term->name.'</a></li>';
                            $tab_content .=    '<div class="tab-pane '.$active.'" id="'.$pre.$term->slug.'">
                                                    <div class="pro-tab-slider18">
                                                        <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                            unset($args['tax_query']);
                            $args['tax_query'][]=array(
                                'taxonomy'=>'product_cat',
                                'field'=>'slug',
                                'terms'=> $tab
                            );
                            $product_query = new WP_Query($args);
                            $count = 1;
                            $count_query = $product_query->post_count;
                            if($product_query->have_posts()) {
                                while($product_query->have_posts()) {
                                    $product_query->the_post();
                                    global $product;
                                    $img_hover_html = '';
                                    $img_hover = get_post_meta(get_the_ID(),'product_thumb_hover',true);
                                    if(!empty($img_hover)) $img_hover_html = s7upf_get_image_by_url($img_hover,$size,'second-image');
                                    else $img_hover_html = get_the_post_thumbnail(get_the_ID(),$size,array('class'=>'second-image'));
                                    if($count % 2 == 1) $tab_content .= '<div class="item">';
                                    $tab_content .=         '<div class="item-pro18">
                                                                <div class="product-thumb">
                                                                    <a href="'.esc_url(get_the_permalink()).'" class="product-thumb-link" title="'.get_the_title().'">
                                                                        '.get_the_post_thumbnail(get_the_ID(),$size).'
                                                                    </a>';
                                    if(!empty($show_attr)){
                                        $terms_attr = wc_get_product_terms( $product->id, $show_attr, array( 'fields' => 'all' ) );
                                        $tab_content .=             '<ul class="product-size">';
                                        foreach ( $terms_attr as $term_attr ) {
                                            $tab_content .=         '<li>'.esc_html($term_attr->name).'</li>';
                                        }
                                        $tab_content .=             '</ul>';
                                                                }
                                    $tab_content .=             '</div>
                                                                <div class="product-info">
                                                                    <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                                    '.s7upf_get_price_html().'
                                                                    '.s7upf_product_link().'
                                                                </div>
                                                            </div>';
                                    if($count % 2 == 0 || $count == $count_query) $tab_content .= '</div>';
                                    $count++;
                                }
                            }
                            $tab_content .=             '</div>
                                                    </div>
                                                </div>';
                        }
                    }
                    $html .=    '<div class="product-tab18">';
                    if(!empty($title)) $html .=    '<h2>'.esc_html($title).'</h2>';
                    $html .=        '<div class="pro-tab-title18">
                                        <ul>
                                            '.$tab_html.'
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                        '.$tab_content.'
                                    </div>
                                </div>';
                }
                break;

            case 'tab-cat-home17':
                if(!empty($cats)){
                    if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,667:3,1200:4';
                    if(empty($item)) $item = 4;
                    if(empty($size)) $size = array(248,316);
                    $pre = rand(1,100);
                    $tabs = explode(",",$cats);
                    $tab_html = $tab_content = '';
                    parse_str( urldecode( $advs ), $data);
                    foreach ($tabs as $key => $tab) {
                        $term = get_term_by( 'slug',$tab, 'product_cat' );
                        if(!empty($term) && is_object($term)){
                            if($key == 0) $active = 'active';
                            else $active = '';
                            $tab_html .=    '<li class="'.$active.'"><a href="#'.$pre.$term->slug.'" data-toggle="tab">'.$term->name.'</a></li>';
                            $tab_content .=    '<div class="tab-pane '.$active.'" id="'.$pre.$term->slug.'">
                                                    <div class="trend-slider owl-direct17">
                                                        <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                            unset($args['tax_query']);
                            $args['tax_query'][]=array(
                                'taxonomy'=>'product_cat',
                                'field'=>'slug',
                                'terms'=> $tab
                            );
                            $product_query = new WP_Query($args);
                            if($product_query->have_posts()) {
                                while($product_query->have_posts()) {
                                    $product_query->the_post();
                                    global $product;
                                    $img_hover_html = '';
                                    $img_hover = get_post_meta(get_the_ID(),'product_thumb_hover',true);
                                    if(!empty($img_hover)) $img_hover_html = s7upf_get_image_by_url($img_hover,$size,'second-image');
                                    else $img_hover_html = get_the_post_thumbnail(get_the_ID(),$size,array('class'=>'second-image'));
                                    $tab_content .=         '<div class="item-trend17">
                                                                <div class="product-thumb">
                                                                    <a class="product-thumb-link" href="'.esc_url(get_the_permalink()).'" title="'.get_the_title().'">
                                                                        '.get_the_post_thumbnail(get_the_ID(),$size,array('class'=>'first-image')).'
                                                                        '.$img_hover_html.'
                                                                    </a>
                                                                    <a data-product-id="'.get_the_id().'" href="'.esc_url(get_the_permalink()).'" class="product-quick-view quickview-link">
                                                                        '.esc_html__("Quick View","fashionstore").'
                                                                    </a>
                                                                </div>
                                                                <div class="product-info product-info17">
                                                                    <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                                    '.s7upf_get_price_html().'
                                                                    '.s7upf_product_link().'
                                                                </div>
                                                            </div>';
                                }
                            }
                            $tab_content .=             '</div>
                                                    </div>
                                                </div>';
                        }
                    }
                    $html .=    '<div class="trending-product17">';
                    if(!empty($title)) $html .=    '<h2 class="title17"><span>'.esc_html($title).'</span></h2>';
                    $html .=        '<div class="trend-tab">
                                        <div class="trend-tab-title">
                                            <ul>
                                                '.$tab_html.'
                                            </ul>                                    
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        '.$tab_content.'
                                    </div>
                                </div>';
                }
                break;

            case 'list-home17':
                if(empty($item) && empty($item_res)) $item_res = '0:1';
                if(empty($item)) $item = 1;
                if(empty($size)) $size = array(158,202);
                $html .=    '<div class="new-product17">';
                if(!empty($title)) $html .=    '<h2 class="title17"><span>'.esc_html($title).'</span></h2>';
                $html .=        '<p class="total-product">'.esc_html__("Total","fashionstore").' '.s7upf_product_count().' '.esc_html__("Items","fashionstore").' - <a href="'.esc_url($link).'">'.esc_html__("Show All","fashionstore").'</a></p>
                                <div class="owl-directnav owl-direct17">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        global $product;
                        if($count % 9 == 1){
                            $html .=    '<div class="item-list17">
                                            <div class="row">';
                            $html .=    '<div class="col-md-4 hidden-sm hidden-xs">
                                            <div class="item-newpro17 main-item">
                                                <div class="product-thumb">
                                                    <div class="zoom-image"><a href="'.esc_url(get_the_permalink()).'" title="'.get_the_title().'">'.get_the_post_thumbnail(get_the_ID(),array(348,444)).'</a></div>
                                                </div>
                                                <div class="product-info product-info17">
                                                    <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                    '.s7upf_get_price_html().'
                                                    '.s7upf_get_rating_html().'
                                                    '.s7upf_product_link('home17').'
                                                </div>
                                            </div>
                                        </div>';
                        }
                        else{
                            if($count % 9 == 2) $html .=    '<div class="col-md-8 col-sm-12 col-xs-12">
                                                                <div class="list-normal-item">
                                                                    <div class="row">';
                            $html .=    '<div class="col-md-3 col-sm-3 col-xs-6">
                                            <div class="item-newpro17">
                                                <div class="product-thumb">
                                                    <div class="zoom-image"><a href="'.esc_url(get_the_permalink()).'" title="'.get_the_title().'">'.get_the_post_thumbnail(get_the_ID(),$size).'</a></div>
                                                </div>
                                                <div class="product-info product-info17">
                                                    <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                    '.s7upf_get_price_html().'
                                                </div>
                                            </div>
                                        </div>';
                            if($count % 9 == 0 || $count == $count_query) $html .=    '</div>
                                                                                    </div>
                                                                                </div>';
                        }
                        if($count % 9 == 0 || $count == $count_query) $html .=        '</div>
                                    </div>';
                        $count++;
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'side-slider17':
                if(empty($item) && empty($item_res)) $item_res = '0:1';
                if(empty($item)) $item = 1;
                if(empty($size)) $size = array(100,128);
                $html .=    '<div class="pro-box17">';
                if(!empty($title)) $html .=    '<h2 class="title17 style2"><span>'.esc_html($title).'</span></h2>';
                $html .=        '<div class="owl-directnav owl-direct17">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        global $product;
                        if($count % 3 == 1) $html .=    '<div class="list-probox17">';
                        $html .=            '<div class="item-probox17">
                                                <div class="product-thumb">
                                                    <div class="zoom-image"><a href="'.esc_url(get_the_permalink()).'" title="'.get_the_title().'">'.get_the_post_thumbnail(get_the_ID(),$size).'</a></div>
                                                </div>
                                                <div class="product-info product-info17">
                                                    <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                    '.s7upf_get_price_html().'
                                                    '.s7upf_get_rating_html().'
                                                </div>
                                            </div>';
                        if($count % 3 == 0 || $count == $count_query) $html .=    '</div>';
                        $count++;
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'list-home12':
                if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,667:3,992:4';
                if(empty($item)) $item = 4;
                if(empty($size)) $size = array(270,344);
                $html .=    '<div class="new-arrival12">';
                if(!empty($title)) $html .=    '<h2>'.esc_html($title).'</h2>';
                $html .=        '<div class="product-slider12">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        global $product;
                        $img_hover_html = '';
                        $img_hover = get_post_meta(get_the_ID(),'product_thumb_hover',true);
                        if(!empty($img_hover)) $img_hover_html = s7upf_get_image_by_url($img_hover,$size,'second-image');
                        else $img_hover_html = get_the_post_thumbnail(get_the_ID(),$size,array('class'=>'second-image'));
                        $html .=    '<div class="item-product12">
                                        <div class="product-thumb">
                                            <a class="product-thumb-link" href="'.esc_url(get_the_permalink()).'" title="'.get_the_title().'">
                                                '.get_the_post_thumbnail(get_the_ID(),$size,array('class'=>'first-image')).'
                                                '.$img_hover_html.'
                                            </a>
                                            <a data-product-id="'.get_the_id().'" href="'.esc_url(get_the_permalink()).'" class="product-quick-view quickview-link">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </a>
                                            '.s7upf_product_link().'
                                        </div>
                                        <div class="product-info">
                                            '.s7upf_get_price_html('style3').'
                                        </div>
                                    </div>';
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'list-home11':
                if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,768:3,992:4,1280:5';
                if(empty($item)) $item = 5;
                if(empty($size)) $size = array(210*1.5,268*1.5);
                $html .=    '<div class="best-sale11">
                                <div class="title-bestsale11">
                                    <div class="container">';
                if(!empty($title)) $html .=    '<h2 class="title-default">'.esc_html($title).'</h2>';
                if(!empty($link)) $html .=    '<a href="'.esc_url($link).'" class="btn-link11" data-hover="'.esc_attr__("view all","fashionstore").'"><span>'.esc_attr__("view all","fashionstore").'</span></a>';
                $html .=            '</div>
                                </div>
                                <div class="bestsale-slider11">
                                    <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="true" data-navigation="false">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        global $product;
                        $img_hover_html = '';
                        $img_hover = get_post_meta(get_the_ID(),'product_thumb_hover',true);
                        if(!empty($img_hover)) $img_hover_html = s7upf_get_image_by_url($img_hover,$size,'second-image');
                        else $img_hover_html = get_the_post_thumbnail(get_the_ID(),$size,array('class'=>'second-image'));
                        $html .=    '<div class="item-betsale11">
                                        <div class="product-thumb">
                                            <a class="product-thumb-link" href="'.esc_url(get_the_permalink()).'">
                                                '.get_the_post_thumbnail(get_the_ID(),$size,array('class'=>'first-image')).'
                                                '.$img_hover_html.'
                                            </a>
                                            <a data-product-id="'.get_the_id().'" href="'.esc_url(get_the_permalink()).'" class="product-quick-view quickview-link">
                                                '.esc_html__("Quick View","fashionstore").'
                                            </a>
                                            '.s7upf_product_link().'
                                        </div>
                                        <div class="product-info">
                                            '.s7upf_get_cat_post().'
                                            <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                            '.s7upf_get_rating_html().'
                                            '.s7upf_get_price_html().'
                                        </div>
                                    </div>';
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'list-home10':
                if(empty($size)) $size = array(540,689);
                $date_to = $time;
                $html .=    '<div class="list-product-bigsale">
                                <div class="row">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        global $product;
                        $deals_time = get_post_meta(get_the_ID(),'deals_time',true);
                        $main_color = s7upf_get_option('main_color');
                        if(!empty($deals_time)) $date_to = current_time( 'Y/m/d ' ).$deals_time;
                        $html .=    '<div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="item-product-bigsale">
                                            <div class="product-thumb">
                                                <a href="'.esc_url(get_the_permalink()).'" class="product-thumb-link">'.get_the_post_thumbnail(get_the_ID(),$size).'</a>
                                                <div class="bigsale-countdown" data-date="'.esc_attr($date_to).'" data-color="'.esc_attr($main_color).'"></div>
                                            </div>
                                            <div class="product-info">
                                                <div class="content-product-info">
                                                    <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                    '.s7upf_get_price_html().'
                                                    '.s7upf_get_rating_html().'
                                                    '.s7upf_product_link('home10').'
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                    }
                }
                $html .=        '</div>
                            </div>';
                break;

            case 'side-slider7-2':
                if(empty($item) && empty($item_res)) $item_res = '0:1';
                if(empty($item)) $item = 1;
                if(empty($size)) $size = array(149,190);
                $html .=    '<div class="product-slider7 style2">';
                if(!empty($title)) $html .= '<h2>'.esc_html($title).'</h2>';
                $html .=        '<div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="false" data-next="false" data-pagination="" data-navigation="true">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        global $product;
                        if($count % 4 == 1) $html .=    '<div class="item"><div class="row">';
                        $html .=    '<div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="item-produc7 style2">
                                            <div class="product-thumb">
                                                <div class="zoom-image"><a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),$size).'</a></div>
                                                '.s7upf_get_sale_label().'
                                                '.s7upf_get_new_label().'
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                '.s7upf_get_price_html().'
                                                '.s7upf_product_link().'
                                            </div>
                                        </div>
                                    </div>';
                        if($count % 4 == 0 || $count == $count_query) $html .=    '</div></div>';
                        $count++;
                    }
                }
                $html .=        '</div>
                            </div>';
                break;

            case 'side-slider7':
                if(empty($item) && empty($item_res)) $item_res = '0:1';
                if(empty($item)) $item = 1;
                if(empty($size)) $size = array(149,190);
                $html .=    '<div class="product-slider7">';
                if(!empty($title)) $html .= '<h2>'.esc_html($title).'</h2>';
                $html .=        '<div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="false" data-next="false" data-pagination="" data-navigation="true">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        global $product;
                        if($count % 3 == 1) $html .=    '<div class="item">';
                        $html .=    '<div class="item-produc7">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6 block-thumb">
                                                <div class="product-thumb">
                                                    <div class="zoom-image"><a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),$size).'</a></div>
                                                    '.s7upf_get_sale_label().'
                                                    '.s7upf_get_new_label().'
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6 block-info">
                                                <div class="product-info">
                                                    <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                    '.s7upf_get_price_html().'
                                                    '.s7upf_get_rating_html().'
                                                    '.s7upf_product_link().'
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                        if($count % 3 == 0 || $count == $count_query) $html .=    '</div>';
                        $count++;
                    }
                }
                $html .=        '</div>
                            </div>';
                break;

            case 'tab-cat7':
                if(!empty($cats)){
                    if(empty($size)) $size = array(370,472);
                    $pre = rand(1,100);
                    $tabs = explode(",",$cats);
                    $tab_html = $tab_content = '';
                    parse_str( urldecode( $advs ), $data);
                    foreach ($tabs as $key => $tab) {
                        $term = get_term_by( 'slug',$tab, 'product_cat' );
                        if(!empty($term) && is_object($term)){
                            if($key == 0) $active = 'active';
                            else $active = '';
                            $tab_html .=    '<li class="'.$active.'"><a href="#'.$pre.$term->slug.'" data-toggle="tab">'.$term->name.'</a></li>';
                            $tab_content .=    '<div class="tab-pane '.$active.'" id="'.$pre.$term->slug.'">
                                                    <div class="best-tab-content">
                                                        <div class="row">';
                            unset($args['tax_query']);
                            $args['tax_query'][]=array(
                                'taxonomy'=>'product_cat',
                                'field'=>'slug',
                                'terms'=> $tab
                            );
                            $product_query = new WP_Query($args);
                            if($product_query->have_posts()) {
                                while($product_query->have_posts()) {
                                    $product_query->the_post();
                                    global $product;                                    
                                    $tab_content .=         '<div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="item-best-tab style2">
                                                                    <div class="product-thumb">
                                                                        <a href="'.esc_url(get_the_permalink()).'" class="product-thumb-link">'.get_the_post_thumbnail(get_the_ID(),$size).'</a>
                                                                        <a data-product-id="'.get_the_id().'" href="'.esc_url(get_the_permalink()).'" class="product-quick-view quickview-link">
                                                                            '.esc_html__("Quick View","fashionstore").'
                                                                        </a>
                                                                        '.s7upf_product_link().'
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                                        '.s7upf_get_price_html().'
                                                                        '.s7upf_get_rating_html().'
                                                                    </div>
                                                                </div>
                                                            </div>';
                                }
                            }
                            $tab_content .=             '</div>
                                                    </div>
                                                </div>';
                        }
                    }
                    $html .=    '<div class="best-tab-product7">
                                    <div class="best-tab-title style2">
                                        <ul class="list-inline text-center">
                                            '.$tab_html.'
                                        </ul>                                    
                                    </div>
                                    <div class="tab-content">
                                        '.$tab_content.'
                                    </div>
                                </div>';
                }
                break;

            case 'deals-home2':
                if(empty($size)) $size = array(370,472);
                $html .=    '<div class="list-supper-deal">
                                <div class="row">';
                if($product_query->have_posts()) {
                    while($product_query->have_posts()) {
                        $product_query->the_post();
                        $html .=    '<div class="col-md-4 col-sm-4 col-xs-12">
                                        <div class="item-supper-deal">
                                            <div class="item-product">
                                                '.s7upf_product_thumb_hover2($size,'show-label').'
                                                <div class="product-info">
                                                    <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                    '.s7upf_get_price_html().'
                                                    '.s7upf_product_link().'
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                    }
                }
                $html .=        '</div>
                            </div>';
                break;

            default:
                if(!empty($cats)){
                    if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,667:3,768:2,1200:3';
                    if(empty($item)) $item = 3;
                    if(empty($size)) $size = array(260,332);
                    $pre = rand(1,100);
                    $tabs = explode(",",$cats);
                    $tab_html = $tab_content = '';
                    parse_str( urldecode( $advs ), $data);
                    foreach ($tabs as $key => $tab) {
                        $term = get_term_by( 'slug',$tab, 'product_cat' );
                        if(!empty($term) && is_object($term)){
                            if($key == 0) $active = 'active';
                            else $active = '';
                            $key_adv = $key+1;
                            $tab_html .=    '<li class="'.$active.'"><a href="#" data-id="'.esc_attr($pre.$term->slug).'">'.$term->name.'</a></li>';
                            $tab_content .=    '<div class="content-featured-product '.$active.'" id="'.$pre.$term->slug.'">
                                                    <div class="clearfix">';
                            if(isset($data[$key_adv])){
                            $tab_content .=             '<div class="featured-product-advert">
                                                            <div class="zoom-image"><a href="'.esc_url($data[$key_adv]['link']).'">'.wp_get_attachment_image($data[$key_adv]['image'],'full').'</a></div>
                                                            <div class="featured-advert-info">
                                                                <h2>'.esc_html($data[$key_adv]['title']).'</h2>
                                                                <div class="featured-product-saleoff">
                                                                    <h4>'.esc_html($data[$key_adv]['des1']).'</h4>
                                                                    <h2>'.esc_html($data[$key_adv]['des2']).'</h2>
                                                                </div>
                                                            </div>
                                                        </div>';
                            }
                            $tab_content .=             '<div class="featured-product-slider">
                                                            <div class="wrap-item smart-slider" data-item="'.esc_attr($item).'" data-speed="'.esc_attr($speed).'" data-itemres="'.esc_attr($item_res).'" data-prev="" data-next="" data-pagination="" data-navigation="true">';
                            unset($args['tax_query']);
                            $args['tax_query'][]=array(
                                'taxonomy'=>'product_cat',
                                'field'=>'slug',
                                'terms'=> $tab
                            );
                            $product_query = new WP_Query($args);
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
                                        $image_pager  = wp_get_attachment_image( $attachment_id, array(38,48), 0, $attr = array(
                                            'title' => $image_title,
                                            'alt'   => $image_title
                                            ) );
                                        if($i == 1) $active = 'active';
                                        else $active = '';
                                        $page_index = $i-1;
                                        $ul_block .= '<li>'.$image.'</li>';
                                        $pager_html .=  '<a data-slide-index="'.$page_index.'" href="#">'.$image_pager.'</a>';
                                        $i++;
                                    }
                                    $available_data = array();
                                    if( $product->is_type( 'variable' ) ) $available_data = $product->get_available_variations();        
                                    if(!empty($available_data)){
                                        foreach ($available_data as $available) {
                                            if(!empty($available['image_src'])){
                                                $page_index = $i-1;
                                                $ul_block .= '<li data-variation_id="'.$available['variation_id'].'"><img src="'.esc_url($available['image_link']).'" srcset="'.esc_url($available['image_link']).'" alt="'.$available['image_alt'].'" title="'.$available['image_title'].'" ></li>';
                                                $pager_html .=  '<a data-variation_id="'.$available['variation_id'].'" data-slide-index="'.$page_index.'" href="#"><img src="'.esc_url($available['image_link']).'" srcset="'.esc_url($available['image_link']).'" alt="'.$available['image_alt'].'" title="'.$available['image_title'].'" ></a>';
                                                $i++;
                                            }
                                        }
                                    }
                                        $tab_content .=         '<div class="item-featured-product">
                                                                    <div class="featured-product-gallery">
                                                                        <ul class="bxslider">
                                                                            '.$ul_block.'
                                                                        </ul>
                                                                        <div class="bx-pager">
                                                                            '.$pager_html.'
                                                                        </div>
                                                                        '.s7upf_product_link().'
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                                        '.s7upf_get_price_html().'
                                                                        '.s7upf_get_rating_html('style2').'
                                                                    </div>
                                                                </div>';
                                }
                            }
                            $tab_content .=                 '</div>
                                                        </div>
                                                    </div>
                                                </div>';
                        }
                    }
                    $html .=    '<div class="featured-product-box">
                                    <div class="container">
                                        <div class="featured-product-title">
                                            <ul>
                                                '.$tab_html.'
                                            </ul>
                                        </div>                                        
                                    </div>
                                    <div class="content-featured-product-box vc_row-no-padding" data-vc-stretch-content="true" data-vc-full-width="true">
                                        '.$tab_content.'
                                    </div>
                                    <div class="vc_row-full-width vc_clearfix"></div>
                                </div>';
                }
                break;
        }
        wp_reset_postdata();
        return $html;
    }
}

stp_reg_shortcode('sv_product_list','sv_vc_product_list');
add_action( 'vc_before_init_base','sv_add_list_product',10,100 );
if ( ! function_exists( 'sv_add_list_product' ) ) {
    function sv_add_list_product(){
        vc_map( array(
            "name"      => esc_html__("SV Product list", 'fashionstore'),
            "base"      => "sv_product_list",
            "icon"      => "icon-st",
            "category"  => '7Up-theme',
            "params"    => array(
                array(
                    'heading'     => esc_html__( 'Style', 'fashionstore' ),
                    'holder'      => 'div',
                    'type'        => 'dropdown',
                    'description' => esc_html__( 'Choose style to display.', 'fashionstore' ),
                    'param_name'  => 'style',
                    'value'       => array(                        
                        esc_html__('Tab Categories','fashionstore')     => 'tab-cat',
                        esc_html__('Deals home 2','fashionstore')       => 'deals-home2',
                        esc_html__('Tab Categories home 7','fashionstore')       => 'tab-cat7',
                        esc_html__('Side Slider home 7','fashionstore')       => 'side-slider7',
                        esc_html__('Side Slider home 7(2)','fashionstore')       => 'side-slider7-2',
                        esc_html__('List home 10','fashionstore')       => 'list-home10',
                        esc_html__('List home 11','fashionstore')       => 'list-home11',
                        esc_html__('List home 12','fashionstore')       => 'list-home12',
                        esc_html__('Side Slider home 17','fashionstore')       => 'side-slider17',
                        esc_html__('List home 17','fashionstore')       => 'list-home17',
                        esc_html__('Tab Categories home 17','fashionstore')       => 'tab-cat-home17',
                        esc_html__('Tab Categories home 18','fashionstore')       => 'tab-cat-home18',
                        esc_html__('Tab Categories detail home 18','fashionstore')       => 'tab-cat-detail-home18',
                        esc_html__('List home 19','fashionstore')       => 'list-home19',
                        esc_html__('List mega menu','fashionstore')       => 'list-mega',
                        )
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Time Countdown",'fashionstore'),
                    "param_name" => "time",
                    'description'   => esc_html__( 'EntertTime for countdown. Format is mm/dd/yyyy. Example: 12/15/2016.', 'fashionstore' ),
                    "dependency"    => array(
                        "element"   => 'style',
                        "value"   => array('list-home10','deals-home2'),
                        )
                ),
                array(
                    'heading'     => esc_html__( 'Title', 'fashionstore' ),
                    'type'        => 'textfield',
                    'param_name'  => 'title',
                    "dependency"    => array(
                        "element"   => 'style',
                        "value"   => array('list-mega','tab-cat-detail-home18','list-home19','tab-cat-home18','tab-cat-home17','list-home17','side-slider17','list-home12','side-slider7','side-slider7-2','list-home11'),
                        )
                ),
                array(
                    'heading'     => esc_html__( 'View Link', 'fashionstore' ),
                    'type'        => 'textfield',
                    'param_name'  => 'link',
                    "dependency"    => array(
                        "element"   => 'style',
                        "value"   => array('list-home11','list-home17'),
                        )
                ),
                array(
                    'heading'     => esc_html__( 'Number', 'fashionstore' ),
                    'type'        => 'textfield',
                    'description' => esc_html__( 'Enter number of product. Default is 8.', 'fashionstore' ),
                    'param_name'  => 'number',
                ),
                array(
                    'heading'     => esc_html__( 'Product Type', 'fashionstore' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'product_type',
                    'value' => array(
                        esc_html__('Default','fashionstore')            => '',
                        esc_html__('Trendding','fashionstore')          => 'trendding',
                        esc_html__('Featured Products','fashionstore')  => 'featured',
                        esc_html__('Best Sellers','fashionstore')       => 'bestsell',
                        esc_html__('On Sale','fashionstore')            => 'onsale',
                        esc_html__('Top rate','fashionstore')           => 'toprate',
                        esc_html__('Most view','fashionstore')          => 'mostview',
                    ),
                    'description' => esc_html__( 'Select Product View Type', 'fashionstore' ),
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
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Attribute",'fashionstore'),
                    "param_name" => "show_attr",
                    "value"     => s7upf_get_list_attribute(),
                    "dependency"    => array(
                        "element"   => 'style',
                        "value"   => 'tab-cat-home18',
                        )
                ),
                array(
                    "type" => "add_advantage",
                    "heading" => esc_html__("Advantage Tabs",'fashionstore'),
                    "param_name" => "advs",
                    "dependency"    => array(
                        "element"   => 'style',
                        "value"   => 'tab-cat',
                        )
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