<?php
$data = '';
global $post;
$format = get_post_format();
switch ($format) {
    case 'video':
        $icon_html = '<a href="#" class="post-format"><i class="fa fa-video-camera" aria-hidden="true"></i></a>';
        break;

    case 'quote':
        $icon_html = '<a href="#" class="post-format"><i class="fa fa-quote-right" aria-hidden="true"></i></a>';
        break;
    
    case 'link':
        $icon_html = '<a href="#" class="post-format"><i class="fa fa-link" aria-hidden="true"></i></a>';
        break;

    case 'audio':
        $icon_html = '<a href="#" class="post-format"><i class="fa fa-headphones" aria-hidden="true"></i></a>';
        break;

    case 'image':
    case 'gallery':
        $icon_html = '<a href="#" class="post-format"><i class="fa fa-camera" aria-hidden="true"></i></a>';
        break;

    default:
        $icon_html = '';
        break;
}
if (has_post_thumbnail()) {
    $data .= '<div class="post-thumb">
                <div class="zoom-image">
                    <a href="'. esc_url(get_the_permalink()) .'">'.get_the_post_thumbnail(get_the_ID(),array(850,370)).'</a>                
                </div>
                <div class="post-format-date">
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
                    '.$icon_html.'
                </div>
            </div>';
}
?>
<div class="post-item">
    <?php if(!empty($data)) echo balanceTags($data);?>
    <div class="post-info">
        <h3 class="post-title"><a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php get_the_title()?>"><?php the_title()?></a></h3>
        <p class="post-desc"><?php echo s7upf_substr(get_the_excerpt(),0,160); ?></p>
        <a href="<?php echo esc_url(get_the_permalink()); ?>" class="readmore btn-plus"><?php esc_html_e('Read more','fashionstore')?></a>
    </div>
</div>