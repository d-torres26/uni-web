<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista studenti</title>
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
            <a href="./" class="funcBtns"><img src="./images/back.png" alt="Indietro" ></a>
            <h1>Lista studenti</h1><br>
        </div>
        <?php
            include "config.php";
            $query="SELECT s.Mat, s.Cognome, s.Nome, s.Email FROM Studente s";
            if(isset($_POST['idc'])){
                $query.=", Frequentazione f WHERE s.Mat=f.Mat AND f.IDC='".$_POST['idc']."'";
            }
            $query.=" ORDER BY s.Cognome ASC, s.Nome ASC";
            $ris=$conn->query($query);
            if($ris->num_rows>0){
                $tab="<table><tr><th>Cognome studente</th><th>Nome studente</th><th>Numero di matricola</th><th>Email studente</th></tr>";
                while($row=$ris->fetch_assoc()){
                    $tab.="<tr><td>".$row['Cognome']."</td><td>".$row['Nome']."</td><td>".$row['Mat']."</td><td>".$row['Email']."</td></tr>";
                }
                $tab.="</table>";
                echo $tab;
            }else{
                header('Location:./error.php?page=./&err=Non ci sono studenti da mostrare');
                exit;
            }
        ?>
    </main>
</body>
</html>