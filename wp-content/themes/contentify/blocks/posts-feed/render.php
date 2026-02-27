<?php
/**
 * posts-feed block
 *
 * @package ContentifyParent
 * @since 1.0.0
 */

use ContentifyParent\Blocks\SingleBlock;

/** @var array $block */
$block_obj = new SingleBlock($block);
$fields = $block_obj->get_block_fields();

$is_automatic = isset($fields['posts_feed-automatic']) && $fields['posts_feed-automatic'];
$post_type = isset($fields['posts_feed-post_type']) && $fields['posts_feed-post_type'] ? $fields['posts_feed-post_type'] : 'post';
$posts_per_page = isset($fields['posts_feed-posts_per_page']) && $fields['posts_feed-posts_per_page'] ? intval($fields['posts_feed-posts_per_page']) : 3;
$manual_posts = isset($fields['posts_feed-posts']) && is_array($fields['posts_feed-posts']) ? $fields['posts_feed-posts'] : [];
$button_label = isset($fields['posts_feed-button_label']) && $fields['posts_feed-button_label'] ? $fields['posts_feed-button_label'] : 'Voir tout';

if ($is_automatic) {
    $posts = get_posts([
            'post_type' => $post_type,
            'posts_per_page' => $posts_per_page,
            'orderby' => 'date',
            'order' => 'DESC',
    ]);
} else {
    $posts = [];
    if (!empty($manual_posts)) {
        foreach ($manual_posts as $post_id) {
            $post_item = get_post($post_id);
            if ($post_item) {
                $posts[] = $post_item;
            }
        }
    }
}

if (empty($posts)) return;


$archive_url = '';

if ($is_automatic) {
    $archive_url = get_post_type_archive_link($post_type);
}
?>

<div <?php echo $block_obj->body_block('block--posts-feed'); ?>>
    <div class="container">
        <div class="block--posts-feed__header">
            <?php echo $block_obj->get_block_title('section-title'); ?>

            <?php if ($archive_url) : ?>
                <a href="<?php echo esc_url($archive_url); ?>" class="btn btn-secondary block--posts-feed__button">
                    <?php echo esc_html($button_label); ?>
                </a>
            <?php endif; ?>
        </div>

        <?php if (!empty($posts) && is_array($posts)) : ?>
            <div class="block--posts-feed__grid" data-post-type="<?php echo esc_attr($post_type); ?>">
                <?php foreach ($posts as $post_item) :
                    get_template_part('template-parts/cards/card', $post_type, ['post_id' => $post_item->ID]);
                endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>