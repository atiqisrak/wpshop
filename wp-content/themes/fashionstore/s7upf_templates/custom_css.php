<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 13/08/15
 * Time: 10:20 AM
 */
$main_color = s7upf_get_option('main_color');
$data_attr = s7upf_get_option('woo_attr_background');
?>
<?php
$style = '';
/*****BEGIN TERM BG COLOR*****/
if(!empty($data_attr)){
    foreach ($data_attr as $attr) {
        $style .= '.bgcolor-'.$attr['attr_slug'].'
        {background-color:'.$attr['attr_bg'].';border:0 !important;}'."\n";
    }
}
/*****END TERM BG COLOR*****/

/*****BEGIN MAIN COLOR*****/
if(!empty($main_color)){
    $style .= '.top-header .top-nav.top-nav1 ul li a:hover,.language-list a:hover, .currency-list a:hover,
    .list-product-box > li > a:hover > i,.main-nav > ul > li:hover > a,.list-category-toggle a:hover,
    .mini-cart:hover .mini-cart-icon,.collection-info h2 a:hover,.btn-plus:hover,
    .product-thumb .quickview-link:hover,.item-product:hover .product-title a,.collection-thumb .shopnow:hover,
    .post-title a:hover,.item-latest-news .readmore:hover,.main-nav .sub-menu li:hover> a,
    .main-nav .sub-menu li .product-title a:hover,.widget .post-title a:hover, .widget a:hover,
    .widget .post-title a:hover, .widget a:hover,.widget_tag_cloud .tagcloud a:hover,
    .bread-crumb span,.blog-comment-date > li a:hover,.leave-reply-form .submit-reply:hover,
    .author-name > a:hover,.social-post > a:hover,.readmore.btn-plus-inner:hover,
    .masonry-loadmore > a:hover,.attr-bar ul li a:hover,.bread-crumb,.product-title a:hover,
    .main-nav.main-nav2 > ul > li:hover > a,.main-nav.main-nav2 .sub-menu li:hover > a,
    .my-account.my-account2:hover .my-account-link,.search-hover.search-hover2:hover .search-link,
    .list-cart-search .mini-cart:hover .mini-cart-icon,.my-account.my-account2 .list-account a:hover,
    .main-nav.main-nav2 > ul > li.menu-item-has-children:hover > a::before,
    .content-adv-wc.style1 .adv-wc-info a,.wellcome-text .btn-plus:hover,
    .item-featured-product:hover .product-title a,.cat-info > h3 a:hover,.cat-info .btn-plus:hover,
    .design-info > h3 a:hover,.language-box:hover > a, .currency-box:hover > a,
    .search-form4:hover > form::after,.my-account.style4:hover .my-account-link,.list-account a:hover,
    .mini-cart.style4:hover .mini-cart-icon,.mini-cart-title > a:hover,
    .list-cart-search .mini-cart .mini-cart-title > a:hover,.list-cart-search .mini-cart .mini-cart-price,
    .main-nav.main-nav4 > ul > li:hover > a,.item-fashion-adv .fashion-adv-info .shopnow:hover,
    .title-gal-pro-tab li.active a,.title-gal-pro-tab a:hover,.gal-pro-tab .product-extra-link > a i,
    .post-item-fluid .fancybox-gallery,.item-testimo4 .testimo-info > h3 a,
    .item-testimo4 .testimo-info > h3::before,.service-footer li i.fa,.social-contact4 .list-contact-footer p::before,
    .menu-footer4 li a:hover,.social-footer4 > a:hover,.footer-bottom4 .copyright3 p a:hover,
    .header-nav7 .search-hover-icon,.top-header .top-nav ul li a:hover,.list-product-box.list-product-box7 > li > a i,
    .list-product-box.list-product-box7 > li > a:hover span,.list-product-box.list-product-box7 .mini-cart-icon,
    .list-product-box.list-product-box7  .mini-cart-title > a:hover,
    .list-product-box.list-product-box7 .mini-cart-price,.header-nav7 .list-category-toggle a:hover,
    .list-product-box.list-product-box7 .mini-cart:hover .mini-cart-number,
    .collect-banner-info .new-text,.item-best-tab.style2 .product-thumb .quickview-link:hover,
    .item-best-tab.style2 .product-extra-link > a:hover,.item-best-tab.style2 .product-title a:hover,
    .item-produc7 .product-title a:hover,.item-post7 .post-title a:hover,.menu-box7 a:hover,.menu-footer7 a:hover,
    .wrap-language-currency10 > li:hover > a,.top-nav-right a:hover,.my-account10:hover .my-account-link i,
    .list-cart-search10 .list-account a:hover,.list-cart-search10 .mini-cart:hover .mini-cart-link .mini-cart-icon,
    .list-cart-search10 .mini-cart .mini-cart-title > a:hover,.list-cart-search10 .mini-cart .mini-cart-price,
    .item-banner10 .banner-info.style2 > h3,.main-nav.main-nav10 .sub-menu li:hover > a,
    .item-banner10 .banner-info.style1 h2 span,.item-product-bigsale .product-title a:hover,
    .latest-news .post-title a:hover,.item-testimo10 .testimo-author a:hover,
    .latest-news  .item-latest-news .readmore:hover,.main-nav.main-nav3 .sub-menu li:hover > a,
    .list-cart-search3 .mini-cart:hover .mini-cart-icon,.list-cart-search3 .mini-cart-title > a:hover,
    .list-cart-search3 .mini-cart-price,.list-cart-search3 .mini-cart-number,.item-banner11 .product-price ins,
    .banner-adv-info .big-title,.item-betsale11 .product-thumb .quickview-link:hover,
    .intro-deal11 > h2,.product-supper11 .title-product a:hover,.item-news11 .post-title a:hover,
    .item-adv11 .adv-info .explore:hover,.item-news11 .img-lightbox::after,
    .smart-search-form.smart-search-form6::after,.item-slider12 .banner-info .shopnow:hover,
    .item-service12 .service-info h3 a:hover,.item-product12 .product-thumb .quickview-link,
    .item-product12 .product-extra-link > a:hover,.footer12 .menu-box7 a:hover,
    .footer12 .menu-footer7 a:hover,.top-header.top-header12 .top-nav ul li a:hover,
    .list-product-box.list-product-box12 > li > a:hover > span,
    .product-slider12 .owl-theme .owl-controls .owl-buttons div:hover,.menu-top17 > li a:hover,
    .list-extra-link17 >li> a:hover,.mini-cart.mini-cart17 .mini-cart-title > a:hover,
    .mini-cart.mini-cart17 .mini-cart-price,.smart-search17 .list-category-toggle a:hover,
    .main-nav.main-nav17 > ul > li:hover > a,.main-nav.main-nav17  .sub-menu li:hover > a,
    .freeship17 > p span,.top-link-extra17 .language-list a:hover, .top-link-extra17 .currency-list a:hover,
    .item-banner17  .banner-thumb-info h2,.item-adv17 .product-title a:hover,
    .item-adv17 .product-price ins,.trend-tab-title li.active a,
    .product-info17 .product-title a:hover,.product-info17 .product-price ins,.product-info17 .product-price >span,
    .banner-access-info h2 strong,.item-blog17 .post-title a:hover,.menu-box17  a:hover,
    .service-footer9.service-footer17 > a:hover,.menu-footer17 a:hover,.item-adv18 .adv-info > h2 a:hover,
    .bdp-element:hover .shopnow,.footer18 .menu-box17 a:hover,.footer18 .service-footer9.service-footer17 > a:hover,
    .footer-bottom18 .menu-footer17 a:hover,.footer18 .contact-footer9 > p a:hover,
    .header-main-left19 .language-box:hover > a, .header-main-left19 .currency-box:hover > a,
    .menu-top19 > li a:hover,.header-main-left19 .language-list a:hover, .header-main-left19 .currency-list a:hover,
    .cart-account19 .my-account:hover .my-account-link > .fa-user,.cart-account19 .list-account a:hover,
    .cart-account19 .mini-cart:hover .mini-cart-icon,.cart-account19 .mini-cart-title > a:hover,
    .cart-account19 .mini-cart-price,.inner-banner-info .shopnow:hover span,.item-service19 .service-info > h2,
    .item-product19 .product-price ins,.item-product19 .product-price > span,
    .item-product19:hover .product-title a,.main-nav.main-nav19 > ul > li:hover > a,
    .main-nav19.main-nav .sub-menu li:hover> a,.smart-search19 .list-category-toggle a:hover,
    .main-nav.main-nav19 .product-price ins,.main-nav.main-nav19 .product-price > span,
    .product-name a:hover,.woocommerce-MyAccount-content a:hover
    {color:'.$main_color.'}'."\n";
    
    $style .= '.item-banner1 .shopnow:hover span,.owl-theme .owl-controls .owl-buttons div:hover,
    .collection-info::after,.main-nav > ul > li.menu-item-has-children:hover > a::before,
    .main-nav.main-nav19 > ul > li.menu-item-has-children:hover > a::before,
    .btn-plus:hover::before,.product-tab-title li a::before,.collection-thumb .collection-thumb-link::before,
    .collection-thumb .collection-thumb-link::after,.content-popup input[type="submit"]:hover,
    .item-latest-news .post-title::after,.mega-banner .banner-info .shopnow:hover,
    .mega-slider  .owl-theme .owl-controls .owl-page.active span,
    .mega-banner2 .banner-info .shopnow:hover,.post-format-date .post-comment-date,
    .content-blog-detail blockquote::before,.single-image-slide .owl-theme .owl-controls .owl-buttons div:hover,
    .woocommerce div.product form.cart .button.single_add_to_cart_button:hover,
    .related-product-slider .owl-theme .owl-controls .owl-page.active span,
    .content-adv-wc.style1::after,.featured-product-title li.active a,
    .featured-product-slider .owl-theme .owl-controls .owl-buttons div:hover,
    .wellcome-text .btn-plus:hover::before,.cat-info .btn-plus:hover::before,
    .newsletter-form > form input[type="submit"],.gal-pro-tab .product-extra-link > a:hover i,
    .mini-cart-button a:hover,.item-banner4 .banner-info .shopnow:hover span,.title-gal-pro-tab a::after,
    .readmore.btn-plus-in:hover,.newsletter-form4,.list-product-box.list-product-box7 .mini-cart-button a:hover,
    .main-nav7 > ul > li.menu-item-has-children:hover > a::before,.btn-link7,
    .best-tab-title.style2 ul li a:hover,.item-best-tab.style2 .product-thumb .quickview-link:hover::after,
    .item-banner7.style4,.info-shoplook7,.testimo7::before,.newsletter-form7 input[type="submit"]:hover,
    .list-cart-search10 .mini-cart .mini-cart-button a:hover,.main-nav.main-nav10 > ul > li:hover > a,
    .banner-slider10 .owl-theme .owl-controls .owl-page.active span::after,.box-title10 > h2 label,
    .item-product-bigsale .product-extra-link > a:hover,.item-product-bigsale .product-extra-link > a:hover,
    .latest-news10 .item-latest-news .post-title::after,.testimo-slider10::after,
    .newsletter-form.newsletter-form10 > form input[type="submit"],
    .latest-news .item-latest-news .readmore:hover::before,
    .latest-news .item-latest-news.item-latest-shadow .post-thumb::after,
    .main-nav.main-nav3 > ul > li.menu-item-has-children:hover > a::before, .main-nav.main-nav3 > ul > li.has-mega-menu:hover > a::before,
    .list-cart-search3 .mini-cart-button a:hover,.banner-slider11 .slick-arrow:hover,
    .btn-link11::after,.item-betsale11 .product-extra-link a:hover,.banner-adv-info.text-left strong,
    .btn-link11.style2,.btn-link11.style2 span,.product-supper11 .owl-theme .owl-controls .owl-buttons div:hover,
    .latest-news11 .owl-directnav6 .owl-theme .owl-controls .owl-buttons div:hover,
    .item-news11 .readmore.btn-plus-in:hover,.bestsale-slider11 .owl-theme .owl-controls .owl-page.active span,
    .item-product12 .product-price > label,.item-product12 .product-price > label::before,
    .item-product12 .product-price del::after,.footer12 .newsletter-form7 input[type="submit"]:hover,
    .mini-cart.mini-cart17 .mini-cart-link .mini-cart-number,
    .mini-cart.mini-cart17 .mini-cart-button a:hover,.main-nav.main-nav17  > ul > li.menu-item-has-children:hover > a::before,
    .search-alphabet > a:hover,.item-banner17 .banner-info,
    .banner-slider17 .owl-theme .owl-controls .owl-page.active span,
    .item-adv17 .shopnow:hover,.owl-direct17 .owl-theme .owl-controls .owl-buttons div:hover,
    .product-info17 .product-extra-link > a:hover,.item-banner-image17 .shopnow:hover,
    .banner-access-info .shopnow:hover,.newsletter9.newsletter17 input[type="submit"]:hover,
    .social-footer9.social-footer17 > a:hover,.collect-info18 .shopnow:hover,
    .item-adv18 .shopnow:hover,.trend-box18 form.cart .button.single_add_to_cart_button:hover,
    .banner-adv18 .banner-info .buynow:hover,.newsletter.newsletter18 > form input[type="submit"]:hover,
    .item-pro18 .product-extra-link > a:hover,.footer18 .social-footer9.social-footer17 > a:hover,
    .footer18 .back-to-top.back-top-top17:hover,.cart-account19 .mini-cart-button a:hover,
    .inner-banner-info.style1,.banner-slider19 .owl-theme .owl-controls .owl-buttons div:hover,
    .banner-slider19 .owl-theme .owl-controls .owl-buttons div.next-img,
    .banner-slider19 .owl-theme .owl-controls .owl-buttons div.prev-img,
    .banner-slider19 .owl-theme .owl-controls .owl-buttons div.next-img::after,
    .banner-slider19 .owl-theme .owl-controls .owl-buttons div.prev-img::after,
    .inner-banner-info.style2 .percent,.item-collect19 .shopnow,
    .owl-directnav19 .owl-theme .owl-controls .owl-buttons div:hover,
    .item-product19 .product-thumb-link::after,.item-product19 .product-extra-link > a:hover,
    .item-shopcat19:hover .cat-title,.newsletter-form.newsletter-form19 > form input[type="submit"],
    .main-nav.main-nav19 > ul > li > a::before,.main-nav.main-nav19 > ul > li > a::after,
    .main-nav.main-nav19 .banner-info .shopnow:hover,.main-nav .banner-info .shopnow:hover,
    .main-nav.main-nav19 .mega-slider .owl-theme .owl-controls .owl-page.active span,
    .main-nav .mega-slider .owl-theme .owl-controls .owl-page.active span,
    .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,
    .woocommerce a.button.alt:hover,.woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover,
    .woocommerce-MyAccount-navigation ul li.is-active, .woocommerce-MyAccount-navigation ul li:hover,
    .woocommerce-account .addresses .title .edit:hover
    {background-color:'.$main_color.'}
    .collection-thumb:hover .collection-thumb-link::after,
    .collection-thumb:hover .collection-thumb-link::before,.item-banner17:hover .banner-info{opacity:0.7}
    .latest-news .item-latest-news.item-latest-shadow .post-thumb::after{opacity:0.1}
    .testimo7::before{opacity:0.2}
    .item-product19:hover .product-thumb-link::after{opacity:0.5}
    .post-format-date .post-comment-date,.info-shoplook7{opacity:0.9}
    .shoplook-slider7 .owl-theme .owl-controls .owl-buttons div,
    .product-slider12 .owl-theme .owl-controls .owl-buttons div:hover,
    .testimo-slide7 .owl-theme .owl-controls .owl-buttons div {background-color: transparent;}'."\n";

    $style .= '.item-banner1 .shopnow:hover span,.btn-plus:hover::before,.pagibar > span.current,
    .widget_tag_cloud .tagcloud a:hover,.leave-reply-form .submit-reply:hover,
    .readmore.btn-plus-inner:hover,.masonry-loadmore > a:hover,
    .banner-slider2 .bx-pager a.active::after,.featured-product-title li.active,
    .featured-product-gallery .bx-pager a.active,.wellcome-text .btn-plus:hover::before,
    .cat-info .btn-plus:hover::before,.gal-pro-tab .product-extra-link > a > span,
    .gal-pro-tab .product-extra-link > a > span::after,.readmore.btn-plus-in:hover,
    .content-fashion-design .fancybox-media:hover,.best-tab-title.style2 ul li a:hover,
    .best-tab-title.style2 ul li.active a,.item-best-tab.style2 .product-thumb .quickview-link:hover::after,
    .content-testimo7,.banner-slider10 .owl-theme .owl-controls .owl-page.active span,
    .item-product-bigsale .product-extra-link > a:hover,.item-slider12 .banner-info .shopnow:hover,
    .latest-news .item-latest-news .readmore:hover::before,.item-news11 .readmore.btn-plus-in:hover,
    .item-adv17 .shopnow:hover,.item-banner-image17 .shopnow:hover,
    .banner-access-info .shopnow:hover,.collect-info18 .shopnow:hover,
    .item-adv18 .shopnow:hover,.banner-adv18 .banner-info .buynow:hover,
    .item-service19:hover,.item-collect19:hover::after,.item-shopcat19:hover,
    .item-shopcat19:hover .cat-title,.product-gallery .bx-pager a.active::after
    {border-color: '.$main_color.'}'."\n";

    $style .= '.video-intro .vjs-big-play-button::before,.content-fashion-design .fancybox-media:hover::after
    {border-left-color: '.$main_color.'}'."\n";
}
/*****END MAIN COLOR*****/

