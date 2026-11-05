<aside class="sidebar sidebar-left" aria-label="Thanh bên trái">
    <?php
    $about_page = get_page_by_path('ve-nguyen-hong-minh');
    $about_url  = $about_page ? get_permalink($about_page) : home_url('/ve-nguyen-hong-minh/');
    ?>
    <nav class="sidebar-about-navigation" aria-label="Giới thiệu tác giả">
        <a class="sidebar-about-link" href="<?php echo esc_url($about_url); ?>">Về Nguyễn Hồng Minh</a>
        <div class="sidebar-category-menu">
            <button class="sidebar-category-toggle" type="button" aria-expanded="false" aria-controls="sidebar-category-list">
                <span>Thơ theo chủ đề</span>
                <span class="sidebar-category-arrow" aria-hidden="true">▸</span>
            </button>
            <ul id="sidebar-category-list" class="sidebar-category-list">
                <?php
                $poem_categories = get_categories([
                    'hide_empty' => false,
                    'exclude'    => [(int) get_option('default_category')],
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                ]);
                ?>
                <?php foreach ($poem_categories as $category) : ?>
                    <li>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                            <?php echo esc_html($category->name); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
                <?php if (!$poem_categories) : ?>
                    <li class="sidebar-category-empty">Chưa có chủ đề</li>
                <?php endif; ?>
            </ul>
        </div>
        <?php
        $gallery_page = get_page_by_path('gallery', OBJECT, 'page');
        $gallery_url  = $gallery_page ? get_permalink($gallery_page) : home_url('/gallery/');
        $photo_categories = get_terms([
            'taxonomy'   => 'photo_category',
            'hide_empty' => false,
            'orderby'    => 'name',
            'order'      => 'ASC',
        ]);
        if (!is_wp_error($photo_categories)) {
            $photo_categories = array_values(array_filter($photo_categories, function ($category) {
                return nhm_get_photo_category_image_count($category->term_id) > 0;
            }));
        }
        ?>
        <div class="sidebar-category-menu sidebar-photo-category-menu">
            <a class="sidebar-category-toggle sidebar-gallery-link" href="<?php echo esc_url($gallery_url); ?>">
                <span>Ảnh</span>
                <span class="sidebar-category-arrow" aria-hidden="true">▸</span>
            </a>
            <ul class="sidebar-category-list sidebar-photo-category-list">
                <?php if (!is_wp_error($photo_categories) && $photo_categories) : ?>
                    <?php foreach ($photo_categories as $photo_category) : ?>
                        <li>
                            <a href="<?php echo esc_url(get_term_link($photo_category)); ?>">
                                <?php echo esc_html($photo_category->name); ?>
                                <span>(<?php echo esc_html((string) nhm_get_photo_category_image_count($photo_category->term_id)); ?>)</span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li class="sidebar-category-empty">Chưa có danh mục ảnh</li>
                <?php endif; ?>
            </ul>
        </div>
        <?php
        $copyright_page = get_page_by_path('ban-quyen', OBJECT, 'page');
        $copyright_url  = $copyright_page ? get_permalink($copyright_page) : home_url('/ban-quyen/');
        $contact_page   = get_page_by_path('lien-he', OBJECT, 'page');
        $contact_url    = $contact_page ? get_permalink($contact_page) : home_url('/lien-he/');
        ?>
        <a class="sidebar-about-link sidebar-copyright-link" href="<?php echo esc_url($copyright_url); ?>">Bản quyền</a>
        <a class="sidebar-about-link sidebar-contact-link" href="<?php echo esc_url($contact_url); ?>">Liên hệ</a>
    </nav>

    <?php if (is_active_sidebar('sidebar-left')) : ?>
        <div class="sidebar-widgets"><?php dynamic_sidebar('sidebar-left'); ?></div>
    <?php else : ?>
        <section class="widget search-widget">
            <h2 class="widget-title">Tìm kiếm</h2>
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <label class="screen-reader-text" for="sidebar-search">Tìm kiếm:</label>
                <input id="sidebar-search" type="search" class="search-field" placeholder="Tìm kiếm..." value="<?php echo esc_attr(get_search_query()); ?>" name="s">
                <button type="submit" class="search-submit" aria-label="Tìm kiếm">
                    <svg aria-hidden="true" viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="10.8" cy="10.8" r="6.8"></circle>
                        <path d="m16 16 5 5"></path>
                    </svg>
                </button>
            </form>
        </section>
    <?php endif; ?>

    <section class="widget sidebar-photo-widget" aria-labelledby="sidebar-photo-title">
        <h2 id="sidebar-photo-title" class="widget-title">Diễn đàn</h2>
        <div class="sidebar-photo-list">
            <img src="<?php echo esc_url(get_theme_file_uri('/assets/image/19225276_278409645896057_5823973264128828056_n.jpg')); ?>" alt="Tác giả trước Dinh Độc Lập năm 1975" loading="lazy">
            <img src="<?php echo esc_url(get_theme_file_uri('/assets/image/81015583_728918774178473_6779654006139518976_n.jpg')); ?>" alt="Tác giả trước Dinh Độc Lập tháng 5 năm 1975" loading="lazy">
            <img src="<?php echo esc_url(get_theme_file_uri('/assets/image/bai_tho_dong_chi.jpg')); ?>" alt="Minh họa người lính và tiếng đàn giữa chiến trường" loading="lazy">
        </div>
    </section>
</aside>
