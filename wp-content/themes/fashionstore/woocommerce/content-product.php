<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;
// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;
?>
<?php
	$type = 'grid';
    if(isset($_GET['type'])){
        $type = $_GET['type'];
    }
?>
<?php if($type == 'list'){?>
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
		echo 	'<div class="item-product-list">
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
		$col_option = $woocommerce_loop['columns'];
		if(isset($_GET['column'])){
	        $col_option = $_GET['column'];
	    }
		if(!empty($col_option)) $col = $b_col/(int)$col_option;
		if($col_option == 2) $size = array(370*1.5,472*1.5);
		if($col_option == 1) $size = 'full';
	?>
	<li class="col-md-<?php echo esc_attr($col)?> col-sm-4 col-xs-12">
		<?php 
			echo 	'<div class="item-product">
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
<?php }?>