<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
if(!class_exists('S7upf_Service'))
{
    class S7upf_Service extends WP_Widget {


        protected $default=array();

        static function _init()
        {
            add_action( 'widgets_init', array(__CLASS__,'_add_widget') );
        }

        static function _add_widget()
        {
            register_widget( 'S7upf_Service' );
        }

        function __construct() {
            // Instantiate the parent object
            parent::__construct( false, esc_html__('SV Service','fashionstore'),
                array( 'description' => esc_html__( 'Service Widget', 'fashionstore' ), ));

            $this->default=array(
                'title' =>  esc_html__('Service Center','fashionstore'),
                'des'=>'',
            );
        }



        function widget( $args, $instance ) {
            // Widget output
           echo balancetags($args['before_widget']);
            if ( ! empty( $instance['title'] ) ) {
               echo balancetags($args['before_title']) . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
            }

            $instance=wp_parse_args($instance,$this->default);
            extract($instance);
            echo balancetags($des);
            
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
                <label for="<?php echo esc_attr($this->get_field_id( 'des' )); ?>"><?php esc_html_e( 'Content:' ,'fashionstore'); ?></label>
                <textarea rows="16" cols="20" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'des' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'des' )); ?>"><?php echo esc_attr( $des ); ?></textarea>
            </p>

        <?php
        }
    }

    S7upf_Service::_init();

}
