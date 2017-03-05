<?php
/**
 * Background
 */
$section = get_query_var('section');
$icons = get_query_var('icons');
if (count($icons) > 0):?>
    <div class="section__bg section__bg-<?php echo $section ?>">
        <?php if (count($icons) > 1):
            foreach ($icons as $icon):?>
                <i class="section__bgIcon icon-<?php echo $icon ?>"></i>
            <?php endforeach;
        else : ?>
            <i class="section__bgIcon icon-<?php echo $icons ?>"></i>
        <?php endif; ?>
    </div>
<?php endif; ?>
