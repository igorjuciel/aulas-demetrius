<?php
$valor = 1200;
$juros = $valor * 0.12;
$valor_total = $valor + $juros;
$parcelas = $valor_total /12;
echo $valor_total. "<br>";
echo $parcelas;


?>