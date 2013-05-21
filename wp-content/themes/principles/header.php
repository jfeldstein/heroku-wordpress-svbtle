<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> xmlns:og="http://ogp.me/ns/fb#" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:addthis="http://www.addthis.com/help/api-spec">
<head profile="http://gmpg.org/xfn/11">
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
	<?php
		global $page, $paged;
		wp_title( '|', true, 'right' );
		bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'ocmx' ), max( $paged, $page ) );
	?>
</title>
<!--Set Viewport for Mobile Devices -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<!-- Setup OpenGraph support-->
<?php if(is_home()) : ?>

<meta property="og:title" content="<?php bloginfo('name'); ?>"/>
<meta property="og:description" content="<?php bloginfo('description'); ?>"/>
<meta property="og:url" content="<?php echo home_url(); ?>"/>
<meta property="og:image" content="<?php echo get_fbimage(); ?>"/>
<meta property="og:type" content="<?php echo "website";?>"/>
<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>

<?php else : ?>
<meta property="og:title" content="<?php the_title(); ?>"/>
<meta property="og:description" content="<?php echo strip_tags($post->post_excerpt); ?>"/>
<meta property="og:url" content="<?php the_permalink(); ?>"/>
<meta property="og:image" content="<?php echo get_fbimage(); ?>"/>
<meta property="og:type" content="<?php
  if (is_single() || is_page()) { echo "article"; } elseif(is_home()) {echo "website";} else { echo "website";}
?>"/>
<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
<?php endif; ?>
<!--Begin styling -->
<?php if(get_option("ocmx_custom_favicon") != "") : ?>
	<link href="<?php echo get_option("ocmx_custom_favicon"); ?>" rel="icon" type="image/png" />
<?php endif; ?>
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/responsive.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="<?php echo home_url('/'); ?>?stylesheet=custom" rel="stylesheet" type="text/css" />
<link href="<?php echo get_template_directory_uri(); ?>/custom.css" rel="stylesheet" type="text/css" />
<link href="<?php bloginfo('template_directory'); ?>/ocmx/jplayer.css" rel="stylesheet" type="text/css" />

<?php if(get_option("ocmx_rss_url")) : ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo get_option("ocmx_rss_url"); ?>" />
<?php else : ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<?php endif; ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if(get_option("ocmx_typekit") != "") :
	echo get_option("ocmx_typekit");
endif; ?>


<!--[if lt IE 8]>
       <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/ie.css" media="screen" />
<![endif]-->

<?php wp_head(); ?>

</head>

