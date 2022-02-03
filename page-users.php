<?php
/* Template Name: All Seller/Buyer */
/**
 * The template for displaying Pages.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package Adforest
 */
?>
<?php get_header(); ?>
<div class="main-content-area clearfix">
    <section class="description-animated-section">
        <div class="container">
            <div class="row">
                <?php get_sidebar('ad_users'); ?>
                <div class="col-md-9 col-lg-9 col-xs-12">
                    <div class="row">
                       <?php
                        global $adforest_theme;
                        $result = count_users();
                        $total_users = isset($result['total_users']) ? $result['total_users'] : 50;

                        $user_style = isset($adforest_theme['sb_all_user_style']) ? $adforest_theme['sb_all_user_style'] : "1";
                        if (!function_exists('adforest_author_page_number_query_vars')) {

                            function adforest_author_page_number_query_vars($qvars) {
                                $qvars[] = 'page-number';
                                return $qvars;
                            }

                        }
                        add_filter('query_vars', 'adforest_author_page_number_query_vars');

                        // grab the current page number and set to 1 if no page number is set
                        if (function_exists('adforest_comments_pagination2')) {
                            $page = ( isset($_GET['page-number'])) ? $_GET['page-number'] : 1;
                        } else {
                            $page = (get_query_var('page')) ? get_query_var('page') : 1;
                        }

                        // how many users to show per page
                        $users_per_page = isset($adforest_theme['users_per_page']) ? $adforest_theme['users_per_page'] : 12;

                        // calculate the total number of pages.
                        $total_pages = 1;
                        $offset = $users_per_page * ($page - 1);
                        $total_pages = ceil($total_users / $users_per_page);

                        $title = isset($_GET['user_title']) ? $_GET['user_title'] : "";

                        $rating = isset($_GET['rating']) ? $_GET['rating'] : "";

                        $rating_query = "";

                        if ($rating != "") {
                            $rating_query = array(
                                "key" => "_adforest_rating_avg",
                                "value" => $rating,
                                "compare" => "=",
                            );
                        }                                           
                        $order   =   isset($_GET['sort'])   ? ($_GET['sort'])   : "ASC";
                        // main user query
                        $args = array(
                            // order results by display_name
                            'search' => $title,
                            'order' => $order,
                            'orderby' => 'display_name',
                            'number' => $users_per_page,
                            'offset' => $offset, // skip the number of users that we have per page  
                            "meta_query" => array(
                                $rating_query
                            )
                        );

                        // Create the WP_User_Query object
                        $wp_user_query = new WP_User_Query($args);
                        $users = $wp_user_query->get_results();
                        $all_user = $wp_user_query->get_total();
                        
                        
                        $all_user = count($users);
                        $counter = 1;                                 
                        ?>
                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                            <div class="clearfix"></div>
                            <div class="listingTopFilterBar">
                                <div class="col-md-7 col-xs-12 col-sm-7 no-padding">
                                    <ul class="filterAdType">
                                        <li class="active"><span class="filterAdType-count"><?php echo esc_html('Total User', 'adfrest') ?><small> <?php echo esc_html($all_user); ?></small></span></li>
                                        <li class=""><a class="filterAdType-count" href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo esc_html__('Reset Search', 'adforest') ?></a></li>
                                    </ul>
                                </div>
                                <div class="col-md-5 col-xs-12 col-sm-5 no-padding">
                            <div class="header-listing">
                                <h6>Sort by : </h6>
                                <div class="custom-select-box pull-right">
                                                                        <form method="get">
                            <select name="sort" id="user_order_by" class="custom-select order_by select2-hidden-accessible" data-select2-id="order_by" tabindex="-1" aria-hidden="true">
                                                         
                                <option value="asc"  <?php echo adforest_returnEcho($order == "asc" ?  "selected" : ""); ?>>A-Z</option>
                                <option value="desc" <?php echo adforest_returnEcho($order == "desc" ?  "selected" : "") ?>>Z-A</option>
                              
                            </select>
                                                                            </form>                                      
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>



                        <?php
