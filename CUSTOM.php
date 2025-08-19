<?php
/**
 * Plugin Name: Interslide - Custom Types
 * Description: Ce plugin permet de créer et de gérer des types de contenus personnalisés pour le site, tels que Tour du Monde, Dossiers, Newsletters, Infographies, Podcasts, et Capsules.
 * Version: 2.4
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
        'taxonomies' => ['category'], // Associate with categories
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

// Activer l'éditeur Gutenberg pour les types de contenu personnalisés
function enable_gutenberg_for_custom_post_types($args, $post_type) {
    $custom_post_types = ['tour_du_monde', 'dossier', 'newsletter', 'infographies', 'podcast', 'capsule'];
    if (in_array($post_type, $custom_post_types)) {
        $args['show_in_rest'] = true; // Activer l'éditeur Gutenberg
    }
    return $args;
}
add_filter('register_post_type_args', 'enable_gutenberg_for_custom_post_types', 10, 2);

// Activer le support des images mises en avant pour les pages
function enable_featured_images_for_pages() {
    add_post_type_support('page', 'thumbnail');
}
add_action('init', 'enable_featured_images_for_pages');

// Activer le support des images mises en avant pour tous les types de contenu personnalisés
function enable_featured_images_for_custom_post_types() {
    $post_types = ['newsletter', 'dossier', 'tour_du_monde', 'infographies', 'podcast', 'capsule'];
    foreach ($post_types as $post_type) {
        add_post_type_support($post_type, 'thumbnail');
    }
}
add_action('init', 'enable_featured_images_for_custom_post_types');

// Enregistrement des taxonomies personnalisées
function register_custom_taxonomies() {
    // Taxonomie "Thème"
    register_taxonomy('theme', ['tour_du_monde', 'infographies', 'podcast'], [
        'labels' => [
            'name' => 'Thèmes',
            'singular_name' => 'Thème',
            'search_items' => 'Rechercher des thèmes',
            'all_items' => 'Tous les thèmes',
            'edit_item' => 'Modifier le thème',
            'update_item' => 'Mettre à jour le thème',
            'add_new_item' => 'Ajouter un nouveau thème',
            'new_item_name' => 'Nom du nouveau thème',
            'menu_name' => 'Thèmes',
        ],
        'hierarchical' => true, // Comme les catégories
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'theme'],
    ]);
}
add_action('init', 'register_custom_taxonomies');

// Ajouter une colonne "ID" dans la liste des catégories
function add_category_id_column($columns) {
    $columns['category_id'] = 'ID';
    return $columns;
}
add_filter('manage_edit-category_columns', 'add_category_id_column');

// Afficher l'ID dans la colonne "ID"
function display_category_id_column($content, $column_name, $term_id) {
    if ($column_name === 'category_id') {
        $content = $term_id;
    }
    return $content;
}
add_filter('manage_category_custom_column', 'display_category_id_column', 10, 3);

// Ajout d'une métabox personnalisée pour les podcasts
function add_podcast_meta_box() {
    add_meta_box(
        'podcast_meta_box', // ID unique
        'Informations du Podcast', // Titre de la métabox
        'render_podcast_meta_box', // Fonction de rendu
        'podcast', // Type de contenu
        'normal', // Contexte
        'default' // Priorité
    );
}
add_action('add_meta_boxes', 'add_podcast_meta_box');

// Rendu de la métabox
function render_podcast_meta_box($post) {
    // Récupérer la valeur actuelle du champ personnalisé
    $podcast_link = get_post_meta($post->ID, '_podcast_link', true);

    // Champ pour le lien du podcast
    echo '<label for="podcast_link">Lien de l\'épisode :</label>';
    echo '<input type="url" id="podcast_link" name="podcast_link" value="' . esc_attr($podcast_link) . '" style="width:100%;">';
}

// Sauvegarde des données de la métabox
function save_podcast_meta_box_data($post_id) {
    // Vérifier si le champ est défini
    if (isset($_POST['podcast_link'])) {
        // Sauvegarder la valeur dans les métadonnées du post
        update_post_meta($post_id, '_podcast_link', sanitize_text_field($_POST['podcast_link']));
    }
}
add_action('save_post', 'save_podcast_meta_box_data');

// Ajouter une métabox pour programmer la publication
function add_schedule_meta_box() {
    $post_types = ['tour_du_monde', 'dossier', 'newsletter', 'infographies', 'podcast', 'capsule'];
    foreach ($post_types as $post_type) {
        add_meta_box(
            'schedule_meta_box', // ID unique
            'Programmer la Publication', // Titre de la métabox
            'render_schedule_meta_box', // Fonction de rendu
            $post_type, // Type de contenu
            'side', // Contexte
            'default' // Priorité
        );
    }
}
add_action('add_meta_boxes', 'add_schedule_meta_box');

// Rendu de la métabox
function render_schedule_meta_box($post) {
    $scheduled_date = get_post_meta($post->ID, '_scheduled_date', true);
    echo '<label for="scheduled_date">Date et heure :</label>';
    echo '<input type="datetime-local" id="scheduled_date" name="scheduled_date" value="' . esc_attr($scheduled_date) . '" style="width:100%;">';
}

// Sauvegarder la date de programmation
function save_schedule_meta_box_data($post_id) {
    if (isset($_POST['scheduled_date'])) {
        update_post_meta($post_id, '_scheduled_date', sanitize_text_field($_POST['scheduled_date']));
    }
}
add_action('save_post', 'save_schedule_meta_box_data');

// Planifier la publication automatique
function schedule_auto_publish() {
    $post_types = ['tour_du_monde', 'dossier', 'newsletter', 'infographies', 'podcast', 'capsule'];
    foreach ($post_types as $post_type) {
        $args = [
            'post_type' => $post_type,
            'post_status' => 'draft',
            'meta_query' => [
                [
                    'key' => '_scheduled_date',
                    'value' => current_time('Y-m-d H:i:s'),
                    'compare' => '<=',
                    'type' => 'DATETIME',
                ],
            ],
        ];
        $query = new WP_Query($args);
        while ($query->have_posts()) {
            $query->the_post();
            wp_update_post([
                'ID' => get_the_ID(),
                'post_status' => 'publish',
            ]);
            delete_post_meta(get_the_ID(), '_scheduled_date');
        }
        wp_reset_postdata();
    }
}
add_action('init', 'schedule_auto_publish');

// Ajouter une métabox pour changer le type de contenu
function add_change_post_type_meta_box() {
    $post_types = ['tour_du_monde', 'dossier', 'newsletter', 'infographies', 'podcast', 'capsule'];
    foreach ($post_types as $post_type) {
        add_meta_box(
            'change_post_type_meta_box', // ID unique
            'Changer le Type de Contenu', // Titre de la métabox
            'render_change_post_type_meta_box', // Fonction de rendu
            $post_type, // Type de contenu
            'side', // Contexte
            'default' // Priorité
        );
    }
}
add_action('add_meta_boxes', 'add_change_post_type_meta_box');

// Rendu de la métabox
function render_change_post_type_meta_box($post) {
    $post_types = ['tour_du_monde', 'dossier', 'newsletter', 'infographies', 'podcast', 'capsule'];
    echo '<label for="change_post_type">Sélectionnez un type :</label>';
    echo '<select id="change_post_type" name="change_post_type" style="width:100%;">';
    foreach ($post_types as $post_type) {
        $selected = ($post->post_type === $post_type) ? 'selected' : '';
        echo '<option value="' . esc_attr($post_type) . '" ' . $selected . '>' . esc_html(get_post_type_object($post_type)->labels->singular_name) . '</option>';
    }
    echo '</select>';
}

// Sauvegarder le changement de type de contenu
function save_change_post_type_meta_box_data($post_id) {
    if (isset($_POST['change_post_type'])) {
        $new_post_type = sanitize_text_field($_POST['change_post_type']);
        $current_post_type = get_post_type($post_id);

        // Vérifier si le type de contenu a changé
        if ($new_post_type !== $current_post_type) {
            set_post_type($post_id, $new_post_type);
        }
    }
}
add_action('save_post', 'save_change_post_type_meta_box_data');

// Ajouter une métabox "Layout Options" pour les types de contenu personnalisés
function add_layout_options_meta_box() {
    $post_types = ['newsletter', 'dossier', 'tour_du_monde', 'infographies', 'podcast', 'capsule'];
    foreach ($post_types as $post_type) {
        add_meta_box(
            'layout_options_meta_box', // ID unique
            'Layout Options', // Titre de la métabox
            'render_layout_options_meta_box', // Fonction de rendu
            $post_type, // Type de contenu
            'side', // Contexte
            'default' // Priorité
        );
    }
}
add_action('add_meta_boxes', 'add_layout_options_meta_box');

// Rendu de la métabox "Layout Options"
function render_layout_options_meta_box($post) {
    // Récupérer les valeurs actuelles des options
    $disable_sidebar = get_post_meta($post->ID, '_disable_sidebar', true);
    $header_type = get_post_meta($post->ID, '_header_type', true);

    // Champ pour désactiver la sidebar
    echo '<p><label><input type="checkbox" name="disable_sidebar" value="1" ' . checked($disable_sidebar, '1', false) . '> Désactiver la Sidebar</label></p>';

    // Champ pour sélectionner le type de header
    echo '<p><label for="header_type">Type de Header :</label></p>';
    echo '<select name="header_type" id="header_type" style="width: 100%;">';
    echo '<option value="default" ' . selected($header_type, 'default', false) . '>Default</option>';
    echo '<option value="minimal" ' . selected($header_type, 'minimal', false) . '>Minimal</option>';
    echo '<option value="custom" ' . selected($header_type, 'custom', false) . '>Custom</option>';
    echo '</select>';
}

// Sauvegarder les données de la métabox "Layout Options"
function save_layout_options_meta_box_data($post_id) {
    // Vérifier les permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Sauvegarder l'option "Désactiver la Sidebar"
    if (isset($_POST['disable_sidebar'])) {
        update_post_meta($post_id, '_disable_sidebar', '1');
    } else {
        delete_post_meta($post_id, '_disable_sidebar');
    }

    // Sauvegarder l'option "Type de Header"
    if (isset($_POST['header_type'])) {
        update_post_meta($post_id, '_header_type', sanitize_text_field($_POST['header_type']));
    }
}
add_action('save_post', 'save_layout_options_meta_box_data');

// Ajouter une page d'options dans le menu d'administration
function custom_plugin_add_admin_menu() {
    add_menu_page(
        'Paramètres Interslide', // Titre de la page
        'Interslide', // Titre du menu
        'manage_options', // Capacité requise
        'custom_plugin_settings', // Slug de la page
        'custom_plugin_settings_page', // Fonction de rendu
        'dashicons-admin-generic', // Icône du menu
        80 // Position
    );
}
add_action('admin_menu', 'custom_plugin_add_admin_menu');

// Ajouter une sous-page pour l'exportation des données
function custom_plugin_add_export_page() {
    add_submenu_page(
        'custom_plugin_settings', // Parent slug
        'Exporter les Données', // Titre de la page
        'Exporter', // Titre du menu
        'manage_options', // Capacité requise
        'custom_plugin_export', // Slug de la page
        'custom_plugin_export_page' // Fonction de rendu
    );
}
add_action('admin_menu', 'custom_plugin_add_export_page');

// Ajouter une sous-page pour créer des types de contenu personnalisés
function custom_plugin_add_create_post_type_page() {
    add_submenu_page(
        'custom_plugin_settings', // Parent slug
        'Créer un Type de Contenu', // Titre de la page
        'Créer Type', // Titre du menu
        'manage_options', // Capacité requise
        'custom_plugin_create_post_type', // Slug de la page
        'custom_plugin_create_post_type_page' // Fonction de rendu
    );
}
add_action('admin_menu', 'custom_plugin_add_create_post_type_page');

// Ajouter une sous-page pour gérer les types de contenu
function custom_plugin_add_manage_post_types_page() {
    add_submenu_page(
        'custom_plugin_settings', // Parent slug
        'Gérer les Types de Contenu', // Titre de la page
        'Gérer Types', // Titre du menu
        'manage_options', // Capacité requise
        'custom_plugin_manage_post_types', // Slug de la page
        'custom_plugin_manage_post_types_page' // Fonction de rendu
    );
}
add_action('admin_menu', 'custom_plugin_add_manage_post_types_page');

// Rendu de la page pour gérer les types de contenu
function custom_plugin_manage_post_types_page() {
    // Récupérer les types de contenu enregistrés dans les options
    $custom_post_types = get_option('custom_plugin_post_types', []);

    // Suppression d'un type de contenu si demandé
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_post_type'])) {
        $post_type_to_delete = sanitize_key($_POST['delete_post_type']);
        if (isset($custom_post_types[$post_type_to_delete])) {
            unset($custom_post_types[$post_type_to_delete]);
            update_option('custom_plugin_post_types', $custom_post_types);

            // Supprimer le type de contenu de WordPress
            unregister_post_type($post_type_to_delete);

            echo '<div id="message" class="updated notice is-dismissible"><p>Le type de contenu "' . esc_html($post_type_to_delete) . '" a été supprimé.</p></div>';
        }
    }

    ?>
    <div class="wrap">
        <h1>Gérer les Types de Contenu</h1>
        <table class="widefat fixed" cellspacing="0">
            <thead>
                <tr>
                    <th>Slug</th>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($custom_post_types)) : ?>
                    <?php foreach ($custom_post_types as $slug => $details) : ?>
                        <tr>
                            <td><?php echo esc_html($slug); ?></td>
                            <td><?php echo esc_html($details['label']); ?></td>
                            <td><?php echo $details['hierarchical'] ? 'Page' : 'Article'; ?></td>
                            <td>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="delete_post_type" value="<?php echo esc_attr($slug); ?>">
                                    <?php submit_button('Supprimer', 'delete', '', false); ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4">Aucun type de contenu personnalisé trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

// Rendu de la page pour créer des types de contenu
function custom_plugin_create_post_type_page() {
    ?>
    <div class="wrap">
        <h1>Créer un Type de Contenu</h1>
        <form method="post" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="post_type_name">Nom du type de contenu (slug) :</label></th>
                    <td><input type="text" id="post_type_name" name="post_type_name" required style="width:100%;"></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="post_type_label">Label (Nom affiché) :</label></th>
                    <td><input type="text" id="post_type_label" name="post_type_label" required style="width:100%;"></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="post_type_hierarchical">Type :</label></th>
                    <td>
                        <select id="post_type_hierarchical" name="post_type_hierarchical" style="width:100%;">
                            <option value="0">Article</option>
                            <option value="1">Page</option>
                        </select>
                    </td>
                </tr>
            </table>
            <?php submit_button('Créer le Type de Contenu'); ?>
        </form>
    </div>
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_type_name'], $_POST['post_type_label'])) {
        $post_type_name = sanitize_key($_POST['post_type_name']);
        $post_type_label = sanitize_text_field($_POST['post_type_label']);
        $hierarchical = intval($_POST['post_type_hierarchical']) === 1;

        custom_plugin_register_dynamic_post_type($post_type_name, $post_type_label, $hierarchical);
    }
}

// Enregistrer dynamiquement un type de contenu et le sauvegarder dans les options
function custom_plugin_register_dynamic_post_type($post_type_name, $post_type_label, $hierarchical) {
    $custom_post_types = get_option('custom_plugin_post_types', []);

    if (!post_type_exists($post_type_name)) {
        register_post_type($post_type_name, [
            'labels' => [
                'name' => $post_type_label,
                'singular_name' => $post_type_label,
                'add_new' => 'Ajouter',
                'add_new_item' => 'Ajouter un nouvel élément',
                'edit_item' => 'Modifier l\'élément',
                'new_item' => 'Nouvel élément',
                'view_item' => 'Voir l\'élément',
                'search_items' => 'Rechercher des éléments',
                'not_found' => 'Aucun élément trouvé',
                'not_found_in_trash' => 'Aucun élément trouvé dans la corbeille',
            ],
            'public' => true,
            'has_archive' => !$hierarchical,
            'hierarchical' => $hierarchical,
            'menu_icon' => 'dashicons-admin-generic',
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        ]);

        // Ajouter le type de contenu à la liste des types enregistrés
        $custom_post_types[$post_type_name] = [
            'label' => $post_type_label,
            'hierarchical' => $hierarchical,
        ];
        update_option('custom_plugin_post_types', $custom_post_types);

        echo '<div id="message" class="updated notice is-dismissible"><p>Le type de contenu "' . esc_html($post_type_label) . '" a été créé avec succès.</p></div>';
    } else {
        echo '<div id="message" class="error notice is-dismissible"><p>Le type de contenu "' . esc_html($post_type_name) . '" existe déjà.</p></div>';
    }
}

// Enregistrer les types de contenu dynamiques au chargement
function custom_plugin_register_saved_post_types() {
    // Charger les types de contenu enregistrés dans les options
    $custom_post_types = get_option('custom_plugin_post_types', []);
    foreach ($custom_post_types as $slug => $details) {
        register_post_type($slug, [
            'labels' => [
                'name' => $details['label'],
                'singular_name' => $details['label'],
            ],
            'public' => true,
            'has_archive' => !$details['hierarchical'],
            'hierarchical' => $details['hierarchical'],
            'menu_icon' => 'dashicons-admin-generic',
            'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        ]);
    }
}
add_action('init', 'custom_plugin_register_saved_post_types');

// Rendu de la page d'exportation
function custom_plugin_export_page() {
    ?>
    <div class="wrap">
        <h1>Exporter les Données</h1>
        <form method="post" action="">
            <p>Sélectionnez le type de contenu à exporter :</p>
            <select name="post_type">
                <option value="tour_du_monde">Tour du Monde</option>
                <option value="dossier">Dossiers</option>
                <option value="newsletter">Newsletters</option>
                <option value="infographies">Infographies</option>
                <option value="podcast">Podcasts</option>
                <option value="capsule">Capsules</option>
            </select>
            <?php submit_button('Exporter au format CSV'); ?>
        </form>
    </div>
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_type'])) {
        custom_plugin_export_to_csv(sanitize_text_field($_POST['post_type']));
    }
}

// Fonction pour exporter les données au format CSV
function custom_plugin_export_to_csv($post_type) {
    if (!current_user_can('manage_options')) {
        return;
    }

    $posts = get_posts([
        'post_type' => $post_type,
        'posts_per_page' => -1,
    ]);

    if (empty($posts)) {
        echo '<p>Aucun contenu trouvé pour ce type.</p>';
        return;
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $post_type . '_export.csv"');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Titre', 'Date de publication', 'Lien']);

    foreach ($posts as $post) {
        fputcsv($output, [
            $post->ID,
            $post->post_title,
            $post->post_date,
            get_permalink($post->ID),
        ]);
    }

    fclose($output);
    exit;
}

// Enregistrer les paramètres
function custom_plugin_register_settings() {
    register_setting('custom_plugin_settings_group', 'custom_plugin_podcast_count');
}
add_action('admin_init', 'custom_plugin_register_settings');

// Ajouter des paramètres supplémentaires pour le plugin
function custom_plugin_register_advanced_settings() {
    register_setting('custom_plugin_settings_group', 'custom_plugin_logo');
    register_setting('custom_plugin_settings_group', 'custom_plugin_enable_scheduling');
    register_setting('custom_plugin_settings_group', 'custom_plugin_enable_export');
    register_setting('custom_plugin_settings_group', 'custom_plugin_default_post_count');
    register_setting('custom_plugin_settings_group', 'custom_plugin_enable_dashboard_widget');
}
add_action('admin_init', 'custom_plugin_register_advanced_settings');

// Rendu de la page des paramètres avec les nouvelles options
function custom_plugin_settings_page() {
    ?>
    <div class="wrap">
        <h1>Paramètres du Plugin Interslide</h1>
        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php
            settings_fields('custom_plugin_settings_group');
            do_settings_sections('custom_plugin_settings_group');
            ?>
            <h2>Général</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Logo du Plugin :</th>
                    <td>
                        <?php $logo = get_option('custom_plugin_logo'); ?>
                        <input type="file" name="custom_plugin_logo_upload" accept="image/*">
                        <?php if ($logo): ?>
                            <p><img src="<?php echo esc_url($logo); ?>" alt="Logo du Plugin" style="max-width: 150px;"></p>
                            <input type="checkbox" name="custom_plugin_logo_remove" value="1"> Supprimer le logo
                        <?php endif; ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Nombre d'éléments par défaut :</th>
                    <td>
                        <input type="number" name="custom_plugin_default_post_count" value="<?php echo esc_attr(get_option('custom_plugin_default_post_count', 5)); ?>" min="1">
                    </td>
                </tr>
            </table>

            <h2>Fonctionnalités</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Activer la Programmation :</th>
                    <td>
                        <input type="checkbox" name="custom_plugin_enable_scheduling" value="1" <?php checked(get_option('custom_plugin_enable_scheduling'), 1); ?>>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Activer l'Exportation :</th>
                    <td>
                        <input type="checkbox" name="custom_plugin_enable_export" value="1" <?php checked(get_option('custom_plugin_enable_export'), 1); ?>>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Afficher le Widget Tableau de Bord :</th>
                    <td>
                        <input type="checkbox" name="custom_plugin_enable_dashboard_widget" value="1" <?php checked(get_option('custom_plugin_enable_dashboard_widget'), 1); ?>>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php

    // Gestion du téléchargement et de la suppression du logo
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_FILES['custom_plugin_logo_upload']['tmp_name'])) {
            $uploaded = wp_upload_bits($_FILES['custom_plugin_logo_upload']['name'], null, file_get_contents($_FILES['custom_plugin_logo_upload']['tmp_name']));
            if (!$uploaded['error']) {
                update_option('custom_plugin_logo', $uploaded['url']);
            }
        }
        if (!empty($_POST['custom_plugin_logo_remove'])) {
            delete_option('custom_plugin_logo');
        }
    }
}

// Désactiver les fonctionnalités en fonction des paramètres
function custom_plugin_disable_features() {
    if (!get_option('custom_plugin_enable_scheduling')) {
        remove_action('init', 'schedule_auto_publish');
    }
    if (!get_option('custom_plugin_enable_export')) {
        remove_action('admin_menu', 'custom_plugin_add_export_page');
    }
    if (!get_option('custom_plugin_enable_dashboard_widget')) {
        remove_action('wp_dashboard_setup', 'custom_dashboard_widget');
    }
}
add_action('init', 'custom_plugin_disable_features');

// Shortcode pour afficher les derniers podcasts
function latest_podcasts_shortcode($atts) {
    $default_count = get_option('custom_plugin_podcast_count', 5);
    $atts = shortcode_atts([
        'count' => $default_count,
    ], $atts, 'latest_podcasts');

    // Requête pour récupérer les derniers podcasts
    $query = new WP_Query([
        'post_type' => 'podcast',
        'posts_per_page' => intval($atts['count']),
    ]);

    // Générer la sortie HTML
    if ($query->have_posts()) {
        $output = '<ul class="latest-podcasts">';
        while ($query->have_posts()) {
            $query->the_post();
            $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
        }
        $output .= '</ul>';
        wp_reset_postdata();
    } else {
        $output = '<p>Aucun podcast trouvé.</p>';
    }

    return $output;
}
add_shortcode('latest_podcasts', 'latest_podcasts_shortcode');

// Ajouter un widget au tableau de bord
function custom_dashboard_widget() {
    wp_add_dashboard_widget(
        'custom_dashboard_widget', // ID du widget
        'Statistiques des Types de Contenu', // Titre du widget
        'render_custom_dashboard_widget' // Fonction de rendu
    );
}
add_action('wp_dashboard_setup', 'custom_dashboard_widget');

// Rendu du widget
function render_custom_dashboard_widget() {
    $post_types = ['tour_du_monde', 'dossier', 'newsletter', 'infographies', 'podcast', 'capsule'];
    echo '<ul>';
    foreach ($post_types as $post_type) {
        $post_type_object = get_post_type_object($post_type);
        $count = wp_count_posts($post_type)->publish;
        echo '<li>' . esc_html($post_type_object->labels->name) . ': ' . esc_html($count) . ' publiés</li>';
    }
    echo '</ul>';
}

// Ajouter une action en masse pour changer le type de contenu
function add_bulk_action_change_post_type($bulk_actions) {
    $bulk_actions['change_to_tour_du_monde'] = 'Déplacer vers Tour du Monde';
    return $bulk_actions;
}
add_filter('bulk_actions-edit-post', 'add_bulk_action_change_post_type');

// Traiter l'action en masse pour changer le type de contenu
function handle_bulk_action_change_post_type($redirect_to, $doaction, $post_ids) {
    if ($doaction === 'change_to_tour_du_monde') {
        foreach ($post_ids as $post_id) {
            set_post_type($post_id, 'tour_du_monde');
        }
        $redirect_to = add_query_arg('bulk_changed_posts', count($post_ids), $redirect_to);
    }
    return $redirect_to;
}
add_filter('handle_bulk_actions-edit-post', 'handle_bulk_action_change_post_type', 10, 3);

// Ajouter un message de confirmation après l'action en masse
function bulk_action_change_post_type_admin_notice() {
    if (!empty($_REQUEST['bulk_changed_posts'])) {
        $changed_count = intval($_REQUEST['bulk_changed_posts']);
        printf('<div id="message" class="updated notice is-dismissible"><p>%s articles déplacés vers Tour du Monde.</p></div>', $changed_count);
    }
}
add_action('admin_notices', 'bulk_action_change_post_type_admin_notice');

// Ajouter une action en masse pour changer le type de contenu des pages
function add_bulk_action_change_page_type($bulk_actions) {
    $bulk_actions['change_to_dossier'] = 'Déplacer vers Dossier';
    return $bulk_actions;
}
add_filter('bulk_actions-edit-page', 'add_bulk_action_change_page_type');

// Traiter l'action en masse pour changer le type de contenu des pages
function handle_bulk_action_change_page_type($redirect_to, $doaction, $post_ids) {
    if ($doaction === 'change_to_dossier') {
        foreach ($post_ids as $post_id) {
            set_post_type($post_id, 'dossier');
        }
        $redirect_to = add_query_arg('bulk_changed_pages', count($post_ids), $redirect_to);
    }
    return $redirect_to;
}
add_filter('handle_bulk_actions-edit-page', 'handle_bulk_action_change_page_type', 10, 3);

// Ajouter un message de confirmation après l'action en masse pour les pages
function bulk_action_change_page_type_admin_notice() {
    if (!empty($_REQUEST['bulk_changed_pages'])) {
        $changed_count = intval($_REQUEST['bulk_changed_pages']);
        printf('<div id="message" class="updated notice is-dismissible"><p>%s pages déplacées vers Dossier.</p></div>', $changed_count);
    }
}
add_action('admin_notices', 'bulk_action_change_page_type_admin_notice');

// Supprimer les publications similaires ajoutées via un filtre sur 'the_content'
function remove_related_posts($content) {
    // Vérifiez et supprimez les publications similaires si elles sont ajoutées ici
    // Exemple : Si un contenu spécifique est ajouté, vous pouvez le filtrer
    $content = preg_replace('/<div class="related-posts">.*?<\/div>/s', '', $content);
    return $content;
}
add_filter('the_content', 'remove_related_posts', 20);
