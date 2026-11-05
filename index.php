
<?php get_header(); ?>

<div class="site-shell site-columns">
    <?php get_sidebar('left'); ?>

    <main id="primary-content" class="content-area">
        <header class="archive-header">
            <h1 class="entry-title">
                <?php
                if (is_search()) {
                    printf('Kết quả tìm kiếm: %s', '<span>' . esc_html(get_search_query()) . '</span>');
                } elseif (is_archive()) {
                    $archive_object = get_queried_object();
                    echo esc_html($archive_object->name ?? '');
                }
                ?>
            </h1>
            <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
        </header>

        <?php if (have_posts()) : ?>
            <div class="post-list">
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('post-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <a class="post-card-image" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                                <?php the_post_thumbnail('nhm-card'); ?>
                            </a>
                        <?php endif; ?>
                        <div class="post-card-content">
                            <p class="entry-meta"><time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">Ngày: <?php echo esc_html(get_the_date('d-m-Y')); ?></time></p>
                            <h2 class="post-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="post-card-excerpt"><?php the_excerpt(); ?></div>
                            <a class="read-more" href="<?php the_permalink(); ?>">Xem tiếp <span aria-hidden="true">→</span></a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(['mid_size' => 1, 'prev_text' => '← Trước', 'next_text' => 'Sau →']); ?>
        <?php else : ?>
            <p>Không tìm thấy nội dung phù hợp.</p>
            <?php get_search_form(); ?>
        <?php endif; ?>
        <?php get_template_part('template-parts/recent-posts'); ?>
    </main>

    <?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
