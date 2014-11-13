<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<div class="comments" id="comments">

	<?php if ( have_comments() ) : ?>
		<h3><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>
			<div class="navigation">
				<div class="alignleft"><?php previous_comments_link() ?></div>
				<div class="alignright"><?php next_comments_link() ?></div>
				<span class="clear" />
			</div>
		
			<ol id="commentlist">
				<?php wp_list_comments('type=comment&callback=modmat_comments'); ?>
				<li class="hidden"></li>
			</ol>
		
			<div class="navigation">
				<div class="alignleft"><?php previous_comments_link() ?></div>
				<div class="alignright"><?php next_comments_link() ?></div>
				<span class="clear" />
			</div>
	
	        <ol id="pinglist">
		        <?php wp_list_comments('type=pings&callback=modmat_pings'); ?>
		        <li class="hidden"></li>
	        </ol>
			
	 <?php else : // this is displayed if there are no comments so far ?>
	
		<?php if ('open' == $post->comment_status) { ?>
			<!-- If comments are open, but there are no comments. -->
			<h4>There are no responses yet</h4>
		 <?php } else if (!is_page()) { // comments are closed ?>
			<!-- If comments are closed. -->
			<h4>Comments are closed.</h4>
	
		<?php } ?>
	<?php endif; ?>
	
	<?php if ('open' == $post->comment_status) : ?>
	
	<div id="respond">
	
	<h5><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h5>
	
	<div class="cancel-comment-reply">
		<small><?php cancel_comment_reply_link(); ?></small>
	</div>
	
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>
	
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" name="commentform">
	
		<?php if ( $user_ID ) : ?>
			<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
		<?php else : ?>
			<p class="formfield"><label for="author"><?php _e('Name', 'sandbox') ?> <?php if ($req) _e('<span class="required">*</span>', 'sandbox') ?></label><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" /></p>
			<p class="formfield"><label for="email"><?php _e('Email', 'sandbox') ?> <?php if ($req) _e('<span class="required">*</span>', 'sandbox') ?></label><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" /></p>
			<p class="formfield"><label for="url"><?php _e('Website', 'sandbox') ?></label><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /></p>
		<?php endif; ?>
		<p class="formfield"><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>
		
		<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" /><?php comment_id_fields(); ?></p>
		<?php do_action('comment_form', $post->ID); ?>
	
	</form>
	
	<?php endif; // If registration required and not logged in ?>
	</div>
	
	<?php endif; // if you delete this the sky will fall on your head ?>
</div>