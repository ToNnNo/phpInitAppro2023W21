<?php 
http_response_code(404);

$title = "Not Found";

require './inc/header.php'; ?>

<h2>404 - Not Found</h2>

<p>Cette page n'existe pas</p>

<p>
    Revenir à la page d'<a href="./">accueil</a>
</p>

<?php require './inc/footer.php'; ?>