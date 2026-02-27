<?php
/**
 * image-banner block
 *
 * @package ContentifyParent
 * @since 1.0.0
 */

use ContentifyParent\Blocks\SingleBlock;

/** @var array $block */
$block_obj = new SingleBlock($block);
$fields = $block_obj->get_block_fields();

$image_id = $fields['image_banner-image'] ?? null;
$description = $fields['image_banner-description'] ?? '';
$buttons = $fields['image_banner-buttons'] ?? [];
?>

<div <?php echo $block_obj->body_block('block--image-banner'); ?>>
    <?php if ($image_id) : ?>
        <div class="block--image-banner__background">
            <?php echo wp_get_attachment_image($image_id, 'full', false, ['class' => 'block--image-banner__image']); ?>
        </div>
    <?php endif; ?>

    <div class="container container">
        <div class="block--image-banner__content">
            <?php echo $block_obj->get_block_title('head-title'); ?>

            <?php if ($description) : ?>
                <div class="block--image-banner__description">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($buttons) && is_array($buttons)) : ?>
                <div class="block--image-banner__buttons">
                    <?php foreach ($buttons as $k => $button) :
                        $link = isset($button['button-link']) ? $button['button-link'] : null;
                        if ($link && !empty($link['url'])) :
                            $url = esc_url($link['url']);
                            $title = isset($link['title']) && $link['title'] ? esc_html($link['title']) : $url;
                            $target = !empty($link['target']) ? esc_attr($link['target']) : '';
                            ?>
                            <a href="<?php echo $url; ?>"
                               class="btn <?php echo $k % 2 === 0 ? 'btn-secondary' : 'btn-primary'; ?>"
                                    <?php echo $target ? 'target="' . $target . '"' : ''; ?>>
                                <?php echo $title; ?>
                            </a>
                        <?php endif;
                    endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>