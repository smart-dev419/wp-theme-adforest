<?php



/**

 * adforest functions and definitions.

 *

 * @link https://developer.wordpress.org/themes/basics/theme-functions/

 *

 * @package adforest

 */

add_action('after_setup_theme', 'adforest_setup');

if (!function_exists('adforest_setup')) :



    function adforest_setup()

    {

        /* ------------------------------------------------ */

        /* Theme Utilities */

        /* ------------------------------------------------ */

        require trailingslashit(get_template_directory()) . 'inc/utilities.php';

        /* ------------------------------------------------ */

        /* Theme Settings */

        /* ------------------------------------------------ */

        require trailingslashit(get_template_directory()) . 'inc/theme_settings.php';

        /* ------------------------------------------------ */

        /* TGM */

        /* ------------------------------------------------ */

        require trailingslashit(get_template_directory()) . 'tgm/tgm-init.php';

        /* ------------------------------------------------ */

        /* Theme Options */

        /* ------------------------------------------------ */

        require trailingslashit(get_template_directory()) . 'inc/options-init.php';

        /* ------------------------------------------------ */

        /* Theme Shortcodes */

        /* ------------------------------------------------ */

        require trailingslashit(get_template_directory()) . 'inc/theme_shortcodes/shortcodes.php';

        /* ------------------------------------------------ */

        /* Theme Nav */

        /* ------------------------------------------------ */

        require trailingslashit(get_template_directory()) . 'inc/nav.php';

        /* ------------------------------------------------ */

        /* Shop Settings */

        /* ------------------------------------------------ */

        require trailingslashit(get_template_directory()) . 'inc/shop-func.php';



        /* Wcmarket Place Vendor */

        /*------------------------------------------------ */

        if (in_array('dc-woocommerce-multi-vendor/dc_product_vendor.php', apply_filters('active_plugins', get_option('active_plugins')))) {

            require trailingslashit(get_template_directory()) . 'dc-product-vendor/wcmarket-functions.php';

        }



        /* ------------------------------------------------ */

        /* Search Widgets */

        /* ------------------------------------------------ */

        require trailingslashit(get_template_directory()) . 'inc/ads-widgets.php';

        require trailingslashit(get_template_directory()) . 'inc/widgets.php';

        require trailingslashit(get_template_directory()) . 'css/colors/custom-theme-color.php';

        adforest_generate_custom_color_css();

        adforest_set_date_timezone();

    }

endif;

/* ------------------------------------------------ */

/* Enqueue google fonts . */

/* ------------------------------------------------ */

function adforest_google_fonts_service()

{



    global $adforest_theme;



    if (!is_rtl()) {

        if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern') {

            $query_args = array('family' => 'Source+Sans+Pro:400,400italic,600%7CQuicksand:400,500,600', 'subset' => '',);

        } else {

            $query_args = array('family' => 'Source+Sans+Pro:400,400italic,600,600italic,700,700italic,900italic,900,300,300italic%7CMerriweather:400,300,300italic,400italic,700,700italic', 'subset' => '',);

        }

        wp_register_style('adforest-google_fonts', add_query_arg($query_args, "//fonts.googleapis.com/css"), array(), null);

        wp_enqueue_style('adforest-google_fonts');

    }

}



add_action('wp_enqueue_scripts', 'adforest_google_fonts_service');



/* ------------------------------------------------ */

/* Enqueue scripts and styles. */

/* ------------------------------------------------ */

add_action('wp_enqueue_scripts', 'adforest_scripts');



function adforest_scripts()

{

    global $adforest_theme;

    /* Register scripts. */

    wp_register_script('bootstrap', trailingslashit(get_template_directory_uri()) . 'js/bootstrap.min.js', false, false, true);

    wp_register_script('adforest-custom', trailingslashit(get_template_directory_uri()) . 'js/custom.js', array(

        'jquery', 'adforest-dt', 'typeahead', 'adforest-moment', 'adforest-moment-timezone-with-data', 'parsley',

    ), false, true);

    wp_localize_script('adforest-custom', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));

    wp_register_script('adforest-shortcode-functions', trailingslashit(get_template_directory_uri()) . 'js/sb-shortcode-functions.js', array('jquery', 'adforest-dt', 'typeahead'), false, true);

    $shortcode_function = array('errorLoading' => __('Loding error', 'adforest'), 'inputTooShort' => __('Too Short Input', 'adforest'), 'searching' => __('Searching', 'adforest'), 'noResults' => __('No Result Found', 'adforest'),);



    wp_localize_script('adforest-shortcode-functions', 'shortcode_globals', $shortcode_function);

    wp_register_script('adforest-custom-coming-soon', trailingslashit(get_template_directory_uri()) . 'js/custom-coming-soon.js', array('jquery'), false, true);





    wp_register_script('adforest-perfect-scrollbar', trailingslashit(get_template_directory_uri()) . 'js/perfect-scrollbar.js', '', '', false);

    wp_register_style('adforest-perfect-scrollbar', trailingslashit(get_template_directory_uri()) . 'css/perfect-scrollbar.css', '', '', false);



    wp_register_script('adforest-dt', trailingslashit(get_template_directory_uri()) . 'js/datepicker.min.js', false, false, true);

    wp_register_script('animate-number', trailingslashit(get_template_directory_uri()) . 'js/animateNumber.min.js', false, false, true);

    wp_register_script('carousel', trailingslashit(get_template_directory_uri()) . 'js/carousel.min.js', false, false, true);

    wp_register_script('lightslider', trailingslashit(get_template_directory_uri()) . 'js/lightslider.js', false, false, true);



    wp_register_script('coundown-timer', trailingslashit(get_template_directory_uri()) . 'js/coundown-timer.js', false, false, true);

    wp_register_script('dropzone', trailingslashit(get_template_directory_uri()) . 'js/dropzone.js', false, false, true);

    wp_register_script('isotope', trailingslashit(get_template_directory_uri()) . 'js/isotope.min.js', false, false, true);

    wp_register_script('easing', trailingslashit(get_template_directory_uri()) . 'js/easing.js', false, false, true);

    wp_register_script('file-input', trailingslashit(get_template_directory_uri()) . 'js/fileinput.js', false, false, true);

    wp_register_script('forest-megamenu', trailingslashit(get_template_directory_uri()) . 'js/forest-megamenu.js', false, false, true);

    wp_register_script('form-dropzone', trailingslashit(get_template_directory_uri()) . 'js/form-dropzone.js', false, false, true);

    wp_register_script('hover', trailingslashit(get_template_directory_uri()) . 'js/hover.min.js', false, false, true);

    wp_register_script('icheck', trailingslashit(get_template_directory_uri()) . 'js/icheck.min.js', false, false, true);

    wp_register_script('modernizr', trailingslashit(get_template_directory_uri()) . 'js/modernizr.js', false, false, true);

    wp_register_script('toastr', trailingslashit(get_template_directory_uri()) . 'js/toastr.min.js', false, false, true);

    wp_register_script('search-map', trailingslashit(get_template_directory_uri()) . 'js/map.js', false, false, true);

    wp_register_script('element-map', trailingslashit(get_template_directory_uri()) . 'js/map-element.js', false, false, true);

    //wp_enqueue_script( 'marker-clusterer', trailingslashit( get_template_directory_uri () ) . 'js/markerclusterer.js' , false, false, false);



    wp_register_script('popup-video-iframe', trailingslashit(get_template_directory_uri()) . 'js/YouTubePopUp.js', false, false, true);

    wp_register_script('jquery-appear', trailingslashit(get_template_directory_uri()) . 'js/jquery.appear.min.js', false, false, true);

    wp_register_script('jquery-countTo', trailingslashit(get_template_directory_uri()) . 'js/jquery.countTo.js', false, false, true);

    wp_register_script('jquery-inview', trailingslashit(get_template_directory_uri()) . 'js/jquery.inview.min.js', false, false, true);

    wp_register_script('nouislider-all', trailingslashit(get_template_directory_uri()) . 'js/nouislider.all.min.js', false, false, true);

    wp_register_script('perfect-scrollbar', trailingslashit(get_template_directory_uri()) . 'js/perfect-scrollbar.min.js', false, false, true);

    wp_register_script('select-2', trailingslashit(get_template_directory_uri()) . 'js/select2.min.js', false, false, true);

    wp_register_script('slide', trailingslashit(get_template_directory_uri()) . 'js/slide.js', false, false, true);

    wp_register_script('color-switcher', trailingslashit(get_template_directory_uri()) . 'js/color-switcher.js', false, false, true);

    wp_register_script('parsley', trailingslashit(get_template_directory_uri()) . 'js/parsley.min.js', false, false, true);





    $language_code = apply_filters('adforest_languages_code', get_bloginfo('language'));

    if (function_exists('icl_object_id')) {

        wp_enqueue_style('adforest-multilinguale', trailingslashit(get_template_directory_uri()) . 'css/adforest-multilingual.css', false, false, false);

    }



    if (isset($adforest_theme['google_api_key']) && !empty($adforest_theme['google_api_key']) && isset($adforest_theme['google_api_secret']) && !empty($adforest_theme['google_api_secret'])) {

        if (isset($adforest_theme['google-recaptcha-type']) && $adforest_theme['google-recaptcha-type'] == 'v3') {

            $captcha_site_key = isset($adforest_theme['google_api_key']) && !empty($adforest_theme['google_api_key']) ? $adforest_theme['google_api_key'] : '';



            wp_register_script('recaptcha', 'https://www.google.com/recaptcha/api.js?hl=' . $language_code . '&render=' . $captcha_site_key . '', false, false, false);

        } else {

            wp_register_script('recaptcha', '//www.google.com/recaptcha/api.js?hl=' . $language_code . '', false, false, true);

        }

    }



    wp_register_script('hello', trailingslashit(get_template_directory_uri()) . 'js/hello.js', false, false, true);

    wp_register_script('jquery-te', trailingslashit(get_template_directory_uri()) . 'js/jquery-te.min.js', false, false, true);

    wp_register_script('tagsinput', trailingslashit(get_template_directory_uri()) . 'js/jquery.tagsinput.min.js', false, false, true);

    wp_register_script('theia-sticky-sidebar', trailingslashit(get_template_directory_uri()) . 'js/theia-sticky-sidebar.js', false, false, true);

    wp_register_script('bootstrap-confirmation', trailingslashit(get_template_directory_uri()) . 'js/bootstrap-confirmation.min.js', false, false, true);

    wp_register_script('bootstrap-multiselect',trailingslashit(get_template_directory_uri()) . 'js/bootstrap-multiselect.min.js',false,false,true);



    wp_register_script('adforest-fancybox', trailingslashit(get_template_directory_uri()) . 'js/jquery.fancybox.min.js', array('jquery'), false, false);



    wp_register_script('adforest-search', trailingslashit(get_template_directory_uri()) . 'js/search.js', false, false, true);

    wp_register_script('jquery-smartWizard', trailingslashit(get_template_directory_uri()) . 'js/jquery.smartWizard.min.js', false, false, true);

    wp_register_script('adforest-ad-wizard', trailingslashit(get_template_directory_uri()) . 'js/ad_post_wizard.js', array('adforest-moment', 'adforest-moment-timezone-with-data'), false, true);

    wp_register_script('oms', trailingslashit(get_template_directory_uri()) . 'js/oms.min.js', false, false, true);

    wp_register_script('adforest-timer', trailingslashit(get_template_directory_uri()) . 'js/timer.js', false, false, true);

    wp_register_script('jquery-ui-all', trailingslashit(get_template_directory_uri()) . 'js/jquery-ui.min.js', false, false, true);

    wp_register_script('adforest-jquery-touch-punch', trailingslashit(get_template_directory_uri()) . 'js/jquery.ui.touch-punch.min.js', false, false, true);

    wp_register_script('adforest-tiny-slider', trailingslashit(get_template_directory_uri()) . 'js/tiny-slider.js', false, false, true);



    wp_register_script('adforest-moment', trailingslashit(get_template_directory_uri()) . 'js/moment.js', false, false, true);





    wp_register_script('adforest-moment-timezone-with-data', trailingslashit(get_template_directory_uri()) . 'js/moment-timezone-with-data.js', false, false, true);









    wp_register_script('typeahead', trailingslashit(get_template_directory_uri()) . 'js/typeahead.min.js', false, false, true);



    wp_enqueue_style('spectrum-colorpicker', trailingslashit(get_template_directory_uri()) . 'css/spectrum-colorpicker.css', false, false);

    wp_enqueue_script('spectrum-colorpicker', trailingslashit(get_template_directory_uri()) . 'js/spectrum-colorpicker.js', false, false, true);



    /* Map Settings For The Theme. Default we have google map so if there is nothing selected the else statement will wors */

    $mapType = adforest_mapType();

    if ($mapType == 'leafletjs_map') {

        /* Open Street Map In The API */

        if (!is_rtl()) {

            wp_enqueue_style('leaflet', trailingslashit(get_template_directory_uri()) . 'assets/leaflet/leaflet.css');

        } else {

            wp_enqueue_style('leaflet', trailingslashit(get_template_directory_uri()) . 'assets/leaflet/leaflet-rtl.css');

        }

        wp_enqueue_style('leaflet-search', trailingslashit(get_template_directory_uri()) . 'assets/leaflet/leaflet-search.min.css');

        wp_register_script('leaflet', trailingslashit(get_template_directory_uri()) . 'assets/leaflet/leaflet.js', false, false, false);

        wp_register_script('leaflet-markercluster', trailingslashit(get_template_directory_uri()) . 'assets/leaflet/leaflet.markercluster.js', false, false, false);



        wp_register_script('leaflet-search', trailingslashit(get_template_directory_uri()) . 'assets/leaflet/leaflet-search.min.js', false, false, false);



        wp_enqueue_script('leaflet');

        wp_enqueue_script('leaflet-markercluster');

        wp_enqueue_script('leaflet-search');

    } else if ($mapType == 'no_map') {

        /* No Mapp In The Theme */

    } else {

        /* Default is google map */

        if (isset($adforest_theme['gmap_api_key']) && $adforest_theme['gmap_api_key'] != "") {

            $map_lang = 'fr';

            if (isset($adforest_theme['gmap_lang']) && $adforest_theme['gmap_lang'] != "") {

                $map_lang = $adforest_theme['gmap_lang'];

            }

            $map_lang = apply_filters('adforest_languages_code', $map_lang); // apply switcher language in case of wpml

            wp_register_script('google-map', '//maps.googleapis.com/maps/api/js?key=' . $adforest_theme['gmap_api_key'] . '&language=' . $map_lang, false, false, true);

            wp_register_script('google-map-callback', '//maps.googleapis.com/maps/api/js?key=' . $adforest_theme['gmap_api_key'] . '&libraries=geometry,places&language=' . $map_lang . '&callback=' . 'adforest_location', false, false, true);

        }

    }

    /* Load the custom scripts. */

    //ME Only include when browser <= 9 ie

    if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/MSIE\s(?P<v>\d+)/i', $_SERVER['HTTP_USER_AGENT'], $B) && $B['v'] <= 9) {

        wp_enqueue_script('adforest-maxcdn1', trailingslashit(get_template_directory_uri()) . 'js/html5shiv.min.js', array(), '3.7.2', false);

        wp_script_add_data('adforest-maxcdn1', 'conditional', 'lt IE 9');

        wp_enqueue_script('adforest-maxcdn2', trailingslashit(get_template_directory_uri()) . 'js/respond.min.js', array(), '1.4.2', false);

        wp_script_add_data('adforest-maxcdn2', 'conditional', 'lt IE 9');

    }





    if (is_singular()) {

        wp_enqueue_script("comment-reply", '', true);

    }

    global $adforest_theme;

    $ad_layout_style_modern = isset($adforest_theme['ad_layout_style_modern']) ? $adforest_theme['ad_layout_style_modern'] : '3';

    if (is_singular('ad_post')) {

        if ($ad_layout_style_modern == '6') {

            wp_enqueue_script('jquery-ui-all');

        }

    }





    wp_enqueue_script('bootstrap');

    wp_enqueue_script('toastr');

    wp_enqueue_script('imagesloaded');

    $is_live = true;

    if (isset($adforest_theme['sb_comming_soon_mode']) && $adforest_theme['sb_comming_soon_mode']) {

        $is_live = false;



        if (is_super_admin(get_current_user_id())) {

            if (!$is_live) {

                $is_live = true;

            }

        }

    }



    $sb_disable_menu = isset($adforest_theme['sb_disable_menu']) ? $adforest_theme['sb_disable_menu'] : false;



    if ($is_live) {

        wp_enqueue_script('animate-number');

        wp_enqueue_script('easing');

        wp_enqueue_script('isotope');

        wp_enqueue_script('carousel');

        wp_enqueue_script('file-input');

        if (!$sb_disable_menu) {

            wp_enqueue_script('forest-megamenu');

        }

        wp_enqueue_script('select-2');

        wp_enqueue_script('hover');

        wp_enqueue_script('modernizr');

        wp_enqueue_script('icheck');

        wp_enqueue_script('jquery-appear');

        wp_enqueue_script('jquery-countTo');

        wp_enqueue_script('jquery-inview');

        wp_enqueue_script('adforest-perfect-scrollbar');

        wp_enqueue_script('nouislider-all');

        wp_enqueue_script('slide');

        wp_enqueue_script('theia-sticky-sidebar');

        if (isset($adforest_theme['sb_color_plate']) && $adforest_theme['sb_color_plate']) {

            wp_enqueue_script('color-switcher');

        }

        wp_enqueue_script('parsley');



        wp_enqueue_script('dropzone');

        wp_enqueue_script('tagsinput');

        wp_enqueue_script('form-dropzone');

        wp_enqueue_script('jquery-te');

        wp_enqueue_script('perfect-scrollbar');

        wp_enqueue_script('bootstrap-confirmation');

        wp_enqueue_script('bootstrap-multiselect');

        wp_enqueue_script('hello');

        wp_enqueue_script('recaptcha');

        wp_enqueue_script('g-spider');

        wp_enqueue_script('adforest-moment');

        wp_enqueue_script('adforest-moment-timezone-with-data');

        wp_enqueue_script('adforest-fancybox');



        wp_enqueue_script('adforest-timer');

        if (is_singular('ad_post')) {



            wp_enqueue_script('google-map');

            if ($ad_layout_style_modern != '6') {

                wp_enqueue_script('jquery-ui-all');

            }

            wp_enqueue_script('adforest-jquery-touch-punch');

        }



        if (isset($adforest_theme['sb_video_icon']) && $adforest_theme['sb_video_icon']) {

            wp_enqueue_script('popup-video-iframe');

        }

        wp_enqueue_script('coundown-timer');

        wp_enqueue_script('adforest-custom');

        wp_enqueue_script('adforest-shortcode-functions');



        if (is_singular('ad_post')) {

        }

    } else {

        wp_enqueue_script('coundown-timer');

        wp_enqueue_script('adforest-custom-coming-soon');

    }

    /* Load the stylesheets. */

    wp_enqueue_style('adforest-style', get_stylesheet_uri());

    wp_enqueue_style('bootstrap', trailingslashit(get_template_directory_uri()) . 'css/bootstrap.css');

    wp_enqueue_style('et-line-fonts', trailingslashit(get_template_directory_uri()) . 'css/et-line-fonts.css');

    

    wp_enqueue_style('adforest-font-awesome', trailingslashit(get_template_directory_uri()) . 'css/font-awesome.css');

    wp_enqueue_style('animate', trailingslashit(get_template_directory_uri()) . 'css/animate.min.css');

    wp_enqueue_style('file-input', trailingslashit(get_template_directory_uri()) . 'css/fileinput.css');

    wp_enqueue_style('flaticon', trailingslashit(get_template_directory_uri()) . 'css/flaticon.css');

    wp_enqueue_style('adforest-select2', trailingslashit(get_template_directory_uri()) . 'css/select2.min.css');

    wp_enqueue_style('nouislider', trailingslashit(get_template_directory_uri()) . 'css/nouislider.min.css');

    wp_enqueue_style('owl-carousel', trailingslashit(get_template_directory_uri()) . 'css/owl.carousel.css');

    wp_enqueue_style('owl-theme', trailingslashit(get_template_directory_uri()) . 'css/owl.theme.css');

    wp_enqueue_style('lightslider', trailingslashit(get_template_directory_uri()) . 'css/lightslider.css');

    wp_enqueue_style('toastr', trailingslashit(get_template_directory_uri()) . 'css/toastr.min.css');

    wp_enqueue_style('minimal', trailingslashit(get_template_directory_uri()) . 'skins/minimal/minimal.css');

    wp_enqueue_style('bootstrap-multiselect',trailingslashit(get_template_directory_uri()) . 'css/bootstrap-multiselect.min.css');



    wp_enqueue_style('adforest-fancybox', trailingslashit(get_template_directory_uri()) . 'css/jquery.fancybox.min.css');

    if (isset($adforest_theme['sb_video_icon']) && $adforest_theme['sb_video_icon']) {

        wp_enqueue_style('popup-video-iframe', trailingslashit(get_template_directory_uri()) . 'css/YouTubePopUp.css');

    }



    if (is_rtl()) {

        if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern') {

            wp_enqueue_style('adforest-theme', trailingslashit(get_template_directory_uri()) . 'css/modern-rtl.css');

        } else {

            wp_enqueue_style('adforest-theme', trailingslashit(get_template_directory_uri()) . 'css/style-rtl.css');

            wp_enqueue_style('responsive-media', trailingslashit(get_template_directory_uri()) . 'css/responsive-media.css');

            wp_enqueue_style('adforest-custom', trailingslashit(get_template_directory_uri()) . 'css/custom.css');

        }

        wp_enqueue_style('bootstrap-rtl', trailingslashit(get_template_directory_uri()) . 'css/bootstrap-rtl.css');

        wp_enqueue_style('adforest-theme-rtl', trailingslashit(get_template_directory_uri()) . 'css/adforest-theme-rtl.css');

        wp_enqueue_style('adforest-theme-rtl-main', trailingslashit(get_template_directory_uri()) . 'css/adforest-theme-rtl-main.css');

    } else {

        if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern') {

            wp_enqueue_style('adforest-theme-modern', trailingslashit(get_template_directory_uri()) . 'css/modern.css');

        } else {

            wp_enqueue_style('adforest-theme', trailingslashit(get_template_directory_uri()) . 'css/style.css');

            wp_enqueue_style('responsive-media', trailingslashit(get_template_directory_uri()) . 'css/responsive-media.css');

            wp_enqueue_style('adforest-custom', trailingslashit(get_template_directory_uri()) . 'css/custom.css');

        }



        wp_enqueue_style('adforest-theme-ltr', trailingslashit(get_template_directory_uri()) . 'css/adforest-theme-ltr.css');

    }

    /* New Css For Shop */



    //wp_enqueue_style('shop-theme', trailingslashit(get_template_directory_uri()) . 'css/theme.css');

    //wp_enqueue_style('adforest-blog', trailingslashit(get_template_directory_uri()) . 'css/blog.css');



    if (in_array('dc-woocommerce-multi-vendor/dc_product_vendor.php', apply_filters('active_plugins', get_option('active_plugins')))) {

        wp_enqueue_style('adforest-wcmvendor', trailingslashit(get_template_directory_uri()) . 'css/wcmvendor.css');

        if (is_rtl()) {

            wp_enqueue_style('adforest-wcmvendor-rtl', trailingslashit(get_template_directory_uri()) . 'css/wcmvendor-rtl.css');

        }

    }



    wp_enqueue_style('slider', trailingslashit(get_template_directory_uri()) . 'css/adforest-main-theme.css');



    $css_color = 'defualt';

    if (isset($adforest_theme['theme_color']) && $adforest_theme['theme_color'] != "") {

        $css_color = $adforest_theme['theme_color'];

    }

    if (isset($adforest_theme['custom_theme_color_switch']) && $adforest_theme['custom_theme_color_switch']) {

        $css_color = 'custom-theme-color';

    }



    wp_enqueue_style('defualt-color', trailingslashit(get_template_directory_uri()) . 'css/colors/' . $css_color . '.css', array(), null);

}



