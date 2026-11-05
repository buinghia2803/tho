<?php get_header(); ?>

<div class="site-shell site-columns">
    <?php get_sidebar('left'); ?>

    <main id="primary-content" class="content-area photo-category-page">
        <?php $current_category = get_queried_object(); ?>
        <header class="archive-header">
            <h1 class="entry-title"><?php echo esc_html($current_category->name); ?></h1>
            <?php if (!empty($current_category->description)) : ?>
                <div class="archive-description"><?php echo wp_kses_post(wpautop($current_category->description)); ?></div>
            <?php endif; ?>
            <p class="photo-category-total">Tổng số ảnh: <?php echo esc_html((string) nhm_get_photo_category_image_count($current_category->term_id)); ?></p>
        </header>

        <?php
        $photo_query = new WP_Query([
            'post_type'      => 'attachment',
            'post_status'    => 'inherit',
            'post_mime_type' => 'image',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order ID',
            'order'          => 'ASC',
            'tax_query'      => [[
                'taxonomy' => 'photo_category',
                'field'    => 'term_id',
                'terms'    => $current_category->term_id,
            ]],
        ]);
        ?>

        <?php if ($photo_query->have_posts()) : ?>
            <div class="photo-gallery-grid">
                <?php while ($photo_query->have_posts()) : $photo_query->the_post(); ?>
                    <figure class="photo-gallery-item">
                        <a href="<?php echo esc_url(wp_get_attachment_image_url(get_the_ID(), 'full')); ?>" target="_blank" rel="noopener">
                            <?php echo wp_get_attachment_image(get_the_ID(), 'medium_large', false, ['loading' => 'lazy']); ?>
                        </a>
                    </figure>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p>Danh mục này hiện chưa có ảnh.</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
        <?php get_template_part('template-parts/recent-posts'); ?>
    </main>

    <?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
