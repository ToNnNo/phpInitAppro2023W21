<?php 
require('./functions/sql.php');
require('./functions/request.php');
require('./functions/render.php');

// récupérer le param d'url
$id = query('livre');

// requete
$livre = find('select titre, parution, resume from livre where id = ?', [$id]);

// test d'existance du livre 
if(!$livre) { 
    render_404();
}

$title = "Détail livre " . $livre['titre']; 

$locale = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE'])[0];

// change et récupère la valeur de la locale du serveur
/*locale_set_default('fr');
$locale = locale_get_default();*/

// fabrique un formateur de date
$fmt = datefmt_create($locale, IntlDateFormatter::FULL, IntlDateFormatter::NONE);

require './inc/header.php'; ?>

<h2>Détail du livre</h2>

<p>
    <a href="livres.php">Revenir à la liste des livres</a>
</p>

<dl>
    <dt>Titre</dt>
    <dd><?php echo $livre['titre']; ?></dd>
    <dt>Parution</dt>
    <dd><?php echo datefmt_format($fmt, date_create($livre['parution'])); ?></dd>
    <dt>Résumé</dt>
    <dd><?php echo $livre['resume']; ?></dd>
</dl>

<?php require './inc/footer.php'; ?>