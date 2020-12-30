<?php
// Custom post type "Event" declaration
function university_post_types() {
    // Event
    register_post_type( // Create new post type
        'event', // Our post type Name
        array(
            'show_in_rest' => true,
            'supports' => array( // Declare what built-in fields are supported by this post type
                'title',
                'editor',
                'excerpt',
            ),
            'has_archive' => true,
            'public' => true, // Make post types visible to editors & viewers of the website
            'labels' => array( // List of labels used at various places in the back office, refering to this new post type
                'name' => 'Events', // Post name
                'add_new_item' => 'Add New Event',
                'edit_item' => 'Edit Event',
                'all_items' => 'All Events',
                'singular_name' => 'Event',
            ),
            'menu_icon' => 'dashicons-calendar-alt',
            'rewrite' => array(
                'slug' => 'events'
            )
        )
    );

    // Program
    register_post_type( // Create new post type
        'program', // Our post type Name
        array(
            'show_in_rest' => true,
            'supports' => array( // Declare what built-in fields are supported by this post type
                'title',
                'editor',
            ),
            'has_archive' => true,
            'public' => true, // Make post types visible to editors & viewers of the website
            'labels' => array( // List of labels used at various places in the back office, refering to this new post type
                'name' => 'Programs', // Post name
                'add_new_item' => 'Add New Program',
                'edit_item' => 'Edit Program',
                'all_items' => 'All Programs',
                'singular_name' => 'Program',
            ),
            'menu_icon' => 'dashicons-awards',
            'rewrite' => array(
                'slug' => 'programs'
            )
        )
    );

    // Professor
    register_post_type( // Create new post type
        'professor', // Our post type Name
        array(
            'show_in_rest' => true,
            'supports' => array( // Declare what built-in fields are supported by this post type
                'title',
                'editor',
                'thumbnail', // We want a thumbnail attached to this post
            ),
            'public' => true, // Make post types visible to editors & viewers of the website
            'labels' => array( // List of labels used at various places in the back office, refering to this new post type
                'name' => 'Professors', // Post name
                'add_new_item' => 'Add New Professor',
                'edit_item' => 'Edit Professor',
                'all_items' => 'All Professors',
                'singular_name' => 'Professor',
            ),
            'menu_icon' => 'dashicons-welcome-learn-more',
            'rewrite' => array(
                'slug' => 'professors'
            )
        )
    );

}

add_action('init', 'university_post_types');