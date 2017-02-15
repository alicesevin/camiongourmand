<?php
/*
Template Name: Sous page
*/
get_header();
the_post();
global $restau;
$post_type = (get_the_ID() == $restau) ? 'restaurant' : 'camion';
?>
<main id="<?php echo $post_type ?>" class="main main-<?php echo $post_type ?>">
    <?php set_query_var('post_type', $post_type);
    echo get_template_part('templates/cover'); ?>
    <section class="section">
        <h1 class="section__title"><?php echo get_the_title() ?></h1>
        <p class="section__description"><?php echo get_the_content() ?></p>
    </section>
    <?php $listes = get_terms(array(
        'taxonomy' => 'liste',
        'hide_empty' => true,
    ));
    if (count($listes) > 0):
        $index = 0;
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
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'liste',
                            'field' => 'name',
                            'terms' => $liste,
                        ),
                    )
                );
                $menus = new WP_Query($args);
                if ($index == $midsize): ?>
            </div>
            <div class="section__column section__column-right">
                <?php endif;
                if ($menus->have_posts()):?>
                    <div class="section__detail">
                        <h1 class="section__detailTitle"><?php echo $liste ?></h1>
                        <ul class="section__detailContainer">
                            <?php while ($menus->have_posts()):$menus->the_post(); ?>
                                <?php echo get_template_part('templates/menu'); ?>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                <?php endif;
                $index++;
                endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