add_action('admin_enqueue_scripts', 'adforest_load_admin_js');



function adforest_load_admin_js()

{

    wp_enqueue_media();

    wp_enqueue_script('adforest-widget-media', get_template_directory_uri() . '/js/widget.js', false, '1.0.0', true);

    wp_register_script('adforest-admin', trailingslashit(get_template_directory_uri()) . 'js/admin.js', false, false, true);

    wp_enqueue_script('adforest-admin');

}



function adforest_set_ad_featured_img($single_template)

{

    global $post;

    if ($post->post_type == 'ad_post') {

        $media = adforest_get_ad_images($post->ID);

        $img_ids = '';

        if (is_array($media) && count($media) > 0) {

            foreach ($media as $m) {

                $mid = '';

                if (isset($m->ID)) {

                    $mid = $m->ID;

                } else {

                    $mid = $m;

                }

                if ($mid != get_post_thumbnail_id($post->ID)) {

                    set_post_thumbnail($post->ID, $mid);

                    break;

                }

            }

        }

    }

    return $single_template;

}



add_filter('single_template', 'adforest_set_ad_featured_img');



function adforest_custom_styles()

{

    global $adforest_theme;



    $header_enable = false;

    if (isset($adforest_theme['sb_header']) && ($adforest_theme['sb_header'] == 'transparent' || $adforest_theme['sb_header'] == 'modern' || $adforest_theme['sb_header'] == 'transparent-2' || $adforest_theme['sb_header'] == 'transparent-3')) {

        $header_enable = true;

    }



    if ((basename(get_page_template()) == 'page-home.php' || is_singular('ad_post')) && isset($adforest_theme['sb_menu_color']) && $header_enable) {

        $color = is_singular('ad_post') ? $adforest_theme['sb_menu_color_single'] : $adforest_theme['sb_menu_color'];

        wp_enqueue_style('custom-style', get_template_directory_uri() . '/css/custom-style.css');

        $custom_css = ".mega-menu .menu-links > li > a {color: {$color};}";

        wp_add_inline_style('custom-style', $custom_css);

    }

}

add_action('wp_enqueue_scripts', 'adforest_custom_styles');

/* ------------------------------------------------ */

require trailingslashit(get_template_directory()) . 'inc/adforest-footer-functions.php';

if (class_exists('SitePress')) {

    require trailingslashit(get_template_directory()) . 'inc/multilingual-functions.php';

}

/* ------------------------------------------------ */



if (!function_exists('adforest_remove_blocks_css')) {

    function adforest_remove_blocks_css()

    {

        global $post;

        /* dequeue addtoany css/js */

        if (isset($post) && $post) {

            $disabled = @get_post_meta($post->ID, 'sharing_disabled', true);

            if ($disabled) {

                add_filter('addtoany_script_disabled', '__return_true');

                wp_dequeue_style('addtoany');

                wp_dequeue_script('addtoany');

            }



            if ($post && (preg_match('/vc_row/', $post->post_content) || preg_match('/post_job/', $post->post_content)) || is_singular('ad_post')) {

                add_filter('use_block_editor_for_post_type', '__return_false', 10);

                wp_dequeue_style('wp-block-library');

                wp_dequeue_style('wp-block-library-theme');

            }

        }

    }

}

add_action('wp_enqueue_scripts', 'adforest_remove_blocks_css', 99);



if (!function_exists('adforest_defer_parsing_of_js')) {

    function adforest_defer_parsing_of_js($url)

    {

        if (is_user_logged_in()) return $url;

        if (FALSE === strpos($url, '.js')) return $url;

        if (strpos($url, 'jquery.js')) return $url;

        return str_replace(' src', ' defer src', $url);

    }

}

//add_filter( 'script_loader_tag', 'adforest_defer_parsing_of_js', 10 );



if (!function_exists('adforest_conditionally_load_woc_js_css')) {

    function adforest_conditionally_load_woc_js_css()

    {

        if (function_exists('is_woocommerce')) {

            # Only load CSS and JS on Woocommerce pages   

            if (!is_woocommerce() && !is_cart() && !is_checkout()) {

                remove_action('wp_head', array($GLOBALS['woocommerce'], 'generator'));

                ## Dequeue scripts.

                wp_dequeue_script('woocommerce');

                wp_dequeue_script('wc-add-to-cart');

                wp_dequeue_script('wc-cart-fragments');

                ## Dequeue styles.

                wp_dequeue_style('woocommerce-layout');

                wp_dequeue_style('woocommerce-smallscreen');

                wp_dequeue_style('woocommerce-general');

                wp_dequeue_style('wc-bto-styles');

                wp_dequeue_script('wc-add-to-cart');

                wp_dequeue_script('wc-cart-fragments');

                wp_dequeue_script('woocommerce');

                //   wp_dequeue_script( 'jquery-blockui' );

                wp_dequeue_script('jquery-placeholder');



                add_filter('woocommerce_enqueue_styles', '__return_empty_array');

            }

        }

    }

}

add_action('wp_enqueue_scripts', 'adforest_conditionally_load_woc_js_css', 11);

if (!function_exists('wp_body_open')) {



    /**

     * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.

     */

    function wp_body_open()

    {

        do_action('wp_body_open');

    }

}



add_action('send_headers', 'sb_block_iframes');

if (!function_exists('sb_block_iframes')) {

    function sb_block_iframes()

    {

        header('X-FRAME-OPTIONS: SAMEORIGIN');

    }

}

//      adding all the hidden fields 

