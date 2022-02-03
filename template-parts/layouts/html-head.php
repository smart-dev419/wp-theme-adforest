<!DOCTYPE html>
<html <?php language_attributes(); ?> >
	<head>
		<?php global $adforest_theme; ?>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

		<?php
		if (isset($adforest_theme['header_js_and_css']) && $adforest_theme['header_js_and_css'] != "") {
			echo adforest_returnEcho($adforest_theme['header_js_and_css']);
		}
		$sb_body_class = '';
		if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['sb_header']) && $adforest_theme['sb_header'] == 'transparent' && is_page_template('page-home.php')) {
			$sb_body_class = 'enable-transparent';
		}
		?>
		<style id="adforest-custom-css"></style>
		<?php wp_head(); 
		$custom_switcher =  isset($adforest_theme['custom_theme_color_switch']) && $adforest_theme['custom_theme_color_switch'] ? $adforest_theme['custom_theme_color_switch'] : false;
		$cus_switch_class = '';
		if($custom_switcher){
			$cus_switch_class = ' custom-switcher';
		}
		?>


		<?php
		if(!is_user_logged_in()) {?>
		<script src="https://apis.google.com/js/api:client.js"></script>
		<script>
			var googleUser = {};
			var startApp = function() {
				gapi.load('auth2', function(){
					// Retrieve the singleton for the GoogleAuth library and set up the client.
					auth2 = gapi.auth2.init({
						client_id: '658844847353-v3ohf4n66ea38d5j56qkmghus5kdtuq9.apps.googleusercontent.com',
						cookiepolicy: 'single_host_origin',
						// Request scopes in addition to 'profile' and 'email'
						//scope: 'additional_scope'
					});
					if(document.getElementById('google-login')){
						attachSignin(document.getElementById('google-login'));
					}
					if(document.getElementById('google-login-register')){
						attachSignin(document.getElementById('google-login-register'));
					}
				});
			};

			function attachSignin(element) {
				//console.log(element.id);
				auth2.attachClickHandler(element, {},
										 function(googleUser) {
					//document.getElementById('name').innerText = "Signed in: " +
					//googleUser.getBasicProfile().getName();
					//console.log(googleUser.getBasicProfile());
					var data =  {
						'action': 'social_login',
						'first_name': googleUser.getBasicProfile().getGivenName(),
						'last_name': googleUser.getBasicProfile().getFamilyName(),
						'email' : googleUser.getBasicProfile().getEmail(),
						'username' : googleUser.getBasicProfile().getId()
					};

					// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					var ajaxurl =  "<?php echo admin_url('admin-ajax.php'); ?>";
					jQuery.post(ajaxurl, data, function(response) {
						//alert('Got this from the server: ' + response);
						location.href = "<?php home_url();?>/my-account";
					});
				}, function(error) {
					console.log(JSON.stringify(error, undefined, 2));
				});
			}
		</script>
		<?php }?>
	</head>
	<body <?php body_class($sb_body_class); ?>>




		<?php
		if(!is_user_logged_in()) {?>
		<script>
			// This is called with the results from from FB.getLoginStatus().
			function statusChangeCallback(response) {
				console.log('statusChangeCallback');
				console.log(response);
				// The response object is returned with a status field that lets the
				// app know the current login status of the person.
				// Full docs on the response object can be found in the documentation
				// for FB.getLoginStatus().
				if (response.status === 'connected') {
					// Logged into your app and Facebook.
					testAPI(response.authResponse.userID);
				} else {
					// The person is not logged into your app or we are unable to tell.

				}
			}

			// This function is called when someone finishes with the Login
			// Button.  See the onlogin handler attached to it in the sample
			// code below.
			function checkLoginState() {
				FB.getLoginStatus(function(response) {
					statusChangeCallback(response);
				});
			}

			window.fbAsyncInit = function() {
				FB.init({
					appId      : '1463302083845450',
					cookie     : true,  // enable cookies to allow the server to access 
					// the session
					xfbml      : true,  // parse social plugins on this page
					version    : 'v2.8' // use graph api version 2.8
				});

				// Now that we've initialized the JavaScript SDK, we call 
				// FB.getLoginStatus().  This function gets the state of the
				// person visiting this page and can return one of three states to
				// the callback you provide.  They can be:
				//
				// 1. Logged into your app ('connected')
				// 2. Logged into Facebook, but not your app ('not_authorized')
				// 3. Not logged into Facebook and can't tell if they are logged into
				//    your app or not.
				//
				// These three cases are handled in the callback function.

				/* FB.getLoginStatus(function(response) {
		      statusChangeCallback(response);
		    });*/
			};

			// Load the SDK asynchronously
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "https://connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));

			// Here we run a very simple test of the Graph API after login is
			// successful.  See statusChangeCallback() for when this call is made.
			function testAPI(loggedInUserId) {
				console.log('Welcome!  Fetching your information.... ');
				FB.api('/me', { locale: 'en_US', fields: 'name, email,first_name,last_name' }, function(response) {

					var data = {
						'action': 'social_login',
						'first_name': response.first_name,
						'last_name': response.last_name,
						'email' : response.email,
						'username' : loggedInUserId
					};

					// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					var ajaxurl =  "<?php echo admin_url('admin-ajax.php'); ?>";
					jQuery.post(ajaxurl, data, function(response) {
						//alert('Got this from the server: ' + response);
						location.href = "<?php home_url();?>/my-account";
					});
				});
			}

			function loginwithFB(){
				FB.login(function(response){
					statusChangeCallback(response);
				});
			}
		</script>
		<?php } ?>


		<?php
		if(!is_user_logged_in()) {
			echo do_shortcode('[csap_login]');
			echo do_shortcode('[csap_registration]');
		}
		?>
		<input type="hidden" name="admin_ajax_url" id="admin_ajax_url" value="<?php echo admin_url('admin-ajax.php'); ?>">

		<?php
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		}
		?>
		<?php do_action('adforest_language_switcher');?>
		<?php if (isset($adforest_theme['sb_pre_loader']) && $adforest_theme['sb_pre_loader']) { ?><div id="loader-wrapper"><div id="loader"></div><div class="loader-section section-left"></div><div class="loader-section section-right"></div></div><?php } ?>
		<?php if (isset($adforest_theme['sb_color_plate']) && $adforest_theme['sb_color_plate']) { ?>
		<div class="color-switcher<?php echo esc_attr($cus_switch_class);?>" id="choose_color"><a href="javascript:void(0)" class="picker_close"><i class="fa fa-gear"></i></a><h5><?php echo __('Style Switcher', 'adforest'); ?></h5> <div class="theme-colours"><p> <?php echo __('Choose Colour style', 'adforest'); ?> </p>
			<?php
																								  if ($custom_switcher) {

																									  $custom_theme_color = isset($adforest_theme['custom-theme-color']) && !empty($adforest_theme['custom-theme-color']) ? $adforest_theme['custom-theme-color'] : '#f58936';
																									  $custom_btn_hover_color = isset($adforest_theme['custom-btn-hover-color']) && !empty($adforest_theme['custom-btn-hover-color']) ? $adforest_theme['custom-btn-hover-color'] : '#f58936';
																									  $custom_btn_border_color = isset($adforest_theme['custom-btn-border-color']) && !empty($adforest_theme['custom-btn-border-color']) ? $adforest_theme['custom-btn-border-color'] : '#f58936';
			?>
			<ul>
				<li><label><?php echo esc_html__('Theme Color', 'adforest'); ?></label> <input value="<?php echo esc_attr($custom_theme_color);?>" type='text' id="theme-color" /> </li>
				<li><label><?php echo esc_html__('Hover Color', 'adforest'); ?></label> <input value="<?php echo esc_attr($custom_btn_hover_color);?>" type='text' id="btn-hover-color" /> </li>
				<li><label><?php echo esc_html__('Border Color', 'adforest'); ?></label> <input value="<?php echo esc_attr($custom_btn_border_color);?>" type='text' id="btn-border-color" /> </li>
				<li class="color-test"><a href="#." class="custom-theme btn btn-theme" id="custom-theme" style="width: auto;; height: auto;;;"><?php echo esc_html__('Apply', 'adforest'); ?></a></li>
			</ul>
			<?php } else { ?>
			<ul>
				<li><a href="#." class="defualt" id="defualt"></a></li>
				<li><a href="#." class="green" id="green"></a></li>
				<li><a href="#." class="blue" id="blue"></a></li>
				<li><a href="#." class="red" id="red"></a></li>
				<li><a href="#." class="dark-red" id="dark-red"></a></li>
				<li><a href="#." class="sea-green" id="sea-green"></a></li>
			</ul>
			<?php } ?>
			</div>
			<div class="clearfix">
			</div>
		</div>
		<?php } ?>
		<?php
		if (isset($adforest_theme['sb_comming_soon_mode']) && $adforest_theme['sb_comming_soon_mode']) {
			if (!current_user_can('administrator') && !is_admin()) {
				get_template_part('template-parts/layouts/coming', 'soon');
				exit;
			}
		}
		?>
		<div class="loading" id="sb_loading"><?php __('Loading', 'adforest'); ?>&#8230;</div>