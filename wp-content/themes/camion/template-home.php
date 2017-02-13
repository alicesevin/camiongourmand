<?php
/*
Template Name: Accueil
*/
get_header();
the_post();
global $restau;
$content = get_the_content();
$other_pages = get_posts(array('fields' => 'ids', 'post_type' => 'page', 'post__not_in' => array(get_the_ID())));
$facebook = get_field('facebook','option');
$instagram = get_field('instagram','option');
?>
<div>
    <main>
        <?php if ($content): ?>
            <section id="notre-histoire">
                <h2>Notre histoire</h2>
                <div><?php the_content() ?></div>
            </section>
        <?php endif; ?>
        <?php if (count($other_pages) > 0): ?>
        <section id="nous-trouver">
            <h2>Nous trouver</h2>
            <?php foreach ($other_pages as $page):
                $fermeture = ($restau == $page) ? '<p>Fermé le samedi et le dimanche</p>' : 'Suivez-nous sur facebook';
                $coord = get_field('adresse', $page);
                $horaires = get_field('horaires', $page);
                $telephone = get_field('numero_de_telephone', $page);
                if ($coord || $horaires || $telephone):?>
                    <h3><?php echo get_the_title($page) ?></h3>
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
                    <?php endif;
                endif;
            endforeach;
            endif; ?>
        </section>
        <?php if ($facebook || $instagram): ?>
        <section id="nous-suivre">
            <h2>Nous suivre</h2>
            <a href="<?php echo $instagram?>">A</a>
            <a href="<?php echo $facebook?>">B</a>
            <p>Ou se faire livrer par</p>
            <a href="#">Take eat easy</a>
        </section>
        <?php endif; ?>
    </main>
</div>
<?php get_footer(); ?>
