
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#primary-content">Bỏ qua nội dung</a>

<header class="site-header">
    <div class="site-shell">
        <?php
        $header_image = get_header_image();
        if (!$header_image) {
            $header_image = get_theme_file_uri('/assets/image/banner.jpg');
        }
        ?>
        <?php if ($header_image) : ?>
            <a class="header-banner" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Về trang chủ">
                <img src="<?php echo esc_url($header_image); ?>" alt="">
            </a>
        <?php endif; ?>

        <div class="header-branding">
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php endif; ?>
            </div>
            <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation">
                <span class="menu-toggle-label">Danh mục</span>
                <span class="menu-toggle-icon" aria-hidden="true">☰</span>
            </button>
        </div>
    </div>
</header>
