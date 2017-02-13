<?php
/**
 * Elements du menu
 */
$id = $post->ID;
$type = wp_get_post_terms($id, 'type', array("fields" => "slugs")); // Formule ?
$type = (is_array($type) && isset($type[0])) ? $type[0] : ''; // Véirfie si il y a une valeur
$price = get_field('prix', $id); // Prix
?>
<!-- Nouvel élément -->
<li>
    <!-- Titre -->
    <h1><?php echo get_the_title() ?></h1>

    <!-- Description -->
    <p><?php echo get_the_content() ?></p>

    <!-- Prix -->
    <?php if ($price): ?>
        <small><?php echo $price ?>€</small>
    <?php endif; ?>

    <!-- Formules -->
    <?php if ($type == 'formule'):
        $price_boisson = get_field('prix_boisson', $id);
        $price_dessert = get_field('prix_dessert', $id);
        ?>

        <!-- Prix avec dessert -->
        <?php if ($price_dessert): ?>
            <small><?php echo $price_dessert ?>€</small>
        <?php endif; ?>
        <!-- Prix avec boisson -->
        <?php if ($price_boisson): ?>
            <small><?php echo $price_boisson ?>€</small>
        <?php endif; ?>

    <?php endif; ?>
</li>