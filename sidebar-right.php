<aside class="sidebar sidebar-right" aria-label="Thanh bên phải">
    <?php
    $recent_post_ids = get_posts([
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'numberposts'         => 4,
        'ignore_sticky_posts' => true,
        'fields'              => 'ids',
        'orderby'             => 'date',
        'order'               => 'DESC',
    ]);
    ?>

    <?php foreach (['Tiêu điểm', 'Mới cập nhật'] as $section_title) : ?>
        <section class="widget sidebar-posts-widget">
            <h2 class="widget-title"><?php echo esc_html($section_title); ?></h2>
            <?php if ($recent_post_ids) : ?>
                <ul class="sidebar-post-links">
                    <?php foreach ($recent_post_ids as $post_id) : ?>
                        <li>
                            <a href="<?php echo esc_url(get_permalink($post_id)); ?>">
                                <?php echo esc_html(get_the_title($post_id)); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p class="sidebar-empty">Chưa có bài viết nào.</p>
            <?php endif; ?>
        </section>
    <?php endforeach; ?>

    <div class="sidebar-artwork" aria-label="Tranh và chữ ký Nguyễn Hồng Minh">
        <img src="<?php echo esc_url(get_theme_file_uri('/assets/image/nho_cha.jpg')); ?>" alt="Thư pháp Cha" loading="lazy">
        <img src="<?php echo esc_url(get_theme_file_uri('/assets/image/ben_doi.jpg')); ?>" alt="Tranh phong cảnh bến đò" loading="lazy">
        <img src="<?php echo esc_url(get_theme_file_uri('/assets/image/13346797_144837789253244_1589182896971032823_n.jpg')); ?>" alt="Lá cờ Việt Nam nơi biển đảo" loading="lazy">
        <img class="sidebar-signature" src="<?php echo esc_url(get_theme_file_uri('/assets/image/chu_ky.png')); ?>" alt="Chữ ký Nguyễn Hồng Minh" loading="lazy">
    </div>

    <?php if (is_active_sidebar('sidebar-right')) : ?>
        <div class="sidebar-widgets"><?php dynamic_sidebar('sidebar-right'); ?></div>
    <?php endif; ?>
</aside>
