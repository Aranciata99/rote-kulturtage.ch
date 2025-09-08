<?php if ($programm = $site->programm()->toStructure()): ?>
    <?php foreach ($programm as $tag): ?>
        <div class="programmDatum">
            <h3><?= $tag->datum()->toDate('d.m') ?></h3>
        </div>
        <div class="programmTag">
            <?php if ($punkte = $tag->punkte()->toStructure()): ?>
                <?php foreach ($punkte as $punkt): ?>
                    <div class="programmPunkt">
                        <?php if ($bild = $punkt->bild()->toFile()): ?>
                            <div class="programmCoverImage">
                                <img src="<?= $bild->url() ?>" alt="RKT Event Cover Picture for <?= $punkt->title()->esc() ?>">
                            </div>
                        <?php endif ?>
                        <h2><?= $punkt->title() ?></h2>
                        <h3><?= $punkt->time() ?></h3>
                        <h3><?= $punkt->location() ?></h3>
                        <?php if ($punkt->details()->isNotEmpty()): ?>
                            <button>INFO</button>
                            <div class="programmInfoContainer">
                                <div class="programmInfoText"><small><?= $punkt->title() ?></small>
                                    <p><?= $punkt->details()->kt() ?></p>
                                </div>
                                <div class="closeProgrammInfo">
                                    <h3>×</h3>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                <?php endforeach ?>
            <?php endif ?>

        </div>
    <?php endforeach ?>
<?php endif ?>