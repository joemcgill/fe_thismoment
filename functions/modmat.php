<?php
// modmat options

// If 2.7+ use comments.php, otherwise its legacy.comments.php
// (hat tip: http://justintadlock.com/archives/2008/11/01/making-your-themes-comments-compatible-with-wordpress-27-and-earlier-versions)
add_filter('comments_template', 'legacy_comments');

function legacy_comments($file) {
	if(!function_exists('wp_list_comments')) : // WP 2.7-only check
		$file = TEMPLATEPATH . '/legacy.comments.php';
	endif;

	return $file;
}

function modmatCheckSiteWidth() {
	$width = get_option('modmat_width');

	if ( $width == "975" ) {
		echo '<link rel="stylesheet" type="text/css" href="';
		bloginfo('template_url');
		echo '/style975.css" />';
	}
}

function modmatHeaderImage() {
	$header = get_option('modmat_header');
	$random = get_option('modmat_random');
	if ( $random == "on" ) {
		echo " style=\"background-image:url('";
		bloginfo('template_directory');
		echo "/headers/";
		modmatRandomHeaderImage();
		echo"');background-repeat: no-repeat;\"";
	} else if ( $header != "" ) {
		echo " style=\"background-image:url('";
		bloginfo('template_directory');
		echo "/headers/" . $header . "');background-repeat: no-repeat;\"";
	}
}

function modmatBackground() {
	$bg = get_option('modmat_background');
	$bt = get_option('modmat_backgroundtiling');
	$bp = get_option('modmat_backgroundposition');
	$ba = get_option('modmat_backgroundattachment');
	$bc = get_option('modmat_backgroundcolor');
	
	echo ' style="';
	if ( $bg != "" && $bg != "default-background.gif" ) {
		if ( $bg == "none" ) {
			echo 'background-image:none;';
		} else {
			echo "background-image:url('";
			bloginfo('template_directory');
			echo "/backgrounds/" . $bg . "');";
			echo "background-repeat:";
			if ($bt != "") {
				echo $bt .";";
			} else {
				echo "repeat-x;";
			}
			echo "background-position:";
			if ($bp != "") {
				echo str_replace("_", " ", $bp) .";";
			} else {
				echo 'top-left';
			}
			echo "background-attachment:";
			if ($ba != "") {
				echo $ba .";";
			} else {
				echo "scroll;";
			}
		}
		if ($bc != "" &&  preg_match("/^[a-zA-Z0-9]{6}$/", $bc )) {
			echo 'background-color:#' . $bc . ';';
		}
	}
	echo '"';
}

function modmatRandomHeaderImage() {
	global $styleFolder;
	if ($handle = opendir($styleFolder . '/headers')) {
		$i = 1;
		while (false !== ($file = readdir($handle))) {
			if (validImageFile($file)) {
				$arr[$i]['header'] = $file;
				$i++;
			}
		}
		$randomCount = rand(1, count($arr));
		echo $arr[$randomCount]['header'];
	}
}

function validImageFile($file) {
	if ($file != "." && $file != ".." && substr($file,0,1) != "." && strtolower($file) != "thumbs.db") {
		return true;
	} else {
		return false;
	}
}

function listAvailableHeaders() {
	global $styleFolder;
	if ($handle = opendir($styleFolder . '/headers')) {
		$header = get_option('modmat_header');
		$random = get_option('modmat_random');
		echo '<select name="modmat_header" id="modmat_header"';
		if ( $random == "on" ) {
			echo ' disabled="disabled"';
		}
		echo '>';
		while (false !== ($file = readdir($handle))) {
			if (validImageFile($file)) {
				echo '<option value=' . $file;
				if ( $file == $header || ($header=="" && $file=="defaultheader.gif") ) {
					echo ' selected="selected"';
				}
				echo '>' . $file . '</option>';
			}
		}
		echo '</select>';
	}
}

function listAvailableBackgrounds() {
	global $styleFolder;
	if ($handle = opendir($styleFolder . '/backgrounds')) {
		$bg = get_option('modmat_background');
		echo '<select name="modmat_background" id="modmat_background">';
			echo '<option value="none"';
			if ($bg=="none") echo ' selected="selected"';
			echo '>None</option>';
			while (false !== ($file = readdir($handle))) {
				if (validImageFile($file)) {
					echo '<option value=' . $file;
					if ( $file == $bg || ($bg=="" && $file=="defaultbg.gif") ) {
						echo ' selected="selected"';
					}
					echo '>' . $file . '</option>';
				}
			}
		echo '</select>';
	}
}

