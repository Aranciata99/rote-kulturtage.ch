<?php snippet('layout', slots: true) ?>

<?php slot('head') ?>
<!-- additional Header Elements here -->
<?php endslot() ?>

<?php slot() ?>

<?php snippet('header') ?>
<?php snippet('footer') ?>
<?php go('/home') ?>

<?php endslot() ?>

<?php slot('scripts') ?>

<?php endslot() ?>

<?php endsnippet() ?>