<?php
/**
 * Archive Template
 */

get_header();
?>

<div class="container">
    <div style="padding: 100px 20px;">
        <?php if (have_posts()) : ?>
            
            <header class="archive-header" style="margin-bottom: 30px;">
                <h1 style="font-size: 24px; color: #333;">
                    <?php
                    if (is_category()) {
                        single_cat_title();
                    } elseif (is_tag()) {
                        single_tag_title();
                    } elseif (is_author()) {
                        the_author();
                    } elseif (is_date()) {
                        echo get_the_date('Y년 F');
                    } else {
                        echo '글 목록';
                    }
                    ?>
                </h1>
            </header>

            <div class="archive-posts">
                <?php
                while (have_posts()) : the_post();
                ?>
                    <article style="margin-bottom: 30px; padding-bottom: 30px; border-bottom: 1px solid #eee;">
                        <h2 style="font-size: 20px; margin-bottom: 10px;">
                            <a href="<?php the_permalink(); ?>" style="color: #333; text-decoration: none;">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        
                        <div class="post-meta" style="color: #999; font-size: 14px; margin-bottom: 15px;">
                            <span><?php echo get_the_date(); ?></span>
                        </div>

                        <?php if (has_excerpt()) : ?>
                            <div class="post-excerpt" style="color: #666; line-height: 1.6;">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>

                        <a href="<?php the_permalink(); ?>" 
                           class="read-more" 
                           style="display: inline-block; margin-top: 10px; color: #6528f7; text-decoration: none;">
                            자세히 보기 →
                        </a>
                    </article>
                <?php
                endwhile;
                ?>
            </div>

            <?php
            // 페이지네이션
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => '← 이전',
                'next_text' => '다음 →',
            ));
            ?>

        <?php else : ?>
            
            <div style="text-align: center;">
                <h2>글이 없습니다.</h2>
                <p>아직 작성된 글이 없습니다.</p>
            </div>

        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
?>
