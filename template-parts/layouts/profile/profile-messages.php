<?php
global $adforest_theme;  
$profile = new adforest_profile();
adforest_user_not_logged_in();     

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
<section class="section-padding bg-gray" >
	<!-- Main Container -->
	<div class="container">
		<?php echo $profile->adforest_profile_full_top(); ?>
		<br>
		<?php echo $profile->adforest_profile_full_body(); ?>
	</div>
	<!-- Main Container End -->
	<input type="hidden"   id="sb-fb-apikey" value= "<?php esc_attr($app_key); ?>"> 
	<input type="hidden"   id="sb-fb-projectid"   value= "<?php esc_attr($project_id); ?>"> 
	<input type="hidden"   id="sb-fb-senderid"   value= "<?php esc_attr($sender_id); ?>"> 
	<input type="hidden"   id="sb-fb-appid"    value= "<?php esc_attr($app_id); ?>"> 

</section>
<?php