if (!function_exists('sb_add_footer_hidden_fields')) {

    function sb_add_footer_hidden_fields()

    {



        global $adforest_theme, $template;

        $page_template = basename($template);

        if (in_array('sb_framework/index.php', apply_filters('active_plugins', get_option('active_plugins')))) {

            $rtl = 0;



            if (function_exists('icl_object_id')) {

                if (apply_filters('wpml_is_rtl', NULL)) {

                    $rtl = 1;

                }

            } else {

                if (is_rtl()) {

                    $rtl = 1;

                }

            }

            $is_single = 0;

            if (is_singular('ad_post')) {

                $is_single = 1;

            }

            $is_video_on = 0;

            if (isset($adforest_theme['sb_video_icon']) && $adforest_theme['sb_video_icon']) {

                $is_video_on = 1;

            }

            $theme_type = '0';

            if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern') {

                $theme_type = '1';

?>



            <?php

            }

            $auto_slide = 1000;

            if (isset($adforest_theme['sb_auto_slide_time']) && $adforest_theme['sb_auto_slide_time'] != "") {

                $auto_slide = $adforest_theme['sb_auto_slide_time'];

            }





            $sb_profile_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_profile_page']);

            $after_login_redirect = get_the_permalink($sb_profile_page);

            if (isset($_GET['u']) && $_GET['u'] != "") {

                $after_login_redirect = $_GET['u'];

            }

            $is_logged_in = 0;

            if (is_user_logged_in()) {

                $is_logged_in = 1;

            }

            $sb_sign_in_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_sign_in_page']);

            $sb_packages_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_packages_page']);

            $ajax_url = apply_filters('adforest_set_query_param', admin_url('admin-ajax.php'));

            $custom_theme_color = isset($adforest_theme['custom-theme-color']) && !empty($adforest_theme['custom-theme-color']) ? $adforest_theme['custom-theme-color'] : '#f58936';

            $custom_btn_hover_color = isset($adforest_theme['custom-btn-hover-color']) && !empty($adforest_theme['custom-btn-hover-color']) ? $adforest_theme['custom-btn-hover-color'] : '#f58936';

            $custom_btn_border_color = isset($adforest_theme['custom-btn-border-color']) && !empty($adforest_theme['custom-btn-border-color']) ? $adforest_theme['custom-btn-border-color'] : '#f58936';

            $sb_disable_menu = isset($adforest_theme['sb_disable_menu']) ? $adforest_theme['sb_disable_menu'] : false;

            $sb_precode = isset($adforest_theme['sb_preadded_code']) ? $adforest_theme['sb_preadded_code'] : false;









            $adforest_menu_display = 'yes';

            if ($sb_disable_menu) {

                $adforest_menu_display = 'no';

            }



            $sb_upload_limit_admin = isset($adforest_theme['sb_upload_limit']) && !empty($adforest_theme['sb_upload_limit']) && $adforest_theme['sb_upload_limit'] > 0 ? $adforest_theme['sb_upload_limit'] : 0;



            $user_upload_max_images = $sb_upload_limit_admin;



            if (is_user_logged_in()) {

                $current_user = get_current_user_id();

                if ($current_user) {

                    update_user_meta($current_user, '_sb_last_login', time());

                }



                $user_packages_images = get_user_meta($current_user, '_sb_num_of_images', true);

                if (isset($user_packages_images) && $user_packages_images == '-1') {

                    $user_upload_max_images = 'null';

                } else if (isset($user_packages_images) && $user_packages_images > 0) {

                    $user_upload_max_images = $user_packages_images;

                }

            }

            $adforest_ad_html = isset($adforest_theme['sb_ad_desc_html']) ? $adforest_theme['sb_ad_desc_html'] : false;

            $allow_attachment    =   isset($adforest_theme['allow_media_upload_messaging'])  ?  $adforest_theme['allow_media_upload_messaging']   : false;

            $allowed_formats = isset($adforest_theme['sb_message_attach_formats']) ? $adforest_theme['sb_message_attach_formats'] : array('pdf', 'doc');

            $formats_provided   =  "";

            if ($allow_attachment) {

                $attachment_type    =   isset($adforest_theme['sb_media_upload_messaging_type'])  ?  $adforest_theme['sb_media_upload_messaging_type']   : "both";

                if ($attachment_type   ==  "images") {

                    $formats_provided   =    "image/*";

                } else if ($attachment_type  ==  "attachments") {

                    foreach ($allowed_formats as $format) {

                        $formats_provided .= "." . $format . ",";

                    }

                } else if ($attachment_type  ==  "both") {

                    $formats_provided   =    "image/*,";

                    foreach ($allowed_formats as $format) {

                        $formats_provided .= "." . $format . ",";

                    }

                }

            }

            echo     '<input type="hidden" id="provided_format" value="' . esc_attr($formats_provided) . '"/> ';

            ?>

            <input type="hidden" id="is_logged_in" value="<?php echo esc_attr($is_logged_in); ?>" />

            <input type="hidden" id="auto_slide_time" value="<?php echo esc_attr($auto_slide); ?>" />

            <input type="hidden" id="theme_type" value="<?php echo esc_attr($theme_type); ?>" />

            <input type="hidden" id="is_rtl" value="<?php echo esc_attr($rtl); ?>" />

            <input type="hidden" id="is_menu_display" value="<?php echo esc_attr($adforest_menu_display); ?>" />

            <input type="hidden" id="is_single_ad" value="<?php echo esc_attr($is_single); ?>" />

            <input type="hidden" id="is_video_on" value="<?php echo esc_attr($is_video_on); ?>" />

            <input type="hidden" id="profile_page" value="<?php echo esc_url($after_login_redirect); ?>" />

            <input type="hidden" id="login_page" value="<?php echo get_the_permalink($sb_sign_in_page); ?>" />

            <input type="hidden" id="sb_packages_page" value="<?php echo get_the_permalink($sb_packages_page); ?>" />

            <input type="hidden" id="theme_path" value="<?php echo trailingslashit(get_template_directory_uri()); ?>" />

            <input type="hidden" id="adforest_ajax_url" value="<?php echo adforest_returnEcho($ajax_url); ?>" />

            <input type="hidden" id="_nonce_error" value="<?php echo __('There is something wrong with the security please check the admin panel.', 'adforest'); ?>" />

            <input type="hidden" id="adforest_ad_html" value="<?php echo adforest_returnEcho($adforest_ad_html); ?>" />

            <input type="hidden" id="adforest_forgot_msg" value="<?php echo __('Password reset link sent to your email.', 'adforest'); ?>" />

            <input type="hidden" id="adforest_profile_msg" value="<?php echo __('Profile saved successfully.', 'adforest'); ?>" />

            <input type="hidden" id="adforest_max_upload_reach" value="<?php echo __('Maximum upload limit reached', 'adforest'); ?>" />

            <input type="hidden" id="not_logged_in" value="<?php echo __('You have been logged out.', 'adforest'); ?>" />

            <input type="hidden" id="sb_upload_limit" value="<?php echo esc_attr($user_upload_max_images); ?>" />

            <input type="hidden" id="adforest_map_type" value="<?php echo esc_attr($adforest_theme['map-setings-map-type']); ?>" />

            <input type="hidden" id="adforest_radius_type" value="<?php echo esc_attr($adforest_theme['search_radius_type']); ?>" />

            <input type="hidden" id="facebook_key" value="<?php echo esc_attr($adforest_theme['fb_api_key']); ?>" />

            <input type="hidden" id="google_key" value="<?php echo esc_attr($adforest_theme['gmail_api_key']); ?>" />

            <input type="hidden" id="google_recaptcha_type" value="<?php echo esc_attr($adforest_theme['google-recaptcha-type']); ?>" />

            <input type="hidden" id="google_recaptcha_site_key" value="<?php echo esc_attr($adforest_theme['google_api_key']); ?>" />

            <input type="hidden" id="google_recaptcha_error_text" value="<?php echo esc_html__('Oops You are spammer ! or Check your Google reCaptcha keys.', 'adforest'); ?>" />

            <input type="hidden" id="no-result-found" value="<?php echo esc_html__('No results found', 'adforest'); ?>" />

            <input type="hidden" id="verification-notice" value="<?php echo esc_html__('Verification code has been sent to ', 'adforest'); ?>" />

            <input type="hidden" id="confirm_delete" value="<?php echo __('Are you sure to delete this?', 'adforest'); ?>" />

            <input type="hidden" id="confirm_update" value="<?php echo __('Are you sure to update this?', 'adforest'); ?>" />

            <input type="hidden" id="ad_updated" value="<?php echo __('Ad updated successfully.', 'adforest'); ?>" />

            <input type="hidden" id="ad_posted" value="<?php echo __('Ad Posted successfully.', 'adforest'); ?>" />

            <input type="hidden" id="redirect_uri" value="<?php echo esc_url($adforest_theme['redirect_uri']); ?>" />

            <input type="hidden" id="select_place_holder" value="<?php echo __('Select an option', 'adforest'); ?>" />

            <input type="hidden" id="is_sticky_header" value="<?php echo esc_attr($adforest_theme['sb_sticky_header']); ?>" />

            <input type="hidden" id="required_images" value="<?php echo __('Images are required.', 'adforest'); ?>" />

            <input type="hidden" id="ad_limit_msg" value="<?php echo __('Your package has been used or expired, please purchase now.', 'adforest'); ?>" />

            <input type="hidden" id="is_sub_active" value="1" />

            <input type="hidden" id="custom-theme-color" value="<?php echo esc_attr($custom_theme_color); ?>" />

            <input type="hidden" id="invalid_phone" value="<?php echo esc_attr__('Invalid format , Valid format is +16505551234', 'adforest'); ?>" />

            <input type="hidden" id="custom-hover-color" value="<?php echo esc_attr($custom_btn_hover_color); ?>" />

            <input type="hidden" id="custom-border-color" value="<?php echo esc_attr($custom_btn_border_color); ?>" />

            <input type="hidden" id="sb-lang-code" value="<?php echo get_bloginfo('language'); ?>" />

            <input type="hidden" id="sb-pre-code" value="<?php echo esc_attr($sb_precode) ?>" />







            <?php

            $slider_item = 2;

            if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && ($page_template == 'taxonomy-ad_cats.php' || $page_template == 'taxonomy-ad_country.php')) {



                $search_cat_page = isset($adforest_theme['search_cat_page']) && $adforest_theme['search_cat_page'] ? TRUE : FALSE;

                if ($search_cat_page) {

                    $slider_item = 3;

                } else {

                    $slider_item = 4;

                }

            } else if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && !is_page_template('page-search.php') && !is_singular('ad_post') && !is_singular('page')) {

                $slider_item = 3;

            } else if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['search_design']) && $adforest_theme['search_design'] == 'topbar' && is_page_template('page-search.php')) {



                $slider_item = 4;

            } else if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['search_design']) && $adforest_theme['search_design'] == 'sidebar' && is_page_template('page-search.php')) {



                $slider_item = 3;

            } else if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['search_design']) && $adforest_theme['search_design'] == 'map' && is_page_template('page-search.php')) {

                $slider_item = 2;

            } else if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && is_singular('ad_post')) {

                $slider_item = 4;

            } else if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && is_singular('page')) {

                $slider_item = 4;

            }



            $time_zones_val = isset($adforest_theme['bid_timezone']) && $adforest_theme['bid_timezone'] != '' ? $adforest_theme['bid_timezone'] : 'Etc/UTC';

            if (function_exists('adforest_timezone_list') && isset($adforest_theme['bid_timezone']) && $adforest_theme['bid_timezone'] != '') {

                $time_zones_val = adforest_timezone_list('', $adforest_theme['bid_timezone']);

                date_default_timezone_set($time_zones_val);

            }

            echo '<input type="hidden" id="sb-bid-timezone" value="' . $time_zones_val . '"/>';

            ?>

            <input type="hidden" id="slider_item" value="<?php echo esc_attr($slider_item); ?>" />

            <?php

            $yes = 0;

            $not_time = '';



            if (isset($adforest_theme['msg_notification_on']) && isset($adforest_theme['communication_mode']) && ($adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message')) {

                $yes = $adforest_theme['msg_notification_on'];

                $not_time = $adforest_theme['msg_notification_time'];

            }

            $unread_msgs = ADFOREST_MESSAGE_COUNT; /* Message count define in header */

            ?>

            <input type="hidden" id="msg_notification_on" value="<?php echo esc_attr($yes); ?>" />

            <input type="hidden" id="msg_notification_time" value="<?php echo esc_attr($not_time); ?>" />

            <input type="hidden" id="is_unread_msgs" value="<?php echo esc_attr($unread_msgs); ?>" />

        <?php } else { ?>

            <input type="hidden" id="is_sub_active" value="0" />

        <?php }

        $transparent_flag = false;



        $sb_header_style   =   isset($adforest_theme['sb_header'])  ? $adforest_theme['sb_header'] : "";





        if ($sb_header_style  &&   $sb_header_style == 'transparent-2' || $sb_header_style == 'transparent-3' || $sb_header_style == 'modern') {

            $transparent_flag = true;

        }

        $menu_color = '#000';

        if (isset($adforest_theme['sb_header']) && $transparent_flag && isset($adforest_theme['sb_menu_color']) && isset($adforest_theme['sb_menu_color_single'])) {

            $menu_color = is_singular('ad_post') ? $adforest_theme['sb_menu_color_single'] : $adforest_theme['sb_menu_color'];

        }

        $sb_static_logo = isset($adforest_theme['sb_site_logo']['url'])  ?  $adforest_theme['sb_site_logo']['url']  : "";

        if (is_singular('ad_post')) {

            $page_template = 'single-ad_post.php';

            if (isset($adforest_theme['ad_layout_style_modern']) && $adforest_theme['ad_layout_style_modern'] == 5) {

                $sb_static_logo = $adforest_theme['sb_site_logo_for_single']['url'];

            }

        } else if (basename($template) == 'page-home.php') {

            $sb_static_logo = $adforest_theme['sb_site_logo_for_home']['url'];

        }

        $browser_notif_message = false;
        $browser_notif_heats = false;
        if (is_user_logged_in()) {
            $browser_notif_message = filter_var( get_user_meta(get_current_user_id(), "browser_notif_message")[0], FILTER_VALIDATE_BOOLEAN);
            $browser_notif_heats = filter_var( get_user_meta(get_current_user_id(), "browser_notif_heats")[0], FILTER_VALIDATE_BOOLEAN);
        }

        echo '<input type="hidden" id="browser_notif_message_on" value="'.$browser_notif_message.'" />';
        echo '<input type="hidden" id="browser_notif_heats_on" value="'.$browser_notif_heats.'" />';

        /*$front_page = is_front_page() || is_home() ? '1' : '2';*/

        $front_page = '2';

        if (is_front_page() && is_home()) {

            $front_page = '1';

        } elseif (is_front_page()) {

            $front_page = '1';

        } elseif (is_home()) {

            $front_page = '2';

        } else {

            $front_page = '2';

        }



        $is_mobile = wp_is_mobile() ? 1 : 2;

        ?>

        <input type="hidden" id="sticky_sb_logo" value="<?php echo esc_url($adforest_theme['sb_site_logo_for_transparent']['url']); ?>" />

        <input type="hidden" id="static_sb_logo" value="<?php echo esc_url($sb_static_logo); ?>" />

        <input type="hidden" id="sb_header_type" value="<?php echo esc_attr($adforest_theme['sb_header']); ?>" />

        <input type="hidden" id="sb_menu_color" value="<?php echo esc_attr($menu_color); ?>" />

        <input type="hidden" id="sb_page_template" value="<?php echo esc_attr($page_template); ?>" />

        <input type="hidden" id="sb_is_mobile" value="<?php echo esc_attr($is_mobile); ?>" />

        <input type="hidden" id="sb_is_homepage" value="<?php echo esc_attr($front_page); ?>" />

        <?php get_template_part('template-parts/linkedin', 'access'); ?>

        <?php get_template_part('template-parts/verification', 'logic'); ?>

        <?php get_template_part('template-parts/layouts/sell', 'button'); ?>

        <?php get_template_part('template-parts/layouts/scroll', 'up'); ?>

        <?php



        if (isset($adforest_theme['sb_android_app']) && $adforest_theme['sb_android_app']) {

            if (!function_exists('adforest_app_notifier_html')) {

                function adforest_app_notifier_html()

                {

                    get_template_part('template-parts/app', 'notifier');

                }

            }

            do_action('adforestAction_app_notifier', 'adforest_app_notifier_html');

        }

        $footer_js   =    isset($adforest_theme['footer_js_and_css'])  ?   $adforest_theme['footer_js_and_css'] : "";

        echo adforest_returnEcho($footer_js);

    }

}

add_action('wp_footer', 'sb_add_footer_hidden_fields');





