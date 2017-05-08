<?php
/*session_start();
if(!isset($_SESSION['id'])){
  header("Location:index.php");
}else{
  $user_id = $_SESSION['id'];
}*/

session_start();

require_once('system/data.php');
require_once('system/security.php');
require_once('get_biermarke.php');



if(isset($_GET['filter-submit']))       //Button, der die ausgewählten Daten ausliest und abschickt.
{
  $marke = filter_data($_GET['marke']);
  $sorte = filter_data($_GET['sorte']);
  $form = filter_data($_GET['form']);
  $alkohol = filter_data($_GET['alkohol']);

  $selection = get_selection($marke, $sorte, $form, $alkohol);   //Funktion zur Erstellung des sql-Befehls wird gestartet.
  while($selection_output = mysqli_fetch_assoc($selection)){    //Die erhaltenen Werte müssen in ein Array umgewandelt werden
      echo "$selection_output[name]<br>";   //Mit der While-Schlaufe wird für jeden Inhalt des Arrays, dessen Name ausgegeben.
  //print_r($selection_output);
    }

  }


 /* $result = filter_user($email, $gender, $firstname, $lastname);
}else{
  $result = get_all_user();
}*/
?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bierkompass</title>
  </head>
  <body>
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1>Wähle deine Kriterien</h2>
                <h2>Biermarke</h2>
                <form class="form-inline" method="get" action="index.php">
                    <div class="form-group">
                        <select name="marke" id="marke">
                            <option value="0" selected>Wähle eine Biermarke aus</option>
                            <option value="1">Schützengarten</option>
                            <option value="2">Feldschlösschen</option>
                        </select>
                    </div>
                    <br><br>
                    <h2>Biersorte</h2>

                    <select name="sorte" id="sorte">
                        <option value="">Wähle eine Biersorte aus</option>
                        <option value="1">Lager</option>
                        <option value="3">Weizen</option>
                    </select>
                    <br><br>
                    <h2>Einheit</h2>

                    <select name="form" id="form">
                        <option value="">Wie gross soll dein Bier sein?</option>
                        <option value="1">33cl</option>
                        <option value="2">50cl</option>
                    </select>
                    <br><br>
                    <h2>Wie solls denn sein?</h2>

                    <select name="alkohol" id="alkohol">
                        <option value="">Alkoholfrei?</option>
                        <option value="1">Nein</option>
                        <option value="0">Ja</option>
                    </select>



                    <button type="submit" name="filter-submit" class="btn btn-default">Filter anwenden</button>
                </form>
                <br><br><br>
                <p id="output"></p>
            </div>
        </div>
    </div>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script>
    // ajax Befehle:

    $("#marke").change(function(event) {         // Bei Klick auf den "posten"-Button
    event.preventDefault();                           // Absenden des Formulars unterbinden
    var marke = $('#marke option:selected').attr( "value");
    // alert(marke);   // User_ID auslesen

    // txt = $("#the_text").val();   // Posttext aus der Textarea auslesen
    // if(txt != ""){                // Sicherheitsabfrage, damit keine leeren Posts erzeugt werden.
    //   $("#the_text").val("");     // Text in Textarea löschen

      var request = $.ajax({                    // Initialisierung eines AJAX-Requests
        url: "get_biermarke.php",               // Adresse des Skripts
        method: "GET",                           // Sendemethode der Daten GET / POST
        data: { biermarke : marke }, // zu sendenden Daten
        dataType: "html"                          // was für ein Datentyp kommt zurück
      });

      request.success(function( msg ) {             // Wenn der Request Erfolg hatte
        html = $.parseHTML( msg );                    // empfangenen Text als HTML parsen
        $(html).hide().prependTo("#output").show(500); // html an den Anfang von #posts einfügen und einblenden
      });

      request.fail(function( jqXHR, textStatus ) {
        // Aktion, wenn ein Fehler auftritt.
      });
    // };
  });

    </script>

  </body>
</html>
