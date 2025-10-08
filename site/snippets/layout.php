<!DOCTYPE html>
<html lang="<?= $kirby->language()->code() ?>">

<head>
    <meta charset="UTF-8">
    <title><?= $page->title() ?></title>
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <?= css('assets/css/index.css') ?>
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="index,follow">
    <meta property="og:title" content="Rote Kultur Tage 2025">
    <meta property="og:description" content=" Während elf Tagen, werden wir in der Stadt Zürich ein Festival der Arbeiter:innenkultur feiern.">
    <meta property="og:type" content="Website">
    <meta property="og:url" content="https://rote-kulturtage.ch/">
    <meta property="og:site_name" content="rote-kulturtage">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?= $slots->head() ?>
</head>

<body>


    <?= $slot ?>


    <?= $slots->scripts() ?>

</body>

</html>