if (in_array('elementor-pro/elementor-pro.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    add_action('elementor/theme/register_locations', 'sb_pro_register_elementor_locations');

    function sb_pro_register_elementor_locations($elementor_theme_manager)

    {



        $elementor_theme_manager->register_location('header');

        $elementor_theme_manager->register_location('footer');

    }

}

add_action('wp_head', 'sb_add_custom_header');

if (!function_exists('sb_add_custom_header')) {

    function sb_add_custom_header()

    {

        global $adforest_theme, $wpdb;

        $user_id = get_current_user_id();

        $user_info = get_userdata($user_id);

        $unread_msgs = 0;

        if ($user_id > 0) {

            $unread_msgs = $wpdb->get_var("SELECT COUNT(meta_id) FROM $wpdb->commentmeta WHERE comment_id = '$user_id' AND meta_value = '0' ");

        }

        define('ADFOREST_MESSAGE_COUNT', $unread_msgs);

        $args = array(
            'post_type' => 'ad_post',
            'post_status' => 'publish',
            'author' => get_current_user_id(),
            'meta_query' => array(
                array(
                    'key'     => 'package_ad_expiry_days',
                    'compare' => 'EXISTS',
                ),
            ),
        );

        $the_query = new WP_Query($args);

        if($the_query->have_posts()):
            while($the_query->have_posts()) : $the_query->the_post();
                $expire_date = get_post_meta(get_the_ID(), 'package_ad_expiry_days', true);
                $time_diff = strtotime($expire_date) - time();

                if($time_diff <= 24 * 60 * 60 && get_current_user_id() > 0){
                    sa_update_notification(get_the_ID(), get_current_user_id(), get_current_user_id(), "6");                    
                }
            endwhile;
        endif;

        wp_reset_postdata();

        sb_set_cookie_badges();

    }

}

add_action('wp_ajax_nopriv_social_login', 'social_login');



function social_login()

{

    global $wpdb; // this is how you get access to the database



    if (!is_user_logged_in()) {

        $user_login = '';



        $user = get_user_by('email', $_POST['email']);

        if (!empty($user)) {

            $user_login = $user->user_login;

        }

        if (empty($user_login)) {

            $user = get_user_by('login', $_POST['username']);

        }



        if (!empty($user)) {



            clean_user_cache($user->ID);

            wp_clear_auth_cookie();

            wp_set_current_user($user->ID);

            wp_set_auth_cookie($user->ID, true, false);



            update_user_caches($user);

        } else {



            $password = rand(123456, 999999);

            $userdata = array(

                'user_login'    =>   $_POST['username'],

                'user_email'    =>   $_POST['email'],

                'user_pass'     =>   $password,

                'first_name'    =>   $_POST['first_name'],

                'last_name'     =>   $_POST['last_name'],

                'role'            =>  'dealer'

            );

            $user_id = wp_insert_user($userdata);

            if ($user_id) {

                $first_name = $_POST['first_name'];

                $last_name = $_POST['last_name'];

                $username = $_POST['username'];

                $email = $_POST['email'];

                // send an email to the admin alerting them of the registration

                //wp_new_user_notification($user_id);

                // log the new user in



                $headers[] = 'Content-Type: text/html; charset=UTF-8';



                $headers[] = 'Bcc: Triphooks <reviewcost@gmail.com>';



                //Mail to site administrator (Start Here)



                $to = get_option('admin_email');



                $subject = "Dear Admin! $first_name $last_name has registered on Triphooks.co.uk";



                $templateBody = '';

                $templateBody = get_post_meta(704, 'template_body');

                $templateBodyToSend = str_replace('%DATE%', date("M, d.m.Y"), $templateBody[0]);

                $templateBodyToSend = str_replace('%YEAR%', date("Y"), $templateBodyToSend);



                $templateBodyToSend = str_replace('%NAME%', $first_name . ' ' . $last_name, $templateBodyToSend);

                $templateBodyToSend = str_replace('%EMAIL%', $email, $templateBodyToSend);

                $templateBodyToSend = str_replace('%USERNAME%', $username, $templateBodyToSend);



                $message = $templateBodyToSend;



                //echo $message;

                //echo '<br>---------------------------------------------<br>';

                $adminMailResult = false;

                $adminMailResult = wp_mail($to, $subject, $message, $headers);



                //wp_mail($to, $subject, $message, $headers);



                //Mail to site administrator (End Here)



                //Mail to registered user (Start Here)



                $to = $email;



                $subject = "Dear " . $first_name . "! you are successfully registered on Triphooks.co.uk";



                $templateBody = '';

                $templateBody = get_post_meta(706, 'template_body');

                $templateBodyToSend = str_replace('%DATE%', date("M, d.m.Y"), $templateBody[0]);

                $templateBodyToSend = str_replace('%YEAR%', date("Y"), $templateBodyToSend);



                $templateBodyToSend = str_replace('%NAME%', $first_name . ' ' . $last_name, $templateBodyToSend);

                $templateBodyToSend = str_replace('%USERNAME%', $username, $templateBodyToSend);

                $templateBodyToSend = str_replace('%EMAIL%', $email, $templateBodyToSend);

                $templateBodyToSend = str_replace('%PASSWORD%', $password, $templateBodyToSend);



                $message = $templateBodyToSend;



                //echo $message;exit;



                $userMailResult = false;

                $userMailResult = wp_mail($to, $subject, $message, $headers);

                //wp_mail($to, $subject, $message, $headers);

                //Mail to registered user (End Here)

                if ($adminMailResult && $userMailResult) {

                    wp_setcookie($_POST['username'], $password, true);

                    wp_set_current_user($user_id, $username);

                    do_action('wp_login', $_POST['username']);

                }

            }

        }

    }

}



































/**

 * Custom Badges

 */

function sa_update_type()

{

    if (isset($_GET['way'])) {

        $way = $_GET['way'];

        $pid = $_GET['id'];

        $value = get_post_meta($pid, 'sa_adtype', true) ? get_post_meta($pid, 'sa_adtype', true) : 0;

        if ($way == 'up') {

            update_post_meta($pid, 'sa_adtype', intval($value) + 1);

        } else if ($way == 'down') {

            update_post_meta($pid, 'sa_adtype', intval($value) - 1);

        }

    }

}

add_action('init', 'sa_update_type');

function sa_get_author_badges($pid)

{
    $badges = array(

        array(

            'title' => 'Habanero',

            'description' => 'Félicitations ! 5 de vos deals ont été les plus hot du jour !',

            'status' => false

        ),

        array(

            'title' => 'Jalapeño',

            'description' => 'Pas mal ! 1 de vos deals a été le plus hot du jour !',

            'status' => false

        ),

        array(

            'title' => 'Marie et Pierre',

            'description' => 'Une de vos publications a recueilli au moins 500 commentaires',

            'status' => false

        ),

        array(

            'title' => 'Fred et Jamy',

            'description' => 'Une de vos publications a recueilli au moins 200 commentaires',

            'status' => false

        ),

        array(

            'title' => 'Igor et Grichka',

            'description' => 'Une de vos publications a recueilli au moins 50 commentaires',

            'status' => false

        ),

        array(

            'title' => 'Bombe atomique',

            'description' => 'Un de vos deals a atteint au moins 1500°',

            'status' => false

        ),

        array(

            'title' => 'Flamme',

            'description' => 'Un de vos deals a atteint au moins 600°',

            'status' => false

        ),

        array(

            'title' => 'Étincelle',

            'description' => 'Un de vos deals a atteint au moins 250°',

            'status' => false

        ),

        array(

            'title' => 'Menace nucléaire',

            'description' => 'Vous obtiendrez ce badge quand la somme des degrés de tous vos bons plans postés sur le site dépassera 5000°',

            'status' => false

        ),

        array(

            'title' => 'Prophète',

            'description' => 'Vous avez joué avec nous à pronostiquer – et même si vous avez misé sur une victoire de l\'Allemagne en 2018, l\'important c\'est de participer !',

            'status' => false

        ),

        array(

            'title' => 'Diamant',

            'description' => 'Cinquante de vos bons plans ont été choisis pour être mis en avant sur la page "À la Une"',

            'status' => false

        ),

        array(

            'title' => 'Rubis',

            'description' => 'Dix de vos bons plans ont été choisis pour être mis en avant sur la page "À la Une"',

            'status' => false

        ),

        array(

            'title' => 'Émeraude',

            'description' => 'Trois de vos bons plans ont été choisis pour être mis en avant sur la page "À la Une"',

            'status' => false

        ),

        array(

            'title' => 'Canicule',

            'description' => 'La température moyenne de vos deals de ces 30 derniers jours est supérieure à 100°. Attention, ce badge est très facile à perdre !',

            'status' => false

        ),

        array(

            'title' => 'Responsable du labo',

            'description' => 'Vous avez posté au moins 100 deals',

            'status' => false

        ),

        array(

            'title' => 'Biologiste',

            'description' => 'Vous avez posté au moins 40 deals',

            'status' => false

        ),

        array(

            'title' => 'Cobaye',

            'description' => 'Vous avez posté au moins 10 deals',

            'status' => false

        ),

        array(

            'title' => 'Altruiste',

            'description' => 'Vous aimez partager ? Vous obtiendrez ce badge lorsque vous aurez posté 20 bons plans ayant dépassé 100° !',

            'status' => false

        ),

        array(

            'title' => 'Astrophysique',

            'description' => 'Vos commentaires ont été aimés au moins 800 fois',

            'status' => false

        ),

        array(

            'title' => 'Alchimie',

            'description' => 'Vos commentaires ont été aimés au moins 250 fois',

            'status' => false

        ),

        array(

            'title' => 'Chimie',

            'description' => 'Vos commentaires ont été aimés au moins 80 fois',

            'status' => false

        ),

        array(

            'title' => 'Thèse scientifique',

            'description' => 'Vous avez posté au moins 1000 commentaires',

            'status' => false

        ),

        array(

            'title' => 'Mémoire de maîtrise',

            'description' => 'Vous avez posté au moins 400 commentaires',

            'status' => false

        ),

        array(

            'title' => 'Rapport de stage',

            'description' => 'Vous avez posté au moins 100 commentaires',

            'status' => false

        ),

        array(

            'title' => 'Jury de thèse',

            'description' => 'Vous avez voté sur 3000 deals',

            'status' => false

        ),

        array(

            'title' => 'Professeur',

            'description' => 'Vous avez voté sur 1200 deals',

            'status' => false

        ),

        array(

            'title' => 'Surveillant',

            'description' => 'Vous avez voté sur 300 deals',

            'status' => false

        ),

        array(

            'title' => 'Élève modèle',

            'description' => 'Vous avez rempli tout votre profil, et vous avez même lié votre profil Facebook. Prenez un bon point !',

            'status' => false

        ),

        array(

            'title' => 'Prix Nobel',

            'description' => 'Ce badge est décerné à la main par l\'équipe et sur des critères obscurs et subjectifs.',

            'status' => false

        ),

        array(

            'title' => 'Belle personne',

            'description' => 'T\'es sympa toi, non ?',

            'status' => false

        ),

        array(

            'title' => 'Fusée',

            'description' => 'Badge temporaire ! Vous l\'obtiendrez en ayant posté le deal le plus hot des 30 derniers jours, restez sur vos gardes pour ne pas vous faire voler la vedette :).',

            'status' => false

        ),

        array(

            'title' => 'Attrape moi si tu peux',

            'description' => 'Bravo ! Vous avez attrapé au moins un renne enflammé ! Si vous continuez sur cet élan, qui sait ce que l\'avenir vous réserve ?',

            'status' => false

        ),

        array(

            'title' => 'Qui va à la chasse',

            'description' => 'Vous avez attrapé au moins dix rennes enflammés et échangé des rennes au moins deux fois. Félicitations, on peut dire que vous tenez les rênes de la situation !',

            'status' => false

        ),

        array(

            'title' => 'Quand on aime, on ne compte pas',

            'description' => 'Ce n\'est pas une collection, c\'est une obsession ! Vous avez au moins 20 Rennes enflammés identiques dans votre tableau.',

            'status' => false

        ),

        array(

            'title' => 'Pepper x',

            'description' => 'Incroyable ! 20 de vos deals ont été les plus hot du jour !',

            'status' => false

        ),

    );

    // helpers

    $uid = get_current_user_id();

    // sold more than > Badges 10 / 40 / 100

    $ad_count = adforest_get_all_ads($pid);

    if ($ad_count > 10) {
        $badges[16]['status'] = true;
    }

    if ($ad_count > 40){
        $badges[15]['status'] = true;
    }

    if ($ad_count > 100) {
        $badges[14]['status'] = true;
    }


    // Commented More Than 100 / 400 / 1000

    $author_comments = get_comments(array('post_author' => $pid));

    $au_count = count($author_comments);

    if ($au_count > 100) {
        $badges[23]['status'] = true;
    }

    if ($au_count > 400) {
        $badges[22]['status'] = true;
    }

    if ($au_count > 1000) {
        $badges[21]['status'] = true;
    }


    // Author Posts Comments 50 / 200 / 500

    $author_post_comments_count = 0;

    $the_query = new WP_Query(array(

        'author' => $pid,

        'posts_per_page' => 500,

    ));

    if ($the_query->have_posts()) {

        while ($the_query->have_posts()) : $the_query->the_post();

            $author_post_comments_count += get_comments_number(get_the_ID());

        endwhile;

    }

    wp_reset_query();

    if ($author_post_comments_count > 50) {
        $badges[4]['status'] = true;
    }

    if ($author_post_comments_count > 200) {
        $badges[3]['status'] = true;
    }

    if ($author_post_comments_count > 500) {
        $badges[2]['status'] = true;
    }


    // Hotness of deals 250/600/1500

    $hottest_deal = intval(sa_author_hottest_ad($pid));

    if ($hottest_deal > 250) {
        $badges[7]['status'] = true;
    }

    if ($hottest_deal > 600) {
        $badges[6]['status'] = true;
    }

    if ($hottest_deal > 1500) {
        $badges[5]['status'] = true;
    }


    // Votes of deals 300/1200/3000

    $downvotes = get_user_meta($uid, 'sa_downvotes', true);

    $upvotes = get_user_meta($uid, 'sa_upvotes', true);

    $downvotes_count = count(explode(',', $downvotes));

    $upvotes_count = count(explode(',', $upvotes));

    $votes_count = $downvotes_count + $upvotes_count;

    if ($votes_count > 2) {
        $badges[26]['status'] = true;
    }

    if ($votes_count > 1200) {
        $badges[25]['status'] = true;
    }

    if ($votes_count > 3000) {
        $badges[24]['status'] = true;
    }

    return $badges;

}



















class Sa_Ad

{



    public function init()

    {



        add_action('wp_enqueue_scripts', [$this, 'enqueue']);



        add_action('admin_menu', [$this, 'add_metabox']);

        add_action('save_post', [$this, 'save_meta'], 10, 2);

        add_filter('manage_ad_post_posts_columns', [$this, 'set_edit_columns']);

        add_action('manage_ad_post_posts_custom_column', [$this, 'custom_column'], 10, 2);



        /* Voting ajax */

        add_action('wp_ajax_sa_vote_change', [$this, 'sa_vote_change']);

        add_action('wp_ajax_nopriv_sa_vote_change', [$this, 'sa_vote_change']);

        /* Search ajax */

        add_action('wp_ajax_sa_search', [$this, 'sa_search']);

        add_action('wp_ajax_nopriv_sa_search', [$this, 'sa_search']);

        /* Follow ajax */

        add_action('wp_ajax_sa_follow', [$this, 'sa_follow']);

        add_action('wp_ajax_nopriv_sa_follow', [$this, 'sa_search']);

        /* Autoload ajax */

        add_action('wp_ajax_sa_adposts_load', [$this, 'sa_adposts_load']);

        add_action('wp_ajax_nopriv_sa_adposts_load', [$this, 'sa_adposts_load']);

		/* Post Discussion ajax */

        add_action('wp_ajax_sa_post_discussion', [$this, 'sa_post_discussion']);

		/* Settings ajax */

        add_action('wp_ajax_sa_settings', [$this, 'sa_settings']);

    }



    public function enqueue()

    {

        wp_localize_script('adforest-custom', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));

        wp_enqueue_script('adforest-custom');

    }



    public function add_metabox()

    {

        add_meta_box(

            'sa_metabox', // metabox ID

            'Post Settings', // title

            [$this, 'metabox_callback'], // callback function

            'ad_post', // post type or post types in array

            'normal', // position (normal, side, advanced)

            'high' // priority (default, low, high, core)

        );

    }



    public function metabox_callback($post)

    {

        $sa_adtype = get_post_meta($post->ID, 'sa_adtype', true);

        $sa_adcoupon = get_post_meta($post->ID, 'sa_adcoupon', true);

        wp_nonce_field('somerandomstr', '_sanonce');

        echo '<table class="form-table">

		<tbody>

			<tr>

				<th><label for="sa_adtype">Ad Type</label></th>

				<td>

					<select name="sa_adtype" id="sa_adtype" class="regular-text">

						<option value="coupon" ' . ($sa_adtype == 'coupon' ? 'selected' : '') . '>Coupon</option>

						<option value="deal" ' . ($sa_adtype == 'deal' ? 'selected' : '') . '>Deal</option>

					</select>

				</td>

			</tr>

			<tr class="tr_coupon">

				<th><label for="sa_adcoupon">Ad Coupon</label></th>

				<td><input type="text" id="sa_adcoupon" name="sa_adcoupon" value="' . esc_attr(($sa_adcoupon) ? $sa_adcoupon : 0) . '" class="regular-text"></td>

			</tr>

		</tbody>

	</table>

	<script>

		if ( jQuery("select[name=sa_adtype]").val() == "coupon") {

			jQuery(".tr_coupon").removeClass("hidden");

		} else {

			jQuery(".tr_coupon").addClass("hidden");

		}

		jQuery("select[name=sa_adtype]").on("change", function(){

			if ( jQuery(this).val() == "coupon") {

				jQuery(".tr_coupon").removeClass("hidden");

			} else {

				jQuery(".tr_coupon").addClass("hidden");

			}

		});

	</script>

	';

    }



    function save_meta($post_id, $post)

    {



        // nonce check

        if (!isset($_POST['_sanonce']) || !wp_verify_nonce($_POST['_sanonce'], 'somerandomstr')) return $post_id;



        // check current use permissions

        $post_type = get_post_type_object($post->post_type);

        if (!current_user_can($post_type->cap->edit_post, $post_id)) return $post_id;



        // Do not save the data if autosave

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;



        // define your own post type here

        if ($post->post_type != 'ad_post') return $post_id;



        (isset($_POST['sa_adtype'])) ? update_post_meta($post_id, 'sa_adtype', sanitize_text_field($_POST['sa_adtype'])) : delete_post_meta($post_id, 'sa_adtype');

        (isset($_POST['sa_adcoupon'])) ? update_post_meta($post_id, 'sa_adcoupon', sanitize_text_field($_POST['sa_adcoupon'])) : delete_post_meta($post_id, 'sa_adcoupon');



        return $post_id;

    }



	public function sa_settings() {

		if (!wp_verify_nonce($_REQUEST['nonce'], "sa_settings"))

            exit("No naughty business please");

		$uid = intval(get_current_user_id());

		$name = $_REQUEST['name'];

		$value = ($_REQUEST['value']) ? $_REQUEST['value'] : false;

		$to_do = (isset($_REQUEST['to_do']) && $_REQUEST['to_do'] === 'remove') ? false : true;

		if ( !$to_do ) $value = null;

		

		update_user_meta($uid, $name, $value);

        

		$output = (!is_null($value)) ? "<ul class='subs-list'><li><span>Newsletter quotidienne</span><button class='rm'>x</button></li></ul>" : false;

      	$result = array(

			'name' => $name,

			'value' => $value,

			'uid' => $uid,

			'output' => $output,

		);

        echo json_encode($result, true);

        die();

	}



    public function sa_follow()

    {



        if (!wp_verify_nonce($_REQUEST['nonce'], "sa_follow"))

            exit("No naughty business please");



        $uid = $_REQUEST['uid'];

        $cid = strval(get_current_user_id());

        $follow = $_REQUEST['follow'];

        $followers_meta = get_user_meta($uid, 'sa_followers', true);

        $followers = explode(',', $followers_meta);

        $followers = (empty($followers)) ? array() : $followers;

        $done = false;

        if ($follow === 'unfollow' && in_array($cid, $followers)) { // UNFOLLOW

            $key = array_search($cid, $followers);

            unset($followers[$key]);



            $done = true;

        } else if ($follow === 'follow' && !in_array($cid, $followers)) { // FOLLOW

            array_push($followers, $cid);

            $done = true;

        }





        if ($done) {

            $new_followers = array_filter($followers);

            $new_followers_value = implode(',', $new_followers);



            update_user_meta($uid, 'sa_followers', $new_followers_value);

        }



        $result = array(

            'status' => $done,

            'followers' => $followers,

            'filtered' => $new_followers,

        );

        echo json_encode($result, true);

        die();

    }



    public function sa_vote_change()

    {



        if (!wp_verify_nonce($_REQUEST['nonce'], "sa_vote_change_nonce"))

            exit("No naughty business please");



        $way = $_REQUEST['way'];

        $pid = $_REQUEST['id'];







        $value = get_post_meta($pid, 'sa_advote', true);

        $value = ($value) ? intval($value) : 0;



        $uid = get_current_user_id();

        // get pre data

        $downvotes = get_user_meta($uid, 'sa_downvotes', true);

        $upvotes = get_user_meta($uid, 'sa_upvotes', true);

        // generate data arrays

        $downvotes_arr  = explode(',', $downvotes);

        $upvotes_arr  = explode(',', $upvotes);

        // updating array

        if (isset($way) && $way == '+') {

            if (!in_array($pid, $upvotes_arr)) {

                array_push($upvotes_arr, $pid);

                update_user_meta($uid, 'sa_upvotes', implode(',', $upvotes_arr));

            }

            $newVal = $value + 1;

        } else if (isset($way) && $way == '-') {

            if (!in_array($pid, $downvotes_arr)) {

                array_push($downvotes_arr, $pid);

                update_user_meta($uid, 'sa_downvotes', implode(',', $downvotes_arr));

            }

            $newVal = $value - 1;

        } else {

            $newVal = $value;

        }



        update_post_meta($pid, 'sa_advote', sanitize_text_field($newVal));


        $author_id = get_post_field( 'post_author', $pid );


        if($newVal == 100){

            update_post_meta($pid, 'sa_advote_hot', '1');

            sa_update_notification($pid, get_current_user_id(), $author_id, "5");

        }

        sa_update_notification($pid, get_current_user_id(), $author_id, "3");

        echo $newVal;

        die();

    }



    // Add the custom columns to the book post type:

    public function set_edit_columns($columns)

    {

        $res = array_slice($columns, 0, 2, true) + array("sa_settings" => "Ad Info") + array_slice($columns, 2, count($columns) - 1, true);

        return $res;

    }



    // Add the data to the custom columns for the book post type:

    public function custom_column($column, $post_id)

    {

        switch ($column) {

            case 'sa_settings':

                $content = '<span style="background: var(--e-context-primary-color); color: #fff; padding: .1rem .4rem; border-radius: 3px; text-transform: capitalize;">' . get_post_meta($post_id, 'sa_adtype', true) . '</span><br>';

                if (get_post_meta($post_id, 'sa_adtype', true) == 'coupon') {

                    $content .= '<h4 style="margin: 0;">' . get_post_meta($post_id, 'sa_adcoupon', true) . '</h4><hr>';

                }

                $content .= '<a href="' . esc_url(get_post_meta($post_id, 'sa_adtype', true)) . '" target="_blank">' . get_post_meta($post_id, 'sa_adurl', true) . '</a>';

                echo $content;

                break;

        }

    }





    public function sa_adposts_load()

    {



        if (!wp_verify_nonce($_REQUEST['nonce'], "sa_adposts_load")) exit("No naughty business please");



        // pre values

        $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

        $nav = isset($_REQUEST['nav']) ? $_REQUEST['nav'] : 1;

        $feed_type = isset($_REQUEST['feed']) ? $_REQUEST['feed'] : 'default';

        $posts_per_page = intval(get_option('posts_per_page'));

        $ad_count = wp_count_posts('ad_post')->publish;

        $pages_count = ceil($ad_count / $posts_per_page);

        $offset = $page * $posts_per_page;

        $current = intval($page);

        $status = true;

        $taxonomy = (isset($_REQUEST['tax'])) ? $_REQUEST['tax'] : false;

        $term_id = (isset($_REQUEST['term'])) ? $_REQUEST['term'] : false;

		$taxonomy_array = (!$taxonomy || !$term_id) ? array() : array($taxonomy, intval($term_id)) ;

        $post_type = (isset($_REQUEST['ptype'])) ? $_REQUEST['ptype'] : 'ad_post';

        if (isset($_REQUEST['autoload'])) {

            $current += 1;

        } else {

            switch ($nav) {

                case 'next':

                    $current += 1;

                    break;

                case 'prev':

                    $current -= 1;

                    break;

                default:

                    $current = intval($nav);

                    break;

            }

        }



        // args

        $queryArgs = feed_args_generator($feed_type, false, $current, $posts_per_page, $taxonomy_array, $post_type);



        // The Query

        $the_query = new WP_Query($queryArgs);

        // The Loop

        if ($the_query->have_posts()) {

            $output = "<ul class='sa-listings' data-page='$current' data-ptype='$post_type'>";

            while ($the_query->have_posts()) {

                $the_query->the_post();

                $status2 = true;

                $locations = wp_get_post_terms(get_the_ID(),'ad_country');



                foreach ( $locations as $location) {

                    if($location->slug == 'morocco'){

                        if(isset($_REQUEST['hide_local']) && $_REQUEST['hide_local'] == 'on'){

                            $status2 = false;

                        }

                    }

                }

                if(isset($_REQUEST['hide_feature']) && $_REQUEST['hide_feature'] == 'on'){

                    if(get_post_meta(get_the_ID(), '_adforest_is_feature', true) == '1'){

                        $status2 = false;

                    }



                }

                if($status2){

                    $output .= sa_ad_layout_list(get_the_ID(), $post_type);

                }

                

                

                

            }

            $output .= "</ul>";

        } else {

            $status = false;

        }

        /* Restore original Post Data */

        wp_reset_postdata();



        /* Generate Pagination */



        $result = array(

            'query' => $queryArgs,

            'feed' => $feed_type,

            'offset' => $offset,

            'count' => $ad_count,

            'pages' => $pages_count,

            'current' => $current,

            'items' => $output,

            'status' => $status,

        );

        echo json_encode($result, true);

        die();

    }

	

	/* Post Discussion Ajax */

	public function sa_post_discussion() {

		

		if (!wp_verify_nonce($_REQUEST['nonce'], "sa_post_discussion")) exit("No naughty business please");

		

		if ( is_user_logged_in() ) {



			// pre values

			$title = $_REQUEST['title'];

			$group = $_REQUEST['groups'];

			$category = $_REQUEST['category'];

			$description = $_REQUEST['description'];

			$tag = $_REQUEST['tags'];



			// Gather post data.

			$discussion_data = array(

				'post_title'    => $title,

				'post_content'  => stripslashes( $description ),

				'post_status'   => 'publish',

				'post_author'   => get_current_user_id(),

				'post_type'   => 'discussions',

				'tax_input'    => array(

					'discussion_groups' => array( intval($group) ),

					'discussion_categories' => array( intval($category) ),

				)

			);



			// Insert the post into the database.

			$discussion_id = wp_insert_post( $discussion_data );



			$resp = 'post added';

		} else {

			$resp = 'user not logged in';

		}

		$result = array(

			'status_text' => $resp,

			'title' => $title,

			'url' => get_permalink($discussion_id),

		);

		

        echo json_encode($result, true);

        die();

		

	}



    /* Search Ajax */

    public function sa_search()

    {



        if (!wp_verify_nonce($_REQUEST['nonce'], "sa_search")) exit("No naughty business please");



        // pre values

        $query = $_REQUEST['q'];



        // Deals

        $the_query = new WP_Query(array(

            'suppress_filters' => true,

            'post_type' => 'ad_post',

            'post_status' => 'publish',

            'posts_per_page' => 4,

            's' => $query

        ));

        if ($the_query->have_posts()) :

            $deals = "<header><span>Resultats</span></header>";

            $deals .= "<ul class='sa-ads'>";

            while ($the_query->have_posts()) : $the_query->the_post();

                $deals .= "<li class='article'>";

                $deals .= "<a href='" . esc_url(get_permalink()) . "'>";

                if (has_post_thumbnail()) {

                    $deals .= get_the_post_thumbnail(get_the_ID(), 'thumbnail', array());

                } else {

                    $deals .= "<img src='" . esc_url(adforest_get_ad_default_image_url('adforest-ads-medium')) . "' />";

                }

                $deals .= "<div class='details'><span class='title'>" . get_the_title() . "</span>";

                $deals .= "<div class='price'>" . adforest_adPrice(get_the_ID()) . "</div>";

                $deals .= "</div></a>";

                $deals .= "</li>";

            endwhile;

            $deals .= "</ul>";

        else : $deals = false;

        endif;

        wp_reset_postdata();



        /* Groups */

        $cats = get_terms(

            array(

                'taxonomy' => 'ad_cats',

                'orderby' => 'name',

                'order'   => 'ASC',

                'hide_empty' => 1,

                //'name__like' => $query,

                //'number' => 4,

            )

        );

        if ($cats) {

            $groups = "<header><span>Groupes</span></header>";

            foreach ($cats as $key => $cat) {

                $thumb_id = get_term_meta($cat->term_id, 'category-image-id', true);

                if (!empty($thumb_id)) {

                    $groups .= "<ul class='sa-cats'>";

                    $groups .= "<li>";

                    $groups .= "<a href='" . esc_url(get_category_link($cat->term_id)) . "'>";

                    $groups .= wp_get_attachment_image($thumb_id, array(150, 150), array('alt' => $cat->name));

                    $groups .= "<div><span class='title'>" . $cat->name . "</span></div>";

                    $groups .= "</a>";

                    $groups .= "</li>";

                    $groups .= "</ul>";

                }

            }

        } else {

            $groups = false;

        }



        // users

        $users_array = new WP_User_Query(array(

            'search'         => '*' . esc_attr($query) . '*',

            'search_columns' => array(

                'user_login',

                'user_nicename',

                'user_email',

            ),

        ));

        $users_found = $users_array->get_results();

        if ($users_found) {

            $users = "<header><span>Members</span></header>";

            $users .= "<ul class='sa-users'>";

            foreach ($users_found as $user) {

                $data = $user->data;

                $user_pic = adforest_get_user_dp($date->ID, 'adforest-user-profile');

                $users .= "<li>";

                $users .= "<a href='#'>";

                $users .= "<img src='" . esc_url($user_pic) . "' height='50' width='50' alt='" . esc_attr($data->display_name) . "' />";

                $users .= "<div><span class='title'>" . $data->display_name . "</span></div>";

                $users .= "</a>";

                $users .= "</li>";

            }

            $users .= "</ul>";

        } else {

            $users = false;

        }



        /* Generate Results */

        $result = array(

            'groups' => $groups,

            'deals' => $deals,

            'users' => $users,

        );

        echo json_encode($result, true);

        die();

    }

}





