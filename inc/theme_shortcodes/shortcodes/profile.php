<?php

/* ------------------------------------------------ */
/* Profile */
/* ------------------------------------------------ */
if (!function_exists('profile_short')) {

    function profile_short() {
        vc_map(array(
            "name" => __("User Profile", 'adforest'),
            "base" => "profile_short_base",
            "category" => __("Theme Shortcodes", 'adforest'),
            "params" => array(
                array(
                    'group' => __('Profile View', 'adforest'),
                    'type' => 'custom_markup',
                    'heading' => __('Profile View', 'adforest'),
                    'param_name' => 'order_field_key',
                    'description' => adforest_VCImage('profile_view.png') . __('Ouput of the Element will be look like this.', 'adforest'),
                ),
               // adforest_generate_type(__('Prolfile Layout', 'adforest'), 'dropdown', 'profile_layout', '', "", array("Please select" => "", "Profile 1" => "p1", "Profile 2" => "p2")),
            ),
        ));
    }

}

add_action('vc_before_init', 'profile_short');
if (!function_exists('profile_short_base_func')) {

    function profile_short_base_func($atts, $content = '') {
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
        
       
        return '<section class="section-padding bg-gray" >
                    <!-- Main Container -->
                    <div class="container">
                       ' . $profile->adforest_profile_full_top() . '
                       <br>
                       ' . $profile->adforest_profile_full_body() . '
                    </div>
                    <!-- Main Container End -->
                 <input type="hidden"   id="sb-fb-apikey" value= "'.$app_key.'"> 
                 <input type="hidden"   id="sb-fb-projectid"   value= "'.$project_id.'"> 
                 <input type="hidden"   id="sb-fb-senderid"   value= "'.$sender_id.'"> 
                 <input type="hidden"   id="sb-fb-appid"    value= "'.$app_id.'"> 

                 </section>';
    }

}

if (function_exists('adforest_add_code')) {
    adforest_add_code('profile_short_base', 'profile_short_base_func');
}