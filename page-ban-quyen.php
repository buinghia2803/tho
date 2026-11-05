<?php
/**
 * Template Name: Bản quyền
 */
get_header();
?>

<div class="site-shell site-columns">
    <?php get_sidebar('left'); ?>

    <main id="primary-content" class="content-area copyright-page">
        <article class="content-entry page-entry">
            <header class="entry-header">
                <h1 class="entry-title">Bản quyền</h1>
            </header>

            <div class="entry-content copyright-content">
                <p>Các tác phẩm trên website đã được Cục Sở hữu Trí tuệ Việt Nam cấp bản quyền cho tác giả Nguyễn Hồng Minh.</p>
                <figure class="copyright-certificate">
                    <a href="<?php echo esc_url(get_theme_file_uri('/assets/image/bn_quyn_nguyn_hng_minh_hng_t.jpg')); ?>" target="_blank" rel="noopener">
                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/image/bn_quyn_nguyn_hng_minh_hng_t.jpg')); ?>" alt="Giấy chứng nhận đăng ký quyền tác giả tác phẩm Hương đất" loading="lazy">
                    </a>
                    <figcaption>Giấy chứng nhận đăng ký quyền tác giả — tác phẩm “Hương đất”.</figcaption>
                </figure>
                <figure class="copyright-certificate">
                    <a href="<?php echo esc_url(get_theme_file_uri('/assets/image/img_0008.jpg')); ?>" target="_blank" rel="noopener">
                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/image/img_0008.jpg')); ?>" alt="Giấy chứng nhận đăng ký quyền tác giả tác phẩm Quê Hương" loading="lazy">
                    </a>
                    <figcaption>Giấy chứng nhận đăng ký quyền tác giả — tác phẩm “Quê Hương”.</figcaption>
                </figure>
            </div>
        </article>
        <?php get_template_part('template-parts/recent-posts'); ?>
    </main>

    <?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
