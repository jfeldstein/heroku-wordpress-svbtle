<?php 
$link = get_permalink( $post->ID ); 
$args  = array( 'postid' => $post->ID, 'width' => 800, 'height' => 533, 'hide_href' => false, 'exclude_video' => true, 'imgnocontainer' => true, 'resizer' => '800x533' );
$image = get_obox_media( $args );
$format = get_post_format();
$quote_link = get_post_meta($post->ID, "quote_link", true);
?>
<li id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>		
    <div class="content clearfix">
    	<!--Begin Top Meta -->
    	
    	<?php if( $format != 'quote' ) : ?>
    	
    		 <div class="post-title-block">
				<?php if( get_option("ocmx_meta_date") != "false" || get_option( "ocmx_meta_author" ) != "false" ) : ?>
	                <h5 class="dater">
						<?php if( get_option("ocmx_meta_date") != "false" ) {echo the_time(get_option('date_format'));} // Hide the date unless enabled in Theme Options ?>
	                    <?php if( get_option( "ocmx_meta_author" ) != "false" ) {_e("written by", "ocmx"); ?> <?php the_author_posts_link();} //Hide the author unless enabled in Theme Options ?>
	                </h5>
	                <?php endif; ?>
	            <!--Show the Title -->
	            <h2 class="post-title typography-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2>
	        </div>
	        <!--Show the Featured Image or Video -->
			<?php if($image != "") : ?> 
		    	<div class="post-image fitvid"> 
		  			<?php echo $image; ?>
		        </div>
		    <?php endif; ?>
	        <!--Begin Excerpt -->
	        <div class="copy <?php echo $image_class; ?>">
	        	<?php if( get_option( "ocmx_content_length" ) != "no" ) : 
					the_excerpt(); 
				else : 
					the_content();
				endif; ?>
	        </div>
	
	        <a href="<?php echo $link; ?>" class="action-link">
	            <?php if( get_option( "ocmx_content_length" ) != "no" ) :
	                _e("Read on",'ocmx'); 
	            endif; ?>
	            <?php if(get_option("ocmx_meta_comments") != "false"): ?>
	                <span class="comment-count"><?php comments_number(__('0 ','ocmx'),__('1 ','ocmx'),__('% ','ocmx')); ?></span>
	            <?php endif; ?>
	        </a>
    	
    	<?php else : ?>
    	
    		<div class="copy">
    			<?php the_content(); ?>
    		</div>
            <cite>&mdash; <?php if($quote_link !='') : ?><a href="<?php echo $quote_link; ?>" target="_blank"><?php the_title(); ?></a> <?php else : the_title(); endif; ?></cite>
	        
		<?php endif; ?>

	</div>
</li>