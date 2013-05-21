<?php 
function check_gallery_table()
	{
		global $wpdb;
		
		$gallery_hdr_table = $wpdb->prefix . "ocmx_gallery";
		$gallery_dtl_table = $wpdb->prefix . "ocmx_gallery_dtl";
		
		if(check_table_existance($gallery_dtl_table)) :
			$usesql = "SELECT image_order FROM `".$gallery_dtl_table."`";
			$gallery_table =  mysql_query($usesql);
			
			if($gallery_table === false) :
				$add_order_column = "ALTER TABLE $gallery_dtl_table ADD COLUMN image_order MEDIUMINT(8) unsigned NOT NULL";
				mysql_query($add_order_column);
				
				$use_sql = "SELECT * FROM `".$gallery_hdr_table."` ORDER BY dbDate DESC";
				$table_Details =  $wpdb->get_results($use_sql);
				foreach ($table_Details as $gallery_list) :
					$i = 0;
					$detail_sql = "SELECT * FROM `".$gallery_dtl_table."` WHERE GalleryId = '".$gallery_list->menuId."' ORDER BY galleryCover DESC";
					$detail_result =  $wpdb->get_results($detail_sql);
					foreach ($detail_result as $gallery_list) :
						$i++;
						$update_details = "UPDATE ".$gallery_dtl_table." SET `image_order` = '".$i."' WHERE menuId = ".$gallery_list->menuId;
						mysql_query($update_details);
					endforeach;
				endforeach;
			endif;
			
			$usesql = "SELECT image_effect FROM `".$gallery_hdr_table."`";
			$gallery_table =  mysql_query($usesql);
			
			if($gallery_table === false) :
				$add_effect_column = "ALTER TABLE $gallery_hdr_table ADD COLUMN image_effect MEDIUMINT(8) unsigned NOT NULL";
				mysql_query($add_effect_column);
			endif;
		endif;
	}

function ocmx_setup()
	{
		global $wpdb, $theme_options;
		if(isset($_GET["activated"])) :
			if($theme_options["general_site_options"][1]["name"] == "ocmx_theme_style") :
				update_option("ocmx_theme_style", $theme_options["general_site_options"][1]["default"]);
			elseif(isset($theme_options["general_site_options"][2]["default"])) :
				update_option("ocmx_theme_style", $theme_options["general_site_options"][2]["default"]);
			endif;
		endif;
		
			$gallery_hdr_table= $wpdb->prefix . "ocmx_gallery";
			$gallery_dtl_table = $wpdb->prefix . "ocmx_gallery_dtl";	
			$comment_table = $wpdb->prefix . "ocmx_comment_meta";	
			if(!check_table_existance($gallery_hdr_table)) :
			
				/* Create the main Table */
				$gallery_table = "CREATE TABLE IF NOT EXISTS `$gallery_hdr_table` (			
				`menuId` MEDIUMINT(8) unsigned NOT NULL auto_increment PRIMARY KEY,
				`Item` VARCHAR(255),
				`LinkTitle` LONGTEXT,
				`Description` LONGTEXT,
				`dbDate` DATE,
				`Tags` LONGTEXT);";
				
				mysql_query($gallery_table);
				
				/* Create the Sub Table */
				$gallery_sub_table = "CREATE TABLE IF NOT EXISTS `$gallery_dtl_table` (
				`menuId` MEDIUMINT(8) unsigned NOT NULL auto_increment PRIMARY KEY,
				`GalleryId` MEDIUMINT(8) unsigned NOT NULL, 
				`Item` VARCHAR(255),
				`Description` LONGTEXT,
				`Image` LONGTEXT,
				`dbDate` DATE,
				`galleryCover` TINYINT,
				`image_effect` MEDIUMINT(8),
				`image_order` MEDIUMINT(8) unsigned NOT NULL);";
				
				mysql_query($gallery_sub_table);
				
				$comment_meta_table = "CREATE TABLE IF NOT EXISTS `".$comment_table."` (			
				`commentId` MEDIUMINT(8) unsigned NOT NULL PRIMARY KEY,
				`twitter` VARCHAR(255),
				`block_user` TINYINT,
				`email_subscribe` TINYINT);";
				
				mysql_query($comment_meta_table);
				$comments_sql = "SELECT * FROM $wpdb->comments";
				$comments_query = $wpdb->get_results($comments_sql);
				
				foreach($comments_query as $comment) :
					if($comment->comment_subscribe == "Y") :
						$comment_subs = "1";
					else :
						$comment_subs = "0";
					endif;
					$meta_update = $wpdb->query
						($wpdb->prepare
							("INSERT INTO $comment_table
								(commentId, twitter, email_subscribe)
							VALUES
								(%d, %s, %s);", 
							$comment->comment_ID, "", $comment_subs)
						);
				endforeach;
				
				if(mysql_query($gallery_table) === true && mysql_query($gallery_sub_table) === true ) :
					$table_created = 1;
				endif;
			endif;
			
			// Small Image Dimension Defaults
			add_option("ocmx_gallery_small_width", "250");
			add_option("ocmx_gallery_small_height", "250");
			add_option("ocmx_gallery_small_percentage", "");
		
			// Large Image Dimension Defaults
			add_option("ocmx_gallery_large_width", "1024");
			add_option("ocmx_gallery_large_height", "0");
			add_option("ocmx_gallery_large_percentage", "");
	
			if (is_admin()) {
				$upload_dir = wp_upload_dir();
				$upload_folder = $upload_dir['basedir'];

				if (!is_dir($upload_folder."/ocmx-gallery/")) {
					mkdir($upload_folder."/ocmx-gallery");
					mkdir($upload_folder."/ocmx-gallery/thumbs");
					mkdir($upload_folder."/ocmx-gallery/small");
					wp_mkdir_p($upload_folder."/ocmx-gallery/large");
					$thumb_file = $upload_folder."/ocmx-gallery/thumbs";
					$small_file = $upload_folder."/ocmx-gallery/small";
					$large_file = $upload_folder."/ocmx-gallery/large";
					chmod($upload_folder."/ocmx-gallery", 0755);
					chmod($thumb_file, 0755);
					chmod($small_file, 0755);
					chmod($large_file, 0755);
				}
			}
				
			$add_like_sql = 	"ALTER TABLE $wpdb->posts
								ADD COLUMN ocmx_like MEDIUMINT(8) DEFAULT 0;";
			mysql_query($add_like_sql);
			
			$add_unlike_sql = 	"ALTER TABLE $wpdb->posts
								ADD COLUMN ocmx_unlike MEDIUMINT(8) DEFAULT 0;";
			mysql_query($add_unlike_sql);
			
		update_option("ocmx_gallery_small_width", "250");
		update_option("ocmx_gallery_small_height", "250");
	}
function check_table_existance($new_table) {
	global $wpdb;
	
	foreach ($wpdb->get_col("SHOW TABLES",0) as $table ) {
		if ($table == $new_table) {
			return true;
		}
	}
	return false;
}
?>