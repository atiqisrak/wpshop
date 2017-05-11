<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 15/12/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_lastest_post'))
{
    function s7upf_vc_lastest_post($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'style'     => '',
            'cats'      => '',
            'title'     => '',
            'number'    => '7',
            'order'     => 'DESC',
            'link'      => '',
        ),$attr));
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => $number,
            'orderby'           => 'date',
            'order'             => $order,
        );
        if(!empty($cats)) {
            $custom_list = explode(",",$cats);
            $args['tax_query'][]=array(
                'taxonomy'=>'category',
                'field'=>'slug',
                'terms'=> $custom_list
            );
        }
        $query = new WP_Query($args);
        $count = 1;
        $count_query = $query->post_count;
        switch ($style) {
            case 'home18':
                $html .=    '<div class="from-blog17 from-blog18">';
                if(!empty($title)) $html .=    '<h2>'.esc_html($title).'</h2>';
                $html .=        '<div class="blog-slider17">
                                    <div class="owl-directnav owl-direct17 owl-default">
                                        <div class="wrap-item">';
                if($query->have_posts()) {
                    while($query->have_posts()) {
                        $query->the_post();
                        if($count % 4 == 1){
                            $html .=    '<div class="list-blog17">
                                            <div class="row">';
                            $html .=            '<div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="item-blog17 main-item">
                                                        <div class="post-thumb">
                                                            <div class="zoom-image"><a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),array(570,320)).'</a></div>
                                                        </div>
                                                        <div class="post-info">
                                                            <h3 class="post-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                            <p class="post-desc">'.s7upf_substr(get_the_excerpt(),0,120).'</p>
                                                            <ul class="post-comment-date">
                                                                <li>
                                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                    <span>'.get_the_date('M d, Y').'</span>
                                                                </li>
                                                                <li>
                                                                    <a href="'.esc_url(get_comments_link()).'">
                                                                        <i class="fa fa-comment-o" aria-hidden="true"></i>
                                                                        <span>'.get_comments_number().' '.esc_html__("Comment","fashionstore").'</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>';
                        }
                        else{
                            if($count % 4 == 2) $html .=    '<div class="col-md-6 col-sm-6 col-xs-12">';
                            $html .=    '<div class="item-blog17">
                                            <div class="post-table17">
                                                <div class="post-thumb">
                                                    <div class="zoom-image"><a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),array(100,72)).'</a></div>
                                                </div>
                                                <div class="post-info">
                                                    <h3 class="post-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                    <p class="post-desc">'.s7upf_substr(get_the_excerpt(),0,100).'</p>
                                                </div>
                                            </div>
                                            <ul class="post-comment-date">
                                                <li>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <span>'.get_the_date('M d, Y').'</span>
                                                </li>
                                                <li>
                                                    <a href="'.esc_url(get_comments_link()).'">
                                                        <i class="fa fa-comment-o" aria-hidden="true"></i>
                                                        <span>'.get_comments_number().' '.esc_html__("Comment","fashionstore").'</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>';
                            if($count % 4 == 0 || $count == $count_query) $html .=    '</div>';
                        }
                        if($count % 4 == 0 || $count == $count_query) $html .=        '</div>
                                    </div>';
                        $count++;
                    }
                }
                $html .=                '</div>
                                    </div>
                                </div>
                            </div>';
                break;

            case 'home17':
                $html .=    '<div class="from-blog17">';
                if(!empty($title)) $html .=    '<h2 class="title17 style2"><span>'.esc_html($title).'</span></h2>';
                $html .=        '<div class="blog-slider17">
                                    <div class="owl-directnav owl-direct17 owl-default">
                                        <div class="wrap-item">';
                if($query->have_posts()) {
                    while($query->have_posts()) {
                        $query->the_post();
                        if($count % 4 == 1){
                            $html .=    '<div class="list-blog17">
                                            <div class="row">';
                            $html .=            '<div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="item-blog17 main-item">
                                                        <div class="post-thumb">
                                                            <div class="zoom-image"><a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),array(570,320)).'</a></div>
                                                        </div>
                                                        <div class="post-info">
                                                            <h3 class="post-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                            <p class="post-desc">'.s7upf_substr(get_the_excerpt(),0,120).'</p>
                                                            <ul class="post-comment-date">
                                                                <li>
                                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                    <span>'.get_the_date('M d, Y').'</span>
                                                                </li>
                                                                <li>
                                                                    <a href="'.esc_url(get_comments_link()).'">
                                                                        <i class="fa fa-comment-o" aria-hidden="true"></i>
                                                                        <span>'.get_comments_number().' '.esc_html__("Comment","fashionstore").'</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>';
                        }
                        else{
                            if($count % 4 == 2) $html .=    '<div class="col-md-6 col-sm-6 col-xs-12">';
                            $html .=    '<div class="item-blog17">
                                            <div class="post-table17">
                                                <div class="post-thumb">
                                                    <div class="zoom-image"><a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),array(100,72)).'</a></div>
                                                </div>
                                                <div class="post-info">
                                                    <h3 class="post-title"><a href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>
                                                    <p class="post-desc">'.s7upf_substr(get_the_excerpt(),0,100).'</p>
                                                </div>
                                            </div>
                                            <ul class="post-comment-date">
                                                <li>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <span>'.get_the_date('M d, Y').'</span>
                                                </li>
                                                <li>
                                                    <a href="'.esc_url(get_comments_link()).'">
                                                        <i class="fa fa-comment-o" aria-hidden="true"></i>
                                                        <span>'.get_comments_number().' '.esc_html__("Comment","fashionstore").'</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>';
                            if($count % 4 == 0 || $count == $count_query) $html .=    '</div>';
                        }
                        if($count % 4 == 0 || $count == $count_query) $html .=        '</div>
                                    </div>';
                        $count++;
                    }
                }
                $html .=                '</div>
                                    </div>
                                </div>
                            </div>';
                break;

            case 'home11':
                $html .=    '<div class="latest-news6 latest-news11">';
                if(!empty($title)) $html .=    '<h2 class="title-default">'.esc_html($title).'</h2>';
                $html .=        '<div class="latest-news-slider6 owl-directnav6">
                                    <div class="wrap-item">';
                if($query->have_posts()) {
                    while($query->have_posts()) {
                        $query->the_post();
                        $html .=    '<div class="item-news6 item-news11">';
                        if($count % 2 == 1){
                        $html .=        '<div class="post-thumb">
                                            <a href="'.esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')).'" class="img-popup img-lightbox" title="'.esc_attr(get_the_title()).'">'.get_the_post_thumbnail(get_the_ID(),array(370,267)).'</a>
                                        </div>';
                                    }
                        $html .=        '<div class="post-info">
                                            <h3 class="post-title"><a href="'.esc_url(get_the_permalink()).'" title="'.get_the_title().'">'.get_the_title().'</a></h3>
                                            <p class="post-desc">'.s7upf_substr(get_the_excerpt(),0,100).'</p>
                                            <a href="'.esc_url(get_the_permalink()).'" class="readmore btn-plus-in">'.esc_html__("read more","fashionstore").'</a>
                                        </div>';
                        if($count % 2 == 0){
                        $html .=        '<div class="post-thumb">
                                            <a href="'.esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')).'" class="img-popup img-lightbox" title="'.esc_attr(get_the_title()).'">'.get_the_post_thumbnail(get_the_ID(),array(370,267)).'</a>
                                        </div>';
                                    }
                        $html .=    '</div>';
                        $count++;
                    }
                }
                $html .=            '</div>
                                </div>
                            </div>';
                break;

            case 'home7':
                $html .=    '<div class="list-post-new5">';
                if($query->have_posts()) {
                    while($query->have_posts()) {
                        $query->the_post();
                        $html .=    '<div class="item-post7">
                                        <div class="row">';
                        if($count % 2 == 1){
                        $html .=            '<div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="post-thumb">
                                                    <div class="zoom-image"><a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),array(585,465)).'</a></div>
                                                </div>
                                            </div>';
                                        }
                        $html .=            '<div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="post-info">
                                                    <h3 class="post-title"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                                    <p class="post-desc">'.get_the_excerpt().'</p>
                                                    <ul class="post-comment-date">
                                                        <li>
                                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            <span>'.get_the_date('M d, Y').'</span>
                                                        </li>
                                                        <li>
                                                            <a href="'.esc_url(get_comments_link()).'">
                                                                <i class="fa fa-comment-o" aria-hidden="true"></i>
                                                                <span>'.get_comments_number().' '.esc_html__("Comment","fashionstore").'</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <a href="'.esc_url(get_the_permalink()).'" class="btn-link7"><span>'.esc_html__("Read more","fashionstore").'</span></a>
                                                </div>
                                            </div>';
                        if($count % 2 == 0){
                        $html .=            '<div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="post-thumb">
                                                    <div class="zoom-image"><a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),array(585,465)).'</a></div>
                                                </div>
                                            </div>';
                                        }
                        $html .=        '</div>
                                    </div>';
                        $count++;
                    }
                }
                if(!empty($link)) $html .=  '<div class="viewall-blog">
                                                <a href="'.esc_url($link).'" class="btn-link7"><span>'.esc_html__("view all form blog","fashionstore").'</span></a>
                                            </div>';
                $html .=    '</div>';
                break;

            case 'home4':
                $html .=    '<div class="list-blog4">
                                <div class="row">';
                if($query->have_posts()) {
                    while($query->have_posts()) {
                        $query->the_post();
                        $html .=    '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="post-item-fluid">
                                            <div class="post-thumb">
                                                <a href="'.esc_url(get_comments_link()).'" class="post-thumb-link">'.get_the_post_thumbnail(get_the_ID(),array(640,460)).'</a>
                                                <a rel="gallery-all-post" href="'.esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')).'" class="fancybox-gallery img-popup" title="'.esc_attr(get_the_title()).'"><i class="fa fa-search" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="post-info">
                                                <ul class="post-comment-date">
                                                    <li>
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                        <span>'.get_the_date('M d, Y').'</span>
                                                    </li>
                                                    <li>
                                                        <a href="'.esc_url(get_comments_link()).'">
                                                            <i class="fa fa-comment-o" aria-hidden="true"></i>
                                                            <span>'.get_comments_number().' '.esc_html__("Comment","fashionstore").'</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <h3 class="post-title"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                                <p class="post-desc">'.s7upf_substr(get_the_excerpt(),0,200).'</p>
                                                <a class="readmore btn-plus-in" href="'.esc_url(get_the_permalink()).'">'.esc_html__("read more","fashionstore").'</a>
                                            </div>
                                        </div>
                                    </div>';
                    }
                }                
                $html .=        '</div>
                            </div>';
                break;
            
            default:
                $html .=    '<div class="latest-news '.esc_attr($style).'">
                                <div class="list-latest-news">';
                if($query->have_posts()) {
                    while($query->have_posts()) {
                        $query->the_post();
                        if($count % 2 == 1){
                            $html .=    '<div class="item-latest-news">
                                            <div class="row">
                                                <div class="col-md-7 col-sm-7 col-xs-12">
                                                    <div class="post-thumb zoom-image">
                                                        <a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),array(570,411)).'</a>
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <div class="post-info text-left">
                                                        <ul class="post-comment-date">
                                                            <li><i class="fa fa-calendar" aria-hidden="true"></i><span>'.get_the_date('M d, Y').'</span></li>
                                                            <li><a href="'.esc_url(get_comments_link()).'"><i class="fa fa-comment-o" aria-hidden="true"></i><span>'.get_comments_number().' '.esc_html__("Comment","fashionstore").'</span></a></li>
                                                        </ul>
                                                        <h3 class="post-title"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                                        <a href="'.esc_url(get_the_permalink()).'" class="btn-plus readmore">'.esc_html__("read more","fashionstore").'</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                        }
                        else{
                            $html .=    '<div class="item-latest-news item-latest-shadow">
                                            <div class="row">
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <div class="post-info text-right">
                                                        <ul class="post-comment-date">
                                                            <li><i class="fa fa-calendar" aria-hidden="true"></i><span>'.get_the_date('M d, Y').'</span></li>
                                                            <li><a href="'.esc_url(get_comments_link()).'"><i class="fa fa-comment-o" aria-hidden="true"></i><span>'.get_comments_number().' '.esc_html__("Comment","fashionstore").'</span></a></li>
                                                        </ul>
                                                        <h3 class="post-title"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h3>
                                                        <a href="'.esc_url(get_the_permalink()).'" class="btn-plus readmore">'.esc_html__("read more","fashionstore").'</a>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-sm-7 col-xs-12">
                                                    <div class="post-thumb zoom-image">
                                                        <a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail(get_the_ID(),array(570,411)).'</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                        }
                        $count++;
                    }
                }
                $html .=        '</div>
                            </div>';
                break;
        }
       
        wp_reset_postdata();
        return $html;
    }
}

