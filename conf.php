<?php 
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=snake;charset=utf8', 'root', 'root');
    } catch (Exception $exception){
        
        die($exception->getMessage());
       
    }
    
?>
