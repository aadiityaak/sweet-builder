<?php

class PostView {

    public $key;

    public function __construct() {
        $this->key = 'post_views_count';
    }

    public function set_post_view($id, $cookie= false, $admin = false) {

        $count = (int) get_post_meta( $id, $this->key, true );
        $count++;

        if($admin && current_user_can('administrator')){
            if( $cookie === true ){
                if($_COOKIE['last_ip_address']!= $_SERVER['REMOTE_ADDR']){
                    setcookie("last_ip_address", $_SERVER['REMOTE_ADDR']);
                    update_post_meta( $id, $this->key, $count );
                }
            } else {
                update_post_meta( $id, $this->key, $count );
            }
        } else {
            if( $cookie === true ){
                if($_COOKIE['last_ip_address']!= $_SERVER['REMOTE_ADDR']){
                    setcookie("last_ip_address", $_SERVER['REMOTE_ADDR']);
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