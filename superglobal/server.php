<?php

echo "<pre>";
print_r($_SERVER); 
echo "</pre>";

echo __DIR__;
echo "<br />";
echo __FILE__;
echo "<br />";
echo "Racine du serveur: ".$_SERVER['DOCUMENT_ROOT'];