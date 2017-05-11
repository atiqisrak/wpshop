<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<?php
			$page_id = s7upf_get_option('s7upf_404_page');
			if(!empty($page_id)) {
			    echo 	'<div class="custom-404-page">
			            	<div class="container">';
			    echo        	S7upf_Template::get_vc_pagecontent($page_id);
			    echo    	'</div>
			          	</div>';
			}
			else{ ?>
				<div class="container">
					<div id="main" class="st-default">
						<section class="error-404 not-found">
							<header class="page-header">
								<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'fashionstore' ); ?></h1>
							</header><!-- .page-header -->

							<div class="page-content">
								<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'fashionstore' ); ?></p>

								<?php get_search_form(); ?>
							</div>
						</section>
					</div>
				</div>
			<?php }?>
	</div>

<?php get_footer(); ?>
