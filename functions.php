<?php
/**
 * Aros Post Theme Functions
 * 
 * @package Aros_Post_Theme
 */

// 테마 설정
function aros_post_setup() {
    // 타이틀 태그 지원
    add_theme_support('title-tag');
    
    // 포스트 썸네일 지원
    add_theme_support('post-thumbnails');
    
    // HTML5 지원
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // 에디터 스타일
    add_editor_style();
}
add_action('after_setup_theme', 'aros_post_setup');

// 스크립트 및 스타일 로드
function aros_post_scripts() {
    // 구글 폰트
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500;700&display=swap', array(), null);
    
    // 메인 스타일시트
    wp_enqueue_style('aros-post-style', get_stylesheet_uri(), array(), '1.0');
    
    // 스크립트
    wp_enqueue_script('aros-post-script', get_template_directory_uri() . '/script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'aros_post_scripts');

// 커스터마이저 설정
function aros_post_customize_register($wp_customize) {
    
    // 로고 이미지 설정
    $wp_customize->add_setting('aros_post_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'aros_post_logo', array(
        'label' => '로고 이미지',
        'section' => 'title_tagline',
        'settings' => 'aros_post_logo',
    )));
    
    // 로고 텍스트
    $wp_customize->add_setting('aros_post_logo_text', array(
        'default' => '근로장려금·자녀장려금',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('aros_post_logo_text', array(
        'label' => '로고 텍스트',
        'section' => 'title_tagline',
        'type' => 'text',
    ));
    
    // 탭 메뉴 섹션
    $wp_customize->add_section('aros_post_tabs', array(
        'title' => '탭 메뉴 설정',
        'priority' => 30,
    ));
    
    // 탭 1~4 설정
    for ($i = 1; $i <= 4; $i++) {
        // 탭 활성화
        $wp_customize->add_setting("aros_post_tab{$i}_enabled", array(
            'default' => true,
            'sanitize_callback' => 'wp_validate_boolean',
        ));
        
        $wp_customize->add_control("aros_post_tab{$i}_enabled", array(
            'label' => "탭 {$i} 활성화",
            'section' => 'aros_post_tabs',
            'type' => 'checkbox',
        ));
        
        // 탭 이름
        $wp_customize->add_setting("aros_post_tab{$i}_name", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control("aros_post_tab{$i}_name", array(
            'label' => "탭 {$i} 이름",
            'section' => 'aros_post_tabs',
            'type' => 'text',
        ));
        
        // 탭 URL
        $wp_customize->add_setting("aros_post_tab{$i}_url", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control("aros_post_tab{$i}_url", array(
            'label' => "탭 {$i} URL",
            'section' => 'aros_post_tabs',
            'type' => 'url',
        ));
        
        // 탭 해시 ID
        $wp_customize->add_setting("aros_post_tab{$i}_hash", array(
            'default' => "aros{$i}",
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control("aros_post_tab{$i}_hash", array(
            'label' => "탭 {$i} 해시 ID",
            'section' => 'aros_post_tabs',
            'type' => 'text',
            'description' => '예: aros1, aros2 등',
        ));
    }
    
    // 푸터 섹션
    $wp_customize->add_section('aros_post_footer', array(
        'title' => '푸터 설정',
        'priority' => 32,
    ));
    
    // 푸터 브랜드명
    $wp_customize->add_setting('aros_post_footer_brand', array(
        'default' => '근로장려금·자녀장려금',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('aros_post_footer_brand', array(
        'label' => '푸터 브랜드명',
        'section' => 'aros_post_footer',
        'type' => 'text',
    ));
    
    // 사업자 주소
    $wp_customize->add_setting('aros_post_footer_address', array(
        'default' => 'N/A',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('aros_post_footer_address', array(
        'label' => '사업자 주소',
        'section' => 'aros_post_footer',
        'type' => 'text',
    ));
    
    // 사업자 번호
    $wp_customize->add_setting('aros_post_footer_business_no', array(
        'default' => 'N/A',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('aros_post_footer_business_no', array(
        'label' => '사업자 번호',
        'section' => 'aros_post_footer',
        'type' => 'text',
    ));
}
add_action('customize_register', 'aros_post_customize_register');

// 포스트 제목 숨기기
add_filter('the_title', 'aros_hide_post_title', 10, 2);
function aros_hide_post_title($title, $id) {
    if (is_single() && in_the_loop()) {
        return '';
    }
    return $title;
}

// 본문 내용을 그대로 출력하기 위한 필터 제거
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
?>
