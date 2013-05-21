<?php function obox_widgets_style() {
global $pagenow;
    if ( $pagenow == 'widgets.php' ) {

echo <<<EOF
<style type="text/css">

/* ORANGE WIDGETS */
   
div.widget[id*=_ocmx_slider_widget-_] .widget-title, 
div.widget[id*=_ocmx_slider_widget-] .widget-title, 

div.widget[id*=_ocmx_content_widget-_] .widget-title,
div.widget[id*=_ocmx_content_widget-] .widget-title{color: #fff; text-shadow: 1px 1px rgba(0,0,0,0.4); background: #e08b30; border: 1px solid #cf5d00;}


/* PURPLE WIDGETS */
div.widget[id*=_ocmx_small_ad_widget-_] .widget-title, 
div.widget[id*=_ocmx_small_ad_widget-] .widget-title, 

div.widget[id*=_ocmx_comment_widget-_] .widget-title, 
div.widget[id*=_ocmx_comment_widget-] .widget-title, 

div.widget[id*=_contact_widget-_] .widget-title,
div.widget[id*=_contact_widget-] .widget-title, 

div.widget[id*=_ocmx_medium_ad_widget-_] .widget-title, 
div.widget[id*=_ocmx_medium_ad_widget-] .widget-title, 

div.widget[id*=_search-_] .widget-title, 
div.widget[id*=_search-] .widget-title, 

div.widget[id*=_popular_posts_widget-_] .widget-title, 
div.widget[id*=_popular_posts_widget-] .widget-title,
 
div.widget[id*=_ocmx_social_widget-_] .widget-title, 
div.widget[id*=_ocmx_social_widget-] .widget-title,
 
div.widget[id*=_ocmx_twitter_widget-_] .widget-title, 
div.widget[id*=_ocmx_twitter_widget-] .widget-title, 

div.widget[id*=_ocmx_flickr_widget-_] .widget-title, 
div.widget[id*=_ocmx_flickr_widget-] .widget-title {color: #fff; text-shadow: 1px 1px rgba(0,0,0,0.4); background: #b386c0; border: 1px solid #9457a5;}

/* WOO GREEN WIDGETS */
div.widget[id*=_best_sellers-_] .widget-title, 
div.widget[id*=_best_sellers-] .widget-title,
 
div.widget[id*=_featured-products-_] .widget-title, 
div.widget[id*=_featured-products-] .widget-title,
 
div.widget[id*=_layered_nav-_] .widget-title, 
div.widget[id*=_layered_nav-] .widget-title, 

div.widget[id*=_woocommerce_login-_] .widget-title, 
div.widget[id*=_woocommerce_login-] .widget-title, 

div.widget[id*=_onsale-_] .widget-title, 
div.widget[id*=_onsale-] .widget-title, 

div.widget[id*=_price_filter-_] .widget-title, 
div.widget[id*=_price_filter-] .widget-title, 

div.widget[id*=_product_categories-_] .widget-title, 
div.widget[id*=_product_categories-] .widget-title, 

div.widget[id*=_product_search-_] .widget-title, 
div.widget[id*=_product_search-] .widget-title,
 
div.widget[id*=_product_tag_cloud-_] .widget-title, 
div.widget[id*=_product_tag_cloud-] .widget-title,
 
div.widget[id*=_woocommerce_random_products-_] .widget-title, 
div.widget[id*=_woocommerce_random_products-] .widget-title, 

div.widget[id*=_recently_viewed_products-_] .widget-title, 
div.widget[id*=_recently_viewed_products-] .widget-title, 

div.widget[id*=_recent_products-_] .widget-title, 
div.widget[id*=_recent_products-] .widget-title, 

div.widget[id*=_recent_reviews-_] .widget-title, 
div.widget[id*=_recent_reviews-] .widget-title, 

div.widget[id*=_shopping_cart-_] .widget-title, 
div.widget[id*=_shopping_cart-] .widget-title, 

div.widget[id*=_top-rated-products-_] .widget-title, 
div.widget[id*=_top-rated-products-] .widget-title {color: #fff; text-shadow: 1px 1px rgba(0,0,0,0.4); background: #83aa4d; border: 1px solid #55890c;}


/* REMOVE BORDER BOTTOM */
.widget-liquid-right .widget .widget-top, .widget-liquid-right .postbox h3, .widget-liquid-right .stuffbox h3 {margin: 0px !important; border-bottom: none !important;}

.wrap div.updated, .wrap div.error, .media-upload-form div.error {margin: 5px 0px 5px !important;}
.widget .widget-top {overflow: visible !important;}
.theme-widgets {display: none; position: absolute; top: 80px; background: #fff; padding: 20px; width: 250px; margin-left: auto; margin-right: auto; left: 0; right: 0; z-index: 99; box-shadow: 0px 0px 10px rgba(0,0,0,0.4); border-radius: 8px;}
.theme-widgets h2 {margin-top: 0px;}
.theme-widgets h3 {margin-bottom: 8px !important;}
.widget-blue {padding-bottom: 10px; border-bottom: 1px dotted #ccc;}
.widget-blue span {padding: 5px 10px; background: #6784bf; border: 1px solid #365dac; color: #fff; font-weight: bold; text-shadow: 1px 1px rgba(0,0,0,0.4); clear: both; display: block;}
.widget-panel {border-bottom: 1px dotted #ccc;}
.widget-panel span.orange {padding: 5px 10px; margin-bottom: 10px; background: #e08b30; border: 1px solid #cf5d00; color: #fff; font-weight: bold; text-shadow: 1px 1px rgba(0,0,0,0.4); clear: both; display: block;}
.widget-panel span.purple {padding: 5px 10px; margin-bottom: 10px; background: #b386c0; border: 1px solid #9457a5; color: #fff; font-weight: bold; text-shadow: 1px 1px rgba(0,0,0,0.4); clear: both; display: block;}
.widget-panel span.green {padding: 5px 10px; margin-bottom: 10px; background: #83aa4d; border: 1px solid #55890c; color: #fff; font-weight: bold; text-shadow: 1px 1px rgba(0,0,0,0.4); clear: both; display: block;}
.widget-orange {padding-bottom: 10px; border-bottom: 1px dotted #ccc;}
.widget-orange span {padding: 5px 10px; background: #e08b30; border: 1px solid #cf5d00; color: #fff; font-weight: bold; text-shadow: 1px 1px rgba(0,0,0,0.4); clear: both; display: block;}
.widget-purple {border-bottom: 1px dotted #ccc;}
.widget-purple span {padding: 5px 10px; margin-bottom: 10px; background: #b386c0; border: 1px solid #9457a5; color: #fff; font-weight: bold; text-shadow: 1px 1px rgba(0,0,0,0.4); clear: both; display: block;}
.widget .widget-top {overflow: visible !important;}
.button_close {margin-bottom: 0px;}	
.button_close a {padding: 5px 10px; margin: 0px; color: #fff; text-decoration: none; background: #c10000; border-radius: 4px; font-weight: bold;}
.button_close a:hover {color: #fff; background: #8d0202;}

/* WIDGET PANEL TEXT COLOR */
div.widget[id*=_video_widget-] .in-widget-title,
div.widget[id*=_sponsors_widget-] .in-widget-title, 
div.widget[id*=_about_widget-] .in-widget-title,
div.widget[id*=_contact_widget-] .in-widget-title,
div.widget[id*=_events_widget-] .in-widget-title,
div.widget[id*=_latest_audio_widget-] .in-widget-title, 
div.widget[id*=_gallery_widget-] .in-widget-title,
div.widget[id*=_latest_news_widget-] .in-widget-title,
div.widget[id*=_testimonials_widget-] .in-widget-title,
div.widget[id*=_cv_widget-] .in-widget-title,
div.widget[id*=_ocmx_recent_posts_widget-] .in-widget-title,
div.widget[id*=_ocmx_content_widget-] .in-widget-title,
div.widget[id*=_ocmx_slider_widget-] .in-widget-title,
div.widget[id*=_skills_widget-] .in-widget-title{color: #fff !important;}

</style>
EOF;
}

}

add_action('admin_print_styles-widgets.php', 'obox_widgets_style');

function ocmx_recommended_setup() {
global $pagenow;
    if ( $pagenow == 'widgets.php' ) {
    
    	echo '<script type="text/javascript">
			  	jQuery(document).ready(function(){ 
				 	jQuery(".button_widget").click(function() { 
				     	jQuery(".theme-widgets").fadeIn("slow");
				 	});
				
				 	jQuery(".button_close").click(function() { 
				  		jQuery(".theme-widgets").fadeOut("slow"); 
				  	});
			 	});
			 </script>';
    
  		echo '<div class="theme-widgets">
 				<h2>Obox Widget Setup</h2> 				
  				<div class="widget-panel">
  					<h3>Home Page</h3>
  					<span class="orange">(Obox) Slider Widget</span>
  					<span class="orange">(Obox) Content Widget</span>
  				</div>
  				<p class="button_close"><a href="#">Close</a></p>
  			  </div>';
  
	}
}

add_action( 'admin_head', 'ocmx_recommended_setup' ); 

function ocmx_admin_notice(){
    global $pagenow;
    if ( $pagenow == 'widgets.php' ) {
         echo '<div class="updated">
             		<p>To view the recommended widget setup for this theme <a class="button_widget" href="#">Click Here</a>.</p>
         		</div>';
    }
}
add_action('admin_notices', 'ocmx_admin_notice');

?>