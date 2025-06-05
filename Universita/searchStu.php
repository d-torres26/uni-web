<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricerca informazioni studenti</title>
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
            <a href="./" class="funcBtns"><img src="./images/back.png" alt="Indietro" ></a>
            <h1>Ricerca informazioni studenti</h1><br>
        </div>
        
        <?php
            if(isset($_POST['type'])){
                include "config.php";
                switch($_POST['type']){
                    case 'esami':
                        echo "<p>Lista e numero esami</p><br>";
                        $query="SELECT COUNT(v.IDE) as nE, e.Nome, e.Arg, e.Tipologia, c.Nome AS nC, v.Voto, v.Data, d.Cognome, d.Nome AS nD
                                FROM Studente s, Valutazione v, Esame e, Corso c, Docente d
                                WHERE s.Mat=v.Mat AND v.IDE=e.IDE AND e.IDC=c.IDC AND c.IDD=d.IDD AND s.Nome='".$_POST['name']."' AND s.Cognome='".$_POST['lname']."'";
                        $ris=$conn->query($query);
                        $row=$ris->fetch_assoc();
                        if($row['nE']>0){
                            echo "<h2>Numero esami eseguiti: ".$row['nE']."</h2 >";
                            $tab="<table><tr><th>Nome esame</th><th>Argomento esame</th><th>Tipologia esame</th><th>Nome del corso</th><th>Valutazione esame</th><th>Data esame</th><th>Cognome del docente</th><th>Nome del docente</th></tr>";
                            do {
                                $tab.="<tr><td>".$row['Nome']."</td><td>".$row['Arg']."</td><td>".$row['Tipologia']."</td><td>".$row['nC']."</td><td>".$row['Voto']."</td><td>".$row['Data']."</td><td>".$row['Cognome']."</td><td>".$row['nD']."</td></tr>";
                            } while ($row=$ris->fetch_assoc());
                            $tab.="</table>";
                            echo $tab;
                        }else{
                            header('Location:./error.php?page=./&err=Non ci sono esami da mostrare');
                            exit;
                        }
                        break;
                    case 'corsi':
                        echo "<p>Lista corsi</p><br>";
                        $query="SELECT c.Nome, c.Descrizione
                                FROM Studente s, Frequentazione f, Corso c
                                WHERE s.Mat=f.Mat AND f.IDC=c.IDC AND s.Nome='".$_POST['name']."' AND s.Cognome='".$_POST['lname']."'";
                        $ris=$conn->query($query);
                        if($ris->num_rows>0){
                            $tab="<table><tr><th>Nome corso</th><th>Descrizione corso</th></tr>";
                            while ($row=$ris->fetch_assoc()){
                                $tab.="<tr><td>".$row['Nome']."</td><td><textarea name=\"desc\" id=\"desc\" cols=\"30\" rows=\"2\" readonly>".$row['Descrizione']."</textarea></td></tr>";
                            }
                            $tab.="</table>";
                            echo $tab;
                        }else{
                            header('Location:./error.php?page=./&err=Non ci sono corsi da mostrare');
                            exit;
                        }
                        break;
                    case 'media':
                        $query="SELECT Count(IDV) as nV, AVG(Voto) as media
                                FROM Valutazione 
                                WHERE Mat='".$_POST['mat']."'";
                        $ris=$conn->query($query);
                        $row=$ris->fetch_assoc();
                        if($row['nV']>0){
                            echo "<h2>Media: ".$row['media']."/30</h2>";
                        }else{
                            header('Location:./error.php?page=./&err=Non è possibile calcolare la media');
                            exit;
                        }
                        break;
                }
            }else{
                header("Location: ./");
                exit;
            }
        ?>
    </main>
</body>
</html>