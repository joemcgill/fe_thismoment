<?php get_header() ?>

	<div id="container">
		<div id="content">
	<h1 class='entry-title'>FE BAND BLOG</h1>
<?php 
	query_posts('posts_per_page=5'); 
	while ( have_posts() ) : the_post() ?>
			<div id="post-<?php the_ID() ?>" <?php if (function_exists(post_class)) { post_class(); } else { sandbox_post_class(); } ?>>
				<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'sandbox'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h2>



				<div class="top-meta">
     <small class="metadata">
<span class="authdata">
<?php the_author() ?></span>
 <span class="chronodata"><?php the_time('F jS, Y') ?></span><BR>
                    	<span class="comments-link"><?php comments_popup_link('0', '1', '%', 'commentslink', 'Closed'); ?> Comments</span>
                    	
                       
                        
<!--span class="cat-links"><?php //printf(__('Posted in %s', 'sandbox'), get_the_category_list(', ')) ?></span -->
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
<?php endwhile ?>

			<!-- div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'sandbox')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'sandbox')) ?></div>
				<span class="clear" />
			</div -->
			<div id="nav-below" class="navigation">Looking for something older? Try the <A HREF='<?php bloginfo('url') ?>/archives/'>Archives</A></DIV>
		</div><!-- #content -->
	</div><!-- #container -->
    
<?php get_sidebar() ?>
<?php get_footer() ?>