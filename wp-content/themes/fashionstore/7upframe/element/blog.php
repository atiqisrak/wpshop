<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 29/02/16
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_blog'))
{
    function s7upf_vc_blog($attr)
    {
        $html = $class_nav = '';
        extract(shortcode_atts(array(
            'style'      => 'content',
            'number'     => '',
            'sv_excerpt'    => '',
            'cats'      => '',
            'order'      => '',
            'order_by'   => '',
        ),$attr));
        global $gsv_excerpt;
        $gsv_excerpt = $sv_excerpt;
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        $args=array(
            'post_type'         => 'post',
            'posts_per_page'    => $number,
            'orderby'           => $order_by,
            'order'             => $order,
            'paged'             => $paged,
        );
        if($order_by == 'post_views'){
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'post_views';
        }
        if($order_by == 'time_update'){
            $args['orderby'] = 'meta_value';
            $args['meta_key'] = 'time_update';
        }
        if($order_by == '_post_like_count'){
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_post_like_count';
        }
        if(!empty($cats)) {
            $custom_list = explode(",",$cats);
            $args['tax_query'][]=array(
                'taxonomy'=>'category',
                'field'=>'slug',
                'terms'=> $custom_list
            );
        }
        $query = new WP_Query($args);
        global $count;
        $count = 1;
        $count_query = $query->post_count;
        $max_page = $query->max_num_pages;
        $html .=    '<div class="content-blog list-blog-'.$style.'">
                        <div class="content-blog-inner">';
        ob_start();
        if($query->have_posts()) {
            while($query->have_posts()) {
                $query->the_post();
                get_template_part( 's7upf_templates/blog-content/'.$style );
                $count++;
            }
        }
        $html .=    ob_get_clean();
        $html .=        '</div>';
        if($style != 'masonry'){
            $big = 999999999;
            $html .=        '<div class="pagibar text-right">';
            $html .=            paginate_links( array(
                                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                    'format'       => '&page=%#%',
                                    'current'      => max( 1, $paged ),
                                    'total'        => $query->max_num_pages,
                                    'prev_text' => '<i aria-hidden="true" class="fa fa-angle-double-left"></i>',
                                    'next_text' => '<i aria-hidden="true" class="fa fa-angle-double-right"></i>',
                                    'end_size'     => 2,
                                    'mid_size'     => 1
                                ) );        
            $html .=        '</div>';
        }
        else{
            if($max_page > 1) $html .=    '<div class="masonry-loadmore"><a href="#" class="masonry-ajax" data-cat="'.$cats.'" data-number="'.$number.'"  data-order="'.$order.'" data-orderby="'.$order_by.'" data-paged="1"  data-maxpage="'.$max_page.'">'.esc_html__("load more items","fashionstore").'</a></div>';
        }
        $html .=    '</div>';
        wp_reset_postdata();
        return $html;
    }
}

stp_reg_shortcode('sv_blog','s7upf_vc_blog');

vc_map( array(
    "name"      => esc_html__("SV Blog", 'fashionstore'),
    "base"      => "sv_blog",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__("Number post",'fashionstore'),
            "param_name" => "number",
            'description'   => esc_html__( 'Number of post display in this element. Default is 10.', 'fashionstore' ),
        ),
        array(
            "type"          => "dropdown",
            "holder"        => "div",
            "heading"       => esc_html__("Style Post",'fashionstore'),
            "param_name"    => "style",
            "value"         => array(
                esc_html__("Default","fashionstore")           => 'content',
                esc_html__("Default 2","fashionstore")           => 'post',
                esc_html__("Default 3","fashionstore")           => 'post3',
                esc_html__("FullWidth","fashionstore")         => 'fullwidth',
                esc_html__("Masonry","fashionstore")           => 'masonry',
                ),
            'description'   => esc_html__( 'Choose style to display.', 'fashionstore' ),
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("SubString Excerpt",'fashionstore'),
            "param_name" => "sv_excerpt",
            'description' => esc_html__( 'Enter number character. Empty is full text.', 'fashionstore' ),
        ),        
        array(
            'holder'     => 'div',
            'heading'     => esc_html__( 'Categories', 'fashionstore' ),
            'type'        => 'checkbox',
            'param_name'  => 'cats',
            'value'       => s7upf_list_taxonomy('category',false)
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__("Order",'fashionstore'),
            "param_name"    => "order",
            "value"         => array(
                esc_html__('Desc','fashionstore') => 'DESC',
                esc_html__('Asc','fashionstore')  => 'ASC',
                ),
            'edit_field_class'=>'vc_col-sm-6 vc_column'
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__("Order By",'fashionstore'),
            "param_name"    => "order_by",
            "value"         => s7upf_get_order_list(),
            'edit_field_class'=>'vc_col-sm-6 vc_column'
        ),
    )
));
//Home 5
add_action( 'wp_ajax_load_more_post_masonry', 's7upf_load_more_post_masonry' );
add_action( 'wp_ajax_nopriv_load_more_post_masonry', 's7upf_load_more_post_masonry' );
if(!function_exists('s7upf_load_more_post_masonry')){
    function s7upf_load_more_post_masonry() {
        $number         = $_POST['number'];
        $order_by       = $_POST['orderby'];
        $order          = $_POST['order'];
        $cats           = $_POST['cats'];
        $paged          = $_POST['paged'];
        $html = '';
        $args   =   array(
            'post_type'         => 'post',
            'posts_per_page'    => $number,
            'orderby'           => $order_by,
            'order'             => $order,
            'paged'             => $paged + 1,
        );
        if($order_by == 'post_views'){
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'post_views';
        }
        if($order_by == 'time_update'){
            $args['orderby'] = 'meta_value';
            $args['meta_key'] = 'time_update';
        }
        if($order_by == '_post_like_count'){
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_post_like_count';
        }
        if(!empty($cats)) {
            $custom_list = explode(",",$cats);
            $args['tax_query']['relation'] = 'AND';
            $args['tax_query'][]=array(
                'taxonomy'  => 'category',
                'field'     => 'slug',
                'terms'     => $custom_list
            );
        }
        if(!empty($post_formats)) {
            $formats_list = explode(",",$post_formats);            
            $args['tax_query']['relation'] = 'AND';
            $args['tax_query'][]=array(
                'taxonomy'  => 'post_format',
                'field'     => 'slug',
                'terms'     => $formats_list
            );
        }             
        $query = new WP_Query($args);
        global $count;
        $count = 1;
        $count_query = $query->post_count;
        if($query->have_posts()) {
            while($query->have_posts()) {
                $query->the_post();
                get_template_part( 's7upf_templates/blog-content/masonry' );
                $count++;
            }
        }
        echo balanceTags($html);
        wp_reset_postdata();
    }
}