<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('sv_vc_shop'))
{
    function sv_vc_shop($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'title'      => '',
            'style'      => 'grid',
            'number'     => '12',
            'column'     => 'col-md-12 col-sm-12',
            'filter'     => '',
            'cats'     => '',
            'orderby'     => 'menu_order',
        ),$attr));
        $type = $style;
        if(isset($_GET['orderby'])){
            $orderby = $_GET['orderby'];
        }
        if(isset($_GET['type'])){
            $type = $_GET['type'];
        }
        if(isset($_GET['number'])){
            $number = $_GET['number'];
        }
        $args = array(
            'post_type'         => 'product',
            'posts_per_page'    => $number,
            'paged'             => 1,
            );
        $attr_taxquery = array();
        global $wpdb;
        $attribute_taxonomies = wc_get_attribute_taxonomies();
        $attr_taxquery = array('relation ' => 'OR');
        if(!empty($attribute_taxonomies)){
            foreach($attribute_taxonomies as $attr){
                if(isset($_REQUEST['pa_'.$attr->attribute_name])){
                    $term = $_REQUEST['pa_'.$attr->attribute_name];
                    $term = explode(',', $term);
                    $attr_taxquery[] =  array(
                                            'taxonomy'      => 'pa_'.$attr->attribute_name,
                                            'terms'         => $term,
                                            'field'         => 'slug',
                                            'operator'      => 'IN'
                                        );
                }
            }
        }
        if(isset( $_GET['product_cat'])) $cats = $_GET['product_cat'];
        if(!empty($cats)) {
            $cats = explode(",",$cats);
            $attr_taxquery[]=array(
                'taxonomy'=>'product_cat',
                'field'=>'slug',
                'terms'=> $cats
            );
        }
        if ( !is_admin() && !empty($attr_taxquery)){
            $args['meta_query'][]  = array(
                    'key'           => '_visibility',
                    'value'         => array('catalog', 'visible'),
                    'compare'       => 'IN'
                );
            $args['tax_query'] = $attr_taxquery;
        }
        if( isset( $_GET['min_price']) && isset( $_GET['max_price']) ){
            $min = $_GET['min_price'];
            $max = $_GET['max_price'];
            $args['post__in'] = sv_filter_price($min,$max);
        }
        switch ($orderby) {
            case 'price' :
                $args['orderby']  = "meta_value_num ID";
                $args['order']    = 'ASC';
                $args['meta_key'] = '_price';
            break;

            case 'price-desc' :
                $args['orderby']  = "meta_value_num ID";
                $args['order']    = 'DESC';
                $args['meta_key'] = '_price';
            break;

            case 'popularity' :
                $args['meta_key'] = 'total_sales';
                add_filter( 'posts_clauses', array( WC()->query, 'order_by_popularity_post_clauses' ) );
            break;

            case 'rating' :
                add_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
            break;

            case 'date':
                $args['orderby'] = 'date';
                break;
            
            default:
                $args['orderby'] = 'menuorder';
                break;
        }
        $grid_active = $list_active = '';
        if($type == 'grid') $grid_active = 'active'; 
        if($type == 'list') $list_active = 'active';
        $product_query = new WP_Query($args);
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;        
        ob_start();
        ?>
        <?php if(!empty($title)){
            echo '<h3 class="page-title">
                <span>'.esc_html($title).'</span>
            </h3>';
        }
        ?>
        <div class="shop-pagibar top">
            <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-6">
                    <div class="view-bar">
                        <label><?php esc_html_e("View:","fashionstore");?></label>
                        <a href="<?php echo esc_url(s7upf_get_key_url('type','grid'))?>" class="grid-view <?php if($type == 'grid') echo 'active'?>"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                        <a href="<?php echo esc_url(s7upf_get_key_url('type','list'))?>" class="list-view <?php if($type == 'list') echo 'active'?>"><i class="fa fa-th-list" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-4 hidden-xs">
                    <?php 
                        $price_filter = s7upf_get_option('woo_shop_price_filter');
                        if(!empty($price_filter) && is_array($price_filter)):
                    ?>
                    <div class="attribute-bar">
                        <div class="attr-bar price-bar">
                            <a href="#"><?php esc_html_e("Price","fashionstore");?></a>
                            <ul class="list-unstyled">
                                <?php
                                    foreach ($price_filter as $price) {
                                        if(!empty($price)) echo '<li><a href="'.esc_url(s7upf_get_key_url2('min_price',$price['price_min'],'max_price',$price['price_max'])).'">'.esc_html($price['title']).'</a></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                        endif;
                    ?>
                </div>
                <div class="col-md-4 col-sm-5 col-xs-6">
                    <div class="wrap-sort-pagi">
                        <div class="attr-bar sort-bar">
                            <?php s7upf_catalog_ordering($product_query)?>
                        </div>
                        <div class="pagibar">
                            <?php
                            echo paginate_links( array(
                                'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
                                'format'       => '',
                                'add_args'     => '',
                                'current'      => max( 1, get_query_var( 'paged' ) ),
                                'total'        => $product_query->max_num_pages,
                                'prev_text'    => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                                'next_text'    => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                                'type'         => 'plain',
                                'end_size'     => 2,
                                'mid_size'     => 1
                            ) );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-<?php echo esc_attr($type)?>view">
            <ul class="row list-unstyled">
        <?php
        $count_product = 1;
        if($product_query->have_posts()) {
            while($product_query->have_posts()) {
                $product_query->the_post();
                global $product;
                if($type == 'list'){?>
                    <li class="col-md-12 col-sm-12 col-xs-12">
                        <?php
                        $size = array(367,468);
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
                            $image_pager  = wp_get_attachment_image( $attachment_id, array(50,64), 0, $attr = array(
                                'title' => $image_title,
                                'alt'   => $image_title
                                ) );
                            if($i == 1) $active = 'active';
                            else $active = '';
                            $page_index = $i-1;
                            $ul_block .= '<li>
                                            <div class="product-thumb product-thumb-link">
                                                <a href="#" class="product-thumb-link">'.$image.'
                                                <a data-product-id="'.get_the_id().'" href="'.esc_url(get_the_permalink()).'" class="quick-view-link quickview-link">
                                                    '.esc_html__("Quick View","fashionstore").'
                                                </a>
                                            </div>
                                        </li>';
                            $pager_html .=  '<a data-slide-index="'.$page_index.'" href="#">'.$image_pager.'</a>';
                            $i++;
                        }
                        $available_data = array();
                        if( $product->is_type( 'variable' ) ) $available_data = $product->get_available_variations();        
                        if(!empty($available_data)){
                            foreach ($available_data as $available) {
                                if(!empty($available['image_src'])){
                                    $page_index = $i-1;
                                    $ul_block .= '<li data-variation_id="'.$available['variation_id'].'">
                                                    <div class="product-thumb product-thumb-link">
                                                        <a href="#" class="product-thumb-link">'.s7upf_get_image_by_url($available['image_link'],$size).'</a>
                                                        <a data-product-id="'.get_the_id().'" href="'.esc_url(get_the_permalink()).'" class="quick-view-link quickview-link">
                                                            '.esc_html__("Quick View","fashionstore").'
                                                        </a>
                                                    </div>                                  
                                                </li>';
                                    $pager_html .=  '<a data-variation_id="'.$available['variation_id'].'" data-slide-index="'.$page_index.'" href="#">'.s7upf_get_image_by_url($available['image_link'],array(50,64)).'</a>';
                                    $i++;
                                }
                            }
                        }
                        $stock = $product->get_availability();
                        $s_class = '';
                        if(is_array($stock)){
                            if(!empty($stock['class'])) $s_class = $stock['class'];
                            if(!empty($stock['availability'])) $stock = $stock['availability'];
                            else {
                                if($stock['class'] == 'in-stock') $stock = esc_html__("In stock","fashionstore");
                                else $stock = esc_html__("Out of stock","fashionstore");
                            }
                        }
                        echo    '<div class="item-product-list">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            <div class="product-gallery">
                                                <ul class="bxslider">
                                                    '.$ul_block.'
                                                </ul>
                                                <div class="bx-pager">
                                                    '.$pager_html.'
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                <ul class="list-rate-review list-inline">
                                                    <li>
                                                        '.s7upf_get_rating_html().'
                                                    </li>
                                                    <li><span class="number-review">'.$product->get_review_count().' '.esc_html__("Review(s)","fashionstore").'</span></li>
                                                    <li><span class="inout-stock '.esc_attr($s_class).'">'.esc_html($stock).'</span></li>
                                                </ul>
                                                <p class="product-desc">'.get_the_excerpt().'</p>
                                                <div class="extra-price">
                                                    '.s7upf_get_price_html().'
                                                    '.s7upf_product_link().'
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        ?>      
                    </li>
                <?php }
                else{
                    $b_col = 12;$col = 3;$size = array(370,472);
                    if($column == 'col-md-12 col-sm-12') $col_option = 1;
                    if($column == 'col-md-6 col-sm-6') $col_option = 2;
                    if($column == 'col-md-4 col-sm-4') $col_option = 3;
                    if($column == 'col-md-3 col-sm-4') $col_option = 4;
                    if($column == 'col-md-2 col-sm-3') $col_option = 6;
                    if(!empty($col_option)) $col = $b_col/(int)$col_option;
                    if($col_option == 2) $size = array(370*1.6,472*1.6);
                    if($col_option == 1) $size = 'full';
                    ?>
                    <li class="col-md-<?php echo esc_attr($col)?> col-sm-4 col-xs-12">
                        <?php 
                            echo    '<div class="item-product">
                                        '.s7upf_product_thumb_hover($size).'
                                        <div class="product-info">
                                            <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                            '.s7upf_get_price_html().'
                                            '.s7upf_get_rating_html().'
                                            '.s7upf_product_link().'
                                        </div>
                                    </div>';
                        ?>
                    </li>
                    <?php 
                }
            }
        }
        ?>
            </ul>
        </div>
        <div class="shop-pagibar bottom">
            <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-6">
                    <div class="view-bar">
                        <label><?php esc_html_e("View:","fashionstore");?></label>
                        <a href="<?php echo esc_url(s7upf_get_key_url('type','grid'))?>" class="grid-view <?php if($type == 'grid') echo 'active'?>"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                        <a href="<?php echo esc_url(s7upf_get_key_url('type','list'))?>" class="list-view <?php if($type == 'list') echo 'active'?>"><i class="fa fa-th-list" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-4 hidden-xs">
                    <?php 
                        $price_filter = s7upf_get_option('woo_shop_price_filter');
                        if(!empty($price_filter) && is_array($price_filter)):
                    ?>
                    <div class="attribute-bar">
                        <div class="attr-bar price-bar">
                            <a href="#"><?php esc_html_e("Price","fashionstore");?></a>
                            <ul class="list-unstyled">
                                <?php
                                    foreach ($price_filter as $price) {
                                        if(!empty($price)) echo '<li><a href="'.esc_url(s7upf_get_key_url2('min_price',$price['price_min'],'max_price',$price['price_max'])).'">'.esc_html($price['title']).'</a></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                        endif;
                    ?>
                </div>
                <div class="col-md-4 col-sm-5 col-xs-6">
                    <div class="wrap-sort-pagi">
                        <div class="attr-bar sort-bar">
                            <?php s7upf_catalog_ordering($product_query)?>
                        </div>
                        <div class="pagibar">
                            <?php
                            echo paginate_links( array(
                                'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
                                'format'       => '',
                                'add_args'     => '',
                                'current'      => max( 1, get_query_var( 'paged' ) ),
                                'total'        => $product_query->max_num_pages,
                                'prev_text'    => '<i class="fa fa-angle-double-left" aria-hidden="true"></i>',
                                'next_text'    => '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                                'type'         => 'plain',
                                'end_size'     => 2,
                                'mid_size'     => 1
                            ) );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $html .= ob_get_clean();
        wp_reset_postdata();
        return $html;
    }
}

