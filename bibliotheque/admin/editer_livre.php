<?php
require_once dirname(__DIR__).'/secure/adminGuardAuthenticator.php';
require_once dirname(__DIR__).'/functions/form.php';
require_once dirname(__DIR__).'/functions/sql.php';
require_once dirname(__DIR__).'/functions/session.php';
require_once dirname(__DIR__).'/functions/response.php';
require_once dirname(__DIR__).'/functions/request.php';
require_once dirname(__DIR__).'/functions/render.php';

// récupérer livre à éditer
$id = query('livre');
$sql = "select titre, parution, resume from livre where id = ?";
$datas = find($sql, [$id]);

if(!$datas) {
    render_404();
}

// récupérer et valider les nouvelles valeurs du livre
if(isset($_POST) && !empty($_POST)) {
    $datas = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    if( null == $datas['titre'] ) {
        $errors['titre'][] = "Ce champs est obligatoire";
    }

    if( null == $datas['parution'] ) {
        $errors['parution'][] = "Ce champs est obligatoire";
    }

    if(empty($errors)) { 

        // mettre à jour les données
        $sql = "update livre set titre=?, parution=?, resume=? where id=?";
        
        // pour remettre les valeurs dans le bon ordre !
        $params = [$datas['titre'], $datas['parution'], $datas['resume'], $id];
        execute($sql, $params);

        addFlash('success', 'Le livre a bien été modifié');
    }
}

require './inc/header.php';
// afficher formulaire
?>

<h2>Editer un livre</h2>

<p>
    <a href="livres.php">Revenir à la liste</a>
</p>

<form method="post" action="">
    <div>
        <label for="titre">Titre:</label>
        <input type="text" id="titre" name="titre" value="<?php echo getValue('titre', $datas) ?>" />
        <?php echo getErrors('titre', $errors); ?>
    </div>
    <div>
        <label for="parution">Parution:</label>
        <input type="date" id="parution" name="parution" value="<?php echo getValue('parution', $datas) ?>" />
        <?php echo getErrors('parution', $errors); ?>
    </div>
    <div>
        <label for="resume">Résumé:</label><br />
        <textarea id="resume" name="resume" style="width: 20rem; height: 5rem"><?php echo getValue('resume', $datas) ?></textarea>
        <?php echo getErrors('resume', $errors); ?>
    </div>
    <div>
        <button type="submit">Modifier</button>
    </div>
</form>

<?php require './inc/footer.php'; ?>