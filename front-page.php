
<?php get_header(); ?>

<div class="site-shell site-columns">
    <?php get_sidebar('left'); ?>

    <main id="primary-content" class="content-area front-content">
        <?php if ('page' === get_option('show_on_front') && have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <section <?php post_class('front-page-intro'); ?>>
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="entry-content"><?php the_content(); ?></div>
                </section>
            <?php endwhile; ?>
        <?php else : ?>
            <header class="archive-header">
                <?php if (get_bloginfo('description')) : ?>
                    <p class="archive-description"><?php echo esc_html(get_bloginfo('description')); ?></p>
                <?php endif; ?>
            </header>
        <?php endif; ?>

        <section class="front-feature-images" aria-label="Hình ảnh giới thiệu Nguyễn Hồng Minh">
            <img class="front-feature-portrait" src="<?php echo esc_url(get_theme_file_uri('/assets/image/doc_tho.jpg')); ?>" alt="Nguyễn Hồng Minh đang đọc sách">
            <img class="front-feature-caption" src="<?php echo esc_url(get_theme_file_uri('/assets/image/cam_nhan.gif')); ?>" alt="Cảm nhận">
        </section>

        <section class="latest-posts" aria-labelledby="latest-posts-title">
            <h2 id="latest-posts-title" class="section-title">Bài viết mới nhất</h2>
            <?php
            $latest_posts = new WP_Query([
                'post_type'           => 'post',
                'post_status'         => 'publish',
                'posts_per_page'      => 6,
                'ignore_sticky_posts' => true,
            ]);
            ?>

            <?php if ($latest_posts->have_posts()) : ?>
                <div class="post-list">
                    <?php while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                        <article <?php post_class('post-card'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <a class="post-card-image" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                                    <?php the_post_thumbnail('nhm-card'); ?>
                                </a>
                            <?php endif; ?>
                            <div class="post-card-content">
                                <p class="entry-meta"><time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">Ngày: <?php echo esc_html(get_the_date('d-m-Y')); ?></time></p>
                                <h3 class="post-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="post-card-excerpt"><?php the_excerpt(); ?></div>
                                <a class="read-more" href="<?php the_permalink(); ?>">Xem tiếp <span aria-hidden="true">→</span></a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <p>Chưa có bài viết nào. Hãy tạo bài viết trong mục Bài viết ở trang quản trị.</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </section>

        <?php get_template_part('template-parts/recent-posts'); ?>
    </main>

    <?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
