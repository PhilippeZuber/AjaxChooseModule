
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

  </head>
  <body>
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 .col-md-offset-1">
                <h1>Wähle deine Kriterien</h2>
                    <br>
                <h2>Welche Marke ist dir lieb?</h2>
                <form class="form-inline" method="get" action="index.php">
                    <div class="form-group">
                        <select name="marke" class="auswahl" id="marke">
                            <option value="" selected>Alle Brauereien</option>
                            <option value="1">Schützengarten</option>
                            <option value="2">Feldschlösschen</option>
                            <option value="3">Appenzeller Bier</option>
                            <option value="4">Brauerei Fischerstube</option>
                            <option value="5">Cardinal</option>
                            <option value="6">Doppelleu</option>

                        </select>
                    </div>
                    <br>
                    <h2>Was trifft deinen Geschmack?</h2>

                    <select name="sorte" class="auswahl" id="sorte">
                        <option value="">Alle Sorten</option>
                        <option value="1">Lager</option>
                        <option value="3">Weizen</option>
                        <option value="4">Naturtrüeb</option>
                        <option value="5">Amber</option>
                        <option value="6">Panache</option>
                        <option value="7">Ale</option>
                        <option value="8">Dunkel</option>
                    </select>
                    <br>
                    <h2>Woraus trinkst du am liebsten?</h2>

                    <select name="form" class="auswahl" id="form">
                        <option value="">Egal</option>
                        <option value="1">Flasche</option>
                        <option value="2">Dose</option>
                        <option value="3">Fässli</option>
                    </select>
                    <br>
                    <h2>Trinkst du gerne Alkoholfrei?</h2>

                    <select name="alkohol" class="auswahl" id="alkohol">
                        <option value="">Egal</option>
                        <option value="1">Spinnsch?</option>
                        <option value="0">Ja</option>
                    </select>
                </form>
                <br>
            </div>
            <div class="col-md-5 .col-md-offset-1">
                <br><br><br><br>
				<!-- <h2>Das Bier-Orakel hat entschieden:</h2> -->
                <p id="output"></p>
            </div>
		  </div> <!--Close Row-->
    </div> <!--Close container fluid-->




	<!--Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!--Bootstrap css-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--Bootstrap JS-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link href="style.css" rel="stylesheet">

    <script>
    // ajax Befehle:

    $(".auswahl").change(function(event) {         // Bei Klick auf den "posten"-Button
    event.preventDefault();                           // Absenden des Formulars unterbinden
    var marke = $('#marke option:selected').attr( "value");
    var sorte = $('#sorte option:selected').attr( "value");
    var form = $('#form option:selected').attr( "value");
    var alkohol = $('#alkohol option:selected').attr( "value");
    // var marke = $('#marke').val();//
    // var sorte = $('#sorte').val();
    // var form = $('#form').val();
    // var alkohol = $('#alkohol').val();


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
            console.log(get_data);


        }




        // request.fail(function( jqXHR, textStatus ) {
        //   // Aktion, wenn ein Fehler auftritt.
        });
    });


    </script>

  </body>
</html>
