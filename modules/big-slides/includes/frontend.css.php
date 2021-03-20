<?php
    $tinggi_slider = $settings->tinggi_slider; 
?>

//slider
/* smaller, dark, rounded square */
.slider-<?php echo $id; ?> .flickity-button {
    background: #333;
}
.slider-<?php echo $id; ?> .flickity-button:hover {
    background: #fff;
}

.slider-<?php echo $id; ?> .flickity-prev-next-button {
    width: 20px;
    height: 45px;
}
/* icon color */
.slider-<?php echo $id; ?> .flickity-button-icon {
    fill: #333;
}
/* position outside */
.slider-<?php echo $id; ?> .flickity-prev-next-button.previous {
    left: 5px;
    border-radius: 0 5px 5px 0;
}
.slider-<?php echo $id; ?> .flickity-prev-next-button.next {
    right: 5px;
    border-radius: 5px 0 0 5px;
}

.slider-<?php echo $id; ?> .slide-content {
    float: left;
    background-size: cover;
    background-position: center;
    position: relative;
    margin-left: 5px;
}
.slider-<?php echo $id; ?> .slide-content > div {
    z-index: 9;
    position-relative;
}
.slider-<?php echo $id; ?> .slide-content + .slide-content {
    margin-bottom: 5px;
    margin-left: 5px;
    height: <?php echo ($tinggi_slider/2)-2.5; ?>px;
    width: calc(25% - 10px);
}
.slider-<?php echo $id; ?> .slide-content + .slide-content .content-excerpt {
    max-height: 0px;
    overflow: hidden;
    transition: all ease 400ms;
}
.slider-<?php echo $id; ?> .slide-content + .slide-content:hover .content-excerpt {
    max-height: <?php echo ($tinggi_slider/2)-2.5; ?>px;
    overflow: hidden;
    transition: all ease 400ms;
}
.slider-<?php echo $id; ?> .slide-content:before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.4);
}
.slider-<?php echo $id; ?> .slide-1 {
    width: 50%;
    height: <?php echo $tinggi_slider; ?>px;
    float: left;
}


@media ( max-width: 782px ) {
    .slider-<?php echo $id; ?> .slide-content {
        width: 50%;
        height: <?php echo $tinggi_slider/4; ?>px;
        margin: 0;
    }
    .slider-<?php echo $id; ?> .slide-1 {
        width: 100%;
        height: <?php echo $tinggi_slider/2; ?>px;
    }
}