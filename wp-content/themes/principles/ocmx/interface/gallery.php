<?php
function ocmx_gallery_list (){
	global  $wpdb, $themename, $wpdb,$gallery_added, $the_menuId, $changes_done;
	$chkloop = 0;
	
	// Make sure the gallery tables exist
	$gallery_hdr_table = $wpdb->prefix . "ocmx_gallery";
	if(check_table_existance($gallery_hdr_table)) : ocmx_setup(); endif;
	
	//Get the data
	$use_sql = "SELECT * FROM ".$wpdb->prefix."ocmx_gallery ORDER BY dbDate ASC";
	$table_Details =  $wpdb->get_results($use_sql);
	$upload_dir = wp_upload_dir();
?>  
	<?php foreach ($table_Details as $gallery_list) :
            /* Fetch the Default Image */
            $use_sql = "SELECT * FROM ".$wpdb->prefix."ocmx_gallery_dtl WHERE GalleryId = ".$gallery_list->menuId." ORDER BY galleryCover DESC";
            $default_image =  $wpdb->get_results($use_sql); ?>
        <li>
            <div class="gallery-item">
                <a href="<?php echo site_url()."/wp-admin/admin.php?page=ocmx-gallery&amp;edit=1&amp;id=".$gallery_list->menuId;?>" class="image">
                    <img src="<?php echo $upload_dir["baseurl"]; ?>/ocmx-gallery/small/<?php echo $default_image[0]->Image; ?>" border="0" />
                </a>
                <a href="<?php echo site_url()."/wp-admin/admin.php?page=ocmx-gallery&amp;delete=1&amp;id=".$gallery_list->menuId;?>" class="delete-image"><?php _e("Delete","ocmx"); ?></a>
                <a href="<?php echo site_url()."/wp-admin/admin.php?page=ocmx-gallery&amp;edit=1&amp;id=".$gallery_list->menuId;?>" class="edit-image"><?php _e("Edit","ocmx"); ?></a>
                <span class="image-name"><?php echo substr($gallery_list->Item, 0, 20); if(strlen($gallery_list->Item) > 20) : ?>...<?php endif; ?></span>
                <span class="image-date"><?php echo date("d.m.Y", strtotime($gallery_list->dbDate)); ?></span>
            </div>
        </li>                          		
    <?php endforeach; ?>
    <li>
        <div class="gallery-item add-new-gallery">
            <a href="<?php echo site_url()."/wp-admin/admin.php?page=ocmx-gallery&amp;new=&amp;id="; ?>">
				<span><?php _e("Create New Gallery","ocmx"); ?></span>
            </a>
        </div>
    </li>         
<?php
	}

