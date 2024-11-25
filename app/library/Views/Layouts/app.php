<?php

use App\Views\Layouts\AppLayout;

/** @var AppLayout $this */

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tic-tac-toe</title>

    <link href="/www/bootstrap.min.css" rel="stylesheet">
    <link href="/www/style.css" rel="stylesheet">

    <script src="/www/jquery-3.7.1.min.js"></script>
    <script src="/www/script.js"></script>
</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <?php /** @see \App\Controllers\IndexController::indexAction() */ ?>
                <a class="navbar-brand" href="/">Play</a>
                <?php /** @see \App\Controllers\IndexController::indexAction() */ ?>
                <a class="navbar-brand" href="/leaderboard">Leaderboard</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if ($this->view->getTitle()) { ?>
            <h1><?= htmlspecialchars($this->view->getTitle()) ?></h1>
        <?php } else { ?>
            <br/>
        <?php } ?>
        <?php $this->view->render(); ?>
    </div>

</body>
</html>