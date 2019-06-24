<?php 
    session_start();
    header("Content-Type: text/plain");
    
    if(isset($_SESSION['user_id'])){
            
        if (isset($_POST["token"])){

            $id = $_SESSION['user_id'];
            $score = $_POST["token"];

            include ('conf.php');
        
            $query = $pdo->prepare('UPDATE profils SET token = ? WHERE (id = ?);');

            $query->execute([$score, $id]);
        } 

    } else {
        $error = "Error";
    }

   
    //header('location: accueil.php');
   
    

?>