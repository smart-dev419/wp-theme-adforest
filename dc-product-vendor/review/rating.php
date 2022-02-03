<?php
/**
 * Vendor Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/dc-product-vendor/review/rating.php.
 *
 * HOWEVER, on occasion WC Marketplace will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 *
 * @author  WC Marketplace
 * @package dc-woocommerce-multi-vendor/Templates
 * @version 3.3.5
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $WCMp;
$rating      = round( $rating_val_array['avg_rating'], 1 );
$count       = intval( $rating_val_array['total_rating'] );
$rating_type = $rating_val_array['rating_type'];
if ( $rating_type == 'product-rating' ) {
	$review_text = $count > 1 ? __( 'Products reviews', 'dc-woocommerce-multi-vendor' ) : __( 'Product review', 'dc-woocommerce-multi-vendor' );
} else {
	$review_text = $count > 1 ? __( 'Reviews', 'dc-woocommerce-multi-vendor' ) : __( 'Review', 'dc-woocommerce-multi-vendor' );
}

?>
<div style="clear:both; width:100%;"></div>
<?php if ( $count > 0 ) {
	$star_text = __( 'Stars', 'dc-woocommerce-multi-vendor' );
	?>
    <span class="wcmp_total_rating_number"><?php echo  sprintf( ' %s %s', $rating, $star_text ); ?></span>
<?php } ?>
<a href="#<?php echo  adforest_returnEcho( ( $rating_type != 'product-rating' ) ? 'reviews' : ''); ?>">
	<?php if ( $count > 0 ) { ?>
        <span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating"
              title="<?php echo sprintf( __( 'Rated %s out of 5', 'dc-woocommerce-multi-vendor' ), $rating ) ?>">
            <span style="width:<?php echo ( round( $rating_val_array['avg_rating'] ) / 5 ) * 100; ?>%"><strong
                        itemprop="ratingValue"><?php echo adforest_returnEcho($rating); ?></strong> <?php _e( 'out of 5', 'dc-woocommerce-multi-vendor' ); ?></span>
        </span>
		<?php echo  sprintf( ' %s %s', $count, $review_text ) ; ?>

		<?php
	} else {
		?>
		<?php echo __( ' No Review Yet ', 'dc-woocommerce-multi-vendor' ); ?>
	<?php } ?>
</a>