<?php 
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Accueil</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
</head>
<body>

<div id="frame_game">
    <div class="container_accueil">
        <h1>Sn@ke by Satannas</h1>
        <form action="send_co.php" method="post" class="connect">
                <label for="co_username">
                    Username :
                    <input class="case" type="text" name="co_username" id="co_username" required>
                </label>
                <label for="co_password">
                    Password : 
                    <input class="case" type="password" name="co_password" id="co_password" required>
                </label>
                <input class="button" type="submit" value="Play !">
            </form>
        </div>
    </div>
    <a href="game.php">Ignore and just play !</a>

    <form class="register" action="send_ins.php" method="POST">
            <h2>Register you !</h2>
            <label for="ins_username">
                Username :
                <input class="case" type="text" name="ins_username" id="ins_username" required>
            </label>
            <label for="ins_password">
                Password : 
                <input class="case" type="password" name="ins_password" id="ins_password" required>
            </label>
            
            <label for="ins_password_repeat">
                Repeat password : 
                <input class="case" type="password" name="ins_password_repeat" id="ins_password_repeat" required>
            </label>
            <input class="button" type="submit" value="register">
    </form>
    <p>V 1.01</p>


    
</body>
</html>