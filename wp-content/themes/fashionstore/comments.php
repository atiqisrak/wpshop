<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package 7up-framework
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() ) {
	return;
}
if(!function_exists('s7upf_comments_list'))
{ 
    function s7upf_comments_list($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment;
        /* override default avatar size */
        $args['avatar_size'] = 122;
        if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) :
            ?>
        <li class="pingback-comment">
            <span id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>></span>
            <div class="comment-body">
                <?php esc_html_e('Pingback:', 'fashionstore'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(esc_html__('Edit', 'fashionstore'), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i>', '</span>'); ?>
            </div>
        <?php else : ?>
	        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent' ); ?>>
	        	<div class="item-post-comment">
					<div class="post-comment-thumb">
						<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo get_avatar($comment, $args['avatar_size'])?></a>
					</div>
					<div class="post-comment-info">
						<h3><?php printf(esc_html__('%s', 'fashionstore'), sprintf('%s', get_comment_author_link())); ?></h3>
						<?php echo str_replace('comment-reply-link', 'comment-reply', get_comment_reply_link(array_merge( $args, array('reply_text' =>esc_html__('Reply','fashionstore'),'depth' => $depth, 'max_depth' => $args['max_depth'])))) ?>
						<div class="comment-text"><?php comment_text();?></div>
					</div>
				</div>
        <?php
        endif;
    }
}
?>
	<div id="comments" class="comments-area comments">
		<?php // You can start editing here -- including this comment! ?>

			<?php if ( have_comments() ) : ?>
				<div class="post-comment">
					<h2 class="title-default"><?php echo esc_html__('Comments', 'fashionstore'); ?></h2>
					<ol class="comments list-post-comment">
			            <?php
			            wp_list_comments(array(
			                'style' => '',
			                'short_ping' => true,
			                'avatar_size' => 74,
			                'max_depth' => '5',
			                'callback' => 's7upf_comments_list',
			                // 'walker' => new s7upf_custom_comment()
			            ));
			            ?>
			        </ol>

					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
					<nav id="comment-nav-below" class="comment-navigation" role="navigation">
						<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'fashionstore' ); ?></h1>
						<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'fashionstore' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'fashionstore' ) ); ?></div>
					</nav><!-- #comment-nav-below -->
					<?php endif; // check for comment navigation ?>				
				</div>
			<?php endif; // have_comments() ?>

			<?php
				// If comments are closed and there are comments, let's leave a little note, shall we?
				if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
			?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'fashionstore' ); ?></p>
			<?php endif; ?>
	</div>
<div class="leave-reply">
	<div class="leave-comments">
		<?php
		$comment_form = array(
            'title_reply' => esc_html__('Leave a comments', 'fashionstore'),
            'fields' => apply_filters( 'comment_form_default_fields', array(
                    'author'=>	'<p>
                                    <input class="form-control your-name" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" placeholder="'.esc_html__( 'Your name', 'fashionstore' ).'" />
                                </p>',
                    'email' =>	'<p>
                                    <input class="form-control your-email" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .'" placeholder="'.esc_html__( 'Your email', 'fashionstore' ).'" />
                                </p>',
                    'url' 	=>	'<p>
                                    <input class="form-control your-site" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'" placeholder="'.esc_html__( 'Your site', 'fashionstore' ).'" />
                                </p>',
                )
            ),
            'comment_field' =>  '<p>
                                    <textarea id="comment" class="form-control" rows="5" name="comment" aria-required="true" placeholder="'.esc_html__( 'Comments:', 'fashionstore' ).'"></textarea>
                                </p>',
            'must_log_in' => '<div class="must-log-in control-group"><div class="controls">' .sprintf(wp_kses_post(__( 'You must be <a href="%s">logged in</a> to post a comment.','fashionstore' )),wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )) . '</div></div >',
            'logged_in_as' => '<div class="logged-in-as control-group"><div class="controls">' .sprintf(wp_kses_post(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','fashionstore' )),admin_url( 'profile.php' ),$user_identity,wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )) . '</div></div>',
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'id_form'              => 'commentform',
            'class_form'           => 'leave-reply-form',
            'id_submit'            => 'submit',
            'title_reply'          => esc_html__( 'Leave Comments','fashionstore' ),
            'title_reply_to'       => esc_html__( 'Leave a Reply %s','fashionstore' ),
            'cancel_reply_link'    => esc_html__( 'Cancel reply','fashionstore' ),
            'label_submit'         => esc_html__( 'Send comment','fashionstore' ),
            'class_submit'         => 'submit-reply',
        );
		?>
		<?php comment_form($comment_form); ?>
	</div>
</div>
<?php

class s7upf_custom_comment extends Walker_Comment {
     
    /** START_LVL 
     * Starts the list before the CHILD elements are added. */
    function start_lvl( &$output, $depth = 0, $args = array() ) {       
        $GLOBALS['comment_depth'] = $depth + 1;

           $output .= '<div class="children">';
        }
 
    /** END_LVL 
     * Ends the children list of after the elements are added. */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;
        $output .= '</div>';
    }
    function end_el( &$output, $object, $depth = 0, $args = array() ) {
    	$output .= '';
    }
}
?>

