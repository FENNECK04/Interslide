<?php
/*
Plugin Name: Trombinoscope Interactif
Description: Plugin pour gérer un trombinoscope interactif des députés.
Version: 1.0
Author: Neil Benabdillah
*/

if (!defined('ABSPATH')) {
    exit; // Sécurité
}

// Enregistrement du Custom Post Type "Députés"
function trombinoscope_register_post_type() {
    register_post_type('depute', [
        'label' => 'Députés',
        'public' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => true,
        'rewrite' => ['slug' => 'deputes'],
    ]);
}
add_action('init', 'trombinoscope_register_post_type');

// Enregistrement des taxonomies
function trombinoscope_register_taxonomies() {
    // Taxonomie pour les appartenances politiques
    register_taxonomy('appartenance_politique', 'depute', [
        'label' => 'Appartenances Politiques',
        'hierarchical' => true,
        'rewrite' => ['slug' => 'appartenance-politique'],
    ]);

    // Taxonomie pour les circonscriptions
    register_taxonomy('circonscription', 'depute', [
        'label' => 'Circonscriptions',
        'hierarchical' => true,
        'rewrite' => ['slug' => 'circonscription'],
    ]);
}
add_action('init', 'trombinoscope_register_taxonomies');

// Supprimer la taxonomie "Département" (si elle existe encore)
function trombinoscope_remove_departement_taxonomy() {
    unregister_taxonomy('departement');
}
add_action('init', 'trombinoscope_remove_departement_taxonomy', 11);

// Enqueue des styles
function trombinoscope_enqueue_styles() {
    wp_enqueue_style('trombinoscope-style', plugin_dir_url(__FILE__) . 'style.css');
}
add_action('wp_enqueue_scripts', 'trombinoscope_enqueue_styles');

// Fonction pour importer les députés avec leurs circonscriptions et appartenances politiques
function trombinoscope_import_deputes($file_path) {
    if (!file_exists($file_path)) {
        echo '<div class="error"><p>Le fichier CSV est introuvable.</p></div>';
        return;
    }

    $file = fopen($file_path, 'r');
    $header = fgetcsv($file); // Lire la première ligne pour les en-têtes

    // Vérifier que les colonnes nécessaires existent
    $required_columns = ['Députés', 'Circonscription', 'Appartenance politique'];
    foreach ($required_columns as $column) {
        if (!in_array($column, $header)) {
            echo '<div class="error"><p>Le fichier CSV doit contenir les colonnes : "Députés", "Circonscription", et "Appartenance politique".</p></div>';
            fclose($file);
            return;
        }
    }

    while (($data = fgetcsv($file)) !== false) {
        $depute_data = array_combine($header, $data);

        // Créer ou mettre à jour le député
        $post_id = wp_insert_post([
            'post_type' => 'depute',
            'post_title' => sanitize_text_field($depute_data['Députés']), // Ajouter au titre
            'post_status' => 'publish',
        ]);

        if ($post_id) {
            // Assigner la circonscription
            if (!empty($depute_data['Circonscription'])) {
                wp_set_object_terms($post_id, $depute_data['Circonscription'], 'circonscription');
            }

            // Assigner l'appartenance politique
            if (!empty($depute_data['Appartenance politique'])) {
                wp_set_object_terms($post_id, $depute_data['Appartenance politique'], 'appartenance_politique');
            }
        }
    }

    fclose($file);
    echo '<div class="updated"><p>Importation réussie.</p></div>';
}

// Ajouter une page d'administration pour importer les données
function trombinoscope_import_page() {
    echo '<div class="wrap">';
    echo '<h1>Importer des Députés</h1>';
    echo '<form method="POST" enctype="multipart/form-data">';
    echo '<input type="file" name="trombinoscope_csv" accept=".csv" required>';
    echo '<button type="submit" name="trombinoscope_import" class="button button-primary">Importer</button>';
    echo '</form>';
    echo '</div>';

    if (isset($_POST['trombinoscope_import']) && !empty($_FILES['trombinoscope_csv']['tmp_name'])) {
        $file_path = $_FILES['trombinoscope_csv']['tmp_name'];
        trombinoscope_import_deputes($file_path);
    }
}
add_action('admin_menu', function () {
    add_submenu_page(
        'edit.php?post_type=depute',
        'Importer des Députés',
        'Importer',
        'manage_options',
        'trombinoscope_import',
        'trombinoscope_import_page'
    );
});

// Chargement des fichiers nécessaires
require_once plugin_dir_path(__FILE__) . 'shortcodes.php';
