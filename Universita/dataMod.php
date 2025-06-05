<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica dati</title>
    <link rel="stylesheet" href="style.css">
    <script src="functions.js"></script>
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
            <a href="./data.php" class="funcBtns"><img src="./images/back.png" alt="Indietro" ></a>
            <h1>Modifica dati</h1><br>
        </div>
        <button id="data" onclick="showData()" hidden>Modifica dati personali</button>
        <button id="pw" onclick="showPW()">Modifica password</button> <br><br>
        <?php
            if(isset($_COOKIE['dati'])){
                $row=explode(";", $_COOKIE['dati']);
                session_start();
                if($_SESSION['type']=="stu"){
                    $form= "<form action=\"mod.php\" method=\"post\" id=\"dati\">
                        Numero di matricola: <input type=\"number\" name=\"mat\" id=\"mat\" value=\"".$row[4]."\"><br>";
                }else{
                    $form= "<form action=\"mod.php\" method=\"post\" id=\"dati\">";
                }
                $form.="Nome:<input type=\"text\" name=\"fName\" id=\"fName\" value=\"".$row[0]."\"><br>
                        Cognome: <input type=\"text\" name=\"lName\" id=\"lName\" value=\"".$row[1]."\"><br>
                        Data di nascita: <input type=\"date\" name=\"bdate\" id=\"bdate\" value=\"".$row[2]."\"><br>
                        Email: <input type=\"text\" name=\"mail\" id=\"mail\" value=\"".$row[3]."\"><br>
                        <input type=\"submit\" value=\"Modifica i toui dati\">
                    </form>";
                echo $form;
            }else{
                header('Location:./error.php?page=dataMod.php&err=Errore');
            }
        ?>
        <form action="mod.php" method="post" id="changePW" hidden>
            Password precedente: <input type="password" name="oldPW" id="oldPW" placeholder="qwerty1234"><br>
            Nuova password: <input type="password" name="pw" id="pw" placeholder="qwerty12345"><br>
            <input type="submit" value="Cambia password">
        </form>
        <br>
    </main>
</body>
</html>