<?php

/* ------------------------------------------------ */
/* Hero Section Toy */
/* ------------------------------------------------ */
add_action('vc_before_init', 'adforest_hero_vendro_slider_shortcode');
if (!function_exists('adforest_hero_vendro_slider_shortcode')) {

    function adforest_hero_vendro_slider_shortcode() {

        $cat_array = array();

        $cat_array = apply_filters('adforest_ajax_load_categories', $cat_array, 'cat', 'no');

        vc_map(array(
            'name' => __('Hero Section - Vendor Banner Slider', 'adforest'),
            'description' => '',
            'base' => 'adforest_hero_vendro_slider',
            'show_settings_on_create' => true,
            'category' => __('Theme Shortcodes - 2', 'adforest'),
            'params' => array(
                array(
                    'group' => __('Shortcode Output', 'adforest'),
                    'type' => 'custom_markup',
                    'heading' => __('Shortcode Output', 'adforest'),
                    'param_name' => 'order_field_key',
                    'description' => adforest_VCImage('hero-vendor-slider.png') . __('Ouput of the shortcode will be look like this.', 'adforest'),
                ),
                array(
                    'group' => __('Slider Settings', 'adforest'),
                    'type' => 'param_group',
                    'heading' => __('Add Slides', 'adforest'),
                    'param_name' => 'vendor_slides',
                    'value' => '',
                    'params' => array
                        (
                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => __("Slider Signature Image", "adforest"),
                            "param_name" => "slider_signature_image",
                            "value" => '',
                            "description" => __("Add an image of Slider : Recommended size (175 X 66)", "adforest")
                        ),
                        array(
                            "type" => "attach_image",
                            "class" => "",
                            "heading" => __("Slider Image", "adforest"),
                            "param_name" => "slider_image",
                            "value" => '',
                            "description" => __("Add an image of Slider : Recommended size (1650 X 550)", "adforest")
                        ),
                        array(
                            "type" => "textfield",
                            "class" => "",
                            "heading" => __("Slider Title", "adforest"),
                            "param_name" => "slider_title",
                            "value" => '',
                            "description" => '',
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => __("Slider Base Line", 'adforest'),
                            "param_name" => "slider_base_line",
                            "value" => "",
                        ),
                        array(
                            "type" => "vc_link",
                            "heading" => __("Slider Button", 'adforest'),
                            "param_name" => "slider_btn",
                            "description" => '',
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => __("Video Link", 'adforest'),
                            "param_name" => "slider_video_link",
                            "value" => "",
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => __("Video Text", 'adforest'),
                            "param_name" => "slider_video_text",
                            "value" => "",
                        ),
                        array(
                            "type" => "textfield",
                            "holder" => "div",
                            "class" => "",
                            "heading" => __("Value for Discount", 'adforest'),
                            "param_name" => "slider_off_sale_num",
                            "value" => "",
                        ),
                    ),
                ),
            )
        ));
    }

}

