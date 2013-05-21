<?php
function ocmx_add_scripts()
	{
		global $themeid;
		
		//Add support for 2.9 and 3.0 functions and setup jQuery for theme
		wp_enqueue_script("jquery");
		if(!is_admin()):
			wp_enqueue_script( "superfish", get_template_directory_uri()."/scripts/superfish.js", array( "jquery" ) );
			wp_enqueue_script( "resize", get_template_directory_uri()."/scripts/jquery.resize.end.js", array( "jquery" ) );
			wp_enqueue_script( $themeid."-jquery", get_template_directory_uri()."/scripts/".$themeid."_jquery.js", array( "jquery" ) );
			wp_enqueue_script( "fitvid", get_template_directory_uri()."/scripts/jquery.fitvids.js", array( "jquery" ) );
	    if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 
			//Localization
			wp_localize_script( $themeid."-jquery", "ThemeAjax", array( "ajaxurl" => admin_url( "admin-ajax.php" ) ) );
		else :
			/* Back-end */
			wp_enqueue_script( 'jquery-ui-draggable' );
			wp_enqueue_script( 'jquery-ui-droppable' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-tabs' );
			
			wp_enqueue_script( "ajaxupload", get_template_directory_uri()."/scripts/ajaxupload.js", array( "jquery" ) );
			wp_enqueue_script( "ocmx-jquery", get_template_directory_uri()."/scripts/ocmx_jquery.js", array( "jquery" ) );
			wp_enqueue_script( "ocmx-multifile", get_template_directory_uri()."/scripts/multifile.js", array( "jquery" ) );
			wp_localize_script( "ocmx-jquery", "ThemeAjax", array( "ajaxurl" => admin_url( "admin-ajax.php" ) ) );
		endif;
		
		//AJAX Functions
		add_action( 'wp_ajax_nopriv_ocmx_comment-post', 'ocmx_comment_post'  );
		add_action( 'wp_ajax_ocmx_comment-post', 'ocmx_comment_post' );
			
		add_action( 'wp_ajax_ocmx_save-options', 'update_ocmx_options');
		add_action( 'wp_ajax_ocmx_reset-options', 'reset_ocmx_options');
		add_action( 'wp_ajax_ocmx_ads-refresh', 'ocmx_ads_refresh' );
		add_action( 'wp_ajax_ocmx_ads-remove', 'ocmx_ads_remove' );
		add_action( 'wp_ajax_ocmx_layout-refresh', 'ocmx_layout_refresh' );
		add_action( 'wp_ajax_ocmx_ajax-upload', 'ocmx_ajax_upload' );
		add_action( 'wp_ajax_ocmx_remove-image', 'ocmx_ajax_remove_image' );
		
		wp_enqueue_style( 'welcome-page', get_template_directory_uri() . '/ocmx/welcome-page.css');

	}
?>