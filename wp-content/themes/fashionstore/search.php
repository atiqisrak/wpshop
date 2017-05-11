<?php
/**
 * The template for displaying search results pages.
 *
 * @package 7up-framework
 */

get_header(); ?>
	<div class="main-wrapper tp-blog-page"> 
	    <div class="container">
	        <div class="row">
		        <?php s7upf_output_sidebar('left')?>		        
				<div class="wrap-content-main <?php echo esc_attr(s7upf_get_main_class()); ?>">
					<h2 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'fashionstore' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
                    <?php
                        $blog_style = s7upf_get_option('sv_style_blog');
                        if(empty($blog_style)) $blog_style = 'content';
                    ?>
                    <div class="content-blog <?php echo esc_attr('list-blog-'.$blog_style)?>">
                        <div class="content-blog-inner">
                        <?php if(have_posts()):?>    
                            <?php while (have_posts()) :the_post();?>

                                <?php get_template_part('s7upf_templates/blog-content/'.$blog_style);?>

                            <?php endwhile;?>

                            <?php wp_reset_postdata();?>

                        <?php else : ?>
                            <?php get_template_part( 's7upf_templates/blog-content/content', 'none' ); ?>
                        <?php endif;?>

                        </div>
                        <?php s7upf_paging_nav();?>
                    </div>
                </div>
	            <?php s7upf_output_sidebar('right')?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
