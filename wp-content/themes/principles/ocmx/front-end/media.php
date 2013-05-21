<?php function get_obox_image($width = 590, $height = '', $href_class = 'thumbnail', $wrap = '', $wrap_class = '', $hide_href = false, $exclude_video = false, $zc = 1, $imglink = false, $imgnocontainer = false, $resizer = ''){
	global $post, $blog_id;
	$args = array(
		'postid' => $post->ID,
		'width' => $width,
		'height' => $height,
		'href_class' => $href_class,
		'wrap' => $wrap,
		'wrap_class' => $wrap_class,
		'hide_href' => $hide_href,
		'exclude_video' => $exclude_video,
		'zc' => $zc,
		'imglink' => $imglink,
		'imgnocontainer' => $imgnocontainer,
		'resizer' => $resizer
	);
	return get_obox_media($args);
};
function get_obox_media($args){
	global $blog_id;
	$defaults = array (
 		'postid' => 0,
 		'width' => 590,
 		'height' => '',
 		'href_class' => '',
 		'wrap' => '',
 		'wrap_class' => '',
 		'hide_href' => false,
 		'exclude_video' => false,
 		'zc' => 1,
 		'imglink' => false,
 		'imgnocontainer' => false,
 		'resizer' => 'medium',
 		'imagefallback' => false
	);
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );
	
	//Set final HTML to nothing
	$html = "";
	
	// VIDEO QUERY
	$embed_code = get_post_meta($postid, "main_video", true); // Regular Embed Code
	$oembed_link = get_post_meta($postid, "video_link", true);
	$self_hosted_video = get_post_meta($postid, "video_hosted", true);

	if($height == '') : // Height fallback
		$videoheight = round($width*0.75, 0);
	else :
		$videoheight = $height;
	endif;

	if ($self_hosted_video != "") : // Self hosted video uses a special function
	
		$video = obox_player($postid, $width, $videoheight);
		
	elseif ($oembed_link != "") : // oEmbed Video
	
        $embed_code = '[embed width="'.$width.'" height="'.$videoheight.'"]'.$oembed_link.'[/embed]';
		$wp_embed = new WP_Embed();
		$video = $wp_embed->run_shortcode($embed_code);
		
	elseif ($embed_code !== "") : // Regular video embed
	
		$video = preg_replace("/(width\s*=\s*[\"\'])[0-9]+([\"\'])/i", "$1 $width \" wmode=\"transparent\"", $embed_code);
		$video = preg_replace("/(height\s*=\s*[\"\'])[0-9]+([\"\'])/i", "$1 $videoheight $2", $video);
		
	endif;	
	
	// AUDIO QUERY
	$soundcloud = get_post_meta($postid, "soundcloud", true);
	
	if ($soundcloud != "" && $exclude_video == false) :
		$audio =  $soundcloud;
		$hide_href = true;
	endif;
	
	// THUMBNAIL QUERY
	//Set up which meta value we're using for the post
	if(!get_option("ocmx_thumbnail_usage")) :
		$meta = "wordpress";
	elseif(get_option("ocmx_thumbnail_usage") == "none") :
		return false;
	elseif(get_option("ocmx_thumbnail_usage") != "0") :
		$meta = get_option("ocmx_thumbnail_usage");
	elseif(!get_option("ocmx_thumbnail_custom") !== "") :
		$meta = get_option("ocmx_thumbnail_custom");
	else :
		$meta = "other_media";
	endif;	//Check for a thumbnail using the meta
	
	$meta_thumbnail_url = get_post_meta($postid, $meta, true);
	
	//Let's check for the a video thumbnail via oEmbed	
	if($oembed_link != "" && ( strpos($oembed_link,'vimeo') || strpos($oembed_link,'youtube') ) ) :
		$oembed_info = video_info($oembed_link);
	endif;
	
	if (function_exists("has_post_thumbnail") && has_post_thumbnail($postid)) : // WordPress Thumbnail overrides everything
	
		$image = get_the_post_thumbnail($postid, $resizer);
		
	elseif ($meta_thumbnail_url != "") : // This is a custom meta 
	
		 // Special effect, should be deprecated IMO
		$get_effect = get_post_meta($postid, "other_media_effect", true);
		$effect = "";
		if($get_effect != "")
			$effect = "&amp;f=".$get_effect;
			
		if(is_multisite()) : // Make sure timthumb plays nice with Multi Site
			$meta_thumbnail_url = str_replace(get_site_url($blog_id), "", $meta_thumbnail_url);
			$meta_thumbnail_url = str_replace("/files/", "/wp-content/blogs.dir/$blog_id/files/", $meta_thumbnail_url); 
		endif;			
		
		$image = "<img src=\"".get_bloginfo('template_directory')."/functions/timthumb.php?src=$meta_thumbnail_url&amp;w=$width&amp;h=$height&amp;zc=$zc".$effect."\" alt=\"$post->post_title\" />";
		
	elseif ($oembed_link != "" && $exclude_video == true && isset($oembed_info['thumb_large']) && $oembed_info['thumb_large'] != "") : // Use oEmbed image if we've got one

		$image = "<img src=\"".$oembed_info['thumb_large']."\" alt=\"".$oembed_info['title']."\" />";
		
	elseif ($imagefallback == true) :	// Fallback to use the first image in the post, only if specified
	
		$attachmentargs = array("post_type" => "attachment", "post_parent" => $postid, "numberposts" => "1", "orderby" => "menu_order", "order" => "ASC");
		$attachments = get_posts($attachmentargs);
		
		$image = wp_get_attachment_image($attachments[0]->ID, $resizer);
		
	endif;
	
	// POST LINK
	if($imglink != true) : // Post Permalink
		$link = get_permalink($postid);
	elseif($meta == "wordpress" && function_exists("has_post_thumbnail") && has_post_thumbnail()) : // Featured image url
		$link = wp_get_attachment_url( get_post_thumbnail_id($postid), "full" );
	else : // Link straight to the post meta url
		$link = $meta_thumbnail_url;
	endif;
		
	// ADD THE HREF AND START PUTTING THE HTML TOGETHER
	if($href_class != "")
		$href_class = "class=\"$href_class\"";
	if(isset($audio)) :
		$html = $audio;
	elseif(isset($video) && ( $exclude_video == false || !isset($image) ) ) : // If we have a video, and we're not prioritizing images
		$html = $video;
	elseif($hide_href == false && isset($image)) : // If we got an image and we want to link it
		$html = "<a href=\"$link\" $href_class>$image</a>";
	else : // If we just have an image 
		$html = isset($image);
	endif;
	
	// Class for the surrounding divs
	if($wrap_class != "") :
    	$class = " class=\"$wrap_class\"";
	else :
		$class = "";
    endif;
    
    // Add the container to the whole dang thing
	if(($wrap !== "" && isset($video)) || (!isset($video) && $wrap != "" && $imgnocontainer !== true)) :
    	$html = "<$wrap".$class.">".$html."</$wrap>";
	else :
		$html;
	endif;
	
	return $html;
}

function obox_has_video($post_id = 0){
	$embed_code = get_post_meta($post_id, "main_video", true);
	$oembed_link = get_post_meta($post_id, "video_link", true);
	$self_hosted_video = get_post_meta($post_id, "video_hosted", true);
	if($embed_code != "" || $oembed_link != "" || $self_hosted_video != "") :
		return true;
	else :
		return false;
	endif;
} ?>