<body <?php body_class(''); ?>>

    <div id="header-container">
        <div id="header" class="clearfix">
            
            <div class="logo">
                <?php if(get_option("ocmx_custom_logo")) : ?>
                    <a href="<?php echo home_url(); ?>"><img src="<?php echo get_option("ocmx_custom_logo"); ?>" alt="<?php bloginfo('name'); ?>" /></a>
                <?php endif; ?>
                <?php if(get_option("ocmx_display_site_title") != "no") : ?>
                    <h1>
                        <a href="<?php echo home_url(); ?>">
                            <?php echo strip_tags(bloginfo('name')); ?>
                        </a>
                    </h1>
                <?php endif; ?>
                <?php if(get_option("ocmx_display_site_tagline") != "no") : ?>
                    <p class="tagline">
                        <?php echo strip_tags(bloginfo('description')); ?>
                    </p>
                <?php endif; ?>
            </div>
    
            <?php 
            if (function_exists("wp_nav_menu")) :	
                wp_nav_menu(array(
                        'menu' => 'Kiosk Nav',
                        'menu_id' => 'nav',
                        'menu_class' => 'clearfix',
                        'sort_column' 	=> 'menu_order',
                        'theme_location' => 'primary',
                        'container' => 'ul',
                        'fallback_cb' => 'ocmx_fallback')
            );
            endif; ?>
            
            <ul class="social-icons">
                <?php if(get_option("ocmx_social_facebook")) : ?><li><a target="_blank" class="facebook" href="<?php echo get_option("ocmx_social_facebook"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_googleplus")) : ?><li><a target="_blank" class="googleplus" href="<?php echo get_option("ocmx_social_googleplus"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_twitter")) : ?><li><a target="_blank" class="twitter" href="<?php echo get_option("ocmx_social_twitter"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_youtube")) : ?><li><a target="_blank" class="youtube" href="<?php echo get_option("ocmx_social_youtube"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_vimeo")) : ?><li><a target="_blank" class="vimeo" href="<?php echo get_option("ocmx_social_vimeo"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_skype")) : ?><li><a target="_blank" class="skype" href="<?php echo get_option("ocmx_social_skype"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_tumblr")) : ?><li><a target="_blank" class="tumblr" href="<?php echo get_option("ocmx_social_tumblr"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_linkedin")) : ?><li><a target="_blank" class="linkedin" href="<?php echo get_option("ocmx_social_linkedin"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_500px")) : ?><li><a target="_blank" class="fivehundredpx" href="<?php echo get_option("ocmx_social_500px"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_aim")) : ?><li><a target="_blank" class="aim" href="<?php echo get_option("ocmx_social_aim"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_android")) : ?><li><a target="_blank" class="android" href="<?php echo get_option("ocmx_social_android"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_badoo")) : ?><li><a target="_blank" class="badoo" href="<?php echo get_option("ocmx_social_badoo"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_dailybooth")) : ?><li><a target="_blank" class="dailybooth" href="<?php echo get_option("ocmx_social_dailybooth"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_dribbble")) : ?><li><a target="_blank" class="dribbble" href="<?php echo get_option("ocmx_social_dribbble"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_email")) : ?><li><a target="_blank" class="emailz" <a href="mailto:<?php echo get_option("ocmx_social_email"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_foursquare")) : ?><li><a target="_blank" class="foursquare" href="<?php echo get_option("ocmx_social_foursquare"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_github")) : ?><li><a target="_blank" class="github" href="<?php echo get_option("ocmx_social_github"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_hipstamatic")) : ?><li><a target="_blank" class="hipstamatic" href="<?php echo get_option("ocmx_social_hipstamatic"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_icq")) : ?><li><a target="_blank" class="icq" href="<?php echo get_option("ocmx_social_icq"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_instagram")) : ?><li><a target="_blank" class="instagram" href="<?php echo get_option("ocmx_social_instagram"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_lastfm")) : ?><li><a target="_blank" class="lastfm" href="<?php echo get_option("ocmx_social_lastfm"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_path")) : ?><li><a target="_blank" class="path" href="<?php echo get_option("ocmx_social_path"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_pinterest")) : ?><li><a target="_blank" class="pinterest" href="<?php echo get_option("ocmx_social_pinterest"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_quora")) : ?><li><a target="_blank" class="quora" href="<?php echo get_option("ocmx_social_quora"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_rdio")) : ?><li><a target="_blank" class="rdio" href="<?php echo get_option("ocmx_social_rdio"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_reddit")) : ?><li><a target="_blank" class="reddit" href="<?php echo get_option("ocmx_social_reddit"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_rss")) : ?><li><a target="_blank" class="rss" href="<?php echo get_option("ocmx_social_rss"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_spotify")) : ?><li><a target="_blank" class="spotify" href="<?php echo get_option("ocmx_social_spotify"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_thefancy")) : ?><li><a target="_blank" class="thefancy" href="<?php echo get_option("ocmx_social_thefancy"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_xbox")) : ?><li><a target="_blank" class="xbox" href="<?php echo get_option("ocmx_social_xbox"); ?>"></a></li><?php endif; ?>
                <?php if(get_option("ocmx_social_zerply")) : ?><li><a target="_blank" class="zerply" href="<?php echo get_option("ocmx_social_zerply"); ?>"></a></li><?php endif; ?>
            </ul>
            
            <div class="footer-text">
                <p class="copyright"><?php echo stripslashes(get_option("ocmx_custom_footer")); ?></p>
                <?php if( get_option("ocmx_logo_hide") != "true") : ?>
                    <div class="obox-credit">
                        <p><a href="http://www.obox-design.com/wordpress-themes/blogging.cfm">Blogging WordPress Themes</a> by <a href="http://www.obox-design.com">Obox</a></p>
                    </div>
                <?php endif; ?>
            </div>
            
        </div><!--End header -->
    
        
    </div><!--End header-container -->

<!--Begin Content -->
<div id="content-container" class="clearfix">
    <a href="#" id="menu-drop-button"></a>
	<a class="show-footer" href="#">+</a>