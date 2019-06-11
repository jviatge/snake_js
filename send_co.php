<?php

if (isset($_POST['co_username']) && isset($_POST['co_password'])){
    $username = $_POST['co_username'];
    $password = $_POST['co_password'];

    include ('conf.php');

    $query = $pdo->prepare('SELECT * FROM profils WHERE username = ?');
    
    $query->execute([$username]);

    if ($data = $query->fetch()){

        if (password_verify($password, $data['password'])){
            session_start();
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['user_name'] = $data['username'];
            $_SESSION['user_score'] = $data['best_score'];
            //$_SESSION['sign_in_time'] = time();
            header('location: game.php');

        } else {
            $error = "mot de passe ou username invalide";
        }
    } else {
        $error = "mot de passe ou username invalide";
    }
} 

if(isset($error)){
    header('location: connect.php?error='.$error);
} 
?>
