<?php
/*
Template Name: Sous page
*/
get_header();
the_post();
global $restau;
$post_type = (get_the_ID() == $restau) ? 'restaurant' : 'camion';
?>
<div>
    <main>
        <h1><?php echo get_the_title() ?></h1>
        <p><?php echo get_the_content() ?></p>
        <?php
        $listes = get_terms(array(
            'taxonomy' => 'liste',
            'hide_empty' => true,
        ));
        if (count($listes) > 0):
            foreach ($listes as $liste):
                $liste = $liste->name;
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
                if ($menus->have_posts()):?>
                    <div>
                        <h1><?php echo $liste ?></h1>
                        <ul>
                            <?php while ($menus->have_posts()):$menus->the_post(); ?>
                                <?php echo get_template_part('templates/menu'); ?>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                <?php endif;
            endforeach;
        endif; ?>
    </main>
</div>
<?php get_footer(); ?>
