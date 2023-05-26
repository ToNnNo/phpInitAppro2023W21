<?php 

// for
echo "For <br />";
for($i = 0; $i < 10; $i++) {
    echo "itération " . $i . "<br />";
}

// while
echo "<br />While <br />";
$j = 1;
while($j <= 10) {
    echo "iteration (while) ". $j . "<br />";
    $j += 1; // $j = $j + 1
}

// do while
echo "<br />Do While <br />";
// $j = 30;
do {
    echo "iteration (do while) ". $j . "<br />";
    $j += 1;
} while($j <= 10);

// foreach
echo "<br />Foreach<br />";
foreach(range(0, 9) as $value) {
    echo "iteration (foreach) ". $value . "<br />";
}

echo "<br />";
$array = [30, 67, 99, 110, 20, 76, 41];
foreach($array as $value) {
    echo "array " . $value . "<br />";
}

echo "<br />";
$array = [30, 67, 99, 110, 20, 76, 41];
foreach($array as $key => $value) {
    echo "array[" . $key . "] = " . $value . "<br />";
}