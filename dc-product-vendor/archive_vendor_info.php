<?php
/**
 * The template for displaying archive vendor info
 *
 * Override this template by copying it to yourtheme/dc-product-vendor/archive_vendor_info.php
 *
 * @author      WC Marketplace
 * @package     WCMp/Templates
 * @version   2.2.0
 */
global $WCMp, $adforest_theme;
$vendor              = get_wcmp_vendor( $vendor_id );
$vendor_hide_address = apply_filters( 'wcmp_vendor_store_header_hide_store_address', get_user_meta( $vendor_id, '_vendor_hide_address', true ), $vendor->id );
$vendor_hide_phone   = apply_filters( 'wcmp_vendor_store_header_hide_store_phone', get_user_meta( $vendor_id, '_vendor_hide_phone', true ), $vendor->id );
$vendor_hide_email   = apply_filters( 'wcmp_vendor_store_header_hide_store_email', get_user_meta( $vendor_id, '_vendor_hide_email', true ), $vendor->id );
$template_class      = get_wcmp_vendor_settings( 'wcmp_vendor_shop_template', 'vendor', 'dashboard', 'template1' );
$template_class      = apply_filters( 'can_vendor_edit_shop_template', false ) && get_user_meta( $vendor_id, '_shop_template', true ) ? get_user_meta( $vendor_id, '_shop_template', true ) : $template_class;

$vendor_hide_description = '';
$vendor_hide_description = apply_filters( 'wcmp_vendor_store_header_hide_description', get_user_meta( $vendor_id, '_vendor_hide_description', true ), $vendor->id );
/* contact detail in sidebar */
$vendor_telefone = get_user_meta( $vendor_id, '_vendor_phone', true ) ? get_user_meta( $vendor_id, '_vendor_phone', true ) : '';
$vendor_email    = isset( $vendor->user_data->user_email ) ? $vendor->user_data->user_email : '';
$register_date   = isset( $vendor->user_data->user_registered ) ? $vendor->user_data->user_registered : '';

/* Vendor Shop Products */
$vendor_products = ( $vendor->get_products() ) ? $vendor->get_products() : '';

/* Template for Vendor Single Page */
$vendor_temp_custom = isset( $adforest_theme['sb_vendor_templates0'] ) ? $adforest_theme['sb_vendor_templates0'] : '';

$banner_img = ( isset( $banner ) && $banner != '' ) ? $banner : get_template_directory_uri() . '/images/banner_placeholder.jpg';
if ( apply_filters( 'wcmp_vendor_store_header_show_social_links', true, $vendor->id ) ) {
	$vendor_fb_profile          = get_user_meta( $vendor_id, '_vendor_fb_profile', true );
	$vendor_fb_profile          = ( isset( $vendor_fb_profile ) && $vendor_fb_profile != '' ) ? '<a target="_blank" class="facebook img-circle" href="' . $vendor_fb_profile . '"><span class="fab fa-facebook-f"></span></a>' : '';
	$vendor_twitter_profile     = get_user_meta( $vendor_id, '_vendor_twitter_profile', true );
	$vendor_twitter_profile     = ( isset( $vendor_twitter_profile ) && $vendor_twitter_profile != '' ) ? '<a target="_blank" class="linkedin img-circle" href="' . $vendor_twitter_profile . '"><span class="fab fa-linkedin"></span></a>' : '';
	$vendor_linkdin_profile     = get_user_meta( $vendor_id, '_vendor_linkdin_profile', true );
	$vendor_linkdin_profile     = ( isset( $vendor_linkdin_profile ) && $vendor_linkdin_profile ) ? '<a target="_blank" class="twitter img-circle  active" href="' . $vendor_linkdin_profile . '"><span class="fab fa-twitter"></span></a>' : '';
	$vendor_google_plus_profile = get_user_meta( $vendor_id, '_vendor_google_plus_profile', true );
	$vendor_google_plus_profile = ( isset( $vendor_google_plus_profile ) && $vendor_google_plus_profile ) ? '<a target="_blank" class="google-plus img-circle" href="' . $vendor_google_plus_profile . '"><span class="fa fa-google-plus"></span></a>' : '';
	$vendor_youtube             = get_user_meta( $vendor_id, '_vendor_youtube', true );
	$vendor_youtube             = ( isset( $vendor_youtube ) && $vendor_youtube ) ? '<a class="linkedin img-circle" href="' . $vendor_youtube . '"><span class="fa fa-youtube"></span></a>' : '';
	$vendor_instagram           = get_user_meta( $vendor_id, '_vendor_instagram', true );
	$vendor_instagram           = ( isset( $vendor_instagram ) && $vendor_instagram ) ? '<a class="linkedin img-circle" href="' . $vendor_instagram . '"><span class="fa fa-instagram"></span></a>' : '';
}
$vendor_image = $vendor->get_image( 'image', 'adforest_vendor_img' ) ? $vendor->get_image( 'image', 'adforest_vendor_img' ) : get_template_directory_uri() . '/images/users/qa.png';
$store_name   = apply_filters( 'wcmp_vendor_lists_single_button_text', $vendor->page_title );
/* badge for approved vendor */
$verified_icon = get_template_directory_uri() . '/images/d-tick.png';