function ocmx_new_gallery_details (){
	global $wpdb, $table_Details;
	/* Get the main Gallery Details*/
	$use_sql = "SELECT * FROM ".$wpdb->prefix."ocmx_gallery WHERE  menuId = ".$_GET['id'];
	$table_Details =  $wpdb->get_results($use_sql);
?>
	<li class="admin-block">
        <label class="parent-label"><?php _e("Title", "ocmx");?></label>
        <div class="form-wrap">
            <input type="text" value="<?php echo $table_Details[0]->Item; ?>"  id="item" name="Item" />
        </div>
        <label class="parent-label"><?php _e("Description", "ocmx");?></label>
        <div class="form-wrap">
            <textarea  name="myEditor"><?php echo $table_Details[0]->Description; ?></textarea>
        </div>
		<?php if (($timestamp = strtotime($table_Details[0]->dbDate)) === false) : ?>
            <input type="hidden" maxlength="100" value="<?php date("Y-m-d"); ?>" id="date" name="dbDate" />
        <?php else : ?>
            <label class="parent-label"><?php _e("Gallery Date", "ocmx");?></label>
            <div class="form-wrap">
            	<input type="text" maxlength="100" value="<?php if($table_Details[0]->dbDate !== "") : echo date("Y-m-d", strtotime($table_Details[0]->dbDate)); endif; ?>" id="date" name="dbDate" />
                <p class="tooltip">eg. yyyy-mm-dd</p>
            </div>
        <?php endif; ?>
        <?php if(get_option("allow_gallery_effect")) : ?>
            <label class="parent-label"><?php _e("Effects", "ocmx");?></label>
            <div class="form-wrap">
            	<?php $effect = $table_Details[0]->image_effect; ?>
            	<label class="image-edit-item noeffect selectit" title="None">
                    <a href="#"<?php if($effect == 0 || $effect == null) : ?> class="active"<?php endif; ?>></a>
                    <input type="radio" name="gallery_effect" value="0" />
                </label>
                <label class="image-edit-item greyscale" title="Grey Scale">
                    <a href="#"<?php if($effect == 2) : ?> class="active"<?php endif; ?>></a>
                    <input type="radio" name="gallery_effect" value="2" />
                </label>
                
                <label class="image-edit-item negative" title="Negative">
                    <a href="#"<?php if($effect == 1) : ?> class="active"<?php endif; ?>></a>
                    <input type="radio" name="gallery_effect" value="1" />
                </label>
                
                <label class="image-edit-item brightness" title="Brighten">
                    <a href="#"<?php if($effect == 3) : ?> class="active"<?php endif; ?>></a>
                    <input type="radio" name="gallery_effect" value="3" />
                </label>
                
                <label class="image-edit-item contrast" title="Contrast">
                    <a href="#"<?php if($effect == 5) : ?> class="active"<?php endif; ?>></a>
                    <input type="radio" name="gallery_effect" value="5" />
                </label>
                
                <label class="image-edit-item blur" title="Blur">
                    <a href="#"<?php if($effect == 8) : ?> class="active"<?php endif; ?>></a>
                    <input type="radio" name="gallery_effect" value="8" />
                </label>
                
                <label class="image-edit-item colorize" title="Colorize">
                    <a href="#"<?php if($effect == 4) : ?> class="active"<?php endif; ?>></a>
                    <input type="radio" name="gallery_effect" value="4" />
                </label>
                <span class="tooltip"><?php _e("Apply special effected to all the images in this gallery.", "ocmx"); ?></span>
            </div>
        <?php endif; ?>
	    <?php if($_GET["id"] == "") : ?>
			<input type="hidden" name="auto_post" value="1" />
        <?php endif; ?>
    </li>
    <li class="admin-block">
        <label class="parent-label"><?php _e("Select Images", "ocmx"); ?></label>
        <div class="form-wrap">
            <input id="my_file_element" type="file" name="file_1" onchange="javascript: check_fileType('.gif,.jpg,.png', this);" />
            <span class="tooltip"><?php _e("Add images to your gallery (maximum of 10 at a time, images larger than <strong>2mb</strong> will not upload)", "ocmx"); ?></span>
            <ul class="upload-list sortable" id="files_list"><li><span><?php _e("You have not selected any images", "ocmx"); ?></span></li></ul>
            
			<script language="JavaScript1.2" type="text/javascript">
                var multi_selector = new MultiSelector( document.getElementById( 'files_list' ), 10);
                multi_selector.addElement( document.getElementById( 'my_file_element' ) );	
            </script>
        </div>
    </li>
    
	<li class="admin-block">
        <h3><?php _e("Image Dimensions", "ocmx"); ?></h3>
        <span class="info-bubble">
            <?php _e("Unless you customize your theme, dimensions will not need to be changed. These options will determine how large your images are when viewing the Gallery.", "ocmx"); ?>
        </span>
        
        <div class="dimension-block">
            <h3><?php _e("Small Image Dimensions (px)"); ?></h3>
            <label><?php _e("Width"); ?></label>
            <input type="text" name="small_width" id="width_1" value="<?php echo get_option("ocmx_gallery_small_width"); ?>" />
            
            <label><?php _e("Height"); ?></label>
            <input type="text" name="small_height" id="height_1" value="<?php echo get_option("ocmx_gallery_small_height"); ?>" />
        </div>
        
        <div class="dimension-block">
            <h3><?php _e("Large Image Dimensions (px)", "ocmx"); ?></h3>
            <label><?php _e("Width", "ocmx"); ?></label>
            <input type="text" name="large_width" id="width_2" value="<?php echo get_option("ocmx_gallery_large_width"); ?>" />
            
            <label><?php _e("Height", "ocmx"); ?></label>
            <input type="text" name="large_height" id="height_2" value="<?php echo get_option("ocmx_gallery_large_height"); ?>" />
        </div>
        <span class="tooltip"><?php _e("Proportions will automatically be constrained, with the larger value prioritized. Set Height or Width to 0 (zero) to ignore.", "ocmx"); ?></span>
    </li>
    <input type="hidden" name="ocmx_gallery_update" value="1" />
    <input type="hidden" name="LinkTitle" value="<?php echo $table_Details[0]->LinkTitle; ?>" />
    <?php if($_GET["id"] !== "") : ?>
        <input type="hidden" name="edit_item" value="<?php echo $table_Details[0]->menuId; ?>" />
    <?php endif; ?>
<?php
}
function ocmx_manage_gallery (){	
	global $wpdb, $table_Details;
	/* Get the Gallery image Details*/
	$images_sql = "SELECT * FROM ".$wpdb->prefix."ocmx_gallery_dtl WHERE GalleryId = ".$table_Details[0]->menuId." ORDER BY image_order ASC, galleryCover, dbDate DESC";
	$image_Details =  $wpdb->get_results($images_sql);
	$upload_dir = wp_upload_dir();
	$i = 0;
	foreach ($image_Details as $this_image) : ?>
		<li>
            <div class="gallery-item clearfix">
                <a href="<?php echo $upload_dir["baseurl"]; ?>/ocmx-gallery/large/<?php echo $this_image->Image; ?>" class="image" rel="lightbox">
                    <img src="<?php bloginfo('template_directory'); ?>/functions/timthumb.php?src=<?php echo $upload_dir["baseurl"]; ?>/ocmx-gallery/small/<?php echo $this_image->Image; ?>&w=250&h=250&q=100&f=<?php echo $table_Details[0]->image_effect; ?>" border="0" />
                </a>
                <a id="edit-image-<?php echo $i; ?>" href="<?php echo get_option("siteurl")."/wp-admin/admin.php?page=ocmx-gallery&amp;edit=1&amp;id=".$this_image->menuId;?>" class="edit-image">edit</a>
                <span class="image-date"><?php echo date("d.m.Y", strtotime($this_image->dbDate)); ?></span>
            </div>
            <div class="image-form">
                <label class="parent-label"><?php _e("Image Title", "ocmx"); ?></label>
                <div class="form-wrap">
                    <input type="text" name="item_<?php echo $this_image->menuId; ?>" value="<?php echo $this_image->Item; ?>" class="wide_fat" />
                </div>
                <label class="parent-label"><?php _e("Caption", "ocmx"); ?></label>
                <div class="form-wrap">
                    <textarea name="description_<?php echo $this_image->menuId; ?>" class="wide_fat"><?php echo $this_image->Description; ?></textarea>
                    <label><input name="remove_image_<?php echo $this_image->menuId; ?>" type="checkbox" /> Remove Picture</label>
                    <label>
                    	<input name="album_cover" type="radio" id="cover_<?php echo $i; ?>" value="<?php echo $this_image->menuId; ?>" <?php if($this_image->galleryCover == 1) : ?>checked="checked" <?php endif; ?>/>
						<?php _e("Album Cover"); ?>
					</label>
                </div>
            </div>
        </li>
<?php
		$i++; 
	endforeach;
}
function ocmx_delete_gallery_prompt($input)
	{
		global $wpdb;
		
		$use_sql = "SELECT * FROM ".$wpdb->prefix."ocmx_gallery WHERE  menuId = ".$_GET['id'];
		$table_Details =  $wpdb->get_results($use_sql);
		
		$postId = $table_Details[0]->LinkTitle;
		
		$linked_post = get_post($postId);
		
		if($input) : ?>
            <li class="admin-block-item">
                <div class="admin-description">
                    <h4><?php _e($input["label"]);?></h4>
                </div>
                <div class="admin-content">
                    
                    <label class="parent-label"><?php _e($input["description"]);?></label>
                    
                    <?php create_form($input, count($input), "form-wrap"); ?>
                        
                    <ul class="form-options contained-forms">
                        <li><strong><?php echo $table_Details[0]->Item; ?></strong> created on <strong><?php echo date("d.m.Y", strtotime($table_Details[0]->dbDate)); ?></strong></li>
                    </ul>
                    
                </div>
                <input type="hidden" name="delete_gallery" value="<?php echo $_GET['id']; ?>"/>
            </li>
		<?php endif;
	}
