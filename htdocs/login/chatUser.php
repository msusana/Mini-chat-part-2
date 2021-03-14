<?php
session_start();
 
if(!isset($_SESSION['user_id'])){
    header('Location: checkIn.php');
    exit;
} else {
    $id=$_SESSION['user_id'];
}
require_once(__DIR__."/../connection.php");
include './../recuperation_donnees/insert_sms.php';

$stmt= $pdo->prepare("SELECT * FROM user WHERE id = :id");
$stmt->bindParam("id", $id, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="/style2.css?v=<?php echo time(); ?>">
    <title>chat</title>
    <div class='row' id='nav'>
         <div class="col-8">
            <a class="btn btn-outline-success" href="#"> 📮 </a>
        </div>
        <div class="col-3">
            <a class="btn btn-outline-success active" href="/../index.php">chat</a>
            <a class="btn btn-outline-success" href="/../index.php">Me deconnecte</a>
        
    </div>
    </div>
</head>

<body>
<h1><span class='icono' style="background-color: <?=$result['color']?>;">👤</span> <?=$result['nickname']?> </h1>
    <div class='container'>
        <div class='item1'>
            <h2>Chats</h2>
        </div>


    <div class='item2'>
        <h3> Utilisateurs</h3>
            <div id='user'>
<?php 
$stmt2 = $pdo->prepare("SELECT nickname, color FROM user");
$stmt2->execute(); 
$result2 = $stmt2->fetchAll();
foreach($result2 as $user) 
{ ?>
<p class='user'> <span class='icono' style="background-color: <?=$user['color']?>;">🙂</span> <?=$user['nickname']?></p>
<?php }
?>
            </div>
    </div>


    <div class='item3'>
        <h3>Messages</h3>
            <table class="table">

                <thead>
                    <tr>
                    <th>Pseudo</th>
                    <th>message</th>
                    <th>date</th>         
                    </tr>
                </thead>


                <tbody id="messages">

    <?php 
    $stmt1 = $pdo->prepare("SELECT * FROM user JOIN message ON user.id = message.user_id ORDER BY created_at DESC");
    $stmt1->execute(); 
    $result1 = $stmt1->fetchAll();
    foreach($result1 as $sms) 
    { ?>
    <tr style="background-color: <?=$sms['color']?>;">
        <td><?=$sms['nickname']?></td>
        <td><?=$sms['message']?></td>
        <td><?=$sms['created_at']?></td>
    </tr>
    <?php }
    ?>

                </tbody>
            </table>
    </div>

    <div class='item5'> 
                <input type='hidden' name='nickname' id='nickname' value='<?=$result['nickname']?>'>   
                <label class='message' for='message' >Message</label>
                <textarea type='text' id='message' class='form-control' name='message' required placeholder="message"></textarea>
                <input type='hidden' name='color' id='color' value='<?=$result['color']?>'>   
                <button class='btn btn-success float-end' name='msg_text' onclick="sendMessage()">Send</button>
    </div>
        
    </div>

    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js' integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>    
    <script src="/javascript.js"></script>
    <script src="/javascript2.js"></script>
</body>    
</html>