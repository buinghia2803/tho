
<?php

/** Theme setup and WordPress feature support. */
function nhm_theme_setup() {
    load_theme_textdomain('nhm', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 320,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('custom-header', [
        'width'       => 1920,
        'height'      => 420,
        'flex-width'  => true,
        'flex-height' => true,
        'header-text' => false,
        'uploads'     => true,
    ]);
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
        'navigation-widgets',
    ]);

    add_image_size('nhm-card', 720, 480, true);

    register_nav_menus([
        'primary' => 'Menu bên trái',
        'footer'  => 'Menu chân trang',
    ]);
}
add_action('after_setup_theme', 'nhm_theme_setup');

/** Create the author page once so the sidebar link has a published destination. */
function nhm_ensure_about_page() {
    $about_page = get_page_by_path('ve-nguyen-hong-minh', OBJECT, 'page');

    if ($about_page || get_option('nhm_about_page_created')) {
        return;
    }

    $page_id = wp_insert_post([
        'post_type'    => 'page',
        'post_status'  => 'publish',
        'post_title'   => 'Về Nguyễn Hồng Minh',
        'post_name'    => 've-nguyen-hong-minh',
        'post_content' => '',
    ], true);

    if (!is_wp_error($page_id)) {
        update_post_meta($page_id, '_wp_page_template', 'page-ve-nguyen-hong-minh.php');
        update_option('nhm_about_page_created', (int) $page_id, false);
    }
}
add_action('init', 'nhm_ensure_about_page', 20);

/** Create the gallery landing page once if it does not exist. */
function nhm_ensure_gallery_page() {
    $gallery_page = get_page_by_path('gallery', OBJECT, 'page');

    if ($gallery_page || get_option('nhm_gallery_page_created')) {
        return;
    }

    $page_id = wp_insert_post([
        'post_type'   => 'page',
        'post_status' => 'publish',
        'post_title'  => 'Gallery',
        'post_name'   => 'gallery',
    ], true);

    if (!is_wp_error($page_id)) {
        update_option('nhm_gallery_page_created', (int) $page_id, false);
    }
}
add_action('init', 'nhm_ensure_gallery_page', 20);

/** Create the copyright page once so the sidebar link always has a destination. */
function nhm_ensure_copyright_page() {
    $copyright_page = get_page_by_path('ban-quyen', OBJECT, 'page');

    if ($copyright_page || get_option('nhm_copyright_page_created')) {
        return;
    }

    $page_id = wp_insert_post([
        'post_type'   => 'page',
        'post_status' => 'publish',
        'post_title'  => 'Bản quyền',
        'post_name'   => 'ban-quyen',
    ], true);

    if (!is_wp_error($page_id)) {
        update_post_meta($page_id, '_wp_page_template', 'page-ban-quyen.php');
        update_option('nhm_copyright_page_created', (int) $page_id, false);
    }
}
add_action('init', 'nhm_ensure_copyright_page', 20);

/** Create the contact page once so the sidebar link has a destination. */
function nhm_ensure_contact_page() {
    $contact_page = get_page_by_path('lien-he', OBJECT, 'page');

    if ($contact_page || get_option('nhm_contact_page_created')) {
        return;
    }

    $page_id = wp_insert_post([
        'post_type'   => 'page',
        'post_status' => 'publish',
        'post_title'  => 'Liên hệ',
        'post_name'   => 'lien-he',
    ], true);

    if (!is_wp_error($page_id)) {
        update_post_meta($page_id, '_wp_page_template', 'page-lien-he.php');
        update_option('nhm_contact_page_created', (int) $page_id, false);
    }
}
add_action('init', 'nhm_ensure_contact_page', 20);

/** Process public contact-form submissions through WordPress admin-post. */
function nhm_handle_contact_form() {
    $contact_page = get_page_by_path('lien-he', OBJECT, 'page');
    $redirect_url = $contact_page ? get_permalink($contact_page) : home_url('/lien-he/');

    if ('POST' !== $_SERVER['REQUEST_METHOD']) {
        wp_safe_redirect($redirect_url);
        exit;
    }

    $nonce = isset($_POST['nhm_contact_nonce'])
        ? sanitize_text_field(wp_unslash($_POST['nhm_contact_nonce']))
        : '';

    if (!wp_verify_nonce($nonce, 'nhm_contact_form')) {
        $status = 'error';
    } elseif (!empty($_POST['website'])) {
        // Silently accept honeypot submissions without sending email.
        $status = 'success';
    } else {
        $name = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
        $unit = isset($_POST['unit']) ? sanitize_text_field(wp_unslash($_POST['unit'])) : '';
        $address = isset($_POST['address']) ? sanitize_textarea_field(wp_unslash($_POST['address'])) : '';
        $phone = isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '';
        $email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
        $message = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '';

        if ('' === $name || '' === $phone || !is_email($email) || '' === $message) {
            $status = 'validation';
        } else {
            $admin_email = sanitize_email(get_option('admin_email'));
            $subject = sprintf('Liên hệ website: %s', $name);
            $body = "Họ tên: {$name}\n";
            $body .= "Đơn vị: {$unit}\n";
            $body .= "Địa chỉ: {$address}\n";
            $body .= "Điện thoại: {$phone}\n";
            $body .= "Email: {$email}\n\n";
            $body .= "Lời nhắn:\n{$message}\n";
            $headers = ['Reply-To: ' . $name . ' <' . $email . '>'];

            $status = wp_mail($admin_email, $subject, $body, $headers) ? 'success' : 'error';
        }
    }

    wp_safe_redirect(add_query_arg('contact_status', $status, $redirect_url));
    exit;
}
add_action('admin_post_nopriv_nhm_submit_contact', 'nhm_handle_contact_form');
add_action('admin_post_nhm_submit_contact', 'nhm_handle_contact_form');

