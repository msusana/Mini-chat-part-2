<?php
session_start();
require __DIR__."/../connection.php";

if (isset($_POST['nickname']) && isset($_POST['password'])){
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $color=$_POST['color'];
    checkPasswords($pdo ,$password, $password2);
}   
    if (checkPasswords($pdo ,$password, $password2)==true) {
        checkNickname($pdo, $nickname);{ 
        if(checkNickname($pdo, $nickname)==true){
              insert($pdo, $nickname, $password_hash, $color)
              
              
              ==false);{
                echo '<p> Le pseudo  existe déjà</p>';
        }
    }
}

function checkPasswords($password, $password2) {
    if ($password!= $password2) {
        
        echo '<div id="error" class="alert alert-danger " role="alert">
        Les mots de passe ne correspondent pas, réessayez!
        </div>';
        include ('checkIn.php');
        return false;
    }else {
        return true;
    }
}

function checkNickname($pdo, $nickname){ 
        $stmt = $pdo->prepare("SELECT * FROM user WHERE nickname=:nickname");
        $stmt->bindParam("nickname", $nickname, PDO::PARAM_STR);
        $stmt->execute(); 
    
        if ($stmt->rowCount() > 0) {
            return true;
            
        }
        else{
            return false;
        }
    }

function insert($pdo, $nickname, $password_hash, $color){
     $stmt = $pdo->prepare("INSERT INTO user (nickname, password, ip_adress, color) VALUES (?,?,?,?)");
            $result = $stmt->execute([
                $nickname,
                $password_hash,
                $_SERVER['REMOTE_ADDR'],
                $color
            ]);
    
            if ($result) {
                include ('ingreser.php');
                echo '<p>Votre inscription a réussi!</p>';
            } else {
                return false;
            }
}

  
?>