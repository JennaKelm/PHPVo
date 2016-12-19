<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="vokabel.css">
        <?php
        session_start();
        include 'StartBildschirm.php';
        ?>
    </head>
    <body>
        <h1> Vocabel Trainer </h1>
        <?php
        $stBi = new StartBildschirm();
        ?>        
        <form class="Tabelle" method="post">
            <div class="zeile">
                <label>Deutsch</label><input type="text"  name="deutsch" value="<?php echo$_SESSION['eingabeDeutsch']; ?>">
                <label>English</label><input type="text"  name="englisch" value="<?php echo$_SESSION['eingabeEnglisch']; ?>">
            </div> 
            <div class="zeile">
                <button type="submit">Senden</button> 
            </div> 
        </form>         
    </body>
</html>
