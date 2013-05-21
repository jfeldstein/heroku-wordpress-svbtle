<?php get_header(); 
$imgarray = array();
if (have_posts()) :
    while (have_posts()) : the_post(); setup_postdata($post); ?>

<div class="full-width">

	<h2 class="post-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2>
    
	<div class="slider clearfix">
        <ul class="gallery-container">
        	<?php $attach_args = array("post_type" => "attachment", "post_parent" => $post->ID, "numberposts" => "-1", "orderby" => "menu_order", "order" => "ASC");
            $attachments = get_posts($attach_args);
            foreach($attachments as $attachement => $this_attachment) :  
                    $image = wp_get_attachment_image_src($this_attachment->ID, "800auto");
                    $full = wp_get_attachment_image_src($this_attachment->ID,  "full");	                    
                    if(!in_array($full[0], $imgarray)) : ?>
					<li>
						<a href="<?php echo $full[0]; ?>" rel="lightbox">
							<img src="<?php echo $image[0]; ?>" alt="<?php echo $this_attachment->post_title; ?>" />
						</a>
					</li>
			<?php endif; 
				$imgarray[] = $full[0];
			endforeach; ?>
		</ul>
		<?php if(count($attachments) > 1) : ?>
	        <div class="controls"> <a href="#" class="next"><?php _e("Next", "ocmx") ?></a> <a href="#" class="previous"><?php _e("Previous", "ocmx") ?></a>
	            <div class="slider-dots"> 
	            	<?php for($i=1; $i <= count($attachments); $i++) : ?>
	                    <a href="#" rel="<?php echo ($i-1); ?>"class="dot <?php if($i == 1) : ?>dot-selected<?php endif; ?>"><?php echo $i; ?></a>
	                <?php endfor; ?> 
	            </div>
	        </div> 
        <?php endif; ?>
    </div>

    <div class="copy clearfix">
        <?php the_content(); ?>
    </div>
    
    
    <ul class="next-prev-post-nav">
        <li>
            <?php if (get_adjacent_post(false, '', true)): // if there are older posts ?>
                &larr;  <?php previous_post_link("%link", "%title"); ?>
            <?php else : ?>
                &nbsp;
            <?php endif; ?>
        </li>
        <li>
            <?php if (get_adjacent_post(false, '', false)): // if there are newer posts ?>
                <?php next_post_link("%link", "%title"); ?> &rarr;
            <?php else : ?>
                &nbsp;
            <?php endif; ?>    
        </li>
    </ul>
    
</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>