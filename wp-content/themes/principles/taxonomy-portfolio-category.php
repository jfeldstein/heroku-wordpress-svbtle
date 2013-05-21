<?php
$term = get_term_by( 'slug', get_query_var('term' ), get_query_var( 'taxonomy' ) );
$cat_list = get_terms("portfolio-category", "orderby=count&hide_empty=0");
$parentpage = get_template_link("portfolio.php");
$layout = get_post_meta($parentpage->ID, "layout", true);

$args = array(
		"post_type" => 'portfolio',
		"posts_per_page" => '-1',
		"tax_query" => array(
			array(
				"taxonomy" => 'portfolio-category',
				"field" => "slug",
				"terms" => $term
			)
		)
	);
$portfolio = new WP_Query ($args);
if($layout == "one-column") :
	$nextul = 1;
elseif($layout == "two-column") :
	$nextul = 2;
else :
	$nextul = 3;
endif;
$i = 1;
get_header(); ?>
<h2 class="post-title"><?php echo $parentpage->post_title; ?> <span>/ <a href="<?php echo get_permalink($parentpage->ID); ?>"><?php echo $parentpage->post_title; ?></a> <?php echo $term->name; ?></span></h2>
<?php if($term->description != "") : ?>
	<p class="page-intro"><?php echo $term->description; ?></p>
<?php endif; ?>
<?php if ($cat_list != "") : ?>
    <ul class="portfolio-category-list">
        <li><a href="<?php  echo get_permalink($parentpage->ID); ?>"><?php _e("All", "ocmx"); ?></a></li>
        <?php foreach($cat_list as $tax) :
            $link = get_term_link($tax->slug, "portfolio-category");
			$class = "";
			if($tax->term_id == $term->term_id)
				$class = "class=\"selected\"";
            echo "<li><a href=\"$link\" $class>".$tax->name."</a></li>";
        endforeach; ?>
    </ul>
<?php endif; ?>
    <ul class="<?php echo $layout ;?> portfolio-list clearfix">
        <?php while ($portfolio->have_posts() ) : $portfolio->the_post();
        	get_template_part("functions/portfolio-list"); ?>
		<?php endwhile; ?>
    </ul>
<?php get_footer(); ?>