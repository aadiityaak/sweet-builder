<?php
$sliderOption = [];
$photos     = $module->get_photos();
$rounded    = $settings->rounded;
$sliderOption['pageDots'] = (bool) $settings->dots;
$sliderOption['wrapAround'] = true;
$sliderOption['cellAlign'] = 'center';
$sliderOption['imagesLoaded'] = true;
$sliderOption['prevNextButtons'] = (bool) $settings->navs;
$width    = 100/$settings->collumn;
$sliderOption = json_encode($sliderOption);
?>
<div data-flickity='<?php echo $sliderOption; ?>' class='sweet-slider sweet-slider-<?php echo $id; ?> display-block carousel'>
    <?php
        foreach($photos as $photo){
            echo '<div class="carousel-cell sweet-slider-img" ><img class="'.$rounded.'" src="'.$photo->src.'" alt="" /></div>';
        }
    ?>
</div>