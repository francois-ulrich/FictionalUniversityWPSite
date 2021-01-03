<?php

// Initialize Timber
use Timber\Timber;

$context = Timber::context();
$context['posts'] = Timber::get_posts();
$context['categories'] = Timber::get_terms('category', array('parent' => 0));

Timber::render('./views/pages/index.twig', $context);
