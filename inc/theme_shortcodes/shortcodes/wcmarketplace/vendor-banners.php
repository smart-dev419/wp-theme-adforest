<?php
/* ------------------------------------------------ */
/* services on vendor page */
/* ------------------------------------------------ */
add_action('vc_before_init', 'adforest_vendor_banners_shortcode');
if (!function_exists('adforest_vendor_banners_shortcode')) {

    function adforest_vendor_banners_shortcode()
    {
        vc_map(array(
            'name' => __('Vendor Banners', 'adforest'),
            'description' => '',
            'base' => 'vendor_banners',
            'show_settings_on_create' => true,
            'category' => __('Theme Shortcodes - 2', 'adforest'),
            'params' => array(
                array(
                    'group' => __('Shortcode Output', 'adforest'),
                    'type' => 'custom_markup',
                    'heading' => __('Shortcode Output', 'adforest'),
                    'param_name' => 'order_field_key',
                    'description' => adforest_VCImage('vendor-banners.png') . __('Ouput of the shortcode will be look like this.', 'adforest'),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Background Color", 'adforest'),
                    "param_name" => "section_bg",
                    "admin_label" => true,
                    "value" => array(
                        __('Select Background Color', 'adforest') => '',
                        __('White', 'adforest') => '',
                        __('Gray', 'adforest') => 'gray',
                        __('Image', 'adforest') => 'img'
                    ),
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    "std" => '',
                    "description" => __("Select background color.", 'adforest'),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "attach_image",
                    "holder" => "bg_img",
                    "class" => "",
                    "heading" => __("Background Image", 'adforest'),
                    "param_name" => "bg_img",
                    'dependency' => array(
                        'element' => 'section_bg',
                        'value' => array('img'),
                    ),
                ),
                array
                (
                    'group' => __('Left & Right', 'adforest'),
                    'type' => 'param_group',
                    'description' => __('Upload only Two images', 'adforest'),
                    'heading' => __('Banner For Only Left & Right', 'adforest'),
                    'param_name' => 'vendor_left_right_banners',
                    'category' => __('Theme Shortcodes - 2', 'adforest'),
                    'value' => '',
                    'params' => array
                    (
                        array(
                            "group" => __("Banners", "adforest"),
                            'type' => 'attach_image',
                            'holder' => 'div',
                            'class' => '',
                            'admin_label' => true,
                            'param_name' => 'vendor_banners_lft_rght_image',
                            'description' => __('Banner Image by size 312x422', 'adforest'),
                            'edit_field_class' => 'vc_col-sm-6 vc_column',
                        ),
                        array(
                            "group" => __("Banners", "adforest"),
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => __("Banner Link", 'adforest'),
                            "param_name" => "vendor_banners_lft_rght_link",
                            "value" => "",
                            'edit_field_class' => 'vc_col-sm-12 vc_column',
                        ),
                    )
                ),
                /*banner image for bottom top*/
                array(
                    "group" => __("Middle Image", "adforest"),
                    'type' => 'attach_image',
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'vendor_banners_middle_top_image',
                    'description' => __('Banner Image by size 567x210', 'adforest'),
                    'edit_field_class' => 'vc_col-sm-6 vc_column',
                ),
                array(
                    "group" => __("Middle Image", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Banner Link", 'adforest'),
                    "param_name" => "vendor_banners_middle_top_link",
                    "value" => "",
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                ),
                /*banner image for middle bottom */
                array
                (
                    'group' => __('Bottom Small Images', 'adforest'),
                    'type' => 'param_group',
                    'description' => __('Upload only Two images', 'adforest'),
                    'heading' => __('Banner For Only Middle Bottom', 'adforest'),
                    'param_name' => 'vendor_midle_bottom_banners',
                    'category' => __('Theme Shortcodes - 2', 'adforest'),
                    'value' => '',
                    'params' => array
                    (
                        array(
                            "group" => __("Banners", "adforest"),
                            'type' => 'attach_image',
                            'holder' => 'div',
                            'class' => '',
                            'admin_label' => true,
                            'param_name' => 'vendor_banners_bottom_image',
                            'description' => __('Banner Image by size 270x179', 'adforest'),
                            'edit_field_class' => 'vc_col-sm-6 vc_column',
                        ),
                        array(
                            "group" => __("Banners", "adforest"),
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => __("Banner Link", 'adforest'),
                            "param_name" => "vendor_banners_bottom_link",
                            "value" => "",
                            'edit_field_class' => 'vc_col-sm-12 vc_column',
                        ),
                    )
                ),
            )
        ));
    }
}

if (!function_exists('adforest_vendor_banners_func')) {

    function adforest_vendor_banners_func($atts, $content = '')
    {
        require trailingslashit(get_template_directory()) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
        extract(shortcode_atts(array(
            'section_bg' => '',
            'attach_image' => '',
            'section_title_regular' => '',
            'section_description' => '',
            'vendor_left_right_banners' => '',
            'vendor_banners_middle_top_image' => '',
            'vendor_banners_middle_top_link' => '',
            'vendor_midle_bottom_banners' => '',
        ), $atts));
        extract($atts);

        /* Banner for outer images */
        $left_right_baners_html1 = $left_right_baners_html2 = '';

        $parallex = '';
        if ($section_bg == 'img') {
            $parallex = 'parallex';
        }

        if (isset($adforest_elementor) && $adforest_elementor) {
            $rows1 = $vendor_left_right_banners;
        } else {
            $rows1 = vc_param_group_parse_atts($atts['vendor_left_right_banners']);
        }
        if (count((array)$rows1) > 0) {
            $count1 = 0;
            foreach ($rows1 as $row) {
                if (!empty($row)) {
                    $count1 = $count1 + 1;
                    if (isset($adforest_elementor) && $adforest_elementor) {
                        $baners_id1 = isset($row['vendor_banners_lft_rght_img']['id']) ? $row['vendor_banners_lft_rght_img']['id'] : '';
                        $baners_img_url1 = adforest_returnImgSrc($baners_id1, 'adforest-vendor_banners_lft_rght_image');
                        $baners_link1 = isset($row['vendor_banners_lft_rght_link']) ? $row['vendor_banners_lft_rght_link'] : '#';
                    } else {
                        $baners_id1 = isset($row['vendor_banners_lft_rght_image']) ? $row['vendor_banners_lft_rght_image'] : '';
                        $baners_img_url1 = adforest_returnImgSrc($baners_id1, 'adforest-vendor_banners_lft_rght_image');
                        $baners_link1 = isset($row['vendor_banners_lft_rght_link']) ? $row['vendor_banners_lft_rght_link'] : '#';
                    }

                    if ($count1 == 1) {
                        $left_right_baners_html1 .= '<div class="col-sm-3 col-md-3 col-lg-3  margin-bottom-30 banner-one">
                        <a href="' . $baners_link1 . '"><img src="' . $baners_img_url1 . '" class="img-responsive img-full" alt="' . esc_html__('Banner', 'adforest') . '"></a>
                    </div>';
                    }
                    if ($count1 == 2) {
                        $left_right_baners_html2 .= '<div class="col-sm-3 col-md-3 col-lg-3 margin-bottom-30 banner-two">
                        <a href="' . $baners_link1 . '"><img src="' . $baners_img_url1 . '" class="img-responsive img-full" alt="' . esc_html__('Banner', 'adforest') . '"></a>
                    </div>';
                    }
                }
            }
        }
        /* Banner for middle upper image */
        $baners_id2 = isset($vendor_banners_middle_top_image) ? $vendor_banners_middle_top_image : '';
        $baners_img_url2 = adforest_returnImgSrc($baners_id2, 'adforest-vendor_banners_middle1_image');
        $baners_img_url2_html = '';
        if ($baners_img_url2 != '') {
            $baners_img_url2_html = '<img src="' . $baners_img_url2 . '" class="img-responsive img-full" alt="' . esc_html__('Banner', 'adforest') . '">';
        }
        $baners_link2 = isset($vendor_banners_middle_top_link) ? $vendor_banners_middle_top_link : '#';

        /* Banner for middle bottom images */
        $left_bottom_html3 = '';
        if (isset($adforest_elementor) && $adforest_elementor) {
            $rows2 = $vendor_midle_bottom_banners;
        } else {
            $rows2 = vc_param_group_parse_atts($atts['vendor_midle_bottom_banners']);
        }
        if (count((array)$rows2) > 0) {
            $count2 = 0;
            foreach ($rows2 as $row) {
                if (!empty($row)) {
                    $count2 = $count2 + 1;
                    if (isset($adforest_elementor) && $adforest_elementor) {
                        $baners_id3 = isset($row['vendor_banners_bottom_image']['id']) ? $row['vendor_banners_bottom_image']['id'] : '';
                        $baners_link3 = isset($row['vendor_banners_bottom_link']) ? $row['vendor_banners_bottom_link'] : '#';
                    } else {
                        $baners_id3 = isset($row['vendor_banners_bottom_image']) ? $row['vendor_banners_bottom_image'] : '';
                        $baners_link3 = isset($row['vendor_banners_bottom_link']) ? $row['vendor_banners_bottom_link'] : '#';
                    }
                    $baners_img_url3 = adforest_returnImgSrc($baners_id3, 'adforest-vendor_banners_middle2_image');
                    if ($count2 < 3) {
                        $left_bottom_html3 .= '<div class="col-sm-6 col-md-6 col-lg-6 margin-bottom-30"><a href="' . $baners_link3 . '"><img
                                            src="' . $baners_img_url3 . '"
                                            class="img-responsive img-full"
                                            alt="' . esc_html__('Banner', 'adforest') . '"></a></div>';
                    }
                }
            }
        }

        return '<section class="wcmpv-banners margin-top-50  ' . $parallex . ' ' . $bg_color . ' "' . $style . '>
            <div class="container">
                <div class="row">
                    ' . $left_right_baners_html1 . '
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="top-banner margin-bottom-60"><a href="' . $baners_link2 . '">' . $baners_img_url2_html . '</a></div>
                        <div class="row">
                            ' . $left_bottom_html3 . '
                        </div>
                    </div>
                    ' . $left_right_baners_html2 . '
                </div>
            </div>
        </section>';
    }

}
if (function_exists('adforest_add_code')) {
    adforest_add_code('vendor_banners', 'adforest_vendor_banners_func');
}