function listAvailableWidths() {
	$width = get_option('modmat_width');
	echo '<select name="modmat_width" id="modmat_width">';
		echo '<option value="775" ';
		if ( $width == "775" || $width == "" ) {
				echo ' selected="selected"';
		}
		echo '>775</option>';
		echo '<option value="975" ';
		if ( $width == "975" ) {
				echo ' selected="selected"';
		}
		echo '>975</option>';
	echo '</select> pixels';
}

function listTilingOptions() {
	$width = get_option('modmat_backgroundtiling');
	echo '<select name="modmat_backgroundtiling" id="modmat_backgroundtiling">';
		echo '<option value="repeat-x" ';
		if ( $width == "repeat-x" || $width == "" ) {
				echo ' selected="selected"';
		}
		echo '>Repeat horizontally only</option>';
		echo '<option value="repeat-y" ';
		if ( $width == "repeat-y" ) {
				echo ' selected="selected"';
		}
		echo '>Repeat Vertically Only</option>';
		echo '<option value="repeat" ';
		if ( $width == "repeat" ) {
				echo ' selected="selected"';
		}
		echo '>Repeat Horizontally &amp Vertically</option>';
		echo '<option value="no-repeat" ';
		if ( $width == "no-repeat" ) {
				echo ' selected="selected"';
		}
		echo '>Do Not Repeat</option>';
	echo '</select>';
}

function listPositioningOptions() {
	$width = get_option('modmat_backgroundposition');
	echo '<select name="modmat_backgroundposition" id="modmat_backgroundposition">';
		echo '<option value="top_left" ';
		if ( $width == "top_left" || $width == "" ) {
				echo ' selected="selected"';
		}
		echo '>Top Left</option>';
		echo '<option value="top_middle" ';
		if ( $width == "top_middle" ) {
				echo ' selected="selected"';
		}
		echo '>Top Middle</option>';
		echo '<option value="top_right" ';
		if ( $width == "top_right" ) {
				echo ' selected="selected"';
		}
		echo '>Top Right</option>';
		echo '<option value="bottom_left" ';
		if ( $width == "bottom_left" ) {
				echo ' selected="selected"';
		}
		echo '>Bottom Left</option>';
		echo '<option value="bottom_middle" ';
		if ( $width == "bottom_middle" ) {
				echo ' selected="selected"';
		}
		echo '>Bottom Middle</option>';
		echo '<option value="bottom_right" ';
		if ( $width == "bottom_right" ) {
				echo ' selected="selected"';
		}
		echo '>Bottom Right</option>';
	echo '</select> pixels';
}

function listAttachmentOptions() {
	$width = get_option('modmat_backgroundattachment');
	echo '<select name="modmat_backgroundattachment" id="modmat_backgroundattachment">';
		echo '<option value="scroll" ';
		if ( $width == "scroll" || $width == "" ) {
				echo ' selected="selected"';
		}
		echo '>Yes</option>';
		echo '<option value="fixed" ';
		if ( $width == "fixed" ) {
				echo ' selected="selected"';
		}
		echo '>No</option>';
	echo '</select> pixels';
}

function backgroundColorInput() {
	$bc = get_option('modmat_backgroundcolor');
	echo '<input type="text" name="modmat_backgroundcolor" id="modmat_backgroundcolor" value="';
	if ($bc=="")
		$bc = '333333';
	echo $bc;
	echo '" maxlength="6" /> ';
	if(!preg_match("/^[a-zA-Z0-9]{6}$/", $bc ) )
		echo '<span style="color:red;">Warning: This is not a valid hex code (6 characters, letters and numbers only)</span> ';
	echo '<a href="#colorpickerhelp">whats this?</a></p>';

}

function modmat_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
         <?php echo get_avatar($comment,$size='32'); ?>

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

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
     </div>
<?php
}

function modmat_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li id="comment-<?php comment_ID(); ?>">
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
	<?php
}

