<?php
global $obox_meta, $theme_options;
global $themeid;

/* Setup Post Image Sizes */
add_image_size("post", 590, 350, true);

$theme_options = array();

$theme_options["general_site_options"] =
		array(
				array("label" => "Custom Logo", "description" => "Full URL or folder path to your custom logo.", "name" => "ocmx_custom_logo", "default" => "", "id" => "upload_button", "input_type" => "file", "args" => array("width" => 90, "height" => 75)),
				array(
					"main_section" => "Site Header",
					"main_description" => "Select whether to display or hide your website title and tagline. To modify your title and tagline go to the <a href=\"".admin_url('options-general.php')."\" target=\"_blank\">Settings -> General</a> area in WordPress.",
					"sub_elements" => 
					array(
							array("label" => "Display Title", "description" => "","name" => "ocmx_display_site_title", "default" => "yes", "id" => "ocmx_display_site_title", "input_type" => 'select', 'options' => array('Yes' => 'yes', 'No' => 'no')),
							array("label" => "Display Tagline", "description" => "","name" => "ocmx_display_site_tagline", "default" => "yes", "id" => "ocmx_display_site_tagline", "input_type" => 'select', 'options' => array('Yes' => 'yes', 'No' => 'no'))
		                 )
				     ),
				array("label" => "Favicon", "description" => "Select a favicon for your site", "name" => "ocmx_custom_favicon", "default" => "", "id" => "upload_button_favicon", "input_type" => "file", "sub_title" => "favicon", "args" => array("width" => 16, "height" => 16)),	
				array(
					"main_section" => "Custom Styling",
					"main_description" => "Set your own custom font and CSS for testimonials any any other element you wish to restyle.",
					"sub_elements" => 
						array(
				  
							array("label" => "Custom CSS", "description" => "Enter changed classes from the theme stylesheet, or custom CSS here.", "name" => "ocmx_custom_css", "default" => "", "id" => "ocmx_custom_css", "input_type" => "memo"),
							array("label" => "Custom Typekit Scripts", "description" => "", "name" => "ocmx_typekit", "default" => "", "id" => "ocmx_typekit", "input_type" => "memo"),
				             )
				    ),
				array(
				"main_section" => "Full Posts or Excerpts?",
				"main_description" => "Select whether to show full posts or excerpts in your archives/ blog list.",
				"sub_elements" => 
				array(
						array("label" => "Content Length", "description" => "Selecting excerpts will show the Read More link.","name" => "ocmx_content_length", "default" => "yes", "id" => "ocmx_content_length", "input_type" => 'select', 'options' => array('Show Excerpts' => 'yes', 'Show Full Post Content' => 'no'))
		                 )
				     ),
				array(
					"main_section" => "Post Meta",
					"main_description" => "These settings control which post meta is displayed in widgets, posts and pages.",
					"sub_elements" => 
						array(
							array("label" => "Date", "description" => "Uncheck to turn off date. Does not affect all widgets.","name" => "ocmx_meta_date", "", "default" => "true", "id" => "ocmx_meta_date", "input_type" => "checkbox"),
							array("label" => "Tags", "description" => "Check to show tags on single posts", "name" => "ocmx_meta_tags", "default" => "false", "id" => "ocmx_meta_tags", "input_type" => "checkbox"),
							array("label" => "Social Sharing", "description" => "Uncheck to disable the sharing icons.", "name" => "ocmx_meta_social", "default" => "true", "id" => "ocmx_meta_social", "input_type" => "checkbox"),
							array("label" => "Author Link", "description" => "Uncheck to hide the author link on posts.", "name" => "ocmx_meta_author", "default" => "true", "id" => "ocmx_meta_author", "input_type" => "checkbox"),
							array("label" => "Show Author Block on Posts", "description" => "Uncheck to hide the author. ","name" => "ocmx_meta_author_post", "", "default" => "true", "id" => "ocmx_meta_author_post", "input_type" => "checkbox"),
						)
					),
				array("label" => "Custom RSS URL", "description" => "Paste the URL to your custom RSS feed, such as Feedburner.", "name" => "ocmx_rss_url", "default" => "", "id" => "", "input_type" => "text"),	   
				array(
					"main_section" => "Press Trends Analytics",
					"main_description" => "Select Yes Opt out. No personal data is collected.",
					"sub_elements" => 
					array(
						array("label" => "Disable Press Trends?", "description" => "PressTrends helps Obox build better themes and provide awesome support by retrieving aggregated stats. PressTrends also provides a <a href='http://wordpress.org/extend/plugins/presstrends/' title='PressTrends Plugin for WordPress' target='_blank'>plugin for you</a> that delivers stats on how your site is performing against similar sites like yours. <a href='http://www.presstrends.me' title='PressTrends' target='_blank'>Learn more…</a>","name" => "ocmx_disable_press_trends", "default" => "no", "id" => "ocmx_disable_press_trends", "input_type" => 'select', 'options' => array('Yes' => 'yes', 'No' => 'no'))
		                 )
				     )
			);
					
	$theme_options["footer_options"] = array(
				array("label" => "Custom Footer Text", "description" => "", "name" => "ocmx_custom_footer", "default" => "Copyright ".date("Y")." Principles was created in WordPress by Obox Themes."	, "id" => "ocmx_custom_footer", "input_type" => "memo"),
				array("label" => "Hide Obox Logo", "description" => "Hide the Obox Logo from the footer.", "name" => "ocmx_logo_hide", "default" => "false", "id" => "ocmx_logo_hide", "input_type" => "checkbox"),
				array("label" => "Show Footer", "description" => "Show the widgetized footer by default.", "name" => "ocmx_show_footer", "default" => "false", "id" => "ocmx_show_footer", "input_type" => "checkbox"),
				array("label" => "Site Analytics", "description" => "Enter in the Google Analytics Script here.","name" => "ocmx_googleAnalytics", "default" => "", "id" => "","input_type" => "memo")
	);
	
	$theme_options["post_social_options"] = array(
		array("label" => "Social Widget Code", "description" => "Paste the template tag or code for your social sharing plugin here.", "name" => "ocmx_social_tag", "default" => "", "id" => "", "input_type" => "memo"),
			array(
			"main_section" => "Social Icons",
			"main_description" => "These settings will control the social icons in the Social Widget. Input the full URL.",
			"sub_elements" => 
				array(
					array("label" => "Facebook", "name" => "ocmx_social_facebook", "id" => "ocmx_social_facebook", "input_type" => "text"),
					array("label" => "Google+", "name" => "ocmx_social_googleplus", "id" => "ocmx_social_googleplus", "input_type" => "text"),
					array("label" => "Twitter", "name" => "ocmx_social_twitter", "id" => "ocmx_social_twitter", "input_type" => "text"),
					array("label" => "Youtube", "name" => "ocmx_social_youtube", "id" => "ocmx_social_youtube", "input_type" => "text"),
					array("label" => "Vimeo", "name" => "ocmx_social_vimeo", "id" => "ocmx_social_vimeo", "input_type" => "text"),
					array("label" => "Skype", "name" => "ocmx_social_skype", "id" => "ocmx_social_skype", "input_type" => "text"),
					array("label" => "Tumblr", "name" => "ocmx_social_tumblr", "id" => "ocmx_social_tumblr", "input_type" => "text"),
					array("label" => "LinkedIn", "name" => "ocmx_social_linkedin", "id" => "ocmx_social_linkedin", "input_type" => "text"),
					array("label" => "500px", "name" => "ocmx_social_500px", "id" => "ocmx_social_500px", "input_type" => "text"),
					array("label" => "Aim", "name" => "ocmx_social_aim", "id" => "ocmx_social_aim", "input_type" => "text"),
					array("label" => "Android", "name" => "ocmx_social_android", "id" => "ocmx_social_android", "input_type" => "text"),
					array("label" => "Badoo", "name" => "ocmx_social_badoo", "id" => "ocmx_social_badoo", "input_type" => "text"),
					array("label" => "Daily Booth", "name" => "ocmx_social_dailybooth", "id" => "ocmx_social_dailybooth", "input_type" => "text"),
					array("label" => "Dribbble", "name" => "ocmx_social_dribbble", "id" => "ocmx_social_dribbble", "input_type" => "text"),
					array("label" => "Email", "name" => "ocmx_social_email", "id" => "ocmx_social_email", "input_type" => "text"),
					array("label" => "Foursquare", "name" => "ocmx_social_foursquare", "id" => "ocmx_social_foursquare", "input_type" => "text"),
					array("label" => "Github", "name" => "ocmx_social_github", "id" => "ocmx_social_github", "input_type" => "text"),
					array("label" => "Hipstamatic", "name" => "ocmx_social_hipstamatic", "id" => "ocmx_social_hipstamatic", "input_type" => "text"),
					array("label" => "ICQ", "name" => "ocmx_social_icq", "id" => "ocmx_social_icq", "input_type" => "text"),
					array("label" => "Instagram", "name" => "ocmx_social_instagram", "id" => "ocmx_social_instagram", "input_type" => "text"),
					array("label" => "LastFM", "name" => "ocmx_social_lastfm", "id" => "ocmx_social_lastfm", "input_type" => "text"),
					array("label" => "Path", "name" => "ocmx_social_path", "id" => "ocmx_social_path", "input_type" => "text"),
					array("label" => "Pinterest", "name" => "ocmx_social_pinterest", "id" => "ocmx_social_pinterest", "input_type" => "text"),
					array("label" => "Quora", "name" => "ocmx_social_quora", "id" => "ocmx_social_quora", "input_type" => "text"),
					array("label" => "Rdio", "name" => "ocmx_social_rdio", "id" => "ocmx_social_rdio", "input_type" => "text"),
					array("label" => "Reddit", "name" => "ocmx_social_reddit", "id" => "ocmx_social_reddit", "input_type" => "text"),
					array("label" => "RSS", "name" => "ocmx_social_rss", "id" => "ocmx_social_rss", "input_type" => "text"),
					array("label" => "Spotify", "name" => "ocmx_social_spotify", "id" => "ocmx_social_spotify", "input_type" => "text"),
					array("label" => "The Fancy", "name" => "ocmx_social_thefancy", "id" => "ocmx_social_thefancy", "input_type" => "text"),
					array("label" => "Xbox", "name" => "ocmx_social_xbox", "id" => "ocmx_social_xbox", "input_type" => "text"),
					array("label" => "Zerply", "name" => "ocmx_social_zerply", "id" => "ocmx_social_zerply", "input_type" => "text")	
				)
			),
	);
	
