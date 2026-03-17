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
        </div>
    </div>
</section>

<div class="container">
    <?php the_content(); ?>
</div>

<?php get_footer(); ?>
