<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Homepage</title>
</head>
<body>
    <header>
        <form action="./" method="get" >
            <button type="submit" id="hp">
                <img src="./images/icon.png" alt="Homepage">
                <h1>Università</h1>
            </button>
        </form>
        <?php
            session_start();
            if(isset($_SESSION['fullName'])){
                echo "<a href=\"./areaRiservata.php\">".$_SESSION['fullName']."</a>";
            }else{
                echo "<form action=\"./signin.html\" method=\"get\"><input type=\"submit\" value=\"Log in/Sign in\"></form>";
            }
        ?>
    </header>
    <main>
        <a href="./searchStu.html"><button>Ricerca informazioni sugli studenti</button></a>
        <a href="./corsi.php"><button>Lista corsi</button></a>
        <a href="./docenti.php"><button>Lista docenti</button></a>
        <a href="./studenti.php"><button>Lista studenti</button></a>
        <?php
            if(isset($_SESSION['fullName'])){
                echo "<a href=\"./esami.php\"><button>I miei esami</button></a>";
            }
        ?>
    </main>
</body>
</html>