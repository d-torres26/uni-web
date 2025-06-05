<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creazione esame</title>
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
            if($_SERVER['REQUEST_METHOD']=="POST"){
                include "config.php";
                $query="INSERT INTO Esame(Nome, Arg, Tipologia, IDC) VALUES('".$_POST['nome']."','".$_POST['arg']."','".$_POST['type']."','".$_POST['idc']."')";
                if($conn->query($query)===TRUE){
                    echo 'Esame aggiunto correttamente';
                    header('Refresh: 1; URL=./'.$_POST['page'].'');
                    exit;
                }else{
                    header('Location:./error.php?page='.$_POST['page'].'&err=Impossibile aggiungere esame');
                    exit;
                }
            }
        ?>
    </main>
</body>
</html>