<?php

class PostView {
    
    public $id;
    public $key;

    public function __construct() {
        global $post;
        $this->id = $post->ID;
        $this->key = 'post_views_count';
    }

    public function set_post_view() {
        $count = (int) get_post_meta( $this->id, $this->key, true );
        $count++;
        update_post_meta( $this->id, $this->key, $count );
    }

    public function get_post_view() {
        $count = (int) get_post_meta( $this->id, $this->key, true );
        return $count;
    }
}