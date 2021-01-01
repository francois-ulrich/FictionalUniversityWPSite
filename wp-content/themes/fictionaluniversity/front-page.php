<?php

// Initialize Timber
use Timber\Timber;

$context = Timber::context();
$context['posts'] = Timber::get_posts();

// Custom query for home posts
$context['homepagePosts'] = new WP_Query(array(
    'posts_per_page' => 2
));

// Today's date
$context['dateToday'] = date('Ymd');

// Custom query for homt event posts
$context['homepageEventPosts'] = Timber::get_posts(array(
    'posts_per_page' => 2,
    'post_type' => 'event',
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => array( // Use meta_query if you want aditionnal conditions 
        array( // Condition: Get all events, where event_date is later than today
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'numeric', // We are comparing numbers
        )
    )
));

Timber::render( './templates/front-page.twig', $context );