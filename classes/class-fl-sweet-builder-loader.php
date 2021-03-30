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

        // Run function in single
		add_action( 'wp_footer', __CLASS__ . '::run_in_single' );
	}
	
	/**
	 * Loads our custom modules.
	 */
	static public function load_modules() {
		// require_once FL_SWEET_DIR . 'modules/basic-example/basic-example.php';
		// require_once FL_SWEET_DIR . 'modules/example/example.php';
		require_once FL_SWEET_DIR . 'modules/post-tabs/post-tabs.php';
        require_once FL_SWEET_DIR . 'modules/big-slides/big-slides.php';
        require_once FL_SWEET_DIR . 'modules/big-post/big-post.php';
        require_once FL_SWEET_DIR . 'modules/basic-post/basic-post.php';
        require_once FL_SWEET_DIR . 'modules/typed-post/typed-post.php';
        require_once FL_SWEET_DIR . 'modules/search-form/search-form.php';
        require_once FL_SWEET_DIR . 'modules/sweet-gallery/sweet-gallery.php';
        require_once FL_SWEET_DIR . 'modules/sweet-slider/sweet-slider.php';
        require_once FL_SWEET_DIR . 'modules/carousel-post/carousel-post.php';
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
		
		wp_enqueue_style( 'my-custom-fields', FL_SWEET_URL . 'assets/css/custom.css', array(), '' );
		wp_enqueue_style( 'flickity-css', FL_SWEET_URL . 'assets/css/flickity.min.css', array(), '' );
        wp_enqueue_style( 'lity-css', FL_SWEET_URL . 'assets/css/lity.min.css', array(), '' );
		wp_enqueue_script( 'flickity-js', FL_SWEET_URL . 'assets/js/flickity.pkgd.min.js', array(), '', true );
        wp_enqueue_script( 'typed-builder-js', FL_SWEET_URL . 'assets/js/typed.min.js', array(), '', true );
        wp_enqueue_script( 'lity-js', FL_SWEET_URL . 'assets/js/lity.min.js', array(), '', true );
		wp_enqueue_script( 'sweet-builder-js', FL_SWEET_URL . 'assets/js/sweet-builder.js', array(), '', true );
	}

	/**
	 * Set global sat list
	 */
    static public function getCatList() {
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
    static public function run_in_single() {
        if ( is_singular() ) {
            global $post;
            $key = 'view_count';
            $get_count = get_post_meta($post->ID, $key, true);
            if($get_count) {
                update_post_meta($post->ID, $key, $get_count+1);
            } else {
                update_post_meta($post->ID, $key, 1);
            }
        }
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

    static public function thumbnail($width = 350, $height = 200, $excerpt=0 ) {
        global $post;
        $url        = get_the_post_thumbnail_url($post->ID, 'full'); // Get featured image url
        $imgurl     = aq_resize( $url, $width, $height, true, true, true ); // Resize image
        
        ob_start();
        echo '<a href="'.get_the_permalink().'">';
            if($imgurl){
                echo '<img class="rounded w-100" src="'.$imgurl.'" alt=""/>';
            } else {
                echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="'.$width.'" height="'.$height.'"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
            }
        echo '</a>';
        
        return ob_get_clean();
    }

    static public function post_style_1($thumbwidth=300, $thumbheight=200, $excerpt=250, $date=false, $more=false, $more_text=null) {
        ob_start();
            echo '<div class="content content-big post-style-1">';
                echo '<div class="mb-3">';
                    echo '<i class="rounded-circle bolt-badge bg-danger fa fa-bolt fa-lg" aria-hidden="true"></i>';
                    echo self ::thumbnail($thumbwidth,$thumbheight);
                echo '</div>';
                echo '<div class="">';
                    echo '<div class="mb-1"><small> '.get_the_date().'</small></div>';
                    echo '<h3 class="h4"><a class="judul-text " href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
                    echo '<div class="content-excerpt">'.self::excerpt($excerpt).'</div>';
                echo '</div>';
            echo '</div>';
        return ob_get_clean(); 
    }
    
    static public function post_style_2($thumbwidth=300, $thumbheight=200, $excerpt=250, $date=false, $more=false, $more_text=null) {
        ob_start();
            echo '<div class="row content mb-3 post-style-2">';
                echo '<div class="col-md-4 pr-md-0">';
                    echo self ::thumbnail($thumbwidth,$thumbheight);
                echo '</div>';
                echo '<div class="col-md-8">';
                    echo ($date == 'show') ? '<div class="mb-1"><small><i class="rounded-circle bg-danger p-1 px-2 fa fa-bolt text-white" aria-hidden="true"></i> '.get_the_date().'</small></div>' : '';
                    echo '<h3 class=h4"><a class="judul-text " href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
                    echo ($excerpt != 0) ? '<div class="content-excerpt">'.self::excerpt($excerpt).'</div>' : '';
                echo '</div>';
            echo '</div>';    
        return ob_get_clean(); 
    }

    static public function post_style_3($thumbwidth=300, $thumbheight=200, $excerpt=250, $date=false, $more=false, $more_text=null) {
        ob_start();
            echo '<div class="content content-big post-style-3">';
                echo '<div class="mb-3 overelay">';
                    echo self ::thumbnail($thumbwidth,$thumbheight);
                echo '</div>';
                echo '<div class="content-text">';
                    echo ($date == 'show') ? '<div class="mb-1"><small> '.get_the_date().'</small></div>' : '';
                    echo '<h3 class="h4"><a class="judul-text " href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
                    echo '<div class="content">';
                        echo ($excerpt != 0) ?  self::excerpt($excerpt) : '';
                        echo ($more == 'show') ? '<a class="read-more" href="' . get_the_permalink() . '">' . $more_text . '</a>' : '';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        return ob_get_clean(); 
    }

    static public function post_style_4($thumbwidth=300, $thumbheight=200, $excerpt=250, $date=false, $more=false, $more_text=null) {
        ob_start();
            echo '<div class="row content mb-3 post-style-4">';
                echo '<div class="col-md-4 pr-md-0">';
                    echo self ::thumbnail($thumbwidth,$thumbheight);
                echo '</div>';
                echo '<div class="col-md-8">';
                echo ($date == 'show') ? '<div class="mb-1"><small>'.get_the_date().'</small></div>' : '';
                    echo '<h3 class="h4"><a class="judul-text " href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
                    echo ($excerpt != 0) ? '<div class="content-excerpt">'.self::excerpt($excerpt).'</div>' : '';
                echo '</div>';
            echo '</div>';    
        return ob_get_clean(); 
    }

    static public function pagination( $args = array() ) {

        if ( ! isset( $args['total'] ) && $GLOBALS['wp_query']->max_num_pages <= 1 ) {
            return;
        }
        
        $class = 'pagination justify-content-center';

        $args = wp_parse_args(
            $args,
            array(
                'mid_size'           => 2,
                'prev_next'          => true,
                'prev_text'          => __( '&laquo;', 'justg' ),
                'next_text'          => __( '&raquo;', 'justg' ),
                'type'               => 'array',
                'current'            => max( 1, get_query_var( 'paged' ) ),
                'screen_reader_text' => __( 'Posts navigation', 'justg' ),
            )
        );

        $links = paginate_links( $args );
        if ( ! $links ) {
            return;
        }

        ?>

        <nav aria-labelledby="posts-nav-label">

            <h2 id="posts-nav-label" class="sr-only">
                <?php echo esc_html( $args['screen_reader_text'] ); ?>
            </h2>

            <ul class="<?php echo esc_attr( $class ); ?>">

                <?php
                foreach ( $links as $key => $link ) {
                    ?>
                    <li class="page-item <?php echo strpos( $link, 'current' ) ? 'active' : ''; ?>">
                        <?php echo str_replace( 'page-numbers', 'page-link', $link ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </li>
                    <?php
                }
                ?>

            </ul>

        </nav>

        <?php
    }


}

FL_Sweet_Builder_Loader::init();