<?php

// Initialize Timber
use Timber\Timber;

$context = Timber::context();
$context['posts'] = Timber::get_posts();

Timber::render('./views/pages/index.twig', $context);