<?php
$colores = array("Abarrotes alcohon", "Chedraui", "floreria", "abarrotes feli", "salchichoneria", "tacos");
echo "Array original";
var_export ($colores);
$numero = 3;
$seleccion = array_rand($colores, $numero);
echo '<br>';
for($i=0; $i<$numero; $i++){
	echo "Valor aleatorio $i : ". $seleccion[0];
	echo '<br>';
}
?>