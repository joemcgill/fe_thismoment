			<div id="comments">
<?php
	$req = get_option('require_name_email'); // Checks if fields are required. Thanks, Adam. ;-)
	if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
		die ( 'Please do not load this page directly. Thanks!' );
	if ( ! empty($post->post_password) ) :
		if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) :
?>
				<div class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'sandbox') ?></div>
			</div><!-- .comments -->
<?php
		return;
	endif;
endif;
?>

<?php if (($comments) or ('open' == $post->comment_status)) : $shownavigation = 'yes'; ?>

	<div class="comments">

		<h4><?php printf(__('%1$s %2$s to &#8220;%3$s&#8221;','sandbox'), '<span id="thecomments">' . get_comments_number() . '</span>', (1 == $post->comment_count) ? __('Response','sandbox'): __('Responses','sandbox'), the_title('', '', false)); ?></h4>

		<div class="metalinks">
			<span class="commentsrsslink"><?php comments_rss_link(__('Feed for this Entry','sandbox')); ?></span>
			<?php if ('open' == $post->ping_status) { ?><span class="trackbacklink"><a href="<?php trackback_url(); ?>" title="<?php _e('Copy this URI to trackback this entry.','sandbox'); ?>"><?php _e('Trackback Address','sandbox'); ?></a></span><?php } ?>
		</div>

		<?php /* Seperate comments and pings */
			if ( $post->comment_count > 0 ) {
				$num_comments = 0;
				$num_pings    = 0;

				$comment_list = array();
				$ping_list    = array();

				foreach ($comments as $comment) {
					if ( 'comment' == get_comment_type() ) {
						$comment_list[++$num_comments] = $comment;
					} else {
						$ping_list[++$num_pings] = $comment;
					}
				}
			}
		?>

	<hr />

		<?php /* Check for comments */ if ( $num_comments > 0 ) { ?>
		<ol id="commentlist">

			<?php foreach ($comment_list as $comment_index => $comment) { ?>
			<li id="comment-<?php comment_ID(); ?>" class="<?php sandbox_comment_class($comment_index); ?>">
				<div id="comment-<?php comment_ID(); ?>">
      				<div class="comment-author vcard">
					<?php if (function_exists('get_avatar')) {
							echo get_avatar($comment, $size='32'); ?>
					<?php } else if (function_exists('gravatar')) { ?>
						<a href="http://www.gravatar.com/" title="<?php _e('What is this?','sandbox'); ?>">
							<img src="<?php gravatar("X", 32,  get_bloginfo('template_url')."/images/defaultgravatar.jpg"); ?>" class="gravatar" alt="<?php _e('Gravatar Icon','sandbox'); ?>" />
						</a>
					<?php } ?>
					<?php printf(__('<cite class="commentauthor">%s</cite>'), get_comment_author_link()) ?>
				</div>
				<?php if ($comment->comment_approved == '0') : ?>
				   <em><?php _e('Your comment is awaiting moderation.') ?></em>
				   <br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
		      	<?php
					printf('<a href="#comment-%1$s" title="%2$s">%3$s</a>', 
						get_comment_ID(),
						(function_exists('time_since')?
							sprintf(__('%s ago.','sandbox'),
								time_since(abs(strtotime($comment->comment_date_gmt . " GMT")), time())
							):
							__('Permanent Link to this Comment','sandbox')
						),
						sprintf(__('%1$s at %2$s','sandbox'),
							get_comment_date(__('M jS, Y','sandbox')),
							get_comment_time()
						)
					);
				?>
				<?php if (function_exists('jal_edit_comment_link')) { jal_edit_comment_link(__('Edit','sandbox'), '<span class="comment-edit">','</span>', '<em>(Editing)</em>'); } else { edit_comment_link(__('Edit','sandbox'), '<span class="comment-edit">', '</span>'); } ?>
				</div>
				<div class="comment-content wrap">
					<?php comment_text(); ?> 
				</div>
			</li>

			<?php } /* End foreach comment */ ?>

		</ol> <!-- END #commentlist -->
		<?php } /* end comment check */ ?>
		
		<?php /* Check for Pings */ if ( $num_pings > 0 ) { ?>
		<ol id="pinglist">

			<?php foreach ($ping_list as $ping_index => $comment) { ?>

			<li id="comment-<?php comment_ID(); ?>">
				<?php if (function_exists('gravatar')) { ?><a href="http://www.gravatar.com/" title="Get your avatar"><img src="<?php gravatar("PG","40",""); ?>" class="gravatar" alt="Gravatar" /></a> Says:<?php } ?>
				<a href="#comment-<?php comment_ID() ?>" title="<?php _e('Permanent Link to this Comment','sandbox'); ?>" class="counter"><?php echo $ping_index; ?></a>
				<span class="commentauthor"><?php comment_author_link(); ?></span>
				<div class="comment-meta">				
				<?php
					printf(__('%1$s on %2$s','sandbox'), 
						'<span class="pingtype">Pingback</span>',
						sprintf('<a href="#comment-%1$s" title="%2$s">%3$s</a>',
							get_comment_ID(),	
							(function_exists('time_since')?
								sprintf(__('%s ago.','sandbox'),
									time_since(abs(strtotime($comment->comment_date_gmt . " GMT")), time())
								):
								__('Permanent Link to this Comment','sandbox')
							),
							sprintf(__('%1$s at %2$s','sandbox'),
								get_comment_date(__('M jS, Y','sandbox')),
								get_comment_time()
							)			
						)
					);
				?>				
				<?php if ($user_ID) { edit_comment_link(__('Edit','sandbox'),'<span class="comment-edit">','</span>'); } ?>
				</div>
			</li>
			<?php } /* end foreach ping */ ?>
		</ol> <!-- END #pinglist -->
		<?php } /* end ping check */ ?>
		
		<?php /* Comments open, but empty */ if ( ($post->comment_count < 1) and comments_open() ) { ?> 
		<ol id="commentlist">
			<li id="leavecomment">
				<?php _e('No Comments','sandbox'); ?>
			</li>
		</ol>
		<?php } ?>
		
		<?php /* Comments closed */ if ( !comments_open() and is_single() ) { ?>
			<div id="comments-closed-msg"><?php _e('Comments are currently closed.','sandbox'); ?></div>
		<?php } ?>

	</div> <!-- END .comments 1 -->
		
	<?php endif; ?>
    
    
    
    
    
    
    
