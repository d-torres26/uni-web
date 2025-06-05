<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiunta Corso</title>
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
            if(sizeof($_POST)>0){
                include "config.php";
                session_start();

                if($_POST['nMax']<=0){
                    header('Location:./error.php?page=addCorsi.html&err=Inserire un numero massimo di studenti valido');
                }else{
                    $query="SELECT IDD FROM Docente WHERE Email='".$_SESSION['email']."'";
                    $ris=$conn->query($query);
                    if($ris->num_rows>0){
                        $IDD=$ris->fetch_assoc()['IDD'];
                        $query="INSERT INTO Corso(Nome, Descrizione, AnnSem, MaxStu, IDD) VALUES ('".$_POST['nome']."','".$_POST['desc']."','".$_POST['annSem']."','".$_POST['nMax']."','".$IDD."')";
                        if($conn->query($query)===TRUE){
                            echo "Corso aggiunto correttamente";
                            header('Refresh: 1; URL=./corsi.php?corsi=own');
                            exit;
                        }else{
                            header('Location:./error.php?page=addCorsi.html&err=Impossibile aggiungere corso');
                        }
                    }else{
                        header('Location:./error.php?page=addCorsi.html&err=Impossibile trovare docente');
                    }
                }
            }
        ?>
    </main>
</body>
</html>