function ocmx_delete_gallery()
	{
		global $wpdb, $no_delete, $changes_done;
			
		if($_POST["ocmx_delete_gallery_confirm"] == "yes") :
			$main_table = $wpdb->prefix . "ocmx_gallery";
			$sub_table  = $wpdb->prefix . "ocmx_gallery_dtl";
			
			$upload_dir = wp_upload_dir();
			$upload_folder = $upload_dir['basedir'];
			
			$use_sql = "SELECT * FROM ".$main_table." ORDER BY menuId DESC";
			$fetch_galleries =  $wpdb->get_results($use_sql);

			$gallery_id = $_POST["delete_gallery"];
			
			//Delete associated Custom Post
			$use_sql = "SELECT * FROM ".$main_table." WHERE `menuId` = ".$gallery_id. " LIMIT 1";
			$get_gallery = $wpdb->get_row($use_sql);
			
			if(count($get_gallery) == 0):
				$postid = $get_gallery->LinkTitle;
				wp_delete_post( $postid, true);
			endif;
			
			//Delete Gallery From OCMX TAble
			$delete_sql = "DELETE FROM ".$main_table." WHERE `menuId` = ".$gallery_id. " LIMIT 1";
			$wpdb->query($delete_sql);
			
			$fetch_images_sql = "SELECT * FROM ".$sub_table." WHERE GalleryId = ".$gallery_id;
			$fetch_images =  $wpdb->get_results($fetch_images_sql);
			
			foreach($fetch_images as $this_image) :
				$delete_sql = "DELETE FROM ".$sub_table." WHERE `menuId` = ".$this_image->menuId. " LIMIT 1";
				$wpdb->query($delete_sql);	
				$thumb_File = $upload_folder."/ocmx-gallery/thumbs/".$this_image->Image;
				$small_File = $upload_folder."/ocmx-gallery/small/".$this_image->Image;
				$large_File = $upload_folder."/ocmx-gallery/large/".$this_image->Image;
				if(is_file($thumb_File) === true){unlink($thumb_File);};
				if(is_file($small_File) === true){unlink($small_File);};
				if(is_file($large_File) === true){unlink($large_File);};;
			endforeach;
				
			$changes_done = 1;
		endif;
	}
add_action("ocmx_fetch_options", "fetch_options");
add_action("ocmx_gallery_list", "ocmx_gallery_list");
add_action("ocmx_new_gallery_details", "ocmx_new_gallery_details");
add_action("ocmx_manage_gallery", "ocmx_manage_gallery"); 
add_action("ocmx_delete_gallery", "ocmx_delete_gallery"); 
add_action("ocmx_delete_gallery_prompt", "ocmx_delete_gallery_prompt"); ?>