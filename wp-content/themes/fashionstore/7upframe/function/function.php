<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
 
/******************************************Core Function******************************************/
//Get option
if(!function_exists('s7upf_get_option')){
	function s7upf_get_option($key,$default=NULL)
    {
        if(function_exists('ot_get_option'))
        {
            return ot_get_option($key,$default);
        }

        return $default;
    }
}

//Get list header page
if(!function_exists('s7upf_list_header_page'))
{
    function s7upf_list_header_page()
    {
        global $post;
        $page_list = array();
        $page_list[] = array(
            'value' => '',
            'label' => esc_html__('-- Choose One --','fashionstore')
        );
        $args= array(
        'post_type' => 'page',
        'posts_per_page' => -1, 
        );
        $query = new WP_Query($args);
        if($query->have_posts()): while ($query->have_posts()):$query->the_post();
            if (strpos($post->post_content, '[sv_logo') ||  strpos($post->post_content, '[sv_menu')) {
                $page_list[] = array(
                    'value' => $post->ID,
                    'label' => $post->post_title
                );
            }
            endwhile;
        endif;
        wp_reset_postdata();
        return $page_list;
    }
}

//Get list sidebar
if(!function_exists('s7upf_get_sidebar_ids'))
{
    function s7upf_get_sidebar_ids($for_optiontree=false)
    {
        global $wp_registered_sidebars;
        $r=array();
        $r[]=esc_html__('--Select--','fashionstore');
        if(!empty($wp_registered_sidebars)){
            foreach($wp_registered_sidebars as $key=>$value)
            {

                if($for_optiontree){
                    $r[]=array(
                        'value'=>$value['id'],
                        'label'=>$value['name']
                    );
                }else{
                    $r[$value['id']]=$value['name'];
                }
            }
        }
        return $r;
    }
}

//Get order list
if(!function_exists('s7upf_get_order_list'))
{
    function s7upf_get_order_list($current=false,$extra=array(),$return='array')
    {
        $default = array(
            esc_html__('None','fashionstore')               => 'none',
            esc_html__('Post ID','fashionstore')            => 'ID',
            esc_html__('Author','fashionstore')             => 'author',
            esc_html__('Post Title','fashionstore')         => 'title',
            esc_html__('Post Name','fashionstore')          => 'name',
            esc_html__('Post Date','fashionstore')          => 'date',
            esc_html__('Last Modified Date','fashionstore') => 'modified',
            esc_html__('Post Parent','fashionstore')        => 'parent',
            esc_html__('Random','fashionstore')             => 'rand',
            esc_html__('Comment Count','fashionstore')      => 'comment_count',
            esc_html__('View Post','fashionstore')          => 'post_views',
            esc_html__('Like Post','fashionstore')          => '_post_like_count',
            esc_html__('Custom Modified Date','fashionstore')=> 'time_update',            
        );

        if(!empty($extra) and is_array($extra))
        {
            $default=array_merge($default,$extra);
        }

        if($return=="array")
        {
            return $default;
        }elseif($return=='option')
        {
            $html='';
            if(!empty($default)){
                foreach($default as $key=>$value){
                    $selected=selected($key,$current,false);
                    $html.="<option {$selected} value='{$key}'>{$value}</option>";
                }
            }
            return $html;
        }
    }
}

// Get sidebar
if(!function_exists('s7upf_get_sidebar'))
{
    function s7upf_get_sidebar()
    {
        $default=array(
            'position'=>'right',
            'id'      =>'blog-sidebar'
        );

        return apply_filters('s7upf_get_sidebar',$default);
    }
}

//Favicon
if(!function_exists('s7upf_load_favicon') )
{
    function s7upf_load_favicon()
    {
        $value = s7upf_get_option('favicon');
        $favicon = (isset($value) && !empty($value))?$value:false;
        if($favicon)
            echo '<link rel="Shortcut Icon" href="' . esc_url( $favicon ) . '" type="image/x-icon" />' . "\n";
    }
}
if(!function_exists( 'wp_site_icon' ) ){
    add_action( 'wp_head','s7upf_load_favicon');
    add_action('login_head', 's7upf_load_favicon');
    add_action('admin_head', 's7upf_load_favicon');
}

//Fill css background
if(!function_exists('s7upf_fill_css_background'))
{
    function s7upf_fill_css_background($data)
    {
        $string = '';
        if(!empty($data['background-color'])) $string .= 'background-color:'.$data['background-color'].';'."\n";
        if(!empty($data['background-repeat'])) $string .= 'background-repeat:'.$data['background-repeat'].';'."\n";
        if(!empty($data['background-attachment'])) $string .= 'background-attachment:'.$data['background-attachment'].';'."\n";
        if(!empty($data['background-position'])) $string .= 'background-position:'.$data['background-position'].';'."\n";
        if(!empty($data['background-size'])) $string .= 'background-size:'.$data['background-size'].';'."\n";
        if(!empty($data['background-image'])) $string .= 'background-image:url("'.$data['background-image'].'");'."\n";
        if(!empty($string)) return S7upf_Assets::build_css($string);
        else return false;
    }
}

// Get list menu
if(!function_exists('s7upf_list_menu_name'))
{
    function s7upf_list_menu_name()
    {
        $menu_nav = wp_get_nav_menus();
        $menu_list = array('Default' => '');
        if(is_array($menu_nav) && !empty($menu_nav))
        {
            foreach($menu_nav as $item)
            { 
                if(is_object($item))
                {
                    $menu_list[$item->name] = $item->slug;
                }
            }
        }
        return $menu_list;
    }
}

//Display BreadCrumb
if(!function_exists('s7upf_display_breadcrumb'))
{
    function s7upf_display_breadcrumb()
    {
        $breadcrumb = s7upf_get_value_by_id('sv_show_breadrumb','on');
        if($breadcrumb == 'on'){ 
            $b_class = s7upf_fill_css_background(s7upf_get_option('sv_bg_breadcrumb'));
            ?>
            <div class="bread-crumb <?php echo esc_attr($b_class)?>">
                <?php 
                    if(function_exists('bcn_display')) bcn_display();
                    else s7upf_breadcrumb();
                ?>
            </div>
        <?php }
    }
}

