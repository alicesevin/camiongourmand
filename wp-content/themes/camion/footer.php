<?php
global $facebook;
global $instagram;
global $takeit;
?>
<!-- MOSAIC -->
<div class="mosaic"></div>
<!-- FOOTER -->
<footer class="footer" role="contentinfo" aria-label="footer section">
    <div class="footer__container">
        <h1 class="footer__title" role="presentation">Nous suivre</h1>
        <!-- FOOTER - SOCIAUX -->
        <?php if ($facebook || $instagram): ?>
            <div class="footer__sociaux" role="group">
                <ul class="footer__sociauxLinks" role="list" aria-label="social link">
                    <?php if ($facebook): ?>
                        <li><a target="_blank" class="icon__sociaux icon-facebook" aria-label="faceook icon"
                               href="<?php echo $facebook ?>"></a>
                        </li>
                    <?php endif;
                    if ($instagram): ?>
                        <li><a target="_blank" class="icon__sociaux icon-instagram" aria-label="instagram icon"
                               href="<?php echo $instagram ?>"></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- FOOTER - NEWSLETTER-->
            <div class="footer__newsletter" role="group">
                <p class="footer__description" role="presentation">Recevoir notre newsletter</p>
                <form class="footer__form" action="post" role="form">
                    <div class="footer__formContainer" role="group">
                        <input required class="footer__formInput footer__formInput-email" type="email" role="textbox"
                               aria-required="true" aria-label="email input" placeholder="Adresse Mail"/>
                        <input class="footer__formInput footer__formInput-submit" type="submit" role="textbox"
                               aria-label="validation button    " value="V">
                    </div>
                </form>
            </div>
        <?php endif;
        if ($takeit): ?>
            <!-- FOOTER - ORDER-->
            <div class="footer__order" role="group">
                <p class="footer__description" role="definition">Passez commande sur :</p>
                <a target="_blank" class="footer__orderLink" role="link" aria-controls="click"
                   href="<?php echo $takeit ?>">Take eat easy</a>
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
