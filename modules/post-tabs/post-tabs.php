<?php

/**
 *
 * @class FLPostabsModule
 */
class FLPostabsModule extends FLBuilderModule {

    /** 
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */  
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Post Tabs', 'fl-builder'),
            'description'   => __('Simple post tab', 'fl-builder'),
            'category'		=> __('Velocity Modules', 'fl-builder'),
            'dir'           => FL_SWEET_DIR . 'modules/post-tabs/',
            'url'           => FL_SWEET_URL . 'modules/post-tabs/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));
    }
    function getCatList() 
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
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLPostabsModule', array(
    'general'       => array( // Tab
        'title'         => __('General', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Post', 'fl-builder'), // Section Title
                'fields'        => array( // Section Fields
                    'categories'   => array(
                        'type'          => 'select',
                        'label'         => __('Category', 'fl-builder'),
                        'options'       => FLPostabsModule::getCatList(),
                        'multi-select'  => true
                    ),
                )
            )
        )
    )
));