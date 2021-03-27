<?php
global $post, $postview;
$i = 0;
$title = $settings->title;
$categories = $settings->categories;
$posts_per_page = $settings->posts_per_page;
$order = $settings->order;
$date = $settings->date;
$post_style = $settings->post_style;
$excerpt = $settings->excerpt;
$more = $settings->more;
$more_text = $settings->more_text;
$width = $settings->width;
$height = $settings->height;
$query = $settings->query;
$pagination = $settings->pagination;

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
    echo $title ? '<div class="basic-post-title mb-3"><h3>'.$title.'</h3></div>' : '';
    echo '<div class="content">';
        
        if(is_archive() && $query == 'main'){
                global $wp_query;
        } else {
            $args = [
                'cat' => $categories,
                'posts_per_page' => $posts_per_page,
                'orderby' => $orderby[0],
                'order' => $orderby[1],
            ];
            if($orderby[2]){
                $args['meta_key'] = $orderby[2];
            }
            $wp_query = new WP_Query($args);
        }
        if ( $wp_query->have_posts() ) {
            while ( $wp_query->have_posts() ) {
                $wp_query->the_post();
                echo '<div class="basic-post-col">';
                    echo FL_Sweet_Builder_Loader::$post_style($width,$height,$excerpt,$date,$more,$more_text);
                echo '</div>';
            }
        } else {
            // no posts found
            echo 'Not Found';
        }
        /* Restore original Post Data */
        wp_reset_query();
        if($pagination == 'show'){
            FL_Sweet_Builder_Loader::pagination();
        }
        
        
        echo '</div>';
echo '</div>';