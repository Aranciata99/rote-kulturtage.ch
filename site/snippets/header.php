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

<!-- <?php if ($page = $site->find('crowdfunding')): ?>
  <a href="<?= $page->url($kirby->language()->code()) ?>">
    <div class="crowdFoundingHeader">
      <p><?= $site->find('crowdfunding')->title()->upper() ?></p>
    </div>
  </a>
<?php endif ?> -->