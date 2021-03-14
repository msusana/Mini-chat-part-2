<?php
 
 require_once(__DIR__."/../connection.php");
session_start();
 
if (isset($_POST['nickname']) && isset($_POST['password'])) {
 
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM user WHERE nickname=:nickname");
    $stmt->bindParam("nickname", $nickname, PDO::PARAM_STR);
    $stmt->execute();
 
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if (!$result) {
        header("location: /login/ingreser.php?error= Le nom d'utilisateur est incorrecte!");
    } 
    else {
        if (password_verify($password, $result['password'])) {
            $_SESSION['user_id'] = $result['id'];
            header('location: /login/chatUser.php');
        } else {
            header("location: /login/ingreser.php?error=Le mot de passe ou le nom d'utilisateur est incorrecte!");
        }
    }
}
 
?>