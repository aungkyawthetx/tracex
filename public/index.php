<?php

  include __DIR__ . '/../src/helpers/url.php';
  require_once __DIR__ . '/../src/helpers/isLoggedIn.php';
  $title = "Home - MySpend";

  ob_start();
  include __DIR__ . '/../views/home/welcome-text-and-cards.php';
  include __DIR__ . '/../views/home/charts.php';
  include __DIR__ . '/../views/home/transactions-and-progress.php';

  $content = ob_get_clean();
  include __DIR__ . '/../views/components/layout.php';

?>