<?php

include 'DBCon.php';

class StartBildschirm {

    private $eingaberichtig = true;

    function __construct() {
        if (isset($_SESSION['vokabel'])) {
            $this->eingaberichtig = $this->Check();
        }
        if ($this->eingaberichtig) {
            $this->DBvokabelnaAnfordern();
        }
    }

    function DBvokabelnaAnfordern() {
        $_SESSION['eingabeEnglisch'] = "";
        $_SESSION['eingabeDeutsch'] = "";
        $db = new DBCon("localhost", "root", "", "vokabel");                     //Datenbank erstellen
        if (!isset($_SESSION['IDArray']) || count($_SESSION['IDArray']) == 0) {
            $db->ZufallsArrayErstellen();                                        // setzen des Array mit den id zu den entsprechenden wörter in der db einmal für alle wörter 
            echo "<h3>LOS GEHTS </h3>";
        }
        $hi = $this->wuerfeln('IDArray');
        $db->WortAbgleich($hi[0]);                                              // Anfrage an die datenbank um die wörter der zufällig ermittelten id 
        unset($hi[0]);                                                          // löschen der bereits abgefragen vokabel aus dem array mit den id um zu vermeiden das vokabel doppelt abgefragt werden 
        $_SESSION['IDArray'] = $hi;                                              //IDarray mit den aktuellen werten in die session eintragen 
        $hi = $this->wuerfeln('vokabel');                                       //zufälliges ermittel welche spreche abgefragt wird 
        if ($hi[0] == $_SESSION['vokabel']['deutsch']) {                        //Eintragen der abzufragenden vokabel in die felder für den User
            $_SESSION['eingabeDeutsch'] = $hi[0];
        } elseif ($hi[0] == $_SESSION['vokabel']['englisch']) {
            $_SESSION['eingabeEnglisch'] = $hi[0];
        }/*
          echo"vokabel ausgabe  HILFSARRAY <br>";
          echo "<pre>";
          echo print_r($hi);
          echo"</pre>";
          echo"NEUE SESSION <br>";
          echo "<pre>";
          echo print_r($_SESSION);
          echo"</pre>"; */
    }

    function wuerfeln($arr) {
        $hilfsArray = $_SESSION[$arr];                                          // Wuerfelt einmal die Werte des Array durcheinander
        shuffle($hilfsArray);
        return $hilfsArray;
    }

    // Überprüfung ob die eingabe mit den werten aus der DB übereinstimmen
    function Check() {
        if ($_POST['deutsch'] != "" && $_POST['englisch'] != "") {
            if (strcmp($_POST['deutsch'], $_SESSION['vokabel']['deutsch']) == 0 && strcmp($_POST['englisch'], $_SESSION['vokabel']['englisch']) == 0) {
                echo"<p class=\"richtigeAntwort\">Klasse das war RICHTIG <br></p>";
                return true;
            } else {
                echo" <p class=\"falscheAntwort\">SCHADE!!!! <br>    Deutsch :  " .
                $_SESSION['vokabel']['deutsch'] . "<br> English: " . $_SESSION['vokabel']['englisch'] .
                "<br> wäre Richtig gewesen!!! <br> </p>";
                return true;
            }
        } else {
            echo "<p class=\"eintagFehlt\">Du must erst etwas eintragen !!!!! </p>";
            return false;
        }
    }

}
