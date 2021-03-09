<?php

class PostView {

    public $key;

    public function __construct() {
        $this->key = 'post_views_count';
    }

    public function set_post_view($id, $session= false, $admin = false) {
        $count = (int) get_post_meta( $id, $this->key, true );
        $count++;
        update_post_meta( $id, $this->key, $count );
    }

    public function get_post_view($id) {
        $count = (int) get_post_meta( $id, $this->key, true );
        $views_text = $count > 1 ? 'views' : 'view';
        return $count .' '. $views_text ;
    }
}