<?php
/* ------------------------------------------------ */
/* Apps 2 */
/* ------------------------------------------------ */
if ( ! function_exists( 'apps_modern_short' ) ) {

	function apps_modern_short() {
		vc_map( array(
			"name"     => __( "Apps Modern", 'adforest' ),
			"base"     => "apps_modern_short_base",
			"category" => __( "Theme Shortcodes", 'adforest' ),
			"params"   => array(
				array(
					'group'       => __( 'Shortcode Output', 'adforest' ),
					'type'        => 'custom_markup',
					'heading'     => __( 'Shortcode Output', 'adforest' ),
					'param_name'  => 'order_field_key',
					'description' => adforest_VCImage( 'app-modern.png' ) . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
				),
				array(
					"group"       => __( "Basic", "adforest" ),
					"type"        => "attach_image",
					"holder"      => "bg_img",
					"class"       => "",
					"heading"     => __( "Main Image", 'adforest' ),
					"param_name"  => "bg_img_mod",
					"description" => __( "330x266", 'adforest' ),
				),
				array(
					"group"            => __( "Basic", "adforest" ),
					"type"             => "dropdown",
					"heading"          => __( "Background Color", 'adforest' ),
					"param_name"       => "section_bg_mod",
					"admin_label"      => true,
					"value"            => array(
						__( 'Select Background Color', 'adforest' ) => '',
						__( 'White', 'adforest' )                   => '',
						__( 'Gray', 'adforest' )                    => 'gray',
					),
					'edit_field_class' => 'vc_col-sm-12 vc_column',
					"std"              => '',
					"description"      => __( "Select background color.", 'adforest' ),
				),
				array(
					"group"      => __( "Basic", "adforest" ),
					"type"       => "textfield",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Section Title", 'adforest' ),
					"param_name" => "section_title_mod",
					"default"    => __( "Download our Apps Today", 'adforest' )
				),
				array(
					"group"      => __( "Basic", "adforest" ),
					"type"       => "textfield",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Tagline", 'adforest' ),
					"param_name" => "tag_line_mod",
					"default"    => __( "Get the App Now", 'adforest' )
				),
				array(
					"group"            => __( "Basic", "adforest" ),
					"type"             => "textarea",
					"holder"           => "div",
					"class"            => "",
					"heading"          => __( "Section Description", 'adforest' ),
					"param_name"       => "section_description_mod",
					"value"            => "",
					'edit_field_class' => 'vc_col-sm-12 vc_column',
					'dependency'       => array(
						'element' => 'header_style',
						'value'   => array( 'classic' ),
					),
				),
				// Android
				array(
					"group"      => __( "Android", "adforest" ),
					"type"       => "textfield",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Download Link", 'adforest' ),
					"param_name" => "a_link_mod",
				),
				array(
					"group"       => __( "Android", "adforest" ),
					"type"        => "attach_image",
					"holder"      => "bg_img",
					"class"       => "",
					"heading"     => __( "Android image", 'adforest' ),
					"param_name"  => "android_img_mod",
					"description" => __( "167x49", 'adforest' ),
				),
				// IOS
				array(
					"group"      => __( "IOS", "adforest" ),
					"type"       => "textfield",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Download Link", 'adforest' ),
					"param_name" => "i_link_mod",
				),
				array(
					"group"       => __( "IOS", "adforest" ),
					"type"        => "attach_image",
					"holder"      => "bg_img",
					"class"       => "",
					"heading"     => __( "IOS image", 'adforest' ),
					"param_name"  => "ios_img_mod",
					"description" => __( "167x49", 'adforest' ),
				),
			)
		) );
	}
}

add_action( 'vc_before_init', 'apps_modern_short' );
if ( ! function_exists( 'apps_modern_short_base_func' ) ) {

	function apps_modern_short_base_func( $att, $content = '' ) {
		extract( shortcode_atts( array(
			'attach_image_mod'        => '',
			'bg_img_mod'              => '',
			'section_title_mod'       => '',
			'section_bg_mod'          => '',
			'tag_line_mod'            => '',
			'section_description_mod' => '',
			'a_link_mod'              => '',
			'android_img_mod'         => '',
			'i_link_mod'              => '',
			'ios_img_mod'             => '',
		), $att ) );
		extract( $att );

		$section_title_mod       = isset( $section_title_mod ) ? $section_title_mod : '';
		$tag_line_mod            = isset( $tag_line_mod ) ? $tag_line_mod : '';
		$section_description_mod = isset( $section_description_mod ) ? $section_description_mod : '';

		$section_bg_class = ( $section_bg_mod == 'gray' ) ? 'gray' : '';

		$attach_image_mod_URL = $main_img_html_ = '';
		if ( $bg_img_mod != "" ) {
			$attach_image_mod_URL = adforest_returnImgSrc( $bg_img_mod );
			$main_img_html_ = '<img src="' . $attach_image_mod_URL . '" class="img-responsive img-full"
                                                 alt="' . __( 'Apps', 'adforest' ) . '">';

		}

		//android
		$android_apps_html = '';
		if ( $android_img_mod != "" ) {
			$android_img_mod   = adforest_returnImgSrc( $android_img_mod );
			$android_apps_html .= '<div class="apple-div margin-bottom-20"> <a href="' . esc_url( $a_link_mod ) . '" target="_blank"> <img src="' . $android_img_mod . '" class="img-responsive"  alt="' . esc_attr( 'image', 'adforest' ) . '"></a> </div>';
		}

		//ios
		$ios_apps_html = '';
		if ( $ios_img_mod != "" ) {
			$ios_img_mod   = adforest_returnImgSrc( $ios_img_mod );
			$ios_apps_html .= '<div class="apple-div margin-bottom-20"> <a href="' . esc_url( $i_link_mod ) . '" target="_blank"> <img src="' . $ios_img_mod . '" class="img-responsive"  alt="' . esc_attr( 'image', 'adforest' ) . '"></a> </div>';
		}

		return '<section class="section-footer-top-mlt footer-indexer ' . $section_bg_class . '">
            <div class="container container-15-custom">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                        <div class="hading">
                            <p class="t-center">' . $tag_line_mod . '</p>
                            <span class="t-center d-block col-md-8 no-padding clearfix"><h3 class="bold-hading">' . $section_title_mod . '</h3></span>
                            <div class="clearfix"></div>
                            <p>' . $section_description_mod . '</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-4 col-lg-2">
                        <div class="store-button">
                            ' . $android_apps_html . '
                            ' . $ios_apps_html . '
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-4 col-lg-4">
                        <div class="mobi-1">'.$main_img_html_.'
                        </div>
                    </div>
                </div>
            </div>
        </section>';

	}

}

if ( function_exists( 'adforest_add_code' ) ) {
	adforest_add_code( 'apps_modern_short_base', 'apps_modern_short_base_func' );
}