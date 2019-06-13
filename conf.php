<?php
    try {
        $pdo = new PDO('mysql:host=julienviisjv.mysql.db;dbname=julienviisjv;charset=utf8', 'julienviisjv', 'Westlifemyst69');
    } catch (Exception $exception){
        
        die($exception->getMessage());
        
    }
    
?>

