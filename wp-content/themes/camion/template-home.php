<?php
/*
Template Name: Accueil
*/
get_header();
the_post();
global $restau;
global $facebook;
global $instagram;
$content = get_the_content();
$other_pages = get_posts(array('fields' => 'ids', 'post_type' => 'page', 'post__not_in' => array(get_the_ID())));
?>

<main id="<?php echo $post_type ?>" class="main main-home">
    <?php echo get_template_part('templates/cover'); ?>
    <?php if ($content): ?>
        <section class="section section-histoire" id="notre-histoire">
            <h1 class="section__title">Notre histoire</h1>
            <p class="section__description"><?php the_content() ?></p>
        </section>
    <?php endif; ?>
    <?php if (count($other_pages) > 0): ?>
    <section class="section section-trouver" id="nous-trouver">
        <h1 class="section__title">Nous trouver</h1>
        <?php foreach ($other_pages as $page):
            $fermeture = ($restau == $page) ? '<p>Fermé le samedi et le dimanche</p>' : 'Suivez-nous sur facebook';
            $coord = get_field('adresse', $page);
            $horaires = get_field('horaires', $page);
            $telephone = get_field('numero_de_telephone', $page);
            if ($coord || $horaires || $telephone):?>
                <div class="section__detail section__detail-">
                    <h2 class="section__detailTitle"><?php echo get_the_title($page) ?></h2>
                    <div class="section__detailContainer">
                        <?php if ($coord): ?>
                            <p><?php echo $coord ?></p>
                        <?php endif;
                        if ($horaires):
                            foreach ($horaires as $horaire):?>
                                <p><?php echo $horaire['jour'] ?></p>
                                <p><?php echo $horaire['description'] ?></p>
                                <?php if ($horaire['lieu']): ?>
                                    <p><?php echo $horaire['lieu'] ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php echo $fermeture ?>
                        <?php endif;
                        if ($telephone): ?>
                            <p>Reserver au :<?php echo $telephone ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        endforeach;
        endif; ?>
    </section>
</main>
<?php get_footer(); ?>
