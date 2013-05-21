<?php /*
Template Name: Full Width */
get_header(); ?>
        
	<div class="full-width">
		<ul> 
		<?php if (have_posts()) :
		    global $post;
		    while (have_posts()) : the_post(); setup_postdata($post);
		        include(get_template_directory()."/functions/fetch-post.php");
		    endwhile;
		else :
		    ocmx_no_posts();
		endif; ?> 
		<?php comments_template(); ?>
		</ul>
	</div>
       
<?php get_footer(); ?>