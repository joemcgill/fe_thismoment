<?php get_header() ?>

	<div id="container">
		<div id="content">

<?php the_post() ?>

<?php if ( is_day() ) : ?>
			<h1 class="page-title"><?php printf(__('Daily Archives: <span>%s</span>', 'sandbox'), get_the_time(get_option('date_format'))) ?></h1>
<?php elseif ( is_month() ) : ?>
			<h1 class="page-title"><?php printf(__('Monthly Archives: <span>%s</span>', 'sandbox'), get_the_time('F Y')) ?></h1>
<?php elseif ( is_year() ) : ?>
			<h1 class="page-title"><?php printf(__('Yearly Archives: <span>%s</span>', 'sandbox'), get_the_time('Y')) ?></h1>
<?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
			<h1 class="page-title"><?php _e('Blog Archives', 'sandbox') ?></h1>
<?php endif; ?>

<?php rewind_posts() ?>

			<div id="nav-above" class="navigation">
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'sandbox')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'sandbox')) ?></div>
			</div>

<?php while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID() ?>" <?php if (function_exists(post_class)) { post_class(); } else { sandbox_post_class(); } ?>>
				<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'sandbox'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h2>
				<div class="top-meta">
                	<small class="metadata">
                    	<span class="chronodata"><?php the_time('F jS, Y') ?></span>
                        <span class="meta-sep">|</span>
                        <span class="cat-links"><?php printf(__('Posted in %s', 'sandbox'), get_the_category_list(', ')) ?></span>
    <?php edit_post_link(__('Edit', 'sandbox'), "\t\t\t\t\t<span class=\"meta-sep\">|</span><span class=\"edit-link\">", "</span>\n"); ?>
                        
                     </small>
				</div>
				<div class="entry-content">
<?php the_excerpt(''.__('Read More <span class="meta-nav">&raquo;</span>', 'sandbox').'') ?>

				</div>
				<div class="entry-meta">
<?php if ( $tag_ur_it = sandbox_tag_ur_it(', ') ) : ?>
					<span class="tag-links"><?php printf(__('Tagged in: %s', 'sandbox'), $tag_ur_it) ?></span>
					<span class="meta-sep">|</span>
<?php endif ?>
					<span class="comments-link"><?php comments_popup_link(__('0 Comments', 'sandbox'), __('1 Comment', 'sandbox'), __('% Comments', 'sandbox')) ?></span>
				</div>
			</div><!-- .post -->

<?php endwhile ?>

			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'sandbox')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'sandbox')) ?></div>
			</div>

		</div><!-- #content .hfeed -->
	</div><!-- #container -->
<?php get_sidebar() ?>
<?php get_footer() ?>