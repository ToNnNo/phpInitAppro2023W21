<?php 

// client => id|nom|prenom|email|tel
$clients = [
    ['id' => 1, 'nom' => "Doe", 'prenom' => "John", 'email' => "john.doe@gmail.com", 'tel' => "06 118 218 00"],
    ['id' => 2, 'nom' => "Doe", 'prenom' => "Jane", 'email' => "jane.doe@gmail.com", 'tel' => "06 118 218 01"],
    ['id' => 3, 'nom' => "Doe", 'prenom' => "Eduard", 'email' => "eduard.doe@gmail.com", 'tel' => "06 118 218 11"],
];
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Liste des clients</title>
        <style>
            /*table { width: 100% }
            table th { text-align: left } */
        </style>
    </head>
    <body>
        <h1>Liste des clients</h1>
        <hr />
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                </tr>
            </thead>
            <tbody>
                <?php /*foreach($clients as $client) {
                    echo "<tr>
                        <td>".$client['id']."</td>
                        <td>".$client['nom']."</td>
                        <td>".$client['prenom']."</td>
                        <td>".$client['email']."</td>
                        <td>".$client['tel']."</td>
                    </tr>";
                } */ ?>
                <?php foreach($clients as $client): ?>
                    <tr>
                        <td><?php echo $client['id']; ?></td>
                        <td><?php echo $client['nom']; ?></td>
                        <td><?php echo $client['prenom']; ?></td>
                        <td><?php echo $client['email']; ?></td>
                        <td><?php echo $client['tel']; ?></td>
                    </tr>
                <?php endforeach; ?>    
            </tbody>
        </table>
    </body>
</html>