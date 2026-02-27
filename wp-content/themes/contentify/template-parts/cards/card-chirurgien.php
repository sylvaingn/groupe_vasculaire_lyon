<?php
/**
 * Template part: Chirurgien card
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
$cv = get_field('chirurgien-cv', $post_id);
$linkedin = get_field('chirurgien-linkedin', $post_id);
$doctolib = get_field('chirurgien-doctolib', $post_id);
$gallery = get_field('chirurgien-gallery', $post_id);
$thumbnail_id = get_post_thumbnail_id($post_id);
?>

<article class="card-chirurgien">
    <div class="card-chirurgien__slider">
        <?php if (!empty($gallery) && is_array($gallery)) : ?>
            <div class="swiper card-chirurgien__swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($gallery as $image_id) : ?>
                        <div class="swiper-slide">
                            <?php echo wp_get_attachment_image($image_id, 'medium_large', false, ['class' => 'card-chirurgien__img']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        <?php elseif ($thumbnail_id) : ?>
            <div class="card-chirurgien__thumbnail">
                <?php echo wp_get_attachment_image($thumbnail_id, 'medium_large', false, ['class' => 'card-chirurgien__img']); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="card-chirurgien__content">
        <?php if ($title) : ?>
            <h3 class="card-chirurgien__title">
                <?php echo esc_html($title); ?>
            </h3>
        <?php endif; ?>

        <?php if ($cv) : ?>
            <div class="card-chirurgien__cv">
                <?php echo $cv; ?>
            </div>
        <?php endif; ?>

        <?php if ($linkedin || $doctolib) : ?>
            <div class="card-chirurgien__links">
                <?php if ($doctolib) : ?>
                    <a href="<?php echo esc_url($doctolib); ?>" class="card-chirurgien__link card-chirurgien__link--doctolib" target="_blank" rel="noopener noreferrer">
                        Doctolib
                    </a>
                <?php endif; ?>

                <?php if ($linkedin) : ?>
                    <a href="<?php echo esc_url($linkedin); ?>" class="card-chirurgien__link card-chirurgien__link--linkedin" target="_blank" rel="noopener noreferrer">
                        LinkedIn
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</article>