//Custom BreadCrumb
if(!function_exists('s7upf_breadcrumb'))
{
    function s7upf_breadcrumb() {
        global $post;
        if (!is_home() || (is_home() && !is_front_page())) {
            echo '<a href="'.esc_url(home_url('/')).'">'.esc_html__("Home","fashionstore").'</a> ';
            if(is_home() && !is_front_page()){
                echo esc_html__('Blog','fashionstore'); 
            }
            if (is_category() || is_single()) {
                the_category(' ');
                if (is_single()) {
                    echo '<span>';
                    the_title();
                    echo '</span>';
                }
            } elseif (is_page()) {
                if($post->post_parent){
                    $anc = get_post_ancestors( get_the_ID() );
                    $title = get_the_title();
                    foreach ( $anc as $ancestor ) {
                        $output = '<a href="'.esc_url(get_permalink($ancestor)).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a> ';
                    }
                    echo balanceTags($output);
                    echo ' <span>'.$title.'</span>';
                } else {
                    echo ' <span>'.get_the_title().'</span>';
                }
            }
            elseif (is_tag()) {echo single_tag_title("", false);}
            elseif (is_day()) {echo esc_html__("Archive for ","fashionstore"); the_time(get_option( 'date_format' ));}
            elseif (is_month()) {echo esc_html__("Archive for ","fashionstore"); echo get_the_time('F, Y');}
            elseif (is_year()) {echo esc_html__("Archive for ","fashionstore"); echo getthe_time('Y');}
            elseif (is_author()) {echo esc_html__("Author Archive ","fashionstore");}
            elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo esc_html__("Blog Archives","fashionstore");}
            elseif (is_search()) {echo esc_html__("Search Results","fashionstore");}
        }
        elseif (is_tag()) {echo single_tag_title("", false);}
        elseif (is_day()) {echo esc_html__("Archive for ","fashionstore"); the_time(get_option( 'date_format' ));}
        elseif (is_month()) {echo esc_html__("Archive for ","fashionstore"); echo get_the_time('F, Y');}
        elseif (is_year()) {echo esc_html__("Archive for ","fashionstore"); echo getthe_time('Y');}
        elseif (is_author()) {echo esc_html__("Author Archive ","fashionstore");}
        elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo esc_html__("Blog Archives","fashionstore");}
        elseif (is_search()) {echo esc_html__("Search Results","fashionstore");}
    }
}

//Get page value by ID
if(!function_exists('s7upf_get_value_by_id'))
{   
    function s7upf_get_value_by_id($key)
    {
        if(!empty($key)){
            $id = get_the_ID();
            if(is_front_page() && is_home()) $id = (int)get_option( 'page_on_front' );
            if(!is_front_page() && is_home()) $id = (int)get_option( 'page_for_posts' );
            if(is_archive() || is_search()) $id = 0;
            if (class_exists('woocommerce')) {
                if(is_shop()) $id = (int)get_option('woocommerce_shop_page_id');
                if(is_cart()) $id = (int)get_option('woocommerce_cart_page_id');
                if(is_checkout()) $id = (int)get_option('woocommerce_checkout_page_id');
                if(is_account_page()) $id = (int)get_option('woocommerce_myaccount_page_id');
            }
            $value = get_post_meta($id,$key,true);
            if(s7upf_is_woocommerce_page()){
                if($key == 'show_header_page' || $key == 'header_page_image' || $key == 'header_page_link') $key = $key.'_woo';
            }
            if(empty($value)) $value = s7upf_get_option($key);
            return $value;
        }
        else return 'Missing a variable of this funtion';
    }
}

//Check woocommerce page
if (!function_exists('s7upf_is_woocommerce_page')) {
    function s7upf_is_woocommerce_page() {
        if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
                return true;
        }
        $woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
                                        "woocommerce_terms_page_id" ,
                                        "woocommerce_cart_page_id" ,
                                        "woocommerce_checkout_page_id" ,
                                        "woocommerce_pay_page_id" ,
                                        "woocommerce_thanks_page_id" ,
                                        "woocommerce_myaccount_page_id" ,
                                        "woocommerce_edit_address_page_id" ,
                                        "woocommerce_view_order_page_id" ,
                                        "woocommerce_change_password_page_id" ,
                                        "woocommerce_logout_page_id" ,
                                        "woocommerce_lost_password_page_id" ) ;
        foreach ( $woocommerce_keys as $wc_page_id ) {
                if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                        return true ;
                }
        }
        return false;
    }
}

//navigation
if(!function_exists('s7upf_paging_nav'))
{
    function s7upf_paging_nav()
    {
        // Don't print empty markup if there's only one page.
        if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
            return;
        }

        $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $query_args   = array();
        $url_parts    = explode( '?', $pagenum_link );

        if ( isset( $url_parts[1] ) ) {
            wp_parse_str( $url_parts[1], $query_args );
        }

        $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
        $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

        $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

        // Set up paginated links.
        $links = paginate_links( array(
            'base'     => $pagenum_link,
            'format'   => $format,
            'total'    => $GLOBALS['wp_query']->max_num_pages,
            'current'  => $paged,
            'mid_size' => 1,
            'add_args' => array_map( 'urlencode', $query_args ),
            'prev_text' => '<i aria-hidden="true" class="fa fa-angle-double-left"></i>',
            'next_text' => '<i aria-hidden="true" class="fa fa-angle-double-right"></i>',
        ) );

        if ($links) : ?>
        <div class="pagibar text-right">
            <?php echo balanceTags($links); ?>
        </div>
        <?php endif;
    }
}

//Set post view
if(!function_exists('s7upf_set_post_view'))
{
    function s7upf_set_post_view($post_id=false)
    {
        if(!$post_id) $post_id=get_the_ID();

        $view=(int)get_post_meta($post_id,'post_views',true);
        $view++;
        update_post_meta($post_id,'post_views',$view);
    }
}

if(!function_exists('s7upf_get_post_view'))
{
    function s7upf_get_post_view($post_id=false)
    {
        if(!$post_id) $post_id=get_the_ID();

        return (int)get_post_meta($post_id,'post_views',true);
    }
}

//remove attr embed
if(!function_exists('s7upf_remove_w3c')){
    function s7upf_remove_w3c($embed_code){
        $embed_code=str_replace('webkitallowfullscreen','',$embed_code);
        $embed_code=str_replace('mozallowfullscreen','',$embed_code);
        $embed_code=str_replace('frameborder="0"','',$embed_code);
        $embed_code=str_replace('frameborder="no"','',$embed_code);
        $embed_code=str_replace('scrolling="no"','',$embed_code);
        $embed_code=str_replace('&','&amp;',$embed_code);
        return $embed_code;
    }
}

