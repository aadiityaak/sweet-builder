<?php
	
/**
 * A class that handles loading custom modules and custom
 * fields if the builder is installed and activated.
 */
class FL_Sweet_Builder_Loader {
	
	/**
	 * Initializes the class once all plugins have loaded.
	 */
	static public function init() {
		add_action( 'plugins_loaded', __CLASS__ . '::setup_hooks' );
	}
	
	/**
	 * Setup hooks if the builder is installed and activated.
	 */
	static public function setup_hooks() {
		if ( ! class_exists( 'FLBuilder' ) ) {
			return;	
		}
		
		// Load custom modules.
		add_action( 'init', __CLASS__ . '::load_modules' );
		
		// Register custom fields.
		add_filter( 'fl_builder_custom_fields', __CLASS__ . '::register_fields' );
		
		// Enqueue custom field assets.
		add_action( 'wp_enqueue_scripts', __CLASS__ . '::enqueue_field_assets' );
	}
	
	/**
	 * Loads our custom modules.
	 */
	static public function load_modules() {
		// require_once FL_SWEET_DIR . 'modules/basic-example/basic-example.php';
		// require_once FL_SWEET_DIR . 'modules/example/example.php';
		require_once FL_SWEET_DIR . 'modules/post-tabs/post-tabs.php';
        require_once FL_SWEET_DIR . 'modules/big-slides/big-slides.php';
        require_once FL_SWEET_DIR . 'modules/big-slides/big-post.php';
	}
	
	/**
	 * Registers our custom fields.
	 */
	static public function register_fields( $fields ) {
		$fields['my-custom-field'] = FL_SWEET_DIR . 'fields/my-custom-field.php';
		return $fields;
	}
	
	/**
	 * Enqueues our custom field assets only if the builder UI is active.
	 */
	static public function enqueue_field_assets() {
		// if ( ! FLBuilderModel::is_builder_active() ) {
		// 	return;
		// }
		
		wp_enqueue_style( 'my-custom-fields', FL_SWEET_URL . 'assets/css/fields.css', array(), '' );
		wp_enqueue_style( 'flickity-css', FL_SWEET_URL . 'assets/css/flickity.min.css', array(), '' );
		wp_enqueue_script( 'flickity-js', FL_SWEET_URL . 'assets/js/flickity.pkgd.min.js', array(), '', false );
		wp_enqueue_script( 'sweet-builder-js', FL_SWEET_URL . 'assets/js/sweet-builder.js', array(), '', true );
	}

	/**
	 * Set global sat list
	 */
    static public function getCatList() 
    {
        $categories = get_categories( array(
            'orderby'   => 'name',
            'order'     => 'ASC',
            'hide_empty' => false
        ) );
        
        $listCat = [];
        foreach( $categories as $category ) {
            $listCat[$category->term_id] = $category->name;
        }
        return $listCat;
    }

    /**
	 * Set global excerpt
	 */
    static public function excerpt($panjang = 100){
        $html = get_the_content();
        $html = strip_tags($html);
        $html = substr($html, 0, $panjang);
        $html = substr($html, 0, strripos($html, " "));
        $html = '<p>'.$html.'...</p>';
        return $html;
    }

}

FL_Sweet_Builder_Loader::init();