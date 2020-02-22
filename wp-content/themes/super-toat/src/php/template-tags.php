<?php

if ( ! function_exists( 'toat_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Template on a Train 1.0
 */
function toat_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'toat' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'toat' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 70 ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'toat' ); ?></em>
					<br />
				<?php endif; ?>
				
				<div class="comment-secondary">
					<div class="comment-meta commentmetadata">
					
						<?php printf( __( '%s', 'toat' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
						<?php printf( __( '%1$s', 'toat' ), get_comment_date() ); ?>

						<span class="comment-functions">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="ss-icon"><time pubdate datetime="<?php comment_time( 'c' ); ?>">link</time></a>
							<span class="ss-icon"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => "reply") ) ); ?></span>
						</span>					
						
					</div><!-- .comment-meta .commentmetadata -->
				
	
					<div class="comment-content"><?php comment_text(); ?></div>
					
					
				</div> <!-- end comment-secondary -->
				
				<div class="clear"></div>
			
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for toat_comment()