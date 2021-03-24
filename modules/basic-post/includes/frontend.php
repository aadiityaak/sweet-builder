<?php
global $post, $postview;
$i = 0;
$title = $settings->title;
$categories = $settings->categories;
$posts_per_page = $settings->posts_per_page;
$order = $settings->order;
$post_style = $settings->post_style;
$excerpt = $settings->excerpt;
$orderby = 
    $order == 'datedesc' ? ['date','desc','']: 
    ($order == 'datedasc' ? ['date','asc','']: 
        ($order == 'titledesc' ? ['title','desc','']:
            ($order == 'titleasc' ? ['title','asc','']:
                ($order == 'trending' ? ['meta_value_num','desc','view_count']: 
                ['date','desc','']
            )
        ))
    );

echo '<div class="basic-post basic-post-'.$id.'">';
    echo '<div class="basic-post-title mb-3"><h3>'.$title.'</h3></div>';
    echo '<div class="content">';
        $args = [
            'cat' => $categories,
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby[0],
            'order' => $orderby[1],
        ];
        if($orderby[2]){
            $args['meta_key'] = $orderby[2];
        }
        $query = new WP_Query($args
            );
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                
                $query->the_post();
                echo FL_Sweet_Builder_Loader::$post_style(300,200,$excerpt);
            }
        } else {
            // no posts found
        }
        /* Restore original Post Data */
        wp_reset_postdata();
        echo '</div>';
echo '</div>';