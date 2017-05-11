<?php
$data = $st_link_post= $s_class = '';
global $post;
$sv_image_blog = get_post_meta(get_the_ID(), 'format_image', true);
if(!empty($sv_image_blog)){
    $data .='<div class="single-thumb">
                <div class="zoom-image">
                    <a href="'. esc_url(get_the_permalink()) .'">
                        <img alt="'.esc_attr($post->post_name).'" title="'.esc_attr($post->post_name).'" src="'.esc_url($sv_image_blog).'"/>
                    </a>
                </div>
            </div>';
}
else{
    if (has_post_thumbnail()) {
        $data .= '<div class="single-thumb">
                    <div class="zoom-image">
                        <a href="'. esc_url(get_the_permalink()) .'">
                            '.get_the_post_thumbnail(get_the_ID(),'full').'
                        </a>
                    </div>               
                </div>';
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