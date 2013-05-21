<?php 
// Custom fields for WP write panel

$obox_meta = array(
		"quote_link" => array (
			"name"			=> __("quote_link",'ocmx'),
			"default" 		=> __("",'ocmx'),
			"label" 		=> __("Quote Link",'ocmx'),
			"desc"      	=> __("Provide a link to your Quote <br />(Only used for the 'Quote' post format)",'ocmx'),
			"input_type"  	=> __("text",'ocmx')
		),
		"media" => array (
			"name"			=> __("other_media",'ocmx'),
			"default" 		=> __("", 'ocmx'),
			"label" 		=> __("Image",'ocmx'),
			"desc"      	=> __("Select a feature image to use for your post.",'ocmx'),
			"input_type"  	=> __("image",'ocmx'),
			"input_size"	=> __("50",'ocmx'),
			"img_width"		=> __("535",'ocmx'),
			"img_height"	=> __("255",'ocmx')
		),	
		"video" => array (
			"name"			=> __("video_link",'ocmx'),
			"default" 		=> __("",'ocmx'),
			"label" 		=> __("Video Link",'ocmx'),
			"desc"      	=> __("Provide your video link instead of the embed code and we'll use <a href='http://codex.wordpress.org/Embeds' target='_blank'>oEmbed</a> to translate that into a video.",'ocmx'),
			"input_type"  	=> __("text",'ocmx')
		),	
		"embed" => array (
			"name"			=> __("main_video",'ocmx'),
			"default" 		=> __("",'ocmx'),
			"label" 		=> __("Embed Code",'ocmx'),
			"desc"      	=> __("Input the embed code of your video here.",'ocmx'),
			"input_type"  	=> __("textarea",'ocmx')
		),
		"hostedvideo" => array (
			"name"			=> "video_hosted",
			"default" 		=> "",
			"label" 		=> "Self Hosted Video Formats: .MP4 or .MPV",
			"desc"      	=> "Please paste in your self hosted video link. To upload videos <a href='".get_bloginfo("url")."/wp-admin/media-new.php'>click here</a>",
			"input_type"  	=> "text"
		),
		"hostedvideo_ogv" => array (
			"name"			=> "video_hosted_ogv",
			"default" 		=> "",
			"label" 		=> "Self Hosted Video Formats: .OGV (for non HTML5 browsers)",
			"desc"      	=> "Please paste in your self hosted video link. To upload videos <a href='".get_bloginfo("url")."/wp-admin/media-new.php'>click here</a>",
			"input_type"  	=> "text"
		)
	);


$layout = array (
				"name"			=> __("layout",'ocmx'),
				"default" 		=> __("",'ocmx'),
				"label" 		=> __("Layout",'ocmx'),
				"desc"      	=> __("Select the layout of your Portfolio list when using the \"Portfolio List\" page template",'ocmx'),
				"input_type"  	=> __("select",'ocmx'),
				"options" => array(__("Single Column",'ocmx') => "one-column", __("Two Column",'ocmx') => "two-column", __("Three Column",'ocmx') => "three-column")
			);
function create_meta_box_ui() {
	global $post, $obox_meta, $layout;
	if(get_post_type($post) == __("page",'ocmx')) :
		array_unshift($obox_meta, $layout);
	endif;
	post_meta_panel($post->ID, $obox_meta);
}
function insert_obox_metabox($pID) {
	global $post, $obox_meta, $meta_added, $layout;
	if(get_post_type($post) == __("page",'ocmx')) :
		array_unshift($obox_meta, $layout);
	endif;
	if(!isset($meta_added))
		post_meta_update($pID, $obox_meta);
	$meta_added = 1;
}
if(function_exists("ocmx_change_metatype")) {}

function add_obox_meta_box() {
	if (function_exists('add_meta_box') ) {
		add_meta_box('obox-meta-box',$GLOBALS['themename'].' Options','create_meta_box_ui','post','normal','high');
		add_meta_box('obox-meta-box',$GLOBALS['themename'].' Options','create_meta_box_ui','page','normal','high');
		add_meta_box('obox-meta-box',$GLOBALS['themename'].' Options','create_meta_box_ui','portfolio','normal','high');
	}
}

function my_page_excerpt_meta_box() {
	add_meta_box( 'postexcerpt', __('Excerpt','ocmx'), 'post_excerpt_meta_box', 'page', 'normal', 'core' );
}

add_action('admin_menu', 'add_obox_meta_box');
add_action('admin_menu', 'my_page_excerpt_meta_box');
add_action('admin_head', 'ocmx_change_metatype');
add_action('save_post', 'insert_obox_metabox');
add_action('publish_post', 'insert_obox_metabox');  ?>