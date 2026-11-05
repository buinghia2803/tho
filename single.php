<?php get_header(); ?>

<div class="site-shell site-columns">
    <?php get_sidebar('left'); ?>

    <main id="primary-content" class="content-area">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('content-entry single-entry'); ?>>
                <header class="entry-header">
                    <?php if (get_the_category_list(' · ')) : ?>
                        <p class="entry-categories"><?php echo wp_kses_post(get_the_category_list(' · ')); ?></p>
                    <?php endif; ?>
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
                <div class="entry-content"><?php the_content(); ?></div>
            </article>
        <?php endwhile; ?>
        <?php get_template_part('template-parts/recent-posts'); ?>
    </main>

    <?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
