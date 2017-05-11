<?php
$data = '';
if (get_post_meta(get_the_ID(), 'format_media', true)) {
    $media_url = get_post_meta(get_the_ID(), 'format_media', true);
    $data .='<div class="post-video single-thumb">';
    $data .= s7upf_remove_w3c(wp_oembed_get($media_url));
    $data .='</div>';
}
?>
<div class="single-item <?php echo (is_sticky()) ? 'sticky':''?>">
    <?php if(!empty($data)) echo balanceTags($data);?>
    <div class="content-blog-detail">
        <h3 class="post-title"><?php the_title()?></h3>
        <?php s7upf_display_metabox();?>
        <div class="desc"><?php the_content(); ?></div>
    </div>
</div>