<?php
/**
 * Template Name: Liên hệ
 */

$contact_status = '';
$contact_values = [
    'name'    => '',
    'unit'    => '',
    'address' => '',
    'phone'   => '',
    'email'   => '',
    'message' => '',
];

if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_POST['nhm_contact_submit'])) {
    foreach ($contact_values as $field => $default) {
        if (isset($_POST[$field])) {
            $raw_value = wp_unslash($_POST[$field]);
            $contact_values[$field] = 'message' === $field || 'address' === $field
                ? sanitize_textarea_field($raw_value)
                : sanitize_text_field($raw_value);
        }
    }
    $contact_values['email'] = sanitize_email($contact_values['email']);

    if (!isset($_POST['nhm_contact_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nhm_contact_nonce'])), 'nhm_contact_form')) {
        $contact_status = 'error';
    } elseif ('' !== ($_POST['website'] ?? '')) {
        // Silently reject bot submissions caught by the hidden honeypot field.
        $contact_status = 'success';
    } elseif ('' === $contact_values['name'] || '' === $contact_values['phone'] || !is_email($contact_values['email']) || '' === $contact_values['message']) {
        $contact_status = 'validation';
    } else {
        $admin_email = sanitize_email(get_option('admin_email'));
        $subject = sprintf('Liên hệ website: %s', $contact_values['name']);
        $body = "Họ tên: {$contact_values['name']}\n";
        $body .= "Đơn vị: {$contact_values['unit']}\n";
        $body .= "Địa chỉ: {$contact_values['address']}\n";
        $body .= "Điện thoại: {$contact_values['phone']}\n";
        $body .= "Email: {$contact_values['email']}\n\n";
        $body .= "Lời nhắn:\n{$contact_values['message']}\n";
        $headers = ['Reply-To: ' . $contact_values['name'] . ' <' . $contact_values['email'] . '>'];

        $contact_status = wp_mail($admin_email, $subject, $body, $headers) ? 'success' : 'error';
        if ('success' === $contact_status) {
            $contact_values = array_fill_keys(array_keys($contact_values), '');
        }
    }
}

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

            <form class="contact-form" method="post" action="">
                <?php wp_nonce_field('nhm_contact_form', 'nhm_contact_nonce'); ?>
                <div class="contact-honeypot" aria-hidden="true">
                    <label for="contact-website">Để trống trường này</label>
                    <input id="contact-website" type="text" name="website" tabindex="-1" autocomplete="off">
                </div>

                <div class="contact-form-row">
                    <label for="contact-name">Họ tên <span>(*)</span></label>
                    <input id="contact-name" name="name" type="text" value="<?php echo esc_attr($contact_values['name']); ?>" required>
                </div>
                <div class="contact-form-row">
                    <label for="contact-unit">Đơn vị</label>
                    <input id="contact-unit" name="unit" type="text" value="<?php echo esc_attr($contact_values['unit']); ?>">
                </div>
                <div class="contact-form-row contact-form-row-textarea">
                    <label for="contact-address">Địa chỉ</label>
                    <textarea id="contact-address" name="address" rows="2"><?php echo esc_textarea($contact_values['address']); ?></textarea>
                </div>
                <div class="contact-form-row">
                    <label for="contact-phone">Điện thoại <span>(*)</span></label>
                    <input id="contact-phone" name="phone" type="tel" value="<?php echo esc_attr($contact_values['phone']); ?>" required>
                </div>
                <div class="contact-form-row">
                    <label for="contact-email">Email <span>(*)</span></label>
                    <input id="contact-email" name="email" type="email" value="<?php echo esc_attr($contact_values['email']); ?>" required>
                </div>
                <div class="contact-form-row contact-form-row-textarea">
                    <label for="contact-message">Lời nhắn <span>(*)</span></label>
                    <textarea id="contact-message" name="message" rows="6" required><?php echo esc_textarea($contact_values['message']); ?></textarea>
                </div>
                <div class="contact-form-actions">
                    <button type="submit" name="nhm_contact_submit" value="1">Gửi liên hệ</button>
                    <button type="reset" class="contact-reset-button">Soạn lại</button>
                </div>
            </form>
        </article>

        <?php get_template_part('template-parts/recent-posts'); ?>
    </main>

    <?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
