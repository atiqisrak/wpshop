<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
if(!class_exists('S7upf_Category_Widget'))
{
    class S7upf_Category_Widget extends WP_Widget {


        protected $default=array();

        static function _init()
        {
            add_action( 'widgets_init', array(__CLASS__,'_add_widget') );
        }

        static function _add_widget()
        {
            register_widget( 'S7upf_Category_Widget' );
        }

        function __construct() {
            // Instantiate the parent object
            parent::__construct( false, esc_html__('SV Category','fashionstore'),
                array( 'description' => esc_html__( 'Lists Category', 'fashionstore' ), ));

            $this->default=array(
                'title'         => esc_html__('Categories','fashionstore'),
                'number'        => '',
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
            $cats = get_terms('category');
            $count = 1;
            global $wp_query;
            $term = $wp_query->get_queried_object();
            $current_term = '';
            if(isset($term->term_id)) $current_term = $term->term_id;
            if(!empty($cats) && is_array($cats)){
                echo    '<div class="widget-filter widget-filter-category">
                            <ul class="list-unstyled">';
                foreach ($cats as $cat) {
                    $cat_link = get_term_link( $cat->term_id, 'category' );
                    if($cat->term_id == $current_term) $li_class = 'active';
                    else $li_class = '';
                    echo        '<li class="'.esc_attr($li_class).'">
                                    <a href="'.esc_url($cat_link).'"><span></span>'.$cat->name.'</a>
                                    <span class="attr-product-num">('.$cat->count.')</span>
                                </li>';
                    if(!empty($number) && $count == (int)$number) break;
                    $count++;
                }
                echo        '</ul>
                        </div>';
            }
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
                <label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number:' ,'fashionstore'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr( $number ); ?>">
            </p>

        <?php
        }
    }

    S7upf_Category_Widget::_init();

}
