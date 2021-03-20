<?php
global $post, $postview;
$i = 0;
$title = $settings->title;
$categories = $settings->categories;
$posts_per_page = $settings->posts_per_page;

echo '<div class="big-post big-post-'.$id.'">';
    echo '<div class="big-post-title mb-3"><h3>'.$title.'</h3></div>';
    echo '<div class="content">';
        $query = new WP_Query(
            [
                'cat' => $categories,
                'posts_per_page' => $posts_per_page
            ]);
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                
                $query->the_post();
                echo FL_Sweet_Builder_Loader::post_style_2();
            }
        } else {
            // no posts found
        }
        /* Restore original Post Data */
        wp_reset_postdata();
        echo '</div>';
echo '</div>';