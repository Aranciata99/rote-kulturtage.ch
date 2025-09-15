<?php foreach (page('programm')?->children() as $programmtag): ?>
    <div class="programmDatum">
        <h3><?= $programmtag->title() ?></h3>
    </div>
    <div class="programmTag">
        <?php foreach ($programmtag->children() as $punkt): ?>
            <?php $tags = explode(',', $punkt->tags()->lower());
            $tagClasses = implode(' ', array_map('trim', $tags)); ?>
            <div class="programmPunkt <?= $tagClasses ?>">
                <?php if ($punkt->files()->isNotEmpty()): ?>
                    <?php foreach ($punkt->files()->sortBy('first') as $bild): ?>
                        <?php if ($bild->isNotEmpty()): ?>
                            <div class="programmCoverImage">
                                <img src="<?= $bild->url() ?>" draggable="false" loading="lazy" alt="RKT Event Cover Picture for <?= $punkt->title()->esc() ?>">
                            </div>
                        <?php else: ?>
                            <div class="programmCoverImagePlaceholder"></div>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php else: ?>
                    <?php $r = rand(10, 100);
                    $g = rand(10, 20);
                    $b = rand(10, 100);
                    $color = sprintf("#%02x%02x%02x", $r, $g, $b); ?>
                    <div class="programmCoverImagePlaceholder" style="background-color: <?php echo $color; ?>; height: <?php echo $g; ?>rem"></div>
                <?php endif ?>
                <h2><?= $punkt->title() ?></h2>
                <h3><?= $punkt->von()->toDate('H:i') ?>–<?= $punkt->bis()->toDate('H:i') ?> <br>
                    <?php if ($punkt->locationLink()->isNotEmpty()): ?>
                        <a href="<?= $punkt->locationLink() ?>" target="_blank">
                            <?php endif ?><?= $punkt->location() ?></a>
                </h3>
                <?php if ($punkt->copyright()->isNotEmpty()): ?><div class="bildCopyright">↑ Photo © <?= $punkt->copyright() ?></div><?php endif ?>
                <?php if ($punkt->details()->isNotEmpty() || $punkt->veranstaltungsDetails()->isNotEmpty()): ?>
                    <button>INFO</button>
                    <div class="programmInfoContainer">
                        <div class="programmInfoText"><span class="smallText"><?= $punkt->veranstaltungsDetails()->kt() ?></span>
                            <p><?= $punkt->details()->kt() ?></p>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        <?php endforeach ?>
    </div>
<?php endforeach ?>