<?php
/**
 * Template Name: Thư viện ảnh
 */
get_header();

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

<div class="site-shell site-columns">
    <?php get_sidebar('left'); ?>

    <main id="primary-content" class="content-area gallery-page">
        <header class="archive-header">
            <h1 class="entry-title">Danh mục hình ảnh</h1>
            <p class="archive-description"></p>
        </header>

        <?php if (!is_wp_error($photo_categories) && $photo_categories) : ?>
            <div class="photo-category-grid">
                <?php foreach ($photo_categories as $photo_category) : ?>
                    <?php
                    $category_attachment_ids = get_objects_in_term($photo_category->term_id, 'photo_category');
                    $first_image_id = 0;
                    if (!is_wp_error($category_attachment_ids)) {
                        foreach ($category_attachment_ids as $attachment_id) {
                            $attachment = get_post($attachment_id);
                            if ($attachment && strpos($attachment->post_mime_type, 'image/') === 0) {
                                $first_image_id = (int) $attachment_id;
                                break;
                            }
                        }
                    }
                    $category_link = get_term_link($photo_category);
                    ?>
                    <?php if (!is_wp_error($category_link)) : ?>
                        <article class="photo-category-card">
                            <a class="photo-category-card-link" href="<?php echo esc_url($category_link); ?>">
                                <span class="photo-category-image">
                                    <?php if ($first_image_id) : ?>
                                        <?php echo wp_get_attachment_image($first_image_id, 'medium_large', false, ['loading' => 'lazy']); ?>
                                    <?php else : ?>
                                        <span class="photo-category-placeholder" aria-hidden="true">Chưa có ảnh</span>
                                    <?php endif; ?>
                                </span>
                                <span class="photo-category-name">
                                    <?php echo esc_html($photo_category->name); ?>
                                    <span class="photo-category-count">(<?php echo esc_html((string) nhm_get_photo_category_image_count($photo_category->term_id)); ?>)</span>
                                </span>
                            </a>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>Chưa có danh mục ảnh. Hãy tạo danh mục trong mục Thư viện ảnh ở trang quản trị.</p>
        <?php endif; ?>
        <?php get_template_part('template-parts/recent-posts'); ?>
    </main>

    <?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