/* here we load our custom template from theme option */
if ( $vendor_temp_custom == 1 ) {
	?>
    <section class="wcmpv-deatil-hero padding-top-140"
             style="background-image:url(<?php echo esc_url( $banner_img ); ?>) ; background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;">
        <div class="container">
            <div class="main-wrap">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="user-detail-main">
                            <div class="user-inner">
                                <img src="<?php echo esc_url( $vendor_image ); ?>" class="img-responsive img-full"
                                     alt="<?php echo __( 'No Image', 'adforest' ); ?>"/>
                            </div>
                            <div class="user-detail-text">
                                <h3><a herf="#"><?php echo adforest_returnEcho ($store_name); ?></a>
                                  
                                
                                </h3>
                                <p><?php echo __( 'Last active', 'adforest' ); ?> :
                                    <span><?php echo adforest_get_last_login( $vendor_id ); ?><?php echo __( ' Ago', 'adforest' ); ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="wcmpv-deatil-social clearfix margin-top-30">
							<?php echo adforest_returnEcho($vendor_fb_profile . $vendor_twitter_profile . $vendor_linkdin_profile . $vendor_google_plus_profile . $vendor_youtube . $vendor_instagram); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---->
    <section class="wcmpv-detail section-padding-40">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <aside class="vendor-sidebar">
                        <div id="" class="widget personal-detail">
                            <div class="widget-heading">
                                <h2><?php echo esc_html__( 'Personal Details', 'adforest' ); ?>:</h2>
                                
                            </div>
                            <div class="personal-detail-inner">
                                <ul>
									<?php if ( $vendor_email != '' ) { ?>
                                        <li>
                                            <div class="personal-icon"><img
                                                        src="<?php echo get_template_directory_uri(), '/images/email1.png'; ?>"
                                                        alt="mail-icon"
                                                        class="img-responsive img-full"/></div>
                                            <div class="text-detail">
                                                <span><?php echo esc_html__( 'Email', 'adforest' ); ?>:</span>
                                                <p><?php echo esc_html($vendor_email); ?></p>
                                            </div>
                                        </li>
									<?php } ?>
									<?php if ( $vendor_telefone ) { ?>
                                        <li>
                                            <div class="personal-icon"><img
                                                        src="<?php echo get_template_directory_uri(), '/images/d-phone.png'; ?>"
                                                        alt="mail-icon"
                                                        class="img-responsive img-full"/></div>
                                            <div class="text-detail">
                                                <span><?php echo esc_html__( 'Phone', 'adforest' ); ?>:</span>
                                                <p><?php echo adforest_returnEcho($vendor_telefone); ?></p>
                                            </div>
                                        </li>
									<?php } ?>
									<?php if ( $vendor->get_formatted_address() && $vendor_hide_address != 'Enable' ) { ?>
                                        <li>
                                            <div class="personal-icon"><img
                                                        src="<?php echo get_template_directory_uri(), '/images/location.png'; ?>"
                                                        alt="mail-icon"
                                                        class="img-responsive img-full"/></div>
                                            <div class="text-detail">
                                                <span><?php echo esc_html__( 'Address', 'adforest' ); ?>:</span>
                                                <p><?php echo adforest_returnEcho($vendor->get_formatted_address()); ?></p>
                                            </div>
                                        </li>
										<?php
									} ?>
                                    <!--                                    <li>-->
                                    <!--                                        <div class="personal-icon"><img-->
                                    <!--                                                    src="-->
									<?php //echo get_template_directory_uri(), '/images/d-language.png'; ?><!--"-->
                                    <!--                                                    alt="mail-icon"-->
                                    <!--                                                    class="img-responsive img-full"/></div>-->
                                    <!--                                        <div class="text-detail">-->
                                    <!--                                            <span>Language:</span>-->
                                    <!--                                            <p>English,Urdu,Hindi</p>-->
                                    <!--                                        </div>-->
                                    <!--                                    </li>-->
									<?php if ( $register_date != '' ) { ?>
                                        <li>
                                            <div class="personal-icon"><img
                                                        src="<?php echo get_template_directory_uri(), '/images/clander.png'; ?>"
                                                        alt="mail-icon"
                                                        class="img-responsive img-full"/></div>
                                            <div class="text-detail">
                                                <span>Member Since:</span>
                                                <p><?php echo date( get_option( 'date_format' ), strtotime( $register_date ) ); ?></p>
                                            </div>
                                        </li>
									<?php } ?>
                                </ul>
                                <!--                                <div class="follow-btn"><a href="post-ad-1.html" class="btn btn-theme">Follow</a>-->
                                <!--                                </div>-->
                            </div>
                        </div>

                        <div id="" class="widget form-detail">
                            <div class="widget-heading">
                                <h2><?php echo esc_html__( 'Contact Us', 'adforest' ); ?>:</h2>
                                
                            </div>
                            <div class="form-inner">
                                <div class="form-submit">
                                    <form id="vendro-owner-contact" class="vendro-owner-contact"
                                          name="vendro-owner-contact" method="post">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-plh"
                                                           placeholder="<?php echo esc_html__( "Your Name", 'adforest' ); ?>"
                                                           name="u_name" id="u_name" data-parsley-required="true"
                                                           data-parsley-error-message="<?php echo __( 'This field is required.', 'adforest' ); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control input-plh"
                                                           placeholder="<?php echo esc_html__( "Email Address", 'adforest' ); ?>"
                                                           name="u_email" id="u_email" data-parsley-required="true"
                                                           data-parsley-error-message="<?php echo __( 'This field is required.', 'adforest' ); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control input-plh"
                                                           placeholder="<?php echo esc_html__( "Subject", 'adforest' ); ?>"
                                                           name="u_subject" id="u_subject">
                                                </div>
                                                <div class="form-group">
                                                        <textarea class="form-control input-plh" rows="3" id="u_mesage"
                                                                  name="u_mesage"
                                                                  placeholder="<?php echo esc_html__( "Your Message", 'adforest' ); ?>"
                                                                  data-parsley-required="true"
                                                                  data-parsley-error-message="<?php echo __( 'This field is required.', 'adforest' ); ?>"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 reqt">
                                                <input type="hidden" id="vendor_id" name="vendor_id"
                                                       value="<?php echo esc_attr( $vendor_id ); ?>"/>
                                                <button type="submit"
                                                        vendor-contact-<?php echo esc_attr( $vendor_id ); ?>" class="btn
                                                btn-theme"><?php echo esc_html__( "Contact Now", 'adforest' ); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
						<?php
						$baner_img      = isset( $adforest_theme['sb_vendor_detail_baner_img']['url'] ) ? $adforest_theme['sb_vendor_detail_baner_img']['url'] : '';
						$baner_img_link = isset( $adforest_theme['sb_vendor_detail_baner_link'] ) ? $adforest_theme['sb_vendor_detail_baner_link'] : '';
						if ( $baner_img != '' && $baner_img_link != '' ) {
							?>
                            <div class="banner-sibar-detail">
                                <a href="<?php echo esc_url( $baner_img_link ); ?>" target="_blank"><img
                                            src="<?php echo esc_url( $baner_img ); ?>"
                                            alt="<?php echo esc_html__( 'No Image', 'adforest' ); ?>"
                                            class="img-responsive img-full"/></a>
                            </div>
						<?php } ?>
                    </aside>
                </div>
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <!---detail-tabs-start-->
                    <div class="detail-tabs">
                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs">
									<?php
									if ( ! $vendor_hide_description && ! empty( $description ) && $description != '' ) {
										?>
                                        <li><a href="#abs"
                                               class="cl-class acmenu-pro-6"><?php echo esc_html__( 'About us', 'adforest' ); ?></a>
                                        </li>
										<?php
									}
									?>
									<?php if ( $vendor_products != '' ) { ?>
                                        <li><a href="#brnds"
                                               class="cl-class"><?php echo esc_html__( 'Brand Shop', 'adforest' ); ?></a>
                                        </li>
									<?php } ?>
                                    <li><a href="#review"
                                           class="cl-class ">
			                                <?php echo esc_html__( 'Reviews', 'adforest' ); ?></a>
                                    </li>
                                    <!--                                    <li><a href="#wreview"-->
                                    <!--                                           class="cl-class">-->
									<?php //echo esc_html__( 'Write a Review', 'adforest' ); ?><!--</a>-->
                                    <!--                                    </li>-->
                                </ul>
                            </div>
							<?php
							if ( ! $vendor_hide_description && ! empty( $description ) && $description != '' ) {
								?>
                                <div class="panel-main">
                                    <div class="tab-content">
                                        <div id="abs">
                                            <h3><?php echo esc_html__( 'About us', 'adforest' ); ?></h3>
                                            <p><?php echo htmlspecialchars_decode( wpautop( $description ), ENT_QUOTES ); ?></p>
                                        </div>
                                    </div>
                                </div>
								<?php
							}
							?>
                        </div>
                    </div>
                    <!---detail-tabs-close-->

                    <!---Brands--shop-start-->
					<?php if ( $adforest_theme['sb_vendor_show_shop_prod'] == true ) {
						$num_vendor_prod_show = isset( $adforest_theme['num_vendor_prod_show'] ) ? $adforest_theme['num_vendor_prod_show'] : 6;
						if ( $vendor_products != '' && count( $vendor_products ) > 0 ) {
							?>
                            <div id="brnds" class="detial-brands-shop">
                                <div class="brand-heading">
                                    <h3><?php echo esc_html__( 'Brand Shop', 'adforest' ); ?></h3>
                                </div>
                                <ul class="brans-ul">
									<?php
									$args     = array(
										'post_type'      => 'product',
										'post_status'    => 'publish',
										'posts_per_page' => $num_vendor_prod_show,
										'author'         => $vendor_id, //change your vendor id here
									);
									$products = new WP_Query( $args );
									if ( $products->have_posts() ) {
										while ( $products->have_posts() ) {
											$products->the_post();
											$product_id = get_the_ID();
											global $product;
											$currency       = get_woocommerce_currency_symbol();
											$price          = $product->get_regular_price();
											$sale           = $product->get_sale_price();
											$newness_days   = 30;
											$created        = strtotime( $product->get_date_created() );
											$new_badge_html = '';
											if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
												$new_badge_html = '<div class="ribbon-container"><a href="javascript:void(0);" class="ribbon">' . __( "New", "adforest" ) . '</a></div>';
											}
											$prod_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'adforest-vendor_page_prod_img' );
											$product_typee  = adforest_get_product_type( $product_id );
											if ( isset( $product_typee ) && $product_typee == 'variable' ) {
												$available_variations = $product->get_available_variations();
												if ( isset( $available_variations[0]['variation_id'] ) && ! empty( $available_variations[0]['variation_id'] ) ) {
													$variation_id      = $available_variations[0]['variation_id'];
													$variable_product1 = new WC_Product_Variation( $variation_id );
													$price             = $variable_product1->get_regular_price();
													$sale              = $variable_product1->get_sale_price();
												}
											}
											$sale_price    = ( $sale ) ? '<span>' . esc_html( adforest_shopPriceDirection( $sale, $currency ) ) . '&nbsp;</span>' : '';
											$regular_price = ( $price ) ? '<strike>' . esc_html( adforest_shopPriceDirection( $price, $currency ) ) . '</strike>' : '';
											if ( ! $sale ) {
												$regular_price = ( $price ) ? '<span>' . esc_html( adforest_shopPriceDirection( $price, $currency ) ) . '</span>' : '';
											}

											$prod_link  = get_the_permalink( $product_id );
											$prod_title = get_the_title( $product_id );
											/* check already favourite or not */
											$fav_class = '';
											if ( get_user_meta( get_current_user_id(), '_product_fav_id_' . $product_id, true ) == $product_id ) {
												$fav_class = 'favourited';
											}
											?>
                                            <li>
                                                <div class="arrival-main">
                                                    <div class="arrival-images">
                                                        <img src="<?php echo esc_url($prod_image_src[0]); ?>"
                                                             alt="<?php echo get_the_title( $product_id ); ?>"
                                                             class="img-responsive">
														<?php echo adforest_returnEcho($new_badge_html); ?>
                                                    </div>
                                                    <div class="arrival-detail">
                                                        <p><?php echo adforest_get_woo_categories( $product_id ); ?></p>
                                                        <h3>
                                                            <a href="<?php echo esc_url( $prod_link ); ?>"><?php echo esc_html($prod_title); ?></a>
                                                        </h3>
                                                        <div class="shop-old-price"><?php echo adforest_returnEcho($regular_price); ?></div>
                                                        <span><?php echo adforest_returnEcho($sale_price); ?> </span>
                                                    </div>
                                                    <div class="arrival-cart">
                                                        <ul class="ul-cart">
                                                            <li class="cart-btn"><a
                                                                        href="<?php echo esc_url( $prod_link ); ?>"
                                                                        class="btn btn-theme"><?php echo __( 'Add to Cart', 'adforest' ); ?></a>
                                                            </li>
                                                            <li class="favorite"><a href="javascript:void(0);"
                                                                                    data-productId="<?php echo adforest_returnEcho($product_id); ?>"
                                                                                    class="product_to_fav fav-link btn btn-theme <?php echo esc_attr($fav_class); ?>">
                                                                    <i class="fa fa-heart" aria-hidden="true"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
										<?php }
									} ?>
                                </ul>
                            </div>
						<?php }
					} ?>
                    <!---Brands--shop-close-->

                    <!--Brands--Rating-Review-start-->
                    <div class="detail-rating-review">
                        <div id="review">
                            <div class="review-heading"><h3><?php echo __( 'Rating Reviews', 'adforest' ); ?></h3></div>
                            <div class="ad-main-content">
								<?php
								if ( get_wcmp_vendor_settings( 'is_sellerreview', 'general' ) == 'Enable' ) {
                                                                    
                                                                   
									$queried_object = get_queried_object();
									if ( isset( $queried_object->term_id ) && ! empty( $queried_object ) ) {
										$rating_val_array = wcmp_get_vendor_review_info( $queried_object->term_id );
										$WCMp->template->get_template( 'review/rating.php', array( 'rating_val_array' => $rating_val_array ) );
									}
                                                                        
                                                                       
								}
                                                                
                                                                 else {
                                                                            
                                                                            echo esc_html__('No review available yet','adforest');
                                                                            
                                                                        }
								?>
                            </div>
                        </div>
                    </div>
                    <!--Brands--Rating-Review-close-->
                </div>
            </div>
        </div>
    </section>
	<?php
} else {
	?>
    <div class="vendor_description_background wcmp_vendor_banner_template <?php echo esc_attr($template_class); ?>">
        <div class="wcmp_vendor_banner">
			<?php
			if ( $banner != '' ) {
				?>
                <img src="<?php echo esc_url( $banner ); ?>" alt="<?php echo esc_attr( $vendor->page_title ) ?>">
				<?php
			} else {
				?>
                <img src="<?php echo esc_url($WCMp->plugin_url . 'assets/images/banner_placeholder.jpg'); ?>"
                     alt="<?php echo esc_attr( $vendor->page_title ) ?>">
				<?php
			}
			?>

			<?php if ( apply_filters( 'wcmp_vendor_store_header_show_social_links', true, $vendor->id ) ) : ?>
                <div class="wcmp_social_profile">
					<?php
					$vendor_fb_profile          = get_user_meta( $vendor_id, '_vendor_fb_profile', true );
					$vendor_twitter_profile     = get_user_meta( $vendor_id, '_vendor_twitter_profile', true );
					$vendor_linkdin_profile     = get_user_meta( $vendor_id, '_vendor_linkdin_profile', true );
					$vendor_google_plus_profile = get_user_meta( $vendor_id, '_vendor_google_plus_profile', true );
					$vendor_youtube             = get_user_meta( $vendor_id, '_vendor_youtube', true );
					$vendor_instagram           = get_user_meta( $vendor_id, '_vendor_instagram', true );
					?>
					<?php if ( $vendor_fb_profile ) { ?> <a target="_blank"
                                                            href="<?php echo esc_url( $vendor_fb_profile ); ?>"><i
                                class="wcmp-font ico-facebook-icon"></i></a><?php } ?>
					<?php if ( $vendor_twitter_profile ) { ?> <a target="_blank"
                                                                 href="<?php echo esc_url( $vendor_twitter_profile ); ?>">
                            <i class="wcmp-font ico-twitter-icon"></i></a><?php } ?>
					<?php if ( $vendor_linkdin_profile ) { ?> <a target="_blank"
                                                                 href="<?php echo esc_url( $vendor_linkdin_profile ); ?>">
                            <i class="wcmp-font ico-linkedin-icon"></i></a><?php } ?>
					<?php if ( $vendor_google_plus_profile ) { ?> <a target="_blank"
                                                                     href="<?php echo esc_url( $vendor_google_plus_profile ); ?>">
                            <i class="wcmp-font ico-google-plus-icon"></i></a><?php } ?>
					<?php if ( $vendor_youtube ) { ?> <a target="_blank"
                                                         href="<?php echo esc_url( $vendor_youtube ); ?>"><i
                                class="wcmp-font ico-youtube-icon"></i></a><?php } ?>
					<?php if ( $vendor_instagram ) { ?> <a target="_blank"
                                                           href="<?php echo esc_url( $vendor_instagram ); ?>"><i
                                class="wcmp-font ico-instagram-icon"></i></a><?php } ?>
					<?php do_action( 'wcmp_vendor_store_header_social_link', $vendor_id ); ?>
                </div>
			<?php endif; ?>

			<?php
			if ( $template_class == 'template1' ) {
				?>
                <div class="vendor_description">
                    <div class="vendor_img_add">
                        <div class="img_div"><img
                                    src=<?php echo esc_url($profile); ?> alt="<?php echo esc_attr( $vendor->page_title ) ?>"/>
                        </div>
                        <div class="vendor_address">
                            <p class="wcmp_vendor_name"><?php echo adforest_returnEcho($vendor->page_title) ?></p>
							<?php do_action( 'before_wcmp_vendor_information', $vendor_id ); ?>
                            <div class="wcmp_vendor_rating">
								<?php
								if ( get_wcmp_vendor_settings( 'is_sellerreview', 'general' ) == 'Enable' ) {
									$queried_object = get_queried_object();
									if ( isset( $queried_object->term_id ) && ! empty( $queried_object ) ) {
										$rating_val_array = wcmp_get_vendor_review_info( $queried_object->term_id );
										$WCMp->template->get_template( 'review/rating.php', array( 'rating_val_array' => $rating_val_array ) );
									}
								}
								?>
                            </div>
							<?php if ( ! empty( $location ) && $vendor_hide_address != 'Enable' ) { ?><p
                                    class="wcmp_vendor_detail"><i
                                        class="wcmp-font ico-location-icon"></i><label><?php echo esc_html($location); ?></label>
                                </p><?php } ?>
							<?php if ( ! empty( $mobile ) && $vendor_hide_phone != 'Enable' ) { ?><p
                                    class="wcmp_vendor_detail"><i
                                        class="wcmp-font ico-call-icon"></i><label><?php echo apply_filters( 'vendor_shop_page_contact', $mobile, $vendor_id ); ?></label>
                                </p><?php } ?>
							<?php if ( ! empty( $email ) && $vendor_hide_email != 'Enable' ) { ?><a
                                href="mailto:<?php echo apply_filters( 'vendor_shop_page_email', $email, $vendor_id ); ?>"
                                class="wcmp_vendor_detail"><i
                                        class="wcmp-font ico-mail-icon"></i><?php echo apply_filters( 'vendor_shop_page_email', $email, $vendor_id ); ?>
                                </a><?php } ?>
							<?php
							if ( apply_filters( 'is_vendor_add_external_url_field', true, $vendor->id ) ) {
								$external_store_url   = get_user_meta( $vendor_id, '_vendor_external_store_url', true );
								$external_store_label = get_user_meta( $vendor_id, '_vendor_external_store_label', true );
								if ( empty( $external_store_label ) ) {
									$external_store_label = __( 'External Store URL', 'dc-woocommerce-multi-vendor' );
								}
								if ( isset( $external_store_url ) && ! empty( $external_store_url ) ) {
									?><p class="external_store_url"><label><a target="_blank"
                                                                              href="<?php echo apply_filters( 'vendor_shop_page_external_store', esc_url_raw( $external_store_url ), $vendor_id ); ?>"><?php echo esc_html($external_store_label); ?></a></label>
                                    </p><?php
								}
							}
							?>
							<?php do_action( 'after_wcmp_vendor_information', $vendor_id ); ?>
							<?php
							$vendor_hide_description = apply_filters( 'wcmp_vendor_store_header_hide_description', get_user_meta( $vendor_id, '_vendor_hide_description', true ), $vendor->id );
							if ( ! $vendor_hide_description && ! empty( $description ) && $template_class != 'template1' ) {
								?>
                                <div class="description_data">
									<?php echo htmlspecialchars_decode( wpautop( $description ), ENT_QUOTES ); ?>
                                </div>
							<?php } ?>
                        </div>
                    </div>
                </div>
				<?php
			}
			?>
        </div>

		<?php
		if ( $template_class != 'template1' ) {
			?>
            <div class="vendor_description">
                <div class="vendor_img_add">
                    <div class="img_div"><img
                                src=<?php echo esc_url( $profile ); ?> alt="<?php echo esc_attr( $vendor->page_title ) ?>"/>
                    </div>
                    <div class="">
                        <p class="wcmp_vendor_name"><?php echo esc_html( $vendor->page_title ) ?></p>
						<?php do_action( 'before_wcmp_vendor_information', $vendor_id ); ?>
                        <div class="wcmp_vendor_rating">
							<?php
							if ( get_wcmp_vendor_settings( 'is_sellerreview', 'general' ) == 'Enable' ) {
								$queried_object = get_queried_object();
								if ( isset( $queried_object->term_id ) && ! empty( $queried_object ) ) {
									$rating_val_array = wcmp_get_vendor_review_info( $queried_object->term_id );
									$WCMp->template->get_template( 'review/rating.php', array( 'rating_val_array' => $rating_val_array ) );
								}
							}
							?>
                        </div>
						<?php if ( ! empty( $location ) && $vendor_hide_address != 'Enable' ) { ?><p
                                class="wcmp_vendor_detail"><i
                                    class="wcmp-font ico-location-icon"></i><label><?php echo esc_html( $location ); ?></label>
                            </p><br/><?php } ?>
						<?php if ( ! empty( $mobile ) && $vendor_hide_phone != 'Enable' ) { ?><p
                                class="wcmp_vendor_detail"><i
                                    class="wcmp-font ico-call-icon"></i><label><?php echo apply_filters( 'vendor_shop_page_contact', $mobile, $vendor_id ); ?></label>
                            </p><?php } ?>
						<?php if ( ! empty( $email ) && $vendor_hide_email != 'Enable' ) { ?><a
                            href="mailto:<?php echo apply_filters( 'vendor_shop_page_email', $email, $vendor_id ); ?>"
                            class="wcmp_vendor_detail"><i
                                    class="wcmp-font ico-mail-icon"></i><?php echo apply_filters( 'vendor_shop_page_email', $email, $vendor_id ); ?>
                            </a><?php } ?>
						<?php
						if ( apply_filters( 'is_vendor_add_external_url_field', true, $vendor->id ) ) {
							$external_store_url   = get_user_meta( $vendor_id, '_vendor_external_store_url', true );
							$external_store_label = get_user_meta( $vendor_id, '_vendor_external_store_label', true );
							if ( empty( $external_store_label ) ) {
								$external_store_label = __( 'External Store URL', 'dc-woocommerce-multi-vendor' );
							}
							if ( isset( $external_store_url ) && ! empty( $external_store_url ) ) {
								?><p class="external_store_url"><label><a target="_blank"
                                                                          href="<?php echo apply_filters( 'vendor_shop_page_external_store', esc_url_raw( $external_store_url ), $vendor_id ); ?>"><?php echo esc_html( $external_store_label ); ?></a></label>
                                </p><?php
							}
						}
						?>
						<?php do_action( 'after_wcmp_vendor_information', $vendor_id ); ?>
						<?php
						$vendor_hide_description = apply_filters( 'wcmp_vendor_store_header_hide_description', get_user_meta( $vendor_id, '_vendor_hide_description', true ), $vendor->id );
						if ( ! $vendor_hide_description && ! empty( $description ) && $template_class != 'template1' ) {
							?>
                            <div class="description_data">
								<?php echo htmlspecialchars_decode( wpautop( $description ), ENT_QUOTES ); ?>
                            </div>
						<?php } ?>
                    </div>
                </div>
            </div>
			<?php
		}
		?>

		<?php
		$vendor_hide_description = apply_filters( 'wcmp_vendor_store_header_hide_description', get_user_meta( $vendor_id, '_vendor_hide_description', true ), $vendor->id );

		if ( ! $vendor_hide_description && ! empty( $description ) && $template_class == 'template1' ) {
			?>
            <div class="description_data">
				<?php echo htmlspecialchars_decode( wpautop( $description ), ENT_QUOTES ); ?>
            </div>
		<?php }
		do_action( 'after_wcmp_vendor_description', $vendor_id );
		?>
    </div>
	<?php
}