<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
if(!function_exists('s7upf_set_theme_config')){
    function s7upf_set_theme_config(){
        global $s7upf_dir,$s7upf_config;
        /**************************************** BEGIN ****************************************/
        $s7upf_dir = get_template_directory_uri() . '/7upframe';
        $s7upf_config = array();
        $s7upf_config['dir'] = $s7upf_dir;
        $s7upf_config['css_url'] = $s7upf_dir . '/assets/css/';
        $s7upf_config['js_url'] = $s7upf_dir . '/assets/js/';
        $s7upf_config['nav_menu'] = array(
            'primary' => esc_html__( 'Primary Navigation', 'fashionstore' ),
        );
        $s7upf_config['mega_menu'] = '1';
        $s7upf_config['sidebars']=array(
            array(
                'name'              => esc_html__( 'Blog Sidebar', 'fashionstore' ),
                'id'                => 'blog-sidebar',
                'description'       => esc_html__( 'Widgets in this area will be shown on all blog page.', 'fashionstore'),
                'before_title'      => '<h3 class="widget-title"><span>',
                'after_title'       => '</span></h3>',
                'before_widget'     => '<div id="%1$s" class="sidebar-widget widget %2$s">',
                'after_widget'      => '</div>',
            )
        );
        $s7upf_config['import_config'] = array(
                'homepage_default'          => 'Home',
                'blogpage_default'          => 'Blog',
                'menu_locations'            => array("Main Menu" => "primary"),
                'set_woocommerce_page'      => 1
            );
        $s7upf_config['import_theme_option'] = 'YTo0NDp7czoxNDoic3ZfaGVhZGVyX3BhZ2UiO3M6MjoiMzEiO3M6MTQ6InN2X2Zvb3Rlcl9wYWdlIjtzOjI6IjMzIjtzOjExOiJzdl80MDRfcGFnZSI7czowOiIiO3M6MTY6InNob3dfaGVhZGVyX3BhZ2UiO3M6Mjoib24iO3M6MTc6ImhlYWRlcl9wYWdlX2ltYWdlIjtzOjgwOiJodHRwOi8vN3VwdGhlbWUuY29tL3dvcmRwcmVzcy9mYXNoaW9uc3RvcmUvd3AtY29udGVudC91cGxvYWRzLzIwMTYvMDkvYm4tYmwxLmpwZyI7czoxNjoiaGVhZGVyX3BhZ2VfbGluayI7czoxOiIjIjtzOjE3OiJzdl9zaG93X2JyZWFkcnVtYiI7czoyOiJvbiI7czoxNjoic3ZfYmdfYnJlYWRjcnVtYiI7czowOiIiO3M6MTA6Im1haW5fY29sb3IiO3M6MDoiIjtzOjEwOiJjdXN0b21fY3NzIjtzOjA6IiI7czo0OiJsb2dvIjtzOjc4OiJodHRwOi8vN3VwdGhlbWUuY29tL3dvcmRwcmVzcy9mYXNoaW9uc3RvcmUvd3AtY29udGVudC91cGxvYWRzLzIwMTYvMDkvbG9nby5wbmciO3M6NzoiZmF2aWNvbiI7czo3NzoiaHR0cDovLzd1cHRoZW1lLmNvbS93b3JkcHJlc3MvZmFzaGlvbnN0b3JlL3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDE2LzA5Lzd1cC5qcGciO3M6MTM6InN2X21lbnVfZml4ZWQiO3M6Mjoib24iO3M6MTM6InN2X21lbnVfY29sb3IiO3M6MDoiIjtzOjE5OiJzdl9tZW51X2NvbG9yX2hvdmVyIjtzOjA6IiI7czoyMDoic3ZfbWVudV9jb2xvcl9hY3RpdmUiO3M6MDoiIjtzOjI0OiJzdl9zaWRlYmFyX3Bvc2l0aW9uX2Jsb2ciO3M6NToicmlnaHQiO3M6MTU6InN2X3NpZGViYXJfYmxvZyI7czoxMjoiYmxvZy1zaWRlYmFyIjtzOjEzOiJzdl9zdHlsZV9ibG9nIjtzOjU6InBvc3QzIjtzOjI0OiJzdl9zaWRlYmFyX3Bvc2l0aW9uX3BhZ2UiO3M6Mjoibm8iO3M6MTU6InN2X3NpZGViYXJfcGFnZSI7czowOiIiO3M6MzI6InN2X3NpZGViYXJfcG9zaXRpb25fcGFnZV9hcmNoaXZlIjtzOjU6InJpZ2h0IjtzOjIzOiJzdl9zaWRlYmFyX3BhZ2VfYXJjaGl2ZSI7czoxMjoiYmxvZy1zaWRlYmFyIjtzOjI0OiJzdl9zaWRlYmFyX3Bvc2l0aW9uX3Bvc3QiO3M6NToicmlnaHQiO3M6MTU6InN2X3NpZGViYXJfcG9zdCI7czoxMjoiYmxvZy1zaWRlYmFyIjtzOjE0OiJzdl9hZGRfc2lkZWJhciI7YToxOntpOjA7YToyOntzOjU6InRpdGxlIjtzOjE5OiJXb29jb21tZXJjZSBTaWRlYmFyIjtzOjIwOiJ3aWRnZXRfdGl0bGVfaGVhZGluZyI7czoyOiJoMyI7fX1zOjEyOiJnb29nbGVfZm9udHMiO2E6MTp7aTowO2E6MTp7czo2OiJmYW1pbHkiO3M6MDoiIjt9fXM6MjM6InN2X3NpZGViYXJfcG9zaXRpb25fd29vIjtzOjI6Im5vIjtzOjE0OiJzdl9zaWRlYmFyX3dvbyI7czowOiIiO3M6MTU6Indvb19zaG9wX251bWJlciI7czoxOiI5IjtzOjIwOiJzaG93X2hlYWRlcl9wYWdlX3dvbyI7czoyOiJvbiI7czoyMToiaGVhZGVyX3BhZ2VfaW1hZ2Vfd29vIjtzOjgwOiJodHRwOi8vN3VwdGhlbWUuY29tL3dvcmRwcmVzcy9mYXNoaW9uc3RvcmUvd3AtY29udGVudC91cGxvYWRzLzIwMTYvMDkvYm4tbHQxLmpwZyI7czoyMDoiaGVhZGVyX3BhZ2VfbGlua193b28iO3M6MToiIyI7czoyMToid29vX3Nob3BfcHJpY2VfZmlsdGVyIjthOjM6e2k6MDthOjM6e3M6NToidGl0bGUiO3M6NjoiMCAtIDUwIjtzOjk6InByaWNlX21pbiI7czoxOiIwIjtzOjk6InByaWNlX21heCI7czoyOiI1MCI7fWk6MTthOjM6e3M6NToidGl0bGUiO3M6ODoiNTAgLSAxMDAiO3M6OToicHJpY2VfbWluIjtzOjI6IjUwIjtzOjk6InByaWNlX21heCI7czozOiIxMDAiO31pOjI7YTozOntzOjU6InRpdGxlIjtzOjk6IjEwMCAtIDIwMCI7czo5OiJwcmljZV9taW4iO3M6MzoiMTAwIjtzOjk6InByaWNlX21heCI7czozOiIyMDAiO319czoxNToid29vX3Nob3BfY29sdW1uIjtzOjE6IjMiO3M6MTU6InN2X3NldF90aW1lX3dvbyI7czowOiIiO3M6MTk6Indvb19hdHRyX2JhY2tncm91bmQiO2E6Mzp7aTowO2E6Mzp7czo1OiJ0aXRsZSI7czo1OiJCZWlnZSI7czo5OiJhdHRyX3NsdWciO3M6NToiYmVpZ2UiO3M6NzoiYXR0cl9iZyI7czo3OiIjZTM2ZDU1Ijt9aToxO2E6Mzp7czo1OiJ0aXRsZSI7czo1OiJCbGFjayI7czo5OiJhdHRyX3NsdWciO3M6NToiYmxhY2siO3M6NzoiYXR0cl9iZyI7czo3OiIjNTU1NTU1Ijt9aToyO2E6Mzp7czo1OiJ0aXRsZSI7czo2OiJZZWxsb3ciO3M6OToiYXR0cl9zbHVnIjtzOjY6InllbGxvdyI7czo3OiJhdHRyX2JnIjtzOjc6IiNmMWNhMmQiO319czozMDoic3Zfc2lkZWJhcl9wb3NpdGlvbl93b29fc2luZ2xlIjtzOjU6InJpZ2h0IjtzOjIxOiJzdl9zaWRlYmFyX3dvb19zaW5nbGUiO3M6MTk6Indvb2NvbW1lcmNlLXNpZGViYXIiO3M6MTU6ImF0dHJpYnV0ZV9zdHlsZSI7czo3OiJzcGVjaWFsIjtzOjE4OiJzaG93X3NpbmdsZV9udW1iZXIiO3M6MToiNiI7czoxOToic2hvd19zaW5nbGVfbGFzdGVzdCI7czozOiJvZmYiO3M6MTg6InNob3dfc2luZ2xlX3Vwc2VsbCI7czozOiJvZmYiO3M6MTg6InNob3dfc2luZ2xlX3JlbGF0ZSI7czoyOiJvbiI7fQ==';
        $s7upf_config['import_widget'] = '{"blog-sidebar":{"s7upf_category_widget-1":{"title":"Categories","number":""},"s7upf_listpostswidget-1":{"title":"Recent post","posts_per_page":"5","category":"0","order":"desc","order_by":"None"},"tag_cloud-1":{"title":"Tags","taxonomy":"post_tag"},"s7upf_advantage_widget-1":{"title":"ADVERTISEMENT","advs":{"1":{"link":"#","image":"http:\/\/localhost\/fashionstore\/wp-content\/uploads\/2016\/08\/ad-1.png"},"2":{"link":"#","image":"http:\/\/localhost\/fashionstore\/wp-content\/uploads\/2016\/08\/ad-2.png"},"3":{"link":"#","image":"http:\/\/localhost\/fashionstore\/wp-content\/uploads\/2016\/08\/ad-3.png"}}},"text-1":{"title":"INFORMATION","text":"<ul class=\"list-unstyled widget-faqs\">\r\n<li class=\"active\">\t\t\t\t\t\t\t\t\t\t<h3>Delivery<\/h3>\t\t\t\t\t\t\t\t\t\t<p>Packages are generally dispatched within 2 days after receipt of payment and are shipped via UPS with tracking and drop-off without signature. <\/p>\t\t\t\t\t\t\t\t\t<\/li>\r\n<li>\t\t\t\t\t\t\t\t\t\t<h3>Terms and conditions of use<\/h3>\t\t\t\t\t\t\t\t\t\t<p>Packages are generally dispatched within 2 days after receipt of payment and are shipped via UPS with tracking and drop-off without signature. <\/p>\t\t\t\t\t\t\t\t\t<\/li>\r\n<li>\t\t\t\t\t\t\t\t\t\t<h3>Secure payment<\/h3>\t\t\t\t\t\t\t\t\t\t<p>Packages are generally dispatched within 2 days after receipt of payment and are shipped via UPS with tracking and drop-off without signature. <\/p>\t\t\t\t\t\t\t\t\t<\/li>\r\n<li>\r\n<h3>Our stores<\/h3>\t\t\t\t\t\t\t\t\t\t<p>Packages are generally dispatched within 2 days after receipt of payment and are shipped via UPS with tracking and drop-off without signature. <\/p>\t\t\t\t\t\t\t\t\t<\/li>\r\n<li>\r\n<h3> About us<\/h3>\t\t\t\t\t\t\t\t\t\t<p>Packages are generally dispatched within 2 days after receipt of payment and are shipped via UPS with tracking and drop-off without signature. <\/p>\t\t\t\t\t\t\t\t\t<\/li>\r\n<\/ul>","filter":false}},"woocommerce-sidebar":{"s7upf_service-1":{"title":"Service Center","des":"<ul>\t\t\t\t\t\t\t\t\t<li><a href=\"tel:+84936238836\"><i class=\"fa fa-phone\" aria-hidden=\"true\"><\/i>Lelia<\/a><\/li>\t\t\t\t\t\t\t\t\t<li><a href=\"callTo:karaxapo\"><i class=\"fa fa-skype\" aria-hidden=\"true\"><\/i>Spider-Man<\/a><\/li>\t\t\t\t\t\t\t\t\t<li><a href=\"mailto:7uptheme@gmail.com\"><i class=\"fa fa-envelope-o\" aria-hidden=\"true\"><\/i>Contact Now<\/a><\/li>\t\t\t\t\t\t\t\t<\/ul>"},"s7upf_list_products-1":{"title":"NEW PRODUCT","number":"3","product_type":"","link":"#","label":"All new products"}}}';
        $s7upf_config['import_category'] = '';

        /**************************************** PLUGINS ****************************************/

        $s7upf_config['require-plugin'] = array(    
            array(
                'name'               => esc_html__('Option Tree','fashionstore'), // The plugin name.
                'slug'               => 'option-tree', // The plugin slug (typically the folder name).
                'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            ),
            array(
                'name'      => esc_html__('Contact Form 7','fashionstore'),
                'slug'      => 'contact-form-7',
                'required'  => true,
            ),
            array(
                'name'      => esc_html__('Visual Composer','fashionstore'),
                'slug'      => 'js_composer',
                'required'  => true,
                'source'    =>get_template_directory_uri().'/plugins/js_composer.zip'
            ),
            array(
                'name'      => esc_html__('7up Core','fashionstore'),
                'slug'      => '7up-core',
                'required'  => true,
                'source'    =>get_template_directory_uri().'/plugins/7up-core.zip'
            ),
            array(
                'name'      => esc_html__('WooCommerce','fashionstore'),
                'slug'      => 'woocommerce',
                'required'  => true,
            ),
            array(
                'name'      => esc_html__('MailChimp for WordPress Lite','fashionstore'),
                'slug'      => 'mailchimp-for-wp',
                'required'  => true,
            ),
            array(
                'name'      => esc_html__('Yith Woocommerce Compare','fashionstore'),
                'slug'      => 'yith-woocommerce-compare',
                'required'  => true,
            ),
            array(
                'name'      => esc_html__('Yith Woocommerce Wishlist','fashionstore'),
                'slug'      => 'yith-woocommerce-wishlist',
                'required'  => true,
            )
        );

    /**************************************** PLUGINS ****************************************/
        $s7upf_config['theme-option'] = array(
            'sections' => array(
                array(
                    'id' => 'option_general',
                    'title' => '<i class="fa fa-cog"></i>'.esc_html__(' General Settings', 'fashionstore')
                ),
                array(
                    'id' => 'option_logo',
                    'title' => '<i class="fa fa-image"></i>'.esc_html__(' Logo Settings', 'fashionstore')
                ),
                array(
                    'id' => 'option_menu',
                    'title' => '<i class="fa fa-align-justify"></i>'.esc_html__(' Menu Settings', 'fashionstore')
                ),
                array(
                    'id' => 'option_layout',
                    'title' => '<i class="fa fa-columns"></i>'.esc_html__(' Layout Settings', 'fashionstore')
                ),
                array(
                    'id' => 'option_typography',
                    'title' => '<i class="fa fa-font"></i>'.esc_html__(' Typography', 'fashionstore')
                )
            ),
            'settings' => array(
                 /*----------------Begin General --------------------*/
                array(
                    'id'          => 'sv_header_page',
                    'label'       => esc_html__( 'Header Page', 'fashionstore' ),
                    'desc'        => esc_html__( 'Include page to Header', 'fashionstore' ),
                    'type'        => 'select',
                    'section'     => 'option_general',
                    'choices'     => s7upf_list_header_page()
                ),
                array(
                    'id'          => 'sv_footer_page',
                    'label'       => esc_html__( 'Footer Page', 'fashionstore' ),
                    'desc'        => esc_html__( 'Include page to Footer', 'fashionstore' ),
                    'type'        => 'page-select',
                    'section'     => 'option_general'
                ),
                array(
                    'id'          => 'sv_404_page',
                    'label'       => esc_html__( '404 Page', 'fashionstore' ),
                    'desc'        => esc_html__( 'Include page to 404 page', 'fashionstore' ),
                    'type'        => 'page-select',
                    'section'     => 'option_general'
                ),
                array(
                    'id'          => 'show_header_page',
                    'label'       => esc_html__('Header page image','fashionstore'),
                    'type'        => 'on-off',
                    'section'     => 'option_general',
                    'std'         => 'off'
                ),
                array(
                    'id'          => 'header_page_image',
                    'label'       => esc_html__('Header page Image','fashionstore'),
                    'type'        => 'upload',
                    'section'     => 'option_general',
                    'condition'   => 'show_header_page:is(on)',
                ),
                array(
                    'id'          => 'header_page_link',
                    'label'       => esc_html__('Header page link','fashionstore'),
                    'type'        => 'text',
                    'section'     => 'option_general',
                    'condition'   => 'show_header_page:is(on)',
                ),
                array(
                    'id' => 'sv_show_breadrumb',
                    'label' => esc_html__('Show BreadCrumb', 'fashionstore'),
                    'desc' => esc_html__('This allow you to show or hide BreadCrumb', 'fashionstore'),
                    'type' => 'on-off',
                    'section' => 'option_general',
                    'std' => 'on'
                ),
                array(
                    'id'          => 'sv_bg_breadcrumb',
                    'label'       => esc_html__('Background Breadcrumb','fashionstore'),
                    'type'        => 'background',
                    'section'     => 'option_general',
                    'condition'   => 'sv_show_breadrumb:is(on)',
                ),
                array(
                    'id' => 'enable_rtl',
                    'label' => esc_html__('Enqueue RTL style', 'fashionstore'),
                    'type' => 'on-off',
                    'section' => 'option_general',
                    'std' => 'off'
                ),
                array(
                    'id'          => 'main_color',
                    'label'       => esc_html__('Main color','fashionstore'),
                    'type'        => 'colorpicker',
                    'section'     => 'option_general',
                ),
                array(
                    'id'          => 'map_api_key',
                    'label'       => esc_html__('Map API key','fashionstore'),
                    'type'        => 'text',
                    'section'     => 'option_general',
                    'std'         => 'AIzaSyBX2IiEBg-0lQKQQ6wk6sWRGQnWI7iogf0',
                ),
                array(
                    'id'          => 'custom_css',
                    'label'       => esc_html__('Custom CSS','fashionstore'),
                    'type'        => 'textarea-simple',
                    'section'     => 'option_general',
                ),
                /*----------------End General ----------------------*/

                /*----------------Begin Logo --------------------*/
                array(
                    'id' => 'logo',
                    'label' => esc_html__('Logo', 'fashionstore'),
                    'desc' => esc_html__('This allow you to change logo', 'fashionstore'),
                    'type' => 'upload',
                    'section' => 'option_logo',
                ),        
                array(
                    'id' => 'favicon',
                    'label' => esc_html__('Favicon', 'fashionstore'),
                    'desc' => esc_html__('This allow you to change favicon of your website', 'fashionstore'),
                    'type' => 'upload',
                    'section' => 'option_logo'
                ),
                /*----------------End Logo ----------------------*/

                /*----------------Begin Menu --------------------*/
                array(
                    'id'          => 'sv_menu_fixed',
                    'label'       => esc_html__('Menu Fixed','fashionstore'),
                    'desc'        => 'Menu change to fixed when scroll',
                    'type'        => 'on-off',
                    'section'     => 'option_menu',
                    'std'         => 'on',
                ),
                array(
                    'id'          => 'sv_menu_color',
                    'label'       => esc_html__('Menu style','fashionstore'),
                    'type'        => 'typography',
                    'section'     => 'option_menu',
                ),
                array(
                    'id'          => 'sv_menu_color_hover',
                    'label'       => esc_html__('Hover color','fashionstore'),
                    'desc'        => esc_html__('Choose color','fashionstore'),
                    'type'        => 'colorpicker',
                    'section'     => 'option_menu',
                ),
                array(
                    'id'          => 'sv_menu_color_active',
                    'label'       => esc_html__('Active color','fashionstore'),
                    'desc'        => esc_html__('Choose color','fashionstore'),
                    'type'        => 'colorpicker',
                    'section'     => 'option_menu',
                ),
                /*----------------End Menu ----------------------*/
                

                /*----------------Begin Layout --------------------*/
                array(
                    'id'          => 'sv_sidebar_position_blog',
                    'label'       => esc_html__('Sidebar Blog','fashionstore'),
                    'type'        => 'select',
                    'section'     => 'option_layout',
                    'desc'=>esc_html__('Left, or Right, or Center','fashionstore'),
                    'choices'     => array(
                        array(
                            'value'=>'no',
                            'label'=>esc_html__('No Sidebar','fashionstore'),
                        ),
                        array(
                            'value'=>'left',
                            'label'=>esc_html__('Left','fashionstore'),
                        ),
                        array(
                            'value'=>'right',
                            'label'=>esc_html__('Right','fashionstore'),
                        )
                    )
                ),
                array(
                    'id'          => 'sv_sidebar_blog',
                    'label'       => esc_html__('Sidebar select display in blog','fashionstore'),
                    'type'        => 'sidebar-select',
                    'section'     => 'option_layout',
                    'condition'   => 'sv_sidebar_position_blog:not(no)',
                ),
                array(
                    'id'          => 'sv_style_blog',
                    'label'       => esc_html__('Blog list style','fashionstore'),
                    'type'        => 'select',
                    'section'     => 'option_layout',
                    'choices'     => array(
                        array(
                            'value'=>'content',
                            'label'=>esc_html__('Default','fashionstore'),
                        ),
                        array(
                            'value'=>'post3',
                            'label'=>esc_html__('Default 3','fashionstore'),
                        ),
                        array(
                            'value'=>'fullwidth',
                            'label'=>esc_html__('FullWidth','fashionstore'),
                        ),
                        array(
                            'value'=>'masonry',
                            'label'=>esc_html__('Masonry','fashionstore'),
                        )
                    )
                ),
                /****end blog****/
                array(
                    'id'          => 'sv_sidebar_position_page',
                    'label'       => esc_html__('Sidebar Page','fashionstore'),
                    'type'        => 'select',
                    'section'     => 'option_layout',
                    'desc'=>esc_html__('Left, or Right, or Center','fashionstore'),
                    'choices'     => array(
                        array(
                            'value'=>'no',
                            'label'=>esc_html__('No Sidebar','fashionstore'),
                        ),
                        array(
                            'value'=>'left',
                            'label'=>esc_html__('Left','fashionstore'),
                        ),
                        array(
                            'value'=>'right',
                            'label'=>esc_html__('Right','fashionstore'),
                        )
                    )
                ),
                array(
                    'id'          => 'sv_sidebar_page',
                    'label'       => esc_html__('Sidebar select display in page','fashionstore'),
                    'type'        => 'sidebar-select',
                    'section'     => 'option_layout',
                    'condition'   => 'sv_sidebar_position_page:not(no)',
                ),
                /****end page****/
                array(
                    'id'          => 'sv_sidebar_position_page_archive',
                    'label'       => esc_html__('Sidebar Position on Page Archives:','fashionstore'),
                    'type'        => 'select',
                    'section'     => 'option_layout',
                    'desc'=>esc_html__('Left, or Right, or Center','fashionstore'),
                    'choices'     => array(
                        array(
                            'value'=>'no',
                            'label'=>esc_html__('No Sidebar','fashionstore'),
                        ),
                        array(
                            'value'=>'left',
                            'label'=>esc_html__('Left','fashionstore'),
                        ),
                        array(
                            'value'=>'right',
                            'label'=>esc_html__('Right','fashionstore'),
                        )
                    )
                ),
                array(
                    'id'          => 'sv_sidebar_page_archive',
                    'label'       => esc_html__('Sidebar select display in page Archives','fashionstore'),
                    'type'        => 'sidebar-select',
                    'section'     => 'option_layout',
                    'condition'   => 'sv_sidebar_position_page_archive:not(no)',
                ),
                // END
                array(
                    'id'          => 'sv_sidebar_position_post',
                    'label'       => esc_html__('Sidebar Single Post','fashionstore'),
                    'type'        => 'select',
                    'section'     => 'option_layout',
                    'desc'=>esc_html__('Left, or Right, or Center','fashionstore'),
                    'choices'     => array(
                        array(
                            'value'=>'no',
                            'label'=>esc_html__('No Sidebar','fashionstore'),
                        ),
                        array(
                            'value'=>'left',
                            'label'=>esc_html__('Left','fashionstore'),
                        ),
                        array(
                            'value'=>'right',
                            'label'=>esc_html__('Right','fashionstore'),
                        )
                    )
                ),
                array(
                    'id'          => 'sv_sidebar_post',
                    'label'       => esc_html__('Sidebar select display in single post','fashionstore'),
                    'type'        => 'sidebar-select',
                    'section'     => 'option_layout',
                    'condition'   => 'sv_sidebar_position_post:not(no)',
                ),
                array(
                    'id'          => 'sv_add_sidebar',
                    'label'       => esc_html__('Add SideBar','fashionstore'),
                    'type'        => 'list-item',
                    'section'     => 'option_layout',
                    'std'         => '',
                    'settings'    => array( 
                        array(
                            'id'          => 'widget_title_heading',
                            'label'       => esc_html__('Choose heading title widget','fashionstore'),
                            'type'        => 'select',
                            'std'        => 'h3',
                            'choices'     => array(
                                array(
                                    'value'=>'h1',
                                    'label'=>esc_html__('H1','fashionstore'),
                                ),
                                array(
                                    'value'=>'h2',
                                    'label'=>esc_html__('H2','fashionstore'),
                                ),
                                array(
                                    'value'=>'h3',
                                    'label'=>esc_html__('H3','fashionstore'),
                                ),
                                array(
                                    'value'=>'h4',
                                    'label'=>esc_html__('H4','fashionstore'),
                                ),
                                array(
                                    'value'=>'h5',
                                    'label'=>esc_html__('H5','fashionstore'),
                                ),
                                array(
                                    'value'=>'h6',
                                    'label'=>esc_html__('H6','fashionstore'),
                                ),
                            )
                        ),
                    ),
                ),
                /*----------------End Layout ----------------------*/

                /*----------------Begin Blog ----------------------*/       
                

                /*----------------End BLOG----------------------*/

                /*----------------Begin Typography ----------------------*/
                array(
                    'id'          => 'sv_custom_typography',
                    'label'       => esc_html__('Add Settings','fashionstore'),
                    'type'        => 'list-item',
                    'section'     => 'option_typography',
                    'std'         => '',
                    'settings'    => array(
                        array(
                            'id'          => 'typo_area',
                            'label'       => esc_html__('Choose Area to style','fashionstore'),
                            'type'        => 'select',
                            'std'        => 'main',
                            'choices'     => array(
                                array(
                                    'value'=>'header',
                                    'label'=>esc_html__('Header','fashionstore'),
                                ),
                                array(
                                    'value'=>'main',
                                    'label'=>esc_html__('Main Content','fashionstore'),
                                ),
                                array(
                                    'value'=>'widget',
                                    'label'=>esc_html__('Widget','fashionstore'),
                                ),
                                array(
                                    'value'=>'footer',
                                    'label'=>esc_html__('Footer','fashionstore'),
                                ),
                            )
                        ),
                        array(
                            'id'          => 'typo_heading',
                            'label'       => esc_html__('Choose heading Area','fashionstore'),
                            'type'        => 'select',
                            'std'        => 'h3',
                            'choices'     => array(
                                array(
                                    'value'=>'h1',
                                    'label'=>esc_html__('H1','fashionstore'),
                                ),
                                array(
                                    'value'=>'h2',
                                    'label'=>esc_html__('H2','fashionstore'),
                                ),
                                array(
                                    'value'=>'h3',
                                    'label'=>esc_html__('H3','fashionstore'),
                                ),
                                array(
                                    'value'=>'h4',
                                    'label'=>esc_html__('H4','fashionstore'),
                                ),
                                array(
                                    'value'=>'h5',
                                    'label'=>esc_html__('H5','fashionstore'),
                                ),
                                array(
                                    'value'=>'h6',
                                    'label'=>esc_html__('H6','fashionstore'),
                                ),
                                array(
                                    'value'=>'a',
                                    'label'=>esc_html__('a','fashionstore'),
                                ),
                                array(
                                    'value'=>'p',
                                    'label'=>esc_html__('p','fashionstore'),
                                ),
                            )
                        ),
                        array(
                            'id'          => 'typography_style',
                            'label'       => esc_html__('Add Style','fashionstore'),
                            'type'        => 'typography',
                            'section'     => 'option_typography',
                        ),
                    ),
                ),        
                array(
                    'id'          => 'google_fonts',
                    'label'       => esc_html__('Add Google Fonts','fashionstore'),
                    'type'        => 'google-fonts',
                    'section'     => 'option_typography',
                ),
                /*----------------End Typography ----------------------*/
            )
        );
        if(class_exists( 'WooCommerce' )){
            array_push($s7upf_config['theme-option']['sections'], array(
                                                        'id' => 'option_woo',
                                                        'title' => '<i class="fa fa-shopping-cart"></i>'.esc_html__(' Shop Settings', 'fashionstore')
                                                    ));
            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'sv_sidebar_position_woo',
                                                        'label'       => esc_html__('Sidebar Position WooCommerce page','fashionstore'),
                                                        'type'        => 'select',
                                                        'section'     => 'option_woo',
                                                        'desc'=>esc_html__('Left, or Right, or Center','fashionstore'),
                                                        'choices'     => array(
                                                            array(
                                                                'value'=>'no',
                                                                'label'=>esc_html__('No Sidebar','fashionstore'),
                                                            ),
                                                            array(
                                                                'value'=>'left',
                                                                'label'=>esc_html__('Left','fashionstore'),
                                                            ),
                                                            array(
                                                                'value'=>'right',
                                                                'label'=>esc_html__('Right','fashionstore'),
                                                            )
                                                        )
                                                    ));
            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'sv_sidebar_woo',
                                                        'label'       => esc_html__('Sidebar select WooCommerce page','fashionstore'),
                                                        'type'        => 'sidebar-select',
                                                        'section'     => 'option_woo',
                                                        'condition'   => 'sv_sidebar_position_woo:not(no)',
                                                        'desc'        => esc_html__('Choose one style of sidebar for WooCommerce page','fashionstore'),

                                                    ));
            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'woo_shop_number',
                                                        'label'       => esc_html__('Product Number','fashionstore'),
                                                        'type'        => 'text',
                                                        'section'     => 'option_woo',
                                                        'desc'        => esc_html__('Enter number product to display per page. Default is 12.','fashionstore')
                                                    ));
            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'show_header_page_woo',
                                                        'label'       => esc_html__('Header page image','fashionstore'),
                                                        'type'        => 'on-off',
                                                        'section'     => 'option_woo',
                                                        'std'         => 'off'
                                                    ));
            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'header_page_image_woo',
                                                        'label'       => esc_html__('Header page Image','fashionstore'),
                                                        'type'        => 'upload',
                                                        'section'     => 'option_woo',
                                                        'condition'   => 'show_header_page_woo:is(on)',
                                                    ));
            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'header_page_link_woo',
                                                        'label'       => esc_html__('Header page link','fashionstore'),
                                                        'type'        => 'text',
                                                        'section'     => 'option_woo',
                                                        'condition'   => 'show_header_page_woo:is(on)',
                                                    ));
            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'woo_shop_price_filter',
                                                        'label'       => esc_html__('Product Price Filter','fashionstore'),
                                                        'type'        => 'list-item',
                                                        'section'     => 'option_woo',
                                                        'std'         => '',
                                                        'settings'    => array( 
                                                            array(
                                                                'id'          => 'price_min',
                                                                'label'       => esc_html__('Price Min','fashionstore'),
                                                                'type'        => 'text',
                                                            ),
                                                            array(
                                                                'id'          => 'price_max',
                                                                'label'       => esc_html__('Price Max','fashionstore'),
                                                                'type'        => 'text',
                                                            ),
                                                        ),
                                                    ));

            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'woo_shop_column',
                                                        'label'       => esc_html__('Choose shop column','fashionstore'),
                                                        'type'        => 'select',
                                                        'section'     => 'option_woo',
                                                        'choices'     => array(                                                    
                                                            array(
                                                                'value'=> 1,
                                                                'label'=> 1,
                                                            ),
                                                            array(
                                                                'value'=> 2,
                                                                'label'=> 2,
                                                            ),
                                                            array(
                                                                'value'=> 3,
                                                                'label'=> 3,
                                                            ),
                                                            array(
                                                                'value'=> 4,
                                                                'label'=> 4,
                                                            ),
                                                        )
                                                    ));
            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'sv_set_time_woo',
                                                        'label'       => esc_html__('Product new in(days)','fashionstore'),
                                                        'type'        => 'text',
                                                        'section'     => 'option_woo',
                                                        'desc'        => esc_html__('Enter number to set time for product is new. Unit day. Default is 30.','fashionstore')
                                                    ));

            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'woo_attr_background',
                                                        'label'       => esc_html__('Product Attribute Background','fashionstore'),
                                                        'type'        => 'list-item',
                                                        'section'     => 'option_woo',
                                                        'std'         => '',
                                                        'settings'    => array( 
                                                            array(
                                                                'id'          => 'attr_slug',
                                                                'label'       => esc_html__('Term Slug Attribute','fashionstore'),
                                                                'type'        => 'text',
                                                            ),
                                                            array(
                                                                'id'          => 'attr_bg',
                                                                'label'       => esc_html__('Term Attribute Background','fashionstore'),
                                                                'type'        => 'colorpicker',
                                                            ),
                                                        ),
                                                    ));
            
            array_push($s7upf_config['theme-option']['sections'], array(
                                                        'id' => 'option_product',
                                                        'title' => '<i class="fa fa-th-large"></i>'.esc_html__(' Product Settings', 'fashionstore')
                                                    ));
            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'sv_sidebar_position_woo_single',
                                                        'label'       => esc_html__('Sidebar Position WooCommerce Single','fashionstore'),
                                                        'type'        => 'select',
                                                        'section'     => 'option_product',
                                                        'desc'=>esc_html__('Left, or Right, or Center','fashionstore'),
                                                        'std'         => 'no',
                                                        'choices'     => array(
                                                            array(
                                                                'value'=>'no',
                                                                'label'=>esc_html__('No Sidebar','fashionstore'),
                                                            ),
                                                            array(
                                                                'value'=>'left',
                                                                'label'=>esc_html__('Left','fashionstore'),
                                                            ),
                                                            array(
                                                                'value'=>'right',
                                                                'label'=>esc_html__('Right','fashionstore'),
                                                            ),
                                                        )
                                                    ));
            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'sv_sidebar_woo_single',
                                                        'label'       => esc_html__('Sidebar select WooCommerce Single','fashionstore'),
                                                        'type'        => 'sidebar-select',
                                                        'section'     => 'option_product',
                                                        'condition'   => 'sv_sidebar_position_woo_single:not(no)',
                                                        'desc'        => esc_html__('Choose one style of sidebar for WooCommerce page','fashionstore'),
                                                    ));
            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'attribute_style',
                                                        'label'       => esc_html__('Attribute Style','fashionstore'),
                                                        'type'        => 'select',
                                                        'section'     => 'option_product',
                                                        'choices'     => array(                                                    
                                                            array(
                                                                'value'=> 'normal',
                                                                'label'=> esc_html__("Normal", 'fashionstore'),
                                                            ),
                                                            array(
                                                                'value'=> 'special',
                                                                'label'=> esc_html__("Special", 'fashionstore'),
                                                            ),
                                                        )
                                                    ));
            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'show_single_number',
                                                        'label'       => esc_html__('Show Single Products Number','fashionstore'),
                                                        'type'        => 'text',
                                                        'section'     => 'option_product',
                                                    ));
            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'show_single_lastest',
                                                        'label'       => esc_html__('Show Single Lastest Products','fashionstore'),
                                                        'type'        => 'on-off',
                                                        'section'     => 'option_product',
                                                        'std'         => 'off'
                                                    ));
            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'show_single_upsell',
                                                        'label'       => esc_html__('Show Single Upsell Products','fashionstore'),
                                                        'type'        => 'on-off',
                                                        'section'     => 'option_product',
                                                        'std'         => 'on'
                                                    ));
            array_push($s7upf_config['theme-option']['settings'],array(
                                                        'id'          => 'show_single_relate',
                                                        'label'       => esc_html__('Show Single Relate Products','fashionstore'),
                                                        'type'        => 'on-off',
                                                        'section'     => 'option_product',
                                                        'std'         => 'off'
                                                    ));
        }
    }
}
s7upf_set_theme_config();