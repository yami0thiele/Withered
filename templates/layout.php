<?php
  global $config;
  global $page;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page->getMeta('title') ?></title>
    <link rel="stylesheet" href="/assets/styles/style.css">
</head>
<body>
<?php include('templates/header.php') ?>
<main>
<?= $page->getContent() . PHP_EOL ?>
</main>
<?php include('templates/footer.php') ?>
</body>
</html>
