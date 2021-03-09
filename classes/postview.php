<?php

class PostView {

    public $key;

    public function __construct() {
        $this->key = 'post_views_count';
    }

    public function set_post_view($id, $session = false, $admin = false) {

        $count = (int) get_post_meta( $id, $this->key, true );
        $session_view = isset($_SESSION['post_views']) ? $_SESSION['post_views'] : '';
        $count++;

        if($admin && current_user_can('administrator')){
            if( $session === true ){
                if(empty($session_view)){
                    $_SESSION['post_views'] = time();
                    update_post_meta( $id, $this->key, $count );
                }
            } else {
                update_post_meta( $id, $this->key, $count );
            }
        } else {
            if( $session === true ){
                if(empty($session_view)){
                    $_SESSION['post_views'] = time();
                    update_post_meta( $id, $this->key, $count );
                }
            } else {
                update_post_meta( $id, $this->key, $count );
            }
        }

        
    }

    public function get_post_view($id) {
        $count = (int) get_post_meta( $id, $this->key, true );
        $views_text = $count > 1 ? 'views' : 'view';
        return $count .' '. $views_text ;
    }
}