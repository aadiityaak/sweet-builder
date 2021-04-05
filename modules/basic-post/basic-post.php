<?php

/**
 *
 * @class FLBasicPostModule
 */
class FLBasicPostModule extends FLBuilderModule {

    /** 
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */  
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Basic Post', 'fl-builder'),
            'description'   => __('Basic post', 'fl-builder'),
            'category'		=> __('Velocity Modules', 'fl-builder'),
            'dir'           => FL_SWEET_DIR . 'modules/basic-post/',
            'url'           => FL_SWEET_URL . 'modules/basic-post/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));
    }

}

/**
 * Register the module and its form settings.
 */


FLBuilder::register_module('FLBasicPostModule', array(
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
                    'query'   => array(
                        'type'          => 'select',
                        'label'         => __('Query', 'fl-builder'),
                        'default'       => 'custom',
                        'options'       => array(
                            'custom'      => __('Custom Query', 'fl-builder'),
                            'main'      => __('Main Query (if archive)', 'fl-builder'),
                        )
                    ),
                    'pagination'   => array(
                        'type'          => 'select',
                        'label'         => __('Pagination', 'fl-builder'),
                        'default'       => 'show',
                        'options'       => array(
                            'show'      => __('Show', 'fl-builder'),
                            'hide'      => __('Hide', 'fl-builder'),
                        )
                    ),
                    'order'   => array(
                        'type'          => 'select',
                        'label'         => __('Order By', 'fl-builder'),
                        'default'       => 'tabs',
                        'options'       => array(
                            'datedesc'      => __('Date New', 'fl-builder'),
                            'dateasc'      => __('Date Old', 'fl-builder'),
                            'titleasc'      => __('Title A-Z', 'fl-builder'),
                            'titleasc'      => __('Title Z-A', 'fl-builder'),
                            'trending'      => __('Trending', 'fl-builder'),
                        )
                    ),
                )
            ),
            'option'       => array( // Section
                'title'         => __('Option', 'fl-builder'), // Section Title
                'fields'        => array( // Section Fields
                    'date'   => array(
                        'type'          => 'select',
                        'label'         => __('Date', 'fl-builder'),
                        'default'       => 'hide',
                        'options'       => array(
                            'show'      => __('Show', 'fl-builder'),
                            'hide'      => __('Hide', 'fl-builder'),
                        )
                    ),
                    'more'   => array(
                        'type'          => 'select',
                        'label'         => __('Read more', 'fl-builder'),
                        'default'       => 'hide',
                        'options'       => array(
                            'show'      => __('Show', 'fl-builder'),
                            'hide'      => __('Hide', 'fl-builder'),
                        )
                    ),
                    'more_text' => array(
                        'type'    => 'text',
                        'label'   => __( 'Read more Text', 'fl-builder' ),
                        'default' => 'More',
                    ),
                    'posts_per_page' => array(
                        'type'          => 'text',
                        'label'         => __( 'Post Count', 'fl-builder' ),
                        'default'       => '5',
                        'class'         => 'form-controll',
                        'description'   => __( '', 'fl-builder' ),
                    ),
                    'excerpt' => array(
                        'type'          => 'text',
                        'label'         => __( 'Panjang excerpt', 'fl-builder' ),
                        'default'       => '0',
                        'class'         => 'form-controll',
                        'description'   => __( '', 'fl-builder' ),
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
                    'post_style'   => array(
                        'type'          => 'select',
                        'label'         => __('Post Style', 'fl-builder'),
                        'default'       => 'post_style_2',
                        'options'       => array(
                            'post_style_1'      => __('Post Style 1', 'fl-builder'),
                            'post_style_2'      => __('Post Style 2', 'fl-builder'),
                            'post_style_3'      => __('Post Style 3', 'fl-builder'),
                            'post_style_4'      => __('Post Style 4', 'fl-builder'),
                        )
                    ),
                    'collumn' => array(
                        'type'    => 'text',
                        'label'   => __( 'Collumn', 'fl-builder' ),
                        'default' => '2',
                    ),
                    'spacing' => array(
                        'type'    => 'unit',
                        'label'   => __( 'Image Spacing', 'fl-builder' ),
                        'default' => '20',
                        'units'   => array( 'px' ),
                        'slider'  => true,
                        'preview' => array(
                            'type'      => 'css',
                            'selector'  => '.basic-post-col',
                            'property'  => 'padding',
                            'important' => true,
                        ),
                    ),
                )
            ),
        )
    ),
));