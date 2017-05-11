<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
if(!class_exists('S7upf_Advantage_Widget'))
{
    class S7upf_Advantage_Widget extends WP_Widget {


        protected $default=array();

        static function _init()
        {
            add_action( 'widgets_init', array(__CLASS__,'_add_widget') );
        }

        static function _add_widget()
        {
            register_widget( 'S7upf_Advantage_Widget' );
        }

        function __construct() {
            // Instantiate the parent object
            parent::__construct( false, esc_html__('Advantage Slider','fashionstore'),
                array( 'description' => esc_html__( 'Add advantage slider', 'fashionstore' ), ));

            $this->default=array(
                'title'=> '',
                'advs'=> array()
            );
        }



        function widget( $args, $instance ) {
            // Widget output
           echo balancetags($args['before_widget']);

            $instance=wp_parse_args($instance,$this->default);
            if ( ! empty( $instance['title'] ) ) {
               echo balancetags($args['before_title']) . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
            }
            echo        '<div class="wg-adv-slider owl-paginav">
                            <div class="wrap-item">';
                            $advs = $instance['advs'];
                            if(is_object($advs)) $advs = json_decode(json_encode($advs), true);
                            foreach($advs as $item) {
                                if(!empty($item['image'])){
                                    echo    '<div class="item">
                                                <div class="zoom-image">
                                                    <a href="'.esc_url($item['link']).'"><img src="'.esc_url($item['image']).'" alt=""></a>
                                                </div>
                                            </div>';
                                } 
                            }
                            ?>
                            </div>
                        </div>
            <?php
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
                <h3 for="<?php echo esc_attr($this->get_field_id( 'advs' )); ?>"><?php esc_html_e( 'Advantages' ,'fashionstore'); ?></h3>
                <div class="sv-add">
                    <div class="add" data-idname="<?php echo esc_attr($this->get_field_name('advs'))?>">
                        <?php
                        if(is_object($advs)) $advs = json_decode(json_encode($advs), true);
                        if(isset($advs[1]) && !empty($advs[1])) {

                            for ($i = 1; $i <= count($advs) +1; $i++) {
                                if(isset($advs[$i]['image']) && isset($advs[$i]['link'])) {
                                    echo '<div class="sv-add-item" data-item="' . $i . '">';                                   
                                    echo '<label>'. esc_html__( 'Link' ,'fashionstore') .'</label>';
                                    echo '<input type ="text" style="margin-top:10px; margin-bottom: 10px; display: block; " class ="images-url widefat" value="' . $advs[$i]['link'] . '" name="' . $this->get_field_name('advs') . '[' . $i . '][link]">';
                                    echo '<label style="display: block;">'. esc_html__( 'Image' ,'fashionstore') .'</label>';
                                    echo '<div class="live-previews"><img style="max-width: 100%; width:100%;" class ="image-preview" src="' . esc_url($advs[$i]['image']) . '"></div>';
                                    echo '<input type ="hidden" class ="custom_media_url images-img-link sv-image-value" value="' . $advs[$i]['image'] . '" name="' . $this->get_field_name('advs') . '[' . $i . '][image]">';
                                    echo '<button class="sv-button-upload" style="background: #00A0D2;  color: #fff;  border: none;  padding: 7px 10px;">' . esc_html__("Upload", 'fashionstore') . '</button>';
                                    echo '<button class="sv-remove-item" style="margin-right: 15px; margin-bottom: 10px;  margin-top: 10px;  background: #D2001D;  color: #fff;  border: none;  padding: 7px 10px;">' . esc_html__("Remove", 'fashionstore') . '</button>';
                                    echo ' <hr>';
                                    echo '</div>';
                                }
                            }
                        }
                        ?>
                    </div>
                    <button class="sv-button-add-slider widefat" style="width: 110px; height: 30px; background: #00A0D2; color: #fff;   border: none; margin-top: 10px; margin-right: 15px">
                        <?php esc_html_e("Add Item",'fashionstore')?>
                    </button>
                </div>
            </p>
        <?php
        }
    }

    S7upf_Advantage_Widget::_init();

}
