<?php
/**
 * image-text block
 *
 * @package ContentifyParent
 * @since 1.0.0
 */

use ContentifyParent\Blocks\SingleBlock;

/** @var array $block */
$block_obj = new SingleBlock($block);
$fields = $block_obj->get_block_fields();

$surtitle = $fields['image_text-surtitle'] ?? '';
$text = $fields['image_text-text'] ?? '';
$image_id = $fields['image_text-image'] ?? null;
$additional_info_title = $fields['image_text-additional_info_title'] ?? '';
$additional_info_entries = $fields['image_text-additional_info_entries'] ?? [];
$additional_text = $fields['image_text-additional_text'] ?? '';
$image_position = $fields['image_text-image_position'] ?? 'right';
$image_contain = $fields['image_text-image_contain'] ?? false;

$block_classes = 'block--image-text';
$block_classes .= ' block--image-text--image-' . $image_position;
if ($image_contain) {
    $block_classes .= ' block--image-text--image-contain';
}
?>

<div <?php echo $block_obj->body_block($block_classes); ?>>
    <div class="container">
        <div class="block--image-text--wrapper <?php echo $image_id ? '' : 'one-col'; ?>">
            <div class="block--image-text__content">
                <?php if ($surtitle): ?>
                    <div class="tag"><?php echo esc_html($surtitle); ?></div>
                <?php endif; ?>

                <?php echo $block_obj->get_block_title('section-title--medium'); ?>

                <?php if ($text): ?>
                    <div class="block--image-text__text">
                        <?php echo $text; ?>
                    </div>
                <?php endif; ?>

                <?php if ($additional_info_title || !empty($additional_info_entries) || $additional_text): ?>
                    <div class="block--image-text__additional-info">
                        <?php if ($additional_info_title): ?>
                            <h3 class="block--image-text__additional-info-title"><?php echo esc_html($additional_info_title); ?></h3>
                        <?php endif; ?>

                        <?php if (!empty($additional_info_entries) && is_array($additional_info_entries)): ?>
                            <ul class="block--image-text__entries">
                                <?php foreach ($additional_info_entries as $entry):
                                    $entry_title = $entry['entry_title'] ?? '';
                                    $entry_text = $entry['entry_text'] ?? '';
                                    ?>
                                    <li class="block--image-text__entry">
                                        <?php if ($entry_title): ?>
                                            <strong class="block--image-text__entry-title"><?php echo esc_html($entry_title); ?></strong>
                                        <?php endif; ?>
                                        <?php if ($entry_text): ?>
                                            <span class="block--image-text__entry-text"><?php echo $entry_text; ?></span>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if ($additional_text): ?>
                            <p class="block--image-text__additional-text"><?php echo $additional_text; ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($image_id): ?>
                <div class="block--image-text__image-wrapper">
                    <?php echo wp_get_attachment_image($image_id, 'large', false, ['class' => 'block--image-text__image']); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>