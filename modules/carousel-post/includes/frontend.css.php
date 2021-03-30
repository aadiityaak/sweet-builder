.carousel-post-<?php echo $id; ?> .carousel-post-col {
    width: <?php echo 100/$settings->collumn; ?>%;
    display: inline-block;
    padding: <?php echo $settings->spacing; ?>px;
    position: relative;
    vertical-align: top;
}

@media (max-width: 782px) {
    .carousel-post-<?php echo $id; ?> .carousel-post-col {
        width: 50%;
    }
}

@media (max-width: 576px) {
    .carousel-post-<?php echo $id; ?> .carousel-post-col {
        width: 100%;
    }
}