/*

 Template: AdForest | Largest Classifieds Portal

 Author: ScriptsBundle

 Version: 1.0

 Designed and Development by: ScriptsBundle

 */

var adforest_is_rtl = jQuery('#is_rtl').val();														

var slider_rtl = false;

if (adforest_is_rtl != 'undefined' && adforest_is_rtl == '1') {

	slider_rtl = true;

}

var header_style_val = jQuery('#sb_header_type').val();

var is_menu_display = jQuery('#is_menu_display').val();

var scroll_height = 0;

if (typeof header_style_val !== 'undefined' && header_style_val == 'modern4') {

	scroll_height = 200;

}



(function ($) {

	"use strict";



	var is_stick = $('#is_sticky_header').val();

	if (is_stick === '1') {

		$(document).scroll(function () {

			var limit = 200;

			if (jQuery(this).scrollTop() >= limit) {

				jQuery('.mega-menu').addClass('desktopTopFixed');

			} else {

				jQuery('.mega-menu').removeClass('desktopTopFixed');

			}

		});

	}



	var adforest_ajax_url = $('#adforest_ajax_url').val();

	$('.top-loc-selection').on('click', function () {

		var loc_id = $(this).attr("data-loc-id");

		$('#sb_loading').show();

		jQuery.post(jQuery('#adforest_ajax_url').val(), {action: 'sb_set_site_location', location_id: loc_id}).done(function (response)

																													{

			$('#sb_loading').hide();

			if (typeof response !== undefined && response == 1) {

				window.location.reload();

			} else {

				alert(get_strings.adforest_location_error);

			}

		});

		return false;

	});



	if (header_style_val !== 'undefined' && (header_style_val == 'transparent-2' || header_style_val == 'transparent-3' || header_style_val == 'modern') && $('#sb_is_homepage').val() !== "1") {

		$(".sb-modern-header .sb-colors-combination-c1 .sb-colored-header .mega-menu").css("position", "relative");

		$(".sb-transparent2-header .sb-top-header-3 .sb-top-header .mega-menu.menu-2").css("position", "relative");

		$(".sb-transparent3-header .sb-srvs-top-header .sb-top-header-3 .sb-top-header .mega-menu").css("position", "relative");

	}

	var adlocation_words = $("#word-count").text().length;

	if (adlocation_words < 35) {

		$('.country-locations').addClass('single-line');

	}

	var ua = navigator.userAgent.toLowerCase();







	if (ua.indexOf("safari/") !== -1 && ua.indexOf("windows") !== -1 && ua.indexOf("chrome") === -1) {

		$('.sb-top-bar_notification').show();

	} else {



		$('.sb-top-bar_notification').hide();

	}

	/* Preloader */

	setTimeout(function () {

		$('body').addClass('loaded');

	}, 3000);

	/* Counter FunFacts */

	var timer = $('.timer');

	if (timer.length) {

		timer.appear(function () {

			timer.countTo();

		});

	}

	/* List Grid Style Switcher */

	$('#list').on("click", function (event) {

		event.preventDefault();

		$(this).addClass('active');

		$('#grid').removeClass('active');

		$('#products .item').addClass('list-group-items');

	});

	$('#grid').on("click", function (event) {

		event.preventDefault();

		$(this).addClass('active');

		$('#list').removeClass('active');

		$('#products .item').removeClass('list-group-items');

		$('#products .item').addClass('grid-group-item');

	});

	/* Sticky Ads */

	$('.leftbar-stick, .rightbar-stick').theiaStickySidebar({

		additionalMarginTop: 80

	});

	/* Accordion Panels */

	$('.accordion-title a').on('click', function (event) {

		event.preventDefault();

		if ($(this).parents('li').hasClass('open')) {

			$(this).parents('li').removeClass('open').find('.accordion-content').slideUp(400);

		} else {

			$(this).parents('.accordion').find('.accordion-content').not($(this).parents('li').find('.accordion-content')).slideUp(400);

			$(this).parents('.accordion').find('> li').not($(this).parents('li')).removeClass('open');

			$(this).parents('li').addClass('open').find('.accordion-content').slideDown(400);

		}

	});



	/* Accordion Style 2 */

	$('#accordion').on('shown.bs.collapse', function () {

		var offset = $('.panel.panel-default > .panel-collapse.in').offset();

		if (offset) {

			$('html,body').animate({scrollTop: $('.panel-title a').offset().top - 20}, 500);

		}

	});



	/* Jquery CheckBoxes */

	$('.skin-minimal .list li input').iCheck({checkboxClass: 'icheckbox_minimal', radioClass: 'iradio_minimal', increaseArea: '20%'});

	$('.checkbox-wrap input').iCheck({checkboxClass: 'icheckbox_minimal', radioClass: 'iradio_minimal', increaseArea: '20%'});



	var get_sticky = $('#is_sticky_header').val();

	var is_sticky = false;

	if (get_sticky != "" && get_sticky == "1") {

		var is_sticky = true;

	}

	if ($('#is_rtl').val() != "" && $('#is_rtl').val() == "1")

	{

		$('.posts-masonry').imagesLoaded(function () {

			$('.posts-masonry').isotope({layoutMode: 'masonry', transitionDuration: '0.3s', isOriginLeft: false, });

		});

		if (typeof is_menu_display !== 'undefined' && is_menu_display == 'yes') {

			$('#menu-1').megaMenu({logo_align: 'left', links_align: 'left', socialBar_align: 'right', searchBar_align: 'left', trigger: 'hover', effect: 'expand-top', effect_speed: 400, sibling: true, outside_click_close: true, top_fixed: false, sticky_header: false, sticky_header_height: scroll_height, menu_position: 'horizontal', full_width: false, mobile_settings: {collapse: true, sibling: true, scrollBar: true, scrollBar_height: 400, top_fixed: false, sticky_header: false, sticky_header_height: 0}});

		}

		/* Jquery Select Dropdowns */

		$("select:not(.no_select2)").select2({dir: "rtl", placeholder: $('#select_place_holder').val(), allowClear: true, width: '100%'});

		$('.remove_select2, .no_select2').select2('destroy');

		/* Featured Carousel 1 */



		var column2inmobile = get_strings.mobile_2column_in_slider;

		var column_count = (column2inmobile == true) ? 2 : 1;

		$('.featured-slider').owlCarousel({

			rtl: true,

			dots: false,

			loop: ($(".featured-slider .item").length > 1) ? true : false,

			autoplay: true,

			autoplayHoverPause: true,

			autoplayTimeout: parseInt($('#auto_slide_time').val()),

			margin: -10,

			responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.

			navText: ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"],

			responsive: {0: {items: column_count, nav: true}, 600: {items: 2, nav: true}, 1000: {items: $('#slider_item').val(), nav: true, loop: ($(".featured-slider .item").length > 1) ? true : false, }}

		});



		/* Featured Carousel 2 */

		$('.featured-slider-1').owlCarousel({

			rtl: true,

			dots: ($(".featured-slider-1 .item").length > 1) ? false : false,

			loop: ($(".featured-slider-1 .item").length > 1) ? true : true,

			autoplay: true,

			autoplayHoverPause: true,

			margin: -10,

			responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.

			navText: ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"],

			responsive: {0: {items: column_count, nav: true}, 600: {items: 2, nav: true}, 1000: {items: $('#slider_item').val(), nav: true, loop: ($(".featured-slider-1 .item").length > 4) ? true : false, }}

		});



		/* Featured Carousel 2 */

		$('.featured-slider-5').owlCarousel({

			rtl: true,

			dots: ($(".featured-slider-5 .item").length > 1) ? false : false,

			loop: ($(".featured-slider-5 .item").length > 1) ? false : false,

			autoplay: true,

			autoplayHoverPause: true,

			margin: -10,

			responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.

			navText: ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"],

			responsive: {0: {items: 1, nav: true}, 600: {items: 2, nav: true}, 1000: {items: 3, nav: true, loop: ($(".featured-slider-5 .item").length > 1) ? false : false, }}

		});



		/* Featured  Carousel 3 */

		$('.featured-slider-3').owlCarousel({

			rtl: true,

			dots: ($(".featured-slider-3 .item").length > 1) ? false : false,

			loop: ($(".featured-slider-3 .item").length > 1) ? true : false,

			autoplay: true,

			autoplayHoverPause: true,

			margin: 0,

			responsiveClass: true,

			navText: ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"],

			responsive: {

				0: {items: column_count, nav: true},

				600: {items: 2, nav: true},

				1000: {items: 1, nav: true, loop: ($(".featured-slider-3 .item").length > 1) ? true : false, }

			}

		});



		/* Category Carousel */

		$('.category-slider').owlCarousel({

			loop: true,

			rtl: true,

			dots: false,

			autoplay: true,

			autoplayHoverPause: true,

			margin: 0,

			responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.

			navText: ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"],

			responsive: {

				0: {items: 1, nav: true},

				600: {items: 2, nav: true},

				1000: {items: 4, nav: true, loop: true}

			}

		});



		/* Background Image Rotator Carousel */

		$('.background-rotator-slider').owlCarousel({

			loop: false,

			rtl: true,

			dots: false,

			margin: 0,

			autoplay: true,

			autoplayHoverPause: true,

			mouseDrag: true,

			touchDrag: true,

			responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.

			nav: false,

			responsive: {

				0: {items: 1, },

				600: {items: 1, },

				1000: {items: 1, }

			}

		});



		/* Slider Carousel */

		$('.single-details').owlCarousel({

			dots: ($(".single-details .item").length > 1) ? false : false,

			loop: ($(".single-details .item").length > 1) ? false : false,

			rtl: true,

			margin: 0,

			autoplay: true,

			autoplayHoverPause: true,

			autoplayTimeout: parseInt($('#auto_slide_time').val()),

			mouseDrag: true,

			touchDrag: true,

			responsiveClass: true,

			nav: true,

			navText: ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"],

			responsive: {0: {items: 1, }, 600: {items: 1, }, 1000: {items: 1, }}

		});



		$('.abcd').owlCarousel({margin: 10, responsive: {0: {items: 1}, 600: {items: 3}, 1000: {items: 5}}});



		$('.success-stories-21').owlCarousel({

			loop: true,

			margin: 10,

			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

			nav: true,

			autoplay: true,

			responsive: {0: {items: 1}, 600: {items: 3, }, 1000: {items: 1, }}

		});



		/* Single Page SLider With Thumb */

		$('#carousels').flexslider({

			animation: "slide",

			controlNav: false,

			animationLoop: false,

			slideshow: false,

			itemWidth: 110,

			itemMargin: 50,

			rtl: true,

			asNavFor: '.single-page-slider'

		});

		$('.single-page-slider').flexslider({

			animation: "slide",

			controlNav: false,

			animationLoop: false,

			slideshow: true,

			rtl: true,

			sync: "#carousel"

		});

	} else

	{



















		/* Masonry Grid System */

		$('.posts-masonry').imagesLoaded(function () {

			$('.posts-masonry').isotope({layoutMode: 'masonry', transitionDuration: '0.3s', });

		});



		/* Template MegaMenu */

		if (typeof is_menu_display !== 'undefined' && is_menu_display == 'yes') {

			$('#menu-1').megaMenu({

				logo_align: 'left',

				links_align: 'left',

				socialBar_align: 'left',

				searchBar_align: 'right',

				trigger: 'hover',

				effect: 'expand-top',

				effect_speed: 400,

				sibling: true,

				outside_click_close: true,

				top_fixed: false,

				sticky_header: false,

				sticky_header_height: scroll_height,

				menu_position: 'horizontal',

				full_width: false,

				mobile_settings: {collapse: true, sibling: true, scrollBar: true, scrollBar_height: 400, top_fixed: false, sticky_header: false, sticky_header_height: 0}

			});

		}

		/* Jquery Select Dropdowns */

		$("select:not(.no_select2)").select2({

			placeholder: $('#select_place_holder').val(),

			allowClear: true,

			width: '100%'

		});

		$('.remove_select2').select2('destroy');

		/* Featured Carousel 1 */



		var column2inmobile = get_strings.mobile_2column_in_slider;

		var column_count = (column2inmobile == true) ? 2 : 1;



		if(column2inmobile == true && $(".featured-slider-1 .item .col-xs-6" ) .length > 0){



			$(".featured-slider-1 .item .col-xs-6" ).removeClass('col-xs-6').addClass('col-xs-12');



		}

		$('.featured-slider').owlCarousel({

			dots: false,

			loop: ($(".featured-slider .item").length > 1) ? true : false,

			autoplay: true,

			autoplayHoverPause: true,

			autoplayTimeout: parseInt($('#auto_slide_time').val()),

			margin: -10,

			responsiveClass: true,

			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

			responsive: {0: {items: column_count, nav: true}, 600: {items: 2, nav: true}, 1000: {items: $('#slider_item').val(), nav: true, loop: ($(".featured-slider .item").length > 1) ? true : false, }}

		});

		/* Featured Carousel 2 */

		$('.featured-slider-1').owlCarousel({

			dots: ($(".featured-slider-1 .item").length > 1) ? false : false,

			loop: ($(".featured-slider-1 .item").length > 1) ? true : false,

			autoplay: true,

			autoplayHoverPause: true,

			autoplayTimeout: parseInt($('#auto_slide_time').val()),

			margin: -10,

			responsiveClass: true,

			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

			responsive: {0: {items: 2, nav: true}, 600: {items: 2, nav: true}, 1000: {items: $('#slider_item').val(), nav: true, loop: ($(".featured-slider-1 .item").length > 4) ? true : false, }}

		});

		/* Featured Carousel 2 */

		$('.featured-slider-5').owlCarousel({

			dots: ($(".featured-slider-5 .item").length > 1) ? false : false,

			loop: ($(".featured-slider-5 .item").length > 1) ? false : false,

			autoplay: true,

			autoplayHoverPause: true,

			autoplayTimeout: parseInt($('#auto_slide_time').val()),

			margin: -10,

			responsiveClass: true,

			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

			responsive: {0: {items: 1, nav: true}, 600: {items: 2, nav: true}, 1000: {items: 3, nav: true, loop: ($(".featured-slider-5 .item").length > 1) ? false : false, }}

		});

		/* Featured  Carousel 3 */

		$('.featured-slider-3').owlCarousel({

			dots: ($(".featured-slider-3 .item").length > 1) ? false : false,

			loop: ($(".featured-slider-3 .item").length > 1) ? true : false,

			autoplay: true,

			autoplayHoverPause: true,

			autoplayTimeout: parseInt($('#auto_slide_time').val()),

			margin: 10,

			responsiveClass: true,

			nav: true,

			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

			responsive: {0: {items: column_count, nav: true}, 600: {items: 2, nav: true}, 1000: {items: 1, nav: true, /*loop:($(".featured-slider-3 .item").length > 1) ? true: false,*/}}

		});

		/* Category Carousel */

		$('.category-slider').owlCarousel({

			loop: true,

			dots: false,

			autoplay: true,

			autoplayHoverPause: true,

			autoplayTimeout: parseInt($('#auto_slide_time').val()),

			margin: 0,

			responsiveClass: true,

			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

			responsive: {0: {items: 1, nav: true}, 600: {items: 2, nav: true}, 1000: {items: 4, nav: true, loop: true}}

		});



		/* Background Image Rotator Carousel */

		$('.background-rotator-slider').owlCarousel({

			loop: false,

			dots: false,

			autoplay: true,

			autoplayHoverPause: true,

			autoplayTimeout: parseInt($('#auto_slide_time').val()),

			margin: 0,

			mouseDrag: true,

			touchDrag: true,

			responsiveClass: true,

			nav: false,

			responsive: {0: {items: 1, }, 600: {items: 1, }, 1000: {items: 1, }}

		});



		/* Single Ad Slider Carousel */

		$('.single-details').owlCarousel({

			dots: ($(".single-details .item").length > 1) ? false : false,

			loop: ($(".single-details .item").length > 1) ? false : false,

			margin: 0,

			autoplay: true,

			autoplayHoverPause: true,

			autoplayTimeout: parseInt($('#auto_slide_time').val()),

			mouseDrag: true,

			touchDrag: true,

			responsiveClass: true,

			nav: true,

			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

			responsive: {0: {items: 1, }, 600: {items: 1, }, 1000: {items: 1, }}

		});



		/* Single Page SLider With Thumb */

		$('#carousels').flexslider({

			animation: "slide",

			controlNav: false,

			animationLoop: false,

			slideshow: false,

			itemWidth: 110,

			itemMargin: 50,

			asNavFor: '.single-page-slider'

		});

		$('.single-page-slider').flexslider({

			animation: "slide",

			controlNav: false,

			animationLoop: false,

			slideshow: true,

			sync: "#carousel"

		});

	}





	if ($('.tophero-slider').length > 0) {

		if ($('#is_rtl').val() !== "" && $('#is_rtl').val() === "1") {

			yes_rtl = true;

		} else {

			yes_rtl = false;

		}

		/* vendor page slider */

		$('.tophero-slider').owlCarousel({

			loop: true,

			dots: false,

			nav: false,

			responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.

			rtl: yes_rtl,

			responsive: {

				0: {

					items: 1,

					nav: true

				},

				600: {

					items: 1,

					nav: true

				},

				1000: {

					items: 1,

					loop: false

				}

			}

		});



	}

	/* vendor page youtube button link on slider */

	$(function () {

		jQuery("a.trust").YouTubePopUp();

		jQuery("a.trust").YouTubePopUp({

			autoplay: 0

		}); // Disable autoplay

	});















	/* Profile Image Upload */

	$(document).on('change', '.btn-file :file', function () {

		var input = $(this), label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

		input.trigger('fileselect', [label]);

	});

	$(document).on('fileselect', '.btn-file :file', function (event, label) {

		var input = $(this).parents('.input-group').find(':text'), log = label;

		if (input.length) {

			input.val(log);

		}

	});

	/* Back To Top */

	var offset = 300,

		offset_opacity = 1200,

		scroll_top_duration = 700,

		$back_to_top = $('.sa_scroll-up');

	var ad_post_btn = $('.sticky-post-button');

	$(window).scroll(function () {



		($(this).scrollTop() > offset) ? ad_post_btn.addClass('sticky-post-button-visible') : ad_post_btn.removeClass('sticky-post-button-visible').removeClass('sticky-post-button-fadeout');

		($(this).scrollTop() > offset) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');

		if ($(this).scrollTop() > offset_opacity) {

			$back_to_top.addClass('cd-fade-out');

			ad_post_btn.addClass('sticky-post-button-fadeout');

		}



		var sb_menu_color = $('#sb_menu_color').val();

		var transparent_flag = false;









		if (header_style_val !== 'undefined' && (header_style_val == 'transparent-2' || header_style_val == 'transparent-3' || header_style_val == 'modern')) {

			transparent_flag = true;

		}

		if (($('#sb_is_homepage').val() == '1' || $('#sb_page_template').val() == 'page-home.php' || $('#sb_page_template').val() == 'single-ad_post.php') && transparent_flag && is_sticky && $('#sb_is_mobile').val() == '2')

		{

			if ($(this).scrollTop() >= 100) {

				$(".mega-menu .menu-links > li > a").css("color", "#000");

			} else {

				$(".mega-menu .menu-links > li > a").css("color", sb_menu_color);

			}

		}



		if ($(this).scrollTop() >= 100 && transparent_flag && is_sticky && $('#sb_is_mobile').val() == '2')

		{

			$('#sb_site_logo').attr('src', $('#sticky_sb_logo').val());

		}

		if ($(this).scrollTop() <= 100 && transparent_flag && is_sticky && $('#sb_is_mobile').val() == '2')

		{

			$('#sb_site_logo').attr('src', $('#static_sb_logo').val());

		}

	});

	/*smooth scroll to top*/

	$back_to_top.on('click', function (event) {

		event.preventDefault();

		$('body,html').animate({scrollTop: 0, }, scroll_top_duration);

	});



	/* Tooltip */

	$('body').on('hover', '[data-toggle="tooltip"]', function ()

				 {

		$('[data-toggle="tooltip"]').tooltip();

		$(this).trigger('hover');

	});

	/* Quick Overview Modal */

	$(".quick-view-modal").css("display", "block");

	/*Validating Registration process*/

	if ($('#sb-sign-form').length > 0)

	{

		$('#sb_register_msg').hide();

		$('#sb_register_redirect').hide();

		$('#sb-sign-form').parsley().on('field:validated', function () {

			var ok = $('.parsley-error').length === 0;

		}).on('form:submit', function () {

			$('#sb_loading').show();

			var google_recaptcha_type = jQuery("#google_recaptcha_type").val();

			google_recaptcha_type = typeof google_recaptcha_type !== 'undefined' ? google_recaptcha_type : 'v2';

			var google_recaptcha_site_key = jQuery("#google_recaptcha_site_key").val();

			if (google_recaptcha_type == 'v3' && google_recaptcha_site_key !== 'undefined' && google_recaptcha_site_key != '') {

				grecaptcha.ready(function () {



					var adforest_ajax_url = jQuery("#adforest_ajax_url").val();

					try {

						grecaptcha.execute(google_recaptcha_site_key, {action: "register_form"}).then(function (token) {

							jQuery("#sb-sign-form").prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');

							jQuery.post(adforest_ajax_url, {action: "sb_goggle_captcha3_verification", token: token}, function (result) {

								result = JSON.parse(result);

								if (result.success) {

									$('#sb_register_submit').hide();

									$('#sb_register_msg').show();

									$.post(adforest_ajax_url, {action: 'sb_register_user', security: $('#sb-register-token').val(), sb_data: $("form#sb-sign-form").serialize(), }).done(function (response)

                                    {

										$('#sb_loading').hide();

										$('#sb_register_msg').hide();

										if ($.trim(response) == '1')

										{

											$('#sb_register_redirect').show();

											window.location = $('#profile_page').val();

										} else if ($.trim(response) == '2')

										{

											$('.resend_email').show();

											toastr.success($('#verify_account_msg').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

										} else

										{

											$('#sb_register_submit').show();

											toastr.error(response, '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

										}

									}).fail(function () {

										$('#sb_loading').hide();

										$('#sb_register_msg').hide();

										$('#sb_register_submit').show();

										toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

									});

								} else {

									$('#sb_loading').hide();

									$('#sb_register_submit').show();

									toastr.error(result.msg, '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

								}

							});

						});

					} catch (err) {

						var google_recaptcha_error_text = jQuery("#google_recaptcha_error_text").val();

						google_recaptcha_error_text = typeof google_recaptcha_error_text !== 'undefined' ? google_recaptcha_error_text : err;

						jQuery('#sb_loading').hide();

						toastr.error(google_recaptcha_error_text, '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					}

				});



			} else {

				$('#sb_register_submit').hide();

				$('#sb_register_msg').show();

				$.post(adforest_ajax_url, {action: 'sb_register_user', security: $('#sb-register-token').val(), sb_data: $("form#sb-sign-form").serialize(), }).done(function (response)

                {

					$('#sb_loading').hide();

					$('#sb_register_msg').hide();

					if ($.trim(response) == '1')

					{

						$('#sb_register_redirect').show();

						window.location = $('#profile_page').val();

					} else if ($.trim(response) == '2')

					{

						$('.resend_email').show();

						toastr.success($('#verify_account_msg').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					} else

					{

						$('#sb_register_submit').show();

						toastr.error(response, '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					}

				}).fail(function () {

					$('#sb_loading').hide();

					$('#sb_register_msg').hide();

					$('#sb_register_submit').show();

					toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				});

			}

			return false;

		});

	}



	// Otp multi form  



	/*

     * Assign role vendor to user on profile page.

     */

	$('#role_as_vendor').on('click', function () {

		var user_id = $('#role_as_vendor').attr("data-user_id");

		var vendor_approve = $('#role_as_vendor').attr('data-vendor_approve');

		$('#sb_loading').show();

		$.post(adforest_ajax_url, {action: 'sb_change_role_user_to_vendor', user_id: user_id, vendor_approve: vendor_approve}).done(function (response) {

			$('#sb_loading').hide();



			window.location.reload();

			toastr.success(response, '', {

				timeOut: 4000,

				"closeButton": true,

				"positionClass": "toast-top-right"

			});

			location.reload();

		});

	});

















	/*Resend Email*/

	$('#resend_email').on('click', function ()

						  {

		var usr_email = $('#sb_reg_email').val();

		$.post(adforest_ajax_url, {action: 'sb_resend_email', usr_email: usr_email, }).done(function (response)

																							{

			toastr.success($('#verify_account_msg').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			$('.resend_email').hide();

			$('.contact_admin').show();

		});

	});



	if ($('#sb-login-form').length > 0)

	{

		$('#sb_login_msg').hide();

		$('#sb_login_redirect').hide();

		$('#sb-login-form').parsley().on('field:validated', function () {

			var ok = $('.parsley-error').length === 0;

		})

			.on('form:submit', function () {

			$('#sb_loading').show();

			$('#sb_login_submit').hide();

			$('#sb_login_msg').show();

			$.post(adforest_ajax_url, {action: 'sb_login_user', security: $('#sb-login-token').val(), sb_data: $("form#sb-login-form").serialize(), }).done(function (response)

                    {



				console.log(response);

				$('#sb_loading').hide();

				$('#sb_login_msg').hide();

				if ($.trim(response) == '1')

				{

					$('#sb_login_redirect').show();

					window.location = $('#profile_page').val();

				} else

				{

					$('#sb_login_submit').show();

					toastr.error(response, '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				}

			}).fail(function () {

				$('#sb_login_submit').show();

				$('#sb_loading').hide();

				$('#sb_login_msg').hide();

				toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			});

			return false;

		});

	}

	/* Forgot Password*/

	if ($('#sb-forgot-form').length > 0)

	{

		$('#sb_forgot_msg').hide();

		$('#sb-forgot-form').parsley().on('field:validated', function () {

			var ok = $('.parsley-error').length === 0;

		}).on('form:submit', function () {

			$('#sb_forgot_submit').hide();

			$('#sb_forgot_msg').show();

			$('#sb_loading').show();

			$.post(adforest_ajax_url, {action: 'sb_forgot_password', security: $('#sb-forgot-pass-token').val(), sb_data: $("form#sb-forgot-form").serialize(), }).done(function (response)

            {

				$('#sb_loading').hide();

				$('#sb_forgot_msg').hide();

				if ($.trim(response) == '1')

				{

					$('#sb_forgot_submit').show();

					$('#sb_forgot_email').val('');

					toastr.success($('#adforest_forgot_msg').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					$('#myModal').modal('hide');

				} else

				{

					$('#sb_forgot_submit').show();

					toastr.error(response, '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				}

			}).fail(function () {

				$('#sb_forgot_submit').show();

				$('#sb_forgot_email').val('');

				toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			});

			return false;

		});

	}

	jQuery(document).ready(function ($) {

		/* Reset Password*/

		if ($('#sb-reset-password-form').length > 0)

		{

			$('#sb_reset_password_modal').modal('show');

			$('#sb_reset_password_msg').hide();

			$('#sb-reset-password-form').parsley().on('field:validated', function () {

				var ok = $('.parsley-error').length === 0;

			}).on('form:submit', function () {

				if ($('#sb_new_password').val() != $('#sb_confirm_new_password').val())

				{

					toastr.error($('#adforest_password_mismatch_msg').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					return false;

				}

				$('#sb_reset_password_submit').hide();

				$('#sb_reset_password_msg').show();

				$('#sb_loading').show();

				$.post(adforest_ajax_url, {action: 'sb_reset_password', security: $('#sb-reset-pass-token').val(), sb_data: $("form#sb-reset-password-form").serialize(), }).done(function (response)

                {

					$('#sb_loading').hide();

					$('#sb_reset_password_msg').hide();



					var get_r = response.split('|');

					if ($.trim(get_r[0]) == '1')

					{

						toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

						$('#sb_reset_password_modal').modal('hide');

						$('#sb_reset_password_submit').show();

						window.location = $('#login_page').val();

					} else

					{

						$('#sb_reset_password_submit').show();

						toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					}

				}).fail(function () {

					$('#sb_loading').hide();

					$('#sb_reset_password_msg').hide();

					$('#sb_reset_password_submit').show();

					toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				});

				return false;

			});

		}

	});

	/* Change Password*/

	$(document).on('click', '#change_pwd', function () {

		$('#sb_loading').show();

		$.post(adforest_ajax_url, {action: 'sb_change_password', security: $('#sb-profile-reset-pass-token').val(), sb_data: $("form#sb-change-password").serialize(), }).done(function (response)

        {

			$('#sb_loading').hide();

			var get_r = response.split('|');

			if ($.trim(get_r[0]) == '1')

			{

				toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				$('#myModal').modal('hide');

				window.location = $('#login_page').val();

			} else

			{

				toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

		}).fail(function () {

			$('#sb_loading').hide();

			toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

		});

	});



	var is_load_required = 0;

	var is_error = false;

	/* Add Post*/

	if ($('#ad_post_form').length > 0)

	{

		$('#ad_cat_sub_div').hide();

		$('#ad_cat_sub_sub_div').hide();

		$('#ad_cat_sub_sub_sub_div').hide();

		$('#ad_country_sub_div').hide();

		$('#ad_country_sub_sub_div').hide();

		$('#ad_country_sub_sub_sub_div').hide();

		if ($('#is_update').val() != "")

		{

			var level = $('#is_level').val();

			if (level >= 2) {

				$('#ad_cat_sub_div').show();

			}

			if (level >= 3) {

				$('#ad_cat_sub_sub_div').show();

			}

			if (level >= 4) {

				$('#ad_cat_sub_sub_sub_div').show();

			}



			var country_level = $('#country_level').val();

			if (country_level >= 2) {

				$('#ad_country_sub_div').show();

			}

			if (country_level >= 3) {

				$('#ad_country_sub_sub_div').show();

			}

			if (country_level >= 4) {

				$('#ad_country_sub_sub_sub_div').show();

			}

		}



		$('#ad_post_form').parsley().on('field:validated', function () {

		}).on('form:error', function () {

			$('.ad_errors').show();

			$('.parsley-errors-list').show();

		}).on('form:submit', function () {

			$('#sb_loading').show();

			$.post(adforest_ajax_url, {action: 'sb_ad_posting', security: $('#sb-post-token').val(), sb_data: $("form#ad_post_form").serialize(), is_update: $('#is_update').val(), }).done(function (response)

            {

				$('#sb_loading').hide();

				if ($.trim(response) == "0")

				{

					toastr.error($('#not_logged_in').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				} else if ($.trim(response) == "1")

				{

					toastr.error($('#ad_limit_msg').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					window.location = $('#sb_packages_page').val();

				} else if ($.trim(response) == "img_req")

				{

					toastr.error($('#required_images').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				} else

				{

					if ($('#is_update').val() != 'undefined' && $('#is_update').val() != '') {

						toastr.success($('#ad_updated').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					} else {

						toastr.success($('#ad_posted').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					}

					window.location = response;

				}

			}).fail(function () {

				$('#sb_loading').hide();

				toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			});

			return false;

		});



		/* grid categories section  javascript */



		// adpotst categories style





		function adforest_save_adpost_cat_val(term_id, term_level) {



			if (term_level == '1') {

				jQuery('#ad_cat').val(term_id);

				jQuery('#ad_cat_sub').val('');

				jQuery('#ad_cat_sub_sub').val('');

				jQuery('#ad_cat_sub_sub_sub').val('');

			} else if (term_level == '2') {

				jQuery('#ad_cat_sub').val(term_id);

			} else if (term_level == '3') {

				jQuery('#ad_cat_sub_sub').val(term_id);

			} else if (term_level == '4') {

				jQuery('#ad_cat_sub_sub_sub').val(term_id);

			}



		}





		jQuery('.sb-adpost-cats ul li a').on('click', function ()

											 {



			var cat_s_id = jQuery(this).attr('data-cat-id');

			var term_level = jQuery(this).attr('data-term-level');

			jQuery('.sb-selected-cats').html('');

			adforest_save_adpost_cat_val(cat_s_id, term_level);



			jQuery(".sb-cat-box").removeClass("sb-cat-active");

			jQuery(this).parent().addClass("sb-cat-active");



			var term_label = jQuery(this).attr('data-term-name');

			if (cat_s_id != "")

			{

				jQuery('#cat_id').val(cat_s_id);

				jQuery('#sb_loading').show();

				jQuery('#cats_response').html('');

				jQuery.post(jQuery('#adforest_ajax_url').val(), {action: 'sb_get_sub_cat_search', cat_id: cat_s_id, type: 'ad_post'}).done(function (response)

																																		   {

					jQuery('#sb_loading').hide();

					jQuery('.sb-selected-cats').css("display", "block");

					jQuery('.sb-selected-cats').append(' <li> ' + term_label + ' </li> ');



					getCustomTemplate(jQuery('#adforest_ajax_url').val(), $("#ad_cat").val(), $("#is_update").val());

					adforest_make_bidding_catbase(jQuery('#adforest_ajax_url').val(), $("#ad_cat").val(), $("#bid_ad_id").val());



					if (jQuery.trim(response) == 'submit')

					{



					} else

					{

						jQuery('#cat_modal').modal('show');

						jQuery('#cats_response').html(response);

					}

				});

			}

		});





		jQuery(document).on('click', '#ajax_cat', function ()

							{

			jQuery('#sb_loading').show();

			var cat_s_id = jQuery(this).attr('data-cat-id');

			var term_level = jQuery(this).attr('data-term-level');







			adforest_save_adpost_cat_val(cat_s_id, term_level);





			var cat_slc_val = $("#ad_cat").val();

			if (term_level == '1') {

				cat_slc_val = jQuery('#ad_cat').val();

			} else if (term_level == '2') {

				cat_slc_val = jQuery('#ad_cat_sub').val();

			} else if (term_level == '3') {

				cat_slc_val = jQuery('#ad_cat_sub_sub').val();

			} else if (term_level == '4') {

				cat_slc_val = jQuery('#ad_cat_sub_sub_sub').val();

			}







			var term_label = jQuery(this).html();

			jQuery('#cat_id').val(cat_s_id);

			jQuery.post(jQuery('#adforest_ajax_url').val(), {action: 'sb_get_sub_cat_search', cat_id: cat_s_id, type: 'ad_post'}).done(function (response)

																																	   {

				jQuery('#sb_loading').hide();

				jQuery('.sb-selected-cats').append(' <li> ' + term_label + ' </li> ');



				getCustomTemplate(jQuery('#adforest_ajax_url').val(), cat_slc_val, $("#is_update").val());

				adforest_make_bidding_catbase(jQuery('#adforest_ajax_url').val(), $("#ad_cat").val(), $("#bid_ad_id").val());



				if (jQuery.trim(response) == 'submit')

				{

					jQuery('#cat_modal').modal('toggle');

				} else

				{

					jQuery('#cat_modal').modal('show');

					jQuery('#cats_response').html(response);

				}

			});

		});











		/* Level 1 */

		$('#ad_cat').on('change', function ()

						{

			if ($("#ad_cat").val())

			{

				$('#sb_loading').show();

				$.post(adforest_ajax_url, {action: 'sb_get_sub_cat', cat_id: $("#ad_cat").val(), }).done(function (response)

																										 {

					$('#sb_loading').hide();

					if ($.trim(response) == 'cat_error') {

						$("#ad_cat").val('');

						$("#select2-ad_cat-container").html($("#select_place_holder").val());

						toastr.error((get_strings.cat_pkg_error), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					} else {

						$("#ad_cat_sub").val('');

						$("#ad_cat_sub_sub").val('');

						$("#ad_cat_sub_sub_sub").val('');

						if ($.trim(response) != "")

						{

							$('#ad_cat_id').val($("#ad_cat").val());

							$('#ad_cat_sub_div').show();

							$('#ad_cat_sub').html(response);

							$('#ad_cat_sub_sub_div').hide();

							$('#ad_cat_sub_sub_sub_div').hide();

						} else

						{

							$('#ad_cat_sub_div').hide();







							$('#ad_cat_sub_sub_div').hide();

							$('#ad_cat_sub_sub_sub_div').hide();

						}

						getCustomTemplate(adforest_ajax_url, $("#ad_cat").val(), $("#is_update").val());

						adforest_make_bidding_catbase(adforest_ajax_url, $("#ad_cat").val(), $("#bid_ad_id").val());

					}

					/*For Category Templates*/

				});

			} else

			{

				$('#ad_cat_sub_div').hide();

				$('#ad_cat_sub_sub_div').hide();

				$('#ad_cat_sub_sub_sub_div').hide();

			}

		});

		/* Level 2 */

		$('#ad_cat_sub').on('change', function ()

							{

			if ($("#ad_cat_sub").val())

			{

				$('#sb_loading').show();

				$.post(adforest_ajax_url, {action: 'sb_get_sub_cat', cat_id: $("#ad_cat_sub").val(), }).done(function (response)

																											 {

					$('#sb_loading').hide();

					if ($.trim(response) == 'cat_error') {

						$("#ad_cat_sub").val('');

						$("#select2-ad_cat_sub-container").html($("#select_place_holder").val());

						toastr.error((get_strings.cat_pkg_error), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					} else {

						$("#ad_cat_sub_sub").val('');

						$("#ad_cat_sub_sub_sub").val('');

						if ($.trim(response) != "")

						{

							$('#ad_cat_id').val($("#ad_cat_sub").val());

							$('#ad_cat_sub_sub_div').show();

							$('#ad_cat_sub_sub').html(response);

							$('#ad_cat_sub_sub_sub_div').hide();

						} else

						{

							$('#ad_cat_sub_sub_div').hide();

							$('#ad_cat_sub_sub_sub_div').hide();

						}

						getCustomTemplate(adforest_ajax_url, $("#ad_cat_sub").val(), $("#is_update").val());

						adforest_make_bidding_catbase(adforest_ajax_url, $("#ad_cat_sub").val(), $("#bid_ad_id").val());

					}

				});

			} else

			{

				$('#ad_cat_sub_sub_div').hide();

				$('#ad_cat_sub_sub_sub_div').hide();

			}

		});

		/* Level 3 */

		$('#ad_cat_sub_sub').on('change', function ()

								{

			if ($("#ad_cat_sub_sub").val())

			{

				$('#sb_loading').show();

				$.post(adforest_ajax_url, {action: 'sb_get_sub_cat', cat_id: $("#ad_cat_sub_sub").val(), }).done(function (response)

																												 {

					$('#sb_loading').hide();

					if ($.trim(response) == 'cat_error') {

						$("#ad_cat_sub_sub").val('');

						$("#select2-ad_cat_sub_sub-container").html($("#select_place_holder").val());

						toastr.error((get_strings.cat_pkg_error), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					} else {

						$("#ad_cat_sub_sub_sub").val('');

						if ($.trim(response) != "")

						{

							$('#ad_cat_id').val($("#ad_cat_sub_sub").val());

							$('#ad_cat_sub_sub_sub_div').show();

							$('#ad_cat_sub_sub_sub').html(response);

						} else

						{

							$('#ad_cat_sub_sub_sub_div').hide();

						}

						getCustomTemplate(adforest_ajax_url, $("#ad_cat_sub_sub").val(), $("#is_update").val());

						adforest_make_bidding_catbase(adforest_ajax_url, $("#ad_cat_sub_sub").val(), $("#bid_ad_id").val());

					}

				});

			} else

			{

				$('#ad_cat_sub_sub_sub_div').hide();

			}

		});

		/* Level 4 */

		$('#ad_cat_sub_sub_sub').on('change', function ()

									{

			$('#sb_loading').show();

			$.post(adforest_ajax_url, {action: 'sb_get_sub_cat', cat_id: $("#ad_cat_sub_sub_sub").val(), }).done(function (response)

																												 {

				$('#sb_loading').hide();

				if ($.trim(response) == 'cat_error') {

					$("#ad_cat_sub_sub_sub").val('');

					$("#select2-ad_cat_sub_sub_sub-container").html($("#select_place_holder").val());

					toastr.error((get_strings.cat_pkg_error), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				} else {

					getCustomTemplate(adforest_ajax_url, $("#ad_cat_sub_sub_sub").val(), $("#is_update").val());

					adforest_make_bidding_catbase(adforest_ajax_url, $("#ad_cat_sub_sub_sub").val(), $("#bid_ad_id").val());

				}

			});

		});

		/*  Countries - Level 1 */

		$('#ad_country').on('change', function ()

							{

			$('#sb_loading').show();

			$.post(adforest_ajax_url, {action: 'sb_get_sub_states', country_id: $("#ad_country").val(), }).done(function (response)

																												{

				$('#sb_loading').hide();

				$("#ad_country_states").val('');

				$("#ad_country_cities").val('');

				$("#ad_country_towns").val('');

				if ($.trim(response) != "")

				{

					$('#ad_country_id').val($("#ad_cat").val());

					$('#ad_country_sub_div').show();

					$('#ad_country_states').html(response);

					$('#ad_country_sub_sub_sub_div').hide();

					$('#ad_country_sub_sub_div').hide();

				} else

				{

					$('#ad_country_sub_div').hide();

					$('#ad_cat_sub_sub_div').hide();

					$('#ad_country_sub_sub_div').hide();

					$('#ad_country_sub_sub_sub_div').hide();

				}

			});

		});

		/* Level 2 */

		$('#ad_country_states').on('change', function ()

								   {

			$('#sb_loading').show();

			$.post(adforest_ajax_url, {action: 'sb_get_sub_states', country_id: $("#ad_country_states").val(), }).done(function (response)

																													   {

				$('#sb_loading').hide();

				$("#ad_country_cities").val('');

				$("#ad_country_towns").val('');

				if ($.trim(response) != "")

				{

					$('#ad_country_id').val($("#ad_country_states").val());

					$('#ad_country_sub_sub_div').show();

					$('#ad_country_cities').html(response);

					$('#ad_country_sub_sub_sub_div').hide();

				} else

				{

					$('#ad_country_sub_sub_div').hide();

					$('#ad_country_sub_sub_sub_div').hide();

				}

			});

		});

		/* Level 3 */

		$('#ad_country_cities').on('change', function ()

								   {

			$('#sb_loading').show();

			$.post(adforest_ajax_url, {action: 'sb_get_sub_states', country_id: $("#ad_country_cities").val(), }).done(function (response)

																													   {

				$('#sb_loading').hide();

				$("#ad_country_towns").val('');

				if ($.trim(response) != "")

				{

					$('#ad_country_id').val($("#ad_country_cities").val());

					$('#ad_country_sub_sub_sub_div').show();

					$('#ad_country_towns').html(response);

				} else

				{

					$('#ad_country_sub_sub_sub_div').hide();

				}

			});

		});

	}

	/*select profile tabs*/

	$(document).on('click', '.messages_actions', function ()

				   {

		var sb_action = $(this).attr('sb_action');

		if (sb_action != "")

		{

			$('#sb_loading').show();

			$.post(adforest_ajax_url, {action: sb_action}).done(function (response)

																{

				$('#sb_loading').hide();

				$('#adforest_res').html(response);



				$('[data-toggle="tooltip"]').tooltip();

				$('[data-toggle=confirmation]').confirmation({rootSelector: '[data-toggle=confirmation]', /*w*/});



				var dd_bottom = $('.list-wraps');

				$(dd_bottom).prop({scrollTop: $(dd_bottom).prop("scrollHeight")});





			});

		}

	});

	$('.menu-name, .profile_tabs').on('click', function ()

									  {

		var sb_action = $(this).attr('sb_action');

		var sb_author = $(this).attr('sb_author');

		if (sb_action != "")

		{

			$('.dashboard-menu-container ul li').removeClass('active');

			$(this).closest("li").addClass('active');

			$('#sb_loading').show();

			$.post(adforest_ajax_url, {action: sb_action, author: sb_author}).done(function (response)

																{

				$('#sb_loading').hide();

				$('#adforest_res').html(response);

				$('[data-toggle="tooltip"]').tooltip();

				if ($('#is_video_on').val() == 1)

				{

					/*Video Popup*/

					$('a.play-video').YouTubePopUp();

					$('a.play-video-new').YouTubePopUp();

				}

				$('[data-toggle=confirmation]').confirmation({rootSelector: '[data-toggle=confirmation]', /*a*/});

				if ($('#is_rtl').val() != "" && $('#is_rtl').val() == "1")

				{

					$('.posts-masonry').imagesLoaded(function () {

						$('.posts-masonry').isotope({layoutMode: 'masonry', transitionDuration: '0.3s', isOriginLeft: false, });

					});

				} else

				{

					$('.posts-masonry').imagesLoaded(function () {

						$('.posts-masonry').isotope({layoutMode: 'masonry', transitionDuration: '0.3s', });

					});

				}

			});

		}

	});

	(function ($) {

		$.sanitize = function (input) {

			var output = input.replace(/<script[^>]*?>.*?<\/script>/gi, '').replace(/<[\/\!]*?[^<>]*?>/gi, '').replace(/<style[^>]*?>.*?<\/style>/gi, '').replace(/<![\s\S]*?--[ \t\n\r]*>/gi, '');

			return output;

		};

	})(jQuery);



	$(document).on('click', '#sb_user_profile_update', function () {

		$('#sb_loading').show();

		$.post(adforest_ajax_url, {action: 'sb_update_profile', security: $('#sb-profile-token').val(), sb_data: $("form#sb_update_profile").serialize(), }).done(function (response)

        {

			$('#sb_loading').hide();

			if ($.trim(response) == '1')

			{

				var sb_user_name = $.sanitize($('input[name=sb_user_name]').val());

				var sb_user_address = $.sanitize($('input[name=sb_user_address]').val());

				var sb_user_type = $.sanitize($('select[name=sb_user_type]').val());

				if (sb_user_name != '') {

					$('.sb_put_user_name').html(sb_user_name);

				}

				if (sb_user_address != '') {

					$('.sb_put_user_address').html(sb_user_address);

				}

				if (sb_user_type != '') {

					$('.sb_user_type').html(sb_user_type);

				}

				toastr.success($('#adforest_profile_msg').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				$('body,html').animate({

					scrollTop: 0,

				}, scroll_top_duration);

			} else

			{

				$('#sb_forgot_submit').show();

				toastr.error(response, '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

		}).fail(function () {

			$('#sb_loading').hide();

			toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

		}

			   );

	});

	/*Upload user profile picture */

	$('body').on('change', '.sb_files-data', function (e) {

		var fd = new FormData();

		var files_data = $('.form-group .sb_files-data');

		$.each($(files_data), function (i, obj) {

			$.each(obj.files, function (j, file) {

				fd.append('my_file_upload[' + j + ']', file);

			});

		});

		fd.append('action', 'upload_user_pic');

		$('#sb_loading').show();

		$.ajax({

			type: 'POST',

			url: adforest_ajax_url,

			data: fd,

			contentType: false,

			processData: false,

			success: function (res) {

				$('#sb_loading').hide();

				var res_arr = res.split("|");

				if ($.trim(res_arr[0]) == "1")

				{

					$('#user_dp').attr('src', res_arr[1]);

					$('#img-upload').attr('src', res_arr[1]);

				} else

				{

					toastr.error(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				}

			}

		});

	});



	if ($('#is_sub_active').val() == "1") { /*images uplaod*/

		sbDropzone_image();

	}

	/*Make Post on blur of title field*/

	$('#ad_title').on('blur', function ()

					  {

		if ($('#is_update').val() == "")

		{

			$.post(adforest_ajax_url, {action: 'post_ad', title: $('#ad_title').val(), is_update: $('#is_update').val(), }).done(function (response) { });

		}

	});

	/*Location while ad posting*/

	$('#sb_user_address').on('focus', function () {

		var map_type = get_strings.adforest_map_type;

		if (map_type == 'google_map') {

			adforest_location();

		}

	});



	if ($('#facebook_key').val() != "" && $('#google_key').val() != "")

	{

		hello.init({facebook: $('#facebook_key').val(), google: $('#google_key').val(), }, {redirect_uri: $('#redirect_uri').val()});

	} else if ($('#facebook_key').val() != "" && $('#google_key').val() == "")

	{

		hello.init({facebook: $('#facebook_key').val(), }, {redirect_uri: $('#redirect_uri').val()});

	} else if ($('#google_key').val() != "" && $('#facebook_key').val() == "")

	{

		hello.init({google: $('#google_key').val(), }, {redirect_uri: $('#redirect_uri').val()});

	}

	$('.form-grid a.btn-social').on('click', function ()

									{

		hello.on('auth.login', function (auth) {

			$('#sb_loading').show();

			hello(auth.network).api('me').then(function (r) {



				if ($('#get_action').val() == 'login' || $('#get_action').val() == 'register')

				{

					var access_token = hello(auth.network).getAuthResponse().access_token;

					var sb_network = hello(auth.network).getAuthResponse().network;







					$.post(adforest_ajax_url, {action: 'sb_social_login', access_token: access_token, sb_network: sb_network, security: $('#sb-social-login-nonce').val(), email: r.email, key_code: $('#nonce').val()}).done(function (response)

                    {

						var get_r = response.split('|');

						if ($.trim(get_r[0]) == '1')

						{

							$('#nonce').val(get_r[1]);

							if ($.trim(get_r[2]) == '1')

							{

								toastr.success(get_r[3], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

								window.location = $('#profile_page').val();

							} else

							{

								toastr.error(get_r[3], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

							}

						} else {

							toastr.error(get_r[3], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

						}

					}).fail(function () {

						$('#sb_loading').hide();

						toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					}

						   );



				} else

				{

					$('#sb_reg_name').val(r.name);

					$('#sb_reg_email').val(r.email);

				}

				$('#sb_loading').hide();

			});

		});

	});



	if ($('#is_sub_active').val() == "1") { /* Tags*/

		adforest_inputTags();

	}

	/* Show Number */

	/* improvement for crawler **/

	$('.sb-click-num').click(function () {

		var ad_id = jQuery(this).data('ad-id');

		var spinner_html = '<span><i class="fa fa-spinner spin"></i></span>';

		jQuery('.sb-phonenumber').html(spinner_html);

		$.post(adforest_ajax_url, {action: 'sb_display_phone_num', ad_id: ad_id}).done(function (response)

																					   {

			var get_r = response.split('|');

			if ($.trim(get_r[0]) == '1')

			{

				jQuery('.sb-phonenumber').html(get_r[1]);

			} else

			{

				toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				jQuery('.sb-phonenumber').html(get_strings.click_to_view);

			}

		});

	});







	/* Show Number */

	/* improvement for crawler **/

	$('.sb-click-num-user').click(function () {

		var user_id = jQuery(this).data('user_id');



		console.log(user_id);

		var spinner_html = '<span><i class="fa fa-spinner spin"></i></span>';

		jQuery('.sb-phonenumber').html(spinner_html);

		$.post(adforest_ajax_url, {action: 'sb_display_phone_num_user', user_id: user_id}).done(function (response)

																								{

			var get_r = response.split('|');

			if ($.trim(get_r[0]) == '1')

			{

				jQuery('.sb-phonenumber').html(get_r[1]);

			} else

			{

				toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				jQuery('.sb-phonenumber').html(get_strings.click_to_view);

			}

		});

	});













	var header = $(".sticky-ad-detail");

	$(window).scroll(function () {

		var scroll = $(window).scrollTop();

		if (scroll >= 500) {

			header.addClass("show-sticky-ad-detail");

		} else {

			header.removeClass("show-sticky-ad-detail");

		}

	});

	/* Ad Location */

	if ($('#lat').length > 0)

	{

		var lat = $('#lat').val();

		var lon = $('#lon').val();

		var map_type = get_strings.adforest_map_type;

		if (map_type == 'leafletjs_map')

		{

			/*For leafletjs map*/

			var map = L.map('itemMap').setView([lat, lon], 7);

			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {attribution: ''}).addTo(map);

			L.marker([lat, lon]).addTo(map);

		} else if (map_type == 'google_map')

		{

			/*For Google Map*/

			var map = "";

			var latlng = new google.maps.LatLng(lat, lon);

			var myOptions = {zoom: 13, center: latlng, scrollwheel: false, mapTypeId: google.maps.MapTypeId.ROADMAP, size: new google.maps.Size(480, 240)}

			map = new google.maps.Map(document.getElementById("itemMap"), myOptions);

			var marker = new google.maps.Marker({

				map: map,

				position: latlng

			});

		}

	}

	/*Report Ad*/

	$('#sb_mark_it').on('click', function ()

						{

		$('#sb_loading').show();

		$.post(adforest_ajax_url, {action: 'sb_report_ad', option: $('#report_option').val(), comments: $('#report_comments').val(), ad_id: $('#ad_id').val(), }).done(function (response)

        {

			$('#sb_loading').hide();

			var get_r = response.split('|');

			if ($.trim(get_r[0]) == '1')

			{

				toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				$('.report-quote').modal('hide');

			} else

			{

				toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

		});

	});

	/*Add to favourites*/

	$("body").on("click", "#ad_to_fav,.save-ad", function()
	//$('#ad_to_fav,.save-ad').on('click', function ()

								{

		var $this = $(this);

		$('#sb_loading').show();

		$.post(adforest_ajax_url, {action: 'sb_fav_ad', ad_id: $(this).attr('data-adid'), }).done(function (response)

																								  {

			$('#sb_loading').hide();

			var get_p = response.split('|');

			if ($.trim(get_p[0]) == '1')

			{

				$this.parent().addClass("ad-favourited");

				toastr.success(get_p[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			} else

			{

				toastr.error(get_p[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

		});

	});









	/* ======================

     * Product favourites/un-favourites shop layout 5

     ========================*/

	$('.product_to_fav').on('click', function () {

		$(this).toggleClass("favourited");

		var status_class = $(this).hasClass("favourited");

		var status_code;

		if (status_class == true) {

			status_code = "true";

		} else {

			status_code = "false";

		}

		$('#sb_loading').show();

		$.post(adforest_ajax_url, {

			action: 'product_fav_add',

			product_id: $(this).attr('data-productId'),

			status_code: status_code,

		}).done(function (response) {

			$('#sb_loading').hide();

			var get_p = response.split('|');

			if ($.trim(get_p[0]) == 1) {

				toastr.success(get_p[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			} else if ($.trim(get_p[0]) == 0) {

				toastr.error(get_p[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

		});



	});































	/* ======================

     * vendor favourites/un-favourites

     ========================*/

	$('.vendor_to_fav').on('click', function () {

		$(this).toggleClass("favourited_v");

		var status_class = $(this).hasClass("favourited_v");

		var status_code;

		if (status_class == true) {

			status_code = "true";

		} else {

			status_code = "false";

		}

		$('#sb_loading').show();

		$.post(adforest_ajax_url, {

			action: 'vendor_fav_ad',

			vendor_id: $(this).attr('data-vendorid'),

			status_code: status_code,

		}).done(function (response) {

			$('#sb_loading').hide();

			var get_p = response.split('|');

			if ($.trim(get_p[0]) == 1) {

				$this.parent().addClass("ad-favourited");

				toastr.success(get_p[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			} else if ($.trim(get_p[0]) == 0) {

				toastr.error(get_p[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

		});

	});







	/* Contact to Vendor on Vendor detail Page. */

	if ($('#vendro-owner-contact').length > 0) {

		$('#vendro-owner-contact').parsley().on('field:validated', function () {

			var ok = $('.parsley-error').length === 0;

		}).on('form:submit', function () {

			var adforest_ajax_url = jQuery("#adforest_ajax_url").val();

			$('#sb_loading').show();

			$.post(adforest_ajax_url, {

				action: 'sb_send_email_to_store_vendor',

				sb_data: $("form.vendro-owner-contact").serialize(),

				vendor_id: $('#vendor_id').val(),

			}).done(function (response) {

				$('#sb_loading').hide();

				var res_arr = response.split("|");



				if ($.trim(res_arr[0]) != "0") {

					toastr.success(res_arr[1], '', {

						timeOut: 4000,

						"closeButton": true,

						"positionClass": "toast-top-right"

					});

				} else {

					toastr.error(res_arr[1], '', {

						timeOut: 4000,

						"closeButton": true,

						"positionClass": "toast-top-right"

					});

				}

			});

			return false;

		});

	}





	/* *********************

     * vendor favourites end

     ************************ */











	/*Delete  Ad*/

	$('body').on('hover', '.remove_fav_ad', function (e) {

		$(this).confirmation({rootSelector: '[data-toggle=confirmation]', /*other options*/});

	});

	/*Remove to favourites*/

	$('body').on('click', '.remove_fav_ad', function (e)

				 {

		var id = $(this).attr('data-adid');

		$.post(adforest_ajax_url, {action: 'sb_fav_remove_ad', ad_id: $(this).attr('data-adid'), }).done(function (response)

																										 {

			var get_r = response.split('|');

			if ($.trim(get_r[0]) == '1')

			{

				$('body').find('#holder-' + id).remove();

				toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			} else

			{

				toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

		});

	});







	if ($('#file_attacher').length > 0) {





		adforest_ajax_url = adforest_ajax_url ;

		var attachmentsDropzone = new Dropzone(document.getElementById('file_attacher'), {// Make the whole body a dropzone

			url: adforest_ajax_url,

			autoProcessQueue: true,

			previewsContainer: "#attachment-wrapper", // Define the container to display the previews

			previewTemplate: '<span class="dz-preview dz-file-preview"><span class="dz-details"><span class="dz-filename"><i class="fa fa-link"></i>&nbsp;&nbsp;&nbsp;<span data-dz-name></span></span>&nbsp;&nbsp;&nbsp;<span class="dz-size" data-dz-size></span>&nbsp;&nbsp;&nbsp;<i class="fa fa-times" style="cursor:pointer;font-size:15px;" data-dz-remove></i></span><span class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></span><i class="ti ti-refresh ti-spin"></i></span>',

			clickable: "a.msgAttachFile",

			acceptedFiles: $('#provided_format').val(),

			maxFilesize: 15,

			maxFiles: 4

		});





		attachmentsDropzone.on("sending", function () {

			$("#send_msg ,#send_ad_message").attr("disabled", true);

		});

		attachmentsDropzone.on("queuecomplete", function () {

			$("#send_msg, #send_ad_message").attr("disabled", false);

		});



	}



	/*Send message to ad owner*/

	if ($('#send_message_pop').length > 0)

	{

		$('#send_message_pop').parsley().on('field:validated', function () { }).on('form:submit', function () {
			$('#sb_loading').show();

			var fd = new FormData();



			if ($('#file_attacher').length > 0) {

				var fileUpload = $('#file_attacher').get(0).dropzone;



				var files = fileUpload.files;



				// Looping over all files and add it to FormData object  

				for (var i = 0; i < files.length; i++) {

					fd.append("message_file[]", files[i]);

				}



			}

			var sb_data = $("form#send_message_pop").serialize()

			var security = $('#sb-msg-token').val();





			fd.append('action', 'sb_send_message');

			fd.append('sb_data', sb_data);

			fd.append('security', security)

			$('#sb_loading').show();

			$.ajax({

				type: 'POST',

				url: adforest_ajax_url,

				data: fd,

				contentType: false,

				processData: false,

				success: function (response) {

					$('#sb_loading').hide();

					var get_r = response.split('|');

					if ($.trim(get_r[0]) == "1")

					{

						toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

						$('#sb_forest_message').val('');



						if ($('.dz-preview').length > 0) {

							Dropzone.forElement('#file_attacher').removeAllFiles(true);

							$('.dz-preview').remove();

							$('.dz-success').fadeOut('slow');

						}

						$(".close").trigger("click");

					} else

					{

						toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

						$(".close").trigger("click");

					}

				},

				error: function () {

					$('#sb_loading').hide();

					toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				}

			});



			return false;

		});

	}



	$('body').on('click', '.user_list', function ()

				 {



		$('#sb_loading').show();

		$('.message-history-active').removeClass('message-history-active');

		$(this).addClass('message-history-active');

		var second_user = $(this).attr('second_user');

		var inbox = $(this).attr('inbox');

		var msg_token = $(this).attr('sb_msg_token');

		var prnt = 'no';

		if (inbox == 'yes') {

			prnt = 'yes';

		}





		$('.block_user').hide();

		$('.unblock_user').hide();

		$('.block-to-' + second_user).show();

		$('.hide_receiver').hide();





		var cid = $(this).attr('cid');

		$('#' + second_user + '_' + cid).html('');



		$.post(adforest_ajax_url, {action: 'sb_get_messages', security: msg_token, ad_id: cid, user_id: second_user, receiver: second_user, inbox: prnt}).done(function (response)

        {

			$('#usr_id').val(second_user);

			$('#rece_id').val(second_user);

			$('#msg_receiver_id').val(second_user);

			$('#ad_post_id').val(cid)

			$('#sb_loading').hide();



			$('#messages').html(response);



			var dd_bottom = $('.list-wraps');



			$(dd_bottom).prop({scrollTop: $('.messages').prop("scrollHeight") - 590});





		}).fail(function () {

			$('#sb_loading').hide();

			$('#messages').html($('#_nonce_error').val());

		});

	});



	$('body').on('click', '#send_msg', function ()

				 {

		$('#send_message').parsley().on('field:validated', function () {

		}).on('form:submit', function () {



			var inbox = $('#send_msg').attr('inbox');

			var sb_msg_token = $('#send_msg').attr('sb_msg_token');

			var prnt = 'no';

			if (inbox == 'yes') {

				prnt = 'yes';

			}

			var fd = new FormData();

			if ($('#file_attacher').length > 0) {

				var fileUpload = $('#file_attacher').get(0).dropzone;

				var files = fileUpload.files;



				// Looping over all files and add it to FormData object  

				for (var i = 0; i < files.length; i++) {

					fd.append("message_file[]", files[i]);

				}

			}

			var sb_data = $("form#send_message").serialize()

			fd.append('action', 'sb_send_message');

			fd.append('sb_data', sb_data);

			fd.append('security', sb_msg_token)

			$('#sb_loading').show();

			$.ajax({

				type: 'POST',

				url: adforest_ajax_url,

				data: fd,

				contentType: false,

				processData: false,

				success: function (response) {

					console.log(response);

					$('#sb_loading').hide();

					var get_r = response.split('|');

					if ($.trim(get_r[0]) == '1')

					{

						toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

						$('#sb_forest_message').val('');

						if ($('.dz-preview').length > 0) {

							$('.dz-preview').remove();

							Dropzone.forElement('#file_attacher').removeAllFiles(true);

						}

						$.post(adforest_ajax_url, {action: 'sb_get_messages', security: sb_msg_token, ad_id: $("#ad_post_id").val(), user_id: $('#usr_id').val(), inbox: prnt}).done(function (response)

                        {

							var get_r = response.split('|');

							if (typeof response !== undefined && $.trim(get_r[0]) == '0') {

								$('#sb_loading').hide();

								toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

							} else {

								$('#sb_loading').hide();

								$('#messages').html(response);

								$('.message-details .list-wraps').scrollTop(20000).perfectScrollbar('update');

							}

						});

					} else

					{

						toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

						$(".close").trigger("click");

					}

				},



				error: function () {

					$('#sb_loading').hide();

					toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				}

			});

			return false;



		});

	});













	/*Delete  Ad*/

	$('body').on('hover', '.remove_ad', function (e) {

		$(this).confirmation({rootSelector: '[data-toggle=confirmation]', /*other options*/});

	});

	/*Delete  Ad*/

	$('body').on('click', '.remove_ad', function (e)

				 {

		$(this).confirmation({rootSelector: '[data-toggle=confirmation]', /*other options*/});

		$('#sb_loading').show();

		var id = $(this).attr('data-adid');

		$.post(adforest_ajax_url, {action: 'sb_remove_ad', ad_id: $(this).attr('data-adid'), }).done(function (response)

																									 {

			$('#sb_loading').hide();

			var get_r = response.split('|');

			if ($.trim(get_r[0]) == '1')

			{

				$('body').find('#holder-' + id).remove();

				toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			} else

			{

				toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

		});

	});







	/* change tab color change in shop5 */

	$(".wcmpv-new-arrival .nav-item").click(function () {

		$(".wcmpv-new-arrival .nav-item").removeClass("active").addClass("");

		$(this).removeClass("active").addClass("active");

	});



	/* My ads pagination */

	$('body').on('click', '.sb_page', function ()

				 {

		$('#sb_loading').show();

		var this_action = 'my_ads';

		if ($(this).attr('ad_type') == 'yes')

		{

			this_action = 'my_fav_ads';

		} else if ($(this).attr('ad_type') == 'inactive')

		{

			this_action = 'my_inactive_ads';

		} else if ($(this).attr('ad_type') == 'rejected')

		{

			this_action = 'my_rejected_ads';

		} else if ($(this).attr('ad_type') == 'expired_sold')

		{

			this_action = 'my_expire_sold_ads';

		} else if ($(this).attr('ad_type') == 'featured_ads')

		{

			this_action = 'my_feature_ads';

		}

		$.post(adforest_ajax_url, {action: this_action, paged: $(this).attr('page_no'), }).done(function (response)

																								{

			$('#sb_loading').hide();

			$('#adforest_res').html(response);

			event.preventDefault();

			$('body,html').animate({

				scrollTop: 200,

			}, scroll_top_duration);

			if ($('#is_rtl').val() != "" && $('#is_rtl').val() == "1")

			{

				$('.posts-masonry').imagesLoaded(function () {

					$('.posts-masonry').isotope({layoutMode: 'masonry', transitionDuration: '0.3s', isOriginLeft: false, });

				});

			} else

			{

				$('.posts-masonry').imagesLoaded(function () {

					$('.posts-masonry').isotope({layoutMode: 'masonry', transitionDuration: '0.3s', });

				});

			}

		});

	});

	/*Load Messages*/

	$('body').on('click', '.get_msgs', function ()

				 {

		$('#sb_loading').show();

		$.post(adforest_ajax_url, {action: 'sb_load_messages', ad_id: $(this).attr('ad_msg'), }).done(function (response)

																									  {

			$('#sb_loading').hide();



			$('#adforest_res').html(response);



			if ($('#file_attacher').length > 0) {





				adforest_ajax_url = adforest_ajax_url;

				var attachmentsDropzone = new Dropzone(document.getElementById('file_attacher'), {

					url: adforest_ajax_url,

					autoProcessQueue: true,

					previewsContainer: "#attachment-wrapper",

					previewTemplate: '<span class="dz-preview dz-file-preview"><span class="dz-details"><span class="dz-filename"><i class="fa fa-link"></i>&nbsp;&nbsp;&nbsp;<span data-dz-name></span></span>&nbsp;&nbsp;&nbsp;<span class="dz-size" data-dz-size></span>&nbsp;&nbsp;&nbsp;<i class="fa fa-times" style="cursor:pointer;font-size:15px;" data-dz-remove></i></span><span class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></span><i class="ti ti-refresh ti-spin"></i></span>',

					clickable: "a.msgAttachFile",

					acceptedFiles: $('#provided_format').val(),

					maxFilesize: 15,

					maxFiles: 4

				});



				attachmentsDropzone.on("sending", function () {

					console.log("eeeee");

					$("#send_msg ,#send_ad_message").attr("disabled", true);

				});

				attachmentsDropzone.on("queuecomplete", function () {

					$("#send_msg, #send_ad_message").attr("disabled", false);

				});







			}





			var dd_bottom = $('.list-wraps');

			$(dd_bottom).prop({scrollTop: $(dd_bottom).prop("scrollHeight")});





		});

	});

	var previous;

	/*My ads pagination*/

	$('body').on('focus', '.ad_status', function ()

				 {

		previous = this.value;

	}).on('change', '.ad_status', function ()

		  {

		if ($(this).val() != "")

		{



			var $this = $(this);

			var status_val = $this.val();

			var status_text = $(this).children("option:selected").text();



			var bg_color_status = '#4caf50';

			if (status_val == 'active') {

				bg_color_status = '#4caf50';

			} else if (status_val == 'sold') {

				bg_color_status = '#3498db';

			} else if (status_val == 'expired') {

				bg_color_status = '#d9534f';

			}

			if (confirm($('#confirm_update').val()))

			{

				$('#sb_loading').show();

				$.post(adforest_ajax_url, {action: 'sb_update_ad_status', ad_id: $(this).attr('adid'), status: $(this).val(), }).done(function (response)

																																	  {

					$('#sb_loading').hide();

					var get_r = response.split('|');

					if ($.trim(get_r[0]) == '1')

					{

						toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

						previous = this.value;

						jQuery('#status-dyn-' + $this.attr('adid') + '').css({"background-color": bg_color_status, "text-transform": "capitalize"});

						jQuery('#status-dyn-' + $this.attr('adid') + '').html(status_text);

					} else

					{

						toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					}

				});

			} else

			{

				$(this).val(previous)

			}

		}

	});

	/* Add to Cart*/

	$('body').on('click', '.sb_add_cart', function ()

				 {

		$('#sb_loading').show();

		$.post(adforest_ajax_url, {action: 'sb_add_cart', product_id: $(this).attr('data-product-id'), qty: $(this).attr('data-product-qty'), }).done(function (response) {

			$('#sb_loading').hide();

			var get_r = response.split('|');

			if ($.trim(get_r[0]) == '1')

			{

				toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				window.location = get_r[2];

			} else

			{

				toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				window.location = get_r[2];

			}

		});

	});


	/* Notification Read */

	$('body').on('click', '.noti_read_btn', function (e){
		$('#sb_loading').show();

		var $this = $(this);
		var id = $(this).attr('data-id');

		$.post(adforest_ajax_url, {action: 'sb_read_notification', noti_id: id, status: "read"}).done(function (response){
			$('#sb_loading').hide();
			var get_r = response.split('|');
			if ($.trim(get_r[0]) == '1')
			{
				$this.parent().parent().removeClass("active");
				$this.parent().find(".noti_read_btn").addClass("hide");
				$this.parent().find(".noti_unread_btn").removeClass("hide");
				toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});
			} else
			{
				toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});
			}
		});
	});

	$('body').on('click', '.noti_unread_btn', function (e){
		$('#sb_loading').show();

		var $this = $(this);
		var id = $(this).attr('data-id');

		$.post(adforest_ajax_url, {action: 'sb_read_notification', noti_id: id, status: "unread"}).done(function (response){
			$('#sb_loading').hide();
			var get_r = response.split('|');
			if ($.trim(get_r[0]) == '1')
			{
				$this.parent().parent().addClass("active");
				$this.parent().find(".noti_read_btn").removeClass("hide");
				$this.parent().find(".noti_unread_btn").addClass("hide");
				toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});
			} else
			{
				toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});
			}
		});
	});

	$('body').on('click', '.noti_del_btn', function (e){
		$('#sb_loading').show();

		var $this = $(this);
		var id = $(this).attr('data-id');

		$.post(adforest_ajax_url, {action: 'sb_read_notification', noti_id: id, status: "delete"}).done(function (response){
			$('#sb_loading').hide();
			var get_r = response.split('|');
			if ($.trim(get_r[0]) == '1')
			{
				$this.parent().parent().remove();
				toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});
			} else
			{
				toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});
			}
		});
	});


	if ($('#is_sub_active').val() == "1") {

		$('[data-toggle=confirmation]').confirmation({rootSelector: '[data-toggle=confirmation]', });

	}



	var ad_html_switch = $('#adforest_ad_html').val();

	ad_html_switch = typeof ad_html_switch !== 'undefined' && ad_html_switch == '1' ? true : false;

	if ($('#ad_description').length > 0)

	{

		if (ad_html_switch) {

			$('#ad_description').jqte({color: false});

		} else {

			$('#ad_description').jqte({link: false, unlink: false, formats: false, format: false, funit: false, fsize: false, fsizes: false, color: false, strike: false, source: false, sub: false, sup: false, indent: false, outdent: false, right: true, left: true, center: true, remove: false, rule: false, title: false, });

		}

	}

	$('#sb_feature_ad').on('click', function ()

						   {

		$('#sb_loading').show();

		$.post(adforest_ajax_url, {action: 'sb_make_featured', ad_id: $(this).attr('aaa_id'), }).done(function (response)

																									  {

			$('#sb_loading').hide();

			var get_r = response.split('|');

			if ($.trim(get_r[0]) == '1')

			{

				toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				location.reload();

			} else

			{

				toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

		});

	});

	$(document).on('click', '.sb_make_feature_ad', function ()

				   {

		$('#sb_loading').show();

		$.post(adforest_ajax_url, {action: 'sb_make_featured', ad_id: $(this).attr('data-aaa-id'), }).done(function (response)

																										   {

			$('#sb_loading').hide();

			var get_r = response.split('|');

			if ($.trim(get_r[0]) == '1')

			{

				toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			} else

			{

				toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

		});

	});

	$(document).on('click', '.bump_it_up', function ()

				   {

		$('#sb_loading').show();

		$.post(adforest_ajax_url, {action: 'sb_bump_it_up', ad_id: $(this).attr('data-aaa-id'), }).done(function (response)

																										{

			$('#sb_loading').hide();

			var get_r = response.split('|');

			if ($.trim(get_r[0]) == '1')

			{

				toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			} else

			{

				toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

		});

	});

	$(document).on('click', '.delete_site_user', function ()

				   {

		$('#sb_loading').show();

		$.post(adforest_ajax_url, {action: 'delete_site_user_func', del_user_id: $(this).attr('data-user-id'), }).done(function (response)

																													   {

			$('#sb_loading').hide();

			var get_r = response.split('|');

			if ($.trim(get_r[0]) == '1')

			{

				toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				location.reload();

			} else

			{

				toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

		});

	});

	$(document).on('click', '.ad_title_show', function ()

				   {

		var cur_ad_id = $(this).attr('cid');

		$('.sb_ad_title').hide();

		$('#title_for_' + cur_ad_id).show();

	});

	if ($('#msg_notification_on').val() != "" && $('#msg_notification_on').val() != 0 && $('#msg_notification_time').val() != "")

	{

		if ($('#is_logged_in').val() == '1')

		{

			setInterval(function ()

						{

				$.post(adforest_ajax_url, {action: 'sb_check_messages', new_msgs: $('#is_unread_msgs').val(), }).done(function (response)

																													  {



					var get_r = response.split('|');

					if ($.trim(get_r[0]) == '1')

					{

						toastr.success(get_r[1], '', {timeOut: 5000, "closeButton": true, "positionClass": "toast-bottom-left"});

						$('#is_unread_msgs').val(get_r[2]);

						$('.msgs_count').html(get_r[2]);

						$('.notify').html('<span class="heartbit"></span><span class="point"></span>');

						$.post(adforest_ajax_url, {action: 'sb_get_notifications'}).done(function (notifications) {

							$('.message-center').html(notifications);

						});

					}

				});

			}, $('#msg_notification_time').val());

		}

	}

	if ($('#is_logged_in').val() == "1" && ($('#browser_notif_message_on').val() == "1" || $('#browser_notif_heats_on').val() == "1") && $('#msg_notification_time').val() != ""){
		setInterval(function (){
			$.post(adforest_ajax_url, {action: 'sb_check_notification'}).done(function (response){
				var get_r = response.split('|');
				if ($.trim(get_r[0]) == '1'){
					var count = get_r[1];
					var title = document.title;
					var newTitle = "";
					var title_tmp = title.trim().split(" ");
					if(title_tmp[0].trim() == "You" && title_tmp[1].trim() == "have" && title_tmp[3].trim() == "new" && title_tmp[4].trim() == "notifications"){
						if(count == 0){
							title_tmp[0] = "";
							title_tmp[1] = "";
							title_tmp[2] = "";
							title_tmp[3] = "";
							title_tmp[4] = "";
						}else{
							title_tmp[2] = count;
						}
						newTitle = title_tmp.join(" ");
					}else if(count > 0){
						newTitle = 'You have ' + count + ' new notifications ' + title;
					}else{
						newTitle = title;
					}
					document.title = newTitle.trim();
				}
			});
		}, $('#msg_notification_time').val());
	}

	function adforest_inputTags()

	{

		var total_tags = $("#tags_count").val();

		if (typeof total_tags === 'undefined' || total_tags == '') {

			total_tags = 0;

		}

		if ($('#tags').length !== 'undefined' && $('#tags').length > 0) {

			$('#tags').tagsInput({

				'width': '100%',

				'height': '5px;',

				'defaultText': '',

				onAddTag: function (elem, elem_tags) {

					total_tags = parseInt(total_tags) + 1;

					if (total_tags > get_strings.adforest_tags_limit_val) {

						alert(get_strings.adforest_tags_limit);

						$(this).removeTag(elem);

					}

					if ($.sanitize(elem) == '') {

						$(this).removeTag(elem);

					}

				},

				onRemoveTag: function () {

					total_tags = parseInt(total_tags) - 1;

				}

			});

		}

		if ($("#is_update").val() == "" && $('.dynamic-form-date-fields').length > 0) {

			$('.dynamic-form-date-fields').datepicker({

				timepicker: false,

				dateFormat: 'yyyy-mm-dd',

				language: {

					days: [get_strings.Sunday, get_strings.Monday, get_strings.Tuesday, get_strings.Wednesday, get_strings.Thursday, get_strings.Friday, get_strings.Saturday],

					daysShort: [get_strings.Sun, get_strings.Mon, get_strings.Tue, get_strings.Wed, get_strings.Thu, get_strings.Fri, get_strings.Sat],

					daysMin: [get_strings.Su, get_strings.Mo, get_strings.Tu, get_strings.We, get_strings.Th, get_strings.Fr, get_strings.Sa],

					months: [get_strings.January, get_strings.February, get_strings.March, get_strings.April, get_strings.May, get_strings.June, get_strings.July, get_strings.August, get_strings.September, get_strings.October, get_strings.November, get_strings.December],

					monthsShort: [get_strings.Jan, get_strings.Feb, get_strings.Mar, get_strings.Apr, get_strings.May, get_strings.Jun, get_strings.Jul, get_strings.Aug, get_strings.Sep, get_strings.Oct, get_strings.Nov, get_strings.Dec],

					today: get_strings.Today,

					clear: get_strings.Clear,

					dateFormat: 'mm/dd/yyyy',

				},

			});

		}

	}



	/*

     * product search

     * on keypress multivendor

     */

	if (jQuery('input[name=s]').length > 0) {

		jQuery('input[name=s]').keypress(function () {

			var spinner_html_ = '<span class="adforest-search-spinner"><i class="fa fa-spinner spin"></i></span>';

			if (jQuery(this).after(spinner_html_)) {

				jQuery('.adforest-search-spinner').remove();

			}

			jQuery(this).after(spinner_html_);

		});

	}

	$('input[name=s]').typeahead({

		minLength: 1,

		delay: 250,

		scrollBar: true,

		autoSelect: true,

		fitToElement: true,

		highlight: false,

		hint: true,

		source: function (query, process) {

			return $.get(ajax_url, {query: query, action: 'product_suggestions'}, function (data) {

				jQuery('.adforest-search-spinner').remove();

				data = $.parseJSON(data);

				return process(data);

			});

		}

	});





	function adforest_remove_query_param(url, parameter) {

		var urlparts = url.split('?');

		if (urlparts.length >= 2) {

			var prefix = encodeURIComponent(parameter) + '=';

			var pars = urlparts[1].split(/[&;]/g);

			for (var i = pars.length; i-- > 0; ) {

				//idiom for string.startsWith

				if (pars[i].lastIndexOf(prefix, 0) !== -1) {

					pars.splice(i, 1);

				}

			}

			return urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');

		}

		return url;

	}

	function sbDropzone_image()

	{

		if ($('#dropzone').length) {

			Dropzone.autoDiscover = false;

			var images_ajax_callback = adforest_ajax_url + "?action=upload_ad_images&is_update=" + $('#is_update').val();

			if (adforest_ajax_url.indexOf('?lang=') !== -1) {

				images_ajax_callback = adforest_ajax_url + "&action=upload_ad_images&is_update=" + $('#is_update').val();

			}

			var fileList = new Array;

			var acceptedFileTypes = "image/jpeg,image/png,image/jpg";

			var i = 0;

			var sb_max_files = typeof $('#sb_upload_limit').val() !== 'undefined' && $('#sb_upload_limit').val() == 'null' ? null : $('#sb_upload_limit').val();

			$("#dropzone").dropzone({

				timeout: 5000000,

				maxFilesize: 50000000,

				addRemoveLinks: true,

				paramName: "my_file_upload",

				maxFiles: sb_max_files, //change limit as per your requirements

				acceptedFiles: acceptedFileTypes,

				dictMaxFilesExceeded: $('#adforest_max_upload_reach').val(),

				url: images_ajax_callback,

				parallelUploads: 1,

				dictDefaultMessage: $('#dictDefaultMessage').val(),

				dictFallbackMessage: $('#dictFallbackMessage').val(),

				dictFallbackText: $('#dictFallbackText').val(),

				dictFileTooBig: $('#dictFileTooBig').val(),

				dictInvalidFileType: $('#dictInvalidFileType').val(),

				dictResponseError: $('#dictResponseError').val(),

				dictCancelUpload: $('#dictCancelUpload').val(),

				dictCancelUploadConfirmation: $('#dictCancelUploadConfirmation').val(),

				dictRemoveFile: $('#dictRemoveFile').val(),

				dictRemoveFileConfirmation: null,

				init: function () {

					var thisDropzone = this;

					$.post(adforest_ajax_url, {action: 'get_uploaded_ad_images', is_update: $('#is_update').val()}).done(function (data)

																														 {

						if (typeof data !== 'undefined' && data != 0) {

							$.each(data, function (key, value) {

								var mockFile = {name: value.dispaly_name, size: value.size};

								thisDropzone.options.addedfile.call(thisDropzone, mockFile);

								thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.name);

								$('a.dz-remove:eq(' + i + ')').attr("data-dz-remove", value.id);

								i++;

								$(".dz-progress").remove();

							});

						}

						if (i > 0)

							$('.dz-message').hide();

						else

							$('.dz-message').show();

					});



					this.on("addedfile", function (file) {

						$('.dz-message').hide();



					});

					this.on("success", function (file, responseText) {



						var res_arr = responseText.split("|");

						if ($.trim(res_arr[0]) != "0")

						{

							$('a.dz-remove:eq(' + i + ')').attr("data-dz-remove", responseText);

							i++;

							$('.dz-message').hide();

						} else

						{

							if (i == 0)

								$('.dz-message').show();

							this.removeFile(file);

							toastr.error(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

						}

					});

					this.on("removedfile", function (file) {

						var img_id = file._removeLink.attributes[2].value;

						if (img_id != "")

						{

							i--;

							if (i == 0)

								$('.dz-message').show();

							$.post(adforest_ajax_url, {action: 'delete_ad_image', img: img_id, is_update: $('#is_update').val(), }).done(function (response)

																																		 {

								if ($.trim(response) == "1") { /*this.removeFile(file);*/

								}

							});

						}

					});

					this.on("maxfilesexceeded", function (file) {

						alert(get_strings.max_upload_images);

						this.removeFile(file);

					});





				},

			});

		}

	}

	/* Rate User */

	if ($('#user_ratting_form').length > 0)

	{

		$('#user_ratting_form').parsley().on('field:validated', function () {

			var ok = $('.parsley-error').length === 0;

		}).on('form:submit', function () {

			// Ajax for Registration

			$('#sb_loading').show();

			$.post(adforest_ajax_url, {action: 'sb_post_user_ratting', security: $('#sb-user-rating-token').val(), sb_data: $("form#user_ratting_form").serialize(), }).done(function (response)

            {

				$('#sb_loading').hide();

				var res_arr = response.split("|");

				if ($.trim(res_arr[0]) != "0")

				{

					toastr.success(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					location.reload();

				} else

				{

					toastr.error(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				}

			}).fail(function () {

				$('#sb_loading').hide();

				toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

				   );

			return false;

		});

	}

	/* Replay to Rator */

	if ($('#sb-reply-rating-form').length > 0)

	{

		$('#sb-reply-rating-form').parsley().on('field:validated', function () {

			var ok = $('.parsley-error').length === 0;

		}).on('form:submit', function () {

			$('#sb_loading').show();

			$.post(adforest_ajax_url, {action: 'sb_reply_user_rating', security: $('#sb-user-rate-reply-token').val(), sb_data: $("form#sb-reply-rating-form").serialize(), }).done(function (response)

            {

				$('#sb_loading').hide();

				var res_arr = response.split("|");

				if ($.trim(res_arr[0]) != "0")

				{

					toastr.success(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					location.reload();

				} else

				{

					toastr.error(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				}

			}).fail(function () {

				$('#sb_loading').hide();

				toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

				   );

			return false;

		});

	}

	$('.clikc_reply').on('click', function ()

						 {

		$('#rator_name').html($(this).attr('data-rator-name'));

		$('#rator_reply').val($(this).attr('data-rator-id'));

	});

	/* Bidding System  */

	if ($('#sb_bid_ad').length > 0)

	{

		$('#sb_bid_ad').parsley().on('field:validated', function () {

			var ok = $('.parsley-error').length === 0;

		}).on('form:submit', function () {

			$('#sb_loading').show();

			$.post(adforest_ajax_url, {action: 'sb_submit_bid', security: $('#sb-bidding-token').val(), sb_data: $("form#sb_bid_ad").serialize(), }).done(function (response)

            {

				$('#sb_loading').hide();

				var res_arr = response.split("|");

				if ($.trim(res_arr[0]) != "0")

				{

					toastr.success(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					location.reload();

				} else

				{

					toastr.error(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				}

			}).fail(function () {

				$('#sb_loading').hide();

				toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

				   );

			return false;

		});

	}

	var $scrollbar = $('.bidding');

	$scrollbar.perfectScrollbar({maxScrollbarLength: 150, });

	$scrollbar.perfectScrollbar('update');

	$('form.custom-search-form select').on("select2:select", function (e) {

		$('#sb_loading').show();

		$(this).closest("form").submit();

	});

	function getCustomTemplate(ajax_url, catId, updateId)

	{

		/*For Category Templates*/

		$('#sb_loading').hide();

		$.post(ajax_url, {action: 'sb_get_sub_template', 'cat_id': catId, 'is_update': updateId, }).done(function (response)

																										 {

			$('#sb_loading').hide();

			if ($.trim(response) != "")

			{

				$("#dynamic-fields").html(response);

				$('#dynamic-fields select').select2();

				sbDropzone_image();

				adforest_inputTags();

			}

			if ($('#theme_type').val() == 1 && updateId == "") {

			}

		});

		/*For Category Templates*/

	}

	function adforest_make_bidding_catbase(ajax_url, catId, bid_ad_id) {

		/*For Category Templates*/

		$('#sb_loading').hide();

		bid_ad_id = typeof bid_ad_id !== 'undefined' && bid_ad_id != '' ? bid_ad_id : '';

		$.post(ajax_url, {action: 'sb_display_bidding_section', 'cat_id': catId, 'bid_ad_id': bid_ad_id}).done(function (response)

																											   {

			$('#sb_loading').hide();

			if (response == '1') {

				$('.bidding-content').show();

			} else {

				$('.bidding-content').hide();

			}

		});

		/*For Category Templates*/

	}

	$(document).on('change', '#ad_price_type', function ()

				   {

		if (this.value == "on_call" || this.value == "free" || this.value == "no_price")

		{

			$('#ad_price').attr("data-parsley-required", "false");

			$('#ad_currency').attr("data-parsley-required", "false");

			$('#ad_price').val('');

			$('#ad_price').parent('div').hide();

			$('#ad_currency').parent('div').hide();

		} else

		{

			$('#ad_price').attr("data-parsley-required", "true");

			$('#ad_currency').attr("data-parsley-required", "true");

			$('#ad_price').parent('div').show();

			$('#ad_currency').parent('div').show();

		}

	});

	if ($('#is_video_on').val() == 1)

	{

		$("a.play-video").YouTubePopUp();

		$("a.play-video-new").YouTubePopUp();

	}

	$('a.page-scroll').on('click', function (event) {

		var $anchor = $(this);

		$('html, body').stop().animate({scrollTop: $($anchor.attr('href')).offset().top - 60}, 1500, 'easeInOutExpo');

		event.preventDefault();

	});



	$('select.submit_on_select').on("select2:select", function (e) {

		$('#sb_loading').show();

		$(this).closest("form").submit();

	});

	$('.fa_cursor').on("click", function (e) {

		$('#sb_loading').show();

		$(this).closest("form").submit();

	});

	$('.submit_on_select').on('click', function () {

		$('#sb_loading').show();

		$(this).closest("form").submit();

	});



	if ($("#sortable").length > 0)

	{

		$("#sortable").sortable({

			stop: function (event, ui) {

				$('#post_img_ids').val('');

				var current_img = '';

				$(".ui-state-default img").each(function (index) {

					current_img = current_img + $(this).attr('data-img-id') + ",";

				});

				$('#post_img_ids').val(current_img.replace(/,\s*$/, ""));

			}

		});

		$("#sortable").disableSelection();

	}

	$('#sb_sort_images').on('click', function ()

							{

		$('#sb_loading').show();

		$.post(adforest_ajax_url, {action: 'sb_sort_images', ids: $('#post_img_ids').val(), ad_id: $('#current_pid').val(), }).done(function (response)

																																	{

			toastr.success($('#re-arrange-msg').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			location.reload();

			$('#sb_loading').hide();

		});

	});

	var $scrollbar = $('.rating_comments');

	$scrollbar.perfectScrollbar({maxScrollbarLength: 150, });

	$scrollbar.perfectScrollbar('update');

	/*Phone verification logic*/

	$(document).on('click', '#sb_verification_ph,#resend_now', function ()

				   {

		var ph_number = $('#sb_ph_number').val();

		$('#sb_verification_ph_code').hide();

		$('#sb_verification_ph').hide();

		$('#sb_verification_ph_back').show();

		$.post(adforest_ajax_url, {action: 'sb_verification_system', sb_phone_numer: ph_number, }).done(function (response)

																										{

			var res_arr = response.split("|");

			if ($.trim(res_arr[0]) != "0")

			{

				$('#sb_verification_ph_back').hide();

				$('.sb_ver_ph_div').hide();

				$('.sb_ver_ph_code_div').show();

				$('#sb_verification_ph_code').show();

				toastr.success(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			} else

			{

				$('#sb_verification_ph').show();

				$('#sb_verification_ph_back').hide();

				toastr.error(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

		});

	});

	$(document).on('click', '#sb_verification_ph_code', function ()

				   {

		var ph_code = $('#sb_ph_number_code').val();

		$('#sb_verification_ph_code').hide();

		$('#sb_verification_ph_back').show();

		$.post(adforest_ajax_url, {action: 'sb_verification_code', sb_code: ph_code, }).done(function (response)

																							 {

			var res_arr = response.split("|");

			if ($.trim(res_arr[0]) != "0")

			{

				toastr.success(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				location.reload();

			} else

			{

				$('#sb_verification_ph_code').show();

				$('#sb_verification_ph_back').hide();

				toastr.error(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			}

		});

	});

	/* Ad rating Logic */

	if ($('#ad_rating_form').length > 0)

	{

		$('#ad_rating_form').parsley().on('field:validated', function () {

		}).on('form:submit', function () {

			$('#sb_loading').show();

			$.post(adforest_ajax_url, {action: 'sb_ad_rating', security: $('#sb-review-token').val(), sb_data: $("form#ad_rating_form").serialize(), }).done(function (response)

            {

				$('#sb_loading').hide();

				var get_r = response.split('|');

				if ($.trim(get_r[0]) == '1')

				{

					toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					location.reload();

				} else

				{

					toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				}

			}).fail(function () {

				$('#sb_loading').hide();

				toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			});

			return false;

		});

	}

	/*Send message to ad owner*/

	if ($('#rating_reply_form').length > 0)

	{

		$('#rating_reply_form').parsley().on('field:validated', function () {

		}).on('form:submit', function () {

			$('#sb_loading').show();

			$.post(adforest_ajax_url, {action: 'sb_ad_rating_reply', security: $('#sb-review-reply-token').val(), sb_data: $("form#rating_reply_form").serialize(), }).done(function (response)

            {

				$('#sb_loading').hide();

				var get_r = response.split('|');

				if ($.trim(get_r[0]) == '1')

				{

					toastr.success(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					location.reload();

				} else

				{

					toastr.error(get_r[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

				}

			}).fail(function () {



				$('#sb_loading').hide();

				toastr.error($('#_nonce_error').val(), '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

			});

			return false;

		});

	}

	$('.reply_ad_rating').on('click', function ()

							 {

		var p_comment_id = $(this).attr('data-comment_id');

		$('#reply_to_rating').html($(this).attr('data-commenter-name'));

		$('#parent_comment_id').val(p_comment_id);

	});

	$("#you_current_location_text").click(function () {

		$('#sb_loading').show();

		$.ajax({

			url: "https://geolocation-db.com/jsonp",

			jsonpCallback: "callback",

			dataType: "jsonp",

			success: function (location) {

				$('#sb_loading').hide();

				$('#sb-radius-form #sb_user_address').val(location.city + ", " + location.state + ", " + location.country_name);

				var map_type = get_strings.adforest_map_type;

				if (map_type == 'leafletjs_map')

				{

					$('#sb_user_address_lat').val(location.latitude);

					$('#sb_user_address_long').val(location.longitude);

				}

			}

		});

	});



	/* Detrmine Theme RTL OR NOT*/

	var ajax_url = $("input#adforest_ajax_url").val();

	var yes_rtl;

	if ($('#is_rtl').val() !== "" && $('#is_rtl').val() === "1") {

		yes_rtl = true;

	} else {

		yes_rtl = false;

	}

	/*Shop Settings Starts*/

	if ($('.produt-slider').length) {

		$('.produt-slider').owlCarousel({nav: true, rtl: yes_rtl, navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"], animateOut: 'fadeOut', animateIn: 'fadeIn', items: 1, });

	}



	if ($('.related-produt-slider').length) {

		$('.related-produt-slider').owlCarousel({

			nav: true,

			rtl: yes_rtl,

			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

			animateOut: 'fadeOut',

			animateIn: 'fadeIn',

			responsive: {0: {items: 1, autoplay: false, }, 600: {items: 3, margin: 10, }, 1000: {items: 4, margin: 10, }, 1025: {items: 4, margin: 10, }},

			dots: false,

			autoplay: true,

			autoplayTimeout: 2500,

			autoplayHoverPause: true,

		});

	}





	/* Contact from profile  */

	if ($('#user_contact_form').length > 0)

	{

		$('#user_contact_form').parsley().on('field:validated', function () {

			var ok = $('.parsley-error').length === 0;

		}).on('form:submit', function () {

			//$('#sb_loading').show();

			var google_recaptcha_type = jQuery("#google_recaptcha_type").val();

			google_recaptcha_type = typeof google_recaptcha_type !== 'undefined' ? google_recaptcha_type : 'v2';

			var google_recaptcha_site_key = jQuery("#google_recaptcha_site_key").val();

			if (google_recaptcha_type == 'v3' && google_recaptcha_site_key !== 'undefined' && google_recaptcha_site_key != '') {

				grecaptcha.ready(function () {

					try {

						var adforest_ajax_url = jQuery("#adforest_ajax_url").val();

						grecaptcha.execute(google_recaptcha_site_key, {action: "contact_form"}).then(function (token) {

							jQuery("#user_contact_form").prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');

							jQuery.post(adforest_ajax_url, {

								action: "sb_goggle_captcha3_verification",

								token: token,

							}, function (result) {

								result = JSON.parse(result);

								if (result.success) {

									$.post(adforest_ajax_url, {action: 'sb_user_contact_form', receiver_id: $('#receiver_id').val(), sb_data: $("form#user_contact_form").serialize(), }).done(function (response)

                                    {

										$('#sb_loading').hide();

										var res_arr = response.split("|");

										if ($.trim(res_arr[0]) != "0")

										{

											toastr.success(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

										} else

										{

											toastr.error(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

										}

									});

								} else {

									$('#sb_loading').hide();

									$('#sb_register_submit').show();

									toastr.error(result.msg, '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

								}

							});

						});

					} catch (err) {

						var google_recaptcha_error_text = jQuery("#google_recaptcha_error_text").val();

						google_recaptcha_error_text = typeof google_recaptcha_error_text !== 'undefined' ? google_recaptcha_error_text : err;

						jQuery('#sb_loading').hide();

						toastr.error(google_recaptcha_error_text, '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					}

				});

			} else {

				$.post(adforest_ajax_url, {action: 'sb_user_contact_form', receiver_id: $('#receiver_id').val(), sb_data: $("form#user_contact_form").serialize(), }).done(function (response)

                {

					$('#sb_loading').hide();

					var res_arr = response.split("|");

					if ($.trim(res_arr[0]) != "0")

					{

						toastr.success(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					} else

					{

						toastr.error(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					}

				});

			}

			return false;

		});

	}





	if ($('.send-message-to-author').length > 0)

	{

		$('.send-message-to-author').parsley().on('field:validated', function () {

			var ok = $('.parsley-error').length === 0;

		}).on('form:submit', function () {

			$('#sb_loading').show();

			var google_recaptcha_type = jQuery("#google_recaptcha_type").val();

			google_recaptcha_type = typeof google_recaptcha_type !== 'undefined' ? google_recaptcha_type : 'v2';

			var google_recaptcha_site_key = jQuery("#google_recaptcha_site_key").val();

			if (google_recaptcha_type == 'v3' && google_recaptcha_site_key !== 'undefined' && google_recaptcha_site_key != '') {

				grecaptcha.ready(function () {

					try {

						var adforest_ajax_url = jQuery("#adforest_ajax_url").val();

						grecaptcha.execute(google_recaptcha_site_key, {action: "contact_form"}).then(function (token) {

							jQuery("#user_contact_form").prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');

							jQuery.post(adforest_ajax_url, {

								action: "sb_goggle_captcha3_verification",

								token: token,

							}, function (result) {

								result = JSON.parse(result);

								if (result.success) {

									$.post(adforest_ajax_url, {action: 'sb_send_message_to_author', ad_id: $('#ad_id').val(), sb_data: $("form.send-message-to-author").serialize(), }).done(function (response)

                                    {

										$('#sb_loading').hide();

										var res_arr = response.split("|");

										if ($.trim(res_arr[0]) != "0")

										{

											toastr.success(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

										} else

										{

											toastr.error(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

										}

									});

								} else {

									$('#sb_loading').hide();

									$('#sb_register_submit').show();

									toastr.error(result.msg, '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

								}

							});

						});

					} catch (err) {

						var google_recaptcha_error_text = jQuery("#google_recaptcha_error_text").val();

						google_recaptcha_error_text = typeof google_recaptcha_error_text !== 'undefined' ? google_recaptcha_error_text : err;

						jQuery('#sb_loading').hide();

						toastr.error(google_recaptcha_error_text, '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					}

				});

			} else {

				$.post(adforest_ajax_url, {action: 'sb_send_message_to_author', ad_id: $('#ad_id').val(), sb_data: $("form.send-message-to-author").serialize(), }).done(function (response)

                {

					$('#sb_loading').hide();

					var res_arr = response.split("|");

					if ($.trim(res_arr[0]) != "0")

					{

						toastr.success(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					} else

					{

						toastr.error(res_arr[1], '', {timeOut: 4000, "closeButton": true, "positionClass": "toast-top-right"});

					}

				});

			}

			return false;

		});

	}







	if ($('.dynamic-form-date-fields').length > 0) {

		jQuery('.dynamic-form-date-fields').datepicker({

			timepicker: false,

			dateFormat: 'yyyy-mm-dd',

			language: {

				days: [get_strings.Sunday, get_strings.Monday, get_strings.Tuesday, get_strings.Wednesday, get_strings.Thursday, get_strings.Friday, get_strings.Saturday],

				daysShort: [get_strings.Sun, get_strings.Mon, get_strings.Tue, get_strings.Wed, get_strings.Thu, get_strings.Fri, get_strings.Sat],

				daysMin: [get_strings.Su, get_strings.Mo, get_strings.Tu, get_strings.We, get_strings.Th, get_strings.Fr, get_strings.Sa],

				months: [get_strings.January, get_strings.February, get_strings.March, get_strings.April, get_strings.May, get_strings.June, get_strings.July, get_strings.August, get_strings.September, get_strings.October, get_strings.November, get_strings.December],

				monthsShort: [get_strings.Jan, get_strings.Feb, get_strings.Mar, get_strings.Apr, get_strings.May, get_strings.Jun, get_strings.Jul, get_strings.Aug, get_strings.Sep, get_strings.Oct, get_strings.Nov, get_strings.Dec],

				today: get_strings.Today,

				clear: get_strings.Clear,

				dateFormat: 'mm/dd/yyyy',

			},

		});

	}

	if (jQuery('input[name=ad_title]').length > 0) {

		jQuery('input[name=ad_title]').keypress(function () {

			var spinner_html = '<span class="adforest-search-spinner"><i class="fa fa-spinner spin"></i></span>';

			if (jQuery(this).after(spinner_html)) {

				jQuery('.adforest-search-spinner').remove();

			}

			jQuery(this).after(spinner_html);

		});

	}



	$('input[name=ad_title]').typeahead({

		minLength: 1,

		delay: 250,

		scrollBar: true,

		autoSelect: true,

		fitToElement: true,

		highlight: false,

		hint: true,

		source: function (query, process) {

			return $.get(ajax_url, {query: query, action: 'fetch_suggestions'}, function (data) {

				jQuery('.adforest-search-spinner').remove();

				data = $.parseJSON(data);

				return process(data);

			});

		}

	});

	/*Resend Email*/

	$('.ads-with-sidebar-section a.ajax-anchor').on('click', function ()

													{

		var cat_id = $(this).data('sidebar-term-id');

		var unique_id = $(this).data('unique-id');

		$(".ads-sidebar-loader").show();

		$('#sb_loading').show();

		var no_of_ads = $("#no_of_ads_" + unique_id).val();

		var layout_type = $("#layout_type_" + unique_id).val();

		var ad_order = $("#ad_order_" + unique_id).val();

		var ad_type = $("#ad_type_" + unique_id).val();

		var cat_link_page = $("#cat_link_page_" + unique_id).val();

		var wpnonce = $("#ads_with_sidebar_ajax_" + unique_id).val();

		var view_all = $("#view_all_" + unique_id).val();

		$("#ads-with-sidebar-section-" + unique_id).html('');

		$.post(adforest_ajax_url, {action: 'get_ads_with_sidebar_section', cat_id: cat_id, unique_id: unique_id, no_of_ads: no_of_ads, layout_type: layout_type, ad_order: ad_order, ad_type: ad_type, cat_link_page: cat_link_page, view_all: view_all, wpnonce: wpnonce}).done(function (response)

        {

			$("#ads-with-sidebar-section-" + unique_id).html(response);

			adforest_timerCounter_function();

			$(".ads-sidebar-loader").hide();

			$('#sb_loading').hide();

		});

	});

	/*More Js Added On Descmber 5*/

	var site_rtl = $("#is_rtl").val();

	if (site_rtl == 1)

	{

		var is_site_rtl = true;

		var navTextAngle = ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"];

	} else

	{

		var is_site_rtl = false;

		var navTextAngle = ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"];

	}

	$('.recent-ad-slider').owlCarousel({

		rtl: is_site_rtl,

		loop: true,

		margin: 10,

		nav: true,

		autoplay: true,

		responsive: {0: {items: 1}, 600: {items: 3}, 1000: {items: 1}}

	});



	$(".hammi-slider").owlCarousel({

		rtl: is_site_rtl,

		loop: true,

		dots: false,

		responsiveClass: true,

		navText: navTextAngle,

		nav: true,

		autoplay: true,

		autoplayTimeout: 10000,

		autoplaySpeed: 2000,

		autoplayHoverPause: true,

		responsive: {0: {items: 3, }, 600: {items: 3, }, 1000: {items: 6, }}

	});

	$('.success-stories-2').owlCarousel({

		rtl: is_site_rtl,

		loop: true,

		margin: 10,

		navText: navTextAngle,

		nav: true,

		smartSpeed: 600,

		autoplay: true,

		responsive: {0: {items: 1}, 600: {items: 3, }, 1000: {items: 1, }}

	});



	function toggleIcon(e) {

		$(e.target).prev('.panel-heading').find(".more-less").toggleClass('glyphicon-plus glyphicon-minus');

	}

	$('.panel-group').on('hidden.bs.collapse', toggleIcon);

	$('.panel-group').on('shown.bs.collapse', toggleIcon);





	$('.landing-page-slider-1').owlCarousel({

		rtl: is_site_rtl,

		loop: true,

		margin: 10,

		nav: true,

		autoplay: true,

		responsive: {0: {items: 1}, 600: {items: 3}, 1000: {items: 1}}

	});

	$('.land-one-slider-2').owlCarousel({

		rtl: is_site_rtl,

		loop: true,

		margin: 10,

		autoplay: true,

		smartSpeed: 700,

		nav: true,

		responsive: {0: {items: 1}, 600: {items: 3}, 1000: {items: 1}}

	});

	$('.apps-shots-slider').owlCarousel({

		rtl: is_site_rtl,

		loop: true,

		smartSpeed: 700,

		nav: true,

		responsive: {0: {items: 1}, 600: {items: 3}, 1000: {items: 4}}

	});



	$('.app-shots-carousal').owlCarousel({

		autoplayHoverPause: true,

		rtl: is_site_rtl,

		loop: true,

		margin: 20,

		dots: false,

		autoplay: false,

		responsiveClass: true,

		navText: navTextAngle,

		nav: true,

		center: true,

		responsive: {0: {items: 1, }, 600: {items: 3, }, 1000: {items: 5, }}

	});





	/* Contact number validation */

	$(document).ready(function () {

		$('[id^=adforest_contact_number]').keypress(validateNumber);

	});



	function validateNumber(event) {

		var key = window.event ? event.keyCode : event.which;

		if (event.keyCode === 8 || event.keyCode === 46) {

			return true;

		} else if (event.keyCode == 43) {

			return true;

		} else if (key < 48 || key > 57) {

			return false;

		} else {

			return true;

		}

	}



	$(".menu-mobile-collapse-trigger").on("click", function () {

		$(".menu-links").toggleClass("menu-work");



	});

	$(document).ready(function () {

		$('[data-toggle="popover"]').popover({

			html: true,

			content: function (e) {

				console.log(e);

				return $('.category_package_list').html();

			}

		});



		if ($('#imageGallery').length > 0) {

			$('#imageGallery').lightSlider({

				gallery: true,

				item: 1,

				rtl: slider_rtl,

				loop: true,

				currentPagerPosition: 'middle',

				margin: 0,

				thumbItem: 4,

				slideMargin: 0,

				enableDrag: false,

				responsive: [],

				onSliderLoad: function (el) { }

			});

		}

	});

	/*More Js Added On Descmber 5*/

	$(".mobile-filters-btn a, a.filter-close-btn").on("click", function () {

		$('.mobile-filters').toggleClass("active");

	});

	/*Scroll to top when arrow up clicked BEGIN*/

	$(window).scroll(function () {

		var height = $(window).scrollTop();

		if (height > 120) {

			/*$('.mobile-filters-btn a').fadeOut();*/

		} else {

			$('.mobile-filters-btn a').fadeIn();

		}

	});

	$(document).ready(function () {

		$(".mobile-filters-btn a").click(function (event) {

			event.preventDefault();

			$("html, body").animate({scrollTop: 0}, "slow");

			return false;

		});

	});

	/*Scroll to top when arrow up clicked END*/







	/* message attachment fancy box*/











})(jQuery);



jQuery(document).ready(function ($) {

	$("#ad_price_type").trigger("change");

	$('[data-toggle="tooltip"]').tooltip();

	if ($('#input-21b').length > 0)

	{

		var star_rtl = false;

		if ($('#is_rtl').val() != "" && $('#is_rtl').val() == "1") {

			star_rtl = true;

		}

		$('#input-21b').rating({starCaptions: {1: get_strings.one, 2: get_strings.two, 3: get_strings.three, 4: get_strings.four, 5: get_strings.five}});

	}









	$('#user_order_by').on('change', function () {



		$(this).closest("form").submit();

	});



	if ($('.sb_rating_input').length > 0)

	{

		var star_rtl = false;

		if ($('#is_rtl').val() != "" && $('#is_rtl').val() == "1") {

			star_rtl = true;

		}

		$('.sb_rating_input').rating({showCaption: false, starCaptions: {1: get_strings.one, 2: get_strings.two, 3: get_strings.three, 4: get_strings.four, 5: get_strings.five}});



		$('.user_ratting_input  .glyphicon-star').on('click', function (event) {



			setTimeout(function () {

				$('#user_search_rating').submit();





			},

					   1000);

			jQuery('#sb_loading').show();





		});

	}



	$(".jqte_editor").on("paste", function (e)

						 {

		e.preventDefault();

		var text = e.originalEvent.clipboardData.getData('text');

		document.execCommand("insertText", false, text);

	});

});



function adforest_validateEmail(sEmail)

{

	var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

	if (filter.test(sEmail)) {

		return true;

	} else {

		return false;

	}

}

function adforest_select_msg(cid, second_user, prnt, msg_token)

{

	jQuery('.message-history-active').removeClass('message-history-active');

	jQuery(document).find('#' + second_user + '_' + cid).html('');

	jQuery(document).find('#sb_' + second_user + '_' + cid).addClass('message-history-active');

	jQuery('#sb_loading').show();

	jQuery.post(jQuery('#adforest_ajax_url').val(), {action: 'sb_get_messages', security: msg_token, ad_id: cid, user_id: second_user, receiver: second_user, inbox: prnt}).done(function (response)

    {

		jQuery('#usr_id').val(second_user);

		jQuery('#rece_id').val(second_user);

		jQuery('#msg_receiver_id').val(second_user);

		jQuery('#ad_post_id').val(cid)

		jQuery('#sb_loading').hide();

		jQuery('#messages').html(response);

	}).fail(function () {

		$('#sb_loading').hide();

		jQuery('#messages').html($('#_nonce_error').val());

	});



}

adforest_timerCounter_function();

/* slider js for adforest app homepage */

if (jQuery('.mobile-hero').length > 0) {

	jQuery('.mobile-hero').owlCarousel({

		loop: true,

		margin: 10,

		dots: false,

		center: true,

		rtl: slider_rtl,

		smartSpeed: 750,

		autoplay: false,

		responsive: {0: {items: 1}, 768: {items: 1, stagePadding: 200, }}

	});

}



if (jQuery('.newest').length > 0) {

	jQuery('.newest').owlCarousel({

		loop: true,

		margin: 10,

		dots: false,

		rtl: slider_rtl,

		responsive: {0: {items: 1}, 600: {items: 3}, 1000: {items: 4, }}});

}

function adforest_disableEmptyInputs(form) {

	var controls = form.elements;

	for (var i = 0, iLen = controls.length; i < iLen; i++) {

		controls[i].disabled = controls[i].value == "";

	}

}



if (jQuery('.toys-new-accessories').length > 0) {

	jQuery('.toys-new-accessories').owlCarousel({

		loop: true,

		margin: 10,

		nav: true,

		rtl: slider_rtl,

		smartSpeed: 550,

		autoplay: true,

		dots: true,

		navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

		responsive: {0: {items: 1, }, 600: {items: 2, }, 768: {items: 1, }, 1000: {items: 1, }}

	});

}



if (jQuery('.dec-location').length > 0) {

	jQuery('.dec-location').owlCarousel({

		loop: true,

		margin: 15,

		dots: false,

		rtl: slider_rtl,

		autoplay: true,

		responsiveClass: true,

		navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

		nav: true,

		responsive: {0: {items: 1, }, 600: {items: 3, }, 1000: {items: 3, }

					}

	});

}



if (jQuery('.dec-latest-products-s').length > 0) {

	jQuery('.dec-latest-products-s').owlCarousel({

		loop: true,

		margin: 10,

		nav: true,

		rtl: slider_rtl,

		smartSpeed: 550,

		autoplay: false,

		//dots: false,

		navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

		responsive: {0: {items: 1, }, 600: {items: 4, }, 768: {items: 6, }, 1000: {items: 6, }}

	});

}

(function ($) {

	/* Emoji Reaction Against Reviews  */

	$(".Emoji").on("click", function ()

				   {

		var reaction_id = $(this).data("reaction");

		var c_id = $(this).data("cid");

		$("#reaction-loader-" + c_id).show();

		$.post(jQuery('#adforest_ajax_url').val(), {action: 'adforest_ads_rating_reaction', r_id: reaction_id, c_id: c_id}).done(function (response)

																																 {

			$("#reaction-loader-" + c_id).hide();



			var get_r = response.split('|');

			if ($.trim(get_r[0]) == '0')

			{

				alert($.trim(get_r[1]));

				return false;

			} else

			{

				if (reaction_id === 1) {

					$('.emoji-count.likes-' + c_id).text(response);

				}

				if (reaction_id === 2)

				{

					$('.emoji-count.loves-' + c_id).text(response)

				}

				if (reaction_id === 3) {

					$('.emoji-count.wows-' + c_id).text(response);

				}

				if (reaction_id === 4) {

					$('.emoji-count.angrys-' + c_id).text(response);

				}

			}

		});

		return false;

	});



	if ($('.ad-grid-slider').length > 0) {

		$('.ad-grid-slider').owlCarousel({

			loop: false,

			margin: 20,

			autoplay: false,

			nav: true,

			rtl: slider_rtl,

			margin: -10,

			dots: false,

			rtl: slider_rtl,

			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],

			responsive: {0: {items: 1}, 600: {items: 2}, 1000: {items: 4}}

		});

	}



	if (jQuery('.mega-menu .menu-links li.hoverTrigger .drop-down.grid-col-12').length > 0) {

		var hee = jQuery('.mega-menu .menu-links li.hoverTrigger .drop-down.grid-col-12').height();

		if (hee !== 'undefined' && hee == 350) {

			const pc = new PerfectScrollbar(".drop-down.grid-col-12.effect-expand-top");

		}

	}

})(jQuery);



jQuery(document).ready(function () {



	if (jQuery('.ad-allbids').length > 0) {

		const ps = new PerfectScrollbar(".ad-allbids");

	}



	if (jQuery('.sb-top-loc').length > 0) {

		const pc = new PerfectScrollbar(".sb-top-loc");

	}



	var sb_lang_code = jQuery('#sb-lang-code').val();







	var lang_cd = jQuery('#sb-lang-code').val();

	lang_cd = lang_cd.toString(2);



	if (jQuery('#is_single_ad').val() == '1') {

		jQuery('[data-fancybox]').fancybox({

			lang: 'lang_cd',

			i18n: {

				'lang_cd': {

					CLOSE: get_strings.CLOSE,

					NEXT: get_strings.NEXT,

					PREV: get_strings.PREV,

					ERROR: get_strings.ERROR,

					PLAY_START: get_strings.PLAY_START,

					PLAY_STOP: get_strings.PLAY_STOP,

					FULL_SCREEN: get_strings.FULL_SCREEN,

					THUMBS: get_strings.THUMBS,

					DOWNLOAD: get_strings.DOWNLOAD,

					SHARE: get_strings.SHARE,

					ZOOM: get_strings.ZOOM,



				}

			}

		});







	}



});





jQuery(function ($) {

	$("p:empty").remove();

	/* show vendor phone number on click*/

	// Make the code work after page load.

	$(document).ready(function () {

		QuantityChange();

	});



	// Make the code work after executing AJAX.

	$(document).ajaxComplete(function () {

		QuantityChange();

	});



	function QuantityChange() {

		$(document).off("click", ".qib-button").on("click", ".qib-button", function () {

			// Find quantity input field corresponding to increment button clicked.

			var qty = $(this).siblings(".quantity").find(".qty");

			// Read value and attributes min, max, step.

			var val = parseFloat(qty.val());

			var max = parseFloat(qty.attr("max"));

			var min = parseFloat(qty.attr("min"));

			var step = parseFloat(qty.attr("step"));



			// Change input field value if result is in min and max range.

			// If the result is above max then change to max and alert user about exceeding max stock.

			// If the field is empty, fill with min for "-" (0 possible) and step for "+".

			if ($(this).is(".plus")) {

				if (val === max)

					return false;

				if (isNaN(val)) {

					qty.val(step);

					return false;

				}

				if (val + step > max) {

					qty.val(max);

				} else {

					qty.val(val + step);

				}

			} else {

				if (val === min)

					return false;

				if (isNaN(val)) {

					qty.val(min);

					return false;

				}

				if (val - step < min) {

					qty.val(min);

				} else {

					qty.val(val - step);

				}

			}



			qty.val(Math.round(qty.val() * 100) / 100);

			qty.trigger("change");

			$("body").removeClass("sf-input-focused");

		});

	}



});













/* Custom Js */

jQuery(function ($) {





	const footer_height = $('.sa_footer').find('footer').height();

	const navbar_height = $('.sa_footer').find('.sa_footer-head').height();

	$('.sa_footer').css('bottom', '-' + ( footer_height + navbar_height) + 'px');

	$('button.sa_footer-toggle').on('click', function(e) {

		e.preventDefault();

		if ($('.sa_footer').hasClass('active')) {

			$('.sa_footer').removeClass('active');

			$('.sa_footer').css('bottom', '-'+footer_height + 'px');

			$(this).find('i').toggleClass('fa-arrow-down fa-arrow-up');

		} else {

			$('.sa_footer').addClass('active');

			$('.sa_footer').css('bottom', '0px');

			$(this).find('i').toggleClass('fa-arrow-down fa-arrow-up');

		}

	});



	//Functions

	/**

 * Set Cooke Method

 * @param {*} name 

 * @param {*} value 

 * @param {*} days 

 */

	const setCookie = (name, value, days) => {

		var expires = "";

		if (days) {

			var date = new Date();

			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));

			expires = "; expires=" + date.toUTCString();

		}

		document.cookie = name + "=" + (value || "") + expires + "; path=/";

	}



	/**

 * Get Cookie Method

 * @param {*} name 

 * @returns 

 */

	const getCookie = name => {

		var nameEQ = name + "=";

		var ca = document.cookie.split(';');

		for (var i = 0; i < ca.length; i++) {

			var c = ca[i];

			while (c.charAt(0) === ' ') c = c.substring(1, c.length);

			if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);

		}

		return null;

	}



	/**

 * remove Cookie Method

 * @param {*} name 

 */

	const removeCookie = (name) => {

		document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';

	}



	//copy text

	function copyToClipboard(text) {

		var $temp = $("<input>");

		$("body").append($temp);

		$temp.val(text).select();

		document.execCommand("copy");

		$temp.remove();

	}



	// Events

	/* submenu Toggle */

	$('li.post-submenu > a').on('click', function(e) { 

		e.preventDefault();

		$(this).parent().toggleClass('active');

	});

	/* Vote */

	function sa_change_vote(e){

		e.preventDefault();



		if ($(this).closest('.sa-deal-rating').hasClass('nlog')) {

			$('.login-popup').modal();

		} else {



			let span = $(this).parent().children('span');

			let vote = span.text();

			let way = ( $(this).hasClass('up') ) ? '+' : '-';

			let id = $(this).closest('.sa-deal-rating').data("id");

			let nonce = $(this).closest('.sa-deal-rating').data("nonce");



			$.ajax({

				type : "post",

				dataType : "json",

				url : myAjax.ajaxurl,

				data : {

					action: "sa_vote_change", 

					id: id, 

					way: way,

					nonce: nonce

				},

				success: function(resp) {

					console.log(resp);

					let ids;



					let cookiePlus = getCookie('dailydeal_vote_plus');

					let cookiePlusArr = [];

					let cookieMinus = getCookie('dailydeal_vote_minus');

					let cookieMinusArr = [];

					if (way === '+') {

						if ( cookiePlus ) {

							cookiePlusArr = cookiePlus.split(',');

							if ( !cookiePlusArr.includes(id) ) {

								cookiePlusArr.push(id)

								console.log('ADD', id, cookiePlusArr);

							} else console.log('IS THERE ALREADY');

						} else {

							cookiePlusArr.push(id)

							console.log('first val: ADD')

						}

						setCookie('dailydeal_vote_plus', cookiePlusArr.join(',') );

					} else {

						if ( cookieMinus ) {

							cookieMinusArr = cookieMinus.split(',');

							if ( !cookieMinusArr.includes(id) ) {

								cookieMinusArr.push(id)

								console.log('ADD', id, cookieMinusArr);

							} else console.log('IS THERE ALREADY');

						} else {

							cookieMinusArr.push(id)

							console.log('first val: ADD')

						}

						setCookie('dailydeal_vote_minus', cookieMinusArr.join(',') );

					}

					span.text(resp);

					span.closest('.sa-deal-rating').attr('disabled', 'disabled');



					//$('.sa-deal-rating button').on('click', sa_change_vote);

				}, 

				error: function(xhr) {

					console.log(xhr);

				}

			});

		}



	}

	$("body").on("click", ".sa-deal-rating button", sa_change_vote);
	//$('.sa-deal-rating button').on('click', sa_change_vote);

	/* Copy */

	$('.btn-copy').off('click').on('click', copyButton);



	function copyButton (e) {

		e.preventDefault();

		let tocopy = $(this).data('copy');

		copyToClipboard(tocopy);

		let span = $(this).children('span');

		span.text('COPIED!');

		setTimeout(() => {

			span.text(tocopy);

		}, 2000)

	}



	// Post New AD 

	let tabs = {

		'deal': '',

		'coupon': '',

	};

	$('[data-tab-target]').each(function(el){

		let tab = $(this).data('tab-target');

		tabs[tab] = '<div class="row" data-tab-target="' + tab + '">' + $(this).html() + '</div>';

		$(this).remove();

	});

	$(tabs[$('.adttype-tabs > .btn.active').data('tab')]).insertAfter('.adttype-tabs');

	$('#ad_type').val($('.adttype-tabs > .btn.active').data('tab'));



	$('.adttype-tabs > .btn').on('click', function(e) {



		if ($(this).hasClass('active')) return false;

		$('.adttype-tabs > .btn').toggleClass('active btn-theme');



		let tab = $(this).data('tab');

		$('[data-tab-target]').remove();

		$(tabs[tab]).insertAfter('.adttype-tabs');

		$('#ad_type').val(tab);



	});



	// Global Tabs

	$('.tabs-nav > button').on('click', function(e) {

		let targetBtn = $(this);

		e.preventDefault();

		if (!$(this).hasClass('active')) {

			let tab = targetBtn.data('nav');

			$('.tabs-nav > button').removeClass('active');

			targetBtn.addClass('active');

			$('.tabs-content > div').removeClass('active')

			$('.tabs-content > div[data-tab="'+tab+'"]').addClass('active');

		}

	})





	// Profile Popup

	

	function toggle_profile_popup (e, action) {

		e.preventDefault();

		if (action === 'show') {

			$(e.currentTarget).parent().find('.sa-popup').addClass('active');

		} else {

			$(e.currentTarget).closest('.sa-popup').removeClass('active');

		}

	}



	$('.sa_author > button').on('click', (e) => {

		toggle_profile_popup(e, 'show');

		console.log('toggle');

	});

	$('.sa-popup [data-close]').on('click', (e) => toggle_profile_popup(e, 'hide'));



	$(".btn-login-popup").trigger('click');



	$("#btn_register_login").click(function(){



		$(".err-msg").remove();

		$("#login_username").val('');



	});



	$("#login_password").focus(function(){

		var _this = this;

		$(_this).attr("placeholder",'');



	});



	function forgotPassword(_this){

		if($(".close-login-popup").trigger('click')){

			$(".btn-forgot-popup").trigger('click');

		}

	}







	$('.sa_pagi > button').off('click').on('click', updateNavi );



	let ajaxDo = true;



	// Paginatiion

	function updateNavi (e) {

		e.preventDefault();

		let current = $(e.currentTarget);

		let nonce = $('.sa_pagi').attr("data-nonce");

		let page = $('.sa_pagi .pager').attr('data-nav');

		let targetNav = current.attr('data-nav');

		let ptype = $('#listings').attr('data-ptype');

		let feed = $('#listings').attr('data-feed');

		let tax, term;

		var bodyClassList = $('body').attr('class').split(/\s+/);

		$.each(bodyClassList, function(i, item) {

			if (item.startsWith("tax-") ) {

				tax = item.replace('tax-', ''); 

			}

		});

		$.each(bodyClassList, function(i, item) {

			if (item.startsWith("term-") ) {

				term = item.replace('term-', ''); 

			}

		});

		if ($('.sa-listings[data-page="'+targetNav+'"]').length) {

			$('html,body').animate({scrollTop: $('.sa-listings[data-page="'+targetNav+'"]').offset().top - 120}, 500);

			console.log('EXIST SCROLL');

			let count_pages = $('.sa_pagi > .sa_nav:last-child').attr('data-nav');;

			update_pagination(parseInt(targetNav), parseInt(count_pages));

		} else {

			if (ajaxDo) {

				$.ajax({

					type : "post",

					dataType : "json",

					url : myAjax.ajaxurl,

					data : {

						action: "sa_adposts_load",

						page: page,

						nav: targetNav,

						autoload: false,

						nonce: nonce,

						feed: feed,

						ptype: ptype,

						tax: tax,

						term: term,

						hide_local:getUrlParameter('hide_local'),

						hide_feature:getUrlParameter('hide_feature'),

					},

					beforeSend: function () {

						ajaxDo = false;

						$('#listings-list').addClass('sa_loading');

					},

					success: function(resp) {

						console.log(resp);

						if ( resp.status == true ) {

							// Append Items

							$('.sa-listings').parent().append(resp.items);

							// Order Items

							$('#listings > div > .row > .sa-listings').sort(function(a, b) {

								return $(a).data('page') - $(b).data('page');

							}).appendTo('#listings > div > .row');

							// Update pagination

							update_pagination(resp.current, resp.pages);

							// Scrolling to result

							$('html,body').animate({scrollTop: $('.sa-listings[data-page="'+$('.sa_pagi .pager').attr('data-nav')+'"]').offset().top - 120}, 500);

							// set available to ajax again

							$('.btn-copy').off('click').on('click', copyButton);

							ajaxDo = true;

							// set Loading Off

							$('#listings-list').removeClass('sa_loading');

							$('.sa_author > button').on('click', (e) => toggle_profile_popup(e, 'show'));

							$('.sa-popup [data-close]').on('click', (e) => toggle_profile_popup(e, 'hide'));

						} else {

							$('#global_footer').removeClass('hide');	

						}

					}, 

					error: function(xhr) {

						console.log(xhr);

					}

				});



			} else {

				console.log('no rush');

			}



		}



	}

	function getUrlParameter(sParam) {

	    var sPageURL = window.location.search.substring(1),

	        sURLVariables = sPageURL.split('&'),

	        sParameterName,

	        i;



	    for (i = 0; i < sURLVariables.length; i++) {

	        sParameterName = sURLVariables[i].split('=');



	        if (sParameterName[0] === sParam) {

	            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);

	        }

	    }

	    return false;

	};

	function update_pagination( current, max ) {

		let data = {

			'current': current,

			'prev': current - 1,

			'next': current + 1,

			'max': max,

		};



		if ( data.current == data.max ) {

			data.next = data.max;

			$('.sa_pagi > .pager').attr('data-nav', data.current);

			$('.sa_pagi > .sa_prev').attr('data-nav', data.prev);

			$('.sa_pagi > .sa_next').attr('data-nav', data.next);

			$('.sa_pagi > .sa_next').attr('disabled', 'disabled'); // Disabling Prev

			$('.sa_pagi > .sa_nav:last-child').attr('disabled', 'disabled'); // Disabling first item

			$('.sa_pagi > .sa_prev').removeAttr('disabled');

			$('.sa_pagi > .sa_nav:first-child').removeAttr('disabled');	

		} else if (data.current == 1) {

			data.prev = 1;

			$('.sa_pagi > .pager').attr('data-nav', data.current);

			$('.sa_pagi > .sa_prev').attr('data-nav', data.prev);

			$('.sa_pagi > .sa_prev').attr('disabled', 'disabled'); // Disabling Prev

			$('.sa_pagi > .sa_nav:first-child').attr('disabled', 'disabled'); // Disabling first item

			$('.sa_pagi > .sa_next').attr('data-nav', data.next);

			$('.sa_pagi > .sa_next').removeAttr('disabled');

			$('.sa_pagi > .sa_nav:last-child').removeAttr('disabled');	

		} else {

			$('.sa_pagi > .pager').attr('data-nav', data.current);

			$('.sa_pagi > .sa_prev').attr('data-nav', data.prev);

			$('.sa_pagi > .sa_next').attr('data-nav', data.next); 

			$('.sa_pagi > .sa_prev').removeAttr('disabled');

			$('.sa_pagi > .sa_next').removeAttr('disabled');

			$('.sa_pagi > .sa_nav:first-child').removeAttr('disabled');	

			$('.sa_pagi > .sa_nav:last-child').removeAttr('disabled');	

		}



	}



	/* Categories Slider */

	$('.owl-carousel.owl-categories').owlCarousel({

		loop:true,

		margin:0,

		nav:true,

		dots: true,

		items: 1,

	});

	/* Categories Slider */

	$('.owl-carousel.owl-merchands').owlCarousel({

		loop:true,

		margin:0,

		nav:true,

		dots: true,

		items: 1,

	});

	/* Posts Slider */

	$('.owl-carousel.owl-ads, .owl-carousel.owl-discussions').owlCarousel({

		loop:true,

		margin:0,

		nav:true,

		dots: true,

		items: 1,

	});

	/* Header Categories Slider */

	$('.owl-carousel.owl-header-categories').owlCarousel({

		loop:false,

		margin:0,

		nav:true,

		dots: false,

		items: 10,

		autoWidth:true,

		slideBy: 'page',

	});

	$('.owl-carousel.owl-header-ht-ad-post').owlCarousel({

		loop:false,

		margin:0,

		nav:true,

		dots: false,

		items: 4,

	});

	/* Header Categories Slider */

	$('.owl-carousel.owl-groups').owlCarousel({

		loop:false,

		margin:0,

		nav:true,

		dots: true,

		items: 1,

		slideBy: 'page',

	});



	$('.sa-widget-heading > button.btn-hide').on('click', function(){

		$(this).closest('.sa-widget').find('.sa-widget_content').toggleClass('hide');

		$(this).find('i').toggleClass('fa-eye-slash fa-eye');

	})





	$('.login-popup').on('show.bs.modal', function (e) {

		$('.registration-popup').modal('hide');

	});

	$('.registration-popup').on('show.bs.modal', function (e) {

		$('.login-popup').modal('hide');

	});



	$('.showpass').on('change', function(e) {

		let input = $(this).prev();

		if (input.attr('type') == 'password') {

			input.attr('type', 'text');

		} else {

			input.attr('type', 'password');

		}

	})



	let ScrollDo = true;

	var footer_Toggle = true;

	$(document).on('scroll', function (e) {



		let limit = $('#listing-list').offset().top + $('#listing-list').height();

		let y = $(this).scrollTop() + $(window).height();

		if ( y > limit && ScrollDo ) {

			let current = $('.sa_pagi > span.pager').data('nav');

			let nonce = $('.sa_pagi').attr("data-nonce");

			let page = $('.sa_pagi').find('.pager').attr('data-nav');

			let feed = $('#listings').attr('data-feed');

			let ptype = $('#listings').attr('data-ptype');

			let tax, term;

			var bodyClassList = $('body').attr('class').split(/\s+/);

			$.each(bodyClassList, function(i, item) {

				if (item.startsWith("tax-") ) {

					tax = item.replace('tax-', ''); 

				}

			});

			$.each(bodyClassList, function(i, item) {

				if (item.startsWith("term-") ) {

					term = item.replace('term-', ''); 

				}

			});

			feed = (feed) ? feed : 'default';

			$.ajax({

				type : "post",

				dataType : "json",

				url : myAjax.ajaxurl,

				data : {

					action: "sa_adposts_load",

					page: page,

					nav: current,

					autoload: true,

					nonce: nonce,

					feed: feed,

					tax: tax,

					term: term,

					ptype: ptype,

					hide_local:getUrlParameter('hide_local'),

					hide_feature:getUrlParameter('hide_feature')

				},

				beforeSend: function() {

					$('#listing-list').addClass('sa_loading');

					if (footer_Toggle == true) {

						console.log('footer toggle');

						$('.sa_footer').css('bottom', '-'+ footer_height + 'px');

						footer_Toggle = false;

					}

				},

				success: function(resp) {

					console.log(resp, tax);

					if ( resp.status == true ) {

						// Append Items

						$('.sa-listings').parent().append(resp.items);

						// Order Items

						$('#listings > div > .row > .sa-listings').sort(function(a, b) {

							return $(a).data('page') - $(b).data('page');

						}).appendTo('#listings > div > .row');

						// Update pagination

						update_pagination(resp.current, resp.pages);

						// set available to ajax again

						$('.btn-copy').off('click').on('click', copyButton);

						ScrollDo = true;

					} else {

						ScrollDo = false;

						$('#global_footer').removeClass('hide');

					}

					// set Loading Off

					$('#listing-list').removeClass('sa_loading');

					$('.sa_author > button').on('click', (e) => toggle_profile_popup(e, 'show'));

					$('.sa-popup [data-close]').on('click', (e) => toggle_profile_popup(e, 'hide'));

				}, 

				error: function(xhr) {

					console.log(xhr);

				}

			});



			ScrollDo = false;

		}



	});



	$('.widget.widget-content select[name=tabs]').on('change', function(e){

		e.preventDefault()

		let target = e.target.value;

		let parent = $(this).closest('.widget.widget-content');

		parent.find('#owl-sa:not([data-tab='+target+'])').removeClass('active');

		parent.find('#owl-sa[data-tab='+target+']').addClass('active');

	})

	$('.ht-section select[name=tabs]').on('change', function(e){

		e.preventDefault()

		let target = e.target.value;

		let parent = $(this).closest('.ht-section');

		parent.find('.owl-header-ht-ad-post:not([data-tab='+target+'])').removeClass('active');

		parent.find('.owl-header-ht-ad-post[data-tab='+target+']').addClass('active');

	})

	/* Drop Down Toggle */

	$('.mega-menu .menu-links > li.sa-dropdown > a').on('click', function(e){

		e.preventDefault();

		$(this).parent().toggleClass('active')

	})



	$(document).mouseup(function(e) 

						{

		var container = $(".sa_author .sa-popup, .sa-dropdown, .sa-search-results, .sa-search-input");

		// if the target of the click isn't the container nor a descendant of the container

		if (!container.is(e.target) && container.has(e.target).length === 0) {

			container.removeClass('active');

		}

	});



	/*  Search Events */

	$('.sa-header-row > .sa-search > .sa-search-input > input').on('focus', function(){

		$(this).parent().addClass('active');

		$('.sa-header-row > .sa-search > .sa-search-results').addClass('active');

	});

	$('.sa-header-row > .sa-search > .sa-search-input > .sa_close').on('click', function(){

		$(this).parent().removeClass('active');

		$('.sa-header-row > .sa-search > .sa-search-results').removeClass('active');

	});



	$('.sa-header-row > .sa-search > .sa-search-input > input').on('keyup', function(e){

		let value = $(this).val();

		let nonce = $(this).closest('.sa-search-input').data('nonce');

		if ( value.length >= 2 ) {

			$('.most-searched.search-block').removeClass('active');

			$.ajax({

				type : "post",

				dataType : "json",

				url : myAjax.ajaxurl,

				data : {

					action: "sa_search",

					q: value,

					nonce: nonce,

				},

				beforeSend: function() {

					console.log('loading');

				},

				success: function(resp) {

					console.log(resp);

					if ( resp.deals ) {

						$('.deals.search-block').html(resp.deals);

						$('.deals.search-block').addClass('active');

					} else {

						$('.deals.search-block').html('');

						$('.deals.search-block').removeClass('active');

					}

					if ( resp.groups ) {

						$('.groups.search-block').html(resp.groups);

						$('.groups.search-block').addClass('active');

					} else {

						$('.groups.search-block').html('');

						$('.groups.search-block').removeClass('active');

					}

					if ( resp.users ) {

						$('.users.search-block').html(resp.users);

						$('.users.search-block').addClass('active');

					} else {

						$('.users.search-block').html('');

						$('.users.search-block').removeClass('active');

					}

					if ( $('.sa-search-results').length ) $('.sa-search-results a.all-results').remove();

					$('.sa-search-results').append('<a class="btn btn-light btn-block all-results" href="/search-results/?ad_title='+value+'">Voir tous les résultats</a>');

				}, 

				error: function(xhr) {

					console.log(xhr);

				}

			});

		} else {

			$('.search-block').removeClass('active');

			$('.most-searched.search-block').addClass('active');

			$('.sa-search-results a.all-results').remove();

		}

	});







	$('button.btn.btn-foll').on('click', function(e){

		let button = $(this);

		let uid = $(this).data('uid');

		let nonce = $(this).data('nonce');

		let follow = ($(this).hasClass('followed')) ? 'unfollow' : 'follow' ;

		$.ajax({

			type : "post",

			dataType : "json",

			url : myAjax.ajaxurl,

			data : {

				action: "sa_follow",

				uid: uid,

				follow: follow,

				nonce: nonce,

			},

			beforeSend: function() {

				console.log('loading');

			},

			success: function(resp) {

				console.log(resp);

				if ( resp.status ) {

					button.parent().find('button').toggleClass('hidden');

				} 

			}, 

			error: function(xhr) {

				console.log(xhr);

			}

		});

	});



	// get

	function sa_get(name) {

		var parts = window.location.search.substr(1).split("&");

		var $_GET = {};

		for (var i = 0; i < parts.length; i++) {

			var temp = parts[i].split("=");

			$_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);

		}



		return $_GET[name];

	}



	if ( sa_get('type') == 'send_message' ) {

		$('#messageModal').modal('show');

	}



	if ( $('.sa_footer').length <= 0 ) {

		$('#global_footer').removeClass('hide');

	}

	if ($('.ht-country').hasClass("select2-hidden-accessible")) {

		    $('.ht-country').select2('destroy');

	}

	$( document ).ready(function() {

		$(document).on('click', '.ht-filter .dropdown-menu,.ht-filter .multiselect-native-select', function (e) {

		  e.stopPropagation();

		});

		$('.ht-icons').on('click','.fas',function(e){

			$('.ht-icons button').removeClass('active');

			$(this).parent().addClass('active');

			if($(this).hasClass('fa-grip-lines')){

				$('.ht-images').show();

			}else{

				$('.ht-images').hide();

				

			}

		});

		$('.ht-bicons').on('click','.fas',function(e){

			$('.ht-bicons button').removeClass('active');

			$(this).parent().addClass('active');

			if($(this).hasClass('fa-grip-lines')){

				$('.ht-p').show();

			}else{

				$('.ht-p').hide();

			}

		});

		$('.ht-checkbox').on('change',function(){

			if($(this).prop("checked") == true){

				$('.ht-checkbox').prop("checked",true);

				$('.ht-sa-after-header').show();

				$('.ht-wigget-heading').parent().parent().hide();

			}else{

				$('.ht-checkbox').prop("checked",false);

				$('.ht-wigget-heading').parent().parent().show();

				$('.ht-sa-after-header').hide();

			}

		});

		$('.ht-filter1').on('change',function(){

			var url = window.location.href;

			url = url.split("?")[0];

			  $(".ht-filter1").each(function(i) {

			    if (!$(this).is(":checked")) return;

			    url += (url.indexOf("?")==-1 ? "?" : "&") + this.name + "=" + encodeURIComponent($(this).val());

			});

			location.href = url;



		});

		

		if (!$('.ht-country').hasClass("select2-hidden-accessible")) {

		    $('.ht-country').multiselect({

	            enableClickableOptGroups: true

	        });

		}

	});

	

});