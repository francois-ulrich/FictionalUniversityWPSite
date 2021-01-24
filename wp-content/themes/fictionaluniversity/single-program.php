<?php

// Initialize Timber
use Timber\Timber;

$context = Timber::context();
$context['post'] = Timber::get_post();

// Today's date
$dateToday = date('Ymd');

// Custom query for home event posts
$context['events'] = Timber::get_posts(array(
    'posts_per_page' => -1,
    'post_type' => 'event',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => array( // Use meta_query if you want additional conditions
        array( // Condition: Get all events, where event_date is later than today
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $dateToday,
            'type' => 'numeric', // We are comparing numbers
        ),
        // Only get events related to the program
        array(
            'key' => 'related_programs',
            'compare' => 'LIKE',
            'value' => strval(get_the_ID()),
        )
    )
));

// Custom query for home event posts
$context['professors'] = Timber::get_posts(array(
    'posts_per_page' => -1,
    'post_type' => 'professor',
    'orderby' => 'title',
    'order' => 'ASC',
    'meta_query' => array( // Use meta_query if you want aditionnal conditions
        // Only get events professors related to the program
        array(
            'key' => 'related_programs',
            'compare' => 'LIKE',
            'value' => strval(get_the_ID()),
        )
    )
));

Timber::render('./views/pages/single-program.twig', $context);
