<?php

// Shortcode pour afficher le trombinoscope
function trombinoscope_display_grid($atts) {
    $args = [
        'post_type' => 'depute',
        'posts_per_page' => -1,
    ];
    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()) {
        echo '<div class="trombinoscope-grid">';
        while ($query->have_posts()) {
            $query->the_post();
            $photo = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
            $name = get_the_title();
            $link = get_permalink();
            echo "<div class='trombinoscope-item'>
                    <a href='{$link}'>{$photo}<h3>{$name}</h3></a>
                  </div>";
        }
        echo '</div>';
    } else {
        echo '<p>Aucun député trouvé.</p>';
    }
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('trombinoscope_grid', 'trombinoscope_display_grid');

// Shortcode pour afficher une fiche individuelle
function trombinoscope_display_single($atts) {
    if (!is_singular('depute')) {
        return '';
    }

    ob_start();
    echo '<div class="trombinoscope-single">';
    echo get_the_post_thumbnail(get_the_ID(), 'large');
    echo '<h1>' . get_the_title() . '</h1>';
    echo '<div>' . get_the_content() . '</div>';

    // Afficher les champs personnalisés
    $email = get_post_meta(get_the_ID(), '_trombinoscope_email', true);
    $phone = get_post_meta(get_the_ID(), '_trombinoscope_phone', true);
    if ($email) {
        echo '<p><strong>Email :</strong> ' . esc_html($email) . '</p>';
    }
    if ($phone) {
        echo '<p><strong>Téléphone :</strong> ' . esc_html($phone) . '</p>';
    }

    echo '</div>';
    return ob_get_clean();
}
add_shortcode('trombinoscope_single', 'trombinoscope_display_single');

// Enregistrement de la taxonomie "Département"
function trombinoscope_register_departements_taxonomy() {
    register_taxonomy('departement', 'depute', [
        'label' => 'Départements',
        'hierarchical' => true,
        'rewrite' => ['slug' => 'departement'],
    ]);
}
add_action('init', 'trombinoscope_register_departements_taxonomy');

