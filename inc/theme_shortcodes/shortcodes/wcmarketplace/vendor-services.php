<?php
/* ------------------------------------------------ */
/* services on vendor page */
/* ------------------------------------------------ */
add_action('vc_before_init', 'adforest_vendor_services_shortcode');
if (!function_exists('adforest_vendor_services_shortcode')) {

    function adforest_vendor_services_shortcode()
    {
        vc_map(array(
            'name' => __('Vendor Services', 'adforest'),
            'description' => '',
            'base' => 'vendor_services',
            'show_settings_on_create' => true,
            'category' => __('Theme Shortcodes - 2', 'adforest'),
            'params' => array(
                array(
                    'group' => __('Shortcode Output', 'adforest'),
                    'type' => 'custom_markup',
                    'heading' => __('Shortcode Output', 'adforest'),
                    'param_name' => 'order_field_key',
                    'description' => adforest_VCImage('vendor-service.png') . __('Ouput of the shortcode will be look like this.', 'adforest'),
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
                        __('Regular', 'adforest') => 'regular'
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
                    "description" => __('For color ', 'adforest') . '<strong>' . esc_html('{color}') . '</strong>' . __('warp text within this tag', 'adforest') . '<strong>' . '<strong>' . esc_html('{/color}') . '</strong>' . '</strong>',
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
                    "heading" => __("Section Description", 'adforest'),
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
                    "type" => "textarea",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section Description", 'adforest'),
                    "param_name" => "section_description",
                    "value" => "",
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    'dependency' => array(
                        'element' => 'header_style',
                        'value' => array('classic'),
                    ),
                ),
                array
                (
                    'group' => __('Services', 'adforest'),
                    'type' => 'param_group',
                    'heading' => __('Services', 'adforest'),
                    'param_name' => 'vendor_services',
                    'value' => '',
                    'params' => array
                    (
                        array(
                            "group" => __("Services", "adforest"),
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => __("Section Title", 'adforest'),
                            "param_name" => "vservice_title",
                            "value" => "",
                            'edit_field_class' => 'vc_col-sm-12 vc_column',
                        ),
                        array(
                            "group" => __("Services", "adforest"),
                            "type" => "textarea",
                            "holder" => "div",
                            "class" => "",
                            "heading" => __("Section Description", 'adforest'),
                            "param_name" => "vservice_desc",
                            "value" => "",
                            'edit_field_class' => 'vc_col-sm-12 vc_column',
                        ),
                        array(
                            "group" => __("Icon Image", "adforest"),
                            'type' => 'attach_image',
                            'holder' => 'div',
                            'class' => '',
                            'admin_label' => true,
                            'param_name' => 'vservice_icon_img',
                            'description' => __('Put Icon Image by size 42x28', 'adforest'),
                            'edit_field_class' => 'vc_col-sm-6 vc_column',
                        ),
                    )
                ),
            )
        ));
    }

}

if (!function_exists('adforest_vendor_services_func')) {

    function adforest_vendor_services_func($atts, $content = '')
    {
        require trailingslashit(get_template_directory()) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
        extract(shortcode_atts(array(
            'section_bg' => '',
            'attach_image' => '',
            'header_style' => '',
            'section_title' => '',
            'section_title_regular' => '',
            'section_description' => '',
            'vendor_services' => '',
        ), $atts));

        extract($atts);
        $parallex = $serv_html = '';

        if (isset($adforest_elementor) && $adforest_elementor) {
            $rows = $vendor_services;
        } else {
            $rows = vc_param_group_parse_atts($atts['vendor_services']);
        }


        if (count((array)$rows) > 0) {
            foreach ($rows as $row) {
                if (isset($adforest_elementor) && $adforest_elementor) {
                    $icon_id = isset($row['vservice_icon_img']['id']) ? $row['vservice_icon_img']['id'] : '';
                } else {
                    $icon_id = isset($row['vservice_icon_img']) ? $row['vservice_icon_img'] : '';
                }

                $icon_img_url = adforest_returnImgSrc($icon_id);
                $vserv_title = isset($row['vservice_title']) ? '<h2>' . $row['vservice_title'] . '</h2>' : '';
                $vserv_desc = isset($row['vservice_desc']) ? '<p>' . $row['vservice_desc'] . '</p>' : '';
                $serv_html .= '<div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="service-inner">
                            <span class="service-icon"><img src="' . $icon_img_url . '" alt="' . esc_html__('Icon', 'adforest') . '"/></span>
                            ' . $vserv_title . '
                            ' . $vserv_desc . '
                        </div>
                    </div>';
            }
        }
        return '<section class="wcmpv-services' . $parallex . ' ' . $bg_color . '"' . $style . '>
            <div class="container">
            
                    <div class="row">
                        ' . $header . '
                    </div>
                
                <div class="row">
                    ' . $serv_html . '
                </div>
            </div>
        </section>';
    }

}
if (function_exists('adforest_add_code')) {
    adforest_add_code('vendor_services', 'adforest_vendor_services_func');
}