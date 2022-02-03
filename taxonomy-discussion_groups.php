<?php 
get_header();
global $adforest_theme; 


$category = array(
	array(
		'taxonomy' => 'discussion_groups',
		'field' => 'term_id',
		'terms' => get_queried_object_id(),
	),
);

$ad_tags_args = array(
	'post_type' => 'ad_post',
	'post_status' => 'publish',
	'posts_per_page' => get_option('posts_per_page'),
	'tax_query' => array(
		$category,
		$countries_location,
	),
	'meta_query' => array(
		array(
			'key' => '_adforest_ad_status_',
			'value' => 'active',
			'compare' => '=',
		),
	),
	'orderby' => 'date',
	'order' => 'DESC',
	'fields' => 'ids',
	'paged' => $paged,
);


$comments_count = get_comments( array(
	'post_type' => 'discussions',   // Use user_id.
	'count'   => true // Return only the count.
) );

$term_id = get_queried_object_id();
$term = get_term($term_id, 'discussion_groups');

$image_id = get_term_meta($term->term_id, 'discussion_groups-image-id', true);
?>

<div class="sa-after-header">
	<section class="sa-header">
		<div class="container">
			<div class="row">
				<div class="left">
					<?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
					<div>
						<h3><?php echo $term->name ?></h3>
						<div>
							<span><i class="fa fa-comments"></i> <?php echo $term->count; ?> discussions</span>
							<span><i class="fa fa-comment"></i> <?php echo $comments_count; ?> commentaires</span>
						</div>
					</div>
				</div>
				<div class="right">
					<a class="btn btn-light" href="/post-discussion"><i class="custom fa fa-plus"></i>&nbsp;Nouvelle discussion</a>
				</div>
			</div>
		</div>
	</section>
</div>

<?php sa_the_ads('default', array('discussion_groups', $term_id), false, 'discussions'); ?>

<?php get_footer(); ?>