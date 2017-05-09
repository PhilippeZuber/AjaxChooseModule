
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
// require_once('get_biermarke.php');



// if(isset($_GET['filter-submit']))       //Button, der die ausgewählten Daten ausliest und abschickt.
// {
//   $marke = filter_data($_GET['marke']);
//   $sorte = filter_data($_GET['sorte']);
//   $form = filter_data($_GET['form']);
//   $alkohol = filter_data($_GET['alkohol']);
//
//   $selection = get_selection($marke, $sorte, $form, $alkohol);   //Funktion zur Erstellung des sql-Befehls wird gestartet.
//   while($selection_output = mysqli_fetch_assoc($selection)){    //Die erhaltenen Werte müssen in ein Array umgewandelt werden
//       echo "$selection_output[name]<br>";   //Mit der While-Schlaufe wird für jeden Inhalt des Arrays, dessen Name ausgegeben.
//   //print_r($selection_output);
//     }
//
//   }


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
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h1>Wähle deine Kriterien</h2>
                <h2>Biermarke</h2>
                <form class="form-inline" method="get" action="index.php">
                    <div class="form-group">
                        <select name="marke" class="auswahl" id="marke">
                            <option value="" selected>Welche Marke ist dir lieb?</option>
                            <option value="1">Schützengarten</option>
                            <option value="2">Feldschlösschen</option>
                            <option value="3">Appenzeller Bier</option>
                            <option value="4">Brauerei Fischerstube</option>
                            <option value="5">Cardinal</option>
                            <option value="6">Doppelleu</option>
                        </select>
                    </div>
                    <br><br><br><br><br><br>
                    <h2>Biersorte</h2>

                    <select name="sorte" class="auswahl" id="sorte">
                        <option value="">Wie solls schmecken?</option>
                        <option value="1">Lager</option>
                        <option value="3">Weizen</option>
                        <option value="4">Naturtrüeb</option>
                        <option value="5">Amber</option>
                        <option value="6">Panache</option>
                        <option value="7">Ale</option>
                        <option value="8">Dunkel</option>
                    </select>
                    <br><br><br><br><br><br>
                    <h2>Einheit</h2>

                    <select name="form" class="auswahl" id="form">
                        <option value="">Wie trinkst du es am liebsten?</option>
                        <option value="1">Glas</option>
                        <option value="2">Dose</option>
                        <option value="3">Flasche</option>
                    </select>
                    <br><br><br><br><br><br>
                    <h2>Mit oder ohne Pfupf?</h2>

                    <select name="alkohol" class="auswahl" id="alkohol">
                        <option value="">Alkoholfrei?</option>
                        <option value="1">Nein</option>
                        <option value="0">Ja</option>
                    </select>
                </form>
                <br><br><br><br><br><br><br>
            </div>
            <div class="col-md-6">
                <p id="output"></p>
            </div>
        </div> <!--Close Row-->
    </div> <!--Close container fluid-->





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script>
    // ajax Befehle:

    $(".auswahl").change(function(event) {         // Bei Klick auf den "posten"-Button
    event.preventDefault();                           // Absenden des Formulars unterbinden
    var marke = $('#marke option:selected').attr( "value"); //
    var sorte = $('#sorte option:selected').attr( "value");
    var form = $('#form option:selected').attr( "value");
    var alkohol = $('#alkohol option:selected').attr( "value");
    console.log(marke);   // User_ID auslesen

    // txt = $("#the_text").val();   // Posttext aus der Textarea auslesen
    // if(txt != ""){                // Sicherheitsabfrage, damit keine leeren Posts erzeugt werden.
    //   $("#the_text").val("");     // Text in Textarea löschen

        $.ajax({                    // Initialisierung eines AJAX-Requests
          url: "get_biermarke.php",               // Die in Ajax ablaufenden Funktionen müssen zwingend in diesem esternen File stattfinden.
          type: "POST",                           // Sendemethode der Daten GET / POST
          data: { biermarke: marke, biersorte: sorte, bierform: form, alkoholgehalt: alkohol}, // zu sendenden Daten; Die Attribute werden als "Variable" gesendet.
          dataType: "text",                 //Die Form der Daten. Kann z.B. auch HTML oder Jason sein.

          success:function( get_data ) {             // Bei erfolgreichem Request: Den zu empfangenden Daten einen "Namen" zuweisen.
            // console.log(get_data);
            html = $.parseHTML( get_data );                    // empfangenen Text als HTML parsen
            $("#output").empty();                           //Das Ausgabefeld mit der ID output wird geleert
            $(html).hide().prependTo("#output").show(500); // Das Ausgabefeld wird mit dem Inhalt gefüllt.

        }



        // request.fail(function( jqXHR, textStatus ) {
        //   // Aktion, wenn ein Fehler auftritt.
        });
    });


    </script>

  </body>
</html>
