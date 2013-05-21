<?php
	/* 
	Template Name: Archives 
	*/
	
	get_header(); 
	
	global $wpdb;	
	//DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month, count(ID) as posts  
	global $wpquery;
    if (is_paged()) :
        $fetch_archive = query_posts("posts_per_page=10&paged=".get_query_var('paged'));
    else :
        $fetch_archive = query_posts("posts_per_page=10&paged=");
    endif;

    $last_month = date( "m Y", strtotime( $wpquery->posts[0]->post_date ) );

?>
<ul class="clearfix">
    <li id="left-column">	
    	<div class="archives">
        	<h2 class="post-title"><?php the_title(); ?></h2>
            <ul class="archives_list">
                <?php
                    foreach( $fetch_archive as $archive_data ) :
                        global $post;
                        $post = $archive_data;
                        $category_id = get_the_category( $archive_data->ID );
                        $this_category = get_category( $category_id[0]->term_id );
                        $this_category_link = get_category_link( $category_id[0]->term_id );
                        $link = get_permalink( $archive_data->ID );
                        $args  = array('postid' => $post->ID, 'width' => 50, 'height' => 50, 'exclude_video' => true, 'resizer' => 'thumbnail');
                        $image = get_obox_media($args); ?>
                        <li class="clearfix">
                        	<?php if(! (strpos($image, 'iframe') || strpos($image, 'object') ) ) : ?>
	                            <div class="archive-post-image"><?php echo $image; ?></div>
                            <?php endif; ?>
                            <?php if(get_option("ocmx_meta_date") != "false"): ?>     	
	                            <h5 class="date">
	                                <?php echo date_i18n('F dS', strtotime($archive_data->post_date)); ?>
	                            </h5>
                            <?php endif; ?>
                            <h4 class="post-title"><a href="<?php echo get_permalink($archive_data->ID); ?>"><?php echo substr($archive_data->post_title, 0, 45); ?></a></h4>
                            <a href="<?php echo get_permalink($archive_data->ID); ?>/#comments" class="comment-count" title="Comment on <?php echo get_permalink($archive_data->post_title); ?>">
                                <?php echo $archive_data->comment_count; ?> <?php _e("comments", "ocmx"); ?>
                            </a>
                            <span class="label">
                                <a href="<?php echo $this_category_link; ?>" title="View all posts in <?php echo $this_category->name; ?>" rel="category tag"><?php echo $this_category->name; ?></a>
                            </span>
                        </li>
                    <?php
                        
                    endforeach; ?>
            
            </ul>
         <?php motionpic_pagination("clearfix", "pagination clearfix"); ?>	
	  </div>
	</li>
</ul>
<?php get_footer(); ?>