<?php
global $post, $postview;
$i = 0;
$categories = $settings->categories;
$posts_per_page = $settings->posts_per_page; 
$slide_style = $settings->slide_style;
$posts_per_page = $slide_style == 'slide-1' ? ceil($posts_per_page / 5) * 5 : $posts_per_page;
$query = new WP_Query( 
    [
        'cat' => implode(',',$categories),
        'posts_per_page' => $posts_per_page
    ]);
$totals_post = $query->post_count;

echo '<div class="slide-container mb-3 slider-'.$id.'">';
    // The Loop
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {

            $i = $i < 5 ? $i+1 : 1;
            echo $i == 1 ? '<div class="slide-frame w-100">' : '';
            
                $query->the_post();
                $img = get_the_post_thumbnail_url(get_the_ID(),'large');
                echo '<div class="slide-content d-flex slide-'.$i.'" style="background-image:url('.$img.');">';
                    echo '<div class="p-3 mt-auto text-light">';
                        echo '<div class="mb-1"><small><i class="rounded-circle bg-danger p-1 px-2 fa fa-bolt text-white" aria-hidden="true"></i> '.get_the_date().'</small></div>';
                        echo '<h3 class="h4"><a class="judul-text text-white" href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
                        echo '<div class="content-excerpt"><a class="text-light" href="' . get_the_permalink() . '">'.FL_Sweet_Builder_Loader::excerpt(100).'</a></div>';
                    echo '</div>';
                echo '</div>';
            echo $i == 5 ? '</div>' : '';
            

        }
    } else {
        // no posts found
    }
    /* Restore original Post Data */
    wp_reset_postdata();
echo '</div>';