function is_active($url)

{

    if ($_SERVER['REQUEST_URI'] === $url)

        return 'active';

}





function feed_args_generator($type = 'default', $deal_type = false, $current = 1, $posts_per_page = 8, $taxonomy = array(), $post_type = 'ad_post', $author_id = false)

{



    if ($type === 'hot') {

        $args = array(

            'meta_key' => 'sb_post_views_count',

            'orderby' => 'meta_value_num',

            'suppress_filters' => true,

            'post_type' => $post_type,

            'post_status' => 'publish',

            'paged' => $current,

            'posts_per_page' => $posts_per_page,

        );

    } else if ($type == 'latest_commented') {



        $comments = get_comments(array(

            'post_type' => $post_type,

            'status' => 'approve',

            'number' => -1,

            'order' => 'DESC'

        ));

        $ads_array = array();

        foreach ($comments as $comment) {

            array_push($ads_array, $comment->comment_post_ID);

        }

        $args = array(

            'suppress_filters' => true,

            'post_type' => $post_type,

            'post_status' => 'publish',

            'post__in' => $ads_array,

            'paged' => $current,

            'posts_per_page' => $posts_per_page,

        );

    } else if ($type === 'trending') {

        $args = array(

            'suppress_filters' => true,

            'post_type' => $post_type,

            'post_status' => 'publish',

            'paged' => $current,

            'posts_per_page' => $posts_per_page,

        );

    } else if ($type === 'category') {

        $args = array(

            'suppress_filters' => true,

            'post_type' => $post_type,

            'post_status' => 'publish',

            'paged' => $current,

            'posts_per_page' => $posts_per_page,

        );

    } else if ($type === 'author' && $author_id > 0) {

        $args = array(

            'suppress_filters' => true,

            'post_type' => $post_type,

            'post_status' => 'publish',

            'paged' => $current,

            'author' => $author_id,

            'posts_per_page' => $posts_per_page,

        );

    } else {

        $args = array(

            'suppress_filters' => true,

            'post_type' => $post_type,

            'post_status' => 'publish',

            'paged' => $current,

            'posts_per_page' => $posts_per_page,

        );

    }

    if ($deal_type) {

        $deal_type_args = array(

            'meta_key'   => 'sa_adtype',

            'meta_value' => $deal_type,

        );

        $args = array_merge($args, $deal_type_args);

    }

    if (!empty($taxonomy)) {

        $tax_args = array(

            'tax_query' => array(

                array(

                    'taxonomy' => $taxonomy[0],

                    'field' => 'term_id',

                    'terms' => $taxonomy[1]

                )

            ),

        );

        $args = array_merge($args, $tax_args);

    }



    return $args;

}











function sa_the_ads($feed_type = 'default', $taxonomy = false, $deal_type = false, $post_type = 'ad_post', $author_id = false)

{

	$found_posts;

	$posts_per_page = get_option('posts_per_page');

    ?>

    <div class="main-content-area clearfix">

        <section class="section-padding error-page pattern-bgs gray ">

            <div class="container">

                <div id="listings" class="row" data-page="1" data-feed="<?php echo esc_attr($feed_type); ?>" data-ptype="<?php echo esc_attr($post_type) ?>">

                    <?php

                    $md_push = '';

                    $blog_type = 'col-md-9 col-xs-12 col-sm-12';

                    if (isset($adforest_theme['blog_sidebar']) && $adforest_theme['blog_sidebar'] == 'no-sidebar') {

                        $blog_type = 'col-md-12 col-xs-12 col-sm-12';

                    } else {

                        if (isset($adforest_theme['blog_sidebar']) && $adforest_theme['blog_sidebar'] == 'left') {

                            $md_push = 'col-md-push-4';

                        }



                        $blog_type = 'col-md-9 col-xs-12 col-sm-12 ' . $md_push;

                    }

                    ?>

                    <div class="<?php echo esc_attr($blog_type); ?>">

                        <div id="listing-list" class="row">

                            <?php



                            // pre values

                            $ad_count = wp_count_posts('ad_post')->publish;

                            $pages_count = ceil($ad_count / $posts_per_page);



                            $args = feed_args_generator($feed_type, $deal_type, 1, $posts_per_page, $taxonomy, $post_type, $author_id);

                            // The Query

                            $the_query = new WP_Query($args);

                            // The Loop

                            if ($the_query->have_posts()) {

								$found_posts = $the_query->found_posts;

                                echo "<ul class='sa-listings' data-page='1' data-ptype='$post_type'>";

                                while ($the_query->have_posts()) {

                                    $the_query->the_post();

                                    $locations = wp_get_post_terms(get_the_ID(),'ad_country');

                                    foreach ( $locations as $location) {

                                        if($location->slug == 'morocco'){

                                            if(isset($_GET['hide_local'])){

                                                continue;

                                            }

                                        }

                                    }

                                    

                                    $check = isset($_GET['hide_feature'])? true: false;

                                    if($check){

                                           if(get_post_meta(get_the_ID(), '_adforest_is_feature', true) == '1'){

                                            continue;

                                        } 

                                    }

                                    echo sa_ad_layout_list(get_the_ID(), $post_type);

                                }

                                echo "</ul>";

                            } else {

                                // no posts found

                            }

                            /* Restore original Post Data */

                            wp_reset_postdata();

                            ?>

                        </div>

                    </div>

                    <?php

                    if (isset($adforest_theme['blog_sidebar']) && $adforest_theme['blog_sidebar'] == 'left') get_sidebar();

                    ?>

                    <?php

                    if (isset($adforest_theme['blog_sidebar']) && $adforest_theme['blog_sidebar'] == 'right') get_sidebar();

                    if (!isset($adforest_theme['blog_sidebar'])) get_sidebar();

                    ?>

                </div>

            </div>

        </section>

    </div>

    <div class="sa_footer" style="bottom: 100vh;">

        <div class="sa_footer-head">

            <div class="container">

                <button class="sa_scroll-up"><i class="fa fa-arrow-up"></i><span>Haut de page</span></button>

				<?php if ($found_posts > $posts_per_page): ?>

                <div class="sa_pagination" data-found="<?php echo $found_posts; ?>">

                    <nav class="sa_pagi" data-page="1" data-nonce="<?php echo esc_attr(wp_create_nonce("sa_adposts_load")); ?>">

                        <button class='sa_nav' data-nav="1" disabled></button>

                        <span>...</span>

                        <button class="sa_prev" data-nav="1" disabled><i class="fa fa-arrow-left"></i></button>

                        <span class="pager" data-nav="1">Page&nbsp;</span>

                        <button class="sa_next" data-nav="2"><i class="fa fa-arrow-right"></i></button>

                        <span>...</span>

                        <button class='sa_nav' data-nav="<?php echo $pages_count; ?>"></button>

                    </nav>

                </div>

				<?php endif; ?>

                <button class="sa_footer-toggle"><span>Afficher le footer</span><i class="fa fa-arrow-up"></i></button>

            </div>

        </div>

        <?php sa_footer_content_html(); ?>

    </div>

    <?php

}

























$sa = new Sa_Ad();

$sa->init();







function sa_check_vote($pid)

{

    if (is_user_logged_in()) {

        $uid = get_current_user_id();

        // get pre data

        $downvotes = get_user_meta($uid, 'sa_downvotes', true);

        $upvotes = get_user_meta($uid, 'sa_upvotes', true);

        // generate data arrays

        $downvotes_arr  = explode(',', $downvotes);

        $upvotes_arr  = explode(',', $upvotes);

        // check if voted

        $return_up = (in_array($pid, $upvotes_arr)) ? true : false;

        $return_down = (in_array($pid, $downvotes_arr)) ? true : false;

        // return

        $return = array(

            'up' => $return_up,

            'down' => $return_down,

        );

        return $return;

    } else {

        return false;

    }

}



function sa_ad_layout_list($pid, $post_type, $col = 12)

