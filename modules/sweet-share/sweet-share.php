<?php

/**
 * This is an example module with only the basic
 * setup necessary to get it working.
 *
 * @class FLSweetShareModule
 */
class FLSweetShareModule extends FLBuilderModule {

    /** 
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */  
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Sweet Share', 'fl-builder'),
            'description'   => __('Sweet Share Social Media Sharing', 'fl-builder'),
            'category'		=> __('Velocity Modules', 'fl-builder'),
            'dir'           => FL_SWEET_DIR . 'modules/sweet-share/',
            'url'           => FL_SWEET_URL . 'modules/sweet-share/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLSweetShareModule', array(
    'general'       => array( // Tab
        'title'         => __('General', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Section Title', 'fl-builder'), // Section Title
                'fields'        => array( // Section Fields
                    'email'   => array(
                        'type'          => 'select',
                        'label'         => __('Email Share', 'fl-builder'),
                        'default'       => 'true',
                        'options'       => array(
                            'show'      => __('Show', 'fl-builder'),
                            'hide'      => __('Hide', 'fl-builder')
                        )
                    ),
                    'facebook'   => array(
                        'type'          => 'select',
                        'label'         => __('Facebook Share', 'fl-builder'),
                        'default'       => 'true',
                        'options'       => array(
                            'show'      => __('Show', 'fl-builder'),
                            'hide'      => __('Hide', 'fl-builder')
                        )
                    ),
                    'twitter'   => array(
                        'type'          => 'select',
                        'label'         => __('witter Share', 'fl-builder'),
                        'default'       => 'true',
                        'options'       => array(
                            'show'      => __('Show', 'fl-builder'),
                            'hide'      => __('Hide', 'fl-builder')
                        )
                    ),
                    'linkedin'   => array(
                        'type'          => 'select',
                        'label'         => __('Linkedin Share', 'fl-builder'),
                        'default'       => 'true',
                        'options'       => array(
                            'show'      => __('Show', 'fl-builder'),
                            'hide'      => __('Hide', 'fl-builder')
                        )
                    ),
                    'pinterest'   => array(
                        'type'          => 'select',
                        'label'         => __('Pinterest Share', 'fl-builder'),
                        'default'       => 'true',
                        'options'       => array(
                            'show'      => __('Show', 'fl-builder'),
                            'hide'      => __('Hide', 'fl-builder')
                        )
                    ),
                    'whatsapp'   => array(
                        'type'          => 'select',
                        'label'         => __('Whatsapp Share', 'fl-builder'),
                        'default'       => 'true',
                        'options'       => array(
                            'show'      => __('Show', 'fl-builder'),
                            'hide'      => __('Hide', 'fl-builder')
                        )
                    ),
                )
            )
        )
    )
));