<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */
if (!defined('ABSPATH')) {
    exit;
}

global $adforest_theme;
$layoutStyle = (isset($adforest_theme['shop-layout-style']) && $adforest_theme['shop-layout-style'] == true) ? $adforest_theme['shop-layout-style'] : 'layout1';

$ext_class   =   "";


if($layoutStyle == "layout4"){
   
    $ext_class   =  "wcmpv-new-arrival";
    
}

if (isset($adforest_theme['shop-turn-on']) && $adforest_theme['shop-turn-on']) {
    get_header();
    ?>
    <div class="main-content-area clearfix"  > 
        <section class="section-padding modern-version <?php echo esc_attr($ext_class); ?>"> 
            <div class="container">
                <div class="row"> 
                    <div class="col-md-8 col-xs-12 col-sm-12"> 
                        <div class="row-class">
                            <?php if (have_posts()) { ?>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                        <?php do_action('woocommerce_before_shop_loop'); ?>
                                    </div>
                                </div>
                                <?php
                                echo '<div class="row clear-custom">';
                                while (have_posts()) {

                                    the_post();
                                    global $product;
                                    $product_id = get_the_ID();
                                    $product_type = wc_get_product($product_id);

                                    $currency = get_woocommerce_currency_symbol();
                                    //$price = get_post_meta(get_the_ID(), '_regular_price', true);
                                    //$sale = get_post_meta(get_the_ID(), '_sale_price', true);
                                    $price = $product->get_regular_price();
                                    $sale = $product->get_sale_price();
                                    $product_typee = adforest_get_product_type(get_the_ID());
                                    if (isset($product_typee) && $product_typee == 'variable') {
                                        $available_variations = $product->get_available_variations();
                                        if (isset($available_variations[0]['variation_id']) && !empty($available_variations[0]['variation_id'])) {
                                            $variation_id = $available_variations[0]['variation_id'];
                                            $variable_product1 = new WC_Product_Variation($variation_id);
                                            $price = $variable_product1->get_regular_price();
                                            $sale = $variable_product1->get_sale_price();
                                        }
                                    }
                                    

                                    if ($layoutStyle == 'layout2') {
                                        ?>

                                        <div class="col-lg-4 col-xs-12 col-md-4 col-sm-6">
                                            <div class="shop-main-section">
                                                <div class="shop-products">                       	<?php if (get_the_post_thumbnail(get_the_ID())) { ?>
                                                        <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'adforest-shop-thumbnail'); ?></a>
                                                    <?php } else { ?>
                                                        <a href="<?php echo esc_url(get_the_permalink()); ?>"><img class="img-responsive" alt="<?php echo get_the_title(); ?>" src="<?php echo esc_url(wc_placeholder_img_src()); ?>"></a>
                                                    <?php } ?>
                                                    <div class="shop-main-title-area">
                                                        <?php if ($sale) { ?>
                                                            <div class="shop-new-product-area"><span><?php echo __("Sale", "adforest"); ?></span></div>
                                                        <?php } ?>                                      
                                                    </div>
                                                </div>
                                                <div class="shop-text-section">
                                                    <div class="shop-lates-products"> <a href="#">
                                                            <p><?php echo adforest_get_woo_categories(get_the_ID()); ?></p>
                                                        </a> </div>
                                                    <div class="shop-categories">
                                                        <h5><a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h5>
                                                    </div>
                                                    <div class="shop-latest-price">

                                                        <?php if ($price) { ?>
                                                            <?php if ($sale) { ?>
                                                                <div class="shop-old-price"><strike><?php echo esc_html(adforest_shopPriceDirection($price, $currency)); ?></strike> </div>
                                                            <?php } else { ?>
                                                                <?php echo ' <div class="shop-new-price">' . "<p>" . esc_html(adforest_shopPriceDirection($price, $currency)) . "</p></div>"; ?>
                                                            <?php } ?>
                                                        <?php } ?>                          
                                                                <?php if ($sale) { ?>  <div class="shop-new-price"><p><?php echo esc_html(adforest_shopPriceDirection($sale, $currency)); ?>&nbsp;</p></div><?php } ?>

                                                    </div>
                                                    <div class="shops-cart"> <a href="<?php echo esc_url(get_the_permalink()); ?>"><i class="fa fa-cart-plus"></i></a> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    } else if ($layoutStyle == 'layout3') {
                                        ?>
                                        <div class="col-lg-4 col-xs-12 col-md-4 col-sm-6">
                                            <div class="tech-great-products">
                                                <div class="tech-new-arrivals-products"> <?php if (get_the_post_thumbnail(get_the_ID())) { ?>
                                                        <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'adforest-shop-thumbnail'); ?></a>
                                                    <?php } else { ?>
                                                        <a href="<?php echo esc_url(get_the_permalink()); ?>"><img class="img-responsive" alt="<?php echo get_the_title(); ?>" src="<?php echo esc_url(wc_placeholder_img_src()); ?>"></a>
                                                    <?php } ?></div>
                                                <div class="tech-products-details">
                                                    <div class="tech-products-categories">
                                                        <h4><?php echo adforest_get_woo_categories(get_the_ID()); ?></h4>
                                                    </div>
                                                    <div class="tech-different-categories">
                                                        <h3><a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
                                                    </div>
                                                    <div class="tech-price-categories">
                                                        <div class="tech-new-prices">

                                                            <p>
                                                                <?php if ($price) { ?>
                                                                    <?php if ($sale) { ?>
                                                                    <strike><?php echo esc_html(adforest_shopPriceDirection($price, $currency)); ?></strike>
                                                                <?php } else { ?>
                                                                    <?php echo esc_html(adforest_shopPriceDirection($price, $currency)); ?>
                                                                <?php } ?>
                                                            <?php } ?>                          
                                                                <?php if ($sale) { ?>  <?php echo esc_html(adforest_shopPriceDirection($sale, $currency)); ?>&nbsp;<?php } ?>                            
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tech-arrival-tech-categories"> 
                                                    <a href="<?php echo esc_url(get_the_permalink()); ?>" class="btn btn-theme">
                                                        <?php echo __("View Product", "adforest"); ?>
                                                    </a> </div>
                                                <div class="shop-main-title-area">
                                                    <?php if ($sale) { ?>
                                                        <div class="shop-new-product-area"><span><?php echo __("Sale", "adforest"); ?></span></div>
                                                    <?php } ?>  
                                                </div>
                                            </div>
                                        </div>                    
                                        <?php
                                    } else if ($layoutStyle == "layout4") {

                                        $currency = get_woocommerce_currency_symbol();
                                        $price = $product->get_regular_price();
                                        $sale = $product->get_sale_price();
                                        $newness_days = isset($adforest_theme['shop_newness_product_days']) ? $adforest_theme['shop_newness_product_days'] : 30;

                                        $created = strtotime($product->get_date_created());
                                        $new_badge_html = '';
                                        /* here we use static badge date. */
                                        if ((time() - (60 * 60 * 24 * $newness_days)) < $created) {
                                            $new_badge_html = '<div class="ribbon-container"><a href="javascript:void(0);" class="ribbon">' . __("New", "adforest") . '</a></div>';
                                        }
                                        $prod_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'adforest-vendor_page_prod_img');
                                        $prod_img_html = '';
                                        if (isset($prod_image_src) && is_array($prod_image_src)) {
                                            $prod_img_html = '<img src="' . $prod_image_src[0] . '" alt="' . get_the_title($product_id) . '" class="img-responsive"/>';
                                        }

                                        else{
                                            
                                           $prod_img_html   =  '<img class="img-responsive" alt="'.get_the_title().'" src="'. esc_url(wc_placeholder_img_src()).'">' ;
                                        }

                                        $sale_price = ($sale) ? '<span>' . esc_html(adforest_shopPriceDirection($sale, $currency)) . '&nbsp;</span>' : '';
                                        $regular_price = ($price) ? '<strike>' . esc_html(adforest_shopPriceDirection($price, $currency)) . '</strike>' : '';
                                        if (!$sale) {
                                            $regular_price = ($price) ? '<span>' . esc_html(adforest_shopPriceDirection($price, $currency)) . '</span>' : '';
                                        }
                                        /* check already favourite or not */
                                        $fav_class = '';
                                        if (get_user_meta(get_current_user_id(), '_product_fav_id_' . $product_id, true) == $product_id) {
                                            $fav_class = 'favourited';
                                        }

                                echo        '<div class="col-lg-4 col-xs-12 col-md-4 col-sm-6">
                                    <div class= "new-arrival-inner">
                                        <div  class="arrival-ul">
                                        <div class="shop_layout_modern">
                        <div class="arrival-main">
                            
                            <div class="arrival-images">
                                ' . $prod_img_html . '
                                ' . $new_badge_html . '
                            </div>
                            <div class="arrival-detail">
                                <p>' . adforest_get_woo_categories($product_id) . '</p>
                                <h3><a href="' . get_the_permalink($product_id) . '">' . get_the_title($product_id) . '</a></h3>
                                <div class="shop-old-price"> ' . $regular_price . ' &nbsp; </div>
                                <span>' . $sale_price . ' &nbsp; </span>
                            </div>
                            <div class="arrival-cart">
                                <ul class="ul-cart">
                                    <li class="cart-btn"><a href="' . get_the_permalink($product_id) . '" class="btn btn-theme">' . __('Add to Cart', 'adforest') . '</a></li>
                                    <li class="favorite"><a href="javascript:void(0);"  data-productId="' . $product_id . '" class="product_to_fav fav-link btn btn-theme ' . $fav_class . '"> <i
                                                    class="fa fa-heart" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            </div>
                        </div>
                                        </div>
                    </div></div>';
                                      
                                    } else {
                                        ?>
                                        <div class="col-lg-4 col-md-4 col-xs-6 col-sm-12">
                                            <div class="product-description-about">
                                                <div class="shop-box">
                                                    <?php if ($sale) { ?>
                                                        <div class="on-sale"><span><?php echo __("Sale", "adforest"); ?></span></div>
                                                    <?php } ?>
                                                    <?php if (get_the_post_thumbnail(get_the_ID())) { ?>
                                                        <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'adforest-shop-thumbnail'); ?></a>
                                                    <?php } else { ?>
                                                        <a href="<?php echo esc_url(get_the_permalink()); ?>"><img class="img-responsive" alt="<?php echo get_the_title(); ?>" src="<?php echo esc_url(wc_placeholder_img_src()); ?>"></a>
                                                    <?php } ?>
                                                    <div class="shop-overlay-box">
                                                        <div class="shop-icon">
                                                            <a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo get_the_title(); ?>"> <?php echo __("Add to Cart", "adforest"); ?> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-description">
                                                    <div class="product-category"><?php echo adforest_get_woo_categories(get_the_ID()); ?></div>
                                                    <div class="product-description-heading">
                                                        <h3><a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h3>
                                                    </div>
                                                    <div class="product-description-icons">

                                                        <ul class="on-product-custom-stars">
                                                            <li>
                                                                <?php
                                                                $average_rating = $product_type->get_average_rating(false);
                                                                echo adforest_get_woo_stars($average_rating);
                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php echo " " . $product_type->get_review_count(false) . ' ' . __("Review", "adforest"); ?>
                                                            </li>
                                                        </ul>                    
                                                    </div>
                                                    <div class="product-description-text"> 
                                                        <?php if ($sale) { ?> <p><?php echo esc_html(adforest_shopPriceDirection($sale, $currency)); ?>&nbsp;</p><?php } ?>
                                                        <?php if ($price) { ?>
                                                            <?php if ($sale) { ?>
                                                                <strike><?php echo esc_html(adforest_shopPriceDirection($price, $currency)); ?></strike>
                                                            <?php } else { ?>
                                                                <?php echo "<p>" . esc_html(adforest_shopPriceDirection($price, $currency)) . "</p>"; ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                echo '<div class="clearfix"></div>';
                                adforest_pagination();
                                echo '</div>';
                            } else {
                                echo '<p class="woocommerce-info">' . __('No Product Found', 'adforest') . '</p>';
                            }
                            ?>

                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-12"> 
                        <div class="sidebar">
                            <?php if (is_active_sidebar('adforest_woocommerce_widget')) : ?>
                                <?php dynamic_sidebar('adforest_woocommerce_widget'); ?>
                            <?php endif; ?>                   
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php
    get_footer();
} else {
    $sb_packages_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_packages_page']);
    wp_redirect(get_the_permalink($sb_packages_page));
    exit;
}