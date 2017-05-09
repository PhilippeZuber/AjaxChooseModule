<?php
require_once('system/data.php');
require_once('system/security.php');


$marke = $_REQUEST['biermarke'];
$sorte = $_REQUEST['biersorte'];
$form = $_REQUEST['bierform'];
$alkohol = $_REQUEST['alkoholgehalt'];

$ausgabe = get_selection($marke, $sorte, $form, $alkohol);
$echo_ok = true;

echo "<h2>Das Bier-Orakel hat entschieden:</h2><br>";

        while($output = mysqli_fetch_assoc($ausgabe)){    //Die erhaltenen Werte müssen in ein Array umgewandelt werden
        echo "$output[name]<br>";
    }

    $row_count = mysqli_num_rows($ausgabe);

                if($row_count == 0){
                    echo "Du hast einen ausserordentlichen Geschmack, welchem ich leider nicht dienen kann! <br><b>Dini Muäter</b> trinkt au so Bier!!";
                }

   //Mit der While-Schlaufe wird für jeden Inhalt des Arrays, dessen Name ausgegeben.
  //print_r($selection_output);


// if ($output = ""){
//      echo "Du bist zu wählerisch! Es gibt kein passendes Bier für dich.";
// }else{}

// echo $output;


// function get_marke($biermarke){
//     echo $biermarke;
//     $sql = "SELECT name FROM biersorten WHERE marke = '$biermarke';";   /*Der Grundbefehl*/
//     return $result;
//     echo $sql;
//     // echo $result;
//      echo mysql_fetch_assoc_array($biermarke);
// }
//




 ?>
