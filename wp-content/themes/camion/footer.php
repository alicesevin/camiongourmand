<?php
global $facebook;
global $instagram;
global $takeit;
?>
<div class="mosaic">

</div>
<footer class="footer">

    <div class="footer__container">
        <h1 class="footer__title">Nous suivre</h1>

        <?php if ($facebook || $instagram): ?>
            <div class="footer__sociaux">
                <ul class="footer__sociauxLinks">
                    <?php if ($facebook): ?>
                        <li><a class="icon__sociaux icon-facebook" href="<?php echo $facebook?>">Facebook</a></li>
                    <?php endif;
                    if ($instagram): ?>
                        <li><a class="icon__sociaux icon-instagram" href="<?php echo $instagram?>">Instagram</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif;
        if ($takeit): ?>
            <div class="footer__order">
                <p class="footer__orderDescription">Passez commande sur :</p>
                <a class="footer__orderLink" href="<?php echo $takeit?>">Take eat easy</a>
            </div>
        <?php endif; ?>
    </div>

</footer>

</div>
<?php wp_footer(); ?>
</body>
</html>