// MetaBox
if(!function_exists('s7upf_display_metabox'))
{
    function s7upf_display_metabox($type ='') {
        switch ($type) {
            case 'blog':?>

                <?php
                break;

            default:?>
                <ul class="blog-comment-date">
                    <li>
                        <i aria-hidden="true" class="fa fa-calendar"></i>
                        <span><?php echo get_the_time('d F, Y')?></span>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( get_comments_link() ); ?>">
                            <i aria-hidden="true" class="fa fa-comment-o"></i>
                            <span><?php echo get_comments_number(); ?> 
                                <?php 
                                    if(get_comments_number()>1) esc_html_e('Comments', 'fashionstore') ;
                                    else esc_html_e('Comment', 'fashionstore') ;
                                ?>
                            </span>
                        </a>
                    </li>
                    <?php if(is_front_page() && is_home()):?>
                        <li><?php esc_html_e('In', 'fashionstore');?>:
                            <?php $cats = get_the_category_list(', ');?>
                            <?php if($cats) echo balanceTags($cats); else _e("No Category",'fashionstore');?>
                        </li>
                        <li><?php esc_html_e('Tags', 'fashionstore');?>:
                            <?php $tags = get_the_tag_list(' ',', ',' ');?>
                            <?php if($tags) echo balanceTags($tags); else _e("No Tag",'fashionstore');?>
                        </li>
                    <?php endif;?>
                </ul>
                <?php
                break;
        }
    ?>        
    <?php
    }
}
if(!function_exists('s7upf_get_header_default')){
    function s7upf_get_header_default(){
        ?>
        <div id="header" class="header header-default">
            <div class="container">
                <div class="logo">
                    <a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr__("logo","fashionstore");?>">
                        <?php $sv_logo=s7upf_get_option('logo');?>
                        <?php if($sv_logo!=''){
                            echo '<h1 class="hidden">'.get_bloginfo('name', 'display').'</h1><img src="' . esc_url($sv_logo) . '" alt="logo">';
                        }   else { echo '<h1>'.get_bloginfo('name', 'display').'</h1>'; }
                        ?>
                    </a>
                </div>
                <div class="nav-header">
                    <nav class="main-nav main-nav1">
                        <?php if ( has_nav_menu( 'primary' ) ) {
                            wp_nav_menu( array(
                                    'theme_location' => 'primary',
                                    'container'=>false,
                                    'walker'=>new S7upf_Walker_Nav_Menu(),
                                 )
                            );
                        } ?>
                        <a class="toggle-mobile-menu" href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
                    </nav>
                </div>
            </div>
        </div>
        <?php
    }
}
if(!function_exists('s7upf_get_footer_default')){
    function s7upf_get_footer_default(){
        ?>
        <div id="footer" class="default-footer">
            <div class="container">
                <div class="copyright">
                    <p><?php esc_html_e("Copyright &copy; by 7up. All Rights Reserved. Designed by","fashionstore")?> <a href="#"><span><?php esc_html_e("7uptheme","fashionstore")?></span>.<?php esc_html_e("com","fashionstore")?></a>.</p>
                </div>
            </div>
        </div>
        <?php
    }
}
if(!function_exists('s7upf_get_footer_visual')){
    function s7upf_get_footer_visual($page_id){
        ?>
        <div id="footer" class="footer-page">
            <div class="container">
                <?php echo S7upf_Template::get_vc_pagecontent($page_id);?>
            </div>
        </div>
        <?php
    }
}
if(!function_exists('s7upf_get_header_visual')){
    function s7upf_get_header_visual($page_id){
        ?>
        <div id="header" class="header-page">
            <div class="container">
                <?php echo S7upf_Template::get_vc_pagecontent($page_id);?>
            </div>
        </div>
        <?php
    }
}
if(!function_exists('s7upf_get_main_class')){
    function s7upf_get_main_class(){
        $sidebar=s7upf_get_sidebar();
        $sidebar_pos=$sidebar['position'];
        $main_class = 'col-md-12';
        if($sidebar_pos != 'no') $main_class = 'col-md-9 col-sm-8 col-xs-12';
        return $main_class;
    }
}
if(!function_exists('s7upf_output_sidebar')){
    function s7upf_output_sidebar($position){
        $sidebar = s7upf_get_sidebar();
        $sidebar_pos = $sidebar['position'];
        if($sidebar_pos == $position) get_sidebar();
    }
}
if(!function_exists('s7upf_fix_import_category')){
    function s7upf_fix_import_category($taxonomy){
        global $s7upf_config;
        $data = $s7upf_config['import_category'];
        if(!empty($data)){
            $data = json_decode($data,true);
            foreach ($data as $cat => $value) {
                $parent_id = 0;
                $term = get_term_by( 'slug',$cat, $taxonomy );
                $term_parent = get_term_by( 'slug', $value['parent'], $taxonomy );
                if(isset($term_parent->term_id)) $parent_id = $term_parent->term_id;
                if($parent_id) wp_update_term( $term->term_id, $taxonomy, array('parent'=> $parent_id) );
                if($value['thumbnail']){
                    if($taxonomy == 'product_cat')  update_metadata( 'woocommerce_term', $term->term_id, 'thumbnail_id', $value['thumbnail']);
                    else{
                        update_term_meta( $term->term_id, 'thumbnail_id', $value['thumbnail']);
                    }
                }
            }
        }
    }
}
/***************************************END Core Function***************************************/


