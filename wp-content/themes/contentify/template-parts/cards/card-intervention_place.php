<?php
/**
 * Template part: Lieu d'intervention card
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

$title = get_the_title($post_id);
$content = get_the_content(null, false, $post_id);
$thumbnail_id = get_post_thumbnail_id($post_id);
$maps_url = get_field('intervention_place-maps_url', $post_id);
?>

<div class="card-intervention-place">
    <?php if ($thumbnail_id) : ?>
        <div class="card-intervention-place__background">
            <?php echo wp_get_attachment_image($thumbnail_id, 'large', false, ['class' => 'card-intervention-place__img']); ?>
        </div>
    <?php endif; ?>

    <div class="card-intervention-place__content">
        <?php if ($title) : ?>
            <div class="title card-title">
                <?php echo esc_html($title); ?>
            </div>
        <?php endif; ?>

        <?php if ($content) : ?>
            <div class="card-intervention-place__text">
                <?php echo wp_trim_words($content, 20, '...'); ?>
            </div>
        <?php endif; ?>

        <?php if ($maps_url) : ?>
            <a href="<?php echo esc_url($maps_url); ?>" class="card-intervention-place__link" target="_blank" rel="noopener noreferrer">
                <?php echo __('Voir le plan', TEXT_DOMAIN); ?>
            </a>
        <?php endif; ?>
    </div>
</div>
