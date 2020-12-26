<?php
// Custom post type "Event" declaration
function university_post_types() {
    register_post_type( // Create new post type
        'event', // Our post type Name
        array(
            // 'description' => 'Events description',
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
}

add_action('init', 'university_post_types');