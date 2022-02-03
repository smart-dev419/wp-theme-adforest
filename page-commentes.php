<?php
/* Template Name: Commented Ads */ 
/**
* The template for displaying latest commented posts page.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package Adforest
*/
?>
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
						</ul>
					</li>
				</div>
			</div>
		</div>
	</section>
</div>

<?php sa_the_ads('latest_commented'); ?>

<?php get_footer(); ?>