<?php snippet('layout', slots: true) ?>

<?php slot('head') ?>
<!-- additional Header Elements here -->
<?php endslot() ?>

<?php slot() ?>

<?php snippet('header') ?>
<?php snippet('footer') ?>
<?php snippet('programmPage') ?>
<?php snippet('aboutPage') ?>
<?php snippet('contactPage') ?>
<?php snippet('backgroundHome') ?>

<?php endslot() ?>

<?php slot('scripts') ?>
<script src="assets/scripts/home.js"></script>
<script src="assets/scripts/fadePagesScript.js"></script>
<script src="assets/scripts/programmDetails.js"></script>
<script src="assets/scripts/scrollTo.js"></script>

<?php endslot() ?>

<?php endsnippet() ?>