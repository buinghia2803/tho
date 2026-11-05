<section class="contact-posts" aria-labelledby="contact-posts-title">
    <h2 id="contact-posts-title" class="section-title">Các bài đã đăng</h2>
    <?php
    $contact_posts = new WP_Query([
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'posts_per_page'      => 6,
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
    ]);
    ?>
    <?php if ($contact_posts->have_posts()) : ?>
        <ul class="contact-post-list">
            <?php while ($contact_posts->have_posts()) : $contact_posts->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">Ngày: <?php echo esc_html(get_the_date('d-m-Y')); ?></time>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p>Chưa có bài viết nào được đăng.</p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</section>
