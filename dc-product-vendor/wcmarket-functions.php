<?php
/*
 * add button for applying as a vendor
 */
add_filter('adforest_vendor_role_assign_button', 'adforest_vendor_role_assign', 10, 2);
if (!function_exists('adforest_vendor_role_assign')) {
    function adforest_vendor_role_assign($html = '', $user_id = '')
    {
        $role_user = wp_get_current_user();
        $vendor_btn_class = '';
        $vendor_btn_text = __('Request as Vendor', 'adforest');
        if ($role_user != '') {
            global $WCMp;
            $is_approve_manually = $WCMp->vendor_caps->vendor_general_settings('approve_vendor_manually');
            if (in_array('dc_pending_vendor', (array)$role_user->roles)) {
                $vendor_btn_text = __('Pending Vendor', 'adforest');
                $html = '<button type="button" id="" class="btn btn-primary" disabled="">' . $vendor_btn_text . '</button>';
            } else {
                $html = '<button type="button" id="role_as_vendor" data-user_id="' . $user_id . '" data-vendor_approve="' . $is_approve_manually . '" class="btn btn-primary">' . $vendor_btn_text . '</button>';
            }
        }
        if (is_plugin_active('dc-woocommerce-multi-vendor/dc_product_vendor.php') && $user_id != '' && $role_user->roles[0] != 'dc_vendor' && !current_user_can('administrator')) {
            return $html;
        }
    }
}

/*
 * add link under profile for
 * vendor dashboard.
 */
add_filter('adforest_vendor_dashboard_profile', 'adforest_vendor_dashboard_profile_callback', 10, 2);
if (!function_exists('adforest_vendor_dashboard_profile_callback')) {
    function adforest_vendor_dashboard_profile_callback($html = '', $user_id = '')
    {
        if (is_plugin_active('dc-woocommerce-multi-vendor/dc_product_vendor.php') && $user_id != '') {
          
            $user = get_userdata($user_id);
            if ($user->roles[0] == 'dc_vendor') {
                global $adforest_theme;
                $vendor_dashboard = isset($adforest_theme['sb_vendor_dashboard_page'][0]) ? $adforest_theme['sb_vendor_dashboard_page'][0] : '';
                if (isset($vendor_dashboard) && $vendor_dashboard != '') {
                    $page_link = esc_url(get_permalink($vendor_dashboard));
                    $html = '<li><a href="' . $page_link . '">' . __("Vendor Dashboard", "adforest") . '</a></li>';
                }
            }
            return $html;
        }
    }
}
/*
 * assign new role to user
 * as a vendor
 */
add_action('wp_ajax_sb_change_role_user_to_vendor', 'sb_change_role_user_to_vendor');
if (!function_exists('sb_change_role_user_to_vendor')) {
    function sb_change_role_user_to_vendor()
    {
        $user_id = $_POST['user_id'];
        $vendor_approve = $_POST['vendor_approve'];
        if ($user_id != '') {
            global $WCMp;
            $is_approve_manually = $WCMp->vendor_caps->vendor_general_settings('approve_vendor_manually');
            $user = new WP_User($user_id);
            //if ($vendor_approve != '' && $vendor_approve == 1) {
            if ($is_approve_manually) {
                $user = new WP_User(absint($user_id));
                // $user->set_role('dc_pending_vendor');
                $user->set_role('dc_pending_vendor');
                $user->add_role('subscriber');

                $email_pending_send = sb_send_email_to_pending_vendor_callback($user);
                $email_admin_send = sb_send_email_on_new_vendor_register($user);
                echo __('Currently your request is in pending.', 'adforest');
            } else {
                //$user->set_role('dc_vendor');
                $user->set_role('dc_vendor');
                $user->add_role('subscriber');

                $email_admin_send = sb_send_email_on_new_vendor_register($user);
                echo __('Now your role is vendor.', 'adforest');
            }
        } else {
            echo __('Something went wrong.', 'adforest');
        }
        die();
    }
}

/*
 * remove filter from plugin
 * and dual role to vendor.
 */

