<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Errore</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        if(isset($_GET['err'])){
            echo "<header>
                <form action=\"./\" method=\"get\" >
                    <button type=\"submit\" id=\"hp\">
                        <img src=\"./images/icon.png\" alt=\"Homepage\">
                        <h1>Università</h1>
                    </button>
                </form>
            </header>";
            echo "<main><h1 id=\"errore\">".$_GET['err']."</h1></main>";
            header ("Refresh: 1, URL=".$_GET['page']."");
        }else{
            header("Location: ./");
        }
    ?>
</body>
</html>