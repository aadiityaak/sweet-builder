<?php
global $post, $postview;
$i = 0;
$title = $settings->title;
$categories = $settings->categories;
$posts_per_page = $settings->posts_per_page;
$width = $settings->width;
$height = $settings->height;
$date = $settings->date;

echo '<div class="big-post big-post-'.$id.'">';
    echo '<div class="big-post-title mb-3"><h3>'.$title.'</h3></div>';
    echo '<div class="row">';
        echo '<div class="col-md-6 pr-md-1">';
            $query = new WP_Query(
                [
                    'cat' => $categories,
                    'posts_per_page' => round($posts_per_page/2)-2
                ]);
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    
                    $query->the_post();
                    if($i++ == 0){
                        echo FL_Sweet_Builder_Loader::post_style_1();
                    } else {
                        echo FL_Sweet_Builder_Loader::post_style_2($thumbwidth=300, $thumbheight=250, $excerpt=0, $date, $more=false, $more_text=null);
                    }
                }
            } else {
                // no posts found
            }
            /* Restore original Post Data */
            wp_reset_postdata();
        echo '</div>';
        echo '<div class="col-md-6">';
            $query = new WP_Query(
                [
                    'cat' => implode(',',$categories),
                    'posts_per_page' => round($posts_per_page/2)+2,
                    'offset' => round($posts_per_page/2)-2
                ]);
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    echo FL_Sweet_Builder_Loader::post_style_2($width, $height, $excerpt=0, $date, $more, $more_text);
                }
            } else {
                // no posts found
            }
            /* Restore original Post Data */
            wp_reset_postdata();
        echo '</div>';
    echo '</div>';
echo '</div>';