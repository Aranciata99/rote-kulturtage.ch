<div class="aboutContainer" id="aboutScroller">
    <div class="closeAboutContainer" id="closeAboutScroller">
        <?php snippet('closeButton') ?>
    </div>
    <div class="aboutNavi">
        <a id="aboutInfoButton">
            <div>
                <small><?= page('about')?->aboutInfoTitle()?->esc() ?></small>
            </div>
        </a>
        <a id="aboutFinanzButton">
            <div>
                <small><?= page('about')?->aboutFinanzTitle() ?></small>
            </div>
        </a>
        <a id="aboutMotivationButton">
            <div>
                <small><?= page('about')?->aboutMotivationTitle() ?></small>
            </div>
        </a>
        <a id="aboutAwareButton">
            <div>
                <small><?= page('about')?->aboutAwareTitle() ?></small>
            </div>
        </a>
    </div>
    <div class="aboutContentContainer">
        <div class="aboutInfo" id="aboutInfo">
            <h2><?= page('about')?->aboutInfoTitle() ?></h2>
            <span class="redText">
                <p class="aboutInfoAllgemein"><?= page('about')?->aboutInfoAllgemein()->kt() ?></p>
            </span>
            <p><?= page('about')?->aboutInfoText()->kt() ?></p>
            <p><?= page('about')?->orgaLogos() ?>:</p>
            <div class="infoLogoContainer">
                <?php foreach (page('about')->logos()->toFiles()->sortBy('sort') as $logo): ?>
                    <img src="<?= $logo->url() ?>" draggable="false">
                <?php endforeach ?>
            </div>
            <p><?= page('about')?->mediaLogos() ?>:</p>
            <div class="infoLogoContainer">
                <?php foreach (page('about')->medienpartnerinnen()->toFiles()->sortBy('sort') as $partner): ?>
                    <img src="<?= $partner->url() ?>" draggable="false">
                <?php endforeach ?>
            </div>
            <?php if (page('about')->others()->isNotEmpty()): ?>
                <p><?= page('about')?->moreLogos() ?>:</p>
                <div class="infoLogoContainer">
                    <?php foreach (page('about')->others()->toFiles()->sortBy('sort') as $weitere): ?>
                        <img src="<?= $weitere->url() ?>" draggable="false">
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
        <div class="aboutFinanz" id="aboutFinanz">
            <h2><?= page('about')?->aboutFinanzTitle() ?></h2>
            <p><?= page('about')?->aboutFinanzText()->kt() ?></p>
        </div>
        <div class="aboutMotivation" id="aboutMotivation">
            <h2><?= page('about')?->aboutMotivationTitle() ?></h2>
            <p><?= page('about')?->aboutMotivationText()->kt() ?></p>
        </div>
        <div class="aboutAware" id="aboutAware">
            <h2><?= page('about')?->aboutAwareTitle() ?></h2>
            <p><?= page('about')?->aboutAwareText1()->kt() ?></p>
            <div class="aboutAwareIconListe">
                <div class="aboutAwareIconListeContainer">
                    <img src="assets/awareness/rollstuhl1_B.png" alt="awareness icon Barierefrei" draggable="false">
                    <small><?= page('about')?->rollstuhl1() ?></small>
                </div>
                <div class="aboutAwareIconListeContainer">
                    <img src="assets/awareness/rollstuhl2_B.png" alt="awareness icon Barierefrei auf Anfrage" draggable="false">
                    <small><?= page('about')?->rollstuhl2() ?></small>
                </div>
                <div class="aboutAwareIconListeContainer">
                    <img src="assets/awareness/licht_B.png" alt="awareness icon intensive Lichteinwirkung" draggable="false">
                    <small><?= page('about')?->licht() ?></small>
                </div>
                <div class="aboutAwareIconListeContainer">
                    <img src="assets/awareness/ton_B.png" alt="awareness icon intensive Toneinwirkung" draggable="false">
                    <small><?= page('about')?->ton() ?></small>
                </div>
                <div class="aboutAwareIconListeContainer">
                    <img src="assets/awareness/stuhl_B.png" alt="awareness icon begrenzte Sitzmöglichkeiten" draggable="false">
                    <small><?= page('about')?->stuhl() ?></small>
                </div>
                <div class="aboutAwareIconListeContainer">
                    <img src="assets/awareness/wc_B.png" alt="awareness icon wenig sanitäre anlagen" draggable="false">
                    <small><?= page('about')?->wc() ?></small>
                </div>
                </div>

                <p><?= page('about')?->aboutAwareText2()->kt() ?></p>
            </div>
        </div>

    </div>