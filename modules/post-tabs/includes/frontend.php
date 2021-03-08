<?php
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
            echo '<li class="nav-item" role="presentation">';
                echo '<a class="nav-link btn btn-sm mr-2 '.$active.'" id="'.$tab_style.'-'.$slug.'-tab" data-toggle="pill" href="#'.$tab_style.'-'.$slug.'" role="tab" aria-controls="'.$tab_style.'-'.$slug.'" aria-selected="'.$selected.'">'.get_term( $category )->name.'</a>';
            echo '</li>';
        }
    echo '</ul>';
    ?>
    
    <div class="tab-content" id="'.$tab_style.'-tabContent">
        <?php 
        $i = 0;
        foreach($categories as $category){
            $slug   = get_term( $category )->slug;
            $active = $i++ == 0 ? 'show active' : '';
            echo '<div class="tab-pane fade '.$active.'" id="'.$tab_style.'-'.$slug.'" role="tabpanel" aria-labelledby="'.$tab_style.'-'.$slug.'-tab">';
                //set category
                $args = array( 'category__in' => $category );
                // The Query
                $query = new WP_Query( $args );
                // The Loop
                while ( $query->have_posts() ) {
                    $query->the_post();
                    echo '<li>' . get_the_title() . '</li>';
                }
                // Reset Query
                wp_reset_postdata();
            echo '</div>';
        }
        ?>
    </div>

</div>