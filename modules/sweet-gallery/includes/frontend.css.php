.sweet-gallery-<?php echo $id;?> .sweet-gallery-img img {
    width: 100%;
    height: auto;
}

.sweet-gallery-<?php echo $id; ?> .sweet-gallery-img {
    width: <?php echo 100/$settings->collumn; ?>%;
    display: inline-block;
    padding: <?php echo $settings->img_spacing; ?>px;
    position: relative;
}

.sweet-gallery-<?php echo $id; ?> .sweet-gallery-img:after {
    content: '';
    position: absolute;
    top:0px;
    left:0px;
    text-align: center;
    background-image: url(<?php echo FL_SWEET_URL.'assets/img/plus.png'; ?>);
    background-position: center;
    background-size: 0%;
    background-repeat: no-repeat;
    width: calc(100% - <?php echo $settings->img_spacing*2; ?>px);
    height: calc(100% - <?php echo $settings->img_spacing*2; ?>px);
    margin: <?php echo $settings->img_spacing; ?>px;
    background-color: rgba(0,0,0,0.0);
    transition: all ease 200ms;
}

.sweet-gallery-<?php echo $id; ?> .sweet-gallery-img:hover:after {
    content: '';
    background-repeat: no-repeat;
    background-size: 30% auto;
    background-color: rgba(0,0,0,0.4);
    transition: all ease 200ms;
}

@media (max-width: 782px) {
    .sweet-gallery-<?php echo $id;?> .sweet-gallery-img {
        width: 50%;
    }
}