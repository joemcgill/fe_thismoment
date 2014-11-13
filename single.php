<?php get_header() ?>

	<div id="container">
		<div id="content">

<?php the_post(); ?>
			
            <div id="nav-above" class="navigation">
				<div class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">&laquo;</span> %title') ?></div>
				<div class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav">&raquo;</span>') ?></div>
				<span class="clear" />
			</div>
            
			<div id="post-<?php the_ID(); ?>" <?php if (function_exists(post_class)) { post_class(); } else { sandbox_post_class(); } ?>>
				<h1 class="entry-title"><?php the_title(); ?></h1>
                <div class="top-meta">
                	<small class="metadata">
                    	<span class="chronodata"><?php the_time('F jS, Y') ?> by <?php the_author_link(); ?></span>
                        <span class="meta-sep">|</span>
                        <span class="cat-links"><?php printf(__('Posted in %s', 'sandbox'), get_the_category_list(', ')) ?></span>
    <?php edit_post_link(__('Edit', 'sandbox'), "\t\t\t\t\t<span class=\"meta-sep\">|</span><span class=\"edit-link\">", "</span>\n"); ?>
                        
                     </small>
				</div>
				<div class="entry-content">
<?php the_content(''.__('Read More <span class="meta-nav">&raquo;</span>', 'sandbox').''); ?>

					<?php wp_link_pages('before=<div class="page-link">' .__('Pages:', 'sandbox') . '&after=</div>') ?>
					<span class="clear"></span>
				</div>
                <div class="bottom-meta">
                	<small class="metadata"><?php the_tags(__('<span class="tag-links">Tagged in: ', 'sandbox'), ", ", "</span>\n") ?></small>
                </div>
			</div><!-- .post -->

<?php comments_template(); ?>

		</div><!-- #content -->
	</div><!-- #container -->
<?php get_sidebar() ?>
<?php get_footer() ?>
