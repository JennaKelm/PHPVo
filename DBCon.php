<?php

class DBCon {

    private $con;
    private $host = "";
    private $username = "";
    private $passwort = "";
    private $db = "";
    private $res;

    function __construct($host, $username, $passwort, $db) {                    // alle notwendigen daten zum db Verbindungsaufbau 
        $this->host = $host;
        $this->username = $username;
        $this->passwort = $passwort;
        $this->db = $db;
    }

    private function Con($query) {
        $this->con = @new mysqli($this->host, $this->username, $this->passwort, $this->db);      // stellt die verbindung mit der Datenbank her und liefert das result zurück
        if ($this->con->connect_error) {
            exit("Die Datenbank ist leider grad nicht erreichbar.<br> Versuch es später noch einmal");
        }
        $result = $this->con->query($query);
        $this->con->close();
        return $result;
    }

    function ZufallsArrayErstellen() {
        $this->res = $this->Con("SELECT* From woerter");
        if ($this->res === false) {                                             //überprüfung ob das sql statmant richtig ist 
            exit("SQL-Query fehlerhaft: ZufallsArrayerstellen <br>");
        } elseif ($this->res->num_rows != 0) {                                   //check ob das result inhalt hat 
            $zufallsArray;
            $anzahl = $this->res->num_rows;                                      //erstell ein array mit den id aus der db 
            for ($i = 0; $i < $anzahl; $i++) {
                $stat = $this->res->fetch_assoc();
                $zufallsArray[$i] = $stat['id'];
            }
            $_SESSION['IDArray'] = $zufallsArray;                                // setzt das array mit den id angaben in die session
            // echo"SEssiom DAten <br>";
            // echo "<pre>";
            // echo print_r($_SESSION);
            // echo"</pre>";
        }
    }

    function WortAbgleich($wortId) {

        $this->res = $this->Con("SELECT * FROM woerter WHERE id = $wortId");
        if ($this->res === false) {                                             //überprüfung ob das sql statmant richtig ist 
            exit("SQL-Query fehlerhaft: WortAbgleich <br>");
        } elseif ($this->res->num_rows != 0) {                                  // hier werden die wörter zu der dem entsprechenden id aus der datenbank geholt 
            $stat = $this->res->fetch_assoc();
            $wortArray['deutsch'] = $stat['deutsch'];
            $wortArray['englisch'] = $stat['englisch'];
            $_SESSION['vokabel'] = $wortArray;                                   // Array mit den wörter für die Userabfrage 
        }
    }

}
