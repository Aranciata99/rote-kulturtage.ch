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
            <p><?= page('about')?->aboutAwareText()->kt() ?></p>
        </div>
    </div>

</div>