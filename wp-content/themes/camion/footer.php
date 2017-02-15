<?php
global $facebook;
global $instagram;
?>
<div class="mosaic">

</div>
<footer class="footer">

    <div class="footer__container">
        <h1 class="footer__title">Nous suivre</h1>

        <?php if ($facebook || $instagram): ?>
            <div class="footer__sociaux">
                <ul class="footer__sociauxLinks">
                    <li><a class="icon__sociaux icon-facebook" href="#">Facebook</a></li>
                    <li><a class="icon__sociaux icon-instagram" href="#">Instagram</a></li>
                </ul>
            </div>
        <?php endif; ?>

        <div class="footer__order">
            <p class="footer__orderDescription">Passez commande sur :</p>
            <a class="footer__orderLink">Take eat easy</a>
        </div>
    </div>

</footer>

</div>
<?php wp_footer(); ?>
</body>
</html>
