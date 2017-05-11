<?php
/**
 * The template for displaying all single posts.
 *
 * @package 7up-framework
 */
?>
<?php get_header();?>
    <div id="main-content"  class="main-wrapper">
        <div class="single-post-wrap content-single"><!-- blog-single -->
            <div class="container">
                <?php s7upf_display_breadcrumb();?>
                <div class="row">
                    <?php s7upf_output_sidebar('left')?>
                    <div class="wrap-content-main <?php echo esc_attr(s7upf_get_main_class()); ?>">
                        <div class="content-blog-sidebar">
                            <?php
                            while ( have_posts() ) : the_post();

                                /*
                                * Include the post format-specific template for the content. If you want to
                                * use this in a child theme, then include a file called called content-___.php
                                * (where ___ is the post format) and that will be used instead.
                                */
                                get_template_part( 's7upf_templates/single-content/content',get_post_format() );
                                wp_link_pages( array(
                                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fashionstore' ),
                                    'after'  => '</div>',
                                    'link_before' => '<span>',
                                    'link_after'  => '</span>',
                                ) );
                                ?>
                                <div class="single-list-tags">
                                    <label> <?php esc_html_e("tags:","fashionstore")?></label>
                                    <?php
                                        $tags = get_the_tag_list(' ',', ',' ');
                                        if($tags) $tags_html = $tags;
                                        else $tags_html = esc_html__("No Tags","fashionstore");
                                        echo balanceTags($tags_html);
                                    ?>
                                </div>
                                <?php
                                if ( comments_open() || get_comments_number() ) { comments_template(); }
                               
                            endwhile; ?>
                        </div>
                    </div>
                    <?php s7upf_output_sidebar('right')?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>