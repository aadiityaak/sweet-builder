<?php
    global $post;
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
                echo '<a class="nav-link btn btn-sm mr-2 rounded-0 '.$active.'" id="'.$tab_style.'-'.$slug.'-tab" data-toggle="pill" href="#'.$tab_style.'-'.$slug.'" role="tab" aria-controls="'.$tab_style.'-'.$slug.'" aria-selected="'.$selected.'">'.get_term( $category )->name.'</a>';
            echo '</li>';
        }
    echo '</ul>';
    ?>
    
    <div class="tab-content border rounded-0 bg-white border-top-0 p-3" id="'.$tab_style.'-tabContent">
        <?php 
        $i = 0;
        foreach($categories as $category){
            $slug   = get_term( $category )->slug;
            $active = $i++ == 0 ? 'show active' : '';
            echo '<div class="tab-pane fade '.$active.'" id="'.$tab_style.'-'.$slug.'" role="tabpanel" aria-labelledby="'.$tab_style.'-'.$slug.'-tab">';
                //set category
                $args = [
                    'category__in'      => $category,
                    'posts_per_page'    => $posts_per_page
                ];
                // The Query
                $query = new WP_Query( $args );
                // The Loop
                while ( $query->have_posts() ) {
                    $query->the_post();
                    $hit = get_post_meta($post->ID, 'hit', true) ? get_post_meta($post->ID, 'hit', true) : '0';
                    echo '<div class="font-weight-bold"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></div>';
                    echo '<div class="row mb-2">';
                        echo '<div class="col-6"><i class="fa fa-calendar" aria-hidden="true"></i> ' . get_the_modified_date() . '</div>';
                        echo '<div class="col-6">Dilihat ' . $hit . ' Kali</div>';
                    echo '</div>';
                }
                // Reset Query
                wp_reset_postdata();
            echo '</div>';
        }
        ?>
    </div>

</div>