<?php get_header(); ?>
<?php global $adforest_theme; ?>

<div class="sa-after-header">
	<section class="sa-header-categories">
		<div class="row">
			<div class="container">
				<?php 
				$cats = get_terms( 
					array(
						'taxonomy' => 'ad_cats',
						'orderby' => 'name',
						'order'   => 'ASC',
						'hide_empty' => 1,
					) 
				);
				echo "<ul id='owl-header-categories' class='owl-header-categories owl-carousel'>";
					foreach ($cats as $cat) {
						
						$cat_meta = get_option("taxonomy_term_$cat->term_id");
						$icon = (isset($cat_meta['ad_cat_icon'])) ? $cat_meta['ad_cat_icon'] : '';
						echo "<li class='item'>";
						echo "<a href='".esc_url( get_category_link( $cat->term_id ) )."'>";
						if ($icon) echo "<i class='$icon'></i>";
						echo "<span>".$cat->name."</span>";
						echo "</a>";
						echo "</li>";
					}
				echo "</ul>";

				?>
			</div>
		</div>
	</section>
	<section class="sa-header-filters">
		<div class="row">
			<div class="container">
				<div id="filters">
					<li><a class="<?php echo esc_attr(is_active('/')); ?>" href="/">A la lune</a></li>
					<li><a class="<?php echo esc_attr(is_active('/hot/')); ?>" href="/hot">Hot</a></li>
					<li><a class="<?php echo esc_attr(is_active('/nouveaux/')); ?>" href="/nouveaux">Nouveaux</a></li>
					<li><a class="<?php echo esc_attr(is_active('/commentes/')); ?>" href="/commentes">Commentes</a></li>
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
		                    <li class="filter-list">
		                    	<div>
		                    		<?php
				                    	$taxonomies = get_terms( array(
										    'taxonomy' => 'ad_country',
										    'hide_empty' => false
										) );
										 
										if ( !empty($taxonomies) ) :
										    $output = '<select name="ht-country[]" id="ht-country" class="ht-country" multiple="multiple">';
										    foreach( $taxonomies as $category ) {
										        if( $category->parent == 0 ) {
										            $output.= '<optgroup label="'. esc_attr( $category->name ) .'">';
										            foreach( $taxonomies as $subcategory ) {
										                if($subcategory->parent == $category->term_id) {
										                	foreach ($taxonomies as $subcategory2) {
										                		if($subcategory2->parent == $subcategory->term_id){
										                			$output.= '<option value="'. esc_attr( $subcategory2->term_id ) .'">
										                    '. esc_html( $subcategory2->name ) .'</option>';
										                		}
										                	}
										                }
										            }
										            $output.='</optgroup>';
										        }
										    }
										    $output.='</select>';
										    echo $output;
										endif;
					                    ?>
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

<?php sa_the_ads(); ?>

<?php get_footer(); ?>