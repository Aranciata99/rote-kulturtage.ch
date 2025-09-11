<div class="aboutContainer" id="aboutScroller">
    <div class="closeAboutContainer" id="closeAboutScroller">
        <?php snippet('closeButton') ?>
    </div>
    <div class="aboutNavi">
        <a id="aboutInfoButton"><div>
            <small><?= page('about')?->aboutInfoTitle()?->esc() ?></small>
        </div></a>
        <a id="aboutFinanzButton"><div>
            <small><?= page('about')?->aboutFinanzTitle() ?></small>
        </div></a>
        <a id="aboutMotivationButton"><div>
            <small><?= page('about')?->aboutMotivationTitle() ?></small>
        </div></a>
        <a id="aboutAwareButton"><div>
            <small><?= page('about')?->aboutAwareTitle() ?></small>
        </div></a>
    </div>
    <div class="aboutContentContainer">
        <div class="aboutInfo" id="aboutInfo">
            <h2><?= page('about')?->aboutInfoTitle() ?></h2>
            <span class="redText"><p class="aboutInfoAllgemein"><?= page('about')?->aboutInfoAllgemein()->kt() ?></p></span>
            <p><?= page('about')?->aboutInfoText()->kt() ?></p>
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