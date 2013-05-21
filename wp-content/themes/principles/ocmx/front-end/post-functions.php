<?php
/* Template Functions */
function ocmx_page_header($before = "<h2>", $after = "</h2>"){
    global $is_archive, $gallery_title, $wp, $post;
	if($gallery_title) : ?>
    	<?php _e($before.$gallery_title.$after); ?>
    <?php elseif($is_archive) :?>
    	<?php _e($before."Archives".$after); ?>
	<?php elseif(is_404()) : ?>
	    <?php _e($before."Page Not Found".$after); ?>
    <?php elseif(is_category()) : ?>
		<?php $cat_id = get_query_var("cat"); ?>
        <?php $category = get_category($cat_id); ?>
        	<?php echo $before; ?><a href="<?php echo get_category_link($category->cat_ID); ?>"><?php single_cat_title(); ?></a><?php echo $after; ?>
    <?php elseif (is_search()) : ?>
    	<?php _e($before."Your Search Results for:"); ?> "<em><?php the_search_query(); ?></em>"<?php echo $after; ?>
	<?php elseif(is_tag()): 
    	single_tag_title();
	elseif(is_page()) : 
		if (have_posts()) : while (have_posts()) : the_post(); ?>
        	<?php echo $before; ?>
            	<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
                </a>
			<?php echo $after;  
		endwhile; endif;
	elseif(get_post_type($post) == "portfolio") :
		echo $before._("Portfolio").$after;
	elseif(get_post_type($post) == "quotes") :
	elseif(get_post_type($post) == "feature") :
		echo $before._("Features").$after;
	elseif(get_post_type($post) == "quotes") :
	elseif(get_post_type($post) == "info-box") :
		echo $before._("Info Boxes").$after;
	elseif(get_post_type($post) == "quotes") :
		echo $before.get_option("ocmx_home_quotes_title").$after;
	elseif(is_single()) :
		$category = get_the_category();
		if (have_posts()) : while (have_posts()) : the_post(); ?>
        	<?php echo $before; ?>
            	<a href="<?php echo get_category_link($category[0]->cat_ID); ?>"><?php echo $category[0]->cat_name; ?></a>
			<?php echo $after; ?>
    <?php endwhile; endif;
	elseif(get_post_type($post) == "feature") :
		_e($before."Features".$after);
	elseif(get_post_type($post) == "portfolio") :
		_e($before."Portfolio".$after);
	elseif(is_archive()) : ?>
		<?php echo $before.get_query_var("y"). " - ".get_query_var("m").$after; ?>
	<?php endif; ?>
<?php }
function fetch_post_image($use_id, $width, $height)
	{
		$attach_args = array("post_type" => "attachment", "post_parent" => $use_id);
		$attachments = get_posts($attach_args);
		$attach_id = $attachments[0]->ID;
		return  wp_get_attachment_image($attach_id, array($width, $height));
	}
		
function fetch_post_tags($post_id)
	{
		global $wpdb;
		$tags = $wpdb->get_results("SELECT $wpdb->term_relationships.*, $wpdb->terms.* FROM $wpdb->terms INNER JOIN $wpdb->term_relationships ON $wpdb->term_relationships.term_taxonomy_id = $wpdb->terms.term_id WHERE $wpdb->term_relationships.object_id = ".$post_id);
		foreach($tags as $posttag) :
			if(!isset($tag_list)) :
				$tag_list = $posttag->name;
			else :
				$tag_list .= ", ".$posttag->name;
			endif;
		endforeach;
		return isset($tag_list);
	}

function ocmx_pagination($container_class = "clearfix", $ul_class = "clearfix")
	{
		global $wp_query;
		$request = $wp_query->request;
		$showpages = 12;
		$numposts = $wp_query->found_posts;
		$pagenum = (ceil($numposts/get_option("posts_per_page")));
		$currentpage = get_query_var('paged');
		
		if($pagenum < $showpages) :
			$maxpages = $pagenum;
		elseif($currentpage > $showpages) :
			$startrow = ($currentpage-1);
			$maxpages = ($startrow + $showpages - 1);
			if($maxpages > $pagenum) :
				$startrow = ($startrow - ($maxpages - $pagenum));
				$maxpages = ($maxpages - ($maxpages - $pagenum));
			endif;
		else :
			$startrow = 1;
			$maxpages  = $showpages;
		endif;
			
		if((get_option("posts_per_page") && $numposts !== 0) && $numposts > get_option("posts_per_page")) :
?>
     <div class="<?php echo $container_class; ?>">
        <ul class="<?php echo $ul_class; ?>">
        	<?php if($currentpage !== 0) : ?>
	            <li class="previous-page"><?php previous_posts_link("Previous"); ?></li>
            <?php endif;
			
			for($i = $startrow; $i <= $maxpages; $i++) : ?>
				<li><a href="<?php echo esc_url(get_pagenum_link($i)); ?>" class="<?php if($i == $currentpage || ($i == 1 && $currentpage == "")) :?>selected-page<?php else : ?>other-page<?php endif; ?>"><?php echo $i; ?></a></li>  
			<?php endfor;
			
			if($maxpages < $pagenum) : ?>
				<li><a href="<?php echo esc_url(get_pagenum_link($pagenum)); ?>" class="other-page"><?php echo $pagenum; ?></a></li>
			<?php endif; 
			
			if($currentpage !== ceil($numposts/get_option("posts_per_page"))) : ?>
				<li class="next-page"><?php next_posts_link("Next"); ?></li>
			<?php endif; ?>
        </ul>
    </div>
<?php
		endif;
	}
if(!function_exists("fetch_related_posts")) :
	function fetch_related_posts(){
		//Gets category and author info
		global $wp_query,$post;
		$cats = get_the_category();
		$postAuthor = $post->post_author;
		$currentId = $post->ID;
		// related category posts
		$catlist = "";
		foreach ( $cats as $c ) :
			if( $catlist != "" ) :
				$catlist .= ",";
			endif;
			$catlist .= $c->cat_ID;
		endforeach;
		$newQuery = "posts_per_page=5&cat=" . $catlist."&exclude=".$currentId;
		$catQuery = get_posts( $newQuery );
		$categoryPosts = "";
		$count = 0;
		$original_post = $post;
		foreach($catQuery as $related_post) :
			//Set the post ID for the image
			$post = $related_post;
			$image = get_obox_image(60, 40, '', '', ''); 
			
			echo "<li>".
				$image.
				"<a href=\"".get_permalink($related_post->ID)."\">".
					$related_post->post_title.
				"</a>
			</li>";
		endforeach;
		$post = $original_post;
	}
endif;
if(!function_exists("get_template_link")) :
	/*****************************************************************************/
	/* This Function Fetches the Post associated to the speciofied Page Template */
	function get_template_link($page){
		global $wpdb;

		$get_meta = $wpdb->get_row("SELECT * FROM ".$wpdb->postmeta." WHERE `meta_key` = '_wp_page_template' AND  `meta_value` = '".$page."'");
		$post = get_post($get_meta->post_id);
		
		return $post;
	}
endif;
?>