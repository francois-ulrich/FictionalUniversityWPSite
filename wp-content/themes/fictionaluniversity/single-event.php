<?php

// Initialize Timber
use Timber\Timber;

$context = Timber::context();
$context['post'] = Timber::get_post();

// Today's date
$dateToday = date('Ymd');

// Custom query for home event posts
// $context['programs'] = Timber::get_posts(array(
//     'posts_per_page' => -1,
//     'post_type' => 'programs',
//     'orderby' => 'title',
//     'order' => 'ASC',
//     'meta_query' => array( // Use meta_query if you want aditionnal conditions
//         // Only get events professors related to the program
//         array(
//             'key' => 'related_programs',
//             'compare' => 'LIKE',
//             'value' => strval(get_the_ID()),
//         )
//     )
// ));

$context['programs'] = get_field('related_programs');

Timber::render('./views/pages/single-event.twig', $context);
