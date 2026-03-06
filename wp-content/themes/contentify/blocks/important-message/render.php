
<?php
/**
 * important-message block
 *
 * @package ContentifyParent
 * @since 1.0.0
 */

use ContentifyParent\Blocks\SingleBlock;

/** @var array $block */
$block_obj = new SingleBlock($block);
$fields = $block_obj->get_block_fields();

$icon = $fields['important_message-icon'] ?? null;
$title = $fields['important_message-title'] ?? '';
$text = $fields['important_message-text'] ?? '';
$link = $fields['important_message-link'] ?? null;
?>

<div <?php echo $block_obj->body_block('block--important-message'); ?>>
    <div class="container">
        <div class="block--important-message__wrapper">
            <div class="block--important-message__left">
                <?php if ($icon): ?>
                    <div class="block--important-message__icon">
                        <?php echo wp_get_attachment_image($icon, 'thumbnail'); ?>
                    </div>
                <?php else: ?>
                    <div class="block--important-message__icon block--important-message__icon--default">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    </div>
                <?php endif; ?>

                <div class="block--important-message__content">
                    <?php if ($title): ?>
                        <h3 class="block--important-message__title"><?php echo esc_html($title); ?></h3>
                    <?php endif; ?>
                    <?php if ($text): ?>
                        <p class="block--important-message__text"><?php echo esc_html($text); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($link): ?>
                <div class="block--important-message__right">
                    <a href="<?php echo esc_url($link['url']); ?>" 
                       class="btn btn-primary"
                       <?php echo !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '" rel="noopener"' : ''; ?>>
                        <?php echo esc_html($link['title']); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>