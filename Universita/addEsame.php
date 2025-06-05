<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creazione esame</title>
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
            <a href="./corsi.php?corsi=own" class="funcBtns"><img src="./images/back.png" alt="Indietro" ></a>
            <h1>Creazione esame</h1><br>
        </div>
        <?php
            if(isset($_REQUEST['page'])){
                $form="<form action=\"addE.php\" method=\"post\">
                            <input type=\"hidden\" name=\"page\" value=\"".$_REQUEST['page']."\">
                            Nome esame: <input type=\"text\" name=\"nome\" id=\"nome\"><br>
                            Argomento: <input type=\"text\" name=\"arg\" id=\"arg\"><br>
                            Tipologia: <select name=\"type\" id=\"type\">
                                <option value=\"Scritto\">Scritto</option>
                                <option value=\"Orale\">Orale</option>
                            </select><br>";
                if($_REQUEST['page']=="corsi.php?corsi=own"){
                    if(isset($_REQUEST['idc']) AND isset($_REQUEST['nome'])){
                        $form.="Corso: <input type=\"text\" name=\"nomeC\" id=\"nomeC\" value='".$_REQUEST['nome']."' readonly><br>
                                <input type=\"hidden\" name=\"idc\" value=\"".$_REQUEST['idc']."\">";
                    }
                }else{
                    include "config.php";
                    session_start();
                    $query="SELECT c.IDC, c.Nome FROM Corso c, Docente d WHERE c.IDD=d.IDD AND d.Email='".$_SESSION['email']."'";
                    $ris=$conn->query($query);
                    if($ris->num_rows>0){
                        $form.="Corso: <select name=\"idc\" id=\"idc\">";
                        while($row=$ris->fetch_assoc()){
                            $form.="<option value=\"".$row['IDC']."\">".$row['Nome']."</option>";
                        }
                        $form.="</select><br>";
                    }
                }
                $form.="<input type=\"submit\" value=\"Crea esame\"></form>";
                echo $form;
            }else{
                header('Location:./error.php?page=./&err=Errore');
                exit;
            }
            
        ?>
    </main>
</body>
</html>