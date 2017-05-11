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
    <?php if(!empty($data)) echo balanceTags($data);?>
    <div class="post-info">
        <h3 class="post-title"><a href="<?php echo esc_url(get_the_permalink()); ?>">
            <?php the_title()?>
            <?php echo (is_sticky()) ? '<i class="fa fa-thumb-tack"></i>':''?>
        </a></h3>
        <?php s7upf_display_metabox()?>
        <p class="post-desc"><?php echo get_the_excerpt(); ?></p>
        <a href="<?php echo esc_url(get_the_permalink()); ?>" class="readmore btn-plus"><?php esc_html_e('Read more','fashionstore')?></a>
    </div>
</div>