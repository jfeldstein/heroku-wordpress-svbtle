</div><!--End Content Container -->

<div id="footer-widget-container" <?php if( get_option( "ocmx_show_footer" ) != "false" ) : ?>style="display: block"<?php endif; ?>>
    <ul class="footer-widgets">
        <?php if (function_exists('dynamic_sidebar')) :
            dynamic_sidebar('widgetarea');
        endif; ?>
    </ul>
</div><!--end Footer Container -->

<div id="footer-container">
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
</div>

<?php wp_footer(); ?>
<!--Get Google Analytics -->
<?php 
	if(get_option("ocmx_googleAnalytics")) :
		echo stripslashes(get_option("ocmx_googleAnalytics"));
	endif;
?>

</body>
</html>