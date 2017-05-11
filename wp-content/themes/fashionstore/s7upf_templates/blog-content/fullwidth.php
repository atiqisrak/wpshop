<?php
$data = '';
global $post;
if (has_post_thumbnail()) {
    $data .= '<div class="post-thumb"><div class="zoom-image">
                <a href="'. esc_url(get_the_permalink()) .'">'.get_the_post_thumbnail(get_the_ID(),array(880,577)).'</a>                
            </div></div>';
}
?>
<div class="post-item">
    <?php if(!empty($data)) echo balanceTags($data);?>
    <div class="post-info">
        <?php s7upf_display_metabox()?>
        <h3 class="post-title"><a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php get_the_title()?>"><?php the_title()?></a></h3>
        <p class="post-desc"><?php echo s7upf_substr(get_the_excerpt(),0,160); ?></p>
        <a href="<?php echo esc_url(get_the_permalink()); ?>" class="readmore btn-plus-inner"><?php esc_html_e('Read more','fashionstore')?></a>
    </div>
</div>