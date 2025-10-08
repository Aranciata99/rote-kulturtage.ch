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

<?php if ($crowd = $site->find('crowdfunding')): ?>
  <a href="<?= $crowd->url($kirby->language()->code()) ?>">
    <div class="crowdFoundingHeader">
      <p><?= $crowd->title()->upper() ?></p>
    </div>
  </a>
<?php endif ?>
