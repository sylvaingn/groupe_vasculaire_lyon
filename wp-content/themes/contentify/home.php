<?php
/**
 * Template pour la page d'archive des articles (Recommandations)
 *
 * @package Contentify
 */

get_header();

$page_for_posts = get_option('page_for_posts');
$page_title = $page_for_posts ? get_the_title($page_for_posts) : __('Recommandations', TEXT_DOMAIN);
$page_thumbnail_id = $page_for_posts ? get_post_thumbnail_id($page_for_posts) : null;

$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$args = [
        'post_type' => 'post',
        'posts_per_page' => 9,
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC'
];

$posts_query = new WP_Query($args);
?>

<section class="top-page page-banner">
    <?php if ($page_thumbnail_id): ?>
        <div class="page-banner__background">
            <?php echo wp_get_attachment_image($page_thumbnail_id, 'full'); ?>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="page-banner__wrapper">
            <?php echo get_breadcrumb(); ?>
            <h1 class="page-banner__title title head-title"><?php echo esc_html($page_title); ?></h1>
        </div>
    </div>
</section>

<section class="archive-posts">
    <?php if ($posts_query->have_posts()): ?>
        <div class="archive-posts__grid">
            <?php while ($posts_query->have_posts()): $posts_query->the_post(); ?>
                <?php get_template_part('template-parts/cards/card', 'post', ['post_id' => get_the_ID()]); ?>
            <?php endwhile; ?>
        </div>

        <?php if ($posts_query->max_num_pages > 1): ?>
            <div class="archive-posts__pagination">
                <?php
                echo paginate_links([
                        'total' => $posts_query->max_num_pages,
                        'current' => $paged,
                        'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                        'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>',
                ]);
                ?>
            </div>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    <?php else: ?>
        <p class="archive-posts__no-posts"><?php echo __('Aucune recommandation pour le moment.', TEXT_DOMAIN); ?></p>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
