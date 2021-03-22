<?php
    global $post, $postview;
    $categories     = $settings->categories;
    $posts_per_page = $settings->posts_per_page; 
    $tab_style      = $settings->tab_style;
?>

<div class="fl-post-tabs">
    <?php 
    echo '<ul class="nav nav-'.$tab_style.'" id="nav-tab" role="tablist">';
        $i = 0;
        foreach($categories as $category){
            $slug       = get_term( $category )->slug;
            $j          = $i++;
            $active     = $j == 0 ? 'active' : '';
            $selected   = $j == 0 ? 'true' : 'false';
            $width      = count($categories) == 2 ? 'w-50' : '';
            echo '<li class="nav-item '.$width.'" role="presentation">';
                echo '<a class="nav-link btn btn-sm p-3 border-top-0 rounded-0 font-weight-bold '.$active.'" id="'.$tab_style.'-'.$slug.'-tab" data-toggle="pill" href="#'.$tab_style.'-'.$slug.'" role="tab" aria-controls="'.$tab_style.'-'.$slug.'" aria-selected="'.$selected.'">'.get_term( $category )->name.'</a>';
            echo '</li>';
        }
    echo '</ul>';
    ?>
    
    <div class="tab-content rounded-0 p-3" id="'.$tab_style.'-tabContent">
        <?php 
        $i = $n = 0;
        foreach($categories as $category){
            $slug   = get_term( $category )->slug;
            $active = $i++ == 0 ? 'show active' : '';
            echo '<div class="tab-pane n fade '.$active.'" id="'.$tab_style.'-'.$slug.'" role="tabpanel" aria-labelledby="'.$tab_style.'-'.$slug.'-tab">';
                
                echo '<div class="row">';
                    echo '<div class="col-md-6">';
                        //set category
                        $args = [
                            'category__in'      => $category,
                            'orderby'           => 'date',
                            'order'             => 'desc',
                            'posts_per_page'    => ($posts_per_page/2)-2
                        ];
                        // The Query
                        $query = new WP_Query( $args );
                        // The Loop
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            if($n++ == 0){
                                echo FL_Sweet_Builder_Loader::post_style_1();
                            } else {
                                echo FL_Sweet_Builder_Loader::post_style_2();
                            }
                        }
                        $n = 0;
                        // Reset Query
                        wp_reset_postdata();
                    echo '</div>';
                    echo '<div class="col-md-6">';
                        //set category
                        $args = [
                            'category__in'      => $category,
                            'orderby'           => 'date',
                            'order'             => 'desc',
                            'posts_per_page'    => round($posts_per_page/2)+2,
                            'offset'            => round($posts_per_page/2)-2
                        ];
                        // The Query
                        $query = new WP_Query( $args );
                        // The Loop
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            echo FL_Sweet_Builder_Loader::post_style_2();
                        }
                        // Reset Query
                        wp_reset_postdata();
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
        ?>
    </div>

</div>