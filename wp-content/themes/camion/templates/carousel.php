<?php
/**
 * Carousel
 **/
$images = get_field('images_carousel');
if ($images && count($images) > 0):
    $indexCarousel = 0; ?>
    <section class="section section-carousel" role="region">
        <div class="carousel" role="group" aria-label="image container">
            <div class="carousel__container" role="slider">
                <?php foreach ($images as $image) :
                    $classImg = '';
                    if ($indexCarousel == 0) {
                        $classImg = " carousel__containerImg-active";
                    } else if (count($images) > 1 && $indexCarousel == 1) {
                        $classImg = " carousel__containerImg-next";
                    }
                    ?>
                    <div class="carousel__containerImg<?php echo $classImg; ?>">
                        <?php
                        $className = ($image['width'] <= $image['height']) ? 'vert' : 'horz'; ?>
                        <img role="img" aria-label="carousel image" class="<?php echo $className ?>" srcset="
                                    <?php echo $image['sizes']['thumbnail']; ?> 200w,
                                    <?php echo $image['sizes']['medium']; ?> 600w,
                                    <?php echo $image['sizes']['large']; ?> 1000w"
                             src="<?php echo $image['url']; ?>"
                             alt="<?php echo $image['name'] ?>">
                    </div>
                    <?php
                    $indexCarousel++;
                endforeach; ?>
            </div>
            <div class="carousel__nav" role="navigation">
                <div class="carousel__navContainer">
                    <a class="carousel__navArrow carousel__navArrow-left icon-arrow" href="#" role="menuitem" aria-label="navigation element in carousel previous" aria-controls="click"></a>
                    <a class="carousel__navArrow carousel__navArrow-right icon-arrow" href="#" role="menuitem" aria-label="navigation element in carousel  following" aria-controls="click"></a>
                </div>
            </div>
        </div>
    </section>
<?php endif;