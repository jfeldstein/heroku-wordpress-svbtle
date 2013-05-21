<?php get_header(); ?>
        
	<div class="full-width">
		<ul>
		<?php if (have_posts()) :
		    global $post;
		    while (have_posts()) : the_post(); setup_postdata($post);
		        get_template_part("/functions/fetch-post");
		    endwhile;
		else :
		    ocmx_no_posts();
		endif; ?>
		</ul> 
	</div>
       
<?php get_footer(); ?>