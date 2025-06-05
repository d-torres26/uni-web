<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valutazione esame</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <form action="./" method="get" >
            <button type="submit" id="hp">
                <img src="./images/icon.png" alt="Homepage">
                <h1>Università</h1>
            </button>
        </form>
    </header>
    <main>
        <div class="title">
            <a href="./esami.php" class="funcBtns"><img src="./images/back.png" alt="Indietro" ></a>
            <h1>Valutazione esame</h1><br>
        </div>
        <?php
            include "config.php";
            session_start();
            $query="SELECT IDD FROM Docente WHERE Email='".$_SESSION['email']."'";
            $ris=$conn->query($query);
            if($ris->num_rows>0){
                $idd=$ris->fetch_assoc()['IDD'];
            }else{
                header('Location:./error.php?page=./esami.php&err=Errore');
                exit;
            }
            $query="SELECT s.Mat, s.Nome, s.Cognome FROM Studente s, Frequentazione f WHERE s.Mat=f.Mat AND f.IDC='".$_POST['idc']."'";
            $ris=$conn->query($query);
            if($ris->num_rows>0){
                $form="<form action=\"addV.php\" method=\"post\">
                        <input type=\"hidden\" name=\"ide\" value=\"".$_POST['ide']."\">
                        <input type=\"hidden\" name=\"idd\" value=\"".$idd."\">
                        Nome esame: <input type=\"text\" name=\"nome\" id=\"nome\" value='".$_POST['nome']."' readonly><br>
                        Voto: <input type=\"number\" name=\"voto\" id=\"voto\" placeholder=\"1-30\"><br>
                        Data: <input type=\"date\" name=\"data\" id=\"data\" value=\"".date('Y-m-d')."\"><br>
                        Studente: <select name=\"mat\" id=\"mat\">";
                while($row=$ris->fetch_assoc()){
                            $form.="<option value=\"".$row['Mat']."\">".$row['Nome']." ".$row['Cognome']."</option>";
                        }
                $form.="</select><br>
                        <input type=\"submit\" value=\"Aggiungi valutazione\">
                    </form>";
                echo $form;
            }else{
                header('Location:./error.php?page=./esami.php&err=Errore');
                exit;
            }
        ?>
    </main>
</body>
</html>