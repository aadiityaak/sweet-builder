<?php
    $categories = $settings->categories; 
?>
<div class="fl-post-tabs">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <?php 
    $i = 0;
    foreach($categories as $category){
        $active = $i++ == 0 ? 'active' : '';
        echo '<li class="nav-item" role="presentation">';
            echo '<button class="btn btn-sm btn-primary mr-2 '.$active.'" id="pills-'.$category.'-tab" data-bs-toggle="pill" data-bs-target="#pills-'.$category.'" role="tab" aria-controls="pills-'.$category.'" aria-selected="true">'.get_term( $category )->name.'</button>';
        echo '</li>';
    }
    ?>

    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
    </div>

</div>