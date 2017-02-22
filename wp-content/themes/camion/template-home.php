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
    <section class="section section-carousel">

    </section>
    <?php if (count($other_pages) > 0): ?>
    <section class="section section-trouver" id="nous-trouver">
        <h1 class="section__title">Nous trouver</h1>
        <div class="section__detailPart section__detailPart-map">

        </div>
        <?php foreach ($other_pages as $page):
            $fermeture = ($restau == $page) ? '<p>Fermé le samedi et le dimanche</p>' : '<p>Suivez-nous sur <span class="section__detailBold section__detailBold-yellow">Facebook</span></p>';
            $coord = get_field('adresse', $page);
            $horaires = get_field('horaires', $page);
            $telephone = get_field('numero_de_telephone', $page);
            if ($coord || $horaires || $telephone):?>
                <div class="section__detail">
                    <h2 class="section__detailTitle"><?php echo get_the_title($page) ?></h2>
                    <div class="section__detailContainer">
                        <?php if ($coord):
                            $coord = explode(',',$coord);
                        $coord = implode($coord,'</p><p>')?>
                            <div class="section__detailPart">
                                <p><?php echo $coord ?></p>
                            </div>
                        <?php endif;
                        if ($horaires):?>
                            <div class="section__detailPart">
                            <?php foreach ($horaires as $horaire):?>
                                <p class="section__detailBold"><?php echo $horaire['jour'] ?></p>
                                <p><?php echo $horaire['description'] ?></p>
                                <?php if ($horaire['lieu']): ?>
                                    <p><?php echo $horaire['lieu'] ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php echo $fermeture ?>
                            </div>
                        <?php endif;
                        if ($telephone): ?>
                            <div class="section__detailPart">
                                <p>Reserver au :</p>
                                <p class="section__detailBold section__detailBold-yellow"><?php echo $telephone ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        endforeach;
        endif; ?>
    </section>
</main>
<?php get_footer(); ?>
