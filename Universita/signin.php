<?php
    include "config.php";

    switch (sizeof($_POST)) {
        case 2: //TODO modifica
            $mail=$_POST['mail'];
            $pw=$_POST['pw'];

            $query="SELECT * FROM docente WHERE email='".$mail."'";
            $ris=$conn->query($query);
                if($ris->num_rows>0){
                    $row=$ris->fetch_assoc();
                    if(password_verify($pw, $row['pw'])){
                        session_start();
                        $_SESSION['email'] =$mail;
                        $_SESSION['fullName']=$row['Nome']." ".$row['Cognome'];
                        $_SESSION['type']="pro";
                        header("Location:./");
                        exit;
                    }else{
                        header('Location:./error.php?page=signin.html&err=Password sbagliata');
                        exit;
                    }
                }else{
                    $query="SELECT * FROM studente WHERE email='".$mail."'";
                    $ris=$conn->query($query);
                    if($ris->num_rows>0){
                        $row=$ris->fetch_assoc();
                        if(password_verify($pw, $row['pw'])){
                            session_start();
                            $_SESSION['email'] =$mail;
                            $_SESSION['fullName']=$row['Nome']." ".$row['Cognome'];  
                        $_SESSION['type']="stu";
                            header("Location:./");
                            exit;
                        }else{
                            header('Location:./error.php?page=signin.html&err=Password sbagliata');
                            exit;
                        }
                    }else{
                        header('Location:./error.php?page=signin.html&err=Utente non registrato');
                        exit;
                    }
                }
            break;
        case 5:
            $name=$_POST['fName'];
            $lname=$_POST['lName'];
            $fname=$name." ".$lname;
            $bdate=$_POST['bdate'];
            $mail=$_POST['mail'];
            $pw=password_hash($_POST['pw'], PASSWORD_DEFAULT);

            $query="INSERT INTO docente(`Nome`, `Cognome`, `bDate`, `Email`, `pw`) VALUES ('".$name."', '".$lname."', '".$bdate."', '".$mail."', '".$pw."')";

            if($conn->query($query)===TRUE){
                session_start();
                $_SESSION['email'] =$mail;
                $_SESSION['fullName']=$fname;
                $_SESSION['type']="pro";
                header("Location:./");
                exit;
            }else{
                header('Location:./error.php?page=signin.html&err=Errore');
            }
            break;
        case 6:
            $mat=$_POST['mat'];
            $name=$_POST['fName'];
            $lname=$_POST['lName'];
            $fname=$name." ".$lname;
            $bdate=$_POST['bdate'];
            $mail=$_POST['mail'];
            $pw=password_hash($_POST['pw'], PASSWORD_DEFAULT);

            $query="INSERT INTO studente(`Mat`, `Nome`, `Cognome`, `bDate`, `Email`, `pw`) VALUES ('".$mat."', '".$name."', '".$lname."', '".$bdate."', '".$mail."', '".$pw."')";

            if($conn->query($query)===TRUE){
                session_start();
                $_SESSION['email'] =$mail;
                $_SESSION['fullName']=$fname;
                $_SESSION['type']="stu";
                header("Location:./");
                exit;
            }else{
                header('Location:./error.php?page=signin.html&err=Errore');
            }
            break;
        default:
            header('Location:./error.php?page=signin.html&err=Dati non inseriti');
            exit;
    }
?>