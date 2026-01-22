<!-- 푸터 -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-left">
            <div class="footer-brand"><?php echo esc_html(get_theme_mod('aros_post_footer_brand', '근로장려금·자녀장려금')); ?></div>
            <ul class="footer-info">
                <li>
                    <i>📍</i>
                    사업자 주소 : <?php echo esc_html(get_theme_mod('aros_post_footer_address', 'N/A')); ?>
                </li>
                <li>
                    <i>🏢</i>
                    사업자 번호: <?php echo esc_html(get_theme_mod('aros_post_footer_business_no', 'N/A')); ?>
                </li>
            </ul>
        </div>
        <div class="footer-right">
            <p>제작자 : 아로스</p>
            <p>홈페이지 : <a href="https://aros100.com" target="_blank">바로가기</a></p>
            <p class="footer-copyright">Copyrights © 2020 All Rights Reserved by (주)아백</p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
