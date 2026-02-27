<?php
/**
 * Template part: Post card
 *
 * @param array $args {
 * @type int $post_id Post ID
 * }
 * @since 1.0.0
 *
 * @package Contentify
 */

defined('ABSPATH') || exit;

$post_id = isset($args['post_id']) ? $args['post_id'] : get_the_ID();

if (!$post_id) {
    return;
}

$thumbnail_id = get_post_thumbnail_id($post_id);
$title = get_the_title($post_id);
$excerpt = get_the_excerpt($post_id);
$permalink = get_permalink($post_id);
$date = get_the_date('', $post_id);
?>

<article class="card-post">
    <?php if ($thumbnail_id) : ?>
        <div class="card-post__image">
            <?php echo wp_get_attachment_image($thumbnail_id, 'medium_large', false, ['class' => 'card-post__img']); ?>
        </div>
    <?php endif; ?>

    <div class="card-post__content">
        <?php if ($title) : ?>
            <h3 class="card-title card-post__title">
                <a href="<?php echo esc_url($permalink); ?>" class="stretched-link">
                    <?php echo esc_html($title); ?>
                </a>
            </h3>
        <?php endif; ?>

        <?php if ($excerpt) : ?>
            <div class="card-post__excerpt">
                <?php echo esc_html($excerpt); ?>
            </div>
        <?php endif; ?>

        <span class="card-post__read-more">
            <?php echo __('Lire le suite', TEXT_DOMAIN); ?>
        </span>
    </div>
</article>
