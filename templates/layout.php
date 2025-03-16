<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $renderer->getMeta('title') ?></title>
    <link rel="stylesheet" href="/assets/styles/style.css">
    <link rel="icon" href="/assets/favicon.ico" type="image/x-icon">
</head>
<body>
<?php include('templates/header.php') ?>
<main>
<?= $renderer->getContent()?>
</main>
<?php include('templates/footer.php') ?>
</body>
</html>
