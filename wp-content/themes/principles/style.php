<?php header('Content-type: text/css'); ?>
<?php if(get_option("ocmx_ignore_colours") != "yes"): ?>

	<?php if(get_option("ocmx_posttitles_links")) : ?>
		.post-title a{color: <?php echo get_option('ocmx_posttitles_links');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_posttitles_links_hover")) : ?>
		.post-title a:hover{color: <?php echo get_option('ocmx_posttitles_links_hover');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_copy_links")) : ?>
		.copy a, .date a{color: <?php echo get_option('ocmx_copy_links');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_copy_links_hover")) : ?>
		.copy a:hover, .date a:hover{color: <?php echo get_option('ocmx_copy_links_hover');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_navigation_links")) : ?>
		ul#nav li a{color: <?php echo get_option('ocmx_navigation_links');?>; border-color: <?php echo get_option('ocmx_navigation_links');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_navigation_hover")) : ?>
		ul#nav li a:hover{color: <?php echo get_option('ocmx_navigation_hover');?>; border-color: <?php echo get_option('ocmx_navigation_hover');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_sidebar_text")) : ?>
		.copyright, .footer-text, .logo .tagline{color: <?php echo get_option('ocmx_sidebar_text');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_sidebar_text_links")) : ?>
		.copyright a, .footer-text a, .logo .tagline a{color: <?php echo get_option('ocmx_sidebar_text_links');?>;}
	<?php endif; ?>
	
	<?php if(get_option("ocmx_sidebar_text_links_hover")) : ?>
		.copyright a:hover, .footer-text a:hover, .logo .tagline a:hover{color: <?php echo get_option('ocmx_sidebar_text_links_hover');?>;}
	<?php endif; ?>
	
<?php endif; ?>

<?php if(get_option("ocmx_custom_css") != ""): ?>
	<?php echo get_option("ocmx_custom_css"); ?>
<?php endif; ?>