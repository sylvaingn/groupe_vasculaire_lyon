<?php
/**
 * contact block
 *
 * @package ContentifyParent
 * @since 1.0.0
 */

use ContentifyParent\Blocks\SingleBlock;

/** @var array $block */
$block_obj = new SingleBlock($block);
$fields = $block_obj->get_block_fields();

$secretariat_phone = get_field('contacts_secretariat_phone', 'option');
$secretariat_email = get_field('contacts_secretariat_email', 'option');
$centers = get_field('contacts_centers', 'option');
?>

<div <?php echo $block_obj->body_block('block--contact'); ?>>
    <div class="container">
        <div class="block--contact--wrapper">
            <div class="block--contact__infos">
                <?php echo $block_obj->get_block_title('section-title'); ?>

                <?php if ($secretariat_phone || $secretariat_email) : ?>
                    <div class="block--contact__secretariat panel">
                        <div class="block--contact__subtitle card-title"><?php _e('Secrétariat', TEXT_DOMAIN); ?></div>
                        <?php if ($secretariat_phone) : ?>
                            <div class="block--contact__item">
                                <i class="fa-solid fa-phone"></i>
                                <div class="contact__item__row">
                                    <div class="row__label"><?php echo __('Téléphone', TEXT_DOMAIN); ?></div>
                                    <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $secretariat_phone)); ?>">
                                        <?php
                                        //echo phone on formatted way (ex: 0123456789 => 01.23.45.67.89)
                                        echo esc_html(preg_replace('/(\d{2})(?=\d)/', '$1.', $secretariat_phone));

                                        ?>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($secretariat_email) : ?>
                            <div class="block--contact__item">
                                <i class="fa-solid fa-envelope"></i>
                                <div class="contact__item__row">
                                    <div class="row__label"><?php echo __('Email', TEXT_DOMAIN); ?></div>
                                    <a href="mailto:<?php echo esc_attr($secretariat_email); ?>">
                                        <?php echo esc_html($secretariat_email); ?>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($centers) && is_array($centers)) : ?>
                    <div class="block--contact__centers">
                        <div class="block--contact__subtitle card-title"><?php _e('Nos lieux de consultation', TEXT_DOMAIN); ?></div>
                        <div class="centers--wrapper">
                            <?php foreach ($centers as $center) :
                                $name = $center['center_name'] ?? '';
                                $address = $center['center_address'] ?? '';
                                $phone = $center['center_phone'] ?? '';
                                ?>
                                <div class="block--contact__center panel">
                                    <?php if ($name) : ?>
                                        <div class="block--contact__center-name"><?php echo esc_html($name); ?></div>
                                    <?php endif; ?>
                                    <?php if ($address) : ?>
                                        <p class="block--contact__item">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <span><?php echo $address; ?></span>
                                        </p>
                                    <?php endif; ?>
                                    <?php if ($phone) : ?>
                                        <p class="block--contact__item">
                                            <i class="fa-solid fa-phone"></i>
                                            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>">
                                                <?php echo esc_html($phone); ?>
                                            </a>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                <?php endif; ?>
            </div>

            <div class="block--contact__map">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/carte.png"
                     alt="<?php _e('Carte', TEXT_DOMAIN); ?>" class="block--contact__map-image">
            </div>
        </div>
    </div>
</div>