<?php

/**
 *
 * @class FLBigPostModule
 */
class FLBigPostModule extends FLBuilderModule {

    /** 
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */  
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Big Post', 'fl-builder'),
            'description'   => __('Big post', 'fl-builder'),
            'category'		=> __('Velocity Modules', 'fl-builder'),
            'dir'           => FL_SWEET_DIR . 'modules/big-post/',
            'url'           => FL_SWEET_URL . 'modules/big-post/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLBigPostModule', array(
    'general'       => array( // Tab
        'title'         => __('General', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Post', 'fl-builder'), // Section Title
                'fields'        => array( // Section Fields
                    'title' => array(
                        'type'          => 'text',
                        'label'         => __( 'Widget Title', 'fl-builder' ),
                        'default'       => 'Berita Terbaru',
                        'class'         => 'form-controll',
                        'description'   => __( '', 'fl-builder' ),
                        'help'          => __( '', 'fl-builder' )
                      ),
                    'categories'   => array(
                        'type'          => 'select',
                        'label'         => __('Category', 'fl-builder'),
                        'options'       => FL_Sweet_Builder_Loader::getCatList(),
                        'class'         => 'form-controll',
                        'multi-select'  => true
                    ),
                    'posts_per_page' => array(
                        'type'          => 'text',
                        'label'         => __( 'Post Count', 'fl-builder' ),
                        'default'       => '5',
                        'class'         => 'form-controll',
                        'description'   => __( 'Only Number', 'fl-builder' ),
                        'help'          => __( 'Ex. "5"', 'fl-builder' )
                    ),
                    'date'   => array(
                        'type'          => 'select',
                        'label'         => __('Date', 'fl-builder'),
                        'default'       => 'hide',
                        'options'       => array(
                            'show'      => __('Show', 'fl-builder'),
                            'hide'      => __('Hide', 'fl-builder'),
                        )
                    ),
                )
            )
        )
    ),
    'Style'       => array( // Tab
        'title'         => __('Style', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Post', 'fl-builder'), // Section Title
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
                    ),
					'color'      => array(
						'type'        => 'color',
						'connections' => array( 'color' ),
						'show_reset'  => true,
						'show_alpha'  => true,
						'label'       => __( 'Color', 'fl-builder' ),
						'preview'     => array(
							'type'      => 'css',
							'selector'  => '{node} .judul-text',
							'property'  => 'color',
							'important' => true,
						),
					),
					'typography' => array(
						'type'       => 'typography',
						'label'      => __( 'Typography', 'fl-builder' ),
						'responsive' => true,
						'preview'    => array(
							'type'      => 'css',
							'selector'  => '{node} .judul-text',
							'important' => true,
						),
					),
				),
            ),
        )
    ),
));