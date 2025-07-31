<?php
// Theme setup
function bem_theme_setup() {
    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'secondary' => 'Secondary Menu',
        'footer' => 'Footer Menu'
    ));
}
add_action('after_setup_theme', 'bem_theme_setup');

// Enqueue styles and scripts
function bem_enqueue_assets() {
    wp_enqueue_style('bem-style', get_stylesheet_uri());
    wp_enqueue_style('bem-custom', get_template_directory_uri() . '/assets/css/custom.css');
    wp_enqueue_script('bem-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true);
    
    // Enqueue additional libraries
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), '1.0', true);
    wp_enqueue_style('aos-css', 'https://unpkg.com/aos@2.3.1/dist/aos.css');
    wp_enqueue_script('aos-js', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'bem_enqueue_assets');

// Register custom post types
function bem_custom_post_types() {
    // Berita/News
    register_post_type('berita', array(
        'labels' => array(
            'name' => 'Berita',
            'singular_name' => 'Berita'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-admin-post'
    ));
    
    // Kegiatan/Events
    register_post_type('kegiatan', array(
        'labels' => array(
            'name' => 'Kegiatan',
            'singular_name' => 'Kegiatan'
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-calendar-alt'
    ));
    
    // Pengurus/Staff
    register_post_type('pengurus', array(
        'labels' => array(
            'name' => 'Pengurus',
            'singular_name' => 'Pengurus'
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-groups'
    ));
}
add_action('init', 'bem_custom_post_types');

// Register widget areas
function bem_widgets_init() {
    register_sidebar(array(
        'name' => 'Sidebar',
        'id' => 'sidebar-1',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
        'name' => 'Footer Widget 1',
        'id' => 'footer-1',
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>'
    ));
}
add_action('widgets_init', 'bem_widgets_init');

// Custom meta boxes for events
function bem_add_event_meta_boxes() {
    add_meta_box(
        'event_details',
        'Detail Kegiatan',
        'bem_event_meta_box_callback',
        'kegiatan',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'bem_add_event_meta_boxes');

function bem_event_meta_box_callback($post) {
    wp_nonce_field('bem_save_event_meta', 'bem_event_meta_nonce');
    
    $tanggal = get_post_meta($post->ID, '_event_date', true);
    $waktu = get_post_meta($post->ID, '_event_time', true);
    $lokasi = get_post_meta($post->ID, '_event_location', true);
    
    echo '<table class="form-table">';
    echo '<tr><th><label for="event_date">Tanggal:</label></th>';
    echo '<td><input type="date" id="event_date" name="event_date" value="' . $tanggal . '" /></td></tr>';
    echo '<tr><th><label for="event_time">Waktu:</label></th>';
    echo '<td><input type="time" id="event_time" name="event_time" value="' . $waktu . '" /></td></tr>';
    echo '<tr><th><label for="event_location">Lokasi:</label></th>';
    echo '<td><input type="text" id="event_location" name="event_location" value="' . $lokasi . '" /></td></tr>';
    echo '</table>';
}

function bem_save_event_meta($post_id) {
    if (!isset($_POST['bem_event_meta_nonce']) || !wp_verify_nonce($_POST['bem_event_meta_nonce'], 'bem_save_event_meta')) {
        return;
    }
    
    if (isset($_POST['event_date'])) {
        update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
    }
    if (isset($_POST['event_time'])) {
        update_post_meta($post_id, '_event_time', sanitize_text_field($_POST['event_time']));
    }
    if (isset($_POST['event_location'])) {
        update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['event_location']));
    }
}
add_action('save_post', 'bem_save_event_meta');

// AJAX handler for aspirasi form
function bem_handle_aspirasi() {
    check_ajax_referer('bem_aspirasi_nonce', 'nonce');
    
    $nama = sanitize_text_field($_POST['nama']);
    $nim = sanitize_text_field($_POST['nim']);
    $email = sanitize_email($_POST['email']);
    $aspirasi = sanitize_textarea_field($_POST['aspirasi']);
    
    // Save to database or send email
    $to = get_option('admin_email');
    $subject = 'Aspirasi Mahasiswa - ' . $nama;
    $message = "Nama: $nama\nNIM: $nim\nEmail: $email\n\nAspirasi:\n$aspirasi";
    
    if (wp_mail($to, $subject, $message)) {
        wp_send_json_success('Aspirasi berhasil dikirim!');
    } else {
        wp_send_json_error('Gagal mengirim aspirasi.');
    }
}
add_action('wp_ajax_bem_aspirasi', 'bem_handle_aspirasi');
add_action('wp_ajax_nopriv_bem_aspirasi', 'bem_handle_aspirasi');
?>
