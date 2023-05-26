<?php 

// CamelCase | camelCase | snake_case | kebab-case
function sayHello(): void {
    "Hello World"; // écrire dans un fichier
}

function hello(string $prenom = null): string {
    echo "__ la fonction hello a été appelé __";
    echo "<br />";

    if(null == $prenom) {
        return "Salut !";
    }
    
    // le mot clé return met fin à une fonction
    return "Salut ". $prenom;
}

echo "Actions avant la fonction<br />";
sayHello();
echo "<br />";
echo "Actions après la fonction<br />";

$message = hello();
echo hello("Stéphane");
echo "<br />";

echo $message;
echo "<br />";

$salutation = hello("John");
echo $salutation;