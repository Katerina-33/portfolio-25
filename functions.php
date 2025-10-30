<?php
// ===== CSS & JS =====
function mytheme_enqueue_scripts() {
    wp_enqueue_style('mytheme-style', get_stylesheet_uri());

    wp_enqueue_style(
        'mytheme-main',
        get_template_directory_uri() . '/assets/css/style.css',
        [],
        filemtime(get_template_directory() . '/assets/css/style.css')
    );

    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap',
        [],
        null
    );

    wp_enqueue_script(
        'mytheme-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        null,
        true
    );
    wp_enqueue_script(
        'mytheme-navigation',
        get_template_directory_uri() . '/assets/js/navigation.js',
        [],
        null,
        true
    );
    wp_enqueue_script(
        'hero-js',
        get_template_directory_uri() . '/assets/js/hero.js',
        [],
        filemtime(get_template_directory() . '/assets/js/hero.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');



// Ujistěte se, že soubor začíná touto značkou (obvykle tam už je, pokud je to functions.php)


// =================================================================
// 1. ZAJIŠTĚNÍ PODPORY NÁHLEDOVÝCH OBRÁZKŮ (FEATURED IMAGE)
// Tato funkce je nutná, aby se pole pro obrázek vůbec zobrazilo
// ve starších šablonách nebo v některých prostředích.
// =================================================================
if ( ! function_exists( 'portfolio_theme_setup' ) ) {
    function portfolio_theme_setup() {
        // Přidá podporu náhledových obrázků pro VŠECHNY post typy (včetně CPT)
        add_theme_support( 'post-thumbnails' ); 
    }
}
add_action( 'after_setup_theme', 'portfolio_theme_setup' );


// =================================================================
// 2. REGISTRACE CUSTOM POST TYPE (CPT) 'PORTFOLIO'
// =================================================================
function create_portfolio_cpt() {
    $labels = array(
        'name' => 'Portfolio',
        'singular_name' => 'Projekt',
        'add_new_item' => 'Přidat nový projekt',
        'edit_item' => 'Upravit projekt',
        'all_items' => 'Všechny projekty',
        'menu_name' => 'Portfolio'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-portfolio',
        // 'title', 'excerpt' (krátký popis), 'thumbnail' (náhledový obrázek)
        'supports' => array('title', 'excerpt', 'thumbnail'),
        'show_in_rest' => true, 
        'rewrite' => array('slug' => 'projekt'),
    );

    register_post_type('portfolio', $args);
}
add_action('init', 'create_portfolio_cpt');


// =================================================================
// 3. META BOX PRO ODKAZ NA PROJEKT (Custom Field: project_link)
// Tato část zajišťuje pole pro odkaz, které používáte ve svém HTML.
// =================================================================

// Přidání meta boxu do administrace
function portfolio_add_custom_box() {
    add_meta_box(
        'portfolio_link_box',
        'Odkaz na hotový projekt',
        'portfolio_link_box_callback',
        'portfolio', // Pouze pro CPT 'portfolio'
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'portfolio_add_custom_box');

// Obsah meta boxu (formulářové pole)
function portfolio_link_box_callback( $post ) {
    // Nonce pro bezpečnost
    wp_nonce_field( 'portfolio_link_save_meta_box_data', 'portfolio_link_meta_box_nonce' );
    // Načtení uložené hodnoty klíče 'project_link'
    $value = get_post_meta( $post->ID, 'project_link', true );
    ?>
    <p>
        <label for="project_link_field">
            Vložte plný odkaz na projekt (včetně https://):
        </label><br>
        <input type="url" id="project_link_field" name="project_link_field" value="<?php echo esc_attr( $value ); ?>" style="width: 100%;" />
    </p>
    <?php
}

// Uložení dat z meta boxu
function portfolio_save_meta_box_data( $post_id ) {
    // Kontrola nonce a oprávnění...
    if ( ! isset( $_POST['portfolio_link_meta_box_nonce'] ) ) { return; }
    if ( ! wp_verify_nonce( $_POST['portfolio_link_meta_box_nonce'], 'portfolio_link_save_meta_box_data' ) ) { return; }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
    if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

    // Uložení dat
    if ( isset( $_POST['project_link_field'] ) ) {
        // Sanitizace dat (čištění)
        $my_data = sanitize_url( $_POST['project_link_field'] );
        // Klíč Custom Fieldu, který používáte ve smyčce: 'project_link'
        update_post_meta( $post_id, 'project_link', $my_data );
    }
}
add_action( 'save_post', 'portfolio_save_meta_box_data' );

?>