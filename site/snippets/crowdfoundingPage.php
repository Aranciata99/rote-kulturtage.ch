<?php
if ($kirby->language()->code() == 'de') {
    $buttonText = 'Jetzt spenden';
} else {
    $buttonText = 'Donate now';
}
?>
<div class="crowdFoundingContainer" id="programmScroller">
    <div class="crowdFoundingBackground" id="crowdFoundingBackground">
        <div class="crowdFoundingCampagne" id="foundingCampagneContainer">
            <?php snippet('crowdfounding') ?>
        </div>
        <div class="crowdFoundingText" style="background-color: rgb(230, 48, 27);">
            <div class="closeFoundingContainer" id="TopDiv">
                <a href="<?= $pages = $site ?>"><?php snippet('closeButton') ?></a>
            </div>
            <h2><?= page('festivalpass')?->title() ?> <br><span class="helvetica">★ ★ ★ ★ ★</span></h2>
            <p><?= $page->beschrieb()->kt() ?></p> <br>
            <!-- <button id="goto-top" title="Go to top"><?= $buttonText ?></button> -->
        </div>
        <!-- <div class="crowdFoundingVideo">

        </div>-->
    </div>
</div>