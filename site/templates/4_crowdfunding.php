<?php snippet('layout', slots: true) ?>

<?php slot('head') ?>
<!-- additional Header Elements here -->
<?php endslot() ?>

<?php slot() ?>

<!-- Umleitung -->
<?php go('/home') ?>

<?php snippet('crowdfoundingPage') ?>
<?php snippet('header') ?>
<?php snippet('footer') ?>
<?php snippet('backgroundHome') ?>


<?php endslot() ?>

<?php slot('scripts') ?>

<script src="<?= url('assets/scripts/crowdfoundingOpen.js') ?>"></script>
<script src="<?= url('assets/scripts/crowdfounding.js') ?>"></script>

<?php endslot() ?>

<?php endsnippet() ?>