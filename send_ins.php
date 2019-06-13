<?php 

    if (isset($_POST['ins_username']) &&
        isset($_POST['ins_password']) &&
        isset($_POST['ins_password_repeat'])){
    
            
        if($_POST['ins_password'] == $_POST['ins_password_repeat']){
    
            
                $ins_username = $_POST['ins_username'];
                $ins_password = password_hash($_POST['ins_password'], PASSWORD_DEFAULT);
    
                include ('conf.php');
     
                $query = $pdo->prepare('INSERT INTO profils (username, password) VALUE (?, ?)');
    
                $query->execute([$ins_username, $ins_password]);
                
                $query_error = $query->errorInfo();
                if($query_error[0] != "00000"){
                    if($query_error[1] == 1062){
                        $error = "Utilisateur déjà utiliser";
                    } else {
                        die("Erreur de connexion a la bdd");
                    }
                }
            
        } else {
            $error = "Wrong password !";
            }
    } else {
        $error = "Error form not conplet";
    }

    if(isset($error)){
        header('location: index.php?error='.$error);
    } else {
        header('location: index.php');
    }

?>

