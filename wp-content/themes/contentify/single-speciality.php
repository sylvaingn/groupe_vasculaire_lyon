<?php
/**
 * Template pour afficher une spécialité unique
 */

get_header();

$doctolib_link = get_field('doctolib_global_link', 'option');
?>

<section class="top-page single-speciality-banner">
    <div class="banner-background--img">
        <?php the_post_thumbnail(); ?>
    </div>
    <div class="container">
        <div class="single-speciality-banner--wrapper">
            <?php echo get_breadcrumb(); ?>

            <h1 class="single-speciality-banner__title title head-title"><?php the_title(); ?></h1>

            <?php if ($doctolib_link): ?>
                <a href="<?php echo esc_url($doctolib_link); ?>" class="btn btn-secondary" target="_blank"
                   rel="noopener">
                    <?php echo __('Prendre rendez-vous', TEXT_DOMAIN); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php the_content(); ?>

<?php get_footer(); ?>
