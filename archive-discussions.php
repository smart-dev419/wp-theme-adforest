<?php 
get_header();
global $adforest_theme; 

$type = (isset($_GET['type']) && !empty($_GET['type'])) ? $_GET['type'] : 'default';

$comments_count = get_comments( array(
	'post_type' => 'discussions',   // Use user_id.
	'count'   => true // Return only the count.
) );
?>

<div class="sa-after-header">
	<section class="sa-header">
		<div class="container">
			<div class="row">
				<div class="left">
					<img src="https://www.dealabs.com/assets/img/default-discussion_6cf1c.svg" />
					<div>
						<h3>Discussions</h3>
						<div>
							<span><i class="fa fa-comments"></i> <?php echo wp_count_posts('discussions')->publish; ?> discussions</span>
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
	<section class="sa-header-filters">
		<div class="row">
			<div class="container">
				<div class="sa-widget">
					<div class="sa-widget-heading">
						<h5>Tous les groupes</h5>
						<button class="btn-hide"><i class="fa fa-eye-slash"></i></button>
					</div>
					<div class="sa-widget_content">
						<?php 
						$groups = get_terms( 
							array(
								'taxonomy' => 'discussion_groups',
								'orderby' => 'name',
								'order'   => 'ASC',
								'hide_empty' => 0,
							) 
						);
						if ($groups) {
							echo "<div id='owl-sa' class='owl-groups owl-carousel owl-sa active'><ul id='sa-groups-slider'>";
							$i = 1;
							foreach ($groups as $group) { // Loop Social Media Data
								$thumb_id = get_term_meta ( $group->term_id, 'group-image-id', true );
								if (empty($thumb_id)) {
									$comment_count = 0;
									$posts_array = get_posts(
										array(
											'posts_per_page' => -1,
											'post_type' => 'discussions',
											'tax_query' => array(
												array(
													'taxonomy' => 'discussion_groups',
													'field' => 'term_id',
													'terms' => $group->term_id,
												)
											)
										)
									);
									foreach($posts_array as $post) {
										$comment_count = $comment_count + $post->comment_count;
									}

									if ($i % 8 === 1 && $i !== 1) echo "</ul><ul id='sa-groups-slider'>";
									echo "<li>";
									echo "<a href='".esc_url( get_category_link( $group->term_id ) )."'>";
									echo wp_get_attachment_image ( $thumb_id, array(150, 150), array('alt' => $group->name) );
									echo "<div><span class='title'>".$group->name."</span>";
									echo "<div class='meta'><span><i class='fa fa-comments'></i>&nbsp;$group->count</span><span><i class='fa fa-comment'></i>&nbsp;$comment_count</span></div></div>";
									echo "</a>";
									echo "</li>";
									$i++;
								}
							}
							echo "</ul>";
							echo '</div>';
						}
						?>
					</div>
				</div>
				<div id="filters">
					<li><a href="/discussions?type=latest">Nouveaux</a></li>
					<li><a href="/discussions?type=latest_commented">Commentes</a></li>
					<li class="filters-btn ht-filter dropdown">
						<button class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<i class="fa fa-sliders"></i>Filter
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<li class='filter-list'>
                        		<span class='ht-see'>Voir:</span>
                        		<span class='ht-bicons '>
                        			<button type='button' class='active'><i class='fas fa-grip-lines'></i></button>
                        			<button type='button' ><i class='fas fa-bars '></i></button>
                        		</span>
                            </li>
						</ul>
					</li>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="sa-after-header ht-sa-after-header">
	<section class="ht-section gray">
		<div class="row">
			<div class="container">
				<span><?php echo __('Les + hot', 'viola'); ?></span>
				<span class='sa-ads-select'>
					<select name='tabs' class='no_select2'>
						<option value='today' selected>Jour</option>
						<option value='week'>Semaine</option>
						<option value='month'>Mois</option>
						<option value='all_time'>Tout</option>
					</select>
				</span>
				<span class='ht-filter'>
                        <div class='dropdown-toggle ht-layoutfilter' type='button' id='f3dropdownmenu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                            <i class='fas fa-cog'></i>
                        </div>
                        <ul class='dropdown-menu ht-dropdown2' aria-labelledby='f3dropdownmenu'>
                            <li class='filter-list'>
                        		<span class='ht-see'>Voir:</span>
                        		<span class='ht-icons'>
                        			<button type='button' class='active'><i class='fas fa-grip-lines'></i></button>
                        			<button type='button' ><i class='fas fa-bars '></i></button>
                        		</span>
                            </li>
                            <li class='filter-list'>
                            	<div class='checkbox'><label><input type='checkbox' class='ht-checkbox'>Caroussel</label></div>
                            </li>
                        </ul>
                </span>
                <?php 
                $the_query = new WP_Query(array(
		            'post_type' => array('ad_post'),
		            'nopaging' => false,
		            'posts_per_page' => 12,
		            'ignore_sticky_posts' => true,
		            'post_status' => 'publish',
		            //'date_query' => array(
		            //array( 'after' => '1 day ago')
		            //)
		        ));
		        if ($the_query->have_posts()) {
		        ?>
		        	<ul  class='owl-header-ht-ad-post owl-carousel active sa-ads-slider' data-tab='today'>
	                	<?php while ($the_query->have_posts()) {
                			$the_query->the_post();?>
		                	<li class='article  ht-article'>
	                			<a href='<?php echo esc_url(get_permalink()); ?>'>
	                				<?php if (has_post_thumbnail()) {
	                    			echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array('class'=>'ht-images'));
	                				} else {
	                    				echo "<img class='ht-images' src='" . esc_url(adforest_get_ad_default_image_url('adforest-ads-medium')) . "' />";
	                				} ?>
	                				<div class='details'>
	                					<span class='title'><?php echo get_the_title(); ?></span>
	                					<div class='price'><?php echo adforest_adPrice(get_the_ID()); ?></div>
	                				</div>
	                			</a>
	                		</li>
                		<?php }?>
	                </ul>
            	<?php } 
            	// The Query
		        $the_query = new WP_Query(array(
		            'post_type' => array('ad_post'),
		            'nopaging' => false,
		            'posts_per_page' => 12,
		            'ignore_sticky_posts' => true,
		            'post_status' => 'publish',
		            'date_query' => array(
		                array('after' => '1 week ago')
		            )
		        ));
		        if ($the_query->have_posts()) {
		        ?>
		        	<ul  class='owl-header-ht-ad-post owl-carousel sa-ads-slider' data-tab='week'>
	                	<?php while ($the_query->have_posts()) {
                			$the_query->the_post();?>
		                	<li class='article  ht-article'>
	                			<a href='<?php echo esc_url(get_permalink()); ?>'>
	                				<?php if (has_post_thumbnail()) {
	                    			echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array('class'=>'ht-images'));
	                				} else {
	                    				echo "<img class='ht-images' src='" . esc_url(adforest_get_ad_default_image_url('adforest-ads-medium')) . "' />";
	                				} ?>
	                				<div class='details'>
	                					<span class='title'><?php echo get_the_title(); ?></span>
	                					<div class='price'><?php echo adforest_adPrice(get_the_ID()); ?></div>
	                				</div>
	                			</a>
	                		</li>
                		<?php }?>
	                </ul>
            	<?php } 
            	// The Query
		        $the_query = new WP_Query(array(
		            'post_type' => array('ad_post'),
		            'nopaging' => false,
		            'posts_per_page' => 12,
		            'ignore_sticky_posts' => true,
		            'post_status' => 'publish',
		            'date_query' => array(
		                array('after' => '1 month ago')
		            )
		        ));
		        if ($the_query->have_posts()) {
		        ?>
		        	<ul  class='owl-header-ht-ad-post owl-carousel sa-ads-slider' data-tab='month'>
	                	<?php while ($the_query->have_posts()) {
                			$the_query->the_post();?>
		                	<li class='article  ht-article'>
	                			<a href='<?php echo esc_url(get_permalink()); ?>'>
	                				<?php if (has_post_thumbnail()) {
	                    			echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array('class'=>'ht-images'));
	                				} else {
	                    				echo "<img class='ht-images' src='" . esc_url(adforest_get_ad_default_image_url('adforest-ads-medium')) . "' />";
	                				} ?>
	                				<div class='details'>
	                					<span class='title'><?php echo get_the_title(); ?></span>
	                					<div class='price'><?php echo adforest_adPrice(get_the_ID()); ?></div>
	                				</div>
	                			</a>
	                		</li>
                		<?php }?>
	                </ul>
            	<?php } 
            	// The Query
		        $the_query = new WP_Query(array(
		            'post_type' => array('ad_post'),
		            'nopaging' => false,
		            'posts_per_page' => 12,
		            'ignore_sticky_posts' => true,
		            'post_status' => 'publish',
		        ));
		        if ($the_query->have_posts()) {
		        ?>
		        	<ul  class='owl-header-ht-ad-post owl-carousel sa-ads-slider' data-tab='all_time'>
	                	<?php while ($the_query->have_posts()) {
                			$the_query->the_post();?>
		                	<li class='article  ht-article'>
	                			<a href='<?php echo esc_url(get_permalink()); ?>'>
	                				<?php if (has_post_thumbnail()) {
	                    			echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array('class'=>'ht-images'));
	                				} else {
	                    				echo "<img class='ht-images' src='" . esc_url(adforest_get_ad_default_image_url('adforest-ads-medium')) . "' />";
	                				} ?>
	                				<div class='details'>
	                					<span class='title'><?php echo get_the_title(); ?></span>
	                					<div class='price'><?php echo adforest_adPrice(get_the_ID()); ?></div>
	                				</div>
	                			</a>
	                		</li>
                		<?php }?>
	                </ul>
            	<?php } 
            	wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
</div>
<?php sa_the_ads($type, false, false, 'discussions'); ?>

<?php get_footer(); ?>