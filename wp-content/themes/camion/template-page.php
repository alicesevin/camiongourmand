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
<main id="<?php echo $post_type ?>" class="main main-<?php echo $post_type ?>">
    <?php set_query_var('post_type', $post_type);
    echo get_template_part('templates/cover'); ?>
    <!-- MAIN - HISTOIRE -->
    <section class="section">
        <!-- MAIN - HISTOIRE - Description -->
        <h1 class="section__title"><?php echo get_the_title() ?></h1>
        <p class="section__description"><?php echo get_the_content() ?></p>
        <!-- MAIN - HISTOIRE - Background -->
        <?php
        set_query_var('section', 'histoire');
        set_query_var('icons', array('champi', 'poulet', 'oeuf'));
        echo get_template_part('templates/background'); ?>
    </section>
    <!-- MAIN - CAROUSEL -->
    <?php echo get_template_part('templates/carousel');
    if (count($listes) > 0):
        $listeMenusL = [];
        $listeMenusR = [];
        $isRestau = (get_the_ID() == $restau);
        $images = get_field('images');

        foreach ($listes as $liste => $val):
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
            if ($menus->have_posts()):
                $indexMenusImg = 0;
                $indexMenus = 0;
                $menusDivided = 1;
                $countMenu = count($menus->posts);
                $midsizeMenus = ($countMenu > 1) ? ceil($countMenu / 2) : 2;

                while ($menus->have_posts()):
                    $menus->the_post();

                    //Define image time display
                    $img = $deb = $fin = '';
                    $allowed = (!$isRestau && ($indexMenus == $menusDivided) && ($menusDivided < $countMenu));
                    if (!$isRestau) $allowed = ($indexMenus == $menusDivided) && ($menusDivided < $countMenu);

                    //Add begin if menus are beginning
                    if ($indexMenus == 0) {
                        $deb = '<div class="section__detail">' .
                            '<h1 class="section__detailTitle">' . $liste . '</h1>' .
                            '<ul class="section__detailContainer">';
                    }

                    //Get menu content
                    $shortcode = sprintf('[menu liste="%1$s"]', $liste);

                    //Add separation image if allowed to
                    if ($allowed) {
                        $img = '<li class="menus__item menus__item-img ">' .
                            '<img srcset="' .
                            $images[$indexMenusImg]['sizes']['thumbnail'] . ' 200w,' .
                            $images[$indexMenusImg]['sizes']['medium'] . ' 600w,' .
                            $images[$indexMenusImg]['sizes']['large'] . ' 1000w"' .
                            'src="' . $images[$indexMenusImg]['url'] . '"' .
                            'alt="' . $images[$indexMenusImg]['name'] . '">' .
                            '</li>';
                        $indexMenusImg++;
                    }

                    //End list if menus are ending
                    if ($indexMenus == ($countMenu - 1)) {
                        $fin = '</ul></div>';
                    }

                    //increment count
                    $indexMenus++;

                    //Add content to associated liste
                    $content = $deb . do_shortcode($shortcode) . $img . $fin;
                    (($indexMenus - 1) > $midsizeMenus) ? $listeMenusR[] = $content : $listeMenusL[] = $content;
                endwhile;
            endif;
        endforeach; ?>
        <!-- MAIN - MENUS -->
        <section class="section section-menus">
            <h1 class="section__title">Nos menus</h1>
            <!-- MAIN - MENUS - Liste -->
            <?php echo '<div class="section__column section__column-left">' . implode('', $listeMenusL) . '</div>';
            if (count($listeMenusR) > 0)
                echo '<div class="section__column section__column-right">' . implode('', $listeMenusR) . '</div>'; ?>
            <!-- MAIN - MENUS - Background -->
            <?php
            set_query_var('section', 'menus');
            set_query_var('icons', array('camion', 'confiture'));
            echo get_template_part('templates/background'); ?>
        </section>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
