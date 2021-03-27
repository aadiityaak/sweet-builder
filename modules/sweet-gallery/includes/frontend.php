<?php
$photos     = $module->get_photos();
$rounded    = $settings->rounded;

echo '<div class="sweet-gallery sweet-gallery-'.$id.' display-block">';
    foreach($photos as $photo){
        echo '<a class="sweet-gallery-img" href="'.$photo->link.'" data-lity><img class="'.$rounded.'" src="'.$photo->src.'" alt="" /></a>';
    }
echo '</div>';