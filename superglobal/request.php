<?php
    function get($key, $default = null) {
        return array_key_exists($key, $_GET) ? 
            filter_var($_GET[$key], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : $default;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Les paramètres de requête</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>Les paramètres de requête (query params)</h1>
        <hr />

        <p>Exemple dans l'url: ?q=dawan&page=1&sort=asc&filter[name]=john&token=....</p>

        <?php // echo $_GET['page'] ?? '1'; ?>
        <p>Nous sommes sur la page <?php echo get('page', 1) ?></p>
        <ul>
            <li>
                <a href="request.php?page=1">Page 1</a>
            </li>
            <li>
                <a href="request.php?page=2">Page 2</a>
            </li>
        </ul>
    </body>
</html>