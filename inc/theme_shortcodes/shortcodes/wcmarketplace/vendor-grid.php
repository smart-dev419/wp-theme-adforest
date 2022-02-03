<?php
/* ------------------------------------------------ */
/* About Us */
/* ------------------------------------------------ */
if (!function_exists('vendro_grid')) {

    function vendro_grid()
    {
        vc_map(array(
            "name" => __("Vendor Grid", 'adforest'),
            "base" => "vendor_grid_short_base",
            "category" => __("Theme Shortcodes", 'adforest'),
            "params" => array(
                array(
                    'group' => __('Shortcode Output', 'adforest'),
                    'type' => 'custom_markup',
                    'heading' => __('Shortcode Output', 'adforest'),
                    'param_name' => 'order_field_key',
                    'description' => adforest_VCImage('vendor-grid.png') . __('Ouput of the shortcode will be look like this.', 'adforest'),
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
                    )
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Header Style", 'adforest'),
                    "param_name" => "header_style",
                    "admin_label" => true,
                    "value" => array(
                        __('Section Header Style', 'adforest') => '',
                        __('No Header', 'adforest') => '',
                        __('Classic', 'adforest') => 'classic',
                        __('Regular', 'adforest') => 'regular',
                        __('Fancy', 'adforest') => 'fancy',
                        __('Modern', 'adforest') => 'modern',
                    ),
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    "std" => '',
                    "description" => __("Chose header style.", 'adforest'),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section Title", 'adforest'),
                    "param_name" => "section_title",
                    "description" => __('For color ', 'adforest') . '<strong>' . esc_html('{color}') . '</strong>' . __('warp text within this tag', 'adforest') . '<strong>' . esc_html('{/color}') . '</strong>',
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    'dependency' => array(
                        'element' => 'header_style',
                        'value' => array('classic'),
                    ),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section Title", 'adforest'),
                    "param_name" => "section_title_regular",
                    "value" => "",
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    'dependency' => array(
                        'element' => 'header_style',
                        'value' => array('regular'),
                    ),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "description" => __('For color ', 'adforest') . '<strong>' . esc_html('{color}') . '</strong>' . __('warp text within this tag', 'adforest') . '<strong>' . esc_html('{/color}') . '</strong>',
                    "heading" => __("Section Title", 'adforest'),
                    "param_name" => "section_title_fancy",
                    "value" => "",
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    'dependency' => array(
                        'element' => 'header_style',
                        'value' => array('fancy'),
                    ),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "description" => __('For color ', 'adforest') . '<strong>' . esc_html('{color}') . '</strong>' . __('warp text within this tag', 'adforest') . '<strong>' . esc_html('{/color}') . '</strong>',
                    "heading" => __("Section Title", 'adforest'),
                    "param_name" => "section_title_modern",
                    "value" => "",
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    'dependency' => array(
                        'element' => 'header_style',
                        'value' => array('modern'),
                    ),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textarea",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section Description", 'adforest'),
                    "param_name" => "section_description",
                    "value" => "",
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    'dependency' => array(
                        'element' => 'header_style',
                        'value' => array('classic', 'modern'),
                    ),
                ),
                array(
                    "group" => __("Vendors Settings", "adforest"),
                    'type' => 'vc_link',
                    'holder' => 'div',
                    'class' => '',
                    'admin_label' => true,
                    'heading' => __('Button Link', 'adforest'),
                    'param_name' => 'vendor_all_link',
                ),
                array(
                    "group" => __("Vendors Settings", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Number fo Vendors", 'adforest'),
                    "param_name" => "no_of_vendors",
                    "admin_label" => true,
                    "value" => range(1, 500),
                ),
            )
        ));
    }

}

add_action('vc_before_init', 'vendro_grid');

if (!function_exists('vendro_grid_base_func')) {

    function vendro_grid_base_func($atts, $content = '')
    {
        require trailingslashit(get_template_directory()) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
        extract(shortcode_atts(array(
            'section_bg' => '',
            'attach_image' => '',
            'header_style' => '',
            'section_title' => '',
            'section_title_regular' => '',
            'section_description' => '',
            'vendor_all_link' => '',
            'no_of_vendors' => ''
        ), $atts));

        extract($atts);

        $btnHTML = '';
        if (isset($adforest_elementor) && $adforest_elementor) {
            $btn_args = array(
                'btn_key' => $main_link,
                'adforest_elementor' => $adforest_elementor,
                'btn_class' => 'btn btn-theme text-center',
                'iconBefore' => '',
                'iconAfter' => '',
                'titleText' => $link_title,
            );
            $btn = apply_filters('adforest_elementor_url_field', $btnHTML, $btn_args);
        } else {
            $btn = adforest_ThemeBtn($vendor_all_link, 'btn btn-theme', false);
        }


        $parallex = '';
        if ($section_bg == 'img') {
          //  $parallex = 'parallex';
        }

        $no_of_vendors_ = 4;
        if (isset($no_of_vendors) && $no_of_vendors != '') {
            $no_of_vendors_ = $no_of_vendors;
        }

        /* get all vendors */
        global $WCMp;
        $vendors_id = get_users(
            array(
                'fields' => 'ids',
                'role' => 'dc_vendor',
            )
        );

        return '<section class="wcmpv-vendor margin-top-50 section-padding-40 margin-bottom-30 ' . $parallex . ' ' . $bg_color . ' " ' . $style . '>
            <div class="container">              
                    <div class="row">
                    <div class="col-lg-12 margin-bottom-30">
                        ' . $header . '
                    </div>
                </div>
                <div class="row">
                    ' . adforest_all_vendors_style1($vendors_id, $no_of_vendors_) . '
                </div>
                ' . ($btn) . '
            </div>
        </section>';
    }
}

if (function_exists('adforest_add_code')) {
    adforest_add_code('vendor_grid_short_base', 'vendro_grid_base_func');
}