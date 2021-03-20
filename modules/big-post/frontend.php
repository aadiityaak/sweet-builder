<?php
global $post, $postview;
$i = 0;
$categories = $settings->categories;
$posts_per_page = $settings->posts_per_page; 
$posts_per_page = $posts_per_page;


echo '<div class="row">';
    echo '<div class="col-md-6">';
        $query = new WP_Query(
            [
                'cat' => implode(',',$categories),
                'posts_per_page' => $posts_per_page/2
            ]);
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                
                    $query->the_post();
                    $img = get_the_post_thumbnail_url(get_the_ID(),'large');
                    echo '<div class="slide-content d-flex slide-'.$i.'" style="background-image:url('.$img.');">';
                        echo '<div class="p-3 mt-auto text-light">';
                            echo '<div class="mb-1"><small><i class="rounded-circle bg-danger p-1 px-2 fa fa-bolt text-white" aria-hidden="true"></i> '.get_the_date().'</small></div>';
                            echo '<h3 class="h4"><a class="judul-text text-white" href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
                            echo '<div class="content-excerpt"><a class="text-light" href="' . get_the_permalink() . '">'.FL_Sweet_Builder_Loader::excerpt(100).'</a></div>';
                        echo '</div>';
                    echo '</div>';                

            }
        } else {
            // no posts found
        }
        /* Restore original Post Data */
        wp_reset_postdata();
    echo '</div>';
    echo '<div class="col-md-6">gggggggggggggggggg';
        $query = new WP_Query(
            [
                'cat' => implode(',',$categories),
                'posts_per_page' => $posts_per_page/2,
                'offset' => $posts_per_page/2
            ]);
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                
                    $query->the_post();
                    $img = get_the_post_thumbnail_url(get_the_ID(),'large');
                    echo '<div class="slide-content d-flex slide-'.$i.'" style="background-image:url('.$img.');">';
                        echo '<div class="p-3 mt-auto text-light">';
                            echo '<div class="mb-1"><small><i class="rounded-circle bg-danger p-1 px-2 fa fa-bolt text-white" aria-hidden="true"></i> '.get_the_date().'</small></div>';
                            echo '<h3 class="h4"><a class="judul-text text-white" href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
                            echo '<div class="content-excerpt"><a class="text-light" href="' . get_the_permalink() . '">'.FL_Sweet_Builder_Loader::excerpt(100).'</a></div>';
                        echo '</div>';
                    echo '</div>';

            }
        } else {
            // no posts found
        }
        /* Restore original Post Data */
        wp_reset_postdata();
    echo '</div>';
echo '</div>';