remove_action('wp_ajax_activate_pending_vendor', array('WCMp_Ajax', 'activate_pending_vendor'));
add_action('wp_ajax_activate_pending_vendor', 'activate_pending_vendor_');
if (!function_exists('activate_pending_vendor_')) {
    function activate_pending_vendor_()
    {
        $user_id = filter_input(INPUT_POST, 'user_id');
        $redirect = filter_input(INPUT_POST, 'redirect');
        $custom_note = filter_input(INPUT_POST, 'custom_note');
        $note_by = filter_input(INPUT_POST, 'note_by');

        if ($user_id) {
            $user = new WP_User(absint($user_id));

            $user->set_role('dc_vendor');
            $user->add_role('subscriber');

            $user_dtl = get_userdata(absint($user_id));
            $email = WC()->mailer()->emails['WC_Email_Approved_New_Vendor_Account'];
            $email->trigger($user_id, $user_dtl->user_pass);

            if (isset($custom_note) && $custom_note != '') {
                $wcmp_vendor_rejection_notes = unserialize(get_user_meta($user_id, 'wcmp_vendor_rejection_notes', true));
                $wcmp_vendor_rejection_notes[time()] = array(
                    'note_by' => $note_by,
                    'note' => $custom_note);
                update_user_meta($user_id, 'wcmp_vendor_rejection_notes', serialize($wcmp_vendor_rejection_notes));
            }
        }

        if (isset($redirect) && $redirect)
            wp_send_json(array('redirect' => true, 'redirect_url' => wp_get_referer() ? wp_get_referer() : admin_url('admin.php?page=vendors')));
        exit;
    }
}

/*========================
 * ajax vendor
 * favourites/un-favourites
 =========================*/
add_action('wp_ajax_vendor_fav_ad', 'adforest_vendor_fav_ad');
add_action('wp_ajax_nopriv_vendor_fav_ad', 'adforest_vendor_fav_ad');
if (!function_exists('adforest_vendor_fav_ad')) {

    function adforest_vendor_fav_ad()
    {
        adforest_authenticate_check();
        $vendor_id = $_POST['vendor_id'];
        $status_code = $_POST['status_code'];

        if ($status_code == "true") {
            update_user_meta(get_current_user_id(), '_vendor_fav_id_' . $vendor_id, $vendor_id);
            echo '1|' . __("Vendor Added to your favourites.", 'adforest');
        } else {
            if (delete_user_meta(get_current_user_id(), '_vendor_fav_id_' . $vendor_id)) {
                echo '0|' . __("Vendor removed to your favourites.", 'adforest');
            }
        }
        die();
    }
}


/* Send Email to Vendor/store Owner */
add_action('wp_ajax_sb_send_email_to_store_vendor', 'adforest_sb_send_email_to_store_vendor_func');
add_action('wp_ajax_nopriv_sb_send_email_to_store_vendor', 'adforest_sb_send_email_to_store_vendor_func');
if (!function_exists('adforest_sb_send_email_to_store_vendor_func')) {
    function adforest_sb_send_email_to_store_vendor_func()
    {
        global $WCMp, $adforest_theme;
        $params = array();
        parse_str($_POST['sb_data'], $params);
        $u_name = $params['u_name'];
        $u_email = $params['u_email'];
        $u_subject = $params['u_subject'];
        $u_mesage = $params['u_mesage'];
        $vendor_id = $_POST['vendor_id'];
        if ($vendor_id == '' || $vendor_id == 0) {
            echo '0|' . __("Something went wrong.", "adforest");
            die();
        }

        if (isset($adforest_theme['sb_email_template_to_vendor_desc']) && $adforest_theme['sb_email_template_to_vendor_desc'] != "" && isset($adforest_theme['sb_email_template_to_vendor_from']) && $adforest_theme['sb_email_template_to_vendor_from'] != "") {
            $vendor = get_wcmp_vendor($vendor_id);
            $store_title = apply_filters('wcmp_vendor_lists_single_button_text', $vendor->page_title);
            $store_link = esc_url($vendor->get_permalink());
            $vendor_email = isset($vendor->user_data->user_email) ? $vendor->user_data->user_email : '';
            $vendor_info = get_userdata($vendor_id);
            $store_owner = $vendor_info->display_name;
            $to = $vendor_email;
            /* $subject = $adforest_theme['sb_email_template_seller_widget_subject']; */
            $from = $adforest_theme['sb_email_template_to_vendor_from'];
            $headers = array('Content-Type: text/html; charset=UTF-8', "From: $from", "Reply-To: <$u_email>");

            $msg_keywords = array(
                '%sender_name%',
                '%sender_email%',
                '%sender_subject%',
                '%sender_message%',
                '%store_title%',
                '%store_link%',
                '%store_owner%'
            );
            $msg_replaces = array(
                $u_name,
                $u_email,
                $u_subject,
                $u_mesage,
                $store_title,
                $store_link,
                $store_owner
            );
            $body = str_replace($msg_keywords, $msg_replaces, $adforest_theme['sb_email_template_to_vendor_desc']);
            $subject_keywords = array('%site_name%', '%store_title%', '%store_owner%');
            $subject_replaces = array(get_bloginfo('name'), $store_title, $store_owner);

            $subject = str_replace($subject_keywords, $subject_replaces, $adforest_theme['sb_email_template_to_vendor_subject']);
            $res = wp_mail($to, $subject, $body, $headers);

            if ($res) {
                echo '1|' . __("Message has been sent.", "dc-woocommerce-multi-vendor");
            } else {
                echo '0|' . __("Message not sent, please try later.", "dc-woocommerce-multi-vendor");
            }
            die();
        }
    }
}