// Get the results
                        
                        foreach ($users as $user) {
                            $user_pic = adforest_get_user_dp($user->ID, 'adforest-user-profile');
                            $user_type = '';
                            $cls = '';
                            if (get_user_meta($user->ID, '_sb_user_type', true) == 'Indiviual') {
                                $user_type = __('Individual', 'adforest');
                                $cls = 'h-ribbon-ind';
                            } else if (get_user_meta($user->ID, '_sb_user_type', true) == 'Dealer') {
                                $user_type = __('Dealer', 'adforest');
                                $cls = 'h-ribbon';
                            }

                            $ribbon_html = '';
                            $style2_ribbon = '';
                            if ($user_type != "") {
                                $ribbon_html = '<div class="' . esc_attr($cls) . '"><span>' . $user_type . '</span></div>';

                                $style2_ribbon = '<span class="theme-custom-ribbon"> ' . $user_type . ' </span>';
                            }

                            $username = $user->display_name;
                            if ($username == "") {
                                $username = $user->user_login;
                            }

                            $user_address = get_user_meta($user->ID, '_sb_address', true);

                            $user_twitter = get_user_meta($user->ID, '_sb_profile_twitter', true);
                            $user_linkedin = get_user_meta($user->ID, '_sb_profile_linkedin', true);
                            $user_insta = get_user_meta($user->ID, '_sb_profile_instagram', true);
                            $user_facebook = get_user_meta($user->ID, '_sb_profile_facebook', true);

                            $unable_social = isset($adforest_theme['sb_enable_social_links']) ? $adforest_theme['sb_enable_social_links'] : false;

                            $no_social    =   "yes";
                            
                            if($user_twitter == ""  && $user_linkedin  == ""  && $user_insta == ""  &&  $user_facebook == ""){
                                
                                $no_social   =  "no";  
                                
                            }
                            if ($user_style == "1") {
                                ?>
                          <div class="col-lg-3 col-sm-6">
                                    <div class="description-main-product">
                                        <div class="description-box">
                                            <?php echo adforest_returnEcho($ribbon_html); ?>
                                            <a href="<?php echo adforest_set_url_param(get_author_posts_url($user->ID), 'type', 'ads'); ?>"><img src="<?php echo esc_attr($user_pic); ?>" alt="<?php echo esc_attr($user->display_name); ?>" class="img-responsive"></a>
                                        </div>
                                        <div class="description-heading-product">
                                            <?php ?>
                                            <h2><a href="<?php echo adforest_set_url_param(get_author_posts_url($user->ID), 'type', 'ads'); ?>"><?php echo esc_html($username); ?></a></h2>
                                        </div>
                                        <div class="paralell-box-description">
                                            <div class="product-icon-description-icons">
                                                <a href="<?php echo adforest_set_url_param(get_author_posts_url($user->ID), 'type', 1); ?>">
                                                    <?php
                                                    $got = get_user_meta($user->ID, "_adforest_rating_avg", true);

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
                                                    $ratings = adforest_get_all_ratings($user->ID);
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="description-short-text">
                                                <?php echo esc_html(count($ratings) . " " . __('Reviews', 'adforest')); ?>
                                            </div>
                                        </div>
                                        <div class="description-social-media-icons">
                                            <?php
                                            $profiles = adforest_social_profiles();
                                            foreach ($profiles as $key => $value) {
                                                if (get_user_meta($user->ID, '_sb_profile_' . $key, true) != "") {
                                                    echo '<a href="' . esc_url(get_user_meta($user->ID, '_sb_profile_' . $key, true)) . '" target="_blank"><i class="fa fa-' . $key . '"></i></a>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } else {
                                ?>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-30 grid-item adforest-user">
                                    <div class="bg-autoh2 bgclr-white seller bx-shadow2"> 
                                        <?php echo adforest_returnEcho($style2_ribbon) ?>
                                        <div class="upper-contain">
                                            <div class="seller-thumb-img">
                                                <a href="<?php echo adforest_set_url_param(get_author_posts_url($user->ID), 'type', 'ads'); ?>"><img src="<?php echo esc_attr($user_pic); ?>" class="img-fluid  wp-post-image" alt="<?php echo esc_attr($user->display_name); ?>"   width="120" height="120"></a>
                                            </div>
                                            <div class="all-content-area text-center">
                                                <h2 class="m-2">
                                                    <a class="clr-black" href="<?php echo adforest_set_url_param(get_author_posts_url($user->ID), 'type', 'ads'); ?>"><?php echo esc_html($username); ?></a>
                                                </h2>
                                                <?php if ($user_address != "") { ?>
                                                    <p><i class="fas fa-location-arrow clr-yal" aria-hidden="true"></i> <?php echo esc_html($user_address) ?></p>

                                                <?php } ?>
                                                <span class="ratings">


                                                    <?php
                                                    $got = get_user_meta($user->ID, "_adforest_rating_avg", true);

                                                    $total = 0;
                                                    if ($got == "")
                                                        $got = 0;
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= round($got))
                                                            echo '<i class="fas fa-star color" aria-hidden="true"></i>';
                                                        else
                                                            echo '<i class="fas fa-star" aria-hidden="true"></i>';

                                                        $total++;
                                                    }
                                                    $ratings = adforest_get_all_ratings($user->ID);
                                                    ?>


                                                    <span class="rating-avg"><?php echo esc_html(count($ratings) . " " . __('Reviews', 'adforest')); ?></span></span>

                                                <?php if ($unable_social && $no_social  == "yes") { ?>
                                                    <ul class="listing-owner-social">
                                                        <?php
                                                        if ($user_facebook != "") {
                                                            echo '<li><a target="_blank"   href="' . $user_facebook . '"><i class="fab fa-facebook-f"></i></a></li>';
                                                        }
                                                        if ($user_linkedin != "") {
                                                            echo '<li><a target="_blank"   href="' . $user_linkedin . '"><i class="fab fa-linkedin-in"></i></a></li>';
                                                        }
                                                        if ($user_insta != "") {
                                                            echo '<li><a target="_blank"   href="' . $user_insta . '"><i class="fab fa-instagram"></i></a></li>';
                                                        }
                                                        if ($user_twitter != "") {
                                                            echo '<li><a target="_blank"   href="' . $user_twitter . '"><i class="fab fa-twitter"></i></a></li>';
                                                        }
                                                        ?>
                                                    </ul>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="seller-detail"> <a href="<?php echo adforest_set_url_param(get_author_posts_url($user->ID), 'type', 'ads'); ?>">  <?php echo esc_html__('View Profile', 'adforest') ?> </a> </div>
                                    </div>
                                </div>


                                <?php
                            }
                      if ($counter % 4 == 0 && $user_style == "1") {
                                echo('<div class="clearfix"></div>');
                            }
                            $counter++;
                        }
                        if (function_exists('adforest_comments_pagination2')) {
                            ?>
                            <div class="col-md-12 col-xs-12 col-sm-12 margin-top-20"><?php echo adforest_comments_pagination2($total_pages, $page); ?> </div>
                            <?php
                        } else {
                            ?>
                            <div class="col-md-12 col-xs-12 col-sm-12 margin-top-20"><?php echo adforest_comments_pagination($total_pages, $page); ?> </div>
                            <?php
                        }
                        ?>

                    </div>      
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>