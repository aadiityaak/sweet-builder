<?php
$photos     = $module->get_photos();
$rounded    = $settings->rounded;

echo '<div class="sweet-slider sweet-slider-'.$id.' display-block">';
    foreach($photos as $photo){
        echo '<div class="w-75 sweet-slider-img" ><img class="'.$rounded.' h-100" src="'.$photo->src.'" alt="" /></div>';
    }
echo '</div>';