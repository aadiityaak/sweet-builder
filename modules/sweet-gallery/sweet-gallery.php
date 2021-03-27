<?php

/**
 *
 * @class FLSweetGalleryModule
 */
class FLSweetGalleryModule extends FLBuilderModule {

    /** 
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */  
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Gallery', 'fl-builder'),
            'description'   => __('Gallery', 'fl-builder'),
            'category'		=> __('Velocity Modules', 'fl-builder'),
            'dir'           => FL_SWEET_DIR . 'modules/sweet-gallery/',
            'url'           => FL_SWEET_URL . 'modules/sweet-gallery/',
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
                $data->src     = aq_resize( $photo->sizes->full->url, $this->settings->width, $this->settings->height, true, true, true );

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
FLBuilder::register_module('FLSweetGalleryModule', array(
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
                        'type'    => 'text',
                        'label'   => __( 'Collumn', 'fl-builder' ),
                        'default' => '4',
                    ),
                    'img_spacing' => array(
                        'type'    => 'unit',
                        'label'   => __( 'Image Spacing', 'fl-builder' ),
                        'default' => '20',
                        'units'   => array( 'px' ),
                        'slider'  => true,
                        'preview' => array(
                            'type'      => 'css',
                            'selector'  => '.sweet-gallery-img',
                            'property'  => 'padding',
                            'important' => true,
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
                        'default'    => '300',
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
                        'preview'    => array(
                            'type'      => 'css',
                            'selector'  => '.sweet-gallery-img',
                            'property'  => 'width',
                            'important' => true,
                        ),
                    ),
                    'height'              => array(
                        'type'       => 'unit',
                        'default'    => '200',
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
                            'selector'  => '.sweet-gallery-img img',
                            'property'  => 'height',
                            'important' => true,
                        ),
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
    )

));