stp_reg_shortcode('sv_shop','sv_vc_shop');
add_action( 'vc_before_init_base','sv_admin_shop',10,100 );
if ( ! function_exists( 'sv_admin_shop' ) ) {
    function sv_admin_shop(){
        vc_map( array(
            "name"      => esc_html__("SV Shop", 'fashionstore'),
            "base"      => "sv_shop",
            "icon"      => "icon-st",
            "category"  => '7Up-theme',
            "params"    => array(
                array(
                    "type" => "textfield",
                    "holder"    => 'div',
                    "heading" => esc_html__("Title",'fashionstore'),
                    "param_name" => "title",
                    ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Style",'fashionstore'),
                    "param_name" => "style",
                    "value"     => array(
                        esc_html__("Grid",'fashionstore')   => 'grid',
                        esc_html__("List",'fashionstore')   => 'list',
                        ),
                    ),
                array(
                    'heading'     => esc_html__( 'Number', 'fashionstore' ),
                    'type'        => 'textfield',
                    'description' => esc_html__( 'Enter number of product. Default is 12.', 'fashionstore' ),
                    'param_name'  => 'number',
                    ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Order By",'fashionstore'),
                    "param_name" => "orderby",
                    "value"     => array(
                        esc_html__("Default sorting",'fashionstore')   => 'menu_order',
                        esc_html__("Sort by popularity",'fashionstore')   => 'popularity',
                        esc_html__("Sort by average rating",'fashionstore')   => 'rating',
                        esc_html__("Sort by newness",'fashionstore')   => 'date',
                        esc_html__("Sort by price: low to high",'fashionstore')   => 'price',
                        esc_html__("Sort by price: high to low",'fashionstore')   => 'price-desc',
                        ),
                    ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Column",'fashionstore'),
                    "param_name" => "column",
                    "value"         => array(
                        esc_html__("1 Column","fashionstore")          => 'col-md-12 col-sm-12',
                        esc_html__("2 Column","fashionstore")          => 'col-md-6 col-sm-6',
                        esc_html__("3 Column","fashionstore")          => 'col-md-4 col-sm-4',
                        esc_html__("4 Column","fashionstore")          => 'col-md-3 col-sm-4',
                        esc_html__("6 Column","fashionstore")          => 'col-md-2 col-sm-3',
                        ),
                    ),            
                array(
                    'holder'     => 'div',
                    'heading'     => esc_html__( 'Custom Product Categories', 'fashionstore' ),
                    'type'        => 'checkbox',
                    'param_name'  => 'cats',
                    'value'       => s7upf_list_taxonomy('product_cat',false)
                    ),
                ),
        ));
    }
}