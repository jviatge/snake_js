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
//            header("HTTP/1.1 301 Moved Permanently");
            header("location: http://www.julien-viatge.fr/snake/game.php");
            exit();
        } else {
            $error = "Wordpass or username not valid";
        }
    } else {
        $error = "Wordpass or username not valid";
    }
} 

if(isset($error)){
//    header("HTTP/1.1 301 Moved Permanently");
    header('location: http://www.julien-viatge.fr/snake/index.php?error='.$error);
    exit();
} 
?>
