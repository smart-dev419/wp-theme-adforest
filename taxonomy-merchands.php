<?php get_header(); 
global $adforest_theme; 
global $wp;
$category = '';
$category = array(
	array(
		'taxonomy' => 'merchands',
		'field' => 'term_id',
		'terms' => get_queried_object_id(),
		'include_children' => 0,
	),
);
$term_id = get_queried_object_id();
$term = get_term($term_id);
$url = get_term_meta($term->term_id, 'merchand-url', true);
$image_id = get_term_meta($term->term_id, 'merchand-image-id', true);

$type = false;
if ( isset($_GET['type']) && $_GET['type'] == 'deals' ) $type = 'deal';
if ( isset($_GET['type']) && $_GET['type'] == 'coupons' ) $type = 'coupon';
?>
<style>
.small-breadcrumb {
    display: none;
}
</style>
<div class="sa-after-header">
	<section class="sa-header">
		<div class="container">
			<div class="row">
				<div class="left">
					<?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
					<div>
						<h3>Codes promo &amp; Bons plans <?php echo $term->name; ?></h3>
						<div>
							<span><i class="fa fa-fire"></i> Toutes les offres Amazon en Septembre 2021</span>
						</div>
					</div>
				</div>
				<?php if ($url) : ?>
				<div class="right">
					<a class="btn btn-light" href="<?php echo esc_url($url); ?>" target="_blank">Visiter le site</a>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<section class="sa-header-filters">
		<div class="row">
			<div class="container">
				<div id="filters">
					<li><a class="" href="<?php echo home_url( $wp->request ) . '?type=coupons' ?>"><i class="fa fa-scissors"></i>&nbsp;Codes promo</a></li>
					<li><a class="" href="<?php echo home_url( $wp->request ) . '?type=deals'; ?>"><i class="fa fa-tag"></i>&nbsp;Bons plans</a></li>
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
                            <li class='filter-list'>
                            	<div class="form-group">
								    <div class="form-check">
								      	<label class="form-check-label" for="fz_hide_local">
								      		<input class="form-check-input ht-filter1" type="checkbox" id="fz_hide_local" <?php echo isset($_GET['hide_local'] )?'checked="checked"':''; ?> name="hide_local">
								    		Masquer les éléments locaux 
								      	</label>

								    </div>
								</div>
		                    </li>
		                    <li class='filter-list'>
		                    	<div class="form-group">
								    <div class="form-check">
								      	<label class="form-check-label" for="fz_hide_feature">
								      		<input class="form-check-input ht-filter1" name="hide_feature" type="checkbox"  id="fz_hide_feature" <?php echo isset($_GET['hide_feature'] )?'checked="checked"':''; ?>>
								    		Masquer les éléments en vedette
								      	</label>
								    </div>
								</div> 
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
<?php sa_the_ads('category', array('merchands', $term_id), $type); ?>

<?php get_footer(); ?>