if (!function_exists('adforest_hero_vendro_slider_callback')) {

    function adforest_hero_vendro_slider_callback($atts, $content = '') {
        extract(
                shortcode_atts(
                        array(
                            'vendor_slides' => '',
                            'slider_signature_image' => '',
                            'slider_image' => '',
                            'slider_title' => '',
                            'slider_base_line' => '',
                            'slider_btn' => '',
                            'slider_video_link' => '',
                            'slider_video_text' => '',
                            'slider_off_sale_num' => ''
                        ), $atts)
        );
        extract($atts);

        wp_enqueue_script('carousel');

        if (isset($adforest_elementor) && $adforest_elementor) {
            $element_slides = ($atts['vendor_slides']);
        } else {
            $element_slides = vc_param_group_parse_atts($atts['vendor_slides']);
        }

        $slider_html = '';
        $slider_off_sale_num_html = '';
        if (isset($element_slides) && !empty($element_slides) && is_array($element_slides) && count($element_slides) > 0) {
            foreach ($element_slides as $slide) {
                if (!empty($slide)) {
                    if (isset($adforest_elementor) && $adforest_elementor) {
                        $singature_img = isset($slide['slider_signature_image']['id']) ? $slide['slider_signature_image']['id'] : '';
                        $slider_img = isset($slide['slider_image']['id']) ? $slide['slider_image']['id'] : '';
                    } else {
                        $singature_img = isset($slide['slider_signature_image']) ? $slide['slider_signature_image'] : '';
                        $slider_img = isset($slide['slider_image']) ? $slide['slider_image'] : '';
                    }

                    $signature_image = adforest_returnImgSrc($singature_img, 'adforest_vendor_hero_signature');

                    $slider_image = adforest_returnImgSrc($slider_img, 'adforest_vendor_hero_slider');

                    $slider_title = isset($slide['slider_title']) ? $slide['slider_title'] : '';
                    $slider_base_line = isset($slide['slider_base_line']) ? $slide['slider_base_line'] : '';

                    $slider_video_text = isset($slide['slider_video_text']) ? $slide['slider_video_text'] : '';
                    $slider_video_link = isset($slide['slider_video_link']) ? $slide['slider_video_link'] : '';

                    $slider_off_sale_num = isset($slide['slider_off_sale_num']) ? $slide['slider_off_sale_num'] : '';
                    if ($slider_off_sale_num != '') {
                        $slider_off_sale_num_html = '<div class="offbg">
                                            <div class="main-off">
                                                <div class="top">' . __('UPTO', 'adforest') . '</div>' . $slide['slider_off_sale_num'] . '
                                                <span>%</span>
                                                <div class="bot">' . __('OFF', 'adforest') . '</div>
                                            </div>
                                        </div>';
                    }

                    $add_sport_btn = $btnHTML = '';
                    if (isset($adforest_elementor) && $adforest_elementor) {
                        if ($slide['link_title'] != '' && $slide['main_link'] != '') {
                            $btn_args = array(
                                'btn_key' => $slide['main_link'],
                                'adforest_elementor' => $adforest_elementor,
                                'btn_class' => 'btn btn-theme text-center',
                                'iconBefore' => '',
                                'iconAfter' => '',
                                'titleText' => $slide['link_title'],
                            );
                            $add_sport_btn = apply_filters('adforest_elementor_url_field', $btnHTML, $btn_args);
                        }
                    } else {
                        $slider_btn = isset($slide['slider_btn']) ? $slide['slider_btn'] : '';
                        if ($slider_btn != '') {
                            $add_sport_btn = adforest_ThemeBtn($slider_btn, 'btn btn-theme', false);
                        }
                    }

                  $slider_video_html   =  "";
                  
                  if($slider_video_link != ""){ 
                    
                  $slider_video_html   =   ' <li class="video-btn"><a href="' . $slider_video_link . '"
                                                                     class="trust btn btn-theme"><i class="fa fa-play"
                                                                                                    aria-hidden="true"></i></a>
                  </li>';}
                  
                  $signature_image_html   =  "";
                  
                  if($signature_image != ""){
                   $signature_image_html    =    '<img src="' . $signature_image . '" alt="' . __('No Image', 'adforest') . '" class="img-responsive"/>';
                  }
                 
                 
                 
                    $slider_html .= '<div class="item">
                <section class="wcmpv-hero" style="background-image:url(' . $slider_image . ') ; background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;">
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-3">
                                <div class="wcmpv-hero-heading">
                                    <div class="singnaute col-lg-7">
                                        '.$signature_image_html.'                                     
                                        ' . $slider_off_sale_num_html . '
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="heading-bottom">
                                        <p>' . $slider_base_line . '</p>
                                        <h1>' . $slider_title . '</h1>
                                    </div>
                                    <div class="video-heading">
                                        <ul class="shop-now list-inline">
                                        <li class="shop-btn">' . $add_sport_btn . '</li>
                                            
                                              '.$slider_video_html.'
                                            
                                            <li class="video-text"><p>' . $slider_video_text . '</p></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>';
                }
            }
        }

        return '<div class="tophero-slider owl-carousel owl-theme">
            ' . $slider_html . '
        </div>';
    }

}
if (function_exists('adforest_add_code')) {
    adforest_add_code('adforest_hero_vendro_slider', 'adforest_hero_vendro_slider_callback');
}