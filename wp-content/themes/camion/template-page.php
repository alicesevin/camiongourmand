<?php
/*
Template Name: Sous page
*/
get_header();
the_post();
global $restau;
$post_type = (get_the_ID() == $restau) ? 'restaurant' : 'camion';
$listes = get_terms(array(
    'taxonomy' => 'liste',
    'hide_empty' => true,
));
?>
<!-- MAIN -->
<main id="<?php echo $post_type ?>" class="main main-<?php echo $post_type ?>" role="main">
    <?php set_query_var('post_type', $post_type);
    echo get_template_part('templates/cover'); ?>
    <!-- MAIN - HISTOIRE -->
    <section class="section" role="region">
        <!-- MAIN - HISTOIRE - Description -->
        <h1 class="section__title" role="presentation"><?php echo get_the_title() ?></h1>
        <p class="section__description" role="contentinfo"><?php echo get_the_content() ?></p>
        <!-- MAIN - HISTOIRE - Background -->
        <?php
        set_query_var('section', 'histoire');
        set_query_var('icons', array('champi', 'poulet', 'oeuf'));
        echo get_template_part('templates/background'); ?>
    </section>
    <!-- MAIN - CAROUSEL -->
    <?php echo get_template_part('templates/carousel');
    if (count($listes) > 0):?>
        <!-- MAIN - MENUS -->
        <section class="section section-menus">
            <h1 class="section__title">Nos menus</h1>
            <div class="section__detail">
                <?php
                $isRestau = (get_the_ID() == $restau);
                $images = get_field('images');
                $indexMenusImg = 0;
                $indexListe = 0;
                foreach ($listes as $liste => $val):
                    $listeMenusL = [];
                    $listeMenusR = [];
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
                    if ($menus->have_posts()):?>
                        <?php
                        $indexMenus = 0;
                        $menusDivided = 1;
                        $countMenu = count($menus->posts);
                        $midsizeMenus = ($countMenu > 1) ? ceil($countMenu / 2) + 1 : 2;
                        if(!$isRestau) $midsizeMenus= $countMenu;

                        while ($menus->have_posts()):
                            $menus->the_post();

                            //Define image time display
                            $img = $title = '';
                            $allowed = ($isRestau && ($indexMenus == $menusDivided) && ($menusDivided < $countMenu));
                            if(!$isRestau) $allowed = ($indexMenus ==  0 && $indexListe > 0);

                            if ($indexMenus == 0) {
                                $title = '<li class="menus__item menus__item-title"><h1>' . $liste . '</h1></li>';
                            }
                            //Get menu content
                            $shortcode = sprintf('[menu liste="%1$s"]', $liste);

                            //Add separation image if allowed to
                            if ($allowed) {
                                $img = '<li class="menus__item menus__item-img">' .
                                    '<img srcset="' .
                                    $images[$indexMenusImg]['sizes']['thumbnail'] . ' 200w,' .
                                    $images[$indexMenusImg]['sizes']['medium'] . ' 600w,' .
                                    $images[$indexMenusImg]['sizes']['large'] . ' 1000w"' .
                                    'src="' . $images[$indexMenusImg]['url'] . '"' .
                                    'alt="' . $images[$indexMenusImg]['name'] . '">' .
                                    '</li>';
                                $indexMenusImg++;
                            }

                            //increment count
                            $indexMenus++;

                            //Add content to associated liste
                            $content = $img . $title . do_shortcode($shortcode);
                            (($indexMenus - 1) > $midsizeMenus) ? $listeMenusR[] = $content : $listeMenusL[] = $content;
                        endwhile;
                    endif; ?>
                    <!-- MAIN - MENUS - Liste -->
                    <?php echo '<div class="section__column section__column-left"><ul class="section__detailContainer">' . implode('', $listeMenusL) . '</ul></div>';
                    if (count($listeMenusR) > 0)
                        echo '<div class="section__column section__column-right"><ul class="section__detailContainer">' . implode('', $listeMenusR) . '</ul></div>'; ?>
                    <?php
                    $indexListe++;
                endforeach; ?>
                <!-- MAIN - MENUS - Background -->
            </div>
            <?php
            set_query_var('section', 'menus');
            set_query_var('icons', array('camion', 'confiture'));
            echo get_template_part('templates/background'); ?>
        </section>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
