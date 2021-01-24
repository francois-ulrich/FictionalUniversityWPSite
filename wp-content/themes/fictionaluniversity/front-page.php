<?php

// Initialize Timber
use Timber\Timber;

$context = Timber::context();

// Custom query for home posts
$context['posts'] = Timber::get_posts(array(
    'posts_per_page' => 2
));

// Today's date
$dateToday = date('Ymd');

// Custom query for home event posts
$context['events'] = Timber::get_posts(array(
    'posts_per_page' => 2,
    'post_type' => 'event',
    'orderby' => 'event_date',
    'order' => 'ASC',
    'meta_query' => array( // Use meta_query if you want aditionnal conditions
        array( // Condition: Get all events, where event_date is later than today
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $dateToday,
            'type' => 'numeric', // We are comparing numbers
        )
    )
));

Timber::render( './views/pages/front-page.twig', $context );
