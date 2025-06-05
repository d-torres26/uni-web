<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iscrizione corso</title>
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
        <?php
            if(isset($_POST['idc'])){
                include "config.php";
                session_start();
                if($_SESSION['type']=="stu"){
                    $dataI= date("Y-m-d");
                    if($_POST['annSem']=="Annuale"){
                        $dataF=date($dataI, strtotime("+1 year"));
                    }else{
                        $dataF=date($dataI, strtotime("+6 months"));
                    }
                    $query="SELECT Mat FROM Studente WHERE Email='".$_SESSION['email']."'";
                    $ris=$conn->query($query);
                    if($ris->num_rows>0){
                        $mat=($ris->fetch_assoc())['Mat'];
                        $query="SELECT IDC FROM Frequentazione WHERE Mat='".$mat."'";
                        $ris=$conn->query($query);
                        $pres=false;
                        if($ris->num_rows>0){
                            $c=0;
                            $v=[];
                            while($row=$ris->fetch_assoc()){
                                $v[$c]=$row['IDC'];
                                $c++;
                            }
                            for ($i=0; $i < sizeof($v); $i++) { 
                                if($_POST['idc']==$v[$i]){
                                    $pres=true;
                                }
                            }
                            if(!$pres){
                                $query="INSERT INTO Frequentazione (Mat, IDC, DataI, DataF) VALUES ('".$mat."','".$_POST['idc']."','".$dataI."','".$dataF."')";
                                if($conn->query($query)===TRUE){
                                    echo "Iscrizione effettuata";
                                    header("Refresh: 1, URL=areaRiservata.php");
                                    exit;
                                }else{
                                    header('Location:./error.php?page=corsi.php?sub=true&err=Errore');
                                    exit;
                                }
                            }else{
                                header('Location:./error.php?page=corsi.php?sub=true&err=Sei già iscritto al corso');
                        exit;
                            }
                        }
                        
                    }else{
                        header('Location:./error.php?page=corsi.php?sub=true&err=Errore');
                        exit;
                    }
                }
            }else{
                header("Location: ./corsi.php?sub=true");
            }
            
        ?>
    </main>
</body>
</html>