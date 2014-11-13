<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>

<head profile="http://gmpg.org/xfn/11">
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
	<title><?php if ( !(is_404()) && (is_single()) or (is_page()) or (is_archive()) ) { ?><?php wp_title(''); ?> | <?php } ?> <?php bloginfo('name'); ?><?php if (is_home()) { ?> | <?php bloginfo('description'); ?><?php } ?></title>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
	<meta name="description" content="<?php bloginfo('description') ?>" />
	
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
	<?php modmatCheckSiteWidth(); ?>
    
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php echo wp_specialchars(get_bloginfo('name'), 1) ?> <?php _e('Posts RSS feed', 'sandbox'); ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php echo wp_specialchars(get_bloginfo('name'), 1) ?> <?php _e('Comments RSS feed', 'sandbox'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<?php if ( is_single() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head() ?>

</head>

<body class="<?php sandbox_body_class() ?>"<?php modmatBackground(); ?>>
<div id="wrapper" class="hfeed">

	<div id="header2">
	<IMG src="<?php bloginfo('template_url') ?>/images/blank.gif" width=975 height=150 usemap="#headermap">
	</div>
	<map name="headermap">
		  <area shape='rect' coords='660,114,725,130' href='<?php bloginfo('url') ?>/videos' alt='Videos'>
            <area shape='rect' coords='839,114,957,130' href='<?php bloginfo('url') ?>/mocha' alt='Mocha Club'>
            <area shape='rect' coords='600,114,650,130' href='<?php bloginfo('url') ?>/tour' alt='Tours'>
            <area shape='rect' coords='737,114,826,130' href='<?php bloginfo('url') ?>/about' alt='About FE'>   
           
			<area shape='rect' coords='465,114,588,130' href='http://fundamentalelements.bandcamp.com/' alt='Blog'>
		   <area shape='rect' coords='402,114,452,130' href='<?php bloginfo('url') ?>' alt='Blog'>
           <area shape='rect' coords='0,0,400,150' href='<?php bloginfo('url') ?>' alt='Blog'>
		   <area shape='rect' coords='401,0,975,110' href='<?php bloginfo('url') ?>' alt='Blog'>
	
<!--

<area shape='rect' coords='0,0,400,150' href='http://www.fundamentalelements.net/'   alt='Blog'  > 

<area shape='rect' coords='660,114,725,130' href='http://www.fundamentalelements.net/videos'  alt='Videos'  > 

<area shape='rect' coords='465,114,588,130' href='/'  alt='Music'   > 

<area shape='rect' coords='401,0,975,110' href='http://www.fundamentalelements.net/'  alt='Blog'  > 

<area shape='rect' coords='737,114,826,130' href='http://www.fundamentalelements.net/about' alt='About FE' 	 > 

<area shape='rect' coords='839,114,957,130' href='http://www.fundamentalelements.net/mocha' alt='Mocha Club' > 

<area shape='rect' coords='402,114,452,130' href='http://www.fundamentalelements.net/' alt='Blog' > 

<area shape='rect' coords='600,114,650,130' href='http://www.fundamentalelements.net/tour'  alt='Tours' > 

-->
	
	
	
	</map>
	
	
	<!--
		<h1 class="blog-title"><a href="<?php //echo get_option('home') ?>/" title="<?php //bloginfo('name') ?>" rel="home"><?php //bloginfo('name') ?></a></h1>
		<div id="blog-description"><?php //bloginfo('description') ?></div>
	</div> -->
	<!--  #header -->

	<div id="access">
		<?php //sandbox_globalnav() ?>
	</div><!-- #access -->
