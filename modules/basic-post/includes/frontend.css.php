.basic-post-<?php echo $id; ?> .basic-post-col {
    width: <?php echo 100/$settings->collumn; ?>%;
    display: inline-block;
    padding: <?php echo $settings->spacing; ?>px;
    position: relative;
    vertical-align: top;
}

@media (max-width: 782px) {
    .basic-post-<?php echo $id; ?> .basic-post-col {
        width: 50%;
    }
}

@media (max-width: 576px) {
    .basic-post-<?php echo $id; ?> .basic-post-col {
        width: 100%;
    }
}