/** Register editable widget areas displayed in the two sidebars. */
function nhm_register_sidebars() {
    register_sidebar([
        'name'          => 'Cột trái',
        'id'            => 'sidebar-left',
        'description'   => 'Nội dung và tiện ích ở cột trái.',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);
    register_sidebar([
        'name'          => 'Cột phải',
        'id'            => 'sidebar-right',
        'description'   => 'Nội dung và tiện ích ở cột phải.',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);
    register_sidebar([
        'name'          => 'Chân trang',
        'id'            => 'footer',
        'description'   => 'Tiện ích tùy chọn ở chân trang.',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ]);
}
add_action('widgets_init', 'nhm_register_sidebars');

/** Load theme assets with file timestamps for cache busting. */
function nhm_enqueue_assets() {
    $css_file = get_theme_file_path('/assets/css/main.css');
    $js_file  = get_theme_file_path('/assets/js/main.js');

    wp_enqueue_style(
        'nhm-main-style',
        get_theme_file_uri('/assets/css/main.css'),
        [],
        file_exists($css_file) ? filemtime($css_file) : '1.0.0'
    );
    wp_enqueue_script(
        'nhm-main-script',
        get_theme_file_uri('/assets/js/main.js'),
        [],
        file_exists($js_file) ? filemtime($js_file) : '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'nhm_enqueue_assets');

/** Add editable contact and copyright fields to the Customizer. */
function nhm_customize_register($wp_customize) {
    $wp_customize->add_section('nhm_footer_settings', [
        'title'    => 'Thông tin chân trang',
        'priority' => 130,
    ]);

    $fields = [
        'nhm_footer_copyright' => [
            'label'   => 'Dòng bản quyền',
            'default' => 'Bản quyền thuộc sở hữu trí tuệ của Nhà thơ Nguyễn Hồng Minh',
            'type'    => 'text',
        ],
        'nhm_contact_phone' => [
            'label'   => 'Số điện thoại liên hệ',
            'default' => '',
            'type'    => 'text',
        ],
        'nhm_contact_email' => [
            'label'   => 'Email liên hệ',
            'default' => '',
            'type'    => 'email',
        ],
    ];

    foreach ($fields as $setting_id => $field) {
        $wp_customize->add_setting($setting_id, [
            'default'           => $field['default'],
            'sanitize_callback' => $field['type'] === 'email' ? 'sanitize_email' : 'sanitize_text_field',
            'transport'          => 'refresh',
        ]);
        $wp_customize->add_control($setting_id, [
            'label'   => $field['label'],
            'section' => 'nhm_footer_settings',
            'type'    => $field['type'],
        ]);
    }
}
add_action('customize_register', 'nhm_customize_register');


function huna_register_photo_category() {

    register_taxonomy(
        'photo_category',
        array('attachment'),
        array(
            'labels' => array(
                'name' => 'Danh mục ảnh',
                'singular_name' => 'Danh mục ảnh',
                'add_new_item' => 'Thêm danh mục ảnh mới',
                'edit_item' => 'Chỉnh sửa danh mục ảnh',
                'menu_name' => 'Danh mục ảnh',
            ),

            'public' => true,
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,

            'rewrite' => array(
                'slug' => 'thu-vien-anh',
            ),
        )
    );
}
add_action('init', 'huna_register_photo_category');

/** Count image attachments in a photo category, including inherited media status. */
function nhm_get_photo_category_image_count($term_id) {
    global $wpdb;

    $count = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(DISTINCT p.ID)
        FROM {$wpdb->posts} AS p
        INNER JOIN {$wpdb->term_relationships} AS tr ON p.ID = tr.object_id
        INNER JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        WHERE tt.taxonomy = %s
            AND tt.term_id = %d
            AND p.post_type = 'attachment'
            AND p.post_status = 'inherit'
            AND p.post_mime_type LIKE %s",
        'photo_category',
        absint($term_id),
        'image/%'
    ));

    return absint($count);
}

/** Refresh photo-category routes once after the taxonomy is registered. */
function nhm_flush_photo_rewrite_rules_once() {
    if (get_option('nhm_photo_rewrite_rules_flushed')) {
        return;
    }

    flush_rewrite_rules(false);
    update_option('nhm_photo_rewrite_rules_flushed', 1, false);
}
add_action('init', 'nhm_flush_photo_rewrite_rules_once', 99);