{

    $output = '';

    $locations = wp_get_post_terms($pid,'ad_country');

    foreach ( $locations as $location) {

        if($location->slug == 'morocco'){

            if(isset($_GET['hide_local'])){

                return  $output;

            }

        }

    }

    $check = isset($_GET['hide_feature'])? true: false;

    if($check){

           if(get_post_meta($pid, '_adforest_is_feature', true) == '1'){

            return  $output;

        } 

    }



    global $adforest_theme;

    $author_id = get_post_field('post_author', $pid);

    $author = get_user_by('ID', $author_id);

    $condition_html = '';

    if (isset($adforest_theme['allow_tax_condition']) && $adforest_theme['allow_tax_condition'] && get_post_meta($pid, '_adforest_ad_condition', true) != "") {

        $condition_html = '<div class="ad-stats hidden-xs"><span>' . __('Condition', 'adforest') . '  : </span>

                ' . get_post_meta($pid, '_adforest_ad_condition', true) . '

                </div>';

    }

    $ad_type_html = '';

    if (get_post_meta($pid, '_adforest_ad_type', true) != "") {

        $ad_type_html = '<div class="ad-stats hidden-xs">

                <span>' . __('Ad Type', 'adforest') . '  : </span>

                ' . get_post_meta($pid, '_adforest_ad_type', true) . '

                </div>';

    }

    $is_feature = '';

    if (get_post_meta(get_the_ID(), '_adforest_is_feature', true) == '1') {

        $rtl_fet = 'featured-ribbon';

        if (is_rtl()) {

            $rtl_fet = 'featured-ribbon-rtl';

        }

        $is_feature = '<div class="' . esc_attr($rtl_fet) . '">

		    <span>' . __('Featured', 'adforest') . '</span>

	        </div>';

    }



    $poster_contact = '';

    if (get_post_meta($pid, '_adforest_poster_contact', true) != "" && ($adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'phone')) {



        $showPhone_to_users = adforest_showPhone_to_users();

        if (!$showPhone_to_users) {

            $poster_contact = '<li><a data-toggle="tooltip" title="' . get_post_meta($pid, '_adforest_poster_contact', true) . '" href="javascript:void(0);" class="fa fa-phone"></a></li>';

        }

    }



    $price = '<div class="price"><span>' . adforest_adPrice($pid) . '</span></div>';

    $output = '<li><div class="well ad-listing clearfix">';



    if ($post_type !== 'discussions') {

        $output .= '<div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">';

        $img = adforest_get_ad_default_image_url('adforest-ad-related');

        $media = adforest_get_ad_images($pid);

        $total_imgs = count($media);

        if (count($media) > 0) {

            foreach ($media as $m) {

                $mid = '';

                if (isset($m->ID))

                    $mid = $m->ID;

                else

                    $mid = $m;



                $image = wp_get_attachment_image_src($mid, 'adforest-ad-related');

                $img = $image[0];

                break;

            }

        } else {

            $img = adforest_get_ad_default_image_url('adforest-ads-medium');

        }

        $output .= '<div class="img-box">' . adforest_video_icon() . ' ' . $is_feature . ' <img src="' . esc_url($img) . '" class="img-responsive" alt="' . get_the_title($pid) . '"><div class="total-images"><strong>' . esc_html($total_imgs) . '</strong> ' . __('photos', 'adforest') . ' </div><div class="quick-view"><a href="' . get_the_permalink($pid) . '" class="view-button"><i class="fa fa-search"></i></a></div>';



        $bid_end_date = get_post_meta($pid, '_adforest_ad_bidding_date', true);

        if ($bid_end_date != "" && date('Y-m-d H:i:s') < $bid_end_date) {

            $output .= '<div class="listing-bidding">' . adforest_timer_html($bid_end_date, false) . '</div>';

        }



        $output .= '</div></div>';

    }



    $output .= ($post_type !== 'discussions') ? '<div class="col-md-9 col-sm-7 col-xs-12">' : '<div class="col-md-12 col-sm-12 col-xs-12">';

    $output .= '<div class="row"><div class="content-area">';



    $cats_html = '';

    $cat_type = ($post_type !== 'discussions') ? 'ad_cats' : 'discussion_groups';

    $post_categories = wp_get_object_terms($pid, array($cat_type), array('orderby' => 'term_group'));

    $it_one = 1;

    foreach ($post_categories as $c) {

        $cls = '';

        if ($it_one != 1)

            $cls =  is_rtl() ?   'padding-right' :  'padding-left';

        $cat = get_term($c);

        $cats_html .= '<span><a class="' . $cls . '" href="' . get_term_link($cat->term_id) . '">' . esc_html($cat->name) . '</a></span>';

        $it_one++;

    }

    // HEADER OF CONTENT

    $rating_value = get_post_meta($pid, 'sa_advote', true) ? get_post_meta($pid, 'sa_advote', true) : '0';



    //$pluses = explode(',', $_COOKIE['dailydeal_vote_plus']);

    //$minuses = explode(',', $_COOKIE['dailydeal_vote_minus']);



    //$disabled_vote = (in_array($pid, $pluses) || in_array($pid, $minuses)) ? 'disabled="disabled"' : '';

    $sa_vote = sa_check_vote($pid);

    $disabled_vote = ($sa_vote['up'] || $sa_vote['down']) ? 'disabled="disabled"' : '';

    $sa_custom_header = '<div class="sa_custom_header">';

    // RATING

    $nonce = wp_create_nonce("sa_vote_change_nonce");

    $rating_classes = (!is_user_logged_in()) ? 'nlog' : '';

    $sa_custom_header .= '<div class="sa-deal-rating ' . $rating_classes . '" ' . $disabled_vote . ' data-id="' . esc_attr($pid) . '" data-nonce="' . esc_attr($nonce) . '"><button class="up"><i class="custom fa fa-plus"></i></button><span>' . $rating_value . '</span><button class="down"><i class="custom fa fa-minus"></i></button></div>';

    // META

    $sa_custom_header .= '<ul class="ad-meta-info"><li> <i class="fa fa-map-marker"></i><a href="javascript:void(0);">' . get_post_meta($pid, '_adforest_ad_location', true) . '</a></li><li> <i class="fa fa-clock-o"></i>' . get_the_date(get_option('date_format'), $pid) . '</li></ul>';

    $sa_custom_header .= '</div>';



    // FOOTER OF CONTENT

    $sa_adtype = get_post_meta($pid, 'sa_adtype', true);

    $sa_adurl = get_post_meta($pid, 'sa_adurl', true);



    $sa_custom_footer = '<div class="sa_custom_footer">';



    $badges = sa_get_author_badges($author_id);

    $badges_html = '';

    $i = 0;

    foreach ($badges as $key => $badge) {

        if ($i === 4) {

            $badges_html .= "<a href='/author/" . get_the_author_meta('user_login', $author_id) . "/?type=badges' class='bdg more'>...</a>";

            break;

        }

        if ($badge['status']) {

            $badges_html .= "<span class='bdg bdg_1" . $key . "'></span>";

            ++$i;

        }

    }



    $ad_count = adforest_get_all_ads($author_id);

    $author_comments = get_comments(array('post_author' => $author_id));

    $au_count = count($author_comments);



    $up_list = get_user_meta($author_id, 'sa_upvotes', true);

    $up_list = explode(",", $up_list);

    $up_count = count($up_list);



	// USER

	$followers_meta = get_user_meta($author_id, 'sa_followers', true);

	$followers = explode(',', $followers_meta);

	$follow_btn = '';

    if(sa_is_user_follow($author_id)){

    	if (is_user_logged_in()) {

    		$followed = (in_array(get_current_user_id(), $followers)) ? true : false;

    		$follow_classes = ($followed) ? 'btn btn-foll sa-btn-green follow hidden' : 'btn btn-foll sa-btn-green follow';

    		$unfollow_classes = ($followed) ? 'btn btn-foll sa-btn-gray followed' : 'btn btn-foll sa-btn-gray followed hidden';

    		$follow_btn .= "<button class='$unfollow_classes' data-uid='$author_id' $unfollow_hidden data-nonce='" . esc_attr(wp_create_nonce("sa_follow")) . "'><i class='fa fa-bell'></i>unfollow</button>";

    		$follow_btn .= "<button class='$follow_classes' data-uid='$author_id' $follow_hidden data-nonce='" . esc_attr(wp_create_nonce("sa_follow")) . "'><i class='fa fa-bell'></i>follow</button>";

    	} else {

    		$follow_btn .= "<button href='javascript:void(0);' data-toggle='modal' data-target='.login-popup' class='btn btn-foll sa-btn-gray followed' data-uid='$author_id' data-nonce='" . esc_attr(wp_create_nonce("sa_follow")) . "'><i class='fa fa-bell'></i></button>";

    	}

    }

	

	if(sa_is_user_message($author_id)){

        $message_btn = '<a class="btn sa-btn-black" href="/author/' . get_the_author_meta('user_login', $author_id) . '/?type=send_message&deal_post_id='.$pid.'"><i class="fa fa-envelope"></i></a>';

    }



	$is_online = ( sa_is_user_online( $author_id ) ) ? "<span class='is-online online'>Online</span>" : "<span class='is-online offline'>Offline</span>";

	$udata = get_userdata( $author_id );

    $registered = $udata->user_registered;

    

    

    			$hottest_deal = sa_author_hottest_ad($author_id);

			$average_hotness = sa_author_year_average_ad_hot($author_id);

		 

    

    

    

    

    $sa_custom_registered = date( "M Y", strtotime( $registered )  );

    $sa_custom_footer .= '<div class="sa_author">

				<button>

				<img src="' . adforest_get_user_dp($author_id) . '" class="avatar avatar-small" alt="' . get_the_title() . '"><span>' . get_the_author_meta('display_name', $author_id) . '</span></button>

				<div class="sa-popup">

					<header>

						<i class="fa fa-user"></i> <span>Aperçu</span>

						<button data-close>x</button>

					</header>

					<main>

						<img src="' . adforest_get_user_dp($author_id) . '" alt="' . get_the_author_meta('display_name', $author_id) . '" class="bg" />

						<img src="' . adforest_get_user_dp($author_id) . '" alt="' . get_the_author_meta('display_name', $author_id) . '" class="avatar" />

						<h5 class="name">' . get_the_author_meta('display_name', $author_id) . $is_online . ' </h5>

						<p class="since">inscrit(e) depuis '.$sa_custom_registered.'</p>

						<div class="seller-badges">' . $badges_html . '</div>

						<div class="links">

							' . $follow_btn . '

							' . $message_btn . '

							<a href="' . adforest_set_url_param(get_author_posts_url($author_id), 'type', 'ads') . '">Voir le profil</a>

						</div>

					</main>

					<footer>

						<h5>Statistiques</h5>

						<ul>

							<li><i class="fa fa-tag"></i> ' . $ad_count . ' <span>deal</span></li>

							<li><i class="fa fa-bar-chart"></i> ' .  $average_hotness . '<span> en moyenne depuis 1 an</span></li>

							<li><i class="fa fa-comments"></i> ' . $au_count . ' <span>commentaires</span></li>

							<li><i class="fa fa-thumbs-o-up"></i> '.$up_count.' <span>mentions j\'aime</span></li>

						</ul>

					</footer>

					</div>

				</div>';



    if ($sa_adtype === 'coupon') {



        $sa_custom_footer .= '<div class="sa-buttons">';

        // Save

        if (is_user_logged_in()) {

            $sa_custom_footer .= '<a data-toggle="tooltip" title="' . __('Save', 'adforest') . '" href="javascript:void(0);" class="save-ad btn btn-block btn-outline btn-default" data-adid="' . esc_attr($pid) . '"><i class="fa fa-bookmark"></i></a>';

        } else {

            $sa_custom_footer .= '<a title="' . __('Save', 'adforest') . '" data-toggle="modal" data-target=".login-popup" class="btn btn-block btn-outline btn-default"><i class="fa fa-bookmark"></i></a>';

        }

        // Comments

        $sa_custom_footer .= '<a href="' . esc_url(get_the_permalink($pid) . '#ad-rating') . '" class="btn btn-block btn-outline btn-default"><i class="fa fa-comments"></i> <span>' . get_comments_number($pid) . '</span></a>';

        $sa_custom_footer .= '</div>';

    } else if ($sa_adtype === 'deal') {



        $sa_custom_footer .= '<div class="sa-buttons">';

        // Save

        if (is_user_logged_in()) {

            $sa_custom_footer .= '<a data-toggle="tooltip" title="' . __('Save', 'adforest') . '" href="javascript:void(0);" class="save-ad btn btn-block btn-outline btn-default" data-adid="' . esc_attr($pid) . '"><i class="fa fa-bookmark"></i></a>';

        } else {

            $sa_custom_footer .= '<a title="' . __('Save', 'adforest') . '" data-toggle="modal" data-target=".login-popup" class="btn btn-block btn-outline btn-default"><i class="fa fa-bookmark"></i></a>';

        }



		// Comments

		$sa_custom_footer .= '<a href="' . esc_url(get_the_permalink($pid) . '#ad-rating') . '" class="btn btn-block btn-outline btn-default"><i class="fa fa-comments"></i> <span>' . get_comments_number($pid) . '</span></a>';

		// See Deal

		$sa_custom_footer .= '<a class="btn btn-block btn-theme" target="_blank" href="' . esc_url($sa_adurl) . '"><i class="fa fa-external-link" ></i> See Deal</a>';

		$sa_custom_footer .= '</div>';

	} else if ( $post_type === 'discussions' ) {

		$sa_custom_footer .= '<div class="sa-buttons">';

		// Save

		if (is_user_logged_in()) {

			$sa_custom_footer .= '<a data-toggle="tooltip" title="' . __('Save', 'adforest') . '" href="javascript:void(0);" class="save-ad btn btn-block btn-outline btn-default" data-adid="' . esc_attr($pid) . '"><i class="fa fa-bookmark"></i></a>';

		} else {

			$sa_custom_footer .= '<a title="' . __('Save', 'adforest') . '" data-toggle="modal" data-target=".login-popup" class="btn btn-block btn-outline btn-default"><i class="fa fa-bookmark"></i></a>';

		}



		// Comments

		$sa_custom_footer .= '<a href="' . esc_url(get_the_permalink($pid) . '#ad-rating') . '" class="btn btn-block btn-outline btn-default"><i class="fa fa-comments"></i> <span>' . get_comments_number($pid) . '</span></a>';

		// See Deal

		$sa_custom_footer .= '<a class="btn btn-block btn-outline btn-default" target="_blank" href="' . esc_url( get_the_permalink($pid) ) . '"> Lire la discussion</a>';

		$sa_custom_footer .= '</div>';

	}



    $sa_custom_footer .= '</div>';



    // PRICE / BONS PLANS

    $sa_custom_meta = '<ul class="sa_custom-meta">';

    if ($post_type !== 'discussions') $sa_custom_meta .= '<li class="sa_price">' . $price . '</li>';

    $sa_custom_meta .= ($post_type !== 'discussions') ? '<li class="sa_cat">Bons plans ' . $cats_html . '</li>' : '<li class="sa_cat">' . $cats_html . '</li>';

    $sa_custom_meta .= '</ul>';



    // COUPON

    $sa_custom_coupon = '';

    if ($sa_adtype === 'coupon') {

        $sa_adcoupon = get_post_meta($pid, 'sa_adcoupon', true);

        $sa_custom_coupon .= '<div class="sa_coupon-buttons">';

        $sa_custom_coupon .= '<a class="btn btn-block btn-theme" target="_blank" href="https://freelancer.com"><i class="fa fa-external-link"></i> See Deal</a>';

        $sa_custom_coupon .= '<button class="btn btn-block btn-outline btn-default btn-copy" data-copy="' . $sa_adcoupon . '"><span>' . $sa_adcoupon . '</span><i class="fa fa-files-o"></i></button>';

        $sa_custom_coupon .= '</div>';

    }



    $sa_discussion_header = '<div class="sa_custom_header">';

    $sa_discussion_header .= $sa_custom_meta;

    $sa_discussion_header .= '<ul class="ad-meta-info"><li> <i class="fa fa-clock-o"></i>' . get_the_date(get_option('date_format'), $pid) . '</li></ul>';

    $sa_discussion_header .= '</div>';



    // OUTPUT

    $output .= ($post_type !== 'discussions') ? $sa_custom_header : $sa_discussion_header;

    $output .=  '<h3><a href="' . get_the_permalink($pid) . '">' . get_the_title($pid) . '</a></h3>';

    $output .= ($post_type !== 'discussions') ? $sa_custom_meta : '';

	$excerpt = ($post_type !== 'discussions') ? adforest_words_count(get_the_excerpt($pid), 150) : adforest_words_count(get_the_excerpt($pid), 200) . "...<a href='" . get_the_permalink($pid) . "'>Afficher plus</a>";

    $output .= $sa_custom_coupon . '<ul class="additional-info pull-right"><li></li></ul><div class="ad-details"><p class="ht-p">' . $excerpt . '</p>' . $sa_custom_footer . '</div></div></div></div></div></li>';

    return $output;

}













class sa_categories_widget extends WP_Widget

{



    public function __construct()

    {

        parent::__construct(

            'sa_categories', // Base ID

            'Groups Slider', // Name

            array('description' => __('top groups slider Daily Deal', 'viola'),) // Args

        );

    }



    public function widget($args, $instance)

    {



        /* Init Widget Settings */

        extract($args);



        $cats = get_terms(

            array(

                'taxonomy' => 'ad_cats',

                'orderby' => 'name',

                'order'   => 'ASC',

                'hide_empty' => 1,

            )

        );



        /* Before Widget */

        echo $before_widget;



        /* Widget Title */

        $title = $instance['title'];

        if (!empty($title)) echo "<div class='widget-heading'><h4 class='panel-title'><span>$title</span></h4></div>";

        /* Widget Content */

        echo "<div class='content'>";

        echo "<div id='owl-sa' class='owl-categories owl-carousel owl-sa active'><ul id='sa-cats-slider'>";

        $i = 1;

        foreach ($cats as $key => $cat) { // Loop Social Media Data

            $thumb_id = get_term_meta($cat->term_id, 'category-image-id', true);

            if (!empty($thumb_id)) {

                if ($i % 2 === 1 && $i !== 1) echo "</ul><ul id='sa-cats-slider'class='item'>";

                echo "<li>";

                echo "<a href='" . esc_url(get_category_link($cat->term_id)) . "'>";

                echo wp_get_attachment_image($thumb_id, array(150, 150), array('alt' => $cat->name));

                echo "<div><span class='title'>" . $cat->name . "</span></div>";

                echo "</a>";

                echo "</li>";

                $i++;

            }

        }

        echo "</ul></div>";

        echo '</div>';



        echo '<script>jQuery(document).ready(function(){jQuery(".owl-categories.owl-carousel").owlCarousel({loop:true,margin:0,nav:true,dots: true,items: 1,});});</script>';



        /* Before Widget */

        echo $after_widget;

    }



    public function form($instance)

    {



        // Init Widget Variables

        $title = (isset($instance['title'])) ? $instance['title'] : __('Top groupes', 'viola'); // Widget Title

        //$style = ( empty( $style ) ) ? 'style-1' : esc_attr($instance['style']); // Widget Style



        // Widget Form

    ?>

        <div class="socialmediaForm">

            <p class="title">

                <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:', 'viola'); ?></label>

                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

            </p>

            <!--<p class="styles">

<label  for="<?php echo $this->get_field_name('style'); ?>"><?php _e('Styles:', 'viola'); ?></label>

<label><input type="radio" name="<?php echo $this->get_field_name('style'); ?>" value="style-1" <?php if ($style === 'style-1' || empty($style)) echo 'checked="checked"'; ?>> <?php _e('Style 1:', 'viola'); ?></label>

<label><input type="radio" name="<?php echo $this->get_field_name('style'); ?>" value="style-2" <?php if ($style === 'style-2') echo 'checked="checked"'; ?>> <?php _e('Style 2:', 'viola'); ?></label>

<label><input type="radio" name="<?php echo $this->get_field_name('style'); ?>" value="style-3" <?php if ($style === 'style-3') echo 'checked="checked"'; ?>> <?php _e('Style 3:', 'viola'); ?></label>

<label><input type="radio" name="<?php echo $this->get_field_name('style'); ?>" value="style-4" <?php if ($style === 'style-4') echo 'checked="checked"'; ?>> <?php _e('Style 4:', 'viola'); ?></label>

</p>-->

        </div>

    <?php

    }



    public function update($new_instance, $old_instance)

    {

        $instance = array();

        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        //$instance['style'] = ( !empty( $new_instance['style'] ) ) ? strip_tags( $new_instance['style'] ) : 'style-1';

        return $instance;

    }

}



add_action('widgets_init', function () {

    register_widget('sa_categories_widget');

});













class sa_hot_ads_widget extends WP_Widget

{



    public function __construct()

    {

        parent::__construct(

            'sa_hot_ads', // Base ID

            'Hot Ads Slider', // Name

            array('description' => __('top ads slider', 'viola'),) // Args

        );

    }



    public function widget($args, $instance)

    {



        /* Init Widget Settings */

        extract($args);



        $cats = get_terms(

            array(

                'taxonomy' => 'ad_cats',

                'orderby' => 'name',

                'order'   => 'ASC',

                'hide_empty' => 1,

            )

        );



        /* Before Widget */

        echo $before_widget;







        /* Widget Title */

        $title = "<div class='widget-heading ht-wigget-heading'>";

        $title .= "<h4 class='panel-title ht-panel-title'><span class='ht-title'>" .$instance['title'] ."</span><span class='ht-filter'>

                        <div class='dropdown-toggle ht-layoutfilter' type='button' id='f2dropdownmenu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>

                            <i class='fas fa-cog'></i>

                        </div>

                        <ul class='dropdown-menu' aria-labelledby='f2dropdownmenu'>

                            <li class='filter-list'><span class='ht-see'>Voir:</span><span class='ht-icons'><button type='button' class='active'><i class='fas fa-grip-lines'></i></button><button type='button' ><i class='fas fa-bars '></i></button></span></li>

                            <li class='filter-list'><div class='checkbox'><label><input type='checkbox' class='ht-checkbox'>Caroussel</label></div></li>

                        </ul>

                </span>

                </h4>";

        $title .= "<div class='sa-ads-select'><select name='tabs' class='no_select2'>

            <option value='today' selected>Jour</option>

            <option value='week'>Semaine</option>

            <option value='month'>Mois</option>

            <option value='all_time'>Tout</option>

        </select></div>";

        $title .= "</div>";

        echo $title;

        /* Widget Content */

        echo "<div class='content ht-content'>";





        // The Query

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

        // The Loop

        if ($the_query->have_posts()) {

            echo "<div id='owl-sa' class='owl-ads owl-carousel active' data-tab='today'><ul id='sa-ads-slider'>";

            $i = 1;

            while ($the_query->have_posts()) {

                $the_query->the_post();

                if ($i % 4 === 1 && $i !== 1) echo "</ul><ul id='sa-ads-slider'>";

                echo "<li class='article'>";

                echo "<a href='" . esc_url(get_permalink()) . "'>";

                if (has_post_thumbnail()) {

                    echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array('class'=>'ht-images'));

                } else {

                    echo "<img class='ht-images' src='" . esc_url(adforest_get_ad_default_image_url('adforest-ads-medium')) . "' />";

                }

                echo "<div class='details'><span class='title'>" . get_the_title() . "</span>";

                echo "<div class='price'>" . adforest_adPrice(get_the_ID()) . "</div>";

                echo "</div></a>";

                echo "</li>";

                $i++;

            }

            echo "</ul></div>";

        }



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

        // The Loop

        if ($the_query->have_posts()) {

            echo "<div id='owl-sa' class='owl-ads owl-carousel' data-tab='week'><ul id='sa-ads-slider'>";

            $i = 1;

            while ($the_query->have_posts()) {

                $the_query->the_post();

                if ($i % 4 === 1 && $i !== 1) echo "</ul><ul id='sa-ads-slider'>";

                echo "<li class='article'>";

                echo "<a href='" . esc_url(get_permalink()) . "'>";

                if (has_post_thumbnail()) {

                    echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array('class'=>'ht-images'));

                } else {

                    echo "<img class='ht-images' src='" . esc_url(adforest_get_ad_default_image_url('adforest-ads-medium')) . "' />";

                }

                echo "<div class='details'><span class='title'>" . get_the_title() . "</span>";

                echo "<div class='price'>" . adforest_adPrice(get_the_ID()) . "</div>";

                echo "</div></a>";

                echo "</li>";

                $i++;

            }

