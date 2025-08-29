<?php if ($programmPunkte = $site->programmPunkte()->toStructure()): ?>
    <?php foreach ($programmPunkte as $punkt): ?>
        <div class="programmPunkt">
            <?php if ($bild = $punkt->bild()->toFile()): ?>
                <div class="programmCoverImage">
                    <img src="<?= $bild->url() ?>" alt="RKT Event Cover Picture for <?= $punkt->title()->esc() ?>">
                </div>
            <?php endif ?>
            <h2><?= $punkt->title() ?></h2>
            <h3><?= $punkt->time() ?></h3>
            <h3><?= $punkt->location() ?></h3>
            <button>INFO</button>
        </div>
    <?php endforeach ?>
<?php endif ?>