<?php if ( 'open' == $post->comment_status ) : ?>
				<div id="respond">
					<h3><?php _e('Post a Comment', 'sandbox') ?></h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
					<p id="login-req"><?php printf(__('You must be <a href="%s" title="Log in">logged in</a> to post a comment.', 'sandbox'),
					get_option('siteurl') . '/wp-login.php?redirect_to=' . get_permalink() ) ?></p>

<?php else : ?>
					<div class="formcontainer">	
						<form id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">

<?php if ( $user_ID ) : ?>
							<p id="login"><?php printf(__('<span class="loggedin">Logged in as <a href="%1$s" title="Logged in as %2$s">%2$s</a>.</span> <span class="logout"><a href="%3$s" title="Log out of this account">Log out?</a></span>', 'sandbox'),
								get_option('siteurl') . '/wp-admin/profile.php',
								wp_specialchars($user_identity, true),
								get_option('siteurl') . '/wp-login.php?action=logout&amp;redirect_to=' . get_permalink() ) ?></p>

<?php else : ?>

							<p id="comment-notes"><?php _e('Your email is <em>never</em> published nor shared.', 'sandbox') ?> <?php if ($req) _e('Required fields are marked <span class="required">*</span>', 'sandbox') ?></p>

							<div class="form-label"><label for="author"><?php _e('Name', 'sandbox') ?> <?php if ($req) _e('<span class="required">*</span>', 'sandbox') ?></label></div>
							<div class="form-input"><input id="author" name="author" type="text" value="<?php echo $comment_author ?>" size="30" maxlength="20" tabindex="3" /></div>

							<div class="form-label"><label for="email"><?php _e('Email', 'sandbox') ?> <?php if ($req) _e('<span class="required">*</span>', 'sandbox') ?></label></div>
							<div class="form-input"><input id="email" name="email" type="text" value="<?php echo $comment_author_email ?>" size="30" maxlength="50" tabindex="4" /></div>

							<div class="form-label"><label for="url"><?php _e('Website', 'sandbox') ?></label></div>
							<div class="form-input"><input id="url" name="url" type="text" value="<?php echo $comment_author_url ?>" size="30" maxlength="50" tabindex="5" /></div>

<?php endif /* if ( $user_ID ) */ ?>

							<div class="form-label"><label for="comment"><?php _e('Comment', 'sandbox') ?></label></div>
							<div class="form-textarea"><textarea id="comment" name="comment" cols="45" rows="8" tabindex="6"></textarea></div>

							<div class="form-submit"><input id="submit" name="submit" type="submit" value="<?php _e('Post Comment', 'sandbox') ?>" tabindex="7" /><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></div>

							<?php do_action('comment_form', $post->ID); ?>

						</form><!-- #commentform -->
					</div><!-- .formcontainer -->
<?php endif /* if ( get_option('comment_registration') && !$user_ID ) */ ?>

				</div><!-- #respond -->
<?php endif /* if ( 'open' == $post->comment_status ) */ ?>

			</div><!-- #comments -->
