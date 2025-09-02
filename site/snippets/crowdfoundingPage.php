<div class="crowdFoundingContainer" id="programmScroller">
    <div class="crowdFoundingBackground" id="crowdFoundingBackground">
        <div class="closeFoundingContainer">
            <a href="<?= $pages = $site->find('home') ?>"><?php snippet('closeButton') ?></a>
        </div>
        <div class="crowdfoundingContainer">
            <h2>❤ Crowdfounding ❤</h2>
            <p style="text-align: center;">★★★</p>
            <p><?= $page->beschrieb()->kt() ?></p>
            <?php snippet('crowdfounding') ?>
        </div>
    </div>
</div>