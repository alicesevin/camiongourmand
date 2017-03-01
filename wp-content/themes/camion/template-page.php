<?php
/*
Template Name: Sous page
*/
get_header();
the_post();
global $restau;
$isRestau = (get_the_ID() == $restau);
$post_type = (get_the_ID() == $restau) ? 'restaurant' : 'camion';
$images = get_field('images');
$listes = get_terms(array(
    'taxonomy' => 'liste',
    'hide_empty' => true,
));
?>
<main id="<?php echo $post_type ?>" class="main main-<?php echo $post_type ?>">
    <?php set_query_var('post_type', $post_type);
    echo get_template_part('templates/cover'); ?>
    <section class="section">
        <h1 class="section__title"><?php echo get_the_title() ?></h1>
        <p class="section__description"><?php echo get_the_content() ?></p>
    </section>
    <?php echo get_template_part('templates/carousel');
    if (count($listes) > 0):
        $indexListe = 0;
        $indexImg = 0;
        $midsize = (count($listes) > 1) ? ceil(count($listes) / 2) : 2; ?>
        <section class="section section-menus">
            <h1 class="section__title">Nos menus</h1>
            <div class="section__column section__column-left">
                <?php foreach ($listes as $liste => $val):
                $liste = $val->name;
                $args = array(
                    'post_type' => $post_type,
                    'post_status' => 'publish',
                    'post_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'ASC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'liste',
                            'field' => 'name',
                            'terms' => $liste,
                        ),
                    )
                );
                $menus = new WP_Query($args);
                if ($indexListe == $midsize): ?>
            </div>
            <div class="section__column section__column-right">
                <?php endif;
                if ($menus->have_posts()):
                    $indexMenus = 0;
                    $indexMenusImg = 0;
                    $menusDivided = 3; ?>
                    <div class="section__detail">
                        <h1 class="section__detailTitle"><?php echo $liste ?></h1>
                        <ul class="section__detailContainer">
                            <?php while ($menus->have_posts()):$menus->the_post(); ?>
                                <?php echo get_template_part('templates/menu');
                                if ($isRestau && $indexMenus == $menusDivided && $menusDivided <= count($menus->posts)):

                                    $menusDivided += $menusDivided;
                                    $indexMenusImg++;
                                endif;
                                $indexMenus++ ?>
                            <?php endwhile; ?>
                        </ul>
                        <?php
                        if (!$isRestau && $images && count($images) > 0 && ($index != (count($listes) - 1))):
                            if ($images[$indexImg]):?>
                                <div class="section__detailContainer section__detailContainer-img">
                                    <img src="<?php echo $images[$indexImg]['url']; ?>"
                                         alt="<?php echo $images[$indexImg]['name']; ?>">
                                </div>
                                <?php $indexImg++;
                            endif;
                        endif; ?>
                    </div>
                <?php endif;
                $indexListe++;
                endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
