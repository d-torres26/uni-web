<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dati personali</title>
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
            <a href="./areaRiservata.php" class="funcBtns"><img src="./images/back.png" alt="Indietro" ></a>
            <h1>Dati personali</h1><br>
        </div>
        <?php
            session_start();
            if(isset($_SESSION['email'])){
                include "config.php";
                $query="SELECT Nome, Cognome, bDate, Email";
                if($_SESSION['type']=="pro"){
                    $query.=" FROM docente WHERE Email='".$_SESSION['email']."'";
                }else{
                    $query.=",Mat FROM studente WHERE Email='".$_SESSION['email']."'";
                }
                $ris=$conn->query($query);
                if($ris->num_rows>0){
                    $row=$ris->fetch_assoc();
                    setcookie("dati", implode(";", $row), time()+1800);
                    $tab="<table><tr><th>Cognome</th><th>Nome</th>";
                    if($_SESSION['type']=="stu"){
                        $tab.="<th>Numero di matricola</th>";
                    }
                    $tab.="<th>Data di nascita</th><th>Email</th></tr>
                    <tr><td>".$row['Cognome']."</td><td>".$row['Nome']."</td>";
                    if($_SESSION['type']=="stu"){
                        $tab.="<td>".$row['Mat']."</td>";
                    }
                    $tab.="<td>".$row['bDate']."</td><td>".$row['Email']."</td></tr><table>";
                    echo $tab;
                    echo "<form action=\"dataMod.php\" method=\"get\"><input type=\"submit\" value=\"Modifica i tuoi dati\"></form>";
                }else{
                    header('Location:./error.php?page=data.php&err=Errore');
                }
            }else{
                header("Location:./signin.html");
            }
        ?>
    </main>
</body>
</html>