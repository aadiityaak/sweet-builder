<?php

/**
 *
 * @class FLSweetSliderModule
 */
class FLSweetSliderModule extends FLBuilderModule {

    /** 
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */  
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Slider', 'fl-builder'),
            'description'   => __('Slider', 'fl-builder'),
            'category'		=> __('Velocity Modules', 'fl-builder'),
            'dir'           => FL_SWEET_DIR . 'modules/sweet-slider/',
            'url'           => FL_SWEET_URL . 'modules/sweet-slider/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));
    }

	/**
	 * @method get_photos
	 */
	public function get_photos() {
		return $this->get_wordpress_photos();
	}

	/**
	 * @method get_wordpress_photos
	 */
	public function get_wordpress_photos() {
		$photos   = array();
		$ids      = $this->settings->photos;
		$medium_w = get_option( 'medium_size_w' );
		$large_w  = get_option( 'large_size_w' );

		if ( empty( $this->settings->photos ) ) {
			return $photos;
		}

		foreach ( $ids as $id ) {

			$photo = FLBuilderPhoto::get_attachment_data( $id );

			// Use the cache if we didn't get a photo from the id.
			if ( ! $photo ) {

				if ( ! isset( $this->settings->photo_data ) ) {
					continue;
				} elseif ( is_array( $this->settings->photo_data ) ) {
					$photos[ $id ] = $this->settings->photo_data[ $id ];
				} elseif ( is_object( $this->settings->photo_data ) ) {
					$photos[ $id ] = $this->settings->photo_data->{$id};
				} else {
					continue;
				}
			}

			// Only use photos who have the sizes object.
			if ( isset( $photo->sizes ) ) {

				// Photo data object
				$data              = new stdClass();
				$data->id          = $id;
				$data->alt         = $photo->alt;
				$data->caption     = $photo->caption;
				$data->description = $photo->description;
				$data->title       = $photo->title;

                // URL img
                $data->src     = aq_resize( $photo->sizes->full->url, $this->settings->width, $this->settings->height, (bool)$this->settings->crop, true, true );

				// Photo Link
				if ( isset( $photo->sizes->large ) ) {
					$data->link = $photo->sizes->large->url;
				} else {
					$data->link = $photo->sizes->full->url;
				}

				// Push the photo data
				$photos[ $id ] = $data;
			}
		}

		return $photos;
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLSweetSliderModule', array(
    'general'       => array( // Tab
        'title'         => __('General', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Gallery', 'fl-builder'), // Section Title
                'fields'        => array( // Section Fields
					'photos'              => array(
						'type'        => 'multiple-photos',
						'label'       => __( 'Photos', 'fl-builder' ),
						'connections' => array( 'multiple-photos' ),
					),
                )
            ),
            'option'       => array( // Section
                'title'         => __('Option', 'fl-builder'), // Section Title
                'fields'        => array( // Section Fields
                    'collumn' => array(
                        'type'    => 'unit',
                        'label'   => __( 'Collumn', 'fl-builder' ),
                        'units'   => array( '%' ),
                        'default' => '100',
                        'preview'    => array(
                            'type'      => 'css',
                            'selector'  => '.carousel-post-col',
                            'property'  => 'width',
                            'important' => true,
                            'unit'      => '%'
                        ),
                    ),
                    'img_spacing' => array(
                        'type'    => 'unit',
                        'label'   => __( 'Image Spacing', 'fl-builder' ),
                        'default' => '20',
                        'units'   => array( 'px' ),
                        'slider'  => true,
                        'preview' => array(
                            'type'      => 'css',
                            'selector'  => '.carousel-post-col',
                            'property'  => 'padding',
                            'important' => true,
                            'unit'      => 'px'
                        ),
                    ),
                )
            ),
        )
    ),
    'style'       => array( // Tab
        'title'         => __('Style', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'style'       => array( // Section
                'title'         => __('Size', 'fl-builder'), // Section Title
                'fields'        => array( // Section Fields
                    'width'              => array(
                        'type'       => 'unit',
                        'label'      => __( 'Width', 'fl-builder' ),
                        'default'    => '1140',
                        'responsive' => true,
                        'units'      => array(
                            'px'
                        ),
                        'slider'     => array(
                            'px' => array(
                                'min'  => 100,
                                'max'  => 2500,
                                'step' => 1,
                            ),
                        ),
                        'preview'    => array(
                            'type'      => 'css',
                            'selector'  => '.carousel-post-col',
                            'property'  => 'width',
                            'important' => true,
                        ),
                    ),
                    'height'              => array(
                        'type'       => 'unit',
                        'default'    => '500',
                        'label'      => __( 'Height', 'fl-builder' ),
                        'responsive' => true,
                        'units'      => array(
                            'px'
                        ),
                        'slider'     => array(
                            'px' => array(
                                'min'  => 10,
                                'max'  => 1500,
                                'step' => 1,
                            ),
                        ),
                        'preview' => array(
                            'type'      => 'css',
                            'selector'  => '.carousel-post-col',
                            'property'  => 'height',
                            'important' => true,
                        ),
                    ),
                    'crop'   => array(
                        'type'          => 'select',
                        'label'         => __('Images Crop', 'fl-builder'),
                        'default'       => 'true',
                        'options'       => array(
                            'true'    => __('Crop', 'fl-builder'),
                            ''  => __("Don't Crop", 'fl-builder'),
                        )
                    ),
                    'rounded'   => array(
                        'type'          => 'select',
                        'label'         => __('Slide Style', 'fl-builder'),
                        'default'       => 'rounded',
                        'options'       => array(
                            'rounded'    => __('Rounded', 'fl-builder'),
                            'rounded-0'      => __('Box', 'fl-builder'),
                        )
                    ),
                )
            )
        )
    ),
    'slider'       => array( // Tab
        'title'         => __('Slider', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'style'       => array( // Section
                'title'         => __('Size', 'fl-builder'), // Section Title
                'fields'        => array( // Section Fields
                    'dots'   => array(
                        'type'          => 'select',
                        'label'         => __('Slide Dots', 'fl-builder'),
                        'default'       => '',
                        'options'       => array(
                            'true'    => __('True', 'fl-builder'),
                            ''      => __('False', 'fl-builder'),
                        )
                    ),
                    'navs'   => array(
                        'type'          => 'select',
                        'label'         => __('Slide Navs', 'fl-builder'),
                        'default'       => '',
                        'options'       => array(
                            'true'    => __('True', 'fl-builder'),
                            ''      => __('False', 'fl-builder'),
                        )
                    ),
                )
            )
        )
    )


));