/*
 * Email send to admin on
 * register as a vendor
 */
if (!function_exists('sb_send_email_on_new_vendor_callback')) {
    function sb_send_email_on_new_vendor_register($vendor_obj = '')
    {
        if ($vendor_obj != '') {
            global $WCMp, $adforest_theme;
            if (isset($adforest_theme['sb_new_vendor_admin_message']) && $adforest_theme['sb_new_vendor_admin_message'] != "" && isset($adforest_theme['sb_new_vendor_admin_message_from']) && $adforest_theme['sb_new_vendor_admin_message_from'] != "") {

                $subject = $adforest_theme['sb_new_vendor_admin_message_subject'];
                $to = get_option('admin_email');
                /* $subject = $adforest_theme['sb_email_template_seller_widget_subject']; */
                $from = $vendor_obj->user_email;
                $headers = array('Content-Type: text/html; charset=UTF-8', "From: $from", "Reply-To: <$to>");

                $msg_keywords = array('%site_name%', '%vendor_name%', '%vendor_email%');
                $msg_replaces = array(get_bloginfo('name'), $vendor_obj->display_name, $vendor_obj->user_email);

                $body = str_replace($msg_keywords, $msg_replaces, $adforest_theme['sb_new_vendor_admin_message']);
                wp_mail($to, $subject, $body, $headers);
            }
        }
    }
}

/*
 * Email send to vendor
 * when status is pending
 */
if (!function_exists('sb_send_email_to_pending_vendor_callback')) {
    function sb_send_email_to_pending_vendor_callback($vendor_obj = '')
    {
        if ($vendor_obj != '') {
            global $WCMp, $adforest_theme;
            if (isset($adforest_theme['sb_vendor_pending_email_message']) && $adforest_theme['sb_vendor_pending_email_message'] != "" && isset($adforest_theme['sb_vendor_pending_email_from']) && $adforest_theme['sb_vendor_pending_email_from'] != "") {

                $subject = $adforest_theme['sb_vendor_pending_email_subject'];
                $to = $vendor_obj->user_email;
                /* $subject = $adforest_theme['sb_email_template_seller_widget_subject']; */
                $from = isset($adforest_theme['sb_vendor_pending_email_from']) ? $adforest_theme['sb_vendor_pending_email_from'] : get_option('admin_email');
                $headers = array('Content-Type: text/html; charset=UTF-8', "From: $from", "Reply-To: <$to>");
                $msg_keywords = array('%site_name%', '%vendor_name%', '%vendor_email%');
                $msg_replaces = array(get_bloginfo('name'), $vendor_obj->display_name, $vendor_obj->user_email);
                $body = str_replace($msg_keywords, $msg_replaces, $adforest_theme['sb_vendor_pending_email_message']);
                wp_mail($to, $subject, $body, $headers);
            }
        }
    }
}


/*
 * Vendor grid
 * */
