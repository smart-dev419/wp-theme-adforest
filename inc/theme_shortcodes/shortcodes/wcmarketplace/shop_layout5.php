<?php
/* ------------------------------------------------ */
/* Shop Modern 5 */
/* ------------------------------------------------ */
if (!function_exists('shop_layout_data_shortcode2')) {

    function shop_layout_data_shortcode2($term_type = 'ad_country')
    {
        $result = array();
        if (!is_admin()) {
            return $result;
        }

        $args = array('hide_empty' => 0);
        $args = apply_filters('adforest_wpml_show_all_posts', $args); // for all lang texonomies
        $terms = get_terms($term_type, $args);

        if ($terms && !is_wp_error($terms)) {
            if (count($terms) > 0) {
                foreach ($terms as $term) {
                    $result[] = array('value' => $term->slug, 'label' => $term->name,);
                }
            }
        }

        return $result;
    }

}
if (!function_exists('shop_layout5_short')) {

    function shop_layout5_short()
    {
        vc_map(array(
            "name" => __("Shop Layout 5", 'adforest'),
            "base" => "shop_layout5_short_base",
            "category" => __("Theme Shortcodes - 2", 'adforest'),
            "params" => array(
                array(
                    'group' => __('Shortcode Output', 'adforest'),
                    'type' => 'custom_markup',
                    'heading' => __('Shortcode Output', 'adforest'),
                    'param_name' => 'order_field_key',
                    'description' => adforest_VCImage('shop-layout5.png') . __('Ouput of the shortcode will be look like this.', 'adforest'),
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
                    "group" => __("Products Setting", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Select Number of Product", 'adforest'),
                    "param_name" => "max_limit",
                    "value" => range(1, 1000),
                ),
//				array(
//					"group"      => __( "Products Setting", "adforest" ),
//					"type"       => "dropdown",
//					"heading"    => __( "Column Settings", 'adforest' ),
//					"param_name" => "p_cols",
//					"value"      => array(
//						__( 'Select Col ', 'adforest' ) => '',
//						__( '3 Col', 'adforest' )       => '4',
//						__( '4 Col', 'adforest' )       => '3',
//						__( '6 Col', 'adforest' )       => '2'
//					),
//				),
                array(
                    'group' => __('Categories', 'adforest'),
                    "type" => "dropdown",
                    "heading" => __("Select Products Categories", 'adforest'),
                    "param_name" => "all_products",
                    "value" => array(
                        __('Select Option', 'adforest') => '',
                        //__( 'All Categories', 'adforest' )       => 'all',
                        __('Selective Categories', 'adforest') => 'selective',
                    ),
                ),
                array
                (
                    'group' => __('Categories', 'adforest'),
                    'type' => 'param_group',
                    'heading' => __('Select Category', 'adforest'),
                    'param_name' => 'woo_products',
                    'value' => '',
                    'dependency' => array('element' => 'all_products', 'value' => array('selective'),),
                    'params' => array
                    (
                        array(
                            "type" => "dropdown",
                            "heading" => __("Select Product Categories", 'adforest'),
                            "param_name" => "product",
                            "admin_label" => true,
                            "value" => shop_layout_data_shortcode2('product_cat'),
                            "description" => __("Remove All categories to show products from all categories.", "adforest"),
                        ),
                    )
                ),
            ),
        ));
    }

}

add_action('vc_before_init', 'shop_layout5_short');
if (!function_exists('shop_layout5_short_base_func')) {

    function shop_layout5_short_base_func($atts, $content = '')
    {
        require trailingslashit(get_template_directory()) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
        $html = '';
        extract($atts);

        $product_fetch_type = 'slug';
        if (isset($adforest_elementor) && $adforest_elementor) {
            $rows = ($woo_products);
            $product_fetch_type = 'term_id';
            $all_products = 'selective';
        } else {
            $rows = vc_param_group_parse_atts($woo_products);
        }

        //===========
        $cat_menu_html = $cat_posts_html = $is_active = '';
        if ($all_products == "selective") {
            if (isset($rows) && !empty($rows) && is_array($rows) && count($rows) > 0) {
                $count = 1;
                foreach ($rows as $row) {
                    
                    
                    $rand   =    rand();
                    if (isset($adforest_elementor) && $adforest_elementor) {
                        $category_obj = get_term_by('slug', $row, 'product_cat');
                    } else {
                        $category_obj = get_term_by('slug', $row['product'], 'product_cat');
                    }
                    $categ_id = isset($category_obj->term_id) ? $category_obj->term_id : '';
                    $categ_slug = isset($category_obj->slug) ? $category_obj->slug : '';
                    $categ_name = isset($category_obj->name) ? $category_obj->name : '';
                    $categ_count = isset($category_obj->count) ? $category_obj->count : 0;
                    if ($categ_id != '' && $categ_count > 0) {
                        $is_active_tab = $is_active_desc = '';
                        if ($count == 1) {
                            $is_active_tab = 'active';
                            $is_active_desc = 'in active';
                        }
                        $count = $count + 1;
                        
                        
                      
                        
                        
                        /* creating tabs */
                        $cat_menu_html .= '<a class="nav-item nav-link bgclr-yal ' . esc_attr($is_active_tab) . '" id="nav-' . $categ_slug . '-tab1" data-toggle="tab"
                               href="#' . $rand . '" role="tab" aria-controls="nav-' . $categ_slug . '" aria-selected="true">' . $categ_name . '</a>';
                        /* creating product grids */
                        if (isset($adforest_elementor) && $adforest_elementor) {
                            $categ_id_slug = $categ_id;
                        } else {
                            $categ_id_slug = $categ_slug;
                        }
                        $cat_posts_html .= '<ul class="tab-pane fade ' . esc_attr($is_active_desc) . ' arrival-ul" id="' . $rand . '">';
                        $cat_posts_html .= get_products_by_category($categ_id_slug, $max_limit, $product_fetch_type );
                        $cat_posts_html .= '</ul>';
                    }
                }
            }
        }

        $parallex = ($section_bg == 'img') ? 'parallex' : "";

        return '<section class="wcmpv-new-arrival' . $parallex . ' ' . $bg_color . '" ' . $style . '>
            <div class="container">
                <div class="col-12 margin-bottom-30">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            ' . $header . '
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6  text-right">
                            <nav>
                                <div class="nav nav-tabs nav-fill float-right border-0 c-nav mb-nav" id="nav-tab1"
                                     role="tablist">
                                    ' . $cat_menu_html . '
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content new-arrival-inner">
                            ' . $cat_posts_html . '
                        </div>
                    </div>
                </div>
            </div>
        </section>';
    }
}

if (function_exists('adforest_add_code')) {
    adforest_add_code('shop_layout5_short_base', 'shop_layout5_short_base_func');
}