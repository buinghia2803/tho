<?php
/**
 * Template Name: Liên hệ
 */

$contact_status = isset($_GET['contact_status'])
    ? sanitize_key(wp_unslash($_GET['contact_status']))
    : '';

get_header();
?>

<div class="site-shell site-columns">
    <?php get_sidebar('left'); ?>

    <main id="primary-content" class="content-area contact-page">
        <article class="content-entry page-entry">
            <header class="entry-header">
                <h1 class="entry-title">Liên hệ</h1>
            </header>

            <div class="contact-intro">
                <p>Quý vị liên hệ với nhà thơ Nguyễn Hồng Minh theo số điện thoại: <a href="tel:0913304113">0913.304.113</a></p>
                <p>Hoặc gửi email theo mẫu bên dưới.</p>
                <p>Xin chân thành cảm ơn!</p>
            </div>

            <?php if ('success' === $contact_status) : ?>
                <p class="contact-notice contact-notice-success" role="status">Cảm ơn quý vị. Lời nhắn đã được gửi.</p>
            <?php elseif ('validation' === $contact_status) : ?>
                <p class="contact-notice contact-notice-error" role="alert">Vui lòng nhập họ tên, số điện thoại, email hợp lệ và lời nhắn.</p>
            <?php elseif ('error' === $contact_status) : ?>
                <p class="contact-notice contact-notice-error" role="alert">Chưa gửi được lời nhắn. Vui lòng thử lại sau.</p>
            <?php endif; ?>

            <form class="contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="nhm_submit_contact">
                <?php wp_nonce_field('nhm_contact_form', 'nhm_contact_nonce'); ?>
                <div class="contact-honeypot" aria-hidden="true">
                    <label for="contact-website">Để trống trường này</label>
                    <input id="contact-website" type="text" name="website" tabindex="-1" autocomplete="off">
                </div>

                <div class="contact-form-row">
                    <label for="contact-name">Họ tên <span>(*)</span></label>
                    <input id="contact-name" name="name" type="text" required>
                </div>
                <div class="contact-form-row">
                    <label for="contact-unit">Đơn vị</label>
                    <input id="contact-unit" name="unit" type="text">
                </div>
                <div class="contact-form-row contact-form-row-textarea">
                    <label for="contact-address">Địa chỉ</label>
                    <textarea id="contact-address" name="address" rows="2"></textarea>
                </div>
                <div class="contact-form-row">
                    <label for="contact-phone">Điện thoại <span>(*)</span></label>
                    <input id="contact-phone" name="phone" type="tel" required>
                </div>
                <div class="contact-form-row">
                    <label for="contact-email">Email <span>(*)</span></label>
                    <input id="contact-email" name="email" type="email" required>
                </div>
                <div class="contact-form-row contact-form-row-textarea">
                    <label for="contact-message">Lời nhắn <span>(*)</span></label>
                    <textarea id="contact-message" name="message" rows="6" required></textarea>
                </div>
                <div class="contact-form-actions">
                    <button type="submit">Gửi liên hệ</button>
                    <button type="reset" class="contact-reset-button">Soạn lại</button>
                </div>
            </form>
        </article>

        <?php get_template_part('template-parts/recent-posts'); ?>
    </main>

    <?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
