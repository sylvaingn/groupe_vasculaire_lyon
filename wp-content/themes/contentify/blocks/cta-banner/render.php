
<?php
/**
 * cta-banner block
 *
 * @package ContentifyParent
 * @since 1.0.0
 */

use ContentifyParent\Blocks\SingleBlock;

/** @var array $block */
$block_obj = new SingleBlock($block);
$fields = $block_obj->get_block_fields();

$image_id = $fields['cta_banner-image'] ?? null;
$text = $fields['cta_banner-text'] ?? '';
$button = $fields['cta_banner-button'] ?? null;
?>

<div <?php echo $block_obj->body_block('block--cta-banner'); ?>>
    <div class="container container-small">
        <div class="block--cta-banner--wrapper">
            <?php echo wp_get_attachment_image($image_id, 'full', false, ['class' => 'block--cta-banner__image']); ?>
            <?php echo $block_obj->get_block_title(); ?>

            <?php if ($text) : ?>
                <div class="block--cta-banner__text">
                    <?php echo $text; ?>
                </div>
            <?php endif; ?>

            <?php if ($button && !empty($button['url'])) : ?>
                <a href="<?php echo esc_url($button['url']); ?>" 
                   class="btn btn-white"
                   <?php echo !empty($button['target']) ? 'target="' . esc_attr($button['target']) . '"' : ''; ?>>
                    <?php echo esc_html($button['title'] ?: $button['url']); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>