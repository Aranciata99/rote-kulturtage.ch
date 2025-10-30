<?php if ($page = $site->find('festivalpass')): ?>
    <a href="<?= $page->url($kirby->language()->code()) ?>" style="font-style: normal;">
        <div class="crowdfoundingSticker">
            <h2>★★★<br>
                <?= page('festivalpass')?->sticker() ?><br>
                ★★★</h2>
            </h2>
        </div>
    </a>
<?php endif ?>