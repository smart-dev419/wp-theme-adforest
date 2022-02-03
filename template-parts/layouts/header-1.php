<?php
global $adforest_theme, $notification_text;
$class = 'colored-header';
if (isset($adforest_theme['design_type']) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['sb_header']) && $adforest_theme['sb_header'] == 'transparent' && is_page_template('page-home.php'))
	$class = 'transparent-header';

$msg_count = 0;
if (isset($adforest_theme['sb_top_bar'])  && !$adforest_theme['sb_top_bar']) { return; }
$sb_sign_in_page    =   isset($adforest_theme['sb_sign_in_page'])  ?  $adforest_theme['sb_sign_in_page'] :  "";
$sb_profile_page     =   isset($adforest_theme['sb_profile_page'])  ?  $adforest_theme['sb_profile_page']   :  "";
$sb_sign_in_page = apply_filters('adforest_language_page_id', $sb_sign_in_page);
$sb_profile_page = apply_filters('adforest_language_page_id', $sb_profile_page);

$user_id = get_current_user_id();
$author = get_user_by('ID', $user_id);
$current_user_pic = adforest_get_user_dp(get_current_user_id(), 'adforest-user-profile');
?>
<div class="<?php echo esc_attr($class); ?>">
	<div class="sb-white-header">
		<nav id="menu-1" class="mega-menu">
			<section class="menu-list-items">
				<div class="container">
					<div class="row">
						<div class="sa-header-row col-md-12 col-sm-12 col-xs-12">
							<ul class="menu-logo">
								<li><?php get_template_part('template-parts/layouts/site', 'logo'); ?></li>
							</ul>
							<?php get_template_part('template-parts/layouts/main', 'nav'); ?>
							<div class="sa-search">
								<div class="sa-search-input" data-nonce="<?php echo esc_attr(wp_create_nonce("sa_search")); ?>">
									<i class="fa fa-search"></i>
									<input type="text" name="q" placeholder="Recherche..." autocomplete="off"  />
									<button class="sa_close"><i class="fa fa-times"></i></button>
								</div>
								<div class="sa-search-results">
									<div class="most-searched search-block active">
										<header>
											<span>Recherches frequentes</span>
											<a href="#">Voir plus</a>
										</header>
										<?php

										$cats = get_terms( 
											array(
												'taxonomy' => 'ad_cats',
												'orderby' => 'name',
												'order'   => 'ASC',
												'hide_empty' => 1,
											) 
										);
										/* Widget Content */
										echo "<ul id='sa-cats-slider'>";
										foreach ($cats as $key => $cat) { // Loop Social Media Data
											$thumb_id = get_term_meta ( $cat->term_id, 'category-image-id', true );
											if (!empty($thumb_id)) {
												echo "<li>";
												echo "<a href='".esc_url( get_category_link( $cat->term_id ) )."'>";
												echo wp_get_attachment_image ( $thumb_id, array(150, 150), array('alt' => $cat->name) );
												echo "<div><span class='title'>".$cat->name."</span>";
												echo "<span class='count'>".$cat->count." deals</span></div>";
												echo "</a>";
												echo "</li>";
											}
										}
										echo "</ul>";

										?>
									</div>
									<div class="groups search-block"></div>
									<div class="deals search-block"></div>
									<div class="users search-block"></div>
								</div>
							</div>
							<ul class="menu-right-bar">
								<?php
								if (!is_user_logged_in()) {
								?>
								<li class="sb-new-sea-green">
									<button id="btn_register_login" class="btn btn-primary" type="button" data-toggle="modal" data-target=".login-popup">
										<i class="fa fa-user"></i> Connexion
									</button>
								</li>
								<?php
								} else {
									$user_id = get_current_user_id();
									$user_info = get_userdata($user_id);
									if (isset($adforest_theme['communication_mode']) && ($adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message')) {
								?>
								
								<li class="dropdown sa-con-btn sb-notify-div"> 
									<a class="dropdown-toggle btn btn-icon" data-toggle="dropdown" href="#" aria-expanded="true">
										<i class="fa fa-envelope"></i>
										<?php
										$unread_msgs = ADFOREST_MESSAGE_COUNT;
										if ($unread_msgs > 0) {
											$msg_count = $unread_msgs; 
										?><div class="sb-notify"><?php echo $msg_count; ?></div><?php 
										} 
										?>
									</a>
									<ul class="dropdown-menu sb-mailbox ">
										<li class="header">
											<span><i class="fa fa-bell"></i>&nbsp;Messages (<?php echo $unread_msgs ; ?>)</span>
											<button class="close"><i class="fa fa-times"></i></button>
										</li>
										<li>
											<div class="sb-message-center">
												<?php
										if ( $unread_msgs == 0) {
												?>
												<div class="no-notifs">
													<img src="https://www.dealabs.com/assets/img/support-images/blank_9fec7.svg"/>
													<span>Aucune Messages.</span>
												</div>
												<?php
										}
										if ($unread_msgs > 0) {

											$notes = $wpdb->get_results("SELECT * FROM $wpdb->commentmeta WHERE comment_id = '$user_id' AND  meta_value = 0 ORDER BY meta_id DESC LIMIT 5", OBJECT);
											if (count($notes) > 0) {
												foreach ($notes as $note) {
													$ad_img = adforest_get_ad_default_image_url('adforest-single-small');
													$get_arr = explode('_', $note->meta_key);
													$ad_id = $get_arr[0];
													$media = adforest_get_ad_images($ad_id);
													if (count($media) > 0) {
														$counting = 1;
														foreach ($media as $m) {
															if ($counting > 1) {
																$mid = '';
																if (isset($m->ID)) $mid = $m->ID;
																else $mid = $m;
																$image = wp_get_attachment_image_src($mid, 'adforest-single-small');
																if ($image[0] != "") $ad_img = $image[0];
																break;
															}
															$counting++;
														}
													}
													$action = get_the_permalink($sb_profile_page) . '?sb_action=sb_get_messages' . '&ad_id=' . $ad_id . '&user_id=' . $user_id . '&uid=' . $get_arr[1];
													$poster_id = get_post_field('post_author', $ad_id);
													if ($poster_id == $user_id)
														$action = get_the_permalink($sb_profile_page) . '?sb_action=sb_load_messages' . '&ad_id=' . $ad_id . '&uid=' . $get_arr[1];
													$user_data = get_userdata($get_arr[1]);
													$user_pic = '';
													if (function_exists('adforest_get_user_dp')) {
														$user_pic = adforest_get_user_dp($get_arr[1]);
													}
												?>
												<a href="<?php echo esc_url($action); ?>">
													<div class="user-img"> <img src="<?php echo esc_url($current_user_pic); ?>" alt="<?php echo adforest_returnEcho($user_data->display_name); ?>" width="30" height="50"> </div>
													<div class="sb-mail-contnet">
														<h5><?php echo adforest_returnEcho($user_data->display_name) ?></h5> <span class="mail-desc"><?php echo get_the_title($ad_id); ?></span>
													</div>
												</a>
												<?php
												} 
											}
												?>
											</div>
										</li>
										<?php
											if ($unread_msgs > 0 && isset($adforest_theme['sb_notification_page']) && $adforest_theme['sb_notification_page'] != "") {
												$sb_notification_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_notification_page']);
										?>
										<li class="sb-all-notify">
											<a class="text-center" href="/author/<?php echo $author->user_login ?>?type=messages"><strong><?php echo __('See all messages', 'adforest'); ?></strong>
												<i class="fa fa-angle-right"></i>
											</a>
										</li>
										<?php
											}
										}
										?>
									</ul>
								</li>
								<?php
									$unread_notifs = 0;
									$browser_notif_message = filter_var( get_user_meta($user_id, "browser_notif_message")[0], FILTER_VALIDATE_BOOLEAN);
									$browser_notif_heats = filter_var( get_user_meta($user_id, "browser_notif_heats")[0], FILTER_VALIDATE_BOOLEAN);
									$alert_notif_heats = filter_var( get_user_meta($user_id, "alert_notif_heats")[0], FILTER_VALIDATE_BOOLEAN);
									$deal_notif_vote = filter_var( get_user_meta($user_id, "deal_notif_vote")[0], FILTER_VALIDATE_BOOLEAN);
									$deal_notif_comment = filter_var( get_user_meta($user_id, "deal_notif_comment")[0], FILTER_VALIDATE_BOOLEAN);
									$deal_notif_hot = filter_var( get_user_meta($user_id, "deal_notif_hot")[0], FILTER_VALIDATE_BOOLEAN);
									$deal_notif_expire = filter_var( get_user_meta($user_id, "deal_notif_expire")[0], FILTER_VALIDATE_BOOLEAN);
									$deal_notif_post_expire = filter_var( get_user_meta($user_id, "deal_notif_post_expire")[0], FILTER_VALIDATE_BOOLEAN);
									$deal_notif_expire_reactive = filter_var( get_user_meta($user_id, "deal_notif_expire_reactive")[0], FILTER_VALIDATE_BOOLEAN);
									$subscribe_notif_comment = filter_var( get_user_meta($user_id, "subscribe_notif_comment")[0], FILTER_VALIDATE_BOOLEAN);
									$comment_notif_like = filter_var( get_user_meta($user_id, "comment_notif_like")[0], FILTER_VALIDATE_BOOLEAN);
									$comment_notif_approve = filter_var( get_user_meta($user_id, "comment_notif_approve")[0], FILTER_VALIDATE_BOOLEAN);
									$badge_notif_earn = filter_var( get_user_meta($user_id, "badge_notif_earn")[0], FILTER_VALIDATE_BOOLEAN);
									$member_notif_deal = filter_var( get_user_meta($user_id, "member_notif_deal")[0], FILTER_VALIDATE_BOOLEAN);

									$where_count = "";
									$where_list = "";
									if($alert_notif_heats){
										$where_list .= " type = '2' OR";
									}
									if($deal_notif_vote){
										$where_count .= " type = '3' OR";
										$where_list .= " type = '3' OR";
									}
									if($deal_notif_comment){
										$where_count .= " type = '4' OR";
										$where_list .= " type = '4' OR";
									}
									if($deal_notif_hot){
										$where_count .= " type = '5' OR";
										$where_list .= " type = '5' OR";
									}
									if($deal_notif_expire){
										$where_count .= " type = '6' OR";
										$where_list .= " type = '6' OR";
									}
									if($deal_notif_post_expire){
										$where_count .= " type = '7' OR";
										$where_list .= " type = '7' OR";
									}
									if($deal_notif_expire_reactive){
										$where_count .= " type = '8' OR";
										$where_list .= " type = '8' OR";
									}
									if($subscribe_notif_comment){
										$where_count .= " type = '9' OR";
										$where_list .= " type = '9' OR";
									}
									if($comment_notif_like){
										$where_count .= " type = '10' OR";
										$where_list .= " type = '10' OR";
									}
									if($comment_notif_approve){
										$where_count .= " type = '11' OR";
										$where_list .= " type = '11' OR";
									}
									if($badge_notif_earn){
										$where_count .= " type = '12' OR";
										$where_list .= " type = '12' OR";
									}
									if($member_notif_deal){
										$where_count .= " type = '13' OR";
										$where_list .= " type = '13' OR";
									}

									if(strlen($where_count) > 0){
										$where_count = substr($where_count, 0, -2);
									}

									if(strlen($where_list) > 0){
										$where_list = substr($where_list, 0, -2);
									}

									$table_name = $wpdb->prefix . "notification";

									$notes = $wpdb->get_results("SELECT * FROM ".$table_name." WHERE uid = '".get_current_user_id()."' AND state = 0 AND (".$where_count.") ORDER BY created_date DESC LIMIT 0, 5");

									$unread_notifs = count($notes);

								?>
								<li class="dropdown sa-con-btn sb-notify-div"> 
									<a class="dropdown-toggle btn btn-icon" data-toggle="dropdown" href="#" aria-expanded="true">
										<i class="fa fa-bell"></i>
										<?php
										if ($unread_notifs > 0) {
										?><div class="sb-notify"><?php echo $unread_notifs; ?></div><?php 
										} 
										?>
									</a>
									<ul class="dropdown-menu sb-mailbox ">
										<li class="header">
											<span><i class="fa fa-bell"></i>&nbsp;Notifications (<?php echo $unread_notifs; ?>)</span>
											<button class="close"><i class="fa fa-times"></i></button>
										</li>
										<li>
											<div class="sb-message-center">
												<?php
										
										if ( count($notes) == 0) {
												?>
												<div class="no-notifs">
													<img src="https://www.dealabs.com/assets/img/support-images/blank_9fec7.svg"/>
													<span>Aucune Notifications.</span>
												</div>
												<?php
										}

										if (count($notes) > 0) {
											foreach ($notes as $note) {
												$content = "";
												if($note->type == '2'){
										            $link = get_the_title($note->fid);
										            $content = sprintf($notification_text[$note->type - 1], $link);
										        }else if($note->type == '3'){
										            $user_info = get_userdata($note->tid);
										            $link1 = $user_info->display_name;
										            $link2 = get_the_title($note->fid);
										            $content = sprintf($notification_text[$note->type - 1], $link1, $link2);
										        }else if($note->type == '4'){
										            $user_info = get_userdata($note->tid);
										            $link1 = $user_info->display_name;
										            $link2 = get_the_title($note->fid);
										            $content = sprintf($notification_text[$note->type - 1], $link1, $link2);
										        }else if($note->type == '5'){
										            $link = get_the_title($note->fid);
										            $content = sprintf($notification_text[$note->type - 1], $link);
										        }else if($note->type == '6'){
										            $link = get_the_title($note->fid);
										            $content = sprintf($notification_text[$note->type - 1], $link);
										        }else if($note->type == '7'){
										            $link = get_the_title($note->fid);
										            $content = sprintf($notification_text[$note->type - 1], $link);
										        }else if($note->type == '8'){
										            $link = get_the_title($note->fid);
										            $content = sprintf($notification_text[$note->type - 1], $link);
										        }else if($note->type == '9'){
										            $user_info = get_userdata($note->tid);
										            $link1 = $user_info->display_name;
										            $link2 = get_the_title($note->fid);
										            $content = sprintf($notification_text[$note->type - 1], $link1, $link2);
										        }else if($note->type == '10'){
										            $user_info = get_userdata($note->tid);
										            $link1 = $user_info->display_name;
										            $link2 = get_the_title($note->fid);
										            $content = sprintf($notification_text[$note->type - 1], $link1, $link2);
										        }else if($note->type == '11'){
										            $link = get_the_title($note->fid);
										            $content = sprintf($notification_text[$note->type - 1], $link);
										        }else if($note->type == '12'){
										            $content = $notification_text[$note->type - 1];
										        }else if($note->type == '13'){
										            $user_info = get_userdata($note->tid);
										            $link1 = $user_info->display_name;
										            $link2 = get_the_title($note->fid);
										            $content = sprintf($notification_text[$note->type - 1], $link1, $link2);
										        }
											?>
											<a href="/author/<?php echo $author->user_login ?>?type=notifications&id=<?php echo $note->id ?>">
												<div class="sb-mail-contnet">
													<h5><?php echo $content ?></h5>
												</div>
											</a>
											<?php
											} 
										}
									?>
											</div>
										</li>
										<?php
											if ($unread_notifs > 0 && isset($adforest_theme['sb_notification_page']) && $adforest_theme['sb_notification_page'] != "") {
												$sb_notification_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_notification_page']);
										?>
										<li class="sb-all-notify">
											<a class="text-center" href="/author/<?php echo $author->user_login ?>?type=notifications"><strong><?php echo __('See all notifications', 'adforest'); ?></strong>
												<i class="fa fa-angle-right"></i>
											</a>
										</li>
										<?php
											}
										?>
									</ul>
								</li>
								<?php } ?>
								<li class="user-dropdown dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<img src="<?php echo esc_url($current_user_pic); ?>" class="avatar">
									</a>
									<ul class="dropdown-menu sb-top-dropdown">
										<?php echo apply_filters('adforest_vendor_dashboard_profile', '', $user_id); ?>
										<li><?php echo adforest_returnEcho($user_info->display_name); ?></li>
										<li><a href="/author/<?php echo $author->user_login; ?>"><i class="fa fa-user"></i>Aperçu de l'activité </a></li>
										<li><a href="/author/<?php echo $author->user_login; ?>?type=badges"><i class="fa fa-star"></i>Mes badges</a></li>
										<li><a href="/author/<?php echo $author->user_login; ?>?type=deals"><i class="fa fa-tag"></i>Deals postés </a></li>
										<li><a href="/author/<?php echo $author->user_login; ?>?type=saved"><i class="fa fa-bookmark"></i>Deals sauvegardés</a></li>
										<li><a href="/author/<?php echo $author->user_login; ?>?type=notifications"><i class="fa fa-bell"></i>Mes alertes</a></li>
										<li><a href="/author/<?php echo $author->user_login; ?>?type=settings&tab=profile"><i class="fa fa-cog"></i>Paramètres </a></li>
										<li><a href="<?php echo wp_logout_url(get_the_permalink($sb_sign_in_page)); ?>"><i class="fa fa-sign-out"></i>Déconnexion</a></li>
									</ul>
								</li>
								<?php } ?>
								<li class="post-submenu">
									<a class="btn btn-light"><i class="custom fa fa-plus"></i>Poster...</a>
									<ul>
										<?php if (is_user_logged_in()) : ?>
										<li><a href="/post-ad?type=deal"><i class="fa fa-tag"></i>&nbsp;Deal</a></li>
										<li><a href="/post-ad?type=coupon"><i class="fa fa-scissors"></i>&nbsp;Code Promo</a></li>
										<li><a href="/post-discussion"><i class="fa fa-comments"></i>&nbsp;Discussion</a></li>
										<?php else : ?>
										<li><a href="javascript:void(0);" data-toggle="modal" data-target=".login-popup"><i class="fa fa-tag"></i>&nbsp;Deal</a></li>
										<li><a href="javascript:void(0);" data-toggle="modal" data-target=".login-popup"><i class="fa fa-scissors"></i>&nbsp;Code Promo</a></li>
										<li><a href="javascript:void(0);" data-toggle="modal" data-target=".login-popup"><i class="fa fa-comments"></i>&nbsp;Discussion</a></li>
										<?php endif; ?>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
		</nav>
	</div>
</div>