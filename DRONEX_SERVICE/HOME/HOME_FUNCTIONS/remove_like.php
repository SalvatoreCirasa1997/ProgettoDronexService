<?php
session_start(); 
if(!isset($_SESSION['Dronex_Service_username'])){ 
    header('Location: ../../LOGIN/login.php');
    exit;
}

    //verifica dati POST
if(isset($_POST["Drone_ID"])){
    //connessione al db
    $conn = mysqli_connect("localhost","root","","DronexService");
    //Aggiungi evento al DB
    $id = mysqli_real_escape_string($conn,$_POST["Drone_ID"]);
    $user = $_SESSION['Dronex_Service_user_ID'];
    mysqli_query($conn,"DELETE FROM likes WHERE ID_utente = '$user' AND ID_drone = '$id'");

    $query="SELECT likes FROM likes_totali WHERE ID_drone = '$id' ";
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
     $entry = mysqli_fetch_assoc($res);
     $returndata = array('ok' => true, 'nlikes' => $entry['likes']);
     echo json_encode($returndata);
     mysqli_close($conn);
     exit;
    }
    mysqli_close($conn);
    echo json_encode(array('ok' => false));
}

?>