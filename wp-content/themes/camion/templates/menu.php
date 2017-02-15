<?php
/**
 * Detail element du menu
 **/
$id = $post->ID;
$type = wp_get_post_terms($id, 'type', array("fields" => "slugs")); // Formule ?
$type = (is_array($type) && isset($type[0])) ? $type[0] : ''; // Véirfie si il y a une valeur
$price = get_field('prix', $id); // Prix
?>
<!-- Nouvel élément -->
<li class="menus__item">
    <div class="menus__itemLine">
        <!-- Titre -->
        <strong class="menus__itemTitle"><?php echo get_the_title() ?></strong>
        <!-- Prix -->
        <?php if ($price): ?>
            <p class="menus__itemPrice"><?php echo $price ?>€</p>
        <?php endif; ?>
    </div>
    <!-- Description -->
    <p class="menus__itemDescription"><?php echo get_the_content() ?></p>

    <!-- Formules -->
    <?php if ($type == 'formule'):
        $price_boisson = get_field('prix_boisson', $id);
        $price_dessert = get_field('prix_dessert', $id);
        if ($price_dessert): ?>

            <!-- Prix avec dessert -->
            <div class="menus__itemLine">
                <p class="menus__itemIntitule">Avec dessert</p>
                <p class="menus__itemPrice menus__itemPrice--small"><?php echo $price_dessert ?>€</p>
            </div>
        <?php endif;
        if ($price_boisson): ?>

            <!-- Prix avec boisson -->
            <div class="menus__itemLine">
                <p class="menus__itemIntitule">Avec boisson</p>
                <p class="menus__itemPrice menus__itemPrice--small"><?php echo $price_boisson ?>€</p>
            </div>
        <?php endif;
    endif; ?>
</li>