/***************************************Add Theme Function***************************************/
//Compare URL
if(!function_exists('s7upf_compare_url')){
    function s7upf_compare_url($ajax = false,$text = '',$icon='<i aria-hidden="true" class="fa fa-balance-scale"></i>'){
        $cp_link = "#";
        if($text === false) $text = '';
        else if(empty($text)) $text = esc_html__("Compare","fashionstore");        
        if(!$ajax){
            global $yith_woocompare;
            if(is_object($yith_woocompare)){
                $cp_link = $yith_woocompare->obj->add_product_url( get_the_ID());
            }
        }
        else{
            if(class_exists('YITH_Woocompare_Frontend')){
                $compare = new YITH_Woocompare_Frontend();
                $cp_link = $compare->add_product_url( get_the_ID());
            }
        }
        if(class_exists('YITH_Woocompare_Frontend') && true){            
            $html = '<a href="'.esc_url($cp_link).'" class="product-compare compare compare-link" data-product_id="'.get_the_ID().'">'.$icon.'<span>'.$text.'</span></a>';
            return $html;
        }
    }
}
if(!function_exists('s7upf_product_thumb_hover')){
    function s7upf_product_thumb_hover($size = 'full',$style = ''){
        $img_hover = get_post_meta(get_the_ID(),'product_thumb_hover',true);
        if(!empty($img_hover)) $img_hover_html = '<img class="second-image" alt="" src="'.esc_url($img_hover).'">';
        else $img_hover_html = get_the_post_thumbnail(get_the_ID(),$size,array('class'=>'second-image'));
        switch ($style) {
            case 'show-label':
                $html = '<div class="product-thumb '.$style.'">
                            <a class="product-thumb-link" href="'.esc_url(get_the_permalink()).'">
                                '.get_the_post_thumbnail(get_the_ID(),$size,array('class'=>'first-image')).'
                                '.$img_hover_html.'                                
                            </a>
                            '.s7upf_get_product_label().'
                            <a data-product-id="'.get_the_id().'" href="'.esc_url(get_the_permalink()).'" class="product-quick-view quickview-link">'.esc_html__("quick view","fashionstore").'</a>';
                $html .= '</div>';
                break;
            
            default:
                $html = '<div class="product-thumb '.$style.'">
                            <a class="product-thumb-link" href="'.esc_url(get_the_permalink()).'">
                                '.get_the_post_thumbnail(get_the_ID(),$size,array('class'=>'first-image')).'
                                '.$img_hover_html.'                                
                            </a>
                            <a data-product-id="'.get_the_id().'" href="'.esc_url(get_the_permalink()).'" class="product-quick-view quickview-link">'.esc_html__("quick view","fashionstore").'</a>';
                $html .= '</div>';
                break;
        }        
        return $html;
    }
}
if(!function_exists('s7upf_product_thumb_hover2')){
    function s7upf_product_thumb_hover2($size = 'full',$style = ''){
        $img_hover = get_post_meta(get_the_ID(),'product_thumb_hover',true);
        if(!empty($img_hover)) $img_hover_html = '<img class="second-image" alt="" src="'.esc_url($img_hover).'">';
        else $img_hover_html = get_the_post_thumbnail(get_the_ID(),$size,array('class'=>'second-image'));
        switch ($style) {
            case 'show-label':
                global $s7upf_time;
                $html = '<div class="product-thumb '.$style.'">
                            <a class="product-thumb-link" href="'.esc_url(get_the_permalink()).'">
                                '.get_the_post_thumbnail(get_the_ID(),$size,array('class'=>'first-image')).'
                                '.$img_hover_html.'                                
                            </a>
                            '.s7upf_get_product_label().'
                            <div class="supper-deal-countdown" data-date="'.esc_attr($s7upf_time).'"></div>';
                $html .= '</div>';
                break;
            
            default:
                $html = '<div class="product-thumb '.$style.'">
                            <a class="product-thumb-link" href="'.esc_url(get_the_permalink()).'">
                                '.get_the_post_thumbnail(get_the_ID(),$size,array('class'=>'first-image')).'
                                '.$img_hover_html.'                                
                            </a>
                            <a data-product-id="'.get_the_id().'" href="'.esc_url(get_the_permalink()).'" class="product-quick-view quickview-link">'.esc_html__("quick view","fashionstore").'</a>';
                $html .= '</div>';
                break;
        }        
        return $html;
    }
}
if(!function_exists('s7upf_product_link')){
    function s7upf_product_link($style = ''){
        global $product;
        $button_html =  apply_filters( 'woocommerce_loop_add_to_cart_link',
            sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s"><i aria-hidden="true" class="fa fa-opencart"></i><span>%s</span></a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( $product->id ),
                esc_attr( $product->get_sku() ),
                esc_attr( isset( $quantity ) ? $quantity : 1 ),
                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button addcart-link' : '',
                esc_attr( $product->product_type ),
                esc_html( $product->add_to_cart_text() )
            ),
        $product );        
        $html_wl = '';
        switch ($style) {
            case 'home17':
                if(class_exists('YITH_WCWL_Init')) $html_wl = '<a href="'.esc_url(str_replace('&', '&amp;',add_query_arg( 'add_to_wishlist', get_the_ID() ))).'" class="add_to_wishlist wishlist-link" rel="nofollow" data-product-id="'.get_the_ID().'"><i class="fa fa-heart-o" aria-hidden="true"></i><span>'.esc_html__("Wishlist","fashionstore").'</span></a>';
                $html =     '<div class="product-extra-link product '.$style.'">';
                $html .=        $html_wl;
                $html .=        $button_html;
                $html .=        s7upf_compare_url(true);
                $html .=    '</div>';
                break;

            case 'home10':
                if(class_exists('YITH_WCWL_Init')) $html_wl = '<a href="'.esc_url(str_replace('&', '&amp;',add_query_arg( 'add_to_wishlist', get_the_ID() ))).'" class="add_to_wishlist wishlist-link" rel="nofollow" data-product-id="'.get_the_ID().'"><i class="fa fa-heart-o" aria-hidden="true"></i><span>'.esc_html__("Wishlist","fashionstore").'</span></a>';
                $html =     '<div class="product-extra-link product '.$style.'">';
                $html .=        $html_wl;
                $html .=        s7upf_compare_url(true);
                $html .=        $button_html;                
                $html .=    '</div>';
                break;

            case 'home4':
                if(class_exists('YITH_WCWL_Init')) $html_wl = '<a href="'.esc_url(str_replace('&', '&amp;',add_query_arg( 'add_to_wishlist', get_the_ID() ))).'" class="add_to_wishlist wishlist-link" rel="nofollow" data-product-id="'.get_the_ID().'"><i class="fa fa-heart-o" aria-hidden="true"></i><span>'.esc_html__("Wishlist","fashionstore").'</span></a>';
                $html =     '<div class="product-extra-link product '.$style.'">';
                $html .=        $button_html;
                $html .=        $html_wl;
                $html .=        s7upf_compare_url(true);
                $html .=        '<a data-product-id="'.get_the_id().'" href="'.esc_url(get_the_permalink()).'" class="quick-view-link quickview-link">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    <span>'.esc_html__("Quick View","fashionstore").'</span>
                                </a>';
                $html .=    '</div>';
                break;
            
            default:
                if(class_exists('YITH_WCWL_Init')) $html_wl = '<a href="'.esc_url(str_replace('&', '&amp;',add_query_arg( 'add_to_wishlist', get_the_ID() ))).'" class="add_to_wishlist wishlist-link" rel="nofollow" data-product-id="'.get_the_ID().'"><i class="fa fa-heart-o" aria-hidden="true"></i><span>'.esc_html__("Wishlist","fashionstore").'</span></a>';
                $html =     '<div class="product-extra-link product '.$style.'">';
                $html .=        $button_html;
                $html .=        $html_wl;
                $html .=        s7upf_compare_url(true);
                $html .=    '</div>';
                break;
        }        
        return $html;
    }
}
//get type url
if(!function_exists('s7upf_get_key_url')){
    function s7upf_get_key_url($key,$value){
        if(function_exists('s7upf_get_current_url')) $current_url = s7upf_get_current_url();
        else $current_url = get_the_permalink();
        if(isset($_GET[$key])){
            $current_url = str_replace('&'.$key.'='.$_GET[$key], '', $current_url);
            $current_url = str_replace('?'.$key.'='.$_GET[$key], '', $current_url);
        }
        if(strpos($current_url,'?') > -1 ){
            $current_url .= '&amp;'.$key.'='.$value;
        }
        else {
            $current_url .= '?'.$key.'='.$value;
        }
        return $current_url;
    }
}
//get type url double key
if(!function_exists('s7upf_get_key_url2')){
    function s7upf_get_key_url2($key,$value,$key2,$value2){
        if(function_exists('s7upf_get_current_url')) $current_url = s7upf_get_current_url();
        else $current_url = get_the_permalink();
        if(isset($_GET[$key])){
            $current_url = str_replace('&'.$key.'='.$_GET[$key], '', $current_url);
            $current_url = str_replace('?'.$key.'='.$_GET[$key], '', $current_url);
        }
        if(strpos($current_url,'?') > -1 ){
            $current_url .= '&amp;'.$key.'='.$value;
        }
        else {
            $current_url .= '?'.$key.'='.$value;
        }
        if(isset($_GET[$key2])){
            $current_url = str_replace('&'.$key2.'='.$_GET[$key2], '', $current_url);
            $current_url = str_replace('?'.$key2.'='.$_GET[$key2], '', $current_url);
        }
        if(strpos($current_url,'?') > -1 ){
            $current_url .= '&amp;'.$key2.'='.$value2;
        }
        else {
            $current_url .= '?'.$key2.'='.$value2;
        }
        return $current_url;
    }
}
if(!function_exists('s7upf_check_sidebar')){
    function s7upf_check_sidebar(){
        $sidebar = s7upf_get_sidebar();
        if($sidebar['position'] == 'no') return false;
        else return true;
    }
}
//product main detail
if(!function_exists('s7upf_product_main_detai')){
    function s7upf_product_main_detai($ajax = false){
        global $post, $product, $woocommerce;
        s7upf_set_post_view();
        $thumb_id = array(get_post_thumbnail_id());
        $attachment_ids = $product->get_gallery_attachment_ids();
        // $attachment_ids = array();
        $attachment_ids = array_merge($thumb_id,$attachment_ids);
        $ul_block = $pager_html = $ul_block2 = ''; $i = 1;
        foreach ( $attachment_ids as $attachment_id ) {
            $image_link = wp_get_attachment_url( $attachment_id );
            if ( ! $image_link )
                continue;
            $image_title    = esc_attr( get_the_title( $attachment_id ) );
            $image_caption  = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
            $image       = wp_get_attachment_image( $attachment_id, 'full', 0, $attr = array(
                'title' => $image_title,
                'alt'   => $image_title
                ) );
            $image_pager  = wp_get_attachment_image( $attachment_id, array(100,100), 0, $attr = array(
                'title' => $image_title,
                'alt'   => $image_title
                ) );
            if($i == 1) $active = 'active';
            else $active = '';
            $page_index = $i-1;
            $ul_block .= '<li>'.$image.'</li>';
            $pager_html .=  '<a data-slide-index="'.$page_index.'" href="#">'.$image.'</a>';
            $i++;
        }
        $available_data = array();
        if( $product->is_type( 'variable' ) ) $available_data = $product->get_available_variations();        
        if(!empty($available_data)){
            foreach ($available_data as $available) {
                if(!empty($available['image_src'])){
                    $page_index = $i-1;
                    $ul_block .= '<li data-variation_id="'.$available['variation_id'].'"><img src="'.esc_url($available['image_link']).'" srcset="'.esc_url($available['image_link']).'" alt="'.$available['image_alt'].'" title="'.$available['image_title'].'" ></li>';
                    $pager_html .=  '<a data-variation_id="'.$available['variation_id'].'" data-slide-index="'.$page_index.'" href="#"><img src="'.esc_url($available['image_link']).'" srcset="'.esc_url($available['image_link']).'" alt="'.$available['image_alt'].'" title="'.$available['image_title'].'" ></a>';
                    $i++;
                }
            }
        }
        $thumb_html =   '<div class="product-gallery detail-gallery">
                            <ul class="bxslider">
                                '.$ul_block.'
                            </ul>
                            <div class="bx-pager">
                                '.$pager_html.'
                            </div>
                        </div>';
        $sku = get_post_meta(get_the_ID(),'_sku',true);
        $stock = $product->get_availability();
        $s_class = '';
        if(is_array($stock)){
            if(!empty($stock['class'])) $s_class = $stock['class'];
            if(!empty($stock['availability'])) $stock = $stock['availability'];
            else {
                if($stock['class'] == 'in-stock') $stock = esc_html__("In stock","fashionstore");
                else $stock = esc_html__("Out of stock","fashionstore");
            }
        }
        $side_class = '';$col_thumb = $col_info = 'col-md-6 col-sm-6';
        if(s7upf_check_sidebar()){
            $side_class = 'style2';
            $col_thumb  = 'col-md-7 col-sm-12';
            $col_info = 'col-md-5 col-sm-12';
        }
        echo        '<div class="product-detail '.esc_attr($side_class).'">
                        <div class="row">
                            <div class="'.esc_attr($col_thumb).' col-xs-12">
                                '.$thumb_html.'
                            </div>
                            <div class="'.esc_attr($col_info).' col-xs-12">
                                <div class="detail-info">
                                    <h2 class="title-detail">'.get_the_title().'</h2>
                                    <ul class="list-rate-review list-inline">
                                        <li>
                                            '.s7upf_get_rating_html().'
                                        </li>
                                        <li><span class="number-review">'.$product->get_review_count().' '.esc_html__("Review(s)","fashionstore").'</span></li>
                                        <li><span class="inout-stock '.esc_attr($s_class).'">'.$stock.'</span></li>
                                    </ul>
                                    <p class="product-desc">'.get_the_excerpt().'</p>';
        echo                        balanceTags(s7upf_get_price_html());
                                    woocommerce_template_single_add_to_cart();
        echo                        balanceTags(s7upf_get_product_detail_link());                                    
        echo                    '</div>
                            </div>
                        </div>
                    </div>';
    }
}
if(!function_exists('s7upf_get_price_html')){
    function s7upf_get_price_html($style = ''){
        global $product;
        switch ($style) {
            case 'style3':
                $html =    '<div class="price-style3">'.$product->get_price_html().s7upf_get_saleoff_html().'</div>';
                break;

            case 'style2':
                $html =    '<div class="price-style2">'.$product->get_price_html().'</div>';
                break;
            
            default:                
                $html =    $product->get_price_html();
                break;
        }
        return $html;
    }
}
if(!function_exists('s7upf_get_rating_html')){
    function s7upf_get_rating_html($count = false,$style = ''){
        global $product;
        $html = '';
        $star = $product->get_average_rating();
        $review_count = $product->get_review_count();
        $width = $star / 5 * 100;
        $html .=    '<div class="product-rating '.$style.'">
                        <div class="inner-rating" style="width:'.$width.'%;"></div>';
        if($count) $html .= '<span>('.$review_count.'s)</span>';
        $html .=    '</div>';
        return $html;
    }
}
if(!function_exists('s7upf_get_product_detail_link')){
    function s7upf_get_product_detail_link($style = ''){
        global $post;
        $html_wl = '';
        if(class_exists('YITH_WCWL_Init')) $html_wl = '<a href="'.esc_url(str_replace('&', '&amp;',add_query_arg( 'add_to_wishlist', get_the_ID() ))).'" class="add_to_wishlist wishlist-link" rel="nofollow" data-product-id="'.get_the_ID().'"><i class="fa fa-heart-o" aria-hidden="true"></i><span>'.esc_html__("Wishlist","fashionstore").'</span></a>';
                $html =     '<div class="product-extra-link product '.$style.'">';
                $html .=        $html_wl;
                $html .=        s7upf_compare_url(true);
                $html .=        '<div class="share-social-product">
                                    <a class="share-link" href="#"><i aria-hidden="true" class="fa fa-share-alt"></i></a>
                                    <ul class="list-social-product">
                                        <li><a href="'.esc_url('http://www.facebook.com/sharer.php?u='.get_the_permalink()).'"><i class="fa fa-facebook"></i><span>'.esc_html__("facebook","fashionstore").'</span></a>
                                        <li><a href="'.esc_url('http://www.twitter.com/share?url='.get_the_permalink()).'"><i class="fa fa-twitter"></i><span>'.esc_html__("twitter","fashionstore").'</span></a>
                                        <li><a href="'.esc_url('http://linkedin.com/shareArticle?mini=true&amp;url='.get_the_permalink().'&amp;title='.$post->post_name).'"><i class="fa fa-linkedin"></i><span>'.esc_html__("linkedin","fashionstore").'</span></a>
                                        <li><a href="'.esc_url('http://pinterest.com/pin/create/button/?url='.get_the_permalink().'&amp;media='.wp_get_attachment_url(get_post_thumbnail_id())).'"><i class="fa fa-pinterest"></i><span>'.esc_html__("pinterest","fashionstore").'</span></a>
                                        <li><a href="'.esc_url('https://plus.google.com/share?url='.get_the_permalink()).'"><i class="fa fa-google-plus"></i><span>'.esc_html__("google","fashionstore").'</span></a>
                                    </ul>
                                </div>';
                $html .=    '</div>';
        return $html;
    }
}
if(!function_exists('s7upf_single_upsell_product'))
{
    function s7upf_single_upsell_product($style='')
    {
        $check_show = s7upf_get_value_by_id('show_single_upsell');
        $number = s7upf_get_value_by_id('show_single_number');
        if(!$number) $number = 6;
        if($check_show == 'on' || $check_show == 'yes'){
            global $product;
            $upsells = $product->get_upsells();
            ?>  
            <div class="related-product <?php echo esc_attr($style)?>">
                <h2 class="title-default"><?php esc_html_e("Upsell Products","fashionstore")?></h2>
                <div class="related-product-slider">
                    <div class="inner-related-product-slider">
                        <div class="wrap-item">
                        <?php
                            $meta_query = WC()->query->get_meta_query();
                            $args = array(
                                'post_type'           => 'product',
                                'ignore_sticky_posts' => 1,
                                'no_found_rows'       => 1,
                                'posts_per_page'      => $number,
                                'post__in'            => $upsells,
                                'post__not_in'        => array( $product->id ),
                                'meta_query'          => $meta_query
                            );
                            $products = new WP_Query( $args );
                            if ( $products->have_posts() ) :
                                while ( $products->have_posts() ) : 
                                    $products->the_post();                                  
                                    global $product;
                                    echo    '<div class="item-product-related">
                                                <div class="product-thumb">
                                                    <div class="zoom-image"><a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),array(318,406)).'</a></div>
                                                </div>
                                                <div class="product-info">
                                                    <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                    '.s7upf_get_price_html().'
                                                </div>
                                            </div>';
                        ?>
                        
                        <?php   endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }
}
if(!function_exists('s7upf_single_lastest_product'))
{
    function s7upf_single_lastest_product($style='')
    {
        $check_show = s7upf_get_value_by_id('show_single_lastest');
        $number = s7upf_get_value_by_id('show_single_number');
        if(!$number) $number = 6;
        if($check_show == 'on' || $check_show == 'yes'){
            global $product;
            ?>  
            <div class="related-product <?php echo esc_attr($style)?>">
                <h2 class="title-default"><?php esc_html_e("Recent Products","fashionstore")?></h2>
                <div class="related-product-slider">
                    <div class="inner-related-product-slider">
                        <div class="wrap-item">
                        <?php
                            $args = array(
                                'post_type'           => 'product',
                                'ignore_sticky_posts' => 1,
                                'posts_per_page'      => $number,
                                'post__not_in'        => array( $product->id ),
                                'orderby'             => 'date'
                            );
                            $products = new WP_Query( $args );
                            if ( $products->have_posts() ) :
                                while ( $products->have_posts() ) : 
                                    $products->the_post();                                  
                                    global $product;
                                    echo    '<div class="item-product-related">
                                                <div class="product-thumb">
                                                    <div class="zoom-image"><a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),array(318,406)).'</a></div>
                                                </div>
                                                <div class="product-info">
                                                    <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                    '.s7upf_get_price_html().'
                                                </div>
                                            </div>';
                        ?>
                        
                        <?php   endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }
}
if(!function_exists('s7upf_single_relate_product'))
{
    function s7upf_single_relate_product($style='')
    {
        global $product;
        $check_show = s7upf_get_value_by_id('show_single_relate');
        $number = s7upf_get_value_by_id('show_single_number');
        if(!$number) $number = 6;
        $related = $product->get_related($number);
        if($check_show == 'on' || $check_show == 'yes'){
            global $product;
            ?>  
            <div class="related-product <?php echo esc_attr($style)?>">
                <h2><?php esc_html_e("YOU MIGHT ALSO LIKE","fashionstore")?></h2>
                <div class="related-product-slider">
                    <div class="inner-related-product-slider">
                        <div class="wrap-item">
                        <?php
                            $args = array(
                                'post_type'           => 'product',
                                'ignore_sticky_posts'  => 1,
                                'no_found_rows'        => 1,
                                'posts_per_page'       => $number,                                    
                                'orderby'              => 'ID',
                                'post__in'             => $related,
                                'post__not_in'         => array( $product->id )
                            );
                            $products = new WP_Query( $args );
                            if ( $products->have_posts() ) :
                                while ( $products->have_posts() ) : 
                                    $products->the_post();                                  
                                    global $product;
                                    echo    '<div class="item-product-related">
                                                <div class="product-thumb">
                                                    <div class="zoom-image"><a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),array(318,406)).'</a></div>
                                                </div>
                                                <div class="product-info">
                                                    <h3 class="product-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                    '.s7upf_get_price_html().'
                                                </div>
                                            </div>';
                        ?>
                        
                        <?php   endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }
}
if(!function_exists('s7upf_substr')){
    function s7upf_substr($string='',$start=0,$end=1){
        $output = '';
        if(!empty($string)){
            if($end < strlen($string)){
                if($string[$end] != ' '){
                    for ($i=$end; $i < strlen($string) ; $i++) { 
                        if($string[$i] == ' ' || $string[$i] == '.' || $i == strlen($string)-1){
                            $end = $i;
                            break;
                        }
                    }
                }
            }
            $output = substr($string,$start,$end);
        }
        return $output;
    }
}
//get type url
if(!function_exists('s7upf_get_filter_url')){
    function s7upf_get_filter_url($key,$value){
        if(function_exists('s7upf_get_current_url')) $current_url = s7upf_get_current_url();
        else $current_url = get_the_permalink();
        if(isset($_GET[$key])){
            $current_val_string = $_GET[$key];
            if($current_val_string == $value){
                $current_url = str_replace('&'.$key.'='.$_GET[$key], '', $current_url);
                $current_url = str_replace('?'.$key.'='.$_GET[$key], '?', $current_url);
            }
            $current_val_key = explode(',', $current_val_string);
            $val_encode = str_replace(',', '%2C', $current_val_string);
            if(!empty($current_val_string)){
                if(!in_array($value, $current_val_key)) $current_val_key[] = $value;
                else{
                    $pos = array_search($value, $current_val_key);
                    unset($current_val_key[$pos]);
                }            
                $new_val_string = implode('%2C', $current_val_key);
                $current_url = str_replace($key.'='.$val_encode, $key.'='.$new_val_string, $current_url);
                if (strpos($current_url, '?') == false) $current_url = str_replace('&','?',$current_url);
            }
            else $current_url = str_replace($key.'=', $key.'='.$value, $current_url);     
        }
        else{
            if(strpos($current_url,'?') > -1 ){
                $current_url .= '&amp;'.$key.'='.$value;
            }
            else {
                $current_url .= '?'.$key.'='.$value;
            }
        }
        return $current_url;
    }
}
// Mini cart
if(!function_exists('s7upf_mini_cart')){
    function s7upf_mini_cart($echo = false){
        $html = '';
        if ( ! WC()->cart->is_empty() ){
            $count_item = 0; $html = '';
            $html .=    '<h2 class="mini-cart-items"><span class="cart-item-count">0</span> '.esc_html__("items","fashionstore").'</h2>
                        <ul class="list-mini-cart-item">';                    
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $count_item++;
                $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                $product_quantity = woocommerce_quantity_input( array(
                    'input_name'  => "cart[{$cart_item_key}][qty]",
                    'input_value' => $cart_item['quantity'],
                    'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                    'min_value'   => '0'
                ), $_product, false );
                $thumb_html = '';
                if(has_post_thumbnail($product_id)) $thumb_html = $_product->get_image(array(70,70));
                $html .=    '<li class="item-info-cart" data-key="'.$cart_item_key.'">
                                <div class="mini-cart-thumb">
                                    <a href="'.esc_url( $_product->get_permalink( $cart_item )).'">'.$thumb_html.'</a>
                                </div>  
                                <div class="mini-cart-info">
                                    <h3 class="mini-cart-title"><a href="'.esc_url( $_product->get_permalink( $cart_item )).'">'.$_product->get_title().'</a></h3>
                                    <div class="mini-cart-qty qty-product"><label>'.esc_html__("Qty:","fashionstore").'</label> <span class="qty-num">'.$cart_item['quantity'].'</span></div>
                                </div>  
                                <div class="mini-cart-remove">
                                    <a class="remove-product btn-remove" href="#"></a>
                                    <span class="mini-cart-price">'.apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ).'</span>
                                </div>  
                            </li>';
            }
            $html .=    '</ul><input id="count-cart-item" type="hidden" value="'.$count_item.'">';
            $html .=    '<div class="mini-cart-total cart-qty">
                            <label>'.esc_html__("Subtotal","fashionstore").'</label>
                            <span class="total-price">'.WC()->cart->get_cart_total().'</span>
                        </div>
                        <div class="mini-cart-button">
                            <a href="'.esc_url(WC()->cart->get_cart_url()).'" class="mini-cart-edit">'.esc_html__("Edit Cart","fashionstore").'</a>
                            <a href="'.esc_url(WC()->cart->get_checkout_url()).'" class="mini-cart-checkout">'.esc_html__("Checkout","fashionstore").'</a>
                        </div>';
        }
        else $html .= '<h5 class="mini-cart-head">'.esc_html__("No Product in your cart.","fashionstore").'</h5>';
        if($echo) echo balanceTags($html);
        else return $html;
    }
}
// get list taxonomy
if(!function_exists('s7upf_list_taxonomy'))
{
    function s7upf_list_taxonomy($taxonomy,$show_all = true)
    {
        if($show_all) $list = array('--Select--' => '');
        else $list = array();
        if(!isset($taxonomy) || empty($taxonomy)) $taxonomy = 'category';
        $tags = get_terms($taxonomy);
        if(is_array($tags) && !empty($tags)){
            foreach ($tags as $tag) {
                $list[$tag->name] = $tag->slug;
            }
        }
        return $list;
    }
}
if(!function_exists('s7upf_get_product_label')){
    function s7upf_get_product_label($style=''){
        global $product,$post;
        $html = $sale_html = $uppsell_html = '';
        if($product->is_on_sale()){
            $sale_html .=    '<span class="sale-label">'.esc_html__("Sale","fashionstore").'</span>';
        }
        $date_pro = strtotime($post->post_date);
        $date_now = strtotime('now');
        $set_timer = s7upf_get_option( 'sv_set_time_woo', 30);
        $uppsell = ($date_now - $date_pro - $set_timer*24*60*60);
        if($uppsell < 0){
            $uppsell_html = '<span class="new-label">'.esc_html__('New','fashionstore').'</span>';
        }
        if(!empty($sale_html) || !empty($uppsell)){
            $html =     '<div class="product-label">
                            '.$uppsell_html.'
                            '.$sale_html.'
                        </div>';
        }
        return $html;
    }
}
if(!function_exists('s7upf_get_saleoff_html')){
    function s7upf_get_saleoff_html($style=''){
        global $product;
        $from = $product->regular_price;
        $to = $product->price;
        $percent = $html = '';
        if($from != $to && $from > 0){
            $percent = round(($from-$to)/$from*100);            
            $html = '<div class="content-move"><label>-'.$percent.'%</label></div>';
        }
        return $html;
    }
}
if(!function_exists('s7upf_get_sale_label')){
    function s7upf_get_sale_label($style=''){
        global $product,$post;
        $sale_html = '';
        if($product->is_on_sale()){
            $sale_html .=    '<span class="sale-label">'.esc_html__("Sale","fashionstore").'</span>';
        }
        return $sale_html;
    }
}
if(!function_exists('s7upf_get_new_label')){
    function s7upf_get_new_label($style=''){
        global $product,$post;
        $date_pro = strtotime($post->post_date);
        $date_now = strtotime('now');
        $set_timer = s7upf_get_option( 'sv_set_time_woo', 30);
        $uppsell = ($date_now - $date_pro - $set_timer*24*60*60);
        $uppsell_html = '';
        if($uppsell < 0){
            $uppsell_html = '<span class="new-label">'.esc_html__('New','fashionstore').'</span>';
        }
        return $uppsell_html;
    }
}
if(!function_exists('s7upf_get_cat_post')){
    function s7upf_get_cat_post($cat_class='cat-title'){
        $terms = get_the_terms( get_the_ID(), 'product_cat');
        $term_name = $term_link = $term_html = '';
        if(is_array($terms) && !empty($terms)){
            $term_name = $terms[0]->name;
            $term_link = get_term_link( $terms[0]->term_id, 'product_cat' );            
            $term_html = '<h2 class="'.esc_attr($cat_class).'"><a href="'.esc_url($term_link).'">'.esc_html($term_name).'</a></h2>';
        }
        return $term_html;
    }
}
if(!function_exists('s7upf_product_count')){
    function s7upf_product_count() {
        $product_count = 0;
        $args = array(
            'post_type'         => 'product',
            'posts_per_page'    => -1,
        );
        $query = new WP_Query($args);
        $product_count = $query->found_posts;
        wp_reset_postdata();
        return $product_count;
    }
}
if(!function_exists('s7upf_header_image')){
    function s7upf_header_image(){        
        $header_show = s7upf_get_value_by_id('show_header_page');
        $header_image = s7upf_get_value_by_id('header_page_image');
        $header_link = s7upf_get_value_by_id('header_page_link');
        $html = '';
        if($header_show == 'on' && !is_single()){            
            if(function_exists('is_shop')) $is_shop = is_shop();
            else $is_shop = false;           
            if(is_archive() && !$is_shop){
                global $wp_query;
                $term = $wp_query->get_queried_object();
                if(is_object($term)){
                    $image = get_term_meta($term->term_id, 'cat-header-image', true);
                    $link = get_term_meta($term->term_id, 'cat-header-link', true);
                    if(!empty($image)) $header_image = $image;
                    if(!empty($link)) $header_link = $link;
                }
            }
            $html .=    '<div class="banner-shop"><a href="'.esc_url($header_link).'"><img src="'.esc_url($header_image).'" alt=""></a></div>';
        }
        echo balanceTags($html);
    }
}
if(!function_exists('s7upf_get_list_attribute')){
    function s7upf_get_list_attribute(){
        $list = array(esc_html__("--Select--","fashionstore") => '');
        if(function_exists('wc_get_attribute_taxonomies')){
            $attribute_taxonomies = wc_get_attribute_taxonomies();
            if(!empty($attribute_taxonomies)){
                foreach($attribute_taxonomies as $attr){
                    $list[$attr->attribute_label] = 'pa_'.$attr->attribute_name;
                }
            }
        }
        return $list;
    }
}
if ( ! function_exists( 's7upf_catalog_ordering' ) ) {
    function s7upf_catalog_ordering($query) {        
        $orderby                 = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
        $show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
        $catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
            'menu_order' => __( 'Default sorting', 'fashionstore' ),
            'popularity' => __( 'Sort by popularity', 'fashionstore' ),
            'rating'     => __( 'Sort by average rating', 'fashionstore' ),
            'date'       => __( 'Sort by newness', 'fashionstore' ),
            'price'      => __( 'Sort by price: low to high', 'fashionstore' ),
            'price-desc' => __( 'Sort by price: high to low', 'fashionstore' )
        ) );

        if ( ! $show_default_orderby ) {
            unset( $catalog_orderby_options['menu_order'] );
        }

        if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
            unset( $catalog_orderby_options['rating'] );
        }

        wc_get_template( 'loop/orderby.php', array( 'catalog_orderby_options' => $catalog_orderby_options, 'orderby' => $orderby, 'show_default_orderby' => $show_default_orderby ) );
    }
}
if ( ! function_exists( 's7upf_get_google_link' ) ) {
    function s7upf_get_google_link() {
        $protocol = is_ssl() ? 'https' : 'http';
        $fonts_url = '';
        $fonts  = array(
                    'Poppins:300,400,700,500',
                    'Lato:300,400,700',
                );
        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
            ), $protocol.'://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
}
/***************************************END Theme Function***************************************/