// Shortcode pour afficher le trombinoscope avec filtres
function trombinoscope_display_grid_with_filters($atts) {
    $atts = shortcode_atts([], $atts);

    // Récupérer les termes des taxonomies nécessaires
    $circonscription_terms = get_terms(['taxonomy' => 'circonscription', 'hide_empty' => true]);
    $appartenance_terms = get_terms(['taxonomy' => 'appartenance_politique', 'hide_empty' => true]);

    // Filtrage par taxonomie
    $selected_circonscription = isset($_GET['circonscription_filter']) ? sanitize_text_field($_GET['circonscription_filter']) : '';
    $selected_appartenance = isset($_GET['appartenance_filter']) ? sanitize_text_field($_GET['appartenance_filter']) : '';

    $args = [
        'post_type' => 'depute',
        'posts_per_page' => -1,
        'tax_query' => [
            'relation' => 'AND',
            $selected_circonscription ? ['taxonomy' => 'circonscription', 'field' => 'slug', 'terms' => $selected_circonscription] : [],
            $selected_appartenance ? ['taxonomy' => 'appartenance_politique', 'field' => 'slug', 'terms' => $selected_appartenance] : [],
        ],
    ];
    $query = new WP_Query($args);

    ob_start();

    // Afficher les filtres
    echo '<form method="GET" class="trombinoscope-filters">';
    echo '<select name="circonscription_filter" onchange="this.form.submit()">';
    echo '<option value="">Toutes les circonscriptions</option>';
    foreach ($circonscription_terms as $term) {
        $selected = $selected_circonscription === $term->slug ? 'selected' : '';
        echo "<option value='{$term->slug}' {$selected}>{$term->name}</option>";
    }
    echo '</select>';

    echo '<select name="appartenance_filter" onchange="this.form.submit()">';
    echo '<option value="">Toutes les appartenances</option>';
    foreach ($appartenance_terms as $term) {
        $selected = $selected_appartenance === $term->slug ? 'selected' : '';
        echo "<option value='{$term->slug}' {$selected}>{$term->name}</option>";
    }
    echo '</select>';
    echo '</form>';

    // Afficher la grille
    if ($query->have_posts()) {
        echo '<div class="trombinoscope-grid">';
        while ($query->have_posts()) {
            $query->the_post();
            $photo = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
            $name = get_the_title();
            $link = get_permalink();
            echo "<div class='trombinoscope-item'>
                    <a href='{$link}'>{$photo}<h3>{$name}</h3></a>
                  </div>";
        }
        echo '</div>';
    } else {
        echo '<p>Aucun député trouvé.</p>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('trombinoscope_grid_with_filters', 'trombinoscope_display_grid_with_filters');

// Ajouter une page d'administration pour gérer les députés
function trombinoscope_add_admin_menu() {
    add_menu_page(
        'Gestion des Députés', // Titre de la page
        'Députés',            // Titre du menu
        'manage_options',     // Capacité requise
        'trombinoscope_admin', // Slug de la page
        'trombinoscope_admin_page', // Fonction de rappel
        'dashicons-groups',   // Icône du menu
        20                    // Position dans le menu
    );
}
add_action('admin_menu', 'trombinoscope_add_admin_menu');

// Contenu de la page d'administration
function trombinoscope_admin_page() {
    echo '<div class="wrap">';
    echo '<h1>Gestion des Députés</h1>';
    echo '<p>Utilisez cette page pour gérer les députés et leurs informations.</p>';

    // Lien vers l'éditeur des députés
    echo '<a href="' . admin_url('edit.php?post_type=depute') . '" class="button button-primary">Gérer les Députés</a>';

    // Lien vers les taxonomies
    echo '<h2>Taxonomies</h2>';
    echo '<ul>';
    echo '<li><a href="' . admin_url('edit-tags.php?taxonomy=groupe_politique&post_type=depute') . '">Groupes Politiques</a></li>';
    echo '<li><a href="' . admin_url('edit-tags.php?taxonomy=departement&post_type=depute') . '">Départements</a></li>';
    echo '</ul>';
    echo '</div>';
}

// Ajouter une sous-page pour l'import/export CSV
function trombinoscope_add_import_export_submenu() {
    add_submenu_page(
        'trombinoscope_admin', // Parent slug
        'Import/Export CSV',   // Page title
        'Import/Export',       // Menu title
        'manage_options',      // Capability
        'trombinoscope_import_export', // Slug
        'trombinoscope_import_export_page' // Callback function
    );
}
add_action('admin_menu', 'trombinoscope_add_import_export_submenu');

// Contenu de la page Import/Export
function trombinoscope_import_export_page() {
    echo '<div class="wrap">';
    echo '<h1>Import/Export CSV</h1>';

    // Formulaire d'import
    echo '<h2>Importer des Députés</h2>';
    echo '<form method="POST" enctype="multipart/form-data">';
    echo '<input type="file" name="trombinoscope_csv" accept=".csv" required>';
    echo '<button type="submit" name="trombinoscope_import" class="button button-primary">Importer</button>';
    echo '</form>';

    // Formulaire d'export
    echo '<h2>Exporter les Députés</h2>';
    echo '<form method="POST">';
    echo '<button type="submit" name="trombinoscope_export" class="button button-secondary">Exporter</button>';
    echo '</form>';
    echo '</div>';

    // Gestion de l'import
    if (isset($_POST['trombinoscope_import']) && !empty($_FILES['trombinoscope_csv']['tmp_name'])) {
        $file = fopen($_FILES['trombinoscope_csv']['tmp_name'], 'r');
        while (($data = fgetcsv($file)) !== false) {
            wp_insert_post([
                'post_type' => 'depute',
                'post_title' => sanitize_text_field($data[0]),
                'post_content' => sanitize_textarea_field($data[1]),
                'post_status' => 'publish',
            ]);
        }
        fclose($file);
        echo '<div class="updated"><p>Importation réussie.</p></div>';
    }

    // Gestion de l'export
    if (isset($_POST['trombinoscope_export'])) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=deputes.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Nom', 'Description']);
        $query = new WP_Query(['post_type' => 'depute', 'posts_per_page' => -1]);
        while ($query->have_posts()) {
            $query->the_post();
            fputcsv($output, [get_the_title(), get_the_content()]);
        }
        fclose($output);
        exit;
    }
}

// Ajout de la pagination au trombinoscope
function trombinoscope_display_grid_with_pagination($atts) {
    $atts = shortcode_atts([
        'posts_per_page' => 10, // Nombre de députés par page
    ], $atts);

    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    $args = [
        'post_type' => 'depute',
        'posts_per_page' => $atts['posts_per_page'],
        'paged' => $paged,
    ];
    $query = new WP_Query($args);

    ob_start();

    // Afficher la grille
    if ($query->have_posts()) {
        echo '<div class="trombinoscope-grid">';
        while ($query->have_posts()) {
            $query->the_post();
            $photo = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
            $name = get_the_title();
            $link = get_permalink();
            echo "<div class='trombinoscope-item'>
                    <a href='{$link}'>{$photo}<h3>{$name}</h3></a>
                  </div>";
        }
        echo '</div>';

        // Afficher la pagination
        echo '<div class="trombinoscope-pagination">';
        echo paginate_links([
            'total' => $query->max_num_pages,
            'current' => $paged,
        ]);
        echo '</div>';
    } else {
        echo '<p>Aucun député trouvé.</p>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('trombinoscope_grid_with_pagination', 'trombinoscope_display_grid_with_pagination');

// Ajouter des champs personnalisés pour les députés
function trombinoscope_register_custom_fields() {
    add_action('add_meta_boxes', function () {
        add_meta_box(
            'trombinoscope_meta_box',
            'Informations supplémentaires',
            'trombinoscope_meta_box_callback',
            'depute',
            'normal',
            'high'
        );
    });

    add_action('save_post', function ($post_id) {
        if (array_key_exists('trombinoscope_email', $_POST)) {
            update_post_meta($post_id, '_trombinoscope_email', sanitize_email($_POST['trombinoscope_email']));
        }
        if (array_key_exists('trombinoscope_phone', $_POST)) {
            update_post_meta($post_id, '_trombinoscope_phone', sanitize_text_field($_POST['trombinoscope_phone']));
        }
    });
}
add_action('init', 'trombinoscope_register_custom_fields');

function trombinoscope_meta_box_callback($post) {
    $email = get_post_meta($post->ID, '_trombinoscope_email', true);
    $phone = get_post_meta($post->ID, '_trombinoscope_phone', true);

    echo '<label for="trombinoscope_email">Email :</label>';
    echo '<input type="email" id="trombinoscope_email" name="trombinoscope_email" value="' . esc_attr($email) . '" style="width:100%;">';

    echo '<label for="trombinoscope_phone" style="margin-top:10px;display:block;">Téléphone :</label>';
    echo '<input type="text" id="trombinoscope_phone" name="trombinoscope_phone" value="' . esc_attr($phone) . '" style="width:100%;">';
}

// Shortcode pour la recherche AJAX
function trombinoscope_ajax_search() {
    ob_start();
    ?>
    <div class="trombinoscope-search">
        <input type="text" id="trombinoscope-search-input" placeholder="Rechercher un député...">
        <div id="trombinoscope-search-results"></div>
    </div>
    <script>
        document.getElementById('trombinoscope-search-input').addEventListener('input', function () {
            const query = this.value;
            const resultsContainer = document.getElementById('trombinoscope-search-results');
            resultsContainer.innerHTML = 'Recherche en cours...';

            fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=trombinoscope_search&query=' + query)
                .then(response => response.json())
                .then(data => {
                    resultsContainer.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(depute => {
                            const item = document.createElement('div');
                            item.innerHTML = `<a href="${depute.link}">${depute.name}</a>`;
                            resultsContainer.appendChild(item);
                        });
                    } else {
                        resultsContainer.innerHTML = 'Aucun résultat trouvé.';
                    }
                });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('trombinoscope_search', 'trombinoscope_ajax_search');

// Action AJAX pour la recherche
function trombinoscope_ajax_search_handler() {
    $query = sanitize_text_field($_GET['query']);
    $args = [
        'post_type' => 'depute',
        's' => $query,
        'posts_per_page' => -1,
    ];
    $query = new WP_Query($args);

    $results = [];
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $results[] = [
                'name' => get_the_title(),
                'link' => get_permalink(),
            ];
        }
    }
    wp_reset_postdata();

    wp_send_json($results);
}
add_action('wp_ajax_trombinoscope_search', 'trombinoscope_ajax_search_handler');
add_action('wp_ajax_nopriv_trombinoscope_search', 'trombinoscope_ajax_search_handler');

// Shortcode pour afficher le trombinoscope avec tri
function trombinoscope_display_grid_with_sorting($atts) {
    $atts = shortcode_atts([
        'posts_per_page' => 10, // Nombre de députés par page
    ], $atts);

    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'title';
    $order = isset($_GET['order']) ? sanitize_text_field($_GET['order']) : 'ASC';

    $args = [
        'post_type' => 'depute',
        'posts_per_page' => $atts['posts_per_page'],
        'paged' => $paged,
        'orderby' => $orderby,
        'order' => $order,
    ];
    $query = new WP_Query($args);

    ob_start();

    // Formulaire de tri
    echo '<form method="GET" class="trombinoscope-sorting">';
    echo '<select name="orderby" onchange="this.form.submit()">';
    echo '<option value="title" ' . selected($orderby, 'title', false) . '>Nom</option>';
    echo '<option value="date" ' . selected($orderby, 'date', false) . '>Date</option>';
    echo '</select>';
    echo '<select name="order" onchange="this.form.submit()">';
    echo '<option value="ASC" ' . selected($order, 'ASC', false) . '>Croissant</option>';
    echo '<option value="DESC" ' . selected($order, 'DESC', false) . '>Décroissant</option>';
    echo '</select>';
    echo '</form>';

    // Afficher la grille
    if ($query->have_posts()) {
        echo '<div class="trombinoscope-grid">';
        while ($query->have_posts()) {
            $query->the_post();
            $photo = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
            $name = get_the_title();
            $link = get_permalink();
            echo "<div class='trombinoscope-item'>
                    <a href='{$link}'>{$photo}<h3>{$name}</h3></a>
                  </div>";
        }
        echo '</div>';

        // Afficher la pagination
        echo '<div class="trombinoscope-pagination">';
        echo paginate_links([
            'total' => $query->max_num_pages,
            'current' => $paged,
        ]);
        echo '</div>';
    } else {
        echo '<p>Aucun député trouvé.</p>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('trombinoscope_grid_with_sorting', 'trombinoscope_display_grid_with_sorting');

// Ajouter un système de favoris
function trombinoscope_add_to_favorites() {
    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();

    if ($user_id && $post_id) {
        $favorites = get_user_meta($user_id, 'trombinoscope_favorites', true);
        if (!$favorites) {
            $favorites = [];
        }

        if (!in_array($post_id, $favorites)) {
            $favorites[] = $post_id;
            update_user_meta($user_id, 'trombinoscope_favorites', $favorites);
            wp_send_json_success(['message' => 'Ajouté aux favoris.']);
        } else {
            wp_send_json_error(['message' => 'Déjà dans les favoris.']);
        }
    } else {
        wp_send_json_error(['message' => 'Action non autorisée.']);
    }

    wp_die();
}
add_action('wp_ajax_trombinoscope_add_to_favorites', 'trombinoscope_add_to_favorites');

// Shortcode pour afficher une grille de députés avec pagination et filtres
function trombinoscope_display_advanced_grid($atts) {
    $atts = shortcode_atts([
        'posts_per_page' => 10, // Nombre de députés par page
    ], $atts);

    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    // Récupérer les termes des taxonomies nécessaires
    $circonscription_terms = get_terms(['taxonomy' => 'circonscription', 'hide_empty' => true]);
    $appartenance_terms = get_terms(['taxonomy' => 'appartenance_politique', 'hide_empty' => true]);

    // Filtrage par taxonomie
    $selected_circonscription = isset($_GET['circonscription_filter']) ? sanitize_text_field($_GET['circonscription_filter']) : '';
    $selected_appartenance = isset($_GET['appartenance_filter']) ? sanitize_text_field($_GET['appartenance_filter']) : '';

    $args = [
        'post_type' => 'depute',
        'posts_per_page' => $atts['posts_per_page'],
        'paged' => $paged,
        'tax_query' => [
            'relation' => 'AND',
            $selected_circonscription ? ['taxonomy' => 'circonscription', 'field' => 'slug', 'terms' => $selected_circonscription] : [],
            $selected_appartenance ? ['taxonomy' => 'appartenance_politique', 'field' => 'slug', 'terms' => $selected_appartenance] : [],
        ],
    ];
    $query = new WP_Query($args);

    ob_start();

    // Afficher les filtres
    echo '<form method="GET" class="trombinoscope-filters">';
    echo '<select name="circonscription_filter" onchange="this.form.submit()">';
    echo '<option value="">Toutes les circonscriptions</option>';
    foreach ($circonscription_terms as $term) {
        $selected = $selected_circonscription === $term->slug ? 'selected' : '';
        echo "<option value='{$term->slug}' {$selected}>{$term->name}</option>";
    }
    echo '</select>';

    echo '<select name="appartenance_filter" onchange="this.form.submit()">';
    echo '<option value="">Toutes les appartenances</option>';
    foreach ($appartenance_terms as $term) {
        $selected = $selected_appartenance === $term->slug ? 'selected' : '';
        echo "<option value='{$term->slug}' {$selected}>{$term->name}</option>";
    }
    echo '</select>';
    echo '</form>';

    // Afficher la grille
    if ($query->have_posts()) {
        echo '<div class="trombinoscope-grid">';
        while ($query->have_posts()) {
            $query->the_post();
            $photo = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
            $name = get_the_title();
            $link = get_permalink();
            echo "<div class='trombinoscope-item'>
                    <a href='{$link}'>{$photo}<h3>{$name}</h3></a>
                  </div>";
        }
        echo '</div>';

        // Afficher la pagination
        echo '<div class="trombinoscope-pagination">';
        echo paginate_links([
            'total' => $query->max_num_pages,
            'current' => $paged,
        ]);
        echo '</div>';
    } else {
        echo '<p>Aucun député trouvé.</p>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('trombinoscope_advanced_grid', 'trombinoscope_display_advanced_grid');

// Shortcode pour afficher les détails d'un député avec ses taxonomies
function trombinoscope_display_depute_details($atts) {
    if (!is_singular('depute')) {
        return '';
    }

    ob_start();
    echo '<div class="trombinoscope-single">';
    echo get_the_post_thumbnail(get_the_ID(), 'large');
    echo '<h1>' . get_the_title() . '</h1>';
    echo '<div>' . get_the_content() . '</div>';

    // Afficher les taxonomies
    $circonscription = wp_get_post_terms(get_the_ID(), 'circonscription', ['fields' => 'names']);
    $appartenance = wp_get_post_terms(get_the_ID(), 'appartenance_politique', ['fields' => 'names']);

    if (!empty($circonscription)) {
        echo '<p><strong>Circonscription :</strong> ' . esc_html(implode(', ', $circonscription)) . '</p>';
    }
    if (!empty($appartenance)) {
        echo '<p><strong>Appartenance politique :</strong> ' . esc_html(implode(', ', $appartenance)) . '</p>';
    }

    // Afficher les champs personnalisés
    $email = get_post_meta(get_the_ID(), '_trombinoscope_email', true);
    $phone = get_post_meta(get_the_ID(), '_trombinoscope_phone', true);
    if ($email) {
        echo '<p><strong>Email :</strong> ' . esc_html($email) . '</p>';
    }
    if ($phone) {
        echo '<p><strong>Téléphone :</strong> ' . esc_html($phone) . '</p>';
    }

    echo '</div>';
    return ob_get_clean();
}
add_shortcode('trombinoscope_depute_details', 'trombinoscope_display_depute_details');

// Shortcode pour afficher une liste des circonscriptions avec le nombre de députés
function trombinoscope_list_circonscriptions() {
    $terms = get_terms(['taxonomy' => 'circonscription', 'hide_empty' => true]);

    ob_start();
    if (!empty($terms)) {
        echo '<ul class="trombinoscope-circonscriptions">';
        foreach ($terms as $term) {
            $count = $term->count;
            $link = get_term_link($term);
            echo "<li><a href='{$link}'>{$term->name} ({$count})</a></li>";
        }
        echo '</ul>';
    } else {
        echo '<p>Aucune circonscription trouvée.</p>';
    }
    return ob_get_clean();
}
add_shortcode('trombinoscope_circonscriptions', 'trombinoscope_list_circonscriptions');

// Shortcode pour afficher une liste des appartenances politiques avec le nombre de députés
function trombinoscope_list_appartenances() {
    $terms = get_terms(['taxonomy' => 'appartenance_politique', 'hide_empty' => true]);

    ob_start();
    if (!empty($terms)) {
        echo '<ul class="trombinoscope-appartenances">';
        foreach ($terms as $term) {
            $count = $term->count;
            $link = get_term_link($term);
            echo "<li><a href='{$link}'>{$term->name} ({$count})</a></li>";
        }
        echo '</ul>';
    } else {
        echo '<p>Aucune appartenance politique trouvée.</p>';
    }
    return ob_get_clean();
}
add_shortcode('trombinoscope_appartenances', 'trombinoscope_list_appartenances');

// Shortcode pour afficher une carte interactive du Maroc
function trombinoscope_interactive_map($atts) {
    $atts = shortcode_atts([], $atts);

    // Récupérer toutes les circonscriptions
    $circonscriptions = get_terms(['taxonomy' => 'circonscription', 'hide_empty' => true]);

    ob_start();
    ?>
    <div id="trombinoscope-map">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" class="map-svg">
            <!-- Exemple de régions (remplacez par les vraies régions du Maroc) -->
            <a href="#" class="map-region" data-circonscription="rabat">
                <path d="M100,100 L200,100 L200,200 L100,200 Z" title="Rabat"></path>
            </a>
            <a href="#" class="map-region" data-circonscription="casablanca">
                <path d="M300,300 L400,300 L400,400 L300,400 Z" title="Casablanca"></path>
            </a>
            <!-- Ajoutez d'autres régions ici -->
        </svg>
    </div>
    <div id="trombinoscope-grid-container">
        <p>Sélectionnez une circonscription sur la carte pour afficher les députés.</p>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const regions = document.querySelectorAll('.map-region');
            const gridContainer = document.getElementById('trombinoscope-grid-container');

            regions.forEach(region => {
                region.addEventListener('click', function (e) {
                    e.preventDefault();
                    const circonscriptionSlug = this.dataset.circonscription;

                    // Charger les députés via AJAX
                    gridContainer.innerHTML = 'Chargement des députés...';
                    fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=load_deputes_by_circonscription&circonscription=' + circonscriptionSlug)
                        .then(response => response.text())
                        .then(data => {
                            gridContainer.innerHTML = data;
                        });
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('trombinoscope_map', 'trombinoscope_interactive_map');

// Shortcode pour afficher une carte interactive du Maroc avec une image
function trombinoscope_interactive_map_with_image($atts) {
    $atts = shortcode_atts([], $atts);

    // Récupérer toutes les circonscriptions
    $circonscriptions = get_terms(['taxonomy' => 'circonscription', 'hide_empty' => true]);

    ob_start();
    ?>
    <div id="trombinoscope-map-container" style="position: relative; max-width: 800px; margin: 0 auto;">
        <img src="<?php echo plugin_dir_url(__FILE__) . 'Map_of_provinces_and_prefectures_of_Morocco_(including_Western_Sahara).png'; ?>" alt="Carte du Maroc" style="width: 100%; height: auto;">
        <?php foreach ($circonscriptions as $circonscription): ?>
            <!-- Exemple de positionnement absolu pour une région -->
            <a href="#" class="map-region" data-circonscription="<?php echo esc_attr($circonscription->slug); ?>" 
               style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 20px; height: 20px; background: rgba(0, 115, 170, 0.8); border-radius: 50%;"
               title="<?php echo esc_attr($circonscription->name); ?>"></a>
        <?php endforeach; ?>
    </div>
    <div id="trombinoscope-grid-container">
        <p>Sélectionnez une circonscription sur la carte pour afficher les députés.</p>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const regions = document.querySelectorAll('.map-region');
            const gridContainer = document.getElementById('trombinoscope-grid-container');

            regions.forEach(region => {
                region.addEventListener('click', function (e) {
                    e.preventDefault();
                    const circonscriptionSlug = this.dataset.circonscription;

                    // Charger les députés via AJAX
                    gridContainer.innerHTML = 'Chargement des députés...';
                    fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=load_deputes_by_circonscription&circonscription=' + circonscriptionSlug)
                        .then(response => response.text())
                        .then(data => {
                            gridContainer.innerHTML = data;
                        });
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('trombinoscope_map_with_image', 'trombinoscope_interactive_map_with_image');

// Action AJAX pour charger les députés par circonscription
function trombinoscope_load_deputes_by_circonscription() {
    $circonscription_slug = sanitize_text_field($_GET['circonscription']);

    $args = [
        'post_type' => 'depute',
        'posts_per_page' => -1,
        'tax_query' => [
            [
                'taxonomy' => 'circonscription',
                'field' => 'slug',
                'terms' => $circonscription_slug,
            ],
        ],
    ];
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<div class="trombinoscope-grid">';
        while ($query->have_posts()) {
            $query->the_post();
            $photo = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
            $name = get_the_title();
            $link = get_permalink();
            echo "<div class='trombinoscope-item'>
                    <a href='{$link}'>{$photo}<h3>{$name}</h3></a>
                  </div>";
        }
        echo '</div>';
    } else {
        echo '<p>Aucun député trouvé pour cette circonscription.</p>';
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_deputes_by_circonscription', 'trombinoscope_load_deputes_by_circonscription');
add_action('wp_ajax_nopriv_load_deputes_by_circonscription', 'trombinoscope_load_deputes_by_circonscription');
