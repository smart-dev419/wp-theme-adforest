<?php
/* ------------------------------------------------ */
/* Ads */
/* ------------------------------------------------ */
if (!function_exists('adforest_location_data_shortcode')) {
    function adforest_location_data_shortcode($term_type = 'ad_country') {
        $result = array();
        if (!is_admin()) {
            return $result;
        }

        $args = array('hide_empty' => 0);
        $args = apply_filters('adforest_wpml_show_all_posts', $args); // for all lang texonomies
        $terms = get_terms($term_type, $args);
        if (count($terms) > 0) {
            foreach ($terms as $term) {
                $result[] = array
                    (
                    'value' => $term->slug,
                    'label' => $term->name,
                );
            }
        }
        return $result;
    }
}

if (!function_exists('ads_by_countries')) {

    function ads_by_countries() {
        vc_map(array(
            "name" => __("Custom Locations", 'adforest'),
            "base" => "location_short_base",
            "category" => __("Theme Shortcodes", 'adforest'),
            "params" => array(
                array(
                    'group' => __('Shortcode Output', 'adforest'),
                    'type' => 'custom_markup',
                    'heading' => __('Shortcode Output', 'adforest'),
                    'param_name' => 'order_field_key',
                    'description' => adforest_VCImage('by-location.png') . __('Ouput of the shortcode will be look like this.', 'adforest'),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Category link Page", 'adforest'),
                    "param_name" => "cat_link_page",
                    "admin_label" => true,
                    "value" => array(
                        __('Search Page', 'adforest') => 'search',
                        __('Category Page', 'adforest') => 'category',
                    ),
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
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
                        __('Gray', 'adforest') => 'gray'
                    ),
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    "std" => '',
                    "description" => __("Select background color.", 'adforest'),
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
                array(
                    'group' => esc_html__('Locations', 'adforest'),
                    'type' => 'param_group',
                    'heading' => esc_html__('Select Locations', 'adforest'),
                    'param_name' => 'select_locations',
                    'value' => '',
                    'params' => array(
                        array(
                            "type" => "autocomplete",
                            "holder" => "div",
                            "heading" => esc_html__("Location Name", 'adforest'),
                            "param_name" => "name",
                            'settings' => array('values' => adforest_location_data_shortcode()),
                        ),
                        array(
                            "type" => "attach_image",
                            "holder" => "bg_img",
                            "heading" => esc_html__("Location Background Image", 'adforest'),
                            "param_name" => "img",
                            "description" => __("Recommended size 250x160.", 'adforest'),
                        ),
                    )
                ),
            ),
        ));
    }

}

add_action('vc_before_init', 'ads_by_countries');

if (!function_exists('location_short_base_func')) {

    function location_short_base_func($atts, $content = '') {
        require trailingslashit(get_template_directory()) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";

        extract($atts);

        $g_cls = 'gradient1';
        if (adforest_detect_ie()) {
            $g_cls = '';
        }

        $marker_div = '<div class="marker-img"><img src="' . trailingslashit(get_template_directory_uri()) . 'images/route.png' . '" alt="' . __(' location', 'adforest') . '"></div>';
        $locations_html = '';
        if (isset($atts['select_locations']) && $atts['select_locations'] != '') {

            if (isset($adforest_elementor) && $adforest_elementor) {
                $rows = $atts['select_locations'];
            } else {
                $rows = vc_param_group_parse_atts($atts['select_locations']);
            }
            if (count($rows) > 0) {

                foreach ($rows as $r) {
                    if ($r != '') {
                        $img_thumb = '';
                        if (isset($adforest_elementor) && $adforest_elementor) {
                            $img = (isset($r['img']['id'])) ? $r['img']['id'] : '';
                        } else {
                            $img = (isset($r['img'])) ? $r['img'] : '';
                        }
                        $id = (isset($r['name'])) ? $r['name'] : '';
                        $img_url = wp_get_attachment_image_src($img, 'adforest-ad-country');
                        $img_thumb = isset($img_url[0])  ? $img_url[0]  :  "";
                        if (isset($adforest_elementor) && $adforest_elementor) {
                            $term = get_term_by('id', $id, 'ad_country');
                        } else {
                            $term = get_term_by('slug', $id, 'ad_country');
                        }
                        if (isset($term->name)) {
                            $id_get = $term->term_id;
                            $slug = $term->slug;
                            $name = $term->name;
                            $count = $term->count;
                            if (isset($adforest_elementor) && $adforest_elementor) {
                                $link = get_term_link($id_get, 'ad_country');
                            } else {
                                $link = get_term_link($slug, 'ad_country');
                            }
                            if (is_wp_error($link)) {
                                continue;
                            }
                            $parent = $term->parent;
                            $locations_html .= '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12"><a href="' . adforest_cat_link_page($id_get, $cat_link_page, 'country_id') . '"><div class="location-card card-cascade narrower">' . $marker_div . '<div class="view hm-white-slight"><img src="' . esc_url($img_thumb) . '" class="img-responsive" alt="' . esc_html($name) . '"></div><div class="card-body"><h3 class="' . $g_cls . '">' . esc_html($name) . '</h3><span class="card-title">(' . $count . __(' Ads', 'adforest') . ')</span></div></div></a></div>';
                        }
                    }
                }
            }
        }
        return '<section class="custom-padding ' . $bg_color . '"><div class="container"><div class="row">' . $header . '' . $locations_html . '</div></div></section>';
    }

}
if (function_exists('adforest_add_code')) {
    adforest_add_code('location_short_base', 'location_short_base_func');
}