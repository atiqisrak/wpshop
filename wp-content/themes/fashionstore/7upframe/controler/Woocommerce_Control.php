<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
/*********************************** ADD TO CART AJAX *******************************************/
if(class_exists("woocommerce")){
	add_action( 'wp_ajax_add_to_cart', 's7upf_minicart_ajax' );
	add_action( 'wp_ajax_nopriv_add_to_cart', 's7upf_minicart_ajax' );
	if(!function_exists('s7upf_minicart_ajax')){
		function s7upf_minicart_ajax() {
			
			$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
			$quantity = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
			$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

			if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity ) ) {
				do_action( 'woocommerce_ajax_added_to_cart', $product_id );
				WC_AJAX::get_refreshed_fragments();
			} else {
				$this->json_headers();

				// If there was an error adding to the cart, redirect to the product page to show any errors
				$data = array(
					'error' => true,
					'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
					);
				echo json_encode( $data );
			}
			die();
		}
	}
	/*********************************** END ADD TO CART AJAX ****************************************/

	/********************************** REMOVE ITEM MINICART AJAX ************************************/

	add_action( 'wp_ajax_product_remove', 's7upf_product_remove' );
	add_action( 'wp_ajax_nopriv_product_remove', 's7upf_product_remove' );
	if(!function_exists('s7upf_product_remove')){
		function s7upf_product_remove() {
		    global $wpdb, $woocommerce;
		    $cart_item_key = $_POST['cart_item_key'];
		    if ( $woocommerce->cart->get_cart_item( $cart_item_key ) ) {
				$woocommerce->cart->remove_cart_item( $cart_item_key );
			}
		    exit();
		}
	}

	/********************************** HOOK ************************************/

	//remove woo breadcrumbs
    add_action( 'init','s7upf_remove_wc_breadcrumbs' );

    // Remove page title
    add_filter( 'woocommerce_show_page_title', 's7upf_remove_page_title');

	// remove action wrap main content
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

    // Custom wrap main content
    add_action('woocommerce_before_main_content', 's7upf_add_before_main_content', 10);
    add_action('woocommerce_after_main_content', 's7upf_add_after_main_content', 10);

    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
   	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
   	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

   	add_filter( 'woocommerce_get_price_html', 's7upf_change_price_html', 100, 2 );

   	if(!function_exists('s7upf_change_price_html')){
    	function s7upf_change_price_html($price, $product){
    		$price = str_replace('&ndash;', '<span class="slipt">&ndash;</span>', $price);
    		$price = '<div class="product-price">'.$price.'</div>';
    		return $price;
    	}
    }

    function s7upf_add_before_main_content() {
        $col_class = 'shop-width-'.s7upf_get_option('woo_shop_column',3);
        global $count_product;
        $count_product = 1;
        ?>
        <div id="main-content" class="<?php echo esc_attr($col_class);?>">
            <div class="container">
                <?php s7upf_header_image();?>
            	<?php 
            	woocommerce_breadcrumb(array(
        			'delimiter'		=> ' ',
        			'wrap_before'	=> '<div class="bread-crumb bread-crumb-product">',
        			'wrap_after'	=> '</div>',
        		)); 
        		?>
                <div class="row">
                	<?php s7upf_output_sidebar('left')?>
                	<div class="<?php echo esc_attr(s7upf_get_main_class()); ?>">
                		<div class="content-shop clearfix">
        <?php
    }

    function s7upf_add_after_main_content() {
        ?>
                		</div>
                	</div>
                	<?php s7upf_output_sidebar('right')?>
            	</div>
            </div>
        </div>
        <?php
    }

    function s7upf_remove_wc_breadcrumbs()
    {
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
    }

    function s7upf_remove_page_title() {
        return false;
    }
	/********************************* END REMOVE ITEM MINICART AJAX *********************************/

	/********************************** FANCYBOX POPUP CONTENT ************************************/

	add_action( 'wp_ajax_product_popup_content', 's7upf_product_popup_content' );
	add_action( 'wp_ajax_nopriv_product_popup_content', 's7upf_product_popup_content' );
	if(!function_exists('s7upf_product_popup_content')){
		function s7upf_product_popup_content() {
			$product_id = $_POST['product_id'];
			$query = new WP_Query( array(
				'post_type' => 'product',
				'post__in' => array($product_id)
				));
			if( $query->have_posts() ):
				echo '<div class="woocommerce single-product product-popup-content"><div class="product has-sidebar">';
				while ( $query->have_posts() ) : $query->the_post();	
					global $post,$product,$woocommerce;			
					s7upf_product_main_detai(true);
				endwhile;
				echo '</div></div>';
			endif;
			wp_reset_postdata();
		}
	}
	//Custom woo shop column
    add_filter( 'loop_shop_columns', 's7upf_woo_shop_columns', 1, 10 );
    function s7upf_woo_shop_columns( $number_columns ) {
        $col = s7upf_get_option('woo_shop_column',3);
        return $col;
    }
    add_filter( 'loop_shop_per_page', 's7upf_woo_shop_number', 20 );
    function s7upf_woo_shop_number( $number) {
        $col = s7upf_get_option('woo_shop_number',12);
        return $col;
    }

    // Image Header category Product
    add_action('product_cat_add_form_fields', 's7upf_product_cat_metabox_add', 10, 1);
    add_action('product_cat_edit_form_fields', 's7upf_product_cat_metabox_edit', 10, 1);    
    add_action('created_product_cat', 'sv_product_save_category_metadata', 10, 1);    
    add_action('edited_product_cat', 'sv_product_save_category_metadata', 10, 1);

    // Image Header category Post
    add_action('category_add_form_fields', 's7upf_product_cat_metabox_add', 10, 1);
    add_action('category_edit_form_fields', 's7upf_product_cat_metabox_edit', 10, 1);
    add_action('created_category', 'sv_product_save_category_metadata', 10, 1);    
    add_action('edited_category', 'sv_product_save_category_metadata', 10, 1);

    if(!function_exists('s7upf_product_cat_metabox_add')){ 
        function s7upf_product_cat_metabox_add($tag) { 
            ?>
            <div class="form-field">
                <label><?php esc_html_e('Category Header Image','fashionstore'); ?></label>
                <div class="wrap-metabox">
                    <div class="live-previews"></div>
                    <a class="button button-primary sv-button-remove"> <?php esc_html_e("Remove","fashionstore")?></a>
                    <a class="button button-primary sv-button-upload"><?php esc_html_e("Upload","fashionstore")?></a>
                    <input name="cat-header-image" type="hidden" class="sv-image-value" value=""></input>
                </div>
            </div>            
            <div class="form-field">
                <label><?php esc_html_e('Category Header Link','fashionstore'); ?></label>
                <input name="cat-header-link" type="text" value="" size="40">
            </div>
        <?php }
    }
    if(!function_exists('s7upf_product_cat_metabox_edit')){ 
        function s7upf_product_cat_metabox_edit($tag) { ?>
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label><?php esc_html_e('Category Header Image','fashionstore'); ?></label>
                </th>
                <td>            
                    <div class="wrap-metabox">
                        <div class="live-previews">
                            <?php 
                                $image = get_term_meta($tag->term_id, 'cat-header-image', true);
                                echo '<img src="'.esc_url($image).'" />';
                            ?> 
                        </div>
                        <a class="button button-primary sv-button-remove"> <?php esc_html_e("Remove","fashionstore")?></a>
                        <a class="button button-primary sv-button-upload"><?php esc_html_e("Upload","fashionstore")?></a>
                        <input name="cat-header-image" type="hidden" class="sv-image-value" value=""></input>
                    </div>            
                </td>
            </tr>            
            <tr class="form-field">
                <th scope="row"><label><?php esc_html_e('Category Header Link','fashionstore'); ?></label></th>
                <td><input name="cat-header-link" type="text" value="<?php echo get_term_meta($tag->term_id, 'cat-header-link', true)?>" size="40">
            </tr>
        <?php }
    }
    if(!function_exists('sv_product_save_category_metadata')){ 
        function sv_product_save_category_metadata($term_id)
        {
            if (isset($_POST['cat-header-image'])) update_term_meta( $term_id, 'cat-header-image', $_POST['cat-header-image']);
            if (isset($_POST['cat-header-link'])) update_term_meta( $term_id, 'cat-header-link', $_POST['cat-header-link']);
        }
    }
    //end
    if(!function_exists('s7upf_update_wishlist_count')){
        function s7upf_update_wishlist_count(){
            if( function_exists( 'YITH_WCWL' ) ){
                wp_send_json( YITH_WCWL()->count_products() );
            }
        }
    }
    add_action( 'wp_ajax_update_wishlist_count', 's7upf_update_wishlist_count' );
    add_action( 'wp_ajax_nopriv_update_wishlist_count', 's7upf_update_wishlist_count' );

    if(!function_exists('s7upf_update_compare_count')){
        function s7upf_update_compare_count(){
            $count_cp = 0;
            if(class_exists('YITH_Woocompare_Frontend')){
                $compare = new YITH_Woocompare_Frontend();
                $count_cp = count($compare->products_list);
            }
            print $count_cp;
        }
    }
    add_action( 'wp_ajax_update_compare_count', 's7upf_update_compare_count' );
    add_action( 'wp_ajax_nopriv_update_compare_count', 's7upf_update_compare_count' );
}