            echo "</ul></div>";

        }





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

        // The Loop

        if ($the_query->have_posts()) {

            echo "<div id='owl-sa' class='owl-ads owl-carousel' data-tab='month'><ul id='sa-ads-slider'>";

            $i = 1;

            while ($the_query->have_posts()) {

                $the_query->the_post();

                if ($i % 4 === 1 && $i !== 1) echo "</ul><ul id='sa-ads-slider'>";

                echo "<li class='article'>";

                echo "<a href='" . esc_url(get_permalink()) . "'>";

                if (has_post_thumbnail()) {

                    echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array('class'=>'ht-images'));

                } else {

                    echo "<img class='ht-images' src='" . esc_url(adforest_get_ad_default_image_url('adforest-ads-medium')) . "' />";

                }

                echo "<div class='details'><span class='title'>" . get_the_title() . "</span>";

                echo "<div class='price'>" . adforest_adPrice(get_the_ID()) . "</div>";

                echo "</div></a>";

                echo "</li>";

                $i++;

            }

            echo "</ul></div>";

        }





        // The Query

        $the_query = new WP_Query(array(

            'post_type' => array('ad_post'),

            'nopaging' => false,

            'posts_per_page' => 12,

            'ignore_sticky_posts' => true,

            'post_status' => 'publish',

        ));

        // The Loop

        if ($the_query->have_posts()) {

            echo "<div id='owl-sa' class='owl-ads owl-carousel' data-tab='all_time'><ul id='sa-ads-slider'>";

            $i = 1;

            while ($the_query->have_posts()) {

                $the_query->the_post();

                if ($i % 4 === 1 && $i !== 1) echo "</ul><ul id='sa-ads-slider'>";

                echo "<li class='article'>";

                echo "<a href='" . esc_url(get_permalink()) . "'>";

                if (has_post_thumbnail()) {

                    echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array('class'=>'ht-images'));

                } else {

                    echo "<img class='ht-images' src='" . esc_url(adforest_get_ad_default_image_url('adforest-ads-medium')) . "' />";

                }

                echo "<div class='details'><span class='title'>" . get_the_title() . "</span>";

                echo "<div class='price'>" . adforest_adPrice(get_the_ID()) . "</div>";

                echo "</div></a>";

                echo "</li>";

                $i++;

            }

            echo "</ul></div>";

        }



        echo '<script>jQuery(document).ready(function(){jQuery(".owl-ads.owl-carousel").owlCarousel({loop:true,margin:0,nav:true,dots: true,items: 1,});});</script>';



        /* Restore original Post Data */

        wp_reset_postdata();



        echo "</div>";



        /* Before Widget */

        echo $after_widget;

    }





    public function form($instance)

    {



        // Init Widget Variables

        $title = (isset($instance['title'])) ? $instance['title'] : __('Les + hot', 'viola'); // Widget Title

        //$style = ( empty( $style ) ) ? 'style-1' : esc_attr($instance['style']); // Widget Style



        // Widget Form

    ?>

        <div class="">

            <p class="title">

                <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:', 'viola'); ?></label>

                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

            </p>

        </div>

    <?php

    }



    public function update($new_instance, $old_instance)

    {

        $instance = array();

        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;

    }

}



add_action('widgets_init', function () {

    register_widget('sa_hot_ads_widget');

});





function sa_footer_content_html($layout = 'default')

{

    global $adforest_theme;

    if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['search_design']) && $adforest_theme['search_design'] == 'map' && is_page_template('page-search.php')) {

    } else {

        $layout = 'default';

        if (isset($adforest_theme['footer_style'])) {

            $layout = $adforest_theme['footer_style'];

        }

        get_template_part('template-parts/layouts/footer', $layout);

    }

}





function to_elapsed_time($time)

{



    $time = time() - $time; // to get the time since that moment

    $time = ($time < 1) ? 1 : $time;

    $tokens = array(

        31536000 => 'year',

        2592000 => 'month',

        604800 => 'week',

        86400 => 'day',

        3600 => 'hour',

        60 => 'minute',

        1 => 'second'

    );



    foreach ($tokens as $unit => $text) {

        if ($time < $unit) continue;

        $numberOfUnits = floor($time / $unit);

        return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');

    }

}







function sa_author_hottest_ad($uid)

{

    $args = array(

        'meta_key' => 'sb_post_views_count',

        'orderby' => 'meta_value_num',

        'suppress_filters' => true,

        'post_type' => 'ad_post',

        'post_status' => 'publish',

        'posts_per_page' => 1,

        'author' => $uid

    );

    $most_viewed;

    // The Query

    $the_query = new WP_Query($args);

    // The Loop

    if ($the_query->have_posts()) {

        while ($the_query->have_posts()) {

            $the_query->the_post();

            $most_viewed = get_the_ID();

        }

    }

    wp_reset_postdata();

    $hotness = get_post_meta($most_viewed, 'sb_post_views_count', true);

    return $hotness;

}



function sa_author_year_average_ad_hot($uid)

{

    $args = array(

        'meta_key' => 'sb_post_views_count',

        'orderby' => 'meta_value_num',

        'suppress_filters' => true,

        'post_type' => 'ad_post',

        'post_status' => 'publish',

        'posts_per_page' => -1,

        'author' => $uid

    );

    $views_array = array(100, 1000);

    // The Query

    $the_query = new WP_Query($args);

    // The Loop

    if ($the_query->have_posts()) {

        while ($the_query->have_posts()) {

            $the_query->the_post();

            $views = intval(get_post_meta(get_the_ID(), 'sb_post_views_count', true));

            array_push($views_array, intval($views));

        }

    }

    wp_reset_postdata();

    $oldview = 0;

    foreach ($views_array as $view) {

        $oldview = intval($view) + $oldview;

    }

    return ceil($oldview / count($views_array));

}

























/**

 * The field on the editing screens.

 *

 * @param $user WP_User user object

 */

function wporg_usermeta_form_field_birthday($user)

{

    ?>

    <h3>All Deals Votes</h3>

    <table class="form-table">

        <tr>

            <th>

                <label for="upvotes">UpVotes</label>

            </th>

            <td>

                <input type="text" class="regular-text ltr" id="sa_upvotes" name="sa_upvotes" value="<?= esc_attr(get_user_meta($user->ID, 'sa_upvotes', true)) ?>" title="upvotes of posts">

            </td>

            <th>

                <label for="sa_downvotes">DownVotes</label>

            </th>

            <td>

                <input type="text" class="regular-text ltr" id="sa_downvotes" name="sa_downvotes" value="<?= esc_attr(get_user_meta($user->ID, 'sa_downvotes', true)) ?>" title="downvotes of posts">

            </td>

        </tr>

    </table>





    <h3>Follows</h3>

    <table class="form-table">

        <tr>

            <th>

                <label for="sa_followers">Following</label>

            </th>

            <td>

                <input type="text" class="regular-text ltr" id="sa_followers" name="sa_followers" value="<?= esc_attr(get_user_meta($user->ID, 'sa_followers', true)) ?>" title="follows">

            </td>

        </tr>

    </table>

    <?php

}





if (!class_exists('sa_discussion_post_type')) {



    class sa_discussion_post_type

    {



        public function __construct()

        {

            //

        }



        /*

		* Initialize the class and start calling our hooks and filters

		* @since 1.0.0

		*/

        public function init()

        {

            add_action('init', [$this, 'custom_post_type'], 0);

            add_action('init', [$this, 'create_groups_taxonomy'], 0);

			add_action('init', [$this, 'create_categories_taxonomy'],0);

        }



        public function custom_post_type()

        {



            $labels = array(

                'name'                => _x('Discussions', 'Post Type General Name', 'twentytwenty'),

                'singular_name'       => _x('Discussion', 'Post Type Singular Name', 'twentytwenty'),

                'menu_name'           => __('Discussions', 'twentytwenty'),

                'parent_item_colon'   => __('Parent Discussion', 'twentytwenty'),

                'all_items'           => __('All Discussions', 'twentytwenty'),

                'view_item'           => __('View Discussion', 'twentytwenty'),

                'add_new_item'        => __('Add New Discussion', 'twentytwenty'),

                'add_new'             => __('Add New', 'twentytwenty'),

                'edit_item'           => __('Edit Discussion', 'twentytwenty'),

                'update_item'         => __('Update Discussion', 'twentytwenty'),

                'search_items'        => __('Search Discussion', 'twentytwenty'),

                'not_found'           => __('Not Found', 'twentytwenty'),

                'not_found_in_trash'  => __('Not found in Trash', 'twentytwenty'),

            );



            $args = array(

                'label'               => __('discussions', 'twentytwenty'),

                'description'         => __('Discussion system', 'twentytwenty'),

                'labels'              => $labels,

                'supports'            => array('title', 'editor', 'excerpt', 'author', 'comments', 'revisions'),

                'hierarchical'        => false,

                'public'              => true,

                'show_ui'             => true,

                'show_in_menu'        => true,

                'show_in_nav_menus'   => true,

                'show_in_admin_bar'   => true,

                'menu_position'       => 30,

                'menu_icon' => 'dashicons-admin-site-alt',

                'can_export'          => true,

                'has_archive'         => true,

                'exclude_from_search' => false,

                'publicly_queryable'  => true,

                'capability_type'     => 'post',

                'show_in_rest' => true,

            );



            register_post_type('discussions', $args);

        }





        public function create_groups_taxonomy()

        {

            $labels = array(

                'name' => _x('Groups', 'taxonomy general name'),

                'singular_name' => _x('Group', 'taxonomy singular name'),

                'search_items' =>  __('Search Groups'),

                'all_items' => __('All Groups'),

                'parent_item' => __('Parent Group'),

                'parent_item_colon' => __('Parent Group:'),

                'edit_item' => __('Edit Group'),

                'update_item' => __('Update Group'),

                'add_new_item' => __('Add New Group'),

                'new_item_name' => __('New Group Name'),

                'menu_name' => __('Groups'),

            );

            $args = array(

                'hierarchical'      => true,

                'labels'            => $labels,

                'show_ui'           => true,

                'show_admin_column' => true,

                'query_var'         => true,

                'rewrite'           => array('slug' => 'groups'),

            );

            register_taxonomy('discussion_groups', array('discussions'), $args);

        }

		public function create_categories_taxonomy () {

			$labels = array(

				'name'                       => _x( 'Categories', 'taxonomy general name', 'textdomain' ),

				'singular_name'              => _x( 'Category', 'taxonomy singular name', 'textdomain' ),

				'search_items'               => __( 'Search Categories', 'textdomain' ),

				'popular_items'              => __( 'Popular Categories', 'textdomain' ),

				'all_items'                  => __( 'All Catogeries', 'textdomain' ),

				'parent_item'                => null,

				'parent_item_colon'          => null,

				'edit_item'                  => __( 'Edit Category', 'textdomain' ),

				'update_item'                => __( 'Update Category', 'textdomain' ),

				'add_new_item'               => __( 'Add New Category', 'textdomain' ),

				'new_item_name'              => __( 'New Category Name', 'textdomain' ),

				'separate_items_with_commas' => __( 'Separate Categeries with commas', 'textdomain' ),

				'add_or_remove_items'        => __( 'Add or remove Categories', 'textdomain' ),

				'choose_from_most_used'      => __( 'Choose from the most used Categories', 'textdomain' ),

				'not_found'                  => __( 'No Categories found.', 'textdomain' ),

				'menu_name'                  => __( 'Categories', 'textdomain' ),

			);

			$args = array(

				'hierarchical'          => false,

				'labels'                => $labels,

				'show_ui'               => true,

				'show_admin_column'     => true,

				'query_var'             => true,

				'rewrite'               => array( 'slug' => 'category' ),

			);

			register_taxonomy( 'discussion_categories', 'discussions', $args );

		}

    }



    $sa_discussion_post_type = new sa_discussion_post_type();

    $sa_discussion_post_type->init();

}



/**

 *  Custom Merchands Taxonomy

 */



if (!class_exists('sa_merchands_taxonomy')) {

    class sa_merchands_taxonomy

    {



        public function __construct()

        {

            //

        }



        /*

		* Initialize the class and start calling our hooks and filters

		* @since 1.0.0

		*/

        public function init()

        {

            add_action('init', [$this, 'create_merchands_taxonomy'], 0);

            add_action('merchands_add_form_fields', array($this, 'add_category_image'), 10, 2);

            add_action('created_merchands', array($this, 'save_category_image'), 10, 2);

            add_action('merchands_edit_form_fields', array($this, 'update_category_image'), 10, 2);

            add_action('edited_merchands', array($this, 'updated_category_image'), 10, 2);

        }





        public function create_merchands_taxonomy()

        {

            $labels = array(

                'name' => _x('Merchands', 'taxonomy general name'),

                'singular_name' => _x('Merchand', 'taxonomy singular name'),

                'search_items' =>  __('Search Merchands'),

                'all_items' => __('All Merchands'),

                'parent_item' => __('Parent Merchand'),

                'parent_item_colon' => __('Parent Merchand:'),

                'edit_item' => __('Edit Merchand'),

                'update_item' => __('Update Merchand'),

                'add_new_item' => __('Add New Merchand'),

                'new_item_name' => __('New Merchand Name'),

                'menu_name' => __('Merchands'),

            );

            $args = array(

                'hierarchical'      => true,

                'labels'            => $labels,

                'show_ui'           => true,

                'show_admin_column' => true,

                'query_var'         => true,

                'rewrite'           => array('slug' => 'merchand'),

            );

            register_taxonomy('merchands', array('ad_post'), $args);

        }





        /*

		* Add a form field in the new category page

		* @since 1.0.0

		*/

        public function add_category_image($taxonomy)

        {

        ?>

            <div class="form-field term-url-wrap">

                <label for="merchand-url">URL</label>

                <input name="merchand-url" id="merchand-url" type="url" value="" size="40">

                <p>add merchands url.</p>

            </div>

        <?php

        }





        /*

		* Save the form field

		* @since 1.0.0

		*/

        public function save_category_image($term_id, $tt_id)

        {

            $metas = array('merchand-url');

            foreach ($metas as $meta) {

                if (isset($_POST[$meta]) && '' !== $_POST[$meta])

                    add_term_meta($term_id, $meta, $_POST[$meta], true);

            }

        }



        /*

		* Edit the form field

		* @since 1.0.0

		*/

        public function update_category_image($term, $taxonomy)

        {

            $url = get_term_meta($term->term_id, 'merchand-url', true);

        ?>

            <tr class="form-field term-slug-wrap">

                <th scope="row">

                    <label for="merchand-url">URL</label>

                </th>

                <td>

                    <input name="merchand-url" id="merchand-url" type="url" value="<?php echo esc_attr($url); ?>" size="40">

                    <p class="description">add merchands url.</p>

                </td>

            </tr>

        <?php }



        /*

		* Update the form field value

		* @since 1.0.0

		*/

        public function updated_category_image($term_id, $tt_id)

        {

            $metas = array('merchand-url');

            foreach ($metas as $meta) {

                if (isset($_POST[$meta]) && '' !== $_POST[$meta])

                    update_term_meta($term_id, $meta, $_POST[$meta]);

            }

        }



    }

    $sa_merchands_taxonomy = new sa_merchands_taxonomy();

    $sa_merchands_taxonomy->init();

}

























class sa_merchands_widget extends WP_Widget

{



    public function __construct()

    {

        parent::__construct(

            'sa_merchands', // Base ID

            'Merchands Slider', // Name

            array('description' => __('merchands widget', 'viola'),) // Args

        );

    }



    public function widget($args, $instance)

    {



        /* Init Widget Settings */

        extract($args);



        $merchands = get_terms(

            array(

                'taxonomy' => 'merchands',

                'orderby' => 'name',

                'hide_empty' => false,

            )

        );



        /* Before Widget */

        echo $before_widget;



        /* Widget Title */

        $title = $instance['title'];

        if (!empty($title)) echo "<div class='widget-heading'><h4 class='panel-title'><span>$title</span></h4></div>";

        /* Widget Content */

        echo "<div class='content'>";

        echo "<div id='owl-sa' class='owl-merchands owl-carousel owl-sa active'><ul id='sa-merchands-slider'>";

        $i = 1;

        foreach ($merchands as $merchand) { // Loop Social Media Data

            $thumb_id = get_term_meta($merchand->term_id, 'merchand-image-id', true);



            if (!empty($thumb_id)) {

                if ($i % 3 === 1 && $i !== 1) echo "</ul><ul id='sa-merchands-slider'class='item'>";

                echo "<li>";

                echo "<a href='" . esc_url(get_category_link($merchand->term_id)) . "'>";

                echo wp_get_attachment_image($thumb_id, array(150, 150), array('alt' => $merchand->name));

                echo "</a>";

                echo "</li>";

                $i++;

            }

        }

        echo "</ul></div>";

        echo '</div>';



        echo '<script>jQuery(document).ready(function(){jQuery(".owl-merchands.owl-carousel").owlCarousel({loop:true,margin:0,nav:true,dots: true,items: 1,});});</script>';



        /* Before Widget */

        echo $after_widget;

    }



    public function form($instance)

    {



        // Init Widget Variables

        $title = (isset($instance['title'])) ? $instance['title'] : __('Merchands', 'viola'); // Widget Title



        // Widget Form

        ?>

        <div class="socialmediaForm">

            <p class="title">

                <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:', 'viola'); ?></label>

                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

            </p>

        </div>

    <?php

    }



    public function update($new_instance, $old_instance)

    {

        $instance = array();

        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;

    }

}



add_action('widgets_init', function () {

    register_widget('sa_merchands_widget');

});

























class sa_merchands_related_widget extends WP_Widget

{



    public function __construct()

    {

        parent::__construct(

            'sa_merchands_related', // Base ID

            'Marchands similaires', // Name

            array('description' => __('merchands similaire widget', 'viola'),) // Args

        );

    }



    public function widget($args, $instance)

    {



        /* Init Widget Settings */

        extract($args);



        $merchands = get_terms(

            array(

                'taxonomy' => 'merchands',

                'orderby' => 'count',

				'order' => 'DESC',

                'hide_empty' => false,

				'number' => 5

            )

        );



        /* Before Widget */

        echo $before_widget;



        /* Widget Title */

        $title = $instance['title'];

        if (!empty($title)) echo "<div class='widget-heading'><h4 class='panel-title'><span>$title</span></h4></div>";

        /* Widget Content */

        echo "<div class='content'>";

        echo "<ul id='sa-merchands-related'>";

        foreach ($merchands as $merchand) { // Loop Social Media Data

            $thumb_id = get_term_meta($merchand->term_id, 'merchand-image-id', true);



            if (!empty($thumb_id)) {

                echo "<li>";

                echo "<a href='" . esc_url(get_category_link($merchand->term_id)) . "'>";

                echo wp_get_attachment_image($thumb_id, array(150, 150), array('alt' => $merchand->name));

				echo "<div><span class='hot-count'><i class='fa fa-fire'></i>$merchand->count codes promo hot</span><span class='name'>$merchand->name</span></div>";

                echo "</a>";

                echo "</li>";

                $i++;

            }

        }

        echo "</ul><a class='btn btn-light' href='/shops'>Voir tout</a></div>";

        echo '</div>';



        /* Before Widget */

        echo $after_widget;

    }



