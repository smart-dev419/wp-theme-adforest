<?php
global $adforest_theme;
$pid = get_the_ID();


     $ad_conditon_val   =   wp_get_post_terms($pid,'ad_condition');
     $ad_conditon_val   =  (isset($ad_conditon_val[0]->name))  ? $ad_conditon_val[0]->name : get_post_meta($pid, '_adforest_ad_condition', true);


     $ad_warranty_val   =   wp_get_post_terms($pid,'ad_warranty');
     $ad_warranty_val   =  (isset($ad_warranty_val[0]->name))  ? $ad_warranty_val[0]->name : get_post_meta($pid, '_adforest_ad_warranty', true);



     $ad_type_val       =   wp_get_post_terms($pid,'ad_type');
     $ad_type_val   =  (isset($ad_type_val[0]->name))  ? $ad_type_val[0]->name : get_post_meta($pid, '_adforest_ad_type', true);
    

?>
<div class="short-features">
<div class="heading-panel">
    <div class="main-title text-left"><?php echo __('Description', 'adforest');?></div>
</div>
<div class="clear-custom">
    <?php
    $feature_col = 4;
    if (isset($adforest_theme['ad_features_cols']) && $adforest_theme['ad_features_cols'] != '')
        $feature_col = $adforest_theme['ad_features_cols'];

    if (get_post_meta($pid, '_adforest_ad_price_type', true) == "no_price" || ( get_post_meta($pid, '_adforest_ad_price', true) == "" && get_post_meta($pid, '_adforest_ad_price_type', true) != "free" && get_post_meta($pid, '_adforest_ad_price_type', true) != "on_call" )) {
        
    } else {
        ?>
        <div class="col-sm-<?php echo esc_attr($feature_col);?> col-md-<?php echo esc_attr($feature_col);?> col-xs-12 no-padding">
            <span><strong><?php echo __('Price', 'adforest');?></strong> :</span>
            <?php echo adforest_adPrice($pid);?> 

        </div>
        <?php
    }
    ?>
    <?php if ($ad_type_val != "") {?>
        <div class="col-sm-<?php echo esc_attr($feature_col);?> col-md-<?php echo esc_attr($feature_col);?> col-xs-12 no-padding">
            <span><strong><?php echo __('Type', 'adforest');?></strong> :</span> <?php echo esc_html($ad_type_val);?>
        </div>
    <?php } ?>
    <div class="col-sm-<?php echo esc_attr($feature_col);?> col-md-<?php echo esc_attr($feature_col);?> col-xs-12 no-padding">
        <span><strong><?php echo __('Date', 'adforest');?></strong> :</span> <?php echo get_the_date();?>
    </div>
    <?php
    if ($ad_conditon_val != "" && isset($adforest_theme['allow_tax_condition']) && $adforest_theme['allow_tax_condition']) {
        ?>
        <div class="col-sm-<?php echo esc_attr($feature_col);?> col-md-<?php echo esc_attr($feature_col);?> col-xs-12 no-padding">
            <span><strong><?php echo __('Condition', 'adforest');?></strong> :</span> <?php echo esc_html($ad_conditon_val);?>
        </div>
        <?php
    }
    if ($ad_warranty_val != "" && isset($adforest_theme['allow_tax_warranty']) && $adforest_theme['allow_tax_warranty']) {
        ?>
        <div class="col-sm-<?php echo esc_attr($feature_col);?> col-md-<?php echo esc_attr($feature_col);?> col-xs-12 no-padding">
            <span><strong><?php echo __('Warranty', 'adforest');?></strong> :</span> <?php echo 
            esc_html($ad_warranty_val);?>
        </div>
        <?php
    }
    global $wpdb;
    $rows = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE post_id = '$pid' AND meta_key LIKE '_sb_extra_%'");
    foreach ($rows as $row) {
        $caption = explode('_', $row->meta_key);
        if ($row->meta_value == "") {
            continue;
        }
        ?>
        <div class="col-sm-<?php echo esc_attr($feature_col);?> col-md-<?php echo esc_attr($feature_col);?> col-xs-12 no-padding"><span><strong><?php echo esc_html(ucfirst($caption[3]));?></strong> :</span><?php echo esc_html($row->meta_value);?></div>
        <?php
    }
    if (function_exists('adforestCustomFieldsHTML')) {
        echo adforestCustomFieldsHTML($pid, $feature_col);

        
    }
    ?>                     
    <?php if (get_post_meta($pid, '_adforest_ad_location', true) != "") {?>
        <div class="col-sm-12 col-md-12 col-xs-12 no-padding"><span><strong><?php echo __("Location", 'adforest');?></strong> :</span> <?php echo get_post_meta($pid, '_adforest_ad_location', true);?></div>
    <?php } ?>
</div>
</div>