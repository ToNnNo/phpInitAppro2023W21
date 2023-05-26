<?php 
require dirname(__DIR__).'/secure/adminGuardAuthenticator.php';
require dirname(__DIR__).'/functions/sql.php';

$livres = findAll('select * from livre');

require './inc/header.php';
?>

<h2>Liste des livres</h2>

<p>
    <a href="ajouter_livre.php">Ajouter un livre</a>
</p>

<table style="width:100%">
<thead>
    <tr style="text-align: left">
        <th>ID</th>
        <th>Titre</th>
        <th>Parution</th>
        <th></th>
    </tr>
</thead>
<tbody>
<?php foreach($livres as $livre): ?>
    <tr>
        <td><?php echo $livre['id']; ?></td>
        <td><?php echo $livre['titre']; ?></td>
        <td><?php echo $livre['parution']; ?></td>
        <td style="text-align: right">
            <a href="editer_livre.php?livre=<?php echo $livre['id'] ?>">modifier</a> - 
            <a href="supprimer_livre.php?livre=<?php echo $livre['id'] ?>">supprimer</a>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php require './inc/footer.php' ?>