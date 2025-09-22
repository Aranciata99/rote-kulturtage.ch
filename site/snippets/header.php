<a>
    <div class="programmHeader" id="programmInbutton">
        <p><?= page('programm')?->title()->upper() ?></p>
    </div>
</a>

<a>
    <div class="aboutHeader" id="aboutInbutton">
        <p><?= page('about')?->title()->upper() ?></p>
    </div>
</a>

<a>
    <div class="contactHeader" id="contactInButton">
        <p><?= page('contact')?->title()->upper() ?></p>
    </div>
</a>

<a href="<?= $pages = $site->find('crowdfunding') ?>">
    <div class="crowdFoundingHeader">
        <p><?= page('crowdfunding')?->title()->upper() ?></p>
    </div>
</a>