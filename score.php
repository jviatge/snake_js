<?php 
    session_start();
    header("Content-Type: text/plain");
    
    if(isset($_SESSION['user_id'])){
            
        if (isset($_POST["score"])) {

            if($_SESSION['user_score'] < $_POST["score"]){

                $_SESSION['user_score'] = $_POST["score"];
                $id = $_SESSION['user_id'];
                $score = $_POST["score"];
    
                include ('conf.php');
         
                $query = $pdo->prepare('UPDATE profils SET best_score = ? WHERE (id = ?);');
    
                $query->execute([$score, $id]);
            }

        }

    } else {
        $error = "Error session";
    }

   
    //header('location: accueil.php');
   
    

?>