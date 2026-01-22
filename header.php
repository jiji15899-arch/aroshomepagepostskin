<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- 헤더 -->
<header class="header">
    <div class="container">
        <span class="logo">
            <?php 
            $logo = get_theme_mod('aros_post_logo');
            if ($logo) : ?>
                <img alt="로고 이미지" class="logo" src="<?php echo esc_url($logo); ?>">
            <?php endif; ?>
        </span>
        <h1 class="logo-text"><?php echo esc_html(get_theme_mod('aros_post_logo_text', '근로장려금·자녀장려금')); ?></h1>
    </div>
</header>
