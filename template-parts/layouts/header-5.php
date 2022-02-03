<?php
global $adforest_theme;
$sb_sign_in_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_sign_in_page']);
$sb_sign_up_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_sign_up_page']);
$sb_notification_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_notification_page']);
?>
<div class="sb-modern-header">
	<div class="sb-colors-combination-c1">
		<div class="sb-colored-header"> 
			<?php
			$pg_class = 'header-position';
			if (basename(get_page_template()) == 'page-home.php' || is_singular('ad_post')) {
				$pg_class = '';
			}
			?>
			<div class="sb-top-header <?php echo esc_attr($pg_class);?>">
				<nav id="menu-1" class="mega-menu menu-2"> 
					<section class="menu-list-items">
						<div class="container">
							<div class="row">
								<div class="col-lg-12 col-md-12"> 
									<ul class="menu-logo"><li> <?php get_template_part('template-parts/layouts/site', 'logo');?></li></ul>
									<?php get_template_part('template-parts/layouts/main', 'nav');?>
									<div class="sa-search">
										<div class="sa-search-input">
											<i class="fa fa-search"></i>
											<input type="text" name="q" placeholder="Recherche..."/>
										</div>
										<div class="sa-search-results">

										</div>
									</div>
									<div class="sb-header-social-h2">
										<ul class="list-inline">
											<?php if(!is_user_logged_in()) : ?>
											<li class="sb-new-sea-green">
												<button id="btn_register_login" class="btn btn-primary" type="button" data-toggle="modal" data-target=".login-popup"> 
													<i class="fa fa-user"></i> Connexion
												</button>
											</li>
											<?php endif; ?>
											<li class="post-submenu">
												<a class="btn btn-primary"><i class="custom fa fa-plus"></i>Poster...</a>
												<ul>
													<?php if(is_user_logged_in()) : ?>
													<li><a href="/ad-post?type=deal">Deal</a></li>
													<li><a href="/ad-post?type=coupon">Code Promo</a></li>
													<?php else: ?>
													<li><a href="javascript:void(0);" data-toggle="modal" data-target=".login-popup">Deal</a></li>
													<li><a href="javascript:void(0);" data-toggle="modal" data-target=".login-popup">Code Promo</a></li>
													<?php endif; ?>
												</ul>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</section>
				</nav>
			</div>
		</div>
	</div>
</div>	