<?php
$data = '';
$gallery = get_post_meta(get_the_ID(), 'format_gallery', true);
if (!empty($gallery)){
    $array = explode(',', $gallery);
    if(is_array($array) && !empty($array)){
        
        $data .= '<div class="post-gallery single-thumb"><div class="gallery-slider">';
        foreach ($array as $key => $item) {
            $thumbnail_url = wp_get_attachment_url($item);
            $data .='<div class="image-slider">';
            $data .= '<img src="' . esc_url($thumbnail_url) . '" alt="image-slider">';           
            $data .= '</div>';
        }
        $data .='</div></div>';
    }
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