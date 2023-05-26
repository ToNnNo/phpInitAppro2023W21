<?php 
session_start();

require dirname(__DIR__) . '/functions/form.php';
require dirname(__DIR__) . '/functions/sql.php';
require dirname(__DIR__) . '/functions/response.php';

// if submit ?
if(isset($_POST) && !empty($_POST)) {
    // récupération des données + protection xss
    $datas = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    // test validité
    if( null == $datas['username'] ) {
        $errors['username'][] = "Ce champs est obligatoire";
    }

    if( null == $datas['password'] ) {
        $errors['password'][] = "Ce champs est obligatoire";
    }

    if(empty($errors)) {
        // authentification
        $user = find('select id, username, password, name from user where username = ?', [$datas['username']]);
        
        if(!$user) {
            $errors['authentication'][] = "Erreur d'authentification";
        } elseif(!password_verify($datas['password'], $user['password'])) {
            $errors['authentication'][] = "Erreur d'authentification";
        } else {
            // save user + redirection
            unset($user['password']);
            $_SESSION['user'] = $user;

            redirect('./');
        }
    }    
}

require './inc/header.php';
?>

<h2>Authentification</h2>

<?php echo getErrors('authentication', $errors) ?>
<form method="post" action="">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" 
            value="<?php echo getValue('username', $datas); ?>" />
        <?php echo getErrors('username', $errors); ?> 
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" /> 
        <?php echo getErrors('password', $errors); ?>
    </div>
    <div>
        <button type="submit">Se connecter</button>
    </div>
</form>

<?php require './inc/footer.php' ?>