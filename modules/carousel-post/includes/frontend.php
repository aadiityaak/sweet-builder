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

$sliderOption = [];
$sliderOption['pageDots'] = (bool) $settings->dots;
$sliderOption['wrapAround'] = true;
$sliderOption['cellAlign'] = 'center';
$sliderOption['imagesLoaded'] = true;
$sliderOption['prevNextButtons'] = (bool) $settings->navs;
$sliderOption = json_encode($sliderOption);

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
?>
<div data-flickity='<?php echo $sliderOption; ?>' class='carousel-post carousel-post-<?php echo $id; ?> display-block carousel'>
    <?php
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
            echo '<div class="carousel-post-col">';
                echo FL_Sweet_Builder_Loader::$post_style($width,$height,$excerpt,$date,$more,$more_text);
            echo '</div>';
        }
    } else {
        // no posts found
        echo 'Not Found';
    }
    /* Restore original Post Data */
    wp_reset_query();

echo '</div>';