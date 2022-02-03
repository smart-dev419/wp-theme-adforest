<div class="counter-seller">
    <div class="row">
        <?php
        global $adforest_theme;
        $allow_whatsapp = isset($adforest_theme['sb_ad_whatsapp_chat']) ? $adforest_theme['sb_ad_whatsapp_chat'] : false;
        $contact_num = get_user_meta($author->ID, '_sb_contact', true);
        ?>
        <div class="col-lg-6">
            <div class="seller-public-profile-text-area">
                <h2><?php echo adforest_get_sold_ads($author->ID); ?></h2>
                <span class="text-details"><?php echo __('Ad Sold', 'adforest'); ?></span> </div>
        </div>
        <div class="col-lg-6">
            <div class="seller-public-profile-text-area-left-side">
                <h2><?php echo adforest_get_all_ads($author->ID); ?></h2>
                <span class="text-details"><?php echo __('Total Listings', 'adforest'); ?></span> </div>
        </div>
        <?php
        if ($contact_num != "") {           
                ?>
        <div class="seller-contact col-lg-12">
            <p><a href="javascript:void(0);" class="sb-click-num-user" id="show_ph_div" data-user_id = "<?php echo esc_attr($author->ID); ?>">
                                <i class="fa fa-mobile-phone" aria-hidden="true"></i>
                                <span class="sb-phonenumber"><?php echo esc_html__('Click To View','adforest') ?></span>
                                                          </a>
                 </p>
                 <?php if($allow_whatsapp){   ?>
                    <span> <a  href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($contact_num); ?>" class="">
                            <i class="fa fa-whatsapp"></i> 
                           
                        </a>
                    </span>                        
                 <?php } ?>
                </div>
                <?php
          
        }
        ?>
    </div>
</div>