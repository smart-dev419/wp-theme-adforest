<?php
/* ------------------------------------------------ */
/* services on vendor page */
/* ------------------------------------------------ */
add_action('vc_before_init', 'adforest_vendor_baner_shortcode');
if (!function_exists('adforest_vendor_baner_shortcode')) {

    function adforest_vendor_baner_shortcode()
    {
        vc_map(array(
            'name' => __('Vendor Banner', 'adforest'),
            'description' => '',
            'base' => 'vendor_baner',
            'show_settings_on_create' => true,
            'category' => __('Theme Shortcodes - 2', 'adforest'),
            'params' => array(
                array(
                    'group' => __('Shortcode Output', 'adforest'),
                    'type' => 'custom_markup',
                    'heading' => __('Shortcode Output', 'adforest'),
                    'param_name' => 'order_field_key',
                    'description' => adforest_VCImage('vendor-baner.png') . __('Ouput of the shortcode will be look like this.', 'adforest'),
                ),
                array(
                    "group" => __("Banner Image", "adforest"),
                    'type' => 'attach_image',
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'vendor_baner_img',
                    'description' => __('Put Banner Image by size 1220x88', 'adforest'),
                    'edit_field_class' => 'vc_col-sm-6 vc_column',
                ),
                array(
                    "group" => __("Banner Image", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Banner Link", 'adforest'),
                    "param_name" => "vendor_baner_img_link",
                    "value" => "",
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                ),
            )
        ));
    }

}

if (!function_exists('adforest_vendor_baner_func')) {

    function adforest_vendor_baner_func($atts, $content = '')
    {
        require trailingslashit(get_template_directory()) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
        extract(shortcode_atts(array(
            'vendor_baner_img' => '',
            'vendor_baner_img_link' => '',
        ), $atts));

        $baner_img_url = $baner_link = $baner_img_html = '';
        $baner_id = isset($vendor_baner_img) ? $vendor_baner_img : '';
        if ($baner_id != '') {
            $baner_img_url = adforest_returnImgSrc($baner_id, 'vendor_baner_img');
            $baner_img_html = '<img src="' . $baner_img_url . '" class="img-responsive img-full" alt="' . esc_html__('Banner', 'adforest') . '"/>';
        }
        $baner_link = isset($vendor_baner_img_link) ? $vendor_baner_img_link : '#';

        return '<section class="wcmpv-baner">
			<div class="container">
            	<div class="row">
                	<div class="col-lg-12 margin-top-50">
                    	<div class="banner-full margin-bottom-30">
                        	<a href="' . $baner_link . '">' . $baner_img_html . '
                        	</a>
                    	</div>
                	</div>
            	</div>
            </div>
        </section>';
    }

}
if (function_exists('adforest_add_code')) {
    adforest_add_code('vendor_baner', 'adforest_vendor_baner_func');
}