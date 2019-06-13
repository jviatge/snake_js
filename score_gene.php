<?php 

function score_gene(){
    include ('conf.php');

    $query = $pdo->prepare('SELECT username, best_score 
                            FROM profils ORDER BY best_score desc LIMIT 10');
    
    $query->execute();

    $tab = array();
    while($data = $query->fetch()){
        array_push($tab, $data['username']);
        array_push($tab, $data['best_score']);
    };
 
    return $tab;
}




?>