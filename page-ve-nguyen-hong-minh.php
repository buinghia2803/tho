<?php get_header(); ?>

<div class="site-shell site-columns">
    <?php get_sidebar('left'); ?>

    <main id="primary-content" class="content-area">
        <article class="content-entry page-entry about-author-page">
            <header class="entry-header">
                <h1 class="entry-title">Giới thiệu về Nguyễn Hồng Minh</h1>
            </header>

            <div class="entry-content about-author-content">
                <div class="about-author-portraits">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/image/tho_nguyenhongminh.jpg')); ?>" alt="Chân dung phác họa Nguyễn Hồng Minh" loading="lazy">
                    <img src="<?php echo esc_url(get_theme_file_uri('/assets/image/nguyen_hong_minh.gif')); ?>" alt="Nhà thơ Nguyễn Hồng Minh" loading="lazy">
                    <img class="about-author-signature" src="<?php echo esc_url(get_theme_file_uri('/assets/image/chu_ky.png')); ?>" alt="Chữ ký Nguyễn Hồng Minh" loading="lazy">
                </div>

                <p class="about-author-intro"><em>Kính gửi các bạn hữu yêu thơ, tôi vốn sinh ra không phải để làm thơ. Nhưng cuộc kháng chiến của dân tộc đã giúp tôi được đi nhiều nơi, tiếp xúc với mọi lứa tuổi. Cuộc sống đã cho tôi nhiều trải nghiệm, đặc biệt là năm tháng sống – chiến đấu ở Trường Sơn và mặt trận B2. Vì vậy, những bài thơ ban đầu của tôi mang tính chất đơn giản. Chỉ sau này, khi có điều kiện và thời gian, tôi mới tổng hợp năm tháng nơi tôi chiến đấu và công tác để có những bài thơ trau chuốt hơn về nội dung, từ ngữ.</em></p>

                <p><strong>Nguyễn Hồng Minh</strong> sinh ngày 8/2/1948, quê quán Thị Cầu, Bắc Ninh.</p>

                <ul class="about-author-timeline">
                    <li>1956–1966: Học cấp 2, cấp 3 tại trường Mạo Khê, Đông Triều, Quảng Ninh.</li>
                    <li>1966–1968: Công nhân mỏ Quảng Ninh.</li>
                    <li>1968–1970: Học tập tại Trường Cán bộ Y tế Quảng Ninh.</li>
                    <li>Tháng 4/1970: Nhập ngũ, học tập tại Trường Bổ túc Văn hóa Sĩ quan Chính trị Yên Dũng, Hà Bắc.</li>
                    <li>1971: Học tại Đại học Y Hà Nội.</li>
                    <li>1974: Tham gia chiến trường B2.</li>
                    <li>1975: Giữ chức vụ trợ lý thanh niên, Tiểu đoàn 18 An ninh Vũ trang, Thành phố Hồ Chí Minh.</li>
                    <li>1978: Giữ chức vụ trợ lý chính trị Phòng PC22, Cảnh sát Bảo vệ, Công an Thành phố Hồ Chí Minh.</li>
                    <li>Hiện nay: Chủ tịch Hội đồng quản trị Công ty TNHH Thẩm mỹ Thanh Bình.</li>
                </ul>
            </div>
        </article>
        <?php get_template_part('template-parts/recent-posts'); ?>
    </main>

    <?php get_sidebar('right'); ?>
</div>

<?php get_footer(); ?>
