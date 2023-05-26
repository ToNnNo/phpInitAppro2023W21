<?php
    session_start();
    define('FLASH', 'flash_message');
    define('SUCCESS_FLASH_MESSAGE', 'success_flash_message');

    function getValue($key, $datas) {
        // si la clé existe dans le tableau
        if( isset($datas[$key]) ) {
            return $datas[$key];
        }

        return '';
    }

    function getErrors($key, $formErrors) {
        // est ce que la clé existe dans le tableau ?
        // si la clé n'existe pas, alors il n'y a pas d'erreur
        if(!isset($formErrors[$key])) {
            return null;
        }

        $errors = $formErrors[$key];
        
        $message = "<ul>";
        foreach($errors as $error) {
            $message .= "<li>".$error."</li>";
        }
        $message .= "</ul>";

        return $message;
    }

    function formIsValid(array $datas) {
        $errors = [];

        // firstname n'est pas vide
        if( isset($datas['firstname']) && empty(trim($datas['firstname'])) ) {
            $errors['firstname'][] = 'Le prénom est obligatoire';
        }

        if( isset($datas['lastname']) && empty(trim($datas['lastname'])) ) {
            $errors['lastname'][] = 'Le nom est obligatoire';
        }

        if( isset($datas['email']) && empty(trim($datas['email'])) ) {
            $errors['email'][] = 'L\'adresse email est obligatoire';
        }

        if( !filter_var($datas['email'], FILTER_VALIDATE_EMAIL) ) {
            $errors['email'][] = 'L\'adresse email n\'est pas valide';
        }

        return $errors;
    }

    function fileValidator(array $file) {
        $errors = [];
        
        // https://www.php.net/manual/en/features.file-upload.errors.php
        $existingFileErrors = [
            1 => "Le poids de l'image est supérieur au poids autorisé",
            2 => "Le poids de l'image est supérieur au poids autorisé",
            3 => "Téléchargement incomplet",
            4 => "La photo est obligatoire"
        ];

        $mimes = [
            'image/png' => ['png'], 
            'image/jpeg' => ['jpg', 'jpeg']
        ];

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

        if( in_array($file['error'], array_keys($existingFileErrors) ) ) {
            $errors['picture'][] = $existingFileErrors[ $file['error'] ];
        }

        // Si le type du fichier ne se trouvent pas dans le tableau des mimes
        if( !in_array($file['type'], array_keys($mimes)) ) {
            $errors['picture'][] = "Ce type d'image n'est pas autorisé";

        // si mime existe alors vérification de la correspondance de l'extension
        }elseif( !in_array( $ext, $mimes[$file['type']] ) ) { 
            $errors['picture'][] = "Le type de fichier ne correspond pas au format attendu";
        }

        return $errors;
    }

    function getSuccessMessage(): void {
        if( empty($_SESSION[FLASH][SUCCESS_FLASH_MESSAGE]) ) {
            return; // Si le message n'existe pas, on met fin à la fonction
        }

        $message = $_SESSION[FLASH][SUCCESS_FLASH_MESSAGE];
        unset($_SESSION[FLASH][SUCCESS_FLASH_MESSAGE]);

        echo '<p><b>Success: </b>'.$message.'</p>';
    }
    
    $errors = [];
    $datas = [];
    if(!empty($_POST)) { // si le formulaire a été soumis

        // var_dump($_FILES);

        // 1 - récupération des données (nettoyage)
        $datas = filter_input_array(INPUT_POST, [
            'firstname' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
            ],
            'lastname' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
            ],
            'email' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
            ],
            'phone' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
            ],
        ]);

        // 2 - validation des données (vérifier les champs obligatoire, email correct)
        $errors = formIsValid($datas);
        $fileErrors = fileValidator($_FILES['picture']);

        $errors = array_merge($errors, $fileErrors);

        if( count($errors) == 0 ) {
            // 3 - formatage des données (mise en forme numéro de téléphone)
            $filename = pathinfo($_FILES['picture']['name'], PATHINFO_FILENAME);
            $fileextension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);

            $safeFilename = transliterator_transliterate(
                'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $filename);
            
            $filename = $safeFilename . time() . '.' . $fileextension;

            // 4 - traiter des données (insertion en base, envoie email, ecrire dans un fichier)    
            $root_dir = dirname(__DIR__);
            $images_dir = $root_dir . "/public/images";

            move_uploaded_file($_FILES['picture']['tmp_name'], $images_dir.DIRECTORY_SEPARATOR.$filename);
            
            $_SESSION[FLASH][SUCCESS_FLASH_MESSAGE] = "Enregistrement terminé";

            header('Location: form.php', true, 302);
            exit(); // met fin au script et renvoie la réponse
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Formulaire</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <h1>Formulaire</h1>
        <hr />
        
        <?php getSuccessMessage(); ?>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo 10**7; ?>" /><!-- 10Mo -->
            <div>
                <label for="firstname">Prénom:</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo getValue('firstname', $datas); ?>" />
                <?php echo getErrors('firstname', $errors); ?>
            </div>
            <div>
                <label for="lastname">Nom:</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo getValue('lastname', $datas); ?>" />
                <?php echo getErrors('lastname', $errors); ?>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo getValue('email', $datas); ?>" />
                <?php echo getErrors('email', $errors); ?>
            </div>
            <div>
                <label for="phone">Portable:</label>
                <input type="text" id="phone" name="phone" value="<?php echo getValue('phone', $datas); ?>" />
            </div>
            <div>
                <label for="picture">Photo:</label>
                <input type="file" id="picture" name="picture"  />
                <?php echo getErrors('picture', $errors); ?>
            </div>
            <div>
                <button type="submit">Enregistrer</button>
            </div>
        </form>
    </body>
</html>