/*****BEGIN CUSTOM CSS*****/
$custom_css = s7upf_get_option('custom_css');
if(!empty($custom_css)){
    $style .= $custom_css."\n";
}

/*****END CUSTOM CSS*****/

/*****BEGIN MENU COLOR*****/
$menu_color = s7upf_get_option('sv_menu_color');
$menu_hover = s7upf_get_option('sv_menu_color_hover');
$menu_active = s7upf_get_option('sv_menu_color_active');
if(is_array($menu_color) && !empty($menu_color)){
    $style .= 'nav>li>a{';
    if(!empty($menu_color['font-color'])) $style .= 'color:'.$menu_color['font-color'].';';
    if(!empty($menu_color['font-family'])) $style .= 'font-family:'.$menu_color['font-family'].';';
    if(!empty($menu_color['font-size'])) $style .= 'font-size:'.$menu_color['font-size'].';';
    if(!empty($menu_color['font-style'])) $style .= 'font-style:'.$menu_color['font-style'].';';
    if(!empty($menu_color['font-variant'])) $style .= 'font-variant:'.$menu_color['font-variant'].';';
    if(!empty($menu_color['font-weight'])) $style .= 'font-weight:'.$menu_color['font-weight'].';';
    if(!empty($menu_color['letter-spacing'])) $style .= 'letter-spacing:'.$menu_color['letter-spacing'].';';
    if(!empty($menu_color['line-height'])) $style .= 'line-height:'.$menu_color['line-height'].';';
    if(!empty($menu_color['text-decoration'])) $style .= 'text-decoration:'.$menu_color['text-decoration'].';';
    if(!empty($menu_color['text-transform'])) $style .= 'text-transform:'.$menu_color['text-transform'].';';
    $style .= '}'."\n";
}
if(!empty($menu_hover)){
    $style .= 'nav>li>a:hover{color:'.$menu_hover.'}'."\n";
    $style .= 'nav>li>a:hover{background-color:'.$menu_hover.'}'."\n";
}
if(!empty($menu_active)){
    $style .= 'nav li.parent-current-menu-item>a{color:'.$menu_active.'}'."\n";
    $style .= 'nav li.current-menu-item >a{background-color:'.$menu_active.'}'."\n";
}

