<?php 
global $adforest_theme;
$author_id = get_query_var('author');
$uid = strval(get_current_user_id());
$author = get_user_by('ID', $author_id);
get_header();
global $adforest_theme;  
$profile = new adforest_profile();
if (isset($_GET['type']) && $_GET['type'] == 'settings') {
?>
<div class="sa_page-settings" data-nonce="<?php echo esc_attr(wp_create_nonce("sa_settings")); ?>">
	<div class="container">
		<div class="row">
			<div class="left-side col-lg-4">
				<h2>Parameters</h2>
				<nav class="sa_settings-nav">
					<a <?php if ($_GET['tab'] == 'profile') echo "class='active'"; ?> href="/author/admin/?type=settings&tab=profile" data-nav="profile"><i class="fa fa-user"></i>Profile</a>
					<a <?php if ($_GET['tab'] == 'preferences') echo "class='active'"; ?> href="/author/admin/?type=settings&tab=preferences" data-nav="preferences"><i class="fa fa-cog"></i>preferences</a>
					<a <?php if ($_GET['tab'] == 'notifs') echo "class='active'"; ?> href="/author/admin/?type=settings&tab=notifs" data-nav="subs"><i class="fa fa-bell"></i>Notifications</a>
					<a <?php if ($_GET['tab'] == 'subs') echo "class='active'"; ?> href="/author/admin/?type=settings&tab=subs" data-nav="notifs"><i class="fa fa-envelope"></i>Abonnements</a>
				</nav>
			</div>
			<div class="right-side col-lg-8">
				<div class="sa_settings-tabs">
					<?php if ($_GET['tab'] == 'profile') { ?>
					<div class='active' data-tab="profile">
						<h2 class="heading">Profile</h2>
						<hr>
						<div class="padding-25">
							<?php echo $profile->adforest_profile_update_form(); ?>
						</div>
					</div>
					<?php } elseif ($_GET['tab'] == 'subs') { ?>
					<div class='active' data-tab="subs">
						<h2 class="heading">Abonnements</h2>
						<hr>
						<div class="block">
							<div class="sa_settings-select">
								<label for="preferences_newsletter">Gérez vos abonnements</label>
								<div class="sa-select-abonnments">
									<select class="select-newsletter no_select2" title="Choisir un abonnement" name="preferences_newsletter" id="preferences_newsletter">
										<option value="basic_newsletters">Newsletter quotidienne</option>
									</select>
									<button class="btn btn-light btn-subscribe">S'abbonner</button>
								</div>
								<?php 
	$newsletter = get_user_meta($uid, 'preferences_newsletter');
	if (in_array( 'basic_newsletters', $newsletter) ) {
		echo "<ul class='subs-list'><li><span>Newsletter quotidienne</span><button class='rm'>x</button></li></ul>";
	}
								?>
							</div>
						</div>
					</div>
					<script>
						jQuery(function ($) {
							$('.btn-subscribe').on('click', (e) => update_newsletter(e, 'add'));
							
							$('.subs-list > li > button.rm').on('click', (e) => update_newsletter(e, 'remove'));

							function update_newsletter(e, to_do){
								e.preventDefault();
								$.ajax({
									type : "post",
									dataType : "json",
									url : myAjax.ajaxurl,
									data : {
										action: "sa_settings",
										page: 'subs',
										name: 'preferences_newsletter',
										value: 'basic_newsletters',
										to_do: to_do,
										nonce: $('.sa_page-settings').data('nonce'),
									},
									beforeSend: function() {
										console.log('loading');
									},
									success: function(resp) {
										console.log(resp); 
										if (resp.output) {
											$('.sa-select-abonnments').parent().append(resp.output);
										} else {
											$('ul.subs-list').remove();
										}
										$('.subs-list > li > button.rm').on('click', (e) => update_newsletter(e, 'remove'));
									}, 
									error: function(xhr) {
										console.log(xhr);
									}
								});
							}

						});
					</script>
					<?php } elseif ($_GET['tab'] == 'preferences') { ?>
					<div class='active' data-tab="notifs">
						<h2 class="heading">Notificiations</h2>
						<hr>
						<div class="block">
							<h3>Notifications dans le navigateur</h3>
							<div class="sa_settings-checks">
								<?php 

	$settings = array(
		array(
			'id' => 'preferences_is_online',
			'label' => 'Afficher quand je suis en ligne',
		),
		array(
			'id' => 'preferences_is_follow',
			'label' => 'Autoriser les membres à me suivre',
		),
		array(
			'id' => 'preferences_is_message',
			'label' => 'Autoriser les membres à m\'écrire en privé',
		),
	);

	foreach ( $settings as $setting ) {
		$setting_value = get_user_meta($uid, $setting['id'])[0];
		$checked = ( filter_var( $setting_value, FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : '';
		echo "<div class='sa_checkbox'>
										<input id='".$setting['id']."' type='checkbox' name='".$setting['id']."' $checked>
										<label for='".$setting['id']."'>".$setting['label']."</label>
									</div>";
	}

								?>
							</div>
						</div>
					</div>
					<script>
						jQuery(function ($) {
							$('.sa_checkbox input').on('change', function(e){
								$.ajax({
									type : "post",
									dataType : "json",
									url : myAjax.ajaxurl,
									data : {
										action: "sa_settings",
										name: $(this).attr('name'),
										value: $(this).is(':checked'),
										nonce: $('.sa_page-settings').data('nonce'),
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
						});
					</script>
					<?php } else if ($_GET['tab'] == 'notifs') { ?>
					<div class='active' data-tab="notifs">
						<h2 class="heading">Notificiations</h2>
						<hr>
						<div class="block">
							<h3>Notifications dans le navigateur</h3>
							<div class="sa_settings-checks">
								<div class="sa_checkbox">
									<input id="browser_notif_message" type="checkbox" name="browser_notif_message" <?php echo ( filter_var( get_user_meta($uid, "browser_notif_message")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="browser_notif_message">Quand quelqu'un m'envoie un message</label>
								</div>
								<div class="sa_checkbox">
									<input id="browser_notif_heats" type="checkbox" name="browser_notif_heats" <?php echo ( filter_var( get_user_meta($uid, "browser_notif_heats")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="browser_notif_heats">Quand un bon plan inratable chauffe très fort</label>
								</div>
							</div>
						</div>
						<hr>
						<div class="block">
							<h3>Alertes de température</h3>
							<div class="sa_settings-checks">
								<div class="sa_checkbox">
									<input id="alert_notif_heats" type="checkbox" name="alert_notif_heats" <?php echo ( filter_var( get_user_meta($uid, "alert_notif_heats")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="alert_notif_heats">Quand un bon plan inratable chauffe très fort</label>
								</div>
								<div class="sa_checkbox">
									<input id="alert_notif_email" type="checkbox" name="alert_notif_email" <?php echo ( filter_var( get_user_meta($uid, "alert_notif_email")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="alert_notif_email">Envoyez-moi aussi une notification par e-mail</label>
								</div>
							</div>
						</div>
						<hr>
						<div class="block">
							<h3>Mes deals</h3>
							<div class="sa_settings-checks">
								<div class="sa_checkbox">
									<input id="deal_notif_vote" type="checkbox" name="deal_notif_vote" <?php echo ( filter_var( get_user_meta($uid, "deal_notif_vote")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="deal_notif_vote">Quand quelqu'un vote sur mon deal</label>
								</div>
								<div class="sa_checkbox">
									<input id="deal_notif_comment" type="checkbox" name="deal_notif_comment" <?php echo ( filter_var( get_user_meta($uid, "deal_notif_comment")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="deal_notif_comment">Quand quelqu'un commente mon post</label>
								</div>
								<div class="sa_checkbox">
									<input id="deal_notif_hot" type="checkbox" name="deal_notif_hot" <?php echo ( filter_var( get_user_meta($uid, "deal_notif_hot")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="deal_notif_hot">Quand mon deal passe hot</label>
								</div>
								<div class="sa_checkbox">
									<input id="deal_notif_expire" type="checkbox" name="deal_notif_expire" <?php echo ( filter_var( get_user_meta($uid, "deal_notif_expire")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="deal_notif_expire">Avant l'expiration de mon deal</label>
								</div>
								<div class="sa_checkbox">
									<input id="deal_notif_post_expire" type="checkbox" name="deal_notif_post_expire" <?php echo ( filter_var( get_user_meta($uid, "deal_notif_post_expire")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="deal_notif_post_expire">Quand mon post expire</label>
								</div>
								<div class="sa_checkbox">
									<input id="deal_notif_expire_reactive" type="checkbox" name="deal_notif_expire_reactive" <?php echo ( filter_var( get_user_meta($uid, "deal_notif_expire_reactive")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="deal_notif_expire_reactive">Quand mon deal expiré est réactivé</label>
								</div>
							</div>
						</div>
						<hr>
						<div class="block">
							<h3>Deals suivis</h3>
							<div class="sa_settings-checks">
								<div class="sa_checkbox">
									<input id="subscribe_notif_comment" type="checkbox" name="subscribe_notif_comment" <?php echo ( filter_var( get_user_meta($uid, "subscribe_notif_comment")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="subscribe_notif_comment">Quand quelqu'un commente un post auquel je suis abonné(e)</label>
								</div>
								<div class="sa_checkbox">
									<input id="subscribe_notif_email" type="checkbox" name="subscribe_notif_email" <?php echo ( filter_var( get_user_meta($uid, "subscribe_notif_email")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="subscribe_notif_email">Envoyez-moi aussi une notification par e-mail</label>
								</div>
							</div>
						</div>
						<hr>
						<div class="block">
							<h3>Mes commentaires</h3>
							<div class="sa_settings-checks">
								<div class="sa_checkbox">
									<input id="comment_notif_like" type="checkbox" name="comment_notif_like" <?php echo ( filter_var( get_user_meta($uid, "comment_notif_like")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="comment_notif_like">Quand quelqu'un aime mon commentaire</label>
								</div>
								<div class="sa_checkbox">
									<input id="comment_notif_approve" type="checkbox" name="comment_notif_approve" <?php echo ( filter_var( get_user_meta($uid, "comment_notif_approve")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="comment_notif_approve">Quand mon commentaire est approuvé</label>
								</div>
								<div class="sa_checkbox">
									<input id="comment_notif_email" type="checkbox" name="comment_notif_email" <?php echo ( filter_var( get_user_meta($uid, "comment_notif_email")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="comment_notif_email">Envoyez-moi aussi une notification par e-mail</label>
								</div>
							</div>
						</div>
						<hr>
						<div class="block">
							<h3>Badges</h3>
							<div class="sa_settings-checks">
								<div class="sa_checkbox">
									<input id="badge_notif_earn" type="checkbox" name="badge_notif_earn" <?php echo ( filter_var( get_user_meta($uid, "badge_notif_earn")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="badge_notif_earn">Quand je gagne un badge</label>
								</div>
								<div class="sa_checkbox">
									<input id="badge_notif_email" type="checkbox" name="badge_notif_email" <?php echo ( filter_var( get_user_meta($uid, "badge_notif_email")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="badge_notif_email">Envoyez-moi aussi une notification par e-mail</label>
								</div>
							</div>
						</div>
						<hr>
						<div class="block">
							<h3>Membres suivis</h3>
							<div class="sa_settings-checks">
								<div class="sa_checkbox">
									<input id="member_notif_deal" type="checkbox" name="member_notif_deal" <?php echo ( filter_var( get_user_meta($uid, "member_notif_deal")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="member_notif_deal">Quand un(e) membre que je suis poste un deal ou une discussion</label>
								</div>
								<div class="sa_checkbox">
									<input id="member_notif_email" type="checkbox" name="member_notif_email" <?php echo ( filter_var( get_user_meta($uid, "member_notif_email")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="member_notif_email">Envoyez-moi aussi une notification par e-mail</label>
								</div>
							</div>
						</div>
						<hr>
						<div class="block">
							<h3>Messages</h3>
							<div class="sa_settings-checks">
								<div class="sa_checkbox">
									<input id="message_notif_email" type="checkbox" name="message_notif_email" <?php echo ( filter_var( get_user_meta($uid, "message_notif_email")[0], FILTER_VALIDATE_BOOLEAN) ) ? 'checked="checked"' : ''; ?>>
									<label for="message_notif_email">Envoyez-moi aussi une notification par e-mail</label>
								</div>
							</div>
						</div>
					</div>
					<script>
						jQuery(function ($) {
							$('.sa_checkbox input').on('change', function(e){
								$.ajax({
									type : "post",
									dataType : "json",
									url : myAjax.ajaxurl,
									data : {
										action: "sa_settings",
										name: $(this).attr('name'),
										value: $(this).is(':checked'),
										nonce: $('.sa_page-settings').data('nonce'),
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
						});
					</script>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.sa_page-settings > .container > .row {
		display: flex;
		align-content: stretch;
	}

	.sa_page-settings {
		background: #e9eaed;
	}

	.sa_page-settings  > .container > .row > div.right-side {
		background: #fff;
	}

	.sa_page-settings  > .container > .row > div {
		padding: 2rem 0;
	}

	.sa_page-settings  > .container > .row h2.heading {
		padding: 0 2.4rem;
		font-weight: bold;
		color: #000;
		margin-bottom: 2rem;
	}

	nav.sa_settings-nav {
		display: flex;
		flex-direction: column;
	}

	nav.sa_settings-nav > a {
		color: #f58936;
		font-size: 2rem;
		font-weight: bold;
		line-height: 5.5rem;
		padding: 0 2.5rem;
		display: flex;
		align-items: center;
	}

	nav.sa_settings-nav > a.active {
		background: #fff;
		color: #5a5d62;
		border-radius: 5px 0 0 5px;
	}

	nav.sa_settings-nav > a > i {
		padding-right: .75rem;
		font-size: 120%;
	}

	.sa_page-settings .row > div.right-side .block {
		display: flex;
		padding: 0 2.5rem;
	}

	.sa_page-settings .row > div.right-side .block > h3 {
		color: #000;
		font-weight: bold;
		flex: 0 0 42%;
	}

	.sa_page-settings .row > div.right-side .block > div {
		display: flex;
		flex-direction: column;
	}
	.sa_settings-tabs > *:not(.active) {
		display: none;
	}
	.sa_page-settings .row > div.right-side .block > div > .sa_checkbox:not(:last-child) {margin-bottom: 1rem;}
</style>
<?php

														 } else {

	//adforest_user_not_logged_in();     

	$app_key  =  $app_id  = $sender_id   =  $project_id   =   "";
	$is_firebase    =  $adforest_theme['sb_phone_verification_firebase']  ?  $adforest_theme['sb_phone_verification_firebase'] : false;
	if($is_firebase){ 

		wp_enqueue_script('firebase-app', "https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js", false, false, true);
		wp_enqueue_script('firebase-analytics', "https://www.gstatic.com/firebasejs/8.3.2/firebase-analytics.js", false, false, true);
		wp_enqueue_script('firebase-auth', "https://www.gstatic.com/firebasejs/8.3.2/firebase-auth.js", false, false, false);
		wp_enqueue_script('firebase-custom', trailingslashit(get_template_directory_uri()) . 'js/firebase-custom.js', array(), false, false);


		$app_key       =    isset($adforest_theme['sb_firebase_apikey']) &&  $adforest_theme['sb_firebase_apikey']!= ""  ?    $adforest_theme['sb_firebase_apikey']   : "";
		$project_id    =    isset($adforest_theme['sb_firebase_projectId']) &&  $adforest_theme['sb_firebase_projectId']!= ""  ?    $adforest_theme['sb_firebase_projectId']   : "";
		$sender_id     =    isset($adforest_theme['sb_firebase_messagingSenderId']) &&  $adforest_theme['sb_firebase_messagingSenderId']!= ""  ?    $adforest_theme['sb_firebase_messagingSenderId']   : "";
		$app_id        =    isset($adforest_theme['sb_firebase_appId']) &&  $adforest_theme['sb_firebase_appId']!= ""  ?    $adforest_theme['sb_firebase_appId']   : "";


	}


?>

<?php echo $profile->adforest_profile_full_top(); ?>
<?php echo $profile->adforest_profile_full_body(); ?>

<?php
}
?>
<!-- Main Container End -->
<input type="hidden"   id="sb-fb-apikey" value= "<?php esc_attr($app_key); ?>"> 
<input type="hidden"   id="sb-fb-projectid"   value= "<?php esc_attr($project_id); ?>"> 
<input type="hidden"   id="sb-fb-senderid"   value= "<?php esc_attr($sender_id); ?>"> 
<input type="hidden"   id="sb-fb-appid"    value= "<?php esc_attr($app_id); ?>"> 
<?php
echo sa_message_popup($author_id);
get_footer();
?>