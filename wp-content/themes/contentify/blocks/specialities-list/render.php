<?php
/**
 * specialities-list block
 *
 * @package ContentifyParent
 * @since 1.0.0
 */

use ContentifyParent\Blocks\SingleBlock;

/** @var array $block */
$block_obj = new SingleBlock($block);
$fields = $block_obj->get_block_fields();

$specialities = get_posts([
        'post_type' => 'speciality',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
]);
?>

<div <?php echo $block_obj->body_block('block--specialities-list'); ?>>
    <div class="container">
        <?php echo $block_obj->get_block_title('section-title text-center'); ?>

        <?php if (!empty($specialities) && is_array($specialities)) : ?>
            <div class="block--specialities-list__grid">
                <div class="block--specialities-list__schema">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/speciality_schema.svg' ?>"
                         alt="Schéma des spécialités" class="block--specialities-list__schema-img">
                </div>
                <?php foreach ($specialities as $speciality) :
                    $icon_id = get_field('speciality-icon', $speciality->ID);
                    $title = get_the_title($speciality->ID);
                    $excerpt = get_the_excerpt($speciality->ID);
                    $permalink = get_permalink($speciality->ID);
                    ?>
                    <div class="block--specialities-list__card">
                        <?php if ($icon_id) : ?>
                            <div class="block--specialities-list__card-icon">
                                <?php echo wp_get_attachment_image($icon_id, 'thumbnail', false, ['class' => 'block--specialities-list__icon-img']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="block--specialities-list__card-content">
                            <?php if ($title) : ?>
                                <h3 class="block--specialities-list__card-title">
                                    <?php echo esc_html($title); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ($excerpt) : ?>
                                <p class="block--specialities-list__card-excerpt">
                                    <?php echo esc_html($excerpt); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ($permalink) : ?>
                                <a href="<?php echo esc_url($permalink); ?>"
                                   class="block--specialities-list__card-link">
                                    En savoir plus
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>