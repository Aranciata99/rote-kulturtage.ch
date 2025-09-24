<div class="crowdFoundingContainer" id="programmScroller">
    <div class="crowdFoundingBackground" id="crowdFoundingBackground">
        <div class="crowdFoundingCampagne" id="foundingCampagneContainer">
            <?php snippet('crowdfounding') ?>
        </div>
        <div class="crowdFoundingText">
            <div class="closeFoundingContainer" id="TopDiv">
                <a href="<?= $pages = $site->find('home') ?>"><?php snippet('closeButton') ?></a>
            </div>
            <h2><?= page('crowdfunding')?->title() ?> <br><span class="helvetica">♥ ♥ ♥ ♥ ♥</span></h2>
            <p><?= $page->beschrieb()->kt() ?></p> <br>
            <button id="goto-top" title="Go to top">Jetzt spenden</button>
        </div>
        <div class="crowdFoundingVideo">

        </div>
    </div>
</div>