/***************************************************************************/
/* Setup Defaults for this theme for optiosn which aren't set in this page */
if(is_admin() && !get_option($themeid."-defaults")) :
	update_option("ocmx_general_font_style_default", "'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");
	update_option("ocmx_navigation_font_style_default", "'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");
	update_option("ocmx_sub_navigation_font_style_default", "'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");
	update_option("ocmx_post_font_titles_style_default", "'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");
	update_option("ocmx_post_font_meta_style_default", "'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");
	update_option("ocmx_post_font_copy_font_style_default", "'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");
	update_option("ocmx_widget_font_titles_font_style_default", "'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");
	update_option("ocmx_widget_footer_titles_font_size_default", "'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");
	
	
	update_option("ocmx_general_font_color_default", "#333");
	update_option("ocmx_navigation_font_color_default", "#777");
	update_option("ocmx_sub_navigation_font_color_default", "#333");
	update_option("ocmx_post_titles_font_color_default", "#333");
	update_option("ocmx_post_meta_font_color_default", "#999");
	update_option("ocmx_post_copy_font_color_default", "#333");
	update_option("ocmx_widget_titles_font_color_default", "#999");
	update_option("ocmx_widget_footer_titles_font_color_default", "#999");
	
	update_option("ocmx_general_font_size_default", "17");
	update_option("ocmx_navigation_font_size_default", "12");
	update_option("ocmx_sub_navigation_font_size_default", "12");
	update_option("ocmx_post_titles_font_size_default", "10");
	update_option("ocmx_post_meta_font_size_default", "13");
	update_option("ocmx_post_copy_font_size_default", "17");
	update_option("ocmx_widget_titles_font_size_default", "15");
	update_option("ocmx_widget_footer_titles_font_size_default", "15");
	update_option($themeid."-defaults", 1);
endif;
update_option("allow_gallery_effect", "1");

add_action("switch_theme", "remove_ocmx_gallery_effects"); 
function remove_ocmx_gallery_effects(){delete_option("allow_gallery_effect");};
?>