if (!function_exists('adforest_all_vendors_style1')) {
    function adforest_all_vendors_style1($vendors_id = '', $no_of_vendors_ = '')
    {
        $vendor_grid_html = '';
        $no_of_vendors_count = $no_of_vendors_;
        if (!empty($vendors_id) && is_array($vendors_id)) {
            foreach ($vendors_id as $vendor_id) {
                if (is_user_wcmp_vendor($vendor_id)) {
                    $vendor = get_wcmp_vendor($vendor_id);
                    $vendor_image = ($vendor->get_image('image') != '') ? $vendor->get_image('image', 'adforest_vendor_img') : get_template_directory_uri() . '/images/users/qa.png';
                    $store_banner = ($vendor->get_image('banner') != '') ? $vendor->get_image('banner', 'adforest_vendor_store_front_grid') : get_template_directory_uri() . '/images/vendor/mlt-bg4.png';
                    $store_name = apply_filters('wcmp_vendor_lists_single_button_text', $vendor->page_title);
                    $vendor_data = get_userdata($vendor_id);
                    $registered_date = $vendor_data->user_registered;
                    /* getting complete address */
                    $address_html = '';
                    if ($vendor->get_formatted_address() != '') {
                        $address_html = '<li><span>
												<img src="' . get_template_directory_uri() . '/images/vendor/location.png" class="myicons"
                                                           alt="icons"/></span>
                                                <p>' . esc_html($vendor->get_formatted_address()) . '</p></li>';
                    }

                    /* getting telephone */
                    $vendor_telefone_html = '';
                    $vendor_telefone = get_user_meta($vendor_id, '_vendor_phone', true) ? get_user_meta($vendor_id, '_vendor_phone', true) : '';
                    if ($vendor_telefone != '') {
                        $vendor_telefone_html = '<li><span><img src="' . get_template_directory_uri() . '/images/vendor/phone.png" class="myicons" alt="icons"/></span>
                                                <p>' . $vendor_telefone . '</p></li>';
                    }
                    /* check already favourite or not */
                    $fav_v_class = '';
                    if (get_user_meta(get_current_user_id(), '_vendor_fav_id_' . $vendor_id, true) == $vendor_id) {
                        $fav_v_class = 'favourited_v';
                    }

                    $vendor_grid_html .= '<div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="multi-inner margin-bottom-30" >
                            <div class="multi-top" style="background-image:url('.$store_banner.') ; background-position: center center;
    background-repeat: no-repeat;
    background-size: cover; max-height: 130px;
    min-height: 130px;
">
                              
                            </div>
                            <div class="multi-bottom">
                                <div class="user-img">
                                    <img src="' . $vendor_image . '" class="img-responsive img-full" alt="users"/>
                                </div>
                                <div class="multi-detail">
                                    <h3><a href="' . esc_url($vendor->get_permalink()) . '">' . esc_html($store_name) . '</a></h3>
                                    <div class="detail-inner">
                                        <ul>
                                            ' . $address_html . '
                                           
                                            <li><span><img src="' . get_template_directory_uri() . '/images/vendor/clander.png" class="myicons" alt="icons"/></span>
                                                <p>' . date(get_option('date_format'), strtotime($registered_date)) . '</p></li>
                                        </ul>
                                    </div>
                                    <div class="detail-button">
                                        <ul class="ul-detail">
                                            <li class="fav"><a href="javascript:void(0);" data-vendorid="' . $vendor_id . '" class="vendor_to_fav btn btn-theme ' . $fav_v_class . '">' . esc_html__('Favourite', 'adforest') . '</a></li>
                                            <li class="view"><a href="' . esc_url($vendor->get_permalink()) . '" class="btn btn-theme">' . esc_html__('View Detail', 'adforest') . '</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                if ($no_of_vendors_count == 1) {
                    break;
                }
                $no_of_vendors_count = $no_of_vendors_count - 1;
            }
        } else {
            $vendor_grid_html = '<div class="col-lg-12">' . esc_html__('No Vendor Found!', 'adforest') . '</div>';
        }

        return $vendor_grid_html;
    }
}

/* Get products related to post. on vendor page */
if (!function_exists('get_products_by_category')) {
    function get_products_by_category($categ_id_slug = '', $max_limit = 4, $product_fetch_type = 'slug' )
    {
        global $adforest_theme;
        $prod_html = $sale_price = $regular_price = '';
        if ($categ_id_slug == '') {
            $loop_args = array('post_type' => 'product', 'posts_per_page' => $max_limit, 'order' => 'DESC',);
        } else {
            $categories = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => $product_fetch_type,
                    'terms' => $categ_id_slug,
                ),
            );
            $loop_args = array(
                'post_type' => 'product',
                'post_status' => 'publish',
                'posts_per_page' => $max_limit,
                'tax_query' => array(
                    $categories,
                ),
            );
            $args = apply_filters('adforest_wpml_show_all_posts', $loop_args);
            $results = new WP_Query($args);
            if ($results->have_posts()) {
                while ($results->have_posts()) {
                    $results->the_post();
                    $product_id = get_the_ID();
                    global $product;
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

                    $product_typee = adforest_get_product_type($product_id);
                    if (isset($product_typee) && $product_typee == 'variable') {
                        $available_variations = $product->get_available_variations();
                        if (isset($available_variations[0]['variation_id']) && !empty($available_variations[0]['variation_id'])) {
                            $variation_id = $available_variations[0]['variation_id'];
                            $variable_product1 = new WC_Product_Variation($variation_id);
                            $price = $variable_product1->get_regular_price();
                            $sale = $variable_product1->get_sale_price();
                        }
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

                    $prod_html .= '<li class="margin-bottom-30  shop_layout_modern">
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
                    </li>';
                }
                wp_reset_postdata();
            }
            return $prod_html;
        }
    }
}

