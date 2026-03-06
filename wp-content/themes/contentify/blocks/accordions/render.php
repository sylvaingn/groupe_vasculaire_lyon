
<?php
/**
 * accordions block
 *
 * @package ContentifyParent
 * @since 1.0.0
 */

use ContentifyParent\Blocks\SingleBlock;

/** @var array $block */
$block_obj = new SingleBlock($block);
$fields = $block_obj->get_block_fields();

$surtitle = $fields['accordions-surtitle'] ?? '';
$description = $fields['accordions-description'] ?? '';
$items = $fields['accordions-items'] ?? [];
?>

<div <?php echo $block_obj->body_block('block--accordions'); ?>>
    <div class="container">
        <div class="block--accordions__header">
            <?php if ($surtitle): ?>
                <div class="tag tag-secondary"><?php echo esc_html($surtitle); ?></div>
            <?php endif; ?>

            <?php echo $block_obj->get_block_title('section-title--medium'); ?>

            <?php if ($description): ?>
                <div class="block--accordions__description">
                    <?php echo esc_html($description); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($items) && is_array($items)): ?>
            <div class="block--accordions__list">
                <?php foreach ($items as $index => $item): 
                    $item_title = $item['title'] ?? '';
                    $item_text = $item['text'] ?? '';
                    $item_additional = $item['additional_info'] ?? '';
                ?>
                    <div class="block--accordions__item">
                        <span class="block--accordions__number"><?php echo $index + 1; ?></span>
                        <div class="block--accordions__item-content">
                            <h3 class="block--accordions__title"><?php echo esc_html($item_title); ?></h3>
                            <?php if ($item_text): ?>
                                <div class="block--accordions__text">
                                    <?php echo esc_html($item_text); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($item_additional): ?>
                                <button class="block--accordions__trigger" aria-expanded="false" aria-controls="accordion-<?php echo $block['id'] . '-' . $index; ?>">
                                    <span>Voir plus</span>
                                    <span class="block--accordions__trigger-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </span>
                                </button>
                                <div class="block--accordions__additional" id="accordion-<?php echo $block['id'] . '-' . $index; ?>" hidden>
                                    <?php echo $item_additional; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>