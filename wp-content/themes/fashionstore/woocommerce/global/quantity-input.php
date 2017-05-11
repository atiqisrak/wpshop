<?php
/**
 * Product quantity inputs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="product-qty">
	<label><?php esc_html_e("Qty","fashionstore")?></label>
	<div class="quantity inner-product-qty">
		<a href="#" class="qty-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
		<input type="text" data-step="<?php echo esc_attr( $step ); ?>" <?php if ( is_numeric( $min_value ) ) : ?>data-min="<?php echo esc_attr( $min_value ); ?>"<?php endif; ?> <?php if ( is_numeric( $max_value ) ) : ?>data-max="<?php echo esc_attr( $max_value ); ?>"<?php endif; ?> name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'fashionstore' ) ?>" class="input-text text qty-number" size="4" />
		<a href="#" class="qty-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
	</div>
</div>