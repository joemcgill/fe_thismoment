<?php
/*
Template Name: Modmat archive
*/
?>

<?php /* Counts the posts, comments and categories on your blog */
	$numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post'");
	if (0 < $numposts) $numposts = number_format($numposts); 
	
	$numpages = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'page'");
	if (0 < $numpages) $numpages = number_format($numpages);
	
	$numcomms = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = '1'");
	if (0 < $numcomms) $numcomms = number_format($numcomms);
	
	$numcats = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->categories");
	if (0 < $numcats) $numcats = number_format($numcats);
?>

<?php get_header() ?>

	<div id="container">
		<div id="content">

<?php the_post() ?>
			<div id="post-<?php the_ID(); ?>" <?php if (function_exists(post_class)) { post_class(); } else { sandbox_post_class(); } ?>>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-content">
					
					<p class="archivetext"><?php printf(__('This is the frontpage of the %1$s archives. Currently the archives are spanning %2$s posts and %3$s comments, contained within the meager confines of %4$s categories. Through here, you will be able to move down into the archives by way of time or category. If you are looking for something specific, perhaps you should try the search on the sidebar.','k2_domain'), get_bloginfo('name'), $numposts, $numcomms, $numcats); ?></p>
					<?php if (function_exists('wp_tag_cloud')) { ?>
						<h3><?php _e('Tag Cloud','k2_domain'); ?></h3>
						<br />
						<div id="tag-cloud">
						<?php wp_tag_cloud(); ?>
						</div>
					<?php } ?>
					
					<br class="clear" /><br class="clear" />
					
					<h3><?php _e('Browse by Month','k2_domain'); ?></h3>
					<ul class="archive-list">
						<?php wp_get_archives('show_post_count=1'); ?>
					</ul>

					<br class="clear" />

					<h3><?php _e('Browse by Category','k2_domain'); ?></h3>
					<ul class="archive-list">
						<?php wp_list_cats('hierarchical=0&optioncount=1'); ?>
					</ul>

					<br class="clear" />

				</div><!-- .entry-content -->
			</div><!-- .post -->
		</div><!-- #content -->
	</div><!-- #container -->
<?php get_sidebar() ?>
<?php get_footer() ?>