    public function form($instance)

    {



        // Init Widget Variables

        $title = (isset($instance['title'])) ? $instance['title'] : __('Marchands similaires', 'viola'); // Widget Title



        // Widget Form

        ?>

        <div class="socialmediaForm">

            <p class="title">

                <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:', 'viola'); ?></label>

                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

            </p>

        </div>

    <?php

    }



    public function update($new_instance, $old_instance)

    {

        $instance = array();

        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;

    }

}



add_action('widgets_init', function () {

    register_widget('sa_merchands_related_widget');

});























class sa_discussions_widget extends WP_Widget

{



    public function __construct()

    {

        parent::__construct(

            'sa_discussions', // Base ID

            'Discussions Recent/Populer', // Name

            array('description' => __('discussions widget', 'viola'),) // Args

        );

    }



    public function widget($args, $instance)

    {



        /* Init Widget Settings */

        extract($args);



        /* Before Widget */

        echo $before_widget;



        /* Widget Title */

        $title = "<div class='widget-heading'>";

        $title .= "<h4 class='panel-title'><span>" . $instance['title'] . "</span></h4>";

        $title .= "<div class='sa-discussions-select'><select name='tabs' class='no_select2'>

			<option value='recent' selected>Recentes</option>

			<option value='popular'>Populaire</option>

		</select></div>";

        $title .= "</div>";

        echo $title;

        /* Widget Content */

        echo "<div class='content'>";



        // Populaire

        $the_query = new WP_Query(array(

            'post_type' => array('discussions'),

            'nopaging' => false,

            'posts_per_page' => 12,

            'ignore_sticky_posts' => true,

            'post_status' => 'publish',

            //'date_query' => array(

            //array( 'after' => '1 day ago')

            //)

        ));

        // The Loop

        if ($the_query->have_posts()) {

            echo "<div id='owl-sa' class='owl-discussions owl-carousel' data-tab='popular'><ul id='sa-discussions-slider'>";

            $i = 1;

            while ($the_query->have_posts()) {

                $author_id = get_post_field('post_author', get_the_ID());

                $the_query->the_post();

                if ($i % 4 === 1 && $i !== 1) echo "</ul><ul id='sa-discussions-slider'>";

                echo "<li class='article'>";

                echo "<a href='" . esc_url(get_permalink()) . "'>";

                echo "<span class='title'>" . get_the_title() . "</span>";

                echo "<div class='details'>";

                echo "<img src='" . adforest_get_user_dp($author_id) . "' class='avatar avatar-small'><span class='time-elapsed'>" . to_elapsed_time(strtotime(get_the_date(get_option('date_format'), get_the_ID()))) . "</span><span class='comments'>1715 <i class='fa fa-comment'></i></span>";

                echo "</div></a>";

                echo "</li>";

                $i++;

            }

            echo "</ul></div>";

        }

        /* Restore original Post Data */

        wp_reset_postdata();





        // Recents

        $the_query = new WP_Query(array(

            'post_type' => array('discussions'),

            'nopaging' => false,

            'posts_per_page' => 12,

            'ignore_sticky_posts' => true,

            'post_status' => 'publish',

        ));

        // The Loop

        if ($the_query->have_posts()) {

            echo "<div id='owl-sa' class='owl-discussions owl-carousel active' data-tab='recent'><ul id='sa-discussions-slider'>";

            $i = 1;

            while ($the_query->have_posts()) {

                $author_id = get_post_field('post_author', get_the_ID());

                $the_query->the_post();

                if ($i % 4 === 1 && $i !== 1) echo "</ul><ul id='sa-discussions-slider'>";

                echo "<li class='article'>";

                echo "<a href='" . esc_url(get_permalink()) . "'>";

                echo "<span class='title'>" . get_the_title() . "</span>";

                echo "<div class='details'>";

                echo "<img src='" . adforest_get_user_dp($author_id) . "' class='avatar avatar-small'><span class='time-elapsed'>" . to_elapsed_time(strtotime(get_the_date(get_option('date_format'), get_the_ID()))) . "</span><span class='comments'>1715 <i class='fa fa-comment'></i></span>";

                echo "</div></a>";

                echo "</li>";

                $i++;

            }

            echo "</ul></div>";

        }



        echo '<script>jQuery(document).ready(function(){jQuery(".owl-discussions.owl-carousel").owlCarousel({loop:true,margin:0,nav:true,dots: true,items: 1,});});</script>';



        /* Restore original Post Data */

        wp_reset_postdata();



        echo "</div>";



        /* Before Widget */

        echo $after_widget;

    }



    public function form($instance)

    {



        // Init Widget Variables

        $title = (isset($instance['title'])) ? $instance['title'] : __('Discussions', 'viola'); // Widget Title



        // Widget Form

    ?>

        <div class="socialmediaForm">

            <p class="title">

                <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:', 'viola'); ?></label>

                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />

            </p>

        </div>

<?php

    }



    public function update($new_instance, $old_instance)

    {

        $instance = array();

        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;

    }

}



add_action('widgets_init', function () {

    register_widget('sa_discussions_widget');

});





function sa_is_user_online( $user_id ) {

    $setting_value = get_user_meta($user_id, "preferences_is_online")[0];

    $checked = ( filter_var( $setting_value, FILTER_VALIDATE_BOOLEAN) ) ? true : false;

    return $checked;   

}



function sa_is_user_follow( $user_id ) {

    $setting_value = get_user_meta($user_id, "preferences_is_follow")[0];

    $checked = ( filter_var( $setting_value, FILTER_VALIDATE_BOOLEAN) ) ? true : false;

    return $checked;   

}



function sa_is_user_message( $user_id ) {

    $setting_value = get_user_meta($user_id, "preferences_is_message")[0];

    $checked = ( filter_var( $setting_value, FILTER_VALIDATE_BOOLEAN) ) ? true : false;

    return $checked;   

}

add_action('transition_comment_status', 'my_approve_comment_callback', 10, 3);
function my_approve_comment_callback($new_status, $old_status, $comment) {
    if($old_status != $new_status) {
        if($new_status == 'approved') {
            sa_update_notification($comment->comment_post_ID, $comment->user_id, $comment->user_id, "11");
        }
    }
}

$notification_text = array(
    "You have received a message from %s",
    "The Deal %s has becoming very hot",
    "The User %s has voted on your Deal %s",
    "The User %s has added a comment on your Deal %s",
    "Your Deal %s has becoming very Hot",
    "Your Deal %s will expire soon",
    "Your Deal %s expired",
    "Your Expired Deal %s is reactivated",
    "The user %s has commented on the deal %s",
    "The user %s like your comment on the deal %s",
    "Your comment on the deal %s is approved",
    "You have earned a new Badge",
    "The user %s that you follow has prosted a new %s"
);

function sa_update_notification($fid = "", $tid = "", $uid = "", $type = 0){
    global $wpdb, $notification_text;

    $table_name = $wpdb->prefix . "notification";

    if($fid > 0 && $tid > 0 && $uid > 0){
        $noti_list = $wpdb->query("SELECT * FROM ".$table_name." WHERE tid = '".$tid."' AND fid = '".$fid."' AND uid = '".$uid."' AND type = '".$type."'");  

        if(!empty($noti_list)){
            $wpdb->query("UPDATE ".$table_name." SET `created_date` = NOW(), `state` = '0' WHERE tid = '".$tid."' AND fid = '".$fid."' AND uid = '".$uid."' AND type = '".$type."'");    
        }else{
            $wpdb->query("INSERT INTO $table_name (`id`, `fid`, `tid`, `uid`, `type`, `created_date`, `state`) VALUES(NULL, '".$fid."', '".$tid."', '".$uid."', '".$type."', NOW(), '0')");    
        }

        $alert_notif_email = filter_var( get_user_meta(get_current_user_id(), "alert_notif_email")[0], FILTER_VALIDATE_BOOLEAN);
        $subscribe_notif_email = filter_var( get_user_meta(get_current_user_id(), "subscribe_notif_email")[0], FILTER_VALIDATE_BOOLEAN);
        $comment_notif_email = filter_var( get_user_meta(get_current_user_id(), "comment_notif_email")[0], FILTER_VALIDATE_BOOLEAN);
        $badge_notif_email = filter_var( get_user_meta(get_current_user_id(), "badge_notif_email")[0], FILTER_VALIDATE_BOOLEAN);
        $member_notif_email = filter_var( get_user_meta(get_current_user_id(), "member_notif_email")[0], FILTER_VALIDATE_BOOLEAN);
        $message_notif_email = filter_var( get_user_meta(get_current_user_id(), "message_notif_email")[0], FILTER_VALIDATE_BOOLEAN);
        $deal_notif_vote = filter_var( get_user_meta(get_current_user_id(), "deal_notif_vote")[0], FILTER_VALIDATE_BOOLEAN);
        $deal_notif_comment = filter_var( get_user_meta(get_current_user_id(), "deal_notif_comment")[0], FILTER_VALIDATE_BOOLEAN);
        $deal_notif_hot = filter_var( get_user_meta(get_current_user_id(), "deal_notif_hot")[0], FILTER_VALIDATE_BOOLEAN);
        $deal_notif_expire = filter_var( get_user_meta(get_current_user_id(), "deal_notif_expire")[0], FILTER_VALIDATE_BOOLEAN);
        $deal_notif_post_expire = filter_var( get_user_meta(get_current_user_id(), "deal_notif_post_expire")[0], FILTER_VALIDATE_BOOLEAN);
        $deal_notif_expire_reactive = filter_var( get_user_meta(get_current_user_id(), "deal_notif_expire_reactive")[0], FILTER_VALIDATE_BOOLEAN);

        if($message_notif_email && $type == 1){
            $user_info = get_userdata($fid);
            $link = '<a href="'.adforest_set_url_param(get_author_posts_url($fid), 'type', 'ads').'">'.$user_info->display_name.'</a>';
            $content = sprintf($notification_text[$type - 1], $link);
            sb_send_notification_email($uid, $content);
        }else if($alert_notif_email && $type == 2){
            $hot_value = get_post_meta($fid, 'sa_advote', true);
            $hot_value = ($hot_value) ? intval($hot_value) : 0;
            if($hot_value > 99){
                $link = '<a href="'.get_the_permalink($fid).'">'.get_the_title($fid).'</a>';
                $content = sprintf($notification_text[$type - 1], $link);
                sb_send_notification_email($uid, $content);
            }
        }else if($deal_notif_vote && $type == 3){
            $user_info = get_userdata($tid);
            $link1 = '<a href="'.adforest_set_url_param(get_author_posts_url($tid), 'type', 'ads').'">'.$user_info->display_name.'</a>';
            $link2 = '<a href="'.get_the_permalink($fid).'">'.get_the_title($fid).'</a>';
            $content = sprintf($notification_text[$type - 1], $link1, $link2);
            sb_send_notification_email($uid, $content);
        }else if($deal_notif_comment && $type == 4){
            $user_info = get_userdata($tid);
            $link1 = '<a href="'.adforest_set_url_param(get_author_posts_url($tid), 'type', 'ads').'">'.$user_info->display_name.'</a>';
            $link2 = '<a href="'.get_the_permalink($fid).'">'.get_the_title($fid).'</a>';
            $content = sprintf($notification_text[$type - 1], $link1, $link2);
            sb_send_notification_email($uid, $content);
        }else if($deal_notif_hot && $type == 5){
            $link = '<a href="'.get_the_permalink($fid).'">'.get_the_title($fid).'</a>';
            $content = sprintf($notification_text[$type - 1], $link);
            sb_send_notification_email($uid, $content);
        }else if($deal_notif_expire && $type == 6){
            $link = '<a href="'.get_the_permalink($fid).'">'.get_the_title($fid).'</a>';
            $content = sprintf($notification_text[$type - 1], $link);
            sb_send_notification_email($uid, $content);
        }else if($deal_notif_post_expire && $type == 7){
            $link = '<a href="'.get_the_permalink($fid).'">'.get_the_title($fid).'</a>';
            $content = sprintf($notification_text[$type - 1], $link);
            sb_send_notification_email($uid, $content);
        }else if($deal_notif_expire_reactive && $type == 8){
            $link = '<a href="'.get_the_permalink($fid).'">'.get_the_title($fid).'</a>';
            $content = sprintf($notification_text[$type - 1], $link);
            sb_send_notification_email($uid, $content);
        }else if($subscribe_notif_email && $type == 9){
            $user_info = get_userdata($tid);
            $link1 = '<a href="'.adforest_set_url_param(get_author_posts_url($tid), 'type', 'ads').'">'.$user_info->display_name.'</a>';
            $link2 = '<a href="'.get_the_permalink($fid).'">'.get_the_title($fid).'</a>';
            $content = sprintf($notification_text[$type - 1], $link1, $link2);
            sb_send_notification_email($uid, $content);
        }else if($comment_notif_email && $type == 10){
            $user_info = get_userdata($tid);
            $link1 = '<a href="'.adforest_set_url_param(get_author_posts_url($tid), 'type', 'ads').'">'.$user_info->display_name.'</a>';
            $link2 = '<a href="'.get_the_permalink($fid).'">'.get_the_title($fid).'</a>';
            $content = sprintf($notification_text[$type - 1], $link1, $link2);
            sb_send_notification_email($uid, $content);
        }else if($comment_notif_email && $type == 11){
            $link = '<a href="'.get_the_permalink($fid).'">'.get_the_title($fid).'</a>';
            $content = sprintf($notification_text[$type - 1], $link);
            sb_send_notification_email($uid, $content);
        }else if($badge_notif_email && $type == 12){
            $content = $notification_text[$type - 1];
            sb_send_notification_email($uid, $content);
        }else if($member_notif_email && $type == 13){
            $user_info = get_userdata($tid);
            $link1 = '<a href="'.adforest_set_url_param(get_author_posts_url($tid), 'type', 'ads').'">'.$user_info->display_name.'</a>';
            $link2 = '<a href="'.get_the_permalink($fid).'">'.get_the_title($fid).'</a>';
            $content = sprintf($notification_text[$type - 1], $link1, $link2);
            sb_send_notification_email($uid, $content);
        }
    }
}

function sb_send_notification_email($uid = "", $content = ""){
    if($uid > 0 && $content != ""){
        $user_info = get_userdata($uid);
        $to = $user_info->user_email;

        $subject = __('New Notification', 'adforest');
        $body =  "";
        $from = get_option('admin_email');

        $headers = array('Content-Type: text/html; charset=UTF-8', "From: $from");
        $body = $content;
        wp_mail($to, $subject, $body, $headers);
    }
}

function sb_set_cookie_badges(){
    $cookie_badges = array();
    if(isset($_COOKIE['cookie_badges'])){
        $cookie_badges = json_decode($_COOKIE['cookie_badges']);
    }
    $i = count($cookie_badges);
    $old_count = count($cookie_badges);

    $uid = get_current_user_id();

    // sold more than > Badges 10 / 40 / 100

    $ad_count = adforest_get_all_ads($uid);

    if ($ad_count > 10) {
        if(!in_array(16, $cookie_badges)){
            $cookie_badges[$i++] = 16;
        }
    }

    if ($ad_count > 40){
        if(!in_array(15, $cookie_badges)){
            $cookie_badges[$i++] = 15;
        }
    }

    if ($ad_count > 100) {
        if(!in_array(14, $cookie_badges)){
            $cookie_badges[$i++] = 14;
        }
    }


    // Commented More Than 100 / 400 / 1000

    $author_comments = get_comments(array('post_author' => $uid));

    $au_count = count($author_comments);

    if ($au_count > 100) {
        if(!in_array(23, $cookie_badges)){
            $cookie_badges[$i++] = 23;
        }
    }

    if ($au_count > 400) {
        if(!in_array(22, $cookie_badges)){
            $cookie_badges[$i++] = 22;
        }
    }

    if ($au_count > 1000) {
        if(!in_array(21, $cookie_badges)){
            $cookie_badges[$i++] = 21;
        }
    }


    // Author Posts Comments 50 / 200 / 500

    $author_post_comments_count = 0;

    $the_query = new WP_Query(array(

        'author' => $uid,

        'posts_per_page' => 500,

    ));

    if ($the_query->have_posts()) {

        while ($the_query->have_posts()) : $the_query->the_post();

            $author_post_comments_count += get_comments_number(get_the_ID());

        endwhile;

    }

    wp_reset_query();

    if ($author_post_comments_count > 50) {
        if(!in_array(4, $cookie_badges)){
            $cookie_badges[$i++] = 4;
        }
    }

    if ($author_post_comments_count > 200) {
        if(!in_array(3, $cookie_badges)){
            $cookie_badges[$i++] = 3;
        }
    }

    if ($author_post_comments_count > 500) {
        if(!in_array(2, $cookie_badges)){
            $cookie_badges[$i++] = 2;
        }
    }


    // Hotness of deals 250/600/1500

    $hottest_deal = intval(sa_author_hottest_ad($uid));

    if ($hottest_deal > 250) {
        if(!in_array(7, $cookie_badges)){
            $cookie_badges[$i++] = 7;
        }
    }

    if ($hottest_deal > 600) {
        if(!in_array(6, $cookie_badges)){
            $cookie_badges[$i++] = 6;
        }
    }

    if ($hottest_deal > 1500) {
        if(!in_array(5, $cookie_badges)){
            $cookie_badges[$i++] = 5;
        }
    }


    // Votes of deals 300/1200/3000

    $downvotes = get_user_meta($uid, 'sa_downvotes', true);

    $upvotes = get_user_meta($uid, 'sa_upvotes', true);

    $downvotes_count = count(explode(',', $downvotes));

    $upvotes_count = count(explode(',', $upvotes));

    $votes_count = $downvotes_count + $upvotes_count;

    if ($votes_count > 2) {
        if(!in_array(26, $cookie_badges)){
            $cookie_badges[$i++] = 26;
        }
    }

    if ($votes_count > 1200) {
        if(!in_array(25, $cookie_badges)){
            $cookie_badges[$i++] = 25;
        }
    }

    if ($votes_count > 3000) {
        if(!in_array(24, $cookie_badges)){
            $cookie_badges[$i++] = 24;
        }
    }

    if($old_count > 0 && $old_count < count($cookie_badges)){
        sa_update_notification($uid, $uid, $uid, "12");
    }

    setcookie("cookie_badges", json_encode($cookie_badges), (time() + 86400), "/", "you1deals.com");

    return $badges;

}