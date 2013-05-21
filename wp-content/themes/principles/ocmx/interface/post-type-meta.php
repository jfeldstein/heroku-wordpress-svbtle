<?php if(!function_exists("post_type_meta_panel")) {
	function post_type_meta_panel($pId, $posttype = "post") { 
		$posttypedetails = get_post_type_object($posttype);
		
		$input = get_post_meta($pId,$posttype,true);
		$cat_list = get_terms("$posttype-category", "orderby=count&hide_empty=0"); ?>
		<div class="inside clearfix">
			<div id="taxonomy-<?php echo $posttype; ?>-category" class="categorydiv">
				<p style="text-align: right;">Add, edit and delete <?php echo $posttypedetails->labels->name; ?> via the <a href="<?php echo home_url(); ?>/wp-admin/edit.php?post_type=<?php echo $posttype; ?>"><?php echo $posttypedetails->labels->name; ?> Panel</a> </p>
				<ul id="<?php echo $posttype; ?>-category-tabs" class="category-tabs clearfix">
					<li <?php if($i == 1) : ?>class="tabs"<?php endif; ?>><a href="#<?php echo $posttype; ?>-category-all">All</a></li>
					<?php  $i=1; foreach($cat_list as $tax) :
						if($tax->parent == 0) :
					?>
						<li <?php if($i == 1) : ?>class="tabs"<?php endif; ?>><a href="#<?php echo $posttype; ?>-category-<?php echo $tax->slug; ?>" tabindex="3"><?php echo $tax->name; ?></a></li>
					<?php  $i++;
						endif;
					endforeach; ?>
				</ul>
				<?php $i=1; $ocmx_posts = new WP_Query("post_type=".$posttype."&posts_per_page=-1"); ?>
				<div id="<?php echo $posttype; ?>-category-all" class="tabs-panel" <?php if($i != 1) : ?>style="display: none;"<?php endif; ?>>
					 <?php if ($ocmx_posts->have_posts()) :
						while ($ocmx_posts->have_posts()) :	$ocmx_posts->the_post(); 
							if(is_array($input) && in_array(get_the_ID(), $input)) : $checked = "checked=\"checked\""; else : $checked = ""; endif; ?>
							<p><label class="selectit">
								<input type="checkbox" name="<?php echo $posttype; ?>[]" value="<?php echo get_the_ID(); ?>" <?php echo $checked; ?> />&nbsp;<?php the_title(); ?>
							</label></p>
						<?php endwhile;
						$i++;
					endif; ?>
				</div>
				 <?php  foreach($cat_list as $tax) :
					if($tax->parent == 0) :
						$ocmx_posts = new WP_Query("post_type=$posttype&$posttype-category=$tax->slug&posts_per_page=-1"); ?>
					<div id="<?php echo $posttype; ?>-category-<?php echo $tax->slug; ?>" class="tabs-panel" <?php if($i != 1) : ?>style="display: none;"<?php endif; ?>>
						 <?php if ($ocmx_posts->have_posts()) :
							while ($ocmx_posts->have_posts()) :	$ocmx_posts->the_post(); 
								if(is_array($input) && in_array(get_the_ID(), $input)) : $checked = "checked=\"checked\""; else : $checked = ""; endif; ?>
								<p><label class="selectit">
									<input type="checkbox" name="<?php echo $posttype; ?>[]" value="<?php echo get_the_ID(); ?>" <?php echo $checked; ?> />&nbsp;<?php the_title(); ?>
								</label></p>
							<?php endwhile;
						endif; ?>
					</div>
				<?php $i++; endif;
				endforeach; ?>
			</div>
		</div>
	<?php }
	
	function post_type_meta_update($postId, $posttype = "post") { 
		foreach($_POST as $key => $value) :
			if($key == $posttype) :
				delete_post_meta($postId,$posttype);
				$metalist = array();
				foreach($value as $val) :
					if(!in_array($val, $metalist))
						$metalist[] = $val;
				endforeach;
				add_post_meta($postId,$key,$metalist,true) or update_post_meta($postId,$key,$metalist);
			endif;
		endforeach;
	}
	
	function post_meta_panel($postId, $postmeta) { 
		global $blog_id;?>
		<table class="obox_metaboxes_table">
			<?php foreach ($postmeta as $metabox) :
				$metabox_value = get_post_meta($postId, $metabox["name"],true);
				
				if ($metabox_value == "" || !isset($metabox_value)) :
					$metabox_value = $metabox['default'];
				endif; ?>
				<tr>
					<td width="20%" valign="top" class="obox_label">
						<label for="<?php echo $metabox; ?>"><?php echo $metabox["label"]; ?></label>
						<p><?php echo $metabox["desc"] ?></p>
					</td>
					<td colspan="3">
						<?php if($metabox["input_type"] == "image") : ?>
							<div class="clearfix"><input type="file" name="<?php echo "obox_".$metabox["name"]."_file"; ?>" /></div>
							<div class="clearfix">
								<label>
									Image Path
								</label>
								<?php if(empty($obox_metabox_value)) : ?>
									<input class="obox_input_text" type="text" name="<?php echo "obox_".$metabox["name"]; ?>" id="<?php echo "obox_".$metabox["name"]; ?>" value="<?php echo $metabox_value; ?>" size="<?php echo $metabox["input_size"] ?>" />
								<?php else : ?>
									<input class="obox_input_text" type="text" name="<?php echo "obox_".$metabox["name"]; ?>" />
								<?php endif; ?>
							</div>
							<div class="clearfix">
								<?php if($metabox_value != "") :
									if(is_multisite()) :
										$metabox_value = str_replace(get_site_url($blog_id), "", $metabox_value);
										$metabox_value = str_replace("/files/", "/wp-content/blogs.dir/$blog_id/files/", $metabox_value); 
									endif; ?>
									<div class="obox_main_image">
										<img src="<?php echo $metabox_value; ?>" />
									</div>
								<?php endif; ?>
							</div>
						<?php elseif($metabox["input_type"] == "select") : ?>
							<select name="<?php echo "obox_".$metabox["name"]; ?>" id="<?php echo "obox_".$metabox["name"]; ?>">
								<?php foreach($metabox["options"] as $option => $value) : ?>
									<option <?php if($metabox_value == $value) : ?>selected="selected"<?php endif; ?> value="<?php echo $value; ?>"><?php echo $option; ?></option>
								<?php endforeach; ?>
							</select>
						<?php elseif($metabox["input_type"] == "textarea") : ?>
							<textarea class="obox_metabox_fields" style="width: 70%;" rows="8" name="<?php echo "obox_".$metabox["name"]; ?>" id="<?php echo "obox_".$metabox["name"]; ?>"><?php echo $metabox_value; ?></textarea>
						<?php else : ?>
							<input class="obox_metabox_fields" type="text" name="<?php echo "obox_".$metabox["name"]; ?>" id="<?php echo "obox_".$metabox["name"]; ?>" value="<?php echo $metabox_value; ?>" />
						<?php endif; ?>        
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
        <?php }
	function ocmx_change_metatype(){
?>
	<script type="text/javascript">
    /* <![CDATA[ */
        jQuery(window).load(function(){
            jQuery('form#post').attr('enctype','multipart/form-data');
        });
    /* ]]> */
    </script>
	<style type="text/css">
	.clearfix:after{clear: both; content: '.'; display: block; visibility: hidden; height: 0;}
	.clearfix{display: inline-block;}
	.clearfix{display: block;}
    .obox_input_text 				{width: 64%; padding: 5px; margin: 0 0 10px 0; background: #f4f4f4; color: #444; font-size: 11px;}
    .obox_input_select 				{width: 60%; padding: 5px; margin: 0 0 10px 0; background: #f4f4f4; color: #444; font-size: 11px;}
    .obox_input_checkbox 			{margin: 0 10px 0 0; }
    .obox_input_radio 				{margin: 0 10px 0 0; }
    .obox_input_radio_desc 			{color: #666; font-size: 12px;}
    .obox_spacer 					{display: block; height: 5px;}
	
	.obox_main_image				{float: left; margin-right: 20px; border: 5px solid #f5f5f5; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;} 
		.obox_main_image img		{-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; max-width: 600px;} 
	
	.obox_label						{ width: 30%;}
	.obox_label label				{display: block; font-weight: bold;}
	.obox_label p					{clear: both; padding: 0px; margin: 10px 0px 0px !important; color: #595959; font-style: italic;}
    
    .obox_metabox_desc				{display: block; font-size: 10px; color: #aaa;}
    .obox_metaboxes_table			{width:100%; border-collapse: collapse;}
	.obox_metaboxes_table tr		{border-bottom: 1px solid #e0e0e0;}
	.obox_metaboxes_table tr:last-child	{border-bottom: none;}
    .obox_metaboxes_table th,
    .obox_metaboxes_table td		{padding: 10px; text-align: left; vertical-align: top;}
	.obox_metaboxes_table textarea	{width: 90% !important;}
    .obox_metabox_names				{width: 20%}
    .obox_metabox_fields			{width: 80%}
    .obox_metabox_image				{text-align: right;}
    .obox_red_note					{margin-left: 5px; color: #c77; font-size: 10px;}
    .obox_input_textarea			{width: 90%; height: 120px; padding: 5px; margin: 0px 0px 10px 0px; background: #f0f0f0; color: #444; font-size: 11px;}
	#excerpt						{height: 120px;}
	
		
	label.image-edit-item{float: left; margin: 20px 10px 10px 0px; padding: 0px; position: relative; overflow: hidden;}
		label.image-edit-item a{display: block; width: 32px; height: 31px; background: url(<?php echo get_template_directory_uri(); ?>/ocmx/images/image-edit-icons.png) no-repeat; position: relative; z-index: 2;}
			label.greyscale a		{background-position: 0px 0px;}
			label.negative a		{background-position: 0px -60px;}
			label.brightness a		{background-position: 0px -120px;}
			label.contrast a		{background-position: 0px -180px;}
			label.blur a			{background-position: 0px -240px;}
			label.colorize a		{background-position: 0px -300px;}
			label.noeffect a		{background-position: 0px -360px;}
			
			label.greyscale a.active	{background-position: -40px 0px;}
			label.negative a.active		{background-position: -40px -60px;}
			label.brightness a.active	{background-position: -40px -120px;}
			label.contrast a.active		{background-position: -40px -180px;}
			label.blur a.active			{background-position: -40px -240px;}
			label.colorize a.active		{background-position: -40px -300px;}
			label.noeffect a.active		{background-position: -40px -360px;}
			
	label.image-edit-item input{position: absolute; top: 5px; left: 5px; z-index: 1;}
	
    </style>
<?php }
	
	function post_meta_update($postId, $postmeta){
		foreach ($postmeta as $metabox) {
			$var = "obox_".$metabox["name"];
			if (isset($_POST[$var])) :
				if($metabox["input_type"] == "image") :
					$use_file_field = $var."_file";			
					$use_effect = $var."_effect";
					
					/* Check if we've actually selected a file */
					
					if($_FILES[$use_file_field]["name"] != "") :				
						$id = media_handle_upload($use_file_field, $postId);           
						if($metabox["name"] == "other_media") :
	                    	set_post_thumbnail($postId, $id);
	                    endif;
	                    $attachment = wp_get_attachment_image_src( $id, "full");						
						//Update Post Meta
						add_post_meta($postId, $metabox["name"], $attachment[0],true) or update_post_meta($postId,  $metabox["name"], $attachment[0]);
					else :
						//Update Post Meta
						add_post_meta($postId,$metabox["name"],$_POST[$var],true) or update_post_meta($postId,$metabox["name"], $_POST[$var]);
					endif;
					if($metabox["effects"]) :
						add_post_meta($postId,$metabox["name"]."_effect",$_POST[$use_effect],true) or update_post_meta($postId,$metabox["name"]."_effect",$_POST[$use_effect]);
					endif;
				else :
					add_post_meta($postId,$metabox["name"],$_POST[$var],true) or update_post_meta($postId,$metabox["name"],$_POST[$var]);				
				endif;
			endif;
		}
	} 
}; ?>