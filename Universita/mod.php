<?php
    function error(){
        header('Location:./error.php?page=dataMod.php&err=Errore');
        exit;
    }
    include "config.php";
    session_start();
    $query="UPDATE";
    if($_SESSION['type']=="stu"){
        $query.=" `studente`";
        if(sizeof($_POST)>2){
            $query.=" SET `Mat`='".$_POST['mat']."',`Cognome`='".$_POST['lName']."',`Nome`='".$_POST['fName']."',`bDate`='".$_POST['bdate']."',`Email`='".$_POST['mail']."' ";
        }else{
            $qry="SELECT * FROM studente WHERE email='".$_SESSION['email']."'";
            $ris=$conn->query($qry);
            if($ris->num_rows>0){
                $row=$ris->fetch_assoc();
                if(password_verify($_POST['oldPW'], $row['pw'])){
                    $query.="SET pw='".password_hash($_POST['pw'], PASSWORD_DEFAULT)."' ";
                }else{
                    error();
                }
            }
        }
    }else{
        $query.=" `docente`";
        if(sizeof($_POST)>2){
            $query.=" SET `Cognome`='".$_POST['lName']."',`Nome`='".$_POST['fName']."',`bDate`='".$_POST['bdate']."',`Email`='".$_POST['mail']."' ";
        }else{
            $qry="SELECT * FROM docente WHERE email='".$_SESSION['email']."'";
            $ris=$conn->query($qry);
            if($ris->num_rows>0){
                $row=$ris->fetch_assoc();
                if(password_verify($_POST['oldPW'], $row['pw'])){
                    $query.="SET pw='".password_hash($_POST['pw'], PASSWORD_DEFAULT)."' ";
                }else{
                    error();
                }
            }
        }
    }
    $query.="WHERE Email='".$_SESSION['email']."'";
    if($conn->query($query)===TRUE){
        echo 'Dati modificati';
        header('Refresh: 1; URL=./data.php');
        exit;
    }else{
        error();
    }
?>