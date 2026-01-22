<?php
/**
 * Single Post Template
 */

get_header();
?>

<!-- 메인 컨텐츠 -->
<div class="container">
    <?php
    while (have_posts()) : the_post();
    ?>
        <!-- 탭 메뉴 -->
        <div class="tab-wrapper">
            <div class="container">
                <nav class="tab-container">
                    <ul class="tabs">
                        <?php
                        $current_url = get_permalink();
                        $tab_count = 0;
                        
                        for ($i = 1; $i <= 4; $i++) {
                            $enabled = get_theme_mod("aros_post_tab{$i}_enabled", true);
                            $name = get_theme_mod("aros_post_tab{$i}_name");
                            $url = get_theme_mod("aros_post_tab{$i}_url");
                            $hash = get_theme_mod("aros_post_tab{$i}_hash", "aros{$i}");
                            
                            // 이름이 비어있거나 비활성화된 경우 스킵
                            if (!$enabled || empty($name)) {
                                continue;
                            }
                            
                            $tab_count++;
                            
                            // 현재 URL과 비교하여 active 클래스 결정
                            $is_active = (strpos($current_url, $url) !== false) ? 'active' : '';
                            ?>
                            <li class="tab-item">
                                <a class="tab-link <?php echo esc_attr($is_active); ?>" 
                                   data-tab="<?php echo esc_attr($hash); ?>" 
                                   href="<?php echo esc_url($url); ?>#<?php echo esc_attr($hash); ?>">
                                    <?php echo esc_html($name); ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="post-body entry-content">
                <?php the_content(); ?>
            </div>
        </article>

    <?php
    endwhile;
    ?>
</div>

<?php
get_footer();
?>
