<?php function obox_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
	<li class="comment clearfix" id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author comment-avatar vcard">
				<?php echo get_avatar($comment, $size = '50'); ?>
			</div>
			
			<div class="comment-post clearfix">
                <h4 class="comment-name"><?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?></h4>
				<?php if ($comment->comment_approved == '0') : ?>
					<em><?php _e('Your comment is awaiting moderation.', 'ocmx') ?></em>
					<br />
				<?php endif; ?>
                <h5 class="date"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></h5>
				
				<?php comment_text() ?>
                <a class="reply-to-comment" href="#"><?php _e('Reply','ocmx'); ?></a>
			</div>
		</div>
<?php
}