<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>
<div class="content-detail no-sidebar">
	<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php s7upf_product_main_detai()?>

		<meta itemprop="url" content="<?php the_permalink(); ?>" />
		<?php 
			$tabs = apply_filters( 'woocommerce_product_tabs', array() );
			// do_action( 'woocommerce_after_single_product_summary' );
		?>
		<?php 
			if(s7upf_check_sidebar()){
				?>
				<div class="tab-detail style2">
					<div class="title-tab-detail">
						<ul>
							<?php 
							$num=0;
							foreach ( $tabs as $key => $tab ) : 
							$num++;
						?>
							<li class="<?php if($num==1){echo 'active';}?>" role="presentation">
								<a href="<?php echo esc_url( '#sv-'.$key ); ?>" aria-controls="sv-<?php echo esc_attr( $key ); ?>" role="tab" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
							</li>
								
						<?php endforeach; ?>			
						<li role="presentation"><a href="<?php echo esc_url('#tags')?>" aria-controls="tags" role="tab" data-toggle="tab"><?php esc_html_e("Tags","fashionstore")?></a></li>
						<?php 
							$custom_tab = get_post_meta(get_the_ID(),'product_tab_data',true);
							if(!empty($custom_tab) && is_array($custom_tab)){
								foreach ($custom_tab as $c_tab) {
									$tab_slug = str_replace(' ', '-', $c_tab['title']);
									$tab_slug = strtolower($tab_slug);
									echo '<li role="presentation"><a href="'.esc_url('#sv-'.$tab_slug).'" aria-controls="tags" role="tab" data-toggle="tab">'.$c_tab['title'].'</a></li>';
								}
							}
						?>
						</ul>
					</div>
					<div class="tab-content">
						<?php 
							$num=0;
							foreach ( $tabs as $key => $tab ) : 
							$num++;
						?>
							<div role="tabpanel" class="tab-pane <?php if($num==1){echo 'active';}?>" id="sv-<?php echo esc_attr( $key ); ?>">
								<div class="content-tab-detail">
									<?php call_user_func( $tab['callback'], $key, $tab ); ?>
								</div>
							</div>
						<?php endforeach; ?>				
						<div role="tabpanel" class="tab-pane" id="tags">
							<div class="content-tab-detail">
								<?php 
									global $product,$post;
									$tag_count = sizeof( get_the_terms( get_the_ID(), 'product_tag' ) );
									$tag_html = $product->get_tags( ' ', '<div class="tagged_as">' . _n( '', '', $tag_count, 'fashionstore' ) . ' ', '</div>' );
									if($tag_html ) echo balanceTags($tag_html);
									else esc_html_e("No Tag","fashionstore");
								?>
							</div>
						</div>
						<?php 
							if(!empty($custom_tab) && is_array($custom_tab)){
								foreach ($custom_tab as $c_tab) {
									$tab_slug = str_replace(' ', '-', $c_tab['title']);
									$tab_slug = strtolower($tab_slug);
									echo '<div role="tabpanel" class="tab-pane" id="sv-'.$tab_slug.'">
											<div class="content-tab-detail">
												'.apply_filters('the_content',$c_tab['tab_content']).'
											</div>
										</div>';
								}
							}
						?>
					</div>
				</div>
				<?php
				s7upf_single_lastest_product('style2');
				s7upf_single_upsell_product('style2');
				s7upf_single_relate_product('style2');
				?>
				<?php
			}
			else{
		?>
		<div class="row">
			<div class="col-md-6 col-sm-12 col-xs-12">
				<?php
				s7upf_single_lastest_product();
				s7upf_single_upsell_product();
				s7upf_single_relate_product();
				?>
			</div>
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="tab-detail">
					<div class="title-tab-detail">
						<ul>
							<?php 
							$num=0;
							foreach ( $tabs as $key => $tab ) : 
							$num++;
						?>
							<li class="<?php if($num==1){echo 'active';}?>" role="presentation">
								<a href="<?php echo esc_url( '#sv-'.$key ); ?>" aria-controls="sv-<?php echo esc_attr( $key ); ?>" role="tab" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
							</li>
								
						<?php endforeach; ?>			
						<li role="presentation"><a href="<?php echo esc_url('#tags')?>" aria-controls="tags" role="tab" data-toggle="tab"><?php esc_html_e("Tags","fashionstore")?></a></li>
						<?php 
							$custom_tab = get_post_meta(get_the_ID(),'product_tab_data',true);
							if(!empty($custom_tab) && is_array($custom_tab)){
								foreach ($custom_tab as $c_tab) {
									$tab_slug = str_replace(' ', '-', $c_tab['title']);
									$tab_slug = strtolower($tab_slug);
									echo '<li role="presentation"><a href="'.esc_url('#sv-'.$tab_slug).'" aria-controls="tags" role="tab" data-toggle="tab">'.$c_tab['title'].'</a></li>';
								}
							}
						?>
						</ul>
					</div>
					<div class="tab-content">
						<?php 
							$num=0;
							foreach ( $tabs as $key => $tab ) : 
							$num++;
						?>
							<div role="tabpanel" class="tab-pane <?php if($num==1){echo 'active';}?>" id="sv-<?php echo esc_attr( $key ); ?>">
								<div class="content-tab-detail">
									<?php call_user_func( $tab['callback'], $key, $tab ); ?>
								</div>
							</div>
						<?php endforeach; ?>				
						<div role="tabpanel" class="tab-pane" id="tags">
							<div class="content-tab-detail">
								<?php 
									global $product,$post;
									$tag_count = sizeof( get_the_terms( get_the_ID(), 'product_tag' ) );
									$tag_html = $product->get_tags( ' ', '<div class="tagged_as">' . _n( '', '', $tag_count, 'fashionstore' ) . ' ', '</div>' );
									if($tag_html ) echo balanceTags($tag_html);
									else esc_html_e("No Tag","fashionstore");
								?>
							</div>
						</div>
						<?php 
							if(!empty($custom_tab) && is_array($custom_tab)){
								foreach ($custom_tab as $c_tab) {
									$tab_slug = str_replace(' ', '-', $c_tab['title']);
									$tab_slug = strtolower($tab_slug);
									echo '<div role="tabpanel" class="tab-pane" id="sv-'.$tab_slug.'">
											<div class="content-tab-detail">
												'.apply_filters('the_content',$c_tab['tab_content']).'
											</div>
										</div>';
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
			}
		?>
	</div>	
	<?php do_action( 'woocommerce_after_single_product' ); ?>
</div>
