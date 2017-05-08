<?php
require_once('system/data.php');
require_once('system/security.php');


function get_marke($biermarke){
    echo $biermarke;
    $sql = "SELECT name FROM biersorten WHERE marke = '$biermarke';";   /*Der Grundbefehl*/
    return $result;
    echo $sql;
    // echo $result;
     echo mysql_fetch_assoc_array($biermarke);
}


 ?>
