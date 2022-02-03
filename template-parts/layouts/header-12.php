<?php
global $adforest_theme;
$sb_sign_in_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_sign_in_page']);
$sb_sign_up_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_sign_up_page']);

/*topbar two pages*/
$top_bar_page2 = apply_filters('adforest_language_page_id', $adforest_theme['top_bar_page2']);
$top_bar_page3 = apply_filters('adforest_language_page_id', $adforest_theme['top_bar_page3']);
$ad_menu_contact_num = isset($adforest_theme['ad_menu_contact_num']) && !empty($adforest_theme['ad_menu_contact_num']) ? $adforest_theme['ad_menu_contact_num'] : '';

$sb_notification_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_notification_page']);
if (isset($adforest_theme['sb_top_bar']) && $adforest_theme['sb_top_bar'] == true) {
    $top_bar_text = isset($adforest_theme['top_bar_text']) && !empty($adforest_theme['top_bar_text']) ? $adforest_theme['top_bar_text'] : '';
    $top_bar_contact = isset($adforest_theme['top_bar_contact']) && !empty($adforest_theme['top_bar_contact']) ? $adforest_theme['top_bar_contact'] : '';
    ?>
    <div class="wcmpv-top-bar">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <!-- Header Top Left -->
                    <div class="header-top-left col-md-8 col-sm-6 col-xs-12 hidden-xs">
                        <ul class="listnone">
                            <li><a href="<?php echo esc_url(get_the_permalink($top_bar_page2)); ?>"><i
                                            class="fa fa-heart-o"
                                            aria-hidden="true"></i><?php echo get_the_title($top_bar_page2); ?></a></li>
                            <li><a href="<?php echo esc_url(get_the_permalink($top_bar_page3)); ?>"><i
                                            class="fa fa-folder-open-o"
                                            aria-hidden="true"></i><?php echo get_the_title($top_bar_page3); ?></a></li>

                            <?php
                            $sb_head_lang_switch = false;
                            if (class_exists('Redux')) {
                                $sb_head_lang_switch = Redux::getOption('adforest_theme', 'sb_head_lang_switch');
                            }
                            $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
                            if (!empty($languages)) {
                                ?>
                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                        role="button" aria-haspopup="true" aria-expanded="false"><i
                                                class="fa fa-globe"
                                                aria-hidden="true"></i> <?php echo esc_html__('Language', 'adforest'); ?>
                                        <span
                                                class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <?php
                                        foreach ($languages as $l) {
                                            ?>
                                            <li><a href="<?php echo esc_url($l['url']); ?>"><?php echo adforest_returnEcho($l['native_name']); ?></a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- Header Top Right Social -->
                    <div class="header-right col-md-4 col-sm-6 col-xs-12 ">
                        <div class="pull-right  <?php echo is_rtl() ?  "flip" : "" ?>">
                            <ul class="listnone">
                                <?php if (is_user_logged_in()) {
                                    $user_id = get_current_user_id();
                                    global $wpdb;
                                    $user_info = get_userdata($user_id);
                                    $sb_profile_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_profile_page']);
                                    ?>
                                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                            role="button" aria-haspopup="true" aria-expanded="false"><i
                                                    class="icon-profile-male"
                                                    aria-hidden="true"></i><?php echo ucfirst($user_info->display_name); ?>
                                            <span
                                                    class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="<?php echo get_the_permalink($sb_profile_page); ?>"><?php echo __("Profile", "adforest"); ?></a>
                                            </li>
                                            <?php echo apply_filters('adforest_vendor_dashboard_profile', '', $user_id); ?>
                                            <?php
                                            if (isset($adforest_theme['sb_cart_in_menu']) && $adforest_theme['sb_cart_in_menu'] && in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
                                                global $woocommerce;
                                                ?>
                                                <li>
                                                    <a href="<?php echo wc_get_cart_url(); ?>"><?php echo __('Cart', 'adforest'); ?>
                                                        <span class="badge"><?php echo adforest_returnEcho($woocommerce->cart->cart_contents_count); ?></span></a>
                                                </li>
                                            <?php } ?>
                                            <li>
                                                <a href="<?php echo wp_logout_url(get_the_permalink($sb_sign_in_page)); ?>"><?php echo __("Logout", "adforest"); ?></a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } else { ?>
                                    <li><a href="<?php echo get_the_permalink($sb_sign_in_page); ?>"><i
                                                    class="fa fa-sign-in"></i><?php echo __(" Log in", "adforest"); ?>
                                        </a></li>
                                    <li><a href="<?php echo get_the_permalink($sb_sign_up_page); ?>"><i
                                                    class="fa fa-unlock"
                                                    aria-hidden="true"></i><?php echo __(" Register", "adforest"); ?>
                                        </a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
       
    </div>
<?php } ?>
<div class="wcmpv-adf-header">
    <!-- Navigation Menu -->
    <nav id="menu-1" class="mega-menu">
        <!-- menu list items container -->
        <section class="menu-list-items">
            <div class="container">
                <div class="row">
                    <!--==========Main--Top-Search--Start----==========-->
                    <div class="col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 padding-15-sm">
                                <!-- menu logo -->
                                <ul class="menu-logo">
                                    <li>  <?php get_template_part('template-parts/layouts/site', 'logo'); ?></li>
                                </ul>
                                <!-- menu links -->
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 search-header custom-padding-20">
                                <?php
                                echo apply_filters('get_product_search_form_','');
                                ?>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="header-right">
                                    <div class="header-right-data">
                                        <ul class="listnone">
                                            <?php if ($ad_menu_contact_num != '') { ?>
                                            <li class="call-us"><span class="icon-spn pull-left  <?php echo is_rtl() ? "flip" :"" ?>"><i
                                                        class="fa fa-phone"></i></span> <span class="pull-left   <?php echo is_rtl()  ?  "flip" : "" ?>">
                        <p class="top-tittle text-capitalize mb-0"><?php echo esc_html__('Call Us:', 'adforest'); ?></p>
                                                        <h3 class="bottom-tittle"><?php echo adforest_returnEcho($ad_menu_contact_num); ?></h3>
                        </span></li>
                                            <?php } 
                                          if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) { ?>
                                                <li class="favorite"><a
                                                            href="<?php echo wc_get_page_permalink('cart'); ?>"
                                                            class="fav-link"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1.15em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 2048 1792"><path d="M1920 768q53 0 90.5 37.5T2048 896t-37.5 90.5t-90.5 37.5h-15l-115 662q-8 46-44 76t-82 30H384q-46 0-82-30t-44-76l-115-662h-15q-53 0-90.5-37.5T0 896t37.5-90.5T128 768h1792zM485 1568q26-2 43.5-22.5T544 1499l-32-416q-2-26-22.5-43.5T443 1024t-43.5 22.5T384 1093l32 416q2 25 20.5 42t43.5 17h5zm411-64v-416q0-26-19-45t-45-19t-45 19t-19 45v416q0 26 19 45t45 19t45-19t19-45zm384 0v-416q0-26-19-45t-45-19t-45 19t-19 45v416q0 26 19 45t45 19t45-19t19-45zm352 5l32-416q2-26-15.5-46.5T1605 1024t-46.5 15.5t-22.5 43.5l-32 416q-2 26 15.5 46.5t43.5 22.5h5q25 0 43.5-17t20.5-42zM476 292l-93 412H251l101-441q19-88 89-143.5T601 64h167q0-26 19-45t45-19h384q26 0 45 19t19 45h167q90 0 160 55.5t89 143.5l101 441h-132l-93-412q-11-44-45.5-72t-79.5-28h-167q0 26-19 45t-45 19H832q-26 0-45-19t-19-45H601q-45 0-79.5 28T476 292z" fill="#626262"/></svg>
                                                    </a>
                                                </li>
                                               
                                            <?php } ?>
                                                                                                                                              
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--==========Main--Top-Search--Close----==========-->
                </div>
            </div>
            <div class="clearfix"></div>
            <!--==========Main--Menu--Start----==========-->
            <div class="container-fluid">
                <div class="row">
                    <div class="menu-block">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-3">
                                    <?php if ($adforest_theme['sb_menu_product_cat_switch'] == true) {
                                        $args = array();
                                        $args = array('hide_empty' => 0);
                                        $args = apply_filters('adforest_wpml_show_all_posts', $args); // for all lang texonomies
                                        $terms = get_terms('product_cat', $args);
                                        if (!empty($terms)) {
                                            ?>
                                            <li class="cat-drop"><a href="#" class="dropdown-toggle"
                                                                    data-toggle="dropdown"
                                                                    role="button" aria-haspopup="true"
                                                                    aria-expanded="false"> <i
                                                            class="fa fa-list-ul theme-icon"
                                                            aria-hidden="true"></i><?php echo esc_html__('Product Categories', 'adforest'); ?>
                                                    <span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                    <?php foreach ($terms as $prod_cat) {
                                                        if (isset($prod_cat->term_id)) {
                                                            $count = $prod_cat->count;
                                                            // get the thumbnail id using the queried category term_id
                                                            $product_image = '';
                                                            $thumbnail_id = get_term_meta($prod_cat->term_id, 'thumbnail_id', true);
                                                            if ($thumbnail_id != '') {
                                                                $product_image = wp_get_attachment_image_src($thumbnail_id, 'adforest_category_menu_vendor', false);
                                                                if(!empty($product_image)){
                                                                $product_image = '<img src="'. $product_image[0] .'" alt="icon"/>';
                                                            }}
                                                            ?>
                                                            <li>
                                                                <a href="<?php echo esc_url(get_term_link($prod_cat->term_id)); ?>">
                                                                    <span class="icon"><?php echo adforest_returnEcho($product_image); ?></span>
                                                                    <p><?php echo esc_html($prod_cat->name); ?></p>
                                                                    <span class="cat-num"><?php echo adforest_returnEcho($count); ?></span>
                                                                </a></li>
                                                        <?php }
                                                    } ?>
                                                </ul>
                                            </li>
                                        <?php }
                                    } ?>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-9 menu-col">
                                    <?php get_template_part('template-parts/layouts/main', 'nav'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--==========Main--Menu--Close----==========-->

        </section>
    </nav>
</div>
 <div class="clearfix"></div>
