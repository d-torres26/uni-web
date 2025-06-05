<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista esami</title>
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
            <h1>Lista esami</h1><br>
        </div>
        <?php
            include "config.php";
            session_start();
            $query="SELECT ";
            if($_SESSION['type']=="pro"){
                $query.="IDD AS id FROM Docente";
            }else{
                $query.="Mat AS id FROM Studente";
            }
            $query.=" WHERE Email='".$_SESSION['email']."'";
            $ris=$conn->query($query);
            if($ris->num_rows>0){
                $id=$ris->fetch_assoc()['id'];
                $es=false;
                if($_SESSION['type']=="pro"){
                    $query="SELECT e.IDE, e.Nome, e.Arg, e.Tipologia, c.IDC, c.Nome AS nC FROM Esame e, Corso c WHERE e.IDC=c.IDC AND c.IDD='".$id."'";
                    $ris=$conn->query($query);
                    if($ris->num_rows>0){
                        $es=true;
                    }
                }else{
                    $query="SELECT e.IDE, e.Nome, e.Arg, e.Tipologia, c.IDC, c.Nome AS nC, v.Voto FROM Valutazione v, Esame e, Corso c WHERE v.IDE=e.IDE AND e.IDC=c.IDC AND v.Mat='".$id."'";
                    $ris=$conn->query($query);
                    if($ris->num_rows>0){
                        $es=true;
                    }
                }
                if($es){
                    $tab="<table><tr><th>Nome esame</th><th>Argomento esame</th><th>Tipologia esame</th><th>Codice corso</th><th>Nome Corso</th>";
                    if($_SESSION['type']=="pro"){
                        $tab.="<th>Valuta esame</th>";
                    }else{
                        $tab.="<th>Voto esame</th>";
                    }
                    $tab.="</tr>";
                    while($row=$ris->fetch_assoc()){
                        $tab.="<tr><td>".$row['Nome']."</td><td>".$row['Arg']."</td><td>".$row['Tipologia']."</td><td>".$row['IDC']."</td><td>".$row['nC']."</td>";
                        if($_SESSION['type']=="pro"){
                            $tab.="<td><form action=\"addVoto.php\" method=\"post\"><input type=\"hidden\" name=\"nome\" value=\"".$row['Nome']."\"><input type=\"hidden\" name=\"idc\" value=\"".$row['IDC']."\"><button type=\"submit\" name=\"ide\" value=\"".$row['IDE']."\">Valuta</button></form></td>";
                        }else{
                            $tab.="<td>".$row['Voto']."</td>";
                        }
                    $tab.="</tr>";
                    }
                    $tab.="</table>";
                    echo $tab;
                }else{
                    header('Location:./error.php?page=./?&err=Non ci sono esami da mostrare');
                    exit;
                }
            }
            if($_SESSION['type']=="pro"){
                echo "<form action=\"addEsame.php\" method=\"post\"><input type=\"hidden\" name=\"page\" value=\"esami.php\"><input type=\"submit\" value=\"Crea nuovo esame\"></form>";
            }
        ?>
    </main>
</body>
</html>