<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Mini jeux</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='anim.css'>
    <!-- <script src='oXHR.js'></script> -->
</head>
<body>
<script type="text/javascript">
(function () { 
    // --------------------------------
        let score = 0;
        let move;
        let point = 0;
        
        let spawn;
        let lock = 0;

        let tab_y = new Array();
        let tab_x = new Array();   

        let y_p;
        let x_p;

        let comptage = 0;
        let tab = [];

        let speed = 200;
        let xhr = new XMLHttpRequest();
 
    // --------------------------------   

        function bloc_spawn_y(){
            let bloc = document.getElementById("bloc_1");
        
            if(bloc.style.display == "" ||bloc.style.display == "none" ){     
                bloc.style.display = "inline-block";
            } 
            let y = 40 * (Math.floor(Math.random() * (18 - 0 + 1)) + 0);
            bloc.style.top = y + "px";
            point = 0;
            return bloc.style.top;
        }

        function bloc_spawn_x(){
            let bloc = document.getElementById("bloc_1");
        
            if(bloc.style.display == "" ||bloc.style.display == "none"){               
                bloc.style.display = "inline-block";
            } 
            let x = 40 * (Math.floor(Math.random() * (18 - 0 + 1)) + 0);
 
            bloc.style.left = x + "px";
            point = 0;
            return bloc.style.left;
        }

    // --------------------------------

        function move_top(){
            let player_1 = document.getElementById("player_1");
            let position_style =  player_1.style.top;
            let position = parseFloat(position_style);
                if(Number.isInteger(position)){
                    let total_pos = position - 40;  
                    if(total_pos < 0){
                        player_1.style.top = "720px";
                    } else {
                        player_1.style.top = total_pos + "px";
                    }
                } else {
                player_1.style.top = 320 + "px";
                }
                return player_1.style.top;
        }

        function move_left(){
            let player_1 = document.getElementById("player_1");
            let position_style =  player_1.style.left;
            let position = parseFloat(position_style);
                if(Number.isInteger(position)){
                    let total_pos = position - 40;
                    if(total_pos < 0){
                        player_1.style.left = "720px";  
                    } else {
                        player_1.style.left = total_pos + "px";
                    }
                } else {
                    player_1.style.left = 320 + "px";
                }
                return player_1.style.left;
        }
        
        function move_bottom(){
            let player_1 = document.getElementById("player_1");
            let position_style =  player_1.style.top;
            let position = parseFloat(position_style);
                if(Number.isInteger(position)){
                    let total_pos = position + 40;
                    if(total_pos > 720){
                        player_1.style.top = "0px";
                    } else {
                        player_1.style.top = total_pos + "px";
                    }
                } else {
                    player_1.style.top = 400 + "px";
                }

            return player_1.style.top;
        }
        
        function move_right(){
            let player_1 = document.getElementById("player_1");
            let position_style =  player_1.style.left;
            let position = parseFloat(position_style);
                if(Number.isInteger(position)){
                    let total_pos = position + 40;
                    if(total_pos > 720){
                        player_1.style.left = "0px";    
                    } else {
                        player_1.style.left = total_pos + "px";
                    }
                } else {
                    player_1.style.left = 400 + "px";
                }
                return player_1.style.left;
        }

    // --------------------------------

        function regroup_bottom(){  
            follow_tail();

            let bloc = document.getElementById("bloc_1");
            let player_1 = document.getElementById("player_1");

            x_p = move_bottom();
            y_p = player_1.style.left;

            tab_y.push(y_p);
            tab_x.push(x_p);

            let x = bloc.style.top;
            let y = bloc.style.left;

            player_1.style.transform = "rotate(180deg)";

            if(y_p == y && x_p == x && point == 0){
                 anmi_croc();
                 heat_bloc();
                 point = 1;
            }
        }
        
        function regroup_top(){  
            follow_tail();
            
            let bloc = document.getElementById("bloc_1");
            let player_1 = document.getElementById("player_1");

            x_p = move_top();
            y_p = player_1.style.left;

            tab_y.push(y_p);
            tab_x.push(x_p);

            let x = bloc.style.top;
            let y = bloc.style.left;

            player_1.style.transform = "rotate(0deg)";

            if(y_p == y && x_p == x && point == 0){             
                 anmi_croc();
                 heat_bloc();
                 point = 1;
            }
        }
        
        function regroup_right(){  
            follow_tail();
        
            let bloc = document.getElementById("bloc_1");
            let player_1 = document.getElementById("player_1");

            y_p = move_right();
            x_p = player_1.style.top;

            tab_y.push(y_p);
            tab_x.push(x_p);

            let x = bloc.style.top;
            let y = bloc.style.left;

            player_1.style.transform = "rotate(90deg)";

            if(y_p == y && x_p == x && point == 0){
                 anmi_croc();
                 heat_bloc();
                 point = 1;
            } 
        }
        
        function regroup_left(){  
            follow_tail();
        
            let bloc = document.getElementById("bloc_1");
            let player_1 = document.getElementById("player_1");

            y_p = move_left();
            x_p = player_1.style.top;

            tab_y.push(y_p);
            tab_x.push(x_p);

            let x = bloc.style.top;
            let y = bloc.style.left;

            player_1.style.transform = "rotate(270deg)";

            if(y_p == y && x_p == x && point == 0){
                 anmi_croc();
                 heat_bloc();
                 point = 1;
            }
        }

    // --------------------------------       
        
        function heat_bloc(){
        
                let bloc = document.getElementById("bloc_1");

                let score_html = document.getElementById("score");
                score++;
                if (score < 50) {
                    speed = speed - 5;
                }
                score_html.textContent = score;
                
                bloc.style.display = "none";
                tail_snake();           
        }    

        function follow_tail(){
        
        
            let player_1 = document.getElementById("player_1");
            let block = document.getElementsByClassName("block_2");

            y_p = player_1.style.left;
            x_p = player_1.style.top;

            let spwan_block = tab_y.length - block.length;
            let c = 0;

            for (let i = tab_y.length - 1; i >= spwan_block; i--) {
                if(block[c].style.left == y_p && block[c].style.top == x_p){
                    end_game();
                }
                block[c].style.left = tab_y[i];
                block[c].style.top = tab_x[i];

                if(block[c].style.display == ""){
                    block[c].style.display = "inline-block";
                }
                c++;
            }            

        }

        function tail_snake(){
            let frame = document.getElementById("frame_game");
            let longuer = document.createElement('div');

            longuer.setAttribute("class", "block_2");
            //setInterval(follow_tail, 500);
            frame.appendChild(longuer);
        }

        function end_game(){
            let score = document.getElementById("score");
            let end_score = score.textContent;

            
            console.log(end_score);
            speed = 200;
            clearInterval(move);
            clearInterval(spawn);
            
            xhr.onreadystatechange = function() {
                console.log(this);
                if (this.readyState == 4 && this.status == 404){
                    alert('erreur 404 :/');
                }
            };

            xhr.open("POST", "score.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("score=" + end_score);

            alert("FIN DU GAME score: " + end_score);
            document.location.reload(true);
        }
    
    // --------------------------------
 
        function anmi_croc(){
            let miette = document.getElementsByClassName("croc");
            miette[0].classList.add("frag1");
            miette[1].classList.add("frag2");
            miette[2].classList.add("frag3");
        setTimeout(function(){
            miette[0].classList.remove("frag1");
            miette[1].classList.remove("frag2");
            miette[2].classList.remove("frag3");
                    }, 500);
        }
 
    // --------------------------------

        spawn = setInterval(bloc_spawn_y, 5200);
        spawn = setInterval(bloc_spawn_x, 5200);
        
        document.addEventListener('keypress', function(event){
                       
            // console.log(event.which, String.fromCharCode(event.which));
                  
            let key = event.which;       
            
            switch(key){
                case 115:
                    if(lock != 122 && lock != 115){
                    clearInterval(move);
                    move = setInterval(regroup_bottom, speed);
                    setTimeout(function(){lock = 115;}, speed);     
                }
                break;

                case 122:
                    if(lock != 115 && lock != 122){
                    clearInterval(move);
                    move = setInterval(regroup_top, speed);
                    setTimeout(function(){lock = 122;}, speed); 
                }
                break;


                case 100:
                    if(lock != 113 && lock != 100){
                    clearInterval(move);
                    move = setInterval(regroup_right, speed);
                    setTimeout(function(){lock = 100;}, speed);
                }
                break;


                case 113:
                    if(lock != 100 && lock != 113){
                    clearInterval(move);
                    move = setInterval(regroup_left, speed);
                    setTimeout(function(){lock = 113;}, speed);
                }
                break;

                // case 32:
                //     clearInterval(move);
                // break
            }
            
        });
    })();
</script>



<div id="frame_game">
    <div class="bloc" id="bloc_1"></div>
    <div id="player_1">
            <div class="croc" id="frag1">
            </div>
            <div class="croc" id="frag2">
            </div>
            <div class="croc" id="frag3">
            </div>
        </div>
    </div>

    <div class="score">
        <p><?php 
            if(isset($_SESSION['user_name'])){
                echo $_SESSION['user_name']; 
            } else {
                echo "<p>Inconu</p><br>"; 
                echo "<a href=\"index.php\">Connect/register</a>";

            }?></p><br>
        
        <p>SCORE :</p>
        <span id="score">0</span>
        <?php if(isset($_SESSION['user_name'])){
                echo '<p>YOUR BEST SCORE :</p>';
                echo '<p>'.$_SESSION['user_score'].'</p>'; 
        }?>
    </div>
    <p>V 1.01</p>
</body>
</html>