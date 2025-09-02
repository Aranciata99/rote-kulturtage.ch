<?php snippet('layout', slots: true) ?>

<?php slot('head') ?>
<!-- additional Header Elements here -->
<?php endslot() ?>

<?php slot() ?>

<?php snippet('crowdfoundingPage') ?>
<?php snippet('header') ?>
<?php snippet('footer') ?>


<?php endslot() ?>

<?php slot('scripts') ?>

<script src="assets/scripts/crowdfounding.js"></script>

<?php endslot() ?>

<?php endsnippet() ?>