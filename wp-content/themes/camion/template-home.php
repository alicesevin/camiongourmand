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
$other_pages = array_reverse($other_pages);
?>
<!-- MAIN -->
<main id="<?php echo $post_type ?>" class="main main-home">
    <?php echo get_template_part('templates/cover'); ?>
    <?php if ($content): ?>
        <!-- MAIN - HISTOIRE -->
        <div class="nav-point" id="notre-histoire" role="region" aria-label="history region"></div>
        <section class="section section-histoire">
            <!-- MAIN - HISTOIRE - Description -->
            <h1 class="section__title" role="presentation">Notre histoire</h1>
            <p class="section__description" role="contentinfo"><?php the_content() ?></p>
            <!-- MAIN - HISTOIRE - Background -->
            <?php
            set_query_var('section', 'histoire');
            set_query_var('icons', array('champi','poulet','oeuf'));
            echo get_template_part('templates/background'); ?>
        </section>
    <?php endif;
    echo get_template_part('templates/carousel');
    if (count($other_pages) > 0): ?>
    <!-- MAIN - NOUS TROUVER -->
    <div class="nav-point" id="nous-trouver" role="region" aria-label="location region"></div>
    <section class="section section-trouver">
        <!-- MAIN - NOUS TROUVER - Description -->
        <h1 class="section__title" role="presentation">Nous trouver</h1>
        <div class="section__detailPart section__detailPart-map">
            <?php echo do_shortcode('[wpgmza id="1"]') ?>
        </div>
        <!-- MAIN - NOUS TROUVER - Horaires -->
        <?php foreach ($other_pages as $page):
            $fermeture = ($restau == $page) ? '<p>Fermé le samedi et le dimanche</p>' : '<p>Suivez-nous sur <span class="section__detailBold section__detailBold-yellow">Facebook</span></p>';
            $coord = get_field('adresse', $page);
            $title = get_the_title($page);
            $horaires = get_field('horaires', $page);
            $telephone = get_field('numero_de_telephone', $page);
            if ($coord || $horaires || $telephone):?>
                <div class="section__detail">
                    <h2 class="section__detailTitle" role="presentation"><?php echo $title ?></h2>
                    <div class="section__detailContainer" role="contentinfo">
                        <?php if ($coord):
                            $coord = explode(',',$coord);
                        $coord = implode($coord,'</p><p>')?>
                            <div class="section__detailPart" role="contentinfo">
                                <p><?php echo $coord ?></p>
                            </div>
                        <?php endif;
                        if ($horaires):
                            $toEnd = count($horaires);?>
                            <?php foreach ($horaires as $key=>$horaire):?>
                                <div class="section__detailPart" role="contentinfo">
                                <p class="section__detailBold" aria-label="opening day"><?php echo $horaire['jour'] ?></p>
                                <p aria-label="timetable description"><?php echo $horaire['description'] ?></p>
                                <?php if ($horaire['lieu']): ?>
                                    <p aria-label="location description"><?php echo $horaire['lieu'] ?></p>
                                <?php endif; ?>
                                    <?php if(($horaire == $horaires[0] && $title == 'Le restaurant') ||
                                        ($title == 'Le camion' && 0 === --$toEnd ))
                                        echo $fermeture ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif;
                        if ($telephone): ?>
                            <div class="section__detailPart">
                                <p>Reserver au :</p>
                                <p class="section__detailBold section__detailBold-yellow" aria-label="phone number"><?php echo $telephone ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        endforeach;
        endif; ?>
        <!-- MAIN - NOUS TROUVER - Background -->
        <?php
        set_query_var('section', 'trouver');
        set_query_var('icons', array('book','confiture'));
        echo get_template_part('templates/background'); ?>
    </section>
</main>
<?php get_footer(); ?>
