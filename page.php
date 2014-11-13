<?php include('header2.php'); ?>

	<div id="container">
		<div id="content-wide">

<?php the_post() ?>
			<div id="post-<?php the_ID(); ?>" <?php if (function_exists(post_class)) { post_class(); } else { sandbox_post_class(); } ?>>
				<h1 class="entry-title-2"><?php the_title(); ?><?php edit_post_link(__('Edit', 'sandbox'),'<span class="edit-page-link">','</span>') ?></h1>
				
				<div class="entry-content">
<?php the_content() ?>

<?php wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'sandbox'), "</div>\n", 'number'); ?>

				</div>
			</div><!-- .post -->
		</div><!-- #content -->
	</div><!-- #container -->
<?php //get_sidebar() ?>
<?php get_footer() ?>