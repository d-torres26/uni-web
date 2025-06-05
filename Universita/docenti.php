<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista docenti</title>
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
            <h1>Lista docenti</h1><br>
        </div>
        <p>Lista dei docenti con l'informazione dei corsi che tengono</p><br>
        <?php
            include "config.php";
            session_start();
            $query="SELECT d.Cognome, d.Nome, d.Email, c.Nome AS nC, c.Descrizione FROM Docente d LEFT JOIN Corso c ON d.IDD=c.IDD ";
            if(isset($_POST['pro'])){
                $query.="WHERE IDC IN (
                    SELECT c.IDC FROM Corso c, Frequentazione f, Studente s WHERE c.IDC=f.IDC AND f.Mat=s.Mat AND s.Email='".$_SESSION['email']."'
                ) ";
            }
            $query.="ORDER BY d.Cognome ASC, d.Nome ASC";
            $ris=$conn->query($query);
            if($ris->num_rows>0){
                $tab="<table><tr><th>Cognome docente</th><th>Nome docente</th><th>Email docente</th><th>Nome corso</th><th>Descrizione corso</th></tr>";
                while($row=$ris->fetch_assoc()){
                    $tab.="<tr><td>".$row['Cognome']."</td><td>".$row['Nome']."</td><td>".$row['Email']."</td><td>".$row['nC']."</td><td><textarea name=\"desc\" id=\"desc\" cols=\"30\" rows=\"2\" readonly>".$row['Descrizione']."</textarea></td></tr>";
                }
                $tab.="</table>";
                echo $tab;
            }else{
                header('Location:./error.php?page=./&err=Non ci sono docenti da mostrare');
                exit;
            }
        ?>
    </main>
</body>
</html>