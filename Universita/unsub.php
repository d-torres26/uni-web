<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annullazione iscrizione corso</title>
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
                    $query="SELECT Mat FROM Studente WHERE Email='".$_SESSION['email']."'";
                    $ris=$conn->query($query);
                    if($ris->num_rows>0){
                        $mat=($ris->fetch_assoc())['Mat'];
                        $query="DELETE FROM `frequentazione` WHERE IDC='".$_POST['idc']."' AND Mat='".$mat."'";
                        if($conn->query($query)===TRUE){
                            echo 'Hai annullato l\'iscrizione al corso';
                            header('Refresh: 1, URL=corsi.php?corsi=sub');
                        }else{
                            header('Location:./error.php?page=corsi.php?sub=true&err=Errore');
                            exit;
                        }
                    }else{
                        header('Location:./error.php?page=corsi.php?sub=true&err=Errore');
                        exit;
                    }
                }
            }else{
                header('Location:./error.php?page=corsi.php?sub=true&err=Errore');
                exit;
            }
            
        ?>
    </main>
</body>
</html>