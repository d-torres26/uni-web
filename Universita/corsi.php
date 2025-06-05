<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista corsi</title>
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
            <h1>Lista corsi</h1><br>
        </div>
        <?php
            include "config.php";
            session_start();
            $query="SELECT c.IDC, c.Nome, c.Descrizione, c.AnnSem, c.MaxStu, COUNT(f.Mat) AS nStu, d.Cognome, d.Nome AS nDoc
                    FROM Docente d JOIN Corso c ON d.IDD=c.IDD LEFT JOIN Frequentazione f ON c.IDC=f.IDC ";
            if(isset($_REQUEST['corsi'])){
                if($_REQUEST['corsi']=="own"){
                    $query.="WHERE d.Email='".$_SESSION['email']."' ";
                }else{
                    $qry="SELECT Mat FROM Studente WHERE Email='".$_SESSION['email']."'";
                    $ris=$conn->query($qry);
                    if($ris->num_rows>0){
                        $mat=$ris->fetch_assoc()['Mat'];
                        $query.="WHERE f.Mat='".$mat."' ";
                    }
                }
            }
            $query.="GROUP BY c.IDC
                    ORDER BY c.Nome ASC";
            $ris=$conn->query($query);
            if($ris->num_rows>0){
                $tab="<table><tr><th>Nome corso</th><th>Descrizione corso</th><th>Annuale/Semestrale</th><th>Numero massimo di studenti</th><th>Numero di studenti</th><th>Lista studenti</th><th>Cognome del docente</th><th>Nome del docente</th>";
                if(isset($_REQUEST['sub'])){
                    $tab.="<th>Iscrizione</th>";
                }else if(isset($_REQUEST['corsi'])){
                    if($_REQUEST['corsi']=="sub"){
                        $tab.="<th>Annulla l'iscrizione</th>";
                    }else if($_REQUEST['corsi']=="own"){
                         $tab.="<th>Crea esame</th>";
                    }
                }
                $tab.="</tr>";
                while($row=$ris->fetch_assoc()){
                    $tab.="<tr><td>".$row['Nome']."</td><td><textarea name=\"desc\" id=\"desc\" cols=\"30\" rows=\"2\" readonly>".$row['Descrizione']."</textarea></td><td>".$row['AnnSem']."</td><td>".$row['MaxStu']."</td><td>".$row['nStu']."</td><td><form action=\"studenti.php\" method=\"post\"><button type=\"submit\" name=\"idc\" value=\"".$row['IDC']."\">Visualizza lista</button></form></td>   <td>".$row['Cognome']."</td><td>".$row['nDoc']."</td>";
                    if(isset($_REQUEST['sub'])){
                    $tab.="<td><form action=\"sub.php\" method=\"post\"><input type=\"hidden\" name=\"annSem\" value=\"".$row['AnnSem']."\"><button type=\"submit\" name=\"idc\" value=\"".$row['IDC']."\">Iscriviti</button></form></td>";
                    }else if(isset($_REQUEST['corsi'])){
                        if($_REQUEST['corsi']=="sub"){
                            $tab.="<td><form action=\"unsub.php\" method=\"post\"><button type=\"submit\" name=\"idc\" value=\"".$row['IDC']."\">Annulla</button></form></td>";
                        }else if($_REQUEST['corsi']=="own"){
                            $tab.="<td><form action=\"addEsame.php\" method=\"post\"><input type=\"hidden\" name=\"page\" value=\"corsi.php?corsi=own\"><input type=\"hidden\" name=\"nome\" value=\"".$row['Nome']."\"><button type=\"submit\" name=\"idc\" value=\"".$row['IDC']."\">Crea</button></form></td>";
                        }
                    }
                    $tab.="</tr>";
                }
                $tab.="</table>";
                echo $tab;
            }else{
                header('Location:./error.php?page=areaRiservata.php&err=Non ci sono corsi da mostrare');
            }
        ?>
    </main>
</body>
</html>