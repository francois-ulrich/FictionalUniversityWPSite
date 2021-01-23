<?php

// Initialize Timber
use Timber\Timber;

$context = Timber::context();
$context['post'] = Timber::get_post();

Timber::render('./views/pages/single.twig', $context);