stp_reg_shortcode('sv_lastest_post','s7upf_vc_lastest_post');

vc_map( array(
    "name"      => esc_html__("SV Latest Post", 'fashionstore'),
    "base"      => "sv_lastest_post",
    "icon"      => "icon-st",
    "category"  => '7Up-theme',
    "params"    => array(
        array(
            "type" => "dropdown",
            "holder" => "div",
            "heading" => esc_html__("Style",'fashionstore'),
            "param_name" => "style",
            "value"     => array(
                esc_html__("Default",'fashionstore')   => '',
                esc_html__("Home 4",'fashionstore')   => 'home4',
                esc_html__("Home 7",'fashionstore')   => 'home7',
                esc_html__("Home 10",'fashionstore')   => 'latest-news10',
                esc_html__("Home 11",'fashionstore')   => 'home11',
                esc_html__("Home 17",'fashionstore')   => 'home17',
                esc_html__("Home 18",'fashionstore')   => 'home18',
                )
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Number post', 'fashionstore' ),
            'param_name'  => 'number',
            'description' => esc_html__( 'Number posts are display. Default is 7.', 'fashionstore' ),
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Title', 'fashionstore' ),
            'param_name'  => 'title',
            "dependency"    => array(
                "element"   => 'style',
                "value"   => array('home18','home17','home11'),
                )
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'View link', 'fashionstore' ),
            'param_name'  => 'link',
            "dependency"    => array(
                "element"   => 'style',
                "value"   => array('home7'),
                )
        ),
        array(
            'holder'     => 'div',
            'heading'     => esc_html__( 'Categories', 'fashionstore' ),
            'type'        => 'checkbox',
            'param_name'  => 'cats',
            'value'       => s7upf_list_taxonomy('category',false)
        ),
        array(
            'heading'     => esc_html__( 'Order', 'fashionstore' ),
            'type'        => 'dropdown',
            'param_name'  => 'order',
            'value' => array(                   
                esc_html__('Desc','fashionstore')  => 'DESC',
                esc_html__('Asc','fashionstore')  => 'ASC',
            ),
            'description' => esc_html__( 'Select Order Type ', 'fashionstore' ),
        ),
    )
));