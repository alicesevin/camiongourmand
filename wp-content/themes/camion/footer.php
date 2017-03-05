<?php
global $facebook;
global $instagram;
global $takeit;
?>
<!-- MOSAIC -->
<div class="mosaic"></div>
<!-- FOOTER -->
<footer class="footer">
    <div class="footer__container">
        <h1 class="footer__title">Nous suivre</h1>
        <!-- FOOTER - SOCIAUX -->
        <?php if ($facebook || $instagram): ?>
            <div class="footer__sociaux">
                <ul class="footer__sociauxLinks">
                    <?php if ($facebook): ?>
                        <li><a target="_blank" class="icon__sociaux icon-facebook" href="<?php echo $facebook?>"></a></li>
                    <?php endif;
                    if ($instagram): ?>
                        <li><a target="_blank" class="icon__sociaux icon-instagram" href="<?php echo $instagram?>"></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif;
        if ($takeit): ?>
            <!-- FOOTER - ORDER-->
            <div class="footer__order">
                <p class="footer__orderDescription">Passez commande sur :</p>
                <a target="_blank" class="footer__orderLink" href="<?php echo $takeit?>">Take eat easy</a>
            </div>
        <?php endif; ?>
        <!-- FOOTER - BACKGROUND -->
        <div class="footer__bg">
            <i class="footer__bgIcon icon-panier"></i>
            <i class="footer__bgIcon icon-pizza"></i>
            <i class="footer__bgIcon icon-poisson"></i>
        </div>
    </div>

</footer>

</div>
<?php wp_footer(); ?>
</body>
</html>
