<?php 
date_default_timezone_set("America/Mexico_City");

//$hora_actual = date("H:i");
$hora_actual = '07:31';

$he_lun = '07:30';
$hc_lun = '15:30';
$hs_lun = '19:00';
$hc_lun_reg = (intval(substr($hc_lun, -5, 2)) + 01) . substr($hc_lun, -3, 3);

echo $hora_actual;
echo '<br>';
echo $hc_lun_reg;
echo '<br>';

if(($hora_actual>$he_lun && $hora_actual<$hs_lun)){
	if(($hora_actual>$hc_lun && $hora_actual<$hc_lun_reg)){
		echo 'no esta abierto';
	} else
	{
		echo 'ya esta abierto';
	}
}
else
{
	echo 'no esta abierto';
}


?>