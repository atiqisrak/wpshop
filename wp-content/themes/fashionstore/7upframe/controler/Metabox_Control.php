<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */

add_action('admin_init', 's7upf_custom_meta_boxes');
if(!function_exists('s7upf_custom_meta_boxes')){
    function s7upf_custom_meta_boxes(){
        //Format content
        $format_metabox = array(
            'id' => 'block_format_content',
            'title' => esc_html__('Format Settings', 'fashionstore'),
            'desc' => '',
            'pages' => array('post'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(                
                array(
                    'id' => 'format_image',
                    'label' => esc_html__('Upload Image', 'fashionstore'),
                    'type' => 'upload',
                ),
                array(
                    'id' => 'format_gallery',
                    'label' => esc_html__('Add Gallery', 'fashionstore'),
                    'type' => 'Gallery',
                ),
                array(
                    'id' => 'format_media',
                    'label' => esc_html__('Link Media', 'fashionstore'),
                    'type' => 'text',
                )
            ),
        );
        // SideBar
    	$sidebar_metabox_default = array(
            'id'        => 'sv_sidebar_option',
            'title'     => 'Advanced Settings',
            'desc'      => '',
            'pages'     => array( 'page','post','product'),
            'context'   => 'side',
            'priority'  => 'low',
            'fields'    => array(
                array(
                    'id'          => 'sv_sidebar_position',
                    'label'       => esc_html__('Sidebar position ','fashionstore'),
                    'type'        => 'select',
                    'std' => '',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('--Select--','fashionstore'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('No Sidebar','fashionstore'),
                            'value'=>'no'
                        ),
                        array(
                            'label'=>esc_html__('Left sidebar','fashionstore'),
                            'value'=>'left'
                        ),
                        array(
                            'label'=>esc_html__('Right sidebar','fashionstore'),
                            'value'=>'right'
                        ),
                    ),

                ),
                array(
                    'id'        =>'sv_select_sidebar',
                    'label'     =>esc_html__('Selects sidebar','fashionstore'),
                    'type'      =>'sidebar-select',
                    'condition' => 'sv_sidebar_position:not(no),sv_sidebar_position:not()',
                ),
                array(
                    'id'          => 'sv_show_breadrumb',
                    'label'       => esc_html__('Show Breadcrumb','fashionstore'),
                    'type'        => 'select',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('--Select--','fashionstore'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('Yes','fashionstore'),
                            'value'=>'yes'
                        ),
                        array(
                            'label'=>esc_html__('No','fashionstore'),
                            'value'=>'no'
                        ),
                    ),

                ),
                array(
                    'id'          => 'sv_header_page',
                    'label'       => esc_html__('Choose page header','fashionstore'),
                    'type'        => 'select',
                    'choices'     => s7upf_list_header_page()
                ),
                array(
                    'id'          => 'sv_footer_page',
                    'label'       => esc_html__('Choose page footer','fashionstore'),
                    'type'        => 'page-select'
                )
            )
        );  
        //Show page title
        $show_page_title = array(
            'id' => 'page_title_setting',
            'title' => esc_html__('Page setting', 'fashionstore'),
            'pages' => array('page'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id' => 'show_title_page',
                    'label' => esc_html__('Show title', 'fashionstore'),
                    'type' => 'on-off',
                    'std'   => 'on',
                ),
                array(
                    'id'          => 'show_header_page',
                    'label'       => esc_html__('Header page image','fashionstore'),
                    'type'        => 'select',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('--Select--','fashionstore'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('Yes','fashionstore'),
                            'value'=>'on'
                        ),
                        array(
                            'label'=>esc_html__('No','fashionstore'),
                            'value'=>'off'
                        ),
                    ),
                ),
                array(
                    'id'          => 'header_page_image',
                    'label'       => esc_html__('Header page Image','fashionstore'),
                    'type'        => 'upload',
                    'condition'   => 'show_header_page:is(on)',
                ),
                array(
                    'id'          => 'header_page_link',
                    'label'       => esc_html__('Header page link','fashionstore'),
                    'type'        => 'text',
                    'condition'   => 'show_header_page:is(on)',
                ),
            )
        );
        $product_custom_tab = array(
            'id' => 'block_product_custom_tab',
            'title' => esc_html__('Product Display', 'fashionstore'),
            'desc' => '',
            'pages' => array('product'),
            'context' => 'normal',
            'priority' => 'low',
            'fields' => array(                
                array(
                    'id'          => 'product_tab_data',
                    'label'       => esc_html__('Custom Tab','fashionstore'),
                    'type'        => 'list-item',
                    'settings'    => array(
                        array(
                            'id' => 'tab_content',
                            'label' => esc_html__('Content', 'fashionstore'),
                            'type' => 'textarea',
                        ),
                    )
                ),
            ),
        );
        $product_trendding = array(
            'id' => 'product_trendding',
            'title' => esc_html__('Product Type', 'fashionstore'),
            'desc' => '',
            'pages' => array('product'),
            'context' => 'side',
            'priority' => 'high',
            'fields' => array(                
                array(
                    'id'    => 'trending_product',
                    'label' => esc_html__('Product Trendding', 'fashionstore'),
                    'type'        => 'on-off',
                    'std'         => 'off'
                ),
            ),
        );
        $product_metabox = array(
            'id' => 'block_product_thumb_hover',
            'title' => esc_html__('Product hover image', 'fashionstore'),
            'desc' => '',
            'pages' => array('product'),
            'context' => 'side',
            'priority' => 'low',
            'fields' => array(                
                array(
                    'id'    => 'product_thumb_hover',
                    'label' => esc_html__('Product hover image', 'fashionstore'),
                    'type'  => 'upload',
                ),
                array(
                    'id'          => 'attribute_style',
                    'label'       => esc_html__('Attributes Style','fashionstore'),
                    'type'        => 'select',
                    'choices'     => array(  
                        array(
                            'value'=> '',
                            'label'=> esc_html__("-- Select --", 'fashionstore'),
                        ),                                                  
                        array(
                            'value'=> 'default',
                            'label'=> esc_html__("Default", 'fashionstore'),
                        ),
                        array(
                            'value'=> 'special',
                            'label'=> esc_html__("Special", 'fashionstore'),
                        ),
                    )
                ),
            ),
        );
        if (function_exists('ot_register_meta_box')){
            ot_register_meta_box($format_metabox);
            ot_register_meta_box($sidebar_metabox_default);
            ot_register_meta_box($show_page_title);
            ot_register_meta_box($product_custom_tab);
            ot_register_meta_box($product_trendding);
            ot_register_meta_box($product_metabox);
        }
    }
}
?>