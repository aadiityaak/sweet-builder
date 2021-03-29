<?php

/**
 *
 * @class FLBigSlidesModule
 */
class FLBigSlidesModule extends FLBuilderModule {

    /** 
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */  
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Big Post Slide', 'fl-builder'),
            'description'   => __('Big post Slider', 'fl-builder'),
            'category'		=> __('Velocity Modules', 'fl-builder'),
            'dir'           => FL_SWEET_DIR . 'modules/big-slides/',
            'url'           => FL_SWEET_URL . 'modules/big-slides/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));
    }

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLBigSlidesModule', array(
    'general'       => array( // Tab
        'title'         => __('General', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Post', 'fl-builder'), // Section Title
                'fields'        => array( // Section Fields
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
                    'slide_style'   => array(
                        'type'          => 'select',
                        'label'         => __('Slide Style', 'fl-builder'),
                        'default'       => 'slide-1',
                        'options'       => array(
                            'slide-1'      => __('Slide 1', 'fl-builder'),
                            // 'slide-2'      => __('Slide 2', 'fl-builder'),
                            // 'slide-3'      => __('Slide 3', 'fl-builder'),
                            // 'slide-4'      => __('Slide 4', 'fl-builder'),
                        )
                    ),
                )
            )
        )
    ),
    'style'       => array( // Tab
        'title'         => __('Style', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Section Title', 'fl-builder'), // Section Title
                'fields'        => array( // Section Fields
                    'tinggi_slider'     => array(
                        'type'          => 'text',
                        'label'         => __('Tinggi Slider', 'fl-builder'),
                        'default'       => '',
                        'maxlength'     => '4',
                        'placeholder'   => '500',
                        'description'   => 'px',
                        'help'          => 'Isi dengan tinggi slider',
                        'preview'       => array(
                            'type'             => 'css',
                            'selector'         => '.slide-content.slide-1',
                            'property'         => 'height',
                            'unit'             => 'px'
                        )
                    ),
                )
            )
        )
    )
));