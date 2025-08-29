<div class="aboutContainer" id="aboutScroller">
    <div class="closeAboutContainer" id="closeAboutScroller">
        <?php snippet('closeButton') ?>
    </div>
    <div class="aboutNavi">
        <a id="aboutInfoButton"><div>
            <small><?= $site->aboutInfoTitle() ?></small>
        </div></a>
        <a id="aboutFinanzButton"><div>
            <small><?= $site->aboutFinanzTitle() ?></small>
        </div></a>
        <a id="aboutMotivationButton"><div>
            <small><?= $site->aboutMotivationTitle() ?></small>
        </div></a>
        <a id="aboutAwareButton"><div>
            <small><?= $site->aboutAwareTitle() ?></small>
        </div></a>
    </div>
    <div class="aboutContentContainer">
        <div class="aboutInfo" id="aboutInfo">
            <h2><?= $site->aboutInfoTitle() ?></h2>
            <p><?= $site->aboutInfoText()->kt() ?></p>
        </div>
        <div class="aboutFinanz" id="aboutFinanz">
            <h2><?= $site->aboutFinanzTitle() ?></h2>
            <p><?= $site->aboutFinanzText()->kt() ?></p>
        </div>
        <div class="aboutMotivation" id="aboutMotivation">
            <h2><?= $site->aboutMotivationTitle() ?></h2>
            <p><?= $site->aboutMotivationText()->kt() ?></p>
        </div>
        <div class="aboutAware" id="aboutAware">
            <h2><?= $site->aboutAwareTitle() ?></h2>
            <p><?= $site->aboutAwareText()->kt() ?></p>
        </div>
    </div>

</div>