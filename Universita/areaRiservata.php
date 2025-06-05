<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Area riservata</title>
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
            <a href="./" class="funcBtns"><img src="./images/back.png" alt="Indietro" ></a>
            <h1>Area riservata</h1><br>
        </div>
        <?php
        function dataBtn() {
            echo "<form action=\"./data.php\" method=\"get\"><input type=\"submit\" value=\"Dati personali\"></form>";
        }
        session_start();
        if(isset($_SESSION['email'])){
            include "config.php";
            $query="SELECT Cognome, Nome, bDate, Email FROM ";
            if($_SESSION['type']=="pro"){
                echo "<h2>Benvenuto/a prof ".$_SESSION['fullName']."</h2>";
                dataBtn();
                echo "<form action=\"./addCorsi.html\" method=\"get\"><input type=\"submit\" value=\"Crea un corso\"></form>";
                echo "<form action=\"./corsi.php\" method=\"post\"><input type=\"hidden\" name=\"corsi\" value=\"own\"><input type=\"submit\" value=\"Mostra i tuoi corsi\"></form>";
            }else{
                echo "<h2>Benvenuto/a ".$_SESSION['fullName']."</h2>";
                dataBtn();
                echo "<form action=\"./corsi.php\" method=\"post\"><input type=\"hidden\" name=\"sub\" value=\"true\"><input type=\"submit\" value=\"Iscriviti ad un corso\"></form>";
                echo "<form action=\"./corsi.php\" method=\"post\"><input type=\"hidden\" name=\"corsi\" value=\"sub\"><input type=\"submit\" value=\"Mostra i tuoi corsi\"></form>";
                echo "<form action=\"./docenti.php\" method=\"post\"><input type=\"hidden\" name=\"pro\" value=\"own\"><input type=\"submit\" value=\"Mostra i docenti dei corsi che segui\"></form>";
            }
            echo "<form action=\"./logout.php\" method=\"get\"><input type=\"submit\" value=\"Log out\"></form>";
        }else{
            header("Location:./signin.html");
        }
    ?>
    </main>
</body>
</html>