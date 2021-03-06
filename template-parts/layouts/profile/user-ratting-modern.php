<?php
global $adforest_theme;
if (isset($adforest_theme['sb_enable_user_ratting']) && !$adforest_theme['sb_enable_user_ratting']) {
    return;
}
wp_enqueue_style('star-rating', trailingslashit(get_template_directory_uri()) . 'css/star-rating.css');
wp_register_script('star-rating', trailingslashit(get_template_directory_uri()) . 'js/star-rating.js', false, false, true);
wp_enqueue_script('star-rating');

$author_id = get_query_var('author');
$author = get_user_by('ID', $author_id);
$user_pic = adforest_get_user_dp($author_id, 'adforest-user-profile');
?>
<section class="seller-public-profile section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <?php
                    require trailingslashit(get_template_directory()) . 'template-parts/layouts/profile/profile-header.php';
                    ?>
                    <div class="seller-description">
                    <div class="seller-profile-contains">
                       
                            <h3 class="main-title text-left"><?php echo __('Total Rating', 'adforest'); ?> (<?php echo count($ratings); ?>)</h3>
                        
                        <?php
                        if (count($ratings) > 0) {
                            ?>
                            <div class="rating_comments">
                                <ol class="comment-list">
                                    <?php
                                    foreach ($ratings as $rating) {
                                        $data = explode('_separator_', $rating->meta_value);
                                        $rated = $data[0];
                                        $comments = $data[1];
                                        $date = $data[2];
                                        $reply = '';
                                        $reply_date = '';
                                        if (isset($data[3])) {
                                            $reply = $data[3];
                                        }
                                        if (isset($data[4])) {
                                            $reply_date = $data[4];
                                        }
                                        $_arr = explode('_user_', $rating->meta_key);
                                        $rator = $_arr[1];
                                        $user = get_user_by('ID', $rator);
                                        ?>
                                        <li class="comment">
                                            <div class="comment-info">
                                                <a href="<?php echo adforest_set_url_param(get_author_posts_url($rator),'type','ads'); ?>"><img class="pull-left<?php echo is_rtl() ? ' flip' : '';?> hidden-xs img-circle" src="<?php echo adforest_get_user_dp($rator, 'adforest-user-profile'); ?>" alt="<?php echo esc_attr($user->display_name); ?>"></a>
                                                <div class="author-desc">
                                                    <div class="author-title"> <a href="<?php echo adforest_set_url_param(get_author_posts_url($rator),'type','ads'); ?>"><strong><?php echo esc_html($user->display_name); ?></strong></a>
                                                        <div class="rating">
                                                            <?php
                                                            for ($i = 1; $i <= 5; $i++) {
                                                                if ($i <= $rated)
                                                                    echo '<i class="fa fa-star"></i>';
                                                                else
                                                                    echo '<i class="fa fa-star-o"></i>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <ul class="list-inline">
                                                            <li><a href="javascript:void(0);"><?php echo date_i18n(get_option('date_format'), strtotime($date)); ?></a></li>
                                                            <?php
                                                            if ($author_id == get_current_user_id() && $reply == "") {
                                                                ?>
                                                                <li>
                                                                    <a href="javascript:void(0);" data-rator-id="<?php echo esc_attr($rator); ?>" data-rator-name="<?php echo esc_attr($user->display_name); ?>" class="clikc_reply" data-target="#rating_reply_modal" data-toggle="modal">
                                                                        <i class="fa fa-reply"></i> 
                                                                        <?php echo __('Reply', 'adforest'); ?>
                                                                    </a>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <p><?php echo esc_html($comments); ?></p>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                        if ($reply != "") {
                                            $user = get_user_by('ID', $author_id);
                                            ?>
                                            <li class="comment children">
                                                <div class="comment-info">
                                                    <img class="pull-left hidden-xs img-circle" src="<?php echo adforest_get_user_dp($user->ID, 'adforest-user-profile'); ?>" alt="<?php echo esc_attr($user->display_name); ?>">
                                                    <div class="author-desc">
                                                        <div class="author-title"> <strong><?php echo esc_html($user->display_name); ?></strong> 
                                                            <ul class="list-inline">
                                                                <li><a href="javascript:void(0);"><?php echo date_i18n(get_option('date_format'), strtotime($reply_date)); ?></a></li>
                                                            </ul>
                                                        </div>
                                                        <p><?php echo esc_html($reply); ?></p>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ol>
                            </div>



                            <?php
                        }
                        ?>
                    </div>
                    
                    <div class="public-link-provider">
                        <div class="listing-jobs-area">
                            <div class="review-form">
                               
                                    <h3 class="main-title text-left">
                                        <?php echo __('Post Your Comment', 'adforest'); ?>
                                    </h3>
                                
                                <div class="row">
                                    <form id="user_ratting_form" novalidate>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div dir="ltr">
                                                    <input id="input-21b" name="rating" value="1" type="text"  data-show-clear="false" <?php if (is_rtl()) { ?> dir="rtl"<?php } ?>class="rating" data-min="0" data-max="5" data-step="1" data-size="xs" required title="required">
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <div class="public-link-provider-1">
                                                <div class="form-group">
                                                    <label><?php echo __('Comments', 'adforest'); ?><span class="required">*</span></label>
                                                    <textarea cols="6" rows="6" class="form-control" id="sb_rate_user_comments" name="sb_rate_user_comments" data-parsley-required="true" data-parsley-error-message="<?php echo __('This field is required.', 'adforest'); ?>"></textarea>
                                                    <p><?php echo __('You can not edit it later.', 'adforest'); ?></small></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <input type="hidden" id="sb-user-rating-token" value="<?php echo wp_create_nonce('sb_user_rating_secure'); ?>" />
                                            <input class="btn btn-theme" value="<?php echo __('Post Your Comment', 'adforest'); ?>" type="submit">
                                            <input type="hidden" name="author" value="<?php echo esc_attr($author_id); ?>" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="seller-public-profile-left-section">
                    <?php
                    require trailingslashit(get_template_directory()) . 'template-parts/layouts/profile/contact_form.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="rating_reply_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header rte">
                <h2 class="modal-title"><?php echo __('Reply to', 'adforest'); ?>&nbsp;<span id="rator_name"></span></h2> 
            </div>
            <form id="sb-reply-rating-form">
                <div class="modal-body">
                    <div class="form-group">
                        <label><?php echo __('Comments', 'adforest'); ?> <span class="required">*</span>
                        </label>
                        <textarea class="form-control" rows="8" cols="6" id="sb_rate_user_comments" name="sb_rate_user_comments" data-parsley-required="true" data-parsley-error-message="<?php echo __('This field is required.', 'adforest'); ?>"></textarea>
                        <div><small><?php echo __('You can not edit it later.', 'adforest'); ?></small></div>
                        <br />
                        <button class="btn btn-theme btn-sm" type="submit">
                            <?php echo __('Post Your Reply', 'adforest'); ?>
                        </button>
                        <input type="hidden" id="rator_reply" name="rator_reply" value="0" />
                        <input type="hidden" id="sb-user-rate-reply-token" value="<?php echo wp_create_nonce('sb_user_rate_reply_secure'); ?>" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>