function modmat_options() {
	?>
    <script type="text/javascript">
		function checkRandomStatus() {
			if ( document.getElementById('modmat_random').checked == true ) {
				document.getElementById('modmat_header').disabled = "disabled";
			} else {
				document.getElementById('modmat_header').disabled = "";
			}
		}
	</script>
	<form method="post" action="options.php">
    	<div class="wrap">
			<h2><?php echo __('Modmat Theme Options') ?></h2>
			<?php wp_nonce_field('update-options') ?>
            <?php 
				echo '<h3>Header Options</h3>';
				echo '<p>Header: ';
				listAvailableHeaders();
				echo '</p>';
				echo '<p>Random Header?: <input type="checkbox" name="modmat_random" id="modmat_random"';
				$random = get_option('modmat_random');
				if ($random == "on" ) {
				 	echo ' checked="checked"';
				}
				echo ' onclick="checkRandomStatus();" /></p>';
				echo '<br /><br>';
				
				echo '<h3>Background Options</h3>';
				echo '<p>Background Color: #';
				backgroundColorInput();
				echo '<p>Background Image: ';
				listAvailableBackgrounds();
				echo '</p>';
				
				if (get_option('modmat_background') == "default-background.gif")
					echo '<p><strong><small>(You cannot change the tiling or positioning options with the default theme)</small></strong><p>';
				
				echo '<p>Background Tiling: ';
				listTilingOptions();
				echo '</p>';
				echo '<p>Background Positioning: ';
				listPositioningOptions();
				echo '</p>';
				echo '<p>Allow background to scroll?: ';
				listAttachmentOptions();
				echo '</p>';
				echo '<br /><br>';
				
				echo '<h3>Width Options</h3>';
            	echo '<p>Width: ';
				listAvailableWidths();
				echo '</p>'; 
			?>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="modmat_header, modmat_width, modmat_random, modmat_backgroundcolor, modmat_background, modmat_backgroundtiling, modmat_backgroundposition, modmat_backgroundattachment" />
            <p class="submit"><input type="submit" name="Submit" value="<?php _e('Update Options »') ?>" /></p>
            <hr />
            <h2>Help</h2>
            <h3>Headers</h3>
            <p><strong>To use you own header</strong>, upload the image to the "headers" folder within the theme folder, then activate it via this page.</p>
            <p>Header images should be around 400px by 105px, are aligned so that the top right of the image is positioned in the top right of the header box.  Anything over this size won't affect the size of the box, it'll just be hidden.</p>
            <p><strong>To use random headers</strong>, simply put a tick in the box and save your options.  The theme will scan the "headers" folder for any files and display one at random.  So don't keep any images in there that you don't want to be included in the rotation!</p>
            <p>&nbsp;</p>
            <h3>Backgrounds</h3>
            <p id="colorpickerhelp"><strong>Background color</strong> requires a valid hex code.  For more info, <a href="http://www.colorpicker.com/" target="_blank"> check out http://www.colorpicker.com/</a></p>
            <p><strong>To use you own background</strong>, upload the image to the "backgrounds" folder within the theme folder, then activate it via this page.</p>
            <p><strong>Background Position</strong> determines where on the page the background is positioned</p>
            <p><strong>Scrolling</strong> affects whether the background image moves with the page.  So, for example, if you're using a huge image you want to stay in one place, set it to "no".</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <h3>Want to donate?</h3>
            <p>If you like my work and want to give me the fuzzy, warm feeling of knowing someone likes it <em>that much</em>, you can send me a couple of £/$ using the form below  :)</p>
            <form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="cezuk@aol.com">
			<input type="hidden" name="item_name" value="FDW Donation">
			<input type="hidden" name="currency_code" value="GBP">
			<input type="image" src="http://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" style="margin:0 0 -10px;">
			£<input type="text" name="amount" value="" size="20">
			</form>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <h3>Anything else?</h3>
            <p>I'd appreciate any feedback or bug reports - if I dont know theres a problem, I can't fix it!  Leave a comment on the <a href="http://mou.me.uk/projects/wordpress/themes/modmat/" target="_blank">project page</a>, or <a href="http://mou.me.uk/contact/" target="_blank">drop me an email</a>.</p>
            <p>&nbsp;</p>
            <p>Otherwise, thanks for downloading the theme, and enjoy!  :)</p>
		</div>
    </form>
	<?php
}

function modmat_admin_menu() {
	if (function_exists('add_options_page')) {
		add_options_page('Modmat Theme Options', 'Modmat', 8, basename(__FILE__), 'modmat_options');
	}
}

add_action('admin_menu', 'modmat_admin_menu'); 



?>