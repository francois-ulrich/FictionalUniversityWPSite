<?php

// Initialize Timber
use Timber\Timber;

$context = Timber::context();

$context['archives'] = new TimberArchives(array(
    'posts_per_page' => 10,
));

Timber::render('./views/pages/archive.twig', $context);
