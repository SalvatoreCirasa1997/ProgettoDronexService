<?php
        session_start(); 
        if(!isset($_SESSION['Dronex_Service_username'])){ 
            header('Location: ../../LOGIN/login.php');
            exit;
        }


        $conn=mysqli_connect('localhost','root','','DronexService');
        $response=array();
        $i=0;
        $error = false;
        $query = "SELECT * FROM spedizioni WHERE stato = 2 ";
        $res= mysqli_query($conn,$query);
         
        while($row = mysqli_fetch_assoc($res)){
            $response[$i]['codice_spedizione'] = $row['codice_spedizione'];
            $response[$i]['data_spedizione'] = $row['data_spedizione'];
            $response[$i]['id_mittente'] = $row['id_mittente'];
            $response[$i]['stato'] = $row['stato'];
            $response[$i]['drone_Spedizione'] = $row['drone_Spedizione'];
            $i++;
        }

        if($i > 0){
        echo json_encode($response);
        mysqli_free_result($res);
        mysqli_close($conn);
        exit;
        }

        else{
        mysqli_close($conn);
        echo json_encode($error);
        }
?>