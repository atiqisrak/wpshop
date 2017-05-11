<?php
$data = '';
global $post;
if (has_post_thumbnail()) {
    $data .= '<div class="post-thumb"><div class="zoom-image">
                <a href="'. esc_url(get_the_permalink()) .'">'.get_the_post_thumbnail(get_the_ID(),array(850,370)).'</a>                
            </div></div>';
}
?>
<div class="post-item">
    <div class="post-author-social">
        <div class="author-avar">
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo get_avatar(get_the_author_meta('email','100')); ?></a>
        </div>
        <div class="author-name">
            <span><?php echo esc_html__("by:","fashionstore")?></span><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo get_the_author(); ?></a>
        </div>
        <div class="author-name cat-in">
            <span><?php echo esc_html__("in:","fashionstore")?></span>
            <?php $cats = get_the_category_list(', ');?>
            <?php if($cats) echo balanceTags($cats); else _e("No Category",'fashionstore');?>
        </div>
        <div class="social-post">
            <a href="<?php echo esc_url('http://www.facebook.com/sharer.php?u='.get_the_permalink())?>"><i aria-hidden="true" class="fa fa-facebook"></i></a>
            <a href="<?php echo esc_url('http://www.twitter.com/share?url='.get_the_permalink())?>"><i aria-hidden="true" class="fa fa-twitter"></i></a>
            <a href="<?php echo esc_url('https://plus.google.com/share?url='.get_the_permalink())?>"><i aria-hidden="true" class="fa fa-google-plus"></i></a>
        </div>
    </div>
    <?php if(!empty($data)) echo balanceTags($data);?>
    <div class="post-info">
        <h3 class="post-title"><a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php get_the_title()?>"><?php the_title()?></a></h3>
        <?php s7upf_display_metabox()?>
        <p class="post-desc"><?php echo get_the_excerpt(); ?></p>
        <a href="<?php echo esc_url(get_the_permalink()); ?>" class="readmore btn-plus"><?php esc_html_e('Read more','fashionstore')?></a>
    </div>
</div>