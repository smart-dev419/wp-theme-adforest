<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFive">
        <h4 class="panel-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive"><i class="more-less glyphicon glyphicon-plus"></i><?php echo esc_html($titlee = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title'])); ?></a></h4>
    </div>
    <?php
    if (isset($instance['open_widget']) && $instance['open_widget'] == '1') { $expand = 'in'; }
    global $wp;
    
    ?>
    <form method="get" action="<?php echo get_the_permalink()?>" >
        <div id="collapseFive" class="panel-collapse collapse <?php echo esc_attr($expand); ?>" role="tabpanel" aria-labelledby="headingFive">
            <div class="panel-body">
                <div class="search-widget">
                    <input placeholder="<?php echo __('search', 'adforest'); ?>" type="text" name="user_title" value="<?php echo esc_attr($title); ?>" autocomplete="off"><button type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <?php
        echo adforest_search_params('user_title');
        ?>
    </form>
</div>