<section class="sa_profile-header">
	<img src="<?php echo esc_attr($user_pic); ?>" id="user_dp" alt="<?php echo __('Profile Picture', 'adforest'); ?>" class="img-bg">
	<div class="container">
		<div class="row">   
			<div class="sa_profile">
				<img class="sa_profile-avatar" src="<?php echo esc_attr($user_pic); ?>" id="user_dp" alt="<?php echo __('Profile Picture', 'adforest'); ?>">
				<div class="sa_profile-details">
					<div class="sa_profile-meta">


						<h4 class="author"><?php echo esc_html($author->display_name); ?></h4>
						<span class="last_active">
							<?php printf( _x( 'Last active : %s Ago', 'Last login time', 'adforest' ), adforest_get_last_login($author->ID) );?>
						</span>

						<div class="sa_profile-rating">
							<?php
							if (get_user_meta($author->ID, '_sb_badge_type', true) != "" && get_user_meta($author->ID, '_sb_badge_text', true) != "" && isset($adforest_theme['sb_enable_user_badge']) && $adforest_theme['sb_enable_user_badge'] && $adforest_theme['sb_enable_user_badge'] && isset($adforest_theme['user_public_profile']) && $adforest_theme['user_public_profile'] != "" && $adforest_theme['user_public_profile'] == "modern") {
							?>
							<button class="btn my-btn-updated <?php echo get_user_meta($author->ID, '_sb_badge_type', true); ?>">
								<?php echo get_user_meta($author->ID, '_sb_badge_text', true); ?>
							</button>
							<?php
							}

							$user_type = '';
							if (get_user_meta($author->ID, '_sb_user_type', true) == 'Indiviual') {
								$user_type = __('Individual', 'adforest');
							} else if (get_user_meta($author->ID, '_sb_user_type', true) == 'Dealer') {
								$user_type = __('Dealer', 'adforest');
							}
							if ($user_type != "") {
							?>
							<button class="btn my-btn label-success"><?php echo adforest_returnEcho($user_type); ?></button>
							<?php
							}
							?>
						</div>

						<?php
						if (isset($adforest_theme['user_public_profile']) && $adforest_theme['user_public_profile'] != "" && $adforest_theme['user_public_profile'] == "modern" && isset($adforest_theme['sb_enable_user_ratting']) && $adforest_theme['sb_enable_user_ratting']) {
						?>
						<a href="<?php echo adforest_set_url_param(get_author_posts_url($author->ID),'type',1) ; ?>">
							<div class="seller-public-profile-star-icons">
								<?php
							$got = get_user_meta($author->ID, "_adforest_rating_avg", true);


							//  $got   =  count(adforest_get_all_ratings($author_id));
							$total = 0;
							if ($got == "")
								$got = 0;
							for ($i = 1; $i <= 5; $i++) {
								if ($i <= round($got))
									echo '<i class="fa fa-star"></i>';
								else
									echo '<i class="fa fa-star-o"></i>';

								$total++;
							}
								?>
								<span class="rating-count count-clr">
									(<?php
							$ratings = adforest_get_all_ratings($author_id);
							echo count($ratings);
									?>)
								</span>
							</div>
						</a>
						<?php
						}
						?>
					</div>
					<?php if ( get_current_user_id() !== $author_id ) : ?>
					<div class="sa_profile-buttons">
						<button type="button" class="btn sa-btn-black" data-toggle="modal" data-target="#messageModal" ><i class="fa fa-envelope"></i> Envoyer MP</button>
						<?php
						$followers_meta = get_user_meta( $author_id, 'sa_followers', true );
						$followers = explode(',', $followers_meta );
						if ( is_user_logged_in() ) {
							$followed = (in_array(get_current_user_id(), $followers)) ? true : false ;
							$follow_classes = ( $followed ) ? 'btn btn-foll sa-btn-green follow hidden' : 'btn btn-foll sa-btn-green follow';
							$unfollow_classes = ( $followed ) ? 'btn btn-foll sa-btn-gray followed' : 'btn btn-foll sa-btn-gray followed hidden';
							echo "<button class='$unfollow_classes' data-uid='$author_id' $unfollow_hidden data-nonce='".esc_attr(wp_create_nonce("sa_follow"))."'><i class='fa fa-bell'></i>unfollow</button>";
							echo "<button class='$follow_classes' data-uid='$author_id' $follow_hidden data-nonce='".esc_attr(wp_create_nonce("sa_follow"))."'><i class='fa fa-bell'></i>follow</button>";
						} else {
							echo "<button href='javascript:void(0);' data-toggle='modal' data-target='.login-popup' class='$classes' data-uid='$author_id' data-nonce='".esc_attr(wp_create_nonce("sa_follow"))."'><i class='fa fa-bell'></i>Suivre</button>";
						}

						?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="messageModalLabel">New message</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<?php
				if (isset($adforest_theme['sb_user_profile_sc'])) {

					if ($adforest_theme['sb_user_profile_sc'] == "") {
						return;
					}
				}
				if (isset($adforest_theme['user_contact_form']) && $adforest_theme['user_contact_form']) {

					$captcha_type = isset($adforest_theme['google-recaptcha-type']) && !empty($adforest_theme['google-recaptcha-type']) ? $adforest_theme['google-recaptcha-type'] : 'v2';
					$site_key = isset($adforest_theme['google_api_key']) && !empty($adforest_theme['google_api_key']) ? $adforest_theme['google_api_key'] : '';
					$contact_form_recaptcha = isset($adforest_theme['contact_form_recaptcha']) && !empty($adforest_theme['contact_form_recaptcha']) ? $adforest_theme['contact_form_recaptcha'] : '';

					$author_privacy_page = isset($adforest_theme['author_privacy_page']) && $adforest_theme['author_privacy_page'] != '' ? $adforest_theme['author_privacy_page'] : '';
				?>

				<div class="heading-panel">
					<h3 class="main-title text-left"><?php echo __('Contact', 'adforest');?></h3>
				</div>
				<form id="user_contact_form">
					<div class="seller-form-group">
						<div class="form-group">
							<input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="<?php echo __('Name', 'adforest');?>" data-parsley-required="true" data-parsley-error-message="<?php echo __('This field is required.', 'adforest');?>">
							<small id="emailHelp" class="form-text text-muted"></small> </div>
						<div class="form-group">
							<input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="<?php echo __('Email', 'adforest');?>" data-parsley-required="true" data-parsley-error-message="<?php echo __('This field is required.', 'adforest');?>">
							<small id="emailHelp" class="form-text text-muted"></small> </div>
						<div class="form-group">
							<input type="text" class="form-control" name="subject" aria-describedby="emailHelp" placeholder="<?php echo __('Subject', 'adforest');?>" data-parsley-required="true" data-parsley-error-message="<?php echo __('This field is required.', 'adforest');?>">
							<small id="emailHelp" class="form-text text-muted"></small> </div>
						<div class="form-group">
							<textarea class="form-control" name="message" rows="3" placeholder="<?php echo __('Message', 'adforest');?>" data-parsley-required="true" data-parsley-error-message="<?php echo __('This field is required.', 'adforest');?>"></textarea>
						</div>
						<?php
					$captcha = '<input type="hidden" value="no" name="is_captcha" />';

					if (isset($contact_form_recaptcha) && $contact_form_recaptcha) {
						if ($captcha_type == 'v2') {
							if ($site_key != "") {
								$captcha = '<div class="form-group">
			  <div class="g-recaptcha" data-sitekey="' . $site_key . '"></div>
		   </div><input type="hidden" value="yes" name="is_captcha" />
		';
							}
						} else {
							$captcha = '<input type="hidden" value="yes" name="is_captcha" />';
						}
					}
					echo adforest_returnEcho($captcha);

					if (isset($author_privacy_page) && $author_privacy_page != '') {
						?>
						<div class="form-group checkbox-wrap sb-author-policy">
							<input type="checkbox" name="author_policy_checkbox" id="author_policy_checkbox" data-parsley-required="true" data-parsley-error-message="<?php echo __('Please accept the terms and policy.', 'adforest');?>" />
							<label for="author_policy_checkbox"><?php echo __(' I agree to the site ', 'adforest')?> <a href="<?php echo esc_url(get_permalink($author_privacy_page));?>" target="_blank"><?php echo __('Terms and Policy', 'adforest');?></a></label>
						</div>
						<?php
					}
						?>
					</div>
					<div class="sellers-button-group">
						<button class="btn btn-primary btn-theme" type="submit"><?php echo __('Send', 'adforest');?></button>
						<input type="hidden" id="receiver_id" value="<?php echo esc_attr($author_id);?>" />
					</div>
				</form>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>