/*****END MENU COLOR*****/

/*****BEGIN TYPOGRAPHY*****/
$typo_data = s7upf_get_option('sv_custom_typography');
if(is_array($typo_data) && !empty($typo_data)){
    foreach ($typo_data as $value) {
        switch ($value['typo_area']) {
            case 'header':
                $style_class = '.site-header';
                break;

            case 'footer':
                $style_class = '.site-footer';
                break;

            case 'widget':
                $style_class = '.widget';
                break;
            
            default:
                $style_class = '#main-content';
                break;
        }
        $class_array = explode(',', $style_class);
        $new_class = '';
        if(is_array($class_array)){
            foreach ($class_array as $prefix) {
                $new_class .= $prefix.' '.$value['typo_heading'].',';
            }
        }
        if(!empty($new_class)) $style .= $new_class.' .nocss{';
        if(!empty($value['typography_style']['font-color'])) $style .= 'color:'.$value['typography_style']['font-color'].';';
        if(!empty($value['typography_style']['font-family'])) $style .= 'font-family:'.$value['typography_style']['font-family'].';';
        if(!empty($value['typography_style']['font-size'])) $style .= 'font-size:'.$value['typography_style']['font-size'].';';
        if(!empty($value['typography_style']['font-style'])) $style .= 'font-style:'.$value['typography_style']['font-style'].';';
        if(!empty($value['typography_style']['font-variant'])) $style .= 'font-variant:'.$value['typography_style']['font-variant'].';';
        if(!empty($value['typography_style']['font-weight'])) $style .= 'font-weight:'.$value['typography_style']['font-weight'].';';
        if(!empty($value['typography_style']['letter-spacing'])) $style .= 'letter-spacing:'.$value['typography_style']['letter-spacing'].';';
        if(!empty($value['typography_style']['line-height'])) $style .= 'line-height:'.$value['typography_style']['line-height'].';';
        if(!empty($value['typography_style']['text-decoration'])) $style .= 'text-decoration:'.$value['typography_style']['text-decoration'].';';
        if(!empty($value['typography_style']['text-transform'])) $style .= 'text-transform:'.$value['typography_style']['text-transform'].';';
        $style .= '}';
        $style .= "\n";
    }
}
/*****END TYPOGRAPHY*****/
if(!empty($style)) print $style;
?>