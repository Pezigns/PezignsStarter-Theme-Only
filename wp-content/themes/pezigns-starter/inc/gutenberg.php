<?php
/**
 *
 * Pezigns Starter Custom Gutenberg Functions
 *
 */

function pezigns_starter_defaults(){
/**
 *
 * Get Site Defaults from Site Settings Page (ACF)
 *
 */
    $default_color_1 = get_field('default_color_one', 'option');
    $default_color_2 = get_field('default_color_two', 'option');
    $default_color_3 = get_field('default_color_three', 'option');
    $default_color_4 = get_field('default_color_four', 'option');
/**
 *
 * Add default color palette colors
 *
 */
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name' => 'Black',
                'slug' => 'black',
                'color' => '#000000'
            ),
            array(
                'name' => 'White',
                'slug' => 'white',
                'color' => '#ffffff'
            ),
            array(
                'name' => 'Site Color 1',
                'slug' => 'default-color-one',
                'color' => $default_color_1
            ),
            array(
                'name' => 'Site Color 2',
                'slug' => 'default-color-two',
                'color' => $default_color_2
            ),
            array(
                'name' => 'Site Color 3',
                'slug' => 'default-color-three',
                'color' => $default_color_3
            ),
            array(
                'name' => 'Site Color 4',
                'slug' => 'default-color-four',
                'color' => $default_color_4
            )
        )
    );

    /**
     *
     * Add default font sizes
     *
     */
    add_theme_support(
        'editor-font-sizes',
        array(

            array(
                'name' => 'Default',
                'slug' => 'default',
                'size' => 18
            ),
            array(
                'name' => 'Small',
                'slug' => 'default-small',
                'size' => 16
            ),
            array(
                'name' => 'Normal',
                'slug' => 'default-normal',
                'size' => 18
            ),
            array(
                'name' => 'Medium',
                'slug' => 'default-medium',
                'size' => 22
            ),
            array(
                'name' => 'Large',
                'slug' => 'default-large',
                'size' => 55
            )
        )
    );
}
add_action('init', 'pezigns_starter_defaults');

/**
 * Register Custom Scripts for Gutenberg Blocks
 */
function pezigns_starter_gutenberg_blocks(){
    wp_register_script('custom-cta-js',get_stylesheet_directory_uri() . '/build/index.js', array('wp-blocks', 'wp-block-editor', 'wp-components'));
    wp_register_style('custom-cta-css',get_stylesheet_directory_uri().'/cta.css', array());
    wp_register_style('custom-cta-editor-css',get_stylesheet_directory_uri().'/cta-editor.css', array());

    register_block_type( 'pezigns-starter/mega-block', array(
        'editor_script' => 'custom-cta-js',
        'editor-style' => 'custom-cta-editor-css',
        'style' => 'custom-cta-css'
    ));
    register_block_type( 'pezigns-starter/count-down-block', array(
        'editor_script' => 'custom-cta-js',
        'editor-style' => 'custom-cta-editor-css',
        'style' => 'custom-cta-css'
    ));
}

add_action('init', 'pezigns_starter_gutenberg_blocks');

