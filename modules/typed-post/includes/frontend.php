<?php
global $post, $postview;
$i = 0;
$title = $settings->title;
$categories = $settings->categories;
$posts_per_page = $settings->posts_per_page;
$order = $settings->order;
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

echo '<div class="typed-post row mx-0 align-items-center typed-post-'.$id.'">';
    echo '<div class="typed-post-title col-md-3 text-white bg-primary">'.$title.'</div>';
    echo '<div class="content col-md-9"><span class="typed-here">';
        echo '</span></div>';
echo '</div>';

echo '<div class="typed-content typed-content-'.$id.' d-none">';
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
            echo '<span><a href="'.get_the_permalink().'">'.get_the_title().'</a></span>';
        }
    } else {
        // no posts found
    }
    /* Restore original Post Data */
    wp_reset_postdata();
echo '</div>';