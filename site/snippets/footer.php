<div class="footer" id="footer">
    <div class="footerLeft">
        <a href="https://www.instagram.com/rote_kulturtage/" target="_blank">
            <p>
                INSTA
            </p>
        </a>
    </div>
    <div class="logoRKTfooter">
        <a href="<?= $site->url() ?>"><img src="assets/img/rktlogo.png" alt="Logo Rote Kulturtage"></a>
    </div>
    <div class="footerRight">
        <?php
        $current = $kirby->language()->code();
        $other = $current === 'en' ? 'de' : 'en';
        $otherUrl = $page->url($other);
        ?>
        <a href="<?= $otherUrl ?>">
            <p><?= strtoupper($other) ?></p>
        </a>
    </div>

</div>