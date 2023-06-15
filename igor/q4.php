<?php

$valor = 200000;
$idade = $valor/365;
echo number_format($idade)."<br>";
if($idade>=18){
echo"maior de idade";
} else {
    echo "menor de idade";
}

?>
