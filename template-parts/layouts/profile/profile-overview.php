<?php 
global $adforest_theme;
$author_id = get_query_var('author');
$author = get_user_by('ID', $author_id);
$user_pic = adforest_get_user_dp($author_id, 'adforest-user-profile');
$current_user = wp_get_current_user();
$uid = $current_user->user_login;
$hottest_deal = sa_author_hottest_ad($author_id);
$average_hotness = sa_author_year_average_ad_hot($author_id);
$ad_count = adforest_get_all_ads($author_id);
$followers_meta = get_user_meta( $author->ID, 'sa_followers', true );
$followers = explode(',', $followers_meta );
$followers_count = (!empty($followers)) ? count($followers) : 0;
?>
1111111111111
<div class="row">

	<div class="col-lg-3">
		<?php
		// author count
		$author_comments = get_comments(array('post_author' => $pid));
		$au_count = count($author_comments);
		?>

		<div class="sa_profile-stat">
			<h4 class="heading"><i class="fa fa-bar-chart"></i>Statistiques</h4>
			<h5>Posts</h5>
			<ul>
				<li><i class="fa fa-tag"></i><?php echo $ad_count; ?><span>deal</span></li>
				<li><i class="fa fa-comments"></i>0 <span>discussion</span></li>
				<li><i class="fa fa-comment"></i><?php echo $au_count; ?><span>commentaires</span></li>
				<li><i class="fa fa-comment"></i>0 <span>réponses dans les discussions</span></li>
			</ul>
			<h5>Palmares</h5>
			<ul>
				<li><i class="fa fa-fire"></i><?php echo $hottest_deal; ?>°<span>deal le plus hot</span></li>
				<li><i class="fa fa-area-chart"></i><?php echo $average_hotness; ?>°<span>en moyenne depuis 1 an</span></li>
				<li><i class="fa fa-pie-chart"></i>0 <span>réponses dans les discussions</span></li>
			</ul>
			<h5>Communaute</h5>
			<ul>
				<li><i class="fa fa-thumbs-o-up"></i>0 <span>mentions j\'aime</span></li>
				<li><i class="fa fa-users"></i><?php echo $followers_count; ?> <span>abonné</span></li>
			</ul>
		</div>
	</div>
	<div class="col-lg-9">

		<div id="Tabs">
			<div class="tabs-nav">
				<button class="active" data-nav="activities">Activities</button>
				<button data-nav="badges">Badges</button>
			</div>
			<div class="tabs-content">


				<div class="active" data-tab="activities">
					<?php 
					$comments = get_comments(array(
						//'user_id' => $author_id,
						//'post_type' => 'ad_post',
						//'status' => 'approve',
						'number' => -1,
						'order' => 'DESC'
					));
					$activity_array = array();
					foreach ($comments as $comment) {
						$comment_array = array(
							'id' => $comment->comment_ID,
							'post_id' => $comment->comment_post_ID,
							'title' => get_the_title($comment->comment_post_ID),
							'date' => $comment->comment_date_gmt,
							'link'=> get_comment_link( $comment->comment_ID ),
							'type'=> 'comment',
						);
						array_push($activity_array, $comment_array);
					}

					// The Query
					$the_query = new WP_Query( array (
						'suppress_filters' => true,
						'post_type' => 'ad_post',
						'post_status' => 'publish',
						'posts_per_page' => -1,
					) );
					// The Loop
					if ( $the_query->have_posts() ) {
						$the_query->the_post();
						$ad_array = array(
							'id' => get_the_ID(),
							'post_id' => get_the_ID(),
							'title' => get_the_title(),
							'date' => get_post_time('Y-m-d h:m:s', true),
							'link'=> get_the_permalink(),
							'type' => 'ad'
						);
						array_push($activity_array, $ad_array);
					}
					/* Restore original Post Data */
					wp_reset_postdata();
					function sortFunction( $b, $a ) {
						return strtotime($a['date']) - strtotime($b['date']);
					}
					usort($activity_array, "sortFunction");   //Here You can use asort($data,"sortFunction")

					if ($activity_array) {
						echo "<ul class='sa_activities-list'>";
						foreach($activity_array as $activity) {
							if ($activity['type'] == 'ad') { 
								$pre_message = 'a posté un deal';
								$icon = 'fa-plus';
							} else {
								$pre_message = 'a commenté le deal';
								$icon = 'fa-comment';
							}
							echo "<li class='item'><a href='".esc_url($activity['url'])."'>";
							if (has_post_thumbnail()) {
								echo get_the_post_thumbnail( $activity['id'], 'thumbnail', array( ) );
							} else {
								echo "<img src='".esc_url(adforest_get_ad_default_image_url('adforest-ads-medium'))."' />";
							}
							echo "<div><span class='message'>".get_the_author_meta('display_name', $activity['id']) . "&nbsp" . $pre_message ."&nbsp;:<b>{$activity['title']}</b></span>";
							echo "<span class='date'><i class='fa $icon'></i> ".to_elapsed_time(strtotime($activity['date']))." ago</span></div></a></li>";
						}
						echo "</ul>";
					}
					?>
				</div>

				<div data-tab="badges">
					<div class="seller-badges">
						<?php 
						$badges = sa_get_author_badges($author->ID);
						foreach ( $badges as $key => $badge ) {
							echo "
					<div class='item'>
						<span class='bdg ". ( $badge['status'] ? 'bdg_1'.$key : 'bdg_0'.$key ) ."'></span>
						<div class='detail'>
							<h4>".$badge['title']."</h4>
							<p>".$badge['description']."</p>
						</div>
					</div>
					";
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 
<?php