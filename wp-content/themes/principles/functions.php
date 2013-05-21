<?php  global $themename, $input_prefix;

/*****************/
/* Theme Details */

$themename = "Principles";
$themeid = "principles";
$productid = "1620";
$presstrendsid = "bsb2lliacd49xuf1xlxc5hb3qy1682wq3iki";

/**********************/
/* Include OCMX files */
$include_folders = array("/ocmx/includes/", "/ocmx/theme-setup/", "/ocmx/widgets/", "/ocmx/front-end/", "/ajax/", "/ocmx/interface/");


include_once (get_template_directory()."/ocmx/folder-class.php");
include_once (get_template_directory()."/ocmx/load-includes.php");
include_once (get_template_directory()."/ocmx/custom.php");

/**********************/
/* "Hook" up the OCMX */

update_option("ocmx_font_support", true);
add_action('init', 'ocmx_add_scripts');
add_action('after_setup_theme', 'ocmx_setup');


/*********************/
/* Load Localization */
load_theme_textdomain('ocmx', get_template_directory() . '/lang');

/***********************/
/* Add OCMX Menu Items */

add_action('admin_menu', 'ocmx_add_admin');
function ocmx_add_admin() {
	global $wpdb;
	
	add_object_page("Theme Options", "Theme Options", 'edit_themes', basename(__FILE__), '', 'http://obox-design.com/images/ocmx-favicon.png');
	
	//Check if we need to upgrade the Gallery Table
	check_gallery_table();
	
	add_submenu_page(basename(__FILE__), "General Options", "General", "edit_theme_options", basename(__FILE__), 'ocmx_general_options');
	add_submenu_page(basename(__FILE__), "Typography", "Typography", "edit_theme_options", "ocmx-fonts", 'ocmx_font_options');
	add_submenu_page(basename(__FILE__), "Customize", "Customize", "edit_theme_options", "customize.php");
	add_submenu_page(basename(__FILE__), "Help", "Help", "edit_theme_options", "obox-help", 'ocmx_welcome_page');

	
};

/*****************/
/* Add Nav Menus */

if (function_exists('register_nav_menus')) :
	register_nav_menus( array(
		'primary' => __('Primary Navigation', $themename)
	) );
endif;

/************************************************/
/* Fallback Function for WordPress Custom Menus */

function ocmx_fallback() {
	echo '<ul id="nav" class="clearfix">';
	wp_list_pages('title_li=&');
	echo '</ul>';
}

/*******************************/
/* Integrate goo.gl Shortlinks */

function googl_shortlink($url, $post_id) {
	global $post;
	if (!$post_id && $post) $post_id = $post->ID;

	if ($post->post_status != 'publish')
		return "";

	$shortlink = get_post_meta($post_id, '_googl_shortlink', true);
	if ($shortlink)
		return $shortlink;

	$permalink = get_permalink($post_id);

	$http = new WP_Http();
	$headers = array('Content-Type' => 'application/json');
	$result = $http->request('https://www.googleapis.com/urlshortener/v1/url', array( 'method' => 'POST', 'body' => '{"longUrl": "' . $permalink . '"}', 'headers' => $headers));
	if(is_array($result))
		$result = json_decode($result['body']);
	$shortlink = isset($result->id);

	if ($shortlink) {
		add_post_meta($post_id, '_googl_shortlink', $shortlink, true);
		return $shortlink;
	}
	else {
		return $url;
	}
}

add_filter('get_shortlink', 'googl_shortlink', 9, 2);

/**************************/
/* WP 3.4 Support         */
global $wp_version;
if ( version_compare( $wp_version, '3.4', '>=' ) ) 
	add_theme_support( 'custom-background' ); 
	add_theme_support( 'post-thumbnails' ); 
	add_theme_support( 'automatic-feed-links' ); 
	add_theme_support( 'post-formats', array( 'quote' ) );

if ( ! isset( $content_width ) ) $content_width = 800;

/******************************************************************************/
/* Each theme has their own "No Posts" styling, so it's kept in functions.php */

function ocmx_no_posts(){ ?>
<li class="post">
	<h2 class="post-title"><a href="#"><?php _e("No Content Found", "ocmx"); ?></a></h2>
    <div class="copy <?php echo $image_class; ?>">
	    <?php _e("The content you are looking for does not exist", "ocmx"); ?>
    </div>
</li>
<?php 
}
/**************************/
/* Set the Excerpt Length */
function new_excerpt_length($length) {
	return 35;
}
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_length', 'new_excerpt_length');
add_filter('excerpt_more', 'new_excerpt_more');

function my_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
}

function my_admin_styles() {
	wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');

/**************************/
/* Set Up Thumbnails */
function ocmx_setup_image_sizes() {
	//image info: (name, width, height, force-crop)
	add_image_size('800x533', 800, 533, true);
	add_image_size('520x347', 520, 347, true);
	add_image_size('440x330', 440, 330, true);
	add_image_size('380x587', 380, 587, true);
  	add_image_size('247x165', 247, 165, true); 
  	add_image_size('240x160', 240, 160, true);
	add_image_size('150x98', 150, 98, true);
  	add_image_size('800auto', 800, 9999);
} 

add_action( 'after_setup_theme', 'ocmx_setup_image_sizes' );

/**************************/
/* Facebook Support      */
function get_fbimage() {
  global $post;
  $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', '' );
  if ( has_post_thumbnail($post->ID) ) {
    $fbimage = $src[0];
  } else {
    global $post, $posts;
    $fbimage = '';
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',
    $post->post_content, $matches);
    $fbimage = $matches [1] [0];
  }
  if(empty($fbimage)) {
    $fbimage = get_the_post_thumbnail($post->ID);
  }
  return $fbimage;
}