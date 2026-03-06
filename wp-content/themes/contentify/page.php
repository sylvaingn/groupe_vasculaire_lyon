<?php get_header();

$buttons = get_field('page_banner_buttons');
?>

    <section class="top-page page-banner">
        <div class="page-banner__background">
            <?php the_post_thumbnail(); ?>
        </div>
        <div class="container">
            <div class="page-banner__wrapper">
                <!--            --><?php //echo get_breadcrumb(); ?>

                <h1 class="page-banner__title title head-title"><?php the_title(); ?></h1>

                <?php if (has_excerpt()): ?>
                    <div class="page-banner__excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($buttons) && is_array($buttons)): ?>
                    <div class="page-banner__buttons">
                        <?php foreach ($buttons as $button):
                            $link = $button['link'] ?? null;
                            $style = $button['style'] ?? 'primary';
                            if ($link):
                                ?>
                                <a href="<?php echo esc_url($link['url']); ?>"
                                   class="btn btn-<?php echo esc_attr($style); ?>"
                                        <?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '" rel="noopener"' : ''; ?>>
                                    <?php echo esc_html($link['title']); ?>
                                </a>
                            <?php endif; endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <div class="page-content">
        <div class="container">
            <?php the_content(); ?>
        </div>
    </div>

<?php get_footer();
