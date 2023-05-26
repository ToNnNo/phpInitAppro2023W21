<?php require_once dirname(__DIR__, 2).'/functions/session.php'; ?>
<!doctype html>
<html>
    <head>
        <title>Administration</title>
        <meta charset="utf-8" />
        <style>
            .text-center { text-align: center }
            .text-right { text-align: right }
            form > div { margin-bottom: 1rem }
        </style>
    </head>
    <body>
        <header>
            <h1>Administration Dawan Bibliothèque</h1>
        </header>
        <?php if( isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
            <div class="text-right">
                <span>Bonjour <?php echo $_SESSION['user']['name']; ?></span> - 
                <a href="deconnexion.php">Déconnexion</a>
            </div>
        <?php endif; ?>
        <nav>
            <a href="./">Dashboard</a>
            <a href="./livres.php">Liste des livres</a>
        </nav>
        <main>
            <?php foreach(getFlashes('success') as $message): ?>
                <p><b>Success: </b><?php echo $message; ?></p>
            <?php endforeach; ?>