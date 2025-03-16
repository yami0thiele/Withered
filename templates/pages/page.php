<?php
  global $config;
  global $page;
?>
<h1 class="post_title"><?= $page->getMeta("title") ?></h1>
<div class="post_date"><?= $page->getMeta("date") ?></div>
<div class="post_content">
  <?= $page->getContent() ?>
</div>
