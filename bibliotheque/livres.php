<?php 
require './functions/sql.php';

$title = "Nos livres"; 

$livres = findAll("select id, titre from livre");

require './inc/header.php'; 
?>

<h2>Nos Livres</h2>

<ul>
<?php foreach($livres as $livre): ?>
    <li>
        <a href="livre_detail.php?livre=<?php echo $livre['id']; ?>">
            <?php echo $livre['titre']; ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>

<?php require './inc/footer.php'; ?>