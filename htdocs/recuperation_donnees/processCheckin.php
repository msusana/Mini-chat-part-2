<?php
session_start();
require __DIR__."/../connection.php";

if (isset($_POST['nickname']) && isset($_POST['password'])){
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $color=$_POST['color'];
    checkPasswords($pdo ,$password, $password2, $password_hash, $nickname, $color );
}

function checkPasswords($pdo, $password, $password2, $password_hash, $nickname, $color) {
    if ($password!= $password2) {
        header("location: /login/checkIn.php?error=Les mots de passe ne correspondent pas, réessayez!");
    }else {

        $stmt = $pdo->prepare("SELECT * FROM user WHERE nickname=:nickname");
        $stmt->bindParam("nickname", $nickname, PDO::PARAM_STR);
        $stmt->execute(); 
    
        if ($stmt->rowCount() > 0) {
             header("location: /login/checkIn.php?error=Le pseudo existe déjà");
        }
        else{
            $stmt = $pdo->prepare("INSERT INTO user (nickname, password, ip_adress, color) VALUES (?,?,?,?)");
            $result = $stmt->execute([
                $nickname,
                $password_hash,
                $_SERVER['REMOTE_ADDR'],
                $color
            ]);
    
            if ($result) {
                header("location: /login/ingreser.php?error=Votre inscription a réussi!");
        
            } else {
                header("location: /login/checkIn.php?error=Un problème est survenu!");
        }
    }  }
}
  
?>