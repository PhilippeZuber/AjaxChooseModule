<?php
require_once('system/data.php');
require_once('system/security.php');


$resultat = function get_marke($biermarke){
    $sql = "SELECT name FROM biersorten WHERE marke = '$biermarke';";   /*Der Grundbefehl*/
    return $result;

         }
echo $resultat;



 ?>