/*========================
 * Ajax Product favourites
 * shop layout 5
 =========================*/

add_action('wp_ajax_product_fav_add', 'adforest_product_fav_add');
add_action('wp_ajax_nopriv_product_fav_add', 'adforest_product_fav_add');
if (!function_exists('adforest_product_fav_add')) {

    function adforest_product_fav_add()
    {
        adforest_authenticate_check();
        $prod_id = $_POST['product_id'];
        $status_code = $_POST['status_code'];
        if ($status_code == "true") {
            update_user_meta(get_current_user_id(), '_product_fav_id_' . $prod_id, $prod_id);
            echo '1|' . __("Added to your favourites.", 'adforest');
        } else {
            if (delete_user_meta(get_current_user_id(), '_product_fav_id_' . $prod_id)) {
                echo '0|' . __("Ad removed to your favourites.", 'adforest');
            }
        }
        die();
    }
}

/*
 * Dequeue theme bootstrap.js on
 * nav because create error
 */
add_filter('wcmp_vendor_dashboard_nav', 'adforest_add_wcmp_vendor_dashboard_nav');
if (!function_exists('adforest_add_wcmp_vendor_dashboard_nav')) {
    function adforest_add_wcmp_vendor_dashboard_nav($nav)
    {
        wp_dequeue_script('bootstrap');
        wp_dequeue_script('adforest-custom');
        return $nav;
    }
}

/**==============================
 * vendor redirect to /
 * after logout.
 * ==============================*/

add_action('wp_logout', 'wcmp_logout_redirect');
function wcmp_logout_redirect()
{
    wp_redirect(home_url());
    exit;
}

/**==============================
 * Hide vendor dashboard menu for
 * acces to wp-admin
 * ==============================*/

add_filter('wcmp_vendor_dashboard_header_right_panel_nav', 'filter_wcmp_vendor_dashboard_header_right_panel_nav', 10, 1);
function filter_wcmp_vendor_dashboard_header_right_panel_nav($panel_nav)
{
    unset($panel_nav ['wp-admin']); //remove Backend Link
    return $panel_nav;
}

/**==============================
 * Hide vendor dashboard menu for
 * acces to wp-admin
 * ==============================*/
add_action('init', 'blockusers_access_wpadmin');
function blockusers_access_wpadmin()
{
     $user = wp_get_current_user();
     $allowed_roles = array( 'editor', 'administrator', 'author' ,'contributor' );
    if ( !array_intersect( $allowed_roles, $user->roles ) && ! defined( 'DOING_AJAX' ) ) {
            add_action( 'admin_init',  'sb_dashboard_redirect');

        } else {
            return; // Bail
        }
}
    function sb_dashboard_redirect() {
        /* @global string $pagenow */
        global $pagenow;
        if ( 'profile.php' != $pagenow) {
            wp_redirect(home_url());
            exit;
        }
    }