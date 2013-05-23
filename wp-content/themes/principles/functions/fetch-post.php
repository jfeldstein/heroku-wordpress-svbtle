<?php 
$link = get_permalink( $post->ID );
$args  = array( 'postid' => $post->ID, 'width' => 800, 'height' => 533, 'hide_href' => false, 'imglink' => false, 'imgnocontainer' => true, 'resizer' => '800auto' );
$image = get_obox_media( $args );
$author = get_option("ocmx_meta_author_post");
?>
<li id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>		
	<div class="post-title-block">
		<?php if( get_option("ocmx_meta_date") != "false" || get_option( "ocmx_meta_author" ) != "false" ) : ?>
            <h5 class="dater">
                <?php if( get_option("ocmx_meta_date") != "false" ) {echo the_time(get_option('date_format'));} // Hide the date unless enabled in Theme Options ?>
                <?php if( get_option( "ocmx_meta_author" ) != "false" ) {_e("written by", "ocmx"); ?> <?php the_author_posts_link();} //Hide the author unless enabled in Theme Options ?>
                <?php _e("in",'ocmx'); ?> <?php the_category(", ",'ocmx'); ?> 
            </h5>
            <?php endif; ?>

    <!--Show the title -->
    <h2 class="post-title typography-title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h2>
	</div>
	<?php if( $image != "" ) : // Show the Featured Image if this is a post ?> 
    	<div class="post-image fitvid"> 
  			<?php echo $image; ?>
        </div>
    <?php endif; ?>
	<!--Get the Content -->
    <div class="copy clearfix">
        <?php the_content(); ?>
    </div>
    
	<?php if( !is_page() ) : //Show meta if this is a post ?>
	    <ul class="post-meta"> 
    		<?php if( get_option("ocmx_meta_tags") != "false" ) : // Show tags if enabled in Theme Options ?>
			    <li class="meta-block">
				    <ul class="tags">
					    <?php the_tags('<li>','</li><li>','</li>'); ?>
				    </ul>
			    </li>
		    <?php endif; ?>
            <?php if( get_option("ocmx_social_tag") !="" ) : ?>
            	<span class="social"><?php echo get_option("ocmx_social_tag"); ?></span> 
		    <?php elseif( get_option("ocmx_meta_social") != "false" ) : // Show sharing if enabled in Theme Options ?>
			    <li class="meta-block social">
                    <!-- AddThis Button BEGIN : Customize at http://www.addthis.com -->
                    <div class="addthis_toolbox addthis_default_style ">
                        <a class="addthis_button_facebook_like"></a>
                        <a class="addthis_button_tweet"></a>
                        <a class="addthis_counter addthis_pill_style"></a>
                    </div>
                    <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-507462e4620a0fff"></script>
                    <!-- AddThis Button END -->
			    </li>
		    <?php endif; ?>         
	    </ul>
	    
      
    <?php echo do_shortcode( '[manual_related_posts]' ); ?>
      
		<!-- Begin Author Block -->
	    <?php if($author != "false" ): ?>         
		    <?php global $show_author; ?>
	        <div class="post-author clearfix">
	            <?php echo get_avatar( get_the_author_meta('email'), "80" ); ?>
	            <div class="author_text">
	                <h4>About the Author, <?php the_author_posts_link(); ?></h4>
	                <p><?php the_author_meta('description'); ?></p>
	            </div>
	        </div>
	    <?php endif; ?>   
	    <?php endif; ?>
</li>                        
