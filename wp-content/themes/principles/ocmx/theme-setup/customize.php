<?php //OCMX Custom logo and Favicon

function ocmx_logo_register($wp_customize){
    
    $wp_customize->add_section('ocmx_general', array(
        'title'    => __('General Theme Settings', 'ocmx'),
        'priority' => 30,
    ));
 
    $wp_customize->add_setting('ocmx_custom_logo', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'ocmx_custom_logo', array(
        'label'    => __('Custom Logo', 'ocmx'),
        'section'  => 'ocmx_general',
        'settings' => 'ocmx_custom_logo',
    )));
    
    $wp_customize->add_setting('ocmx_custom_favicon', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'ocmx_custom_favicon', array(
        'label'    => __('Custom Favicon', 'ocmx'),
        'section'  => 'ocmx_general',
        'settings' => 'ocmx_custom_favicon',
    )));
    
}

add_action('customize_register', 'ocmx_logo_register');

// OCMX Color Options 

function ocmx_customize_register($wp_customize) {

	$wp_customize->add_section(
		'color_scheme', array(
		'title' => __( 'Theme Color Scheme', 'ocmx' ),
		'priority' => 35,
		)
	);
	
	//Custom Colors
	
	$wp_customize->add_setting('ocmx_ignore_colours', array(
        'default'        => 'no',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control('color_scheme', array(
        'label'      => __('Use Theme Defaults', 'ocmx'),
        'section'    => 'color_scheme',
        'settings'   => 'ocmx_ignore_colours',
        'type'       => 'radio',
        'priority' => 0,
        'choices'    => array(
            'yes' => 'Yes',
            'no' => 'No'
        ),
    ));
	
	$wp_customize->add_setting( 'ocmx_posttitles_links', array(
		'default' => '#000',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_posttitles_links', array(
		'label' => __( 'Post Titles', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_posttitles_links',
		'priority' => 1,
	)));
	
	$wp_customize->add_setting( 'ocmx_posttitles_links_hover', array(
		'default' => '#0099CC',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_posttitles_links_hover', array(
		'label' => __( 'Post Titles Hover', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_posttitles_links_hover',
		'priority' => 5,
	)));
	
	$wp_customize->add_setting( 'ocmx_copy_links', array(
		'default' => '#000',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_copy_links', array(
		'label' => __( 'Copy Links', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_copy_links',
		'priority' => 10,
	)));
	
	$wp_customize->add_setting( 'ocmx_copy_links_hover', array(
		'default' => '#0099CC',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_copy_links_hover', array(
		'label' => __( 'Copy Links Hover', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_copy_links_hover',
		'priority' => 15,
	)));
	
	$wp_customize->add_setting( 'ocmx_navigation_links', array(
		'default' => '#fff',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_navigation_links', array(
		'label' => __( 'Navigation Links', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_navigation_links',
		'priority' => 20,
	)));
	
	$wp_customize->add_setting( 'ocmx_navigation_hover', array(
		'default' => '#fff',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_navigation_hover', array(
		'label' => __( 'Navigation Links Hover', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_navigation_hover',
		'priority' => 25,
	)));
	
	$wp_customize->add_setting( 'ocmx_sidebar_text', array(
		'default' => '#fff',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_sidebar_text', array(
		'label' => __( 'Sidebar Text', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_sidebar_text',
		'priority' => 30,
	)));
	
	$wp_customize->add_setting( 'ocmx_sidebar_text_links', array(
		'default' => '#fff',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_sidebar_text_links', array(
		'label' => __( 'Sidebar Text Links', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_sidebar_text_links',
		'priority' => 35,
	)));
	
	$wp_customize->add_setting( 'ocmx_sidebar_text_links_hover', array(
		'default' => '#fff',
		'type' => 'option',
		'capability' => 'edit_theme_options',
		'transport' => 'postMessage',
	));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ocmx_sidebar_text_links_hover', array(
		'label' => __( 'Sidebar Text Links Hover', 'ocmx' ),
		'section' => 'color_scheme',
		'settings' => 'ocmx_sidebar_text_links_hover',
		'priority' => 40,
	)));
	
	
	wp_reset_query();

//ADD JQUERY

if ( $wp_customize->is_preview() && ! is_admin() )
	add_action( 'wp_footer', 'ocmx_customize_preview', 21);
	
	function ocmx_customize_preview() {
	?>
	<script type="text/javascript">

	( function( $ ){

		wp.customize('ocmx_posttitles_links',function( value ) {
			value.bind(function(to) {
				jQuery('.post-title a').css({'color': to});
			});
		});
		
		wp.customize('ocmx_posttitles_links_hover',function( value ) {
			value.bind(function(to) {
				jQuery('.post-title a:hover').css({'color': to});
			});
		});
		
		wp.customize('ocmx_copy_links',function( value ) {
			value.bind(function(to) {
				jQuery('.copy a, .date a').css({'color': to});
			});
		});
		
		wp.customize('ocmx_copy_links_hover',function( value ) {
			value.bind(function(to) {
				jQuery('.copy a:hover, .date a:hover').css({'color': to});
			});
		});
		
		wp.customize('ocmx_navigation_links',function( value ) {
			value.bind(function(to) {
				jQuery('ul#nav li a').css({'color': to});
			});
		});
		
		wp.customize('ocmx_navigation_links',function( value ) {
			value.bind(function(to) {
				jQuery('ul#nav li a').css({'borderColor': to});
			});
		});

		wp.customize('ocmx_navigation_hover',function( value ) {
			value.bind(function(to) {
				jQuery('ul#nav li a:hover').css({'color': to});
			});
		});
		
		wp.customize('ocmx_navigation_hover',function( value ) {
			value.bind(function(to) {
				jQuery('ul#nav li a:hover').css({'borderColor': to});
			});
		});
		
		wp.customize('ocmx_sidebar_text',function( value ) {
			value.bind(function(to) {
				jQuery('.copyright, .footer-text, .logo .tagline').css({'color': to});
			});
		});
		
		wp.customize('ocmx_sidebar_text_links',function( value ) {
			value.bind(function(to) {
				jQuery('.copyright a, .footer-text a, .logo .tagline a').css({'color': to});
			});
		});
		
		wp.customize('ocmx_sidebar_text_links_hover',function( value ) {
			value.bind(function(to) {
				jQuery('.copyright a:hover, .footer-text a:hover, .logo .tagline a:hover').css({'color': to});
			});
		});
		
	} )( jQuery );
	</script>
<?php } 

//ADD POST MESSAGE

$wp_customize->get_setting('ocmx_wrapper_background')->transport='postMessage';
$wp_customize->get_setting('ocmx_navigation_links')->transport='postMessage';
$wp_customize->get_setting('ocmx_navigation_hover')->transport='postMessage';
$wp_customize->get_setting('ocmx_border_color')->transport='postMessage';
$wp_customize->get_setting('ocmx_body_text')->transport='postMessage';
$wp_customize->get_setting('ocmx_content_links')->transport='postMessage';
$wp_customize->get_setting('ocmx_content_links_hover')->transport='postMessage';
$wp_customize->get_setting('ocmx_buttons')->transport='postMessage';
$wp_customize->get_setting('ocmx_buttons_shadow')->transport='postMessage';
$wp_customize->get_setting('ocmx_buttons_hover')->transport='postMessage';
$wp_customize->get_setting('ocmx_buttons_text')->transport='postMessage';
$wp_customize->get_setting('ocmx_section_title')->transport='postMessage';
$wp_customize->get_setting('ocmx_post_titles')->transport='postMessage';
$wp_customize->get_setting('ocmx_content_background')->transport='postMessage';
$wp_customize->get_setting('ocmx_footer_links')->transport='postMessage';
$wp_customize->get_setting('ocmx_footer_links_hover')->transport='postMessage';
$wp_customize->get_setting('ocmx_footer_text')->transport='postMessage';
$wp_customize->get_setting('ocmx_copyright_text')->transport='postMessage';
}
add_action( 'customize_register', 'ocmx_customize_register' );

function ocmx_add_query_vars($query_vars) {
	$query_vars[] = 'stylesheet';
	return $query_vars;
}
add_filter( 'query_vars', 'ocmx_add_query_vars' );
function ocmx_takeover_css() {
	    $style = get_query_var('stylesheet');
	    if($style == "custom") {
		    include_once(get_template_directory() . '/style.php');
	        exit;
	    }
	}
add_action( 'template_redirect', 'ocmx_takeover_css');