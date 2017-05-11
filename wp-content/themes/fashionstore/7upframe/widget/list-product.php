<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
if(!class_exists('S7upf_List_products'))
{
    class S7upf_List_products extends WP_Widget {


        protected $default=array();

        static function _init()
        {
            add_action( 'widgets_init', array(__CLASS__,'_add_widget') );
        }

        static function _add_widget()
        {
            register_widget( 'S7upf_List_products' );
        }

        function __construct() {
            // Instantiate the parent object
            parent::__construct( false, esc_html__('SV Products','fashionstore'),
                array( 'description' => esc_html__( 'Get products widget', 'fashionstore' ), ));

            $this->default=array(
                'title'     => '',
                'number'     => '',
                'product_type'     => '',
                'link'     => '',
                'label'     => '',
            );
        }

        function widget( $args, $instance ) {
            // Widget output
            echo balancetags($args['before_widget']);
            if ( ! empty( $instance['title'] ) ) {
               echo balancetags($args['before_title']) . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
            }
            $instance = wp_parse_args($instance,$this->default);
            extract($instance);
            $args_post=array(
                'post_type'         => 'product',
                'posts_per_page'    => $number,
                'orderby'           => 'date'
            );
            if($product_type == 'trendding'){
                $args_post['meta_query'][] = array(
                        'key'     => 'trending_product',
                        'value'   => 'on',
                        'compare' => '=',
                    );
            }
            if($product_type == 'toprate'){
                add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
                $args_post['no_found_rows'] = 1;
                $args_post['meta_query'] = WC()->query->get_meta_query();
            }
            if($product_type == 'mostview'){
                $args_post['meta_key'] = 'post_views';
                $args_post['orderby'] = 'meta_value_num';
            }
            if($product_type == 'bestsell'){
                $args_post['meta_key'] = 'total_sales';
                $args_post['orderby'] = 'meta_value_num';
            }
            if($product_type=='onsale'){
                $args_post['meta_query']['relation']= 'OR';
                $args_post['meta_query'][]=array(
                    'key'   => '_sale_price',
                    'value' => 0,
                    'compare' => '>',                
                    'type'          => 'numeric'
                );
                $args_post['meta_query'][]=array(
                    'key'   => '_min_variation_sale_price',
                    'value' => 0,
                    'compare' => '>',                
                    'type'          => 'numeric'
                );
            }
            if($product_type == 'featured'){
                $args_post['meta_key'] = '_featured';
                $args_post['meta_value'] = 'yes';
            }
            $query = new WP_Query($args_post);
            $html =    '';
            if($query->have_posts()) {
                $html .=    '<div class="widget-new-product">
                                <ul class="list-unstyled">';
                while($query->have_posts()) {
                    $query->the_post();
                    global $product;
                    $html .=        '<li>
                                        <div class="product-thumb">
                                            <div class="zoom-image"><a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),array(100,128)).'</a></div>
                                        </div>
                                        <div class="product-info">
                                            <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                            <p class="product-desc">'.s7upf_substr(get_the_excerpt(),0,60).'...</p>
                                            '.s7upf_get_price_html().'
                                        </div>
                                    </li>';
                }                
                $html .=        '</ul>';
                $html .=        '<a href="'.esc_url($link).'" class="btn-widget all-new-product">'.esc_html($label).'</a>';
                $html .=    '</div>';                
            }
            wp_reset_postdata();
            echo balancetags($html);
            echo balancetags($args['after_widget']);
        }

        function update( $new_instance, $old_instance ) {

            // Save widget options
            $instance=array();
            $instance=wp_parse_args($instance,$this->default);
            $new_instance=wp_parse_args($new_instance,$instance);

            return $new_instance;
        }

        function form( $instance ) {
            // Output admin widget options form

            $instance=wp_parse_args($instance,$this->default);
            extract($instance);
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:' ,'fashionstore'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number', 'fashionstore'); ?>: </label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('product_type')); ?>"><?php esc_html_e('Product Type', 'fashionstore'); ?>: </label>
                <select id="<?php echo esc_attr($this->get_field_id( 'product_type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'product_type' )); ?>">
                    <option value="" <?php if($product_type == '') echo'selected="selected"';?>><?php esc_html_e('Recent Product','fashionstore');?></option>
                    <option value="featured" <?php if($product_type == 'featured') echo'selected="selected"';?>><?php esc_html_e('Featured Product','fashionstore');?></option>
                    <option value="trending" <?php if($product_type == 'trending') echo'selected="selected"';?>><?php esc_html_e('Trending Product','fashionstore');?></option>
                    <option value="onsale" <?php if($product_type == 'onsale') echo'selected="selected"';?>><?php esc_html_e('Sale Product','fashionstore');?></option>
                    <option value="bestsell" <?php if($product_type == 'bestsell') echo'selected="selected"';?>><?php esc_html_e('Bestsell Product','fashionstore');?></option>
                    <option value="toprate" <?php if($product_type == 'toprate') echo'selected="selected"';?>><?php esc_html_e('Top rate Product','fashionstore');?></option>
                    <option value="mostview" <?php if($product_type == 'mostview') echo'selected="selected"';?>><?php esc_html_e('Most view Product','fashionstore');?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'link' )); ?>"><?php esc_html_e( 'Link:' ,'fashionstore'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'link' )); ?>" type="text" value="<?php echo esc_attr( $link ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'label' )); ?>"><?php esc_html_e( 'View Label:' ,'fashionstore'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'label' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'label' )); ?>" type="text" value="<?php echo esc_attr( $label ); ?>">
            </p>
        <?php
        }
    }

    S7upf_List_products::_init();

}
