<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_product'))
{
    function s7upf_vc_product($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'title'         => '',
            'title_first'   => '',
            'des'           => '',
            'time'          => '',
            'link'          => '',
            'product_id'    => '',
        ),$attr));
        if(!empty($product_id)){
            $query = new WP_Query( array(
                'post_type' => 'product',
                'post__in' => array($product_id)
                ));
            if( $query->have_posts() ):
                while ( $query->have_posts() ) : $query->the_post();
                    global $product;
                        $thumb_id = array(get_post_thumbnail_id());
                        $attachment_ids = $product->get_gallery_attachment_ids();
                        $attachment_ids = array_merge($thumb_id,$attachment_ids);
                        $item_html = '';$index = 0;
                        foreach ( $attachment_ids as $attachment_id ) {
                            $image_link = wp_get_attachment_url( $attachment_id );
                            if ( ! $image_link )
                                continue;
                            $image_title    = esc_attr( get_the_title( $attachment_id ) );
                            $image_caption  = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
                            $image       = wp_get_attachment_image( $attachment_id, array(350,447), 0, $attr = array(
                                'title' => $image_title,
                                'alt'   => $image_title
                                ) );
                            $item_html .= '<div class="item"><a href="#">'.$image.'</a></div>';
                            $index++;
                        }
                        $available_data = array();
                        if( $product->is_type( 'variable' ) ) $available_data = $product->get_available_variations();        
                        if(!empty($available_data)){
                            foreach ($available_data as $available) {
                                if(!empty($available['image_src'])){
                                    $item_html .= '<div data-index="'.esc_attr($index).'" data-variation_id="'.$available['variation_id'].'" class="item"><a href="#">'.s7upf_get_image_by_url($available['image_link'],array(350,447)).'</a></div>';
                                    $index++;
                                }
                            }
                        }
                        $html .= '<div class="supper-deal11-wrap">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <div class="intro-deal11">';
                        if(!empty($title_first))    $html .= '<h3>'.esc_html($title_first).'</h3>';
                        if(!empty($title))          $html .= '<h2>'.esc_html($title).'</h2>';
                        if(!empty($des))            $html .= '<p>'.esc_html($des).'</p>';
                        if(!empty($time))           $html .= '<div class="deal-count11" data-date="'.esc_attr($time).'"></div>';
                        if(!empty($link))           $html .= '<a href="'.esc_url($link).'" class="btn-link11 style2" data-hover="'.esc_attr__("view all","fashionstore").'"><span>'.esc_html__("view all","fashionstore").'</span></a>';
                        $html .=            '</div>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <div class="product-supper11">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="supper-gal">
                                                            <div class="owl-directnav product-detail11">
                                                                <div class="wrap-item">
                                                                    '.$item_html.'
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="product-info">
                                                            <h3 class="title-product"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                            '.s7upf_get_price_html().'
                                                            '.s7upf_get_rating_html();
                                                            ob_start();
                                                            woocommerce_template_single_add_to_cart();
                                                            $html .=    ob_get_clean();
                        $html .=                            '<div class="supper-deal-link hidden">
                                                                <a href="'.esc_url(get_the_permalink()).'" class="view-detail11 btn-link11" data-hover="'.esc_attr__("view detail","fashionstore").'"><span>'.esc_html__("view detail","fashionstore").'</span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                endwhile;
            endif;
            wp_reset_postdata();            
        }        
        return $html;
    }
}

stp_reg_shortcode('sv_product','s7upf_vc_product');

vc_map( array(
    "name"      => esc_html__("SV Product", 'fashionstore'),
    "base"      => "sv_product",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            'heading'     => esc_html__( 'Product ID', 'fashionstore' ),
            'holder'      => 'div',
            'type'        => 'textfield',
            'param_name'  => 'product_id',
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Time Countdown",'fashionstore'),
            "param_name" => "time",
            'description'   => esc_html__( 'Enter Time for countdown. Format is mm/dd/yyyy. Example: 12/15/2016.', 'fashionstore' ),
        ),
        array(
            'type'        => 'textfield',
            'holder'      => 'h3',
            'heading'     => esc_html__( 'Title Fisrt', 'fashionstore' ),
            'param_name'  => 'title_first',
        ),
        array(
            'heading'     => esc_html__( 'Title', 'fashionstore' ),
            'holder'      => 'h2',
            'type'        => 'textfield',
            'param_name'  => 'title',
        ),
        array(
            'type'        => 'textfield',
            'holder'      => 'div',
            'heading'     => esc_html__( 'Description', 'fashionstore' ),
            'param_name'  => 'des',
        ),
        array(
            'heading'     => esc_html__( 'View Link', 'fashionstore' ),
            'type'        => 'textfield',
            'param_name'  => 'link',
        ),
    )
));