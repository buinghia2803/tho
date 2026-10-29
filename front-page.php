
<?php get_header(); ?>

<main class="site-main">

    <section class="hero">
        <div class="container">
            <h1>Chào mừng đến với website Nguyễn Hồng Minh</h1>
            <p>Website được xây dựng bằng theme WordPress riêng.</p>
        </div>
    </section>

    <section class="latest-posts container">
        <h2>Bài viết mới nhất</h2>

        <?php
        $latest_posts = new WP_Query([
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => 6,
            'ignore_sticky_posts' => true,
        ]);
        ?>

        <?php if ($latest_posts->have_posts()) : ?>
            <div class="post-grid">

                <?php while ($latest_posts->have_posts()) :
                    $latest_posts->the_post();
                ?>

                    <article <?php post_class('post-card'); ?>>

                        <a class="post-card-image"
                           href="<?php the_permalink(); ?>">

                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium_large'); ?>
                            <?php endif; ?>

                        </a>

                        <div class="post-card-content">
                            <h3>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>

                            <p><?php echo esc_html(
                                get_the_excerpt()
                            ); ?></p>
                        </div>

                    </article>

                <?php endwhile; ?>

            </div>

        <?php else : ?>
            <p>Chưa có bài viết nào được xuất bản.</p>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>

    </section>

</main>

<?php get_footer(); ?>
