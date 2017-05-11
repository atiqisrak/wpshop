<?php
/**
 * Product Loop End
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 */
global $wp_query;
$type = 'grid';
if(isset($_GET['type'])){
    $type = $_GET['type'];
}
$column = s7upf_get_option('woo_shop_column',3);
if(isset($_GET['column'])){
        $column = $_GET['column'];
    }
if(isset($_GET['number'])){
    $number = $_GET['number'];
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
					<?php woocommerce_catalog_ordering()?>
				</div>
				<div class="pagibar">
					<?php
					echo paginate_links( array(
						'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
						'format'       => '',
						'add_args'     => '',
						'current'      => max( 1, get_query_var( 'paged' ) ),
						'total'        => $wp_query->max_num_pages,
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