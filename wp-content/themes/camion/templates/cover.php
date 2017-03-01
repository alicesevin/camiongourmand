<?php
$post_type = ($post_type) ? get_query_var('post_type') : '';
$subtitle = get_field('subtitle');
$place = ($post_type == 'camion') ? 'Le camion' : 'Père & fils';
$bg_home = wp_get_attachment_image_src(get_post_thumbnail_id(get_option('page_on_front')), 'large');
$bg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
?>
<section class="cover">
    <?php if ($post_type): ?>
        <div class="cover__container" <?php if ($bg) echo 'style="background-image:url(' . $bg[0] . ');"' ?>>
            <h1 class="cover__title"><?php echo $place . ' ' ?>
                <span class="cover__subtitle"><?php echo $subtitle ?></span>
                <i class="cover__icon icon__food-pasta"></i>
            </h1>
            <a href="#" class="cover__nav">
                <i class="cover__navIcon icon__arrow-bottom"></i>
            </a>
        </div>
    <?php else:
        $pages = new WP_Query(array('post_type' => array('page')));
        if ($pages->have_posts()):
            foreach ($pages->posts as $page):
                $icon = explode('-', $page->post_name);
                $icon = (isset($icon[1]) && ($icon[1] == 'camion' || $icon[1] == 'restaurant')) ? $icon[1] : '';
                $place = ($icon == 'camion') ? 'Le camion gourmand' : 'Père & fils';
                $way = ($icon == 'camion') ? 'left' : 'right';
                $bg = wp_get_attachment_image_src(get_post_thumbnail_id($page->ID), 'large');
                if ($icon):
                    ?>
                    <div class="cover__container cover__container-tryptique" <?php if ($bg) echo 'style="background-image:url(' . $bg[0] . ');"' ?>>
                        <a href="<?php echo get_the_permalink($page->ID) ?>" class="cover__nav">
                            <h1 class="cover__title">
                                <?php echo $place ?>
                                <i class="cover__icon icon__<?php echo $icon ?>"></i>
                            </h1>
                            <i class="cover__navIcon icon__arrow-<?php echo $way ?>"></i>
                        </a>
                    </div>
                    <?php
                endif;
                if ($page == $pages->posts[0]):?>
                    <div class="cover__container cover__container-tryptique" <?php if ($bg_home) echo 'style="background-image:url(' . $bg_home[0] . ');"' ?>>
                        <a href="<?php get_the_permalink(get_option('page_on_front')) ?>" class="cover__nav">
                            <h1 class="cover__title">
                                L'univers
                                <i class="cover__icon icon__home"></i>
                            </h1>
                            <i class="cover__navIcon icon__arrow-bottom"></i>
                        </a>
                    </div>
                <?php endif;
            endforeach; ?>
        <?php endif;
        wp_reset_postdata();
    endif; ?>
    <div class="mosaic">

    </div>
</section>