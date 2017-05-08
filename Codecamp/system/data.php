<?php

  function get_db_connection()
  {
    $db = mysqli_connect('localhost', '689292_9_1', '0g9Qir6X1UAv', '689292_9_1')
      or die('Fehler beim Verbinden mit dem Datenbank-Server.');
    mysqli_set_charset($db, "utf8");
    return $db;
}

  function get_result($sql)
  {
    $db = get_db_connection();
    echo $sql;
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    return $result;

  }

 function get_selection($marke, $sorte, $form, $alkohol){

     /*$sql = "SELECT name FROM biersorten WHERE marke = $marke;";
     return get_result($sql);*/


     $sql = "SELECT name FROM biersorten WHERE ";   /*Der Grundbefehl*/

         if($marke != ""){                  /*Abhängig davon, ob die Variable leer ist oder nicht,*/
          $sql .= "marke = '$marke' AND ";      /*wird diese in das sql-Statement integriert*/
          $sql_ok = true;                   /*Mit dem Punkt (.) wird der Befehl hinzugefügt.*/
          }

         if($sorte != ""){
           $sql .= "sorte = '$sorte' AND ";
           $sql_ok = true;
           }

         if($form != ""){
            $sql .= "form = '$form' AND ";
            $sql_ok = true;
            }

         if($alkohol != ""){
             $sql .= "alkohol = '$alkohol' AND ";
             $sql_ok = true;
             }

    $sql = substr_replace($sql, ' ', -4, 3);    /*Das letzte AND im sql-Befehl wird gelöscht.
                                                    Man weiss ja nicht, welche Variablen alle übergeben werden.*/
    return get_result($sql);


 }


  ?>
