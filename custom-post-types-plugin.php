<?php
/**
 * Plugin Name: Interslide - Custom Types
 * Description: Ce plugin permet de créer et de gérer des types de contenus personnalisés pour le site, tels que Tour du Monde, Dossiers, Newsletters, Infographies, Podcasts, et Capsules.
 * Version: 2.0
 * Author: BH Media
 */

// Sécurité : empêcher l'accès direct au fichier
if (!defined('ABSPATH')) {
    exit;
}

// Enregistrement des Custom Post Types
function register_custom_post_types() {
    // Tour du Monde (Post)
    register_post_type('tour_du_monde', [
        'labels' => [
            'name' => 'Tour du Monde',
            'singular_name' => 'Tour du Monde',
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-admin-site',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'hierarchical' => false, // Type "post"
    ]);

    // Dossier (Page)
    register_post_type('dossier', [
        'labels' => [
            'name' => 'Dossiers',
            'singular_name' => 'Dossier',
        ],
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'hierarchical' => true, // Type "page"
    ]);

    // Newsletter (Page)
    register_post_type('newsletter', [
        'labels' => [
            'name' => 'Newsletters',
            'singular_name' => 'Newsletter',
        ],
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-email',
        'supports' => ['title', 'editor', 'excerpt', 'custom-fields'],
        'hierarchical' => true, // Type "page"
    ]);

    // Infographies (Post)
    register_post_type('infographies', [
        'labels' => [
            'name' => 'Infographies',
            'singular_name' => 'Infographie',
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-chart-bar',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'hierarchical' => false, // Type "post"
        'taxonomies' => ['category'], // Associate with categories
    ]);

    // Podcast (Post)
    register_post_type('podcast', [
        'labels' => [
            'name' => 'Podcasts',
            'singular_name' => 'Podcast',
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-microphone',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'hierarchical' => false, // Type "post"
        'taxonomies' => ['category'], // Associate with categories
    ]);

    // Capsule (Page)
    register_post_type('capsule', [
        'labels' => [
            'name' => 'Capsules',
            'singular_name' => 'Capsule',
        ],
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-archive',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'hierarchical' => true, // Type "page"
        'taxonomies' => ['category'], // Associate with categories
    ]);
}
add_action('init', 'register_custom_post_types');
