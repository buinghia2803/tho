<?php get_header(); ?>

<div class="site-shell site-columns">
    <?php get_sidebar('left'); ?>

    <main id="primary-content" class="content-area">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('content-entry page-entry'); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
                <?php if (has_post_thumbnail()) : ?>
                    <figure class="entry-featured-image"><?php the_post_thumbnail('large'); ?></figure>
                <?php endif; ?>
                <div class="entry-content"><?php the_content(); ?></div>
                <?php
                wp_link_pages([
                    'before' => '<nav class="page-links" aria-label="Trang nội dung">' . esc_html__('Trang:', 'nhm'),
                    'after'  => '</nav>',
                ]);
                ?>
            </article>
        <?php endwhile; ?>
        <?php get_template_part('template-parts/recent-posts'); ?>
    </main>

    <?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
