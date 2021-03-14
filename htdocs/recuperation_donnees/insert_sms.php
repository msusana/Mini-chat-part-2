<?php

require_once(__DIR__."/../connection.php");

if (isset($_POST['nickname']) && isset($_POST['message'])){
   
    $message = $_POST['message']; 
    $nickname = $_POST['nickname'];
    $color = $_POST['color'];

    // Récuperation de l'utilisateur 
    $stmt = $pdo->prepare("SELECT * FROM user WHERE nickname=?");
    $stmt->execute([$nickname]); 
    $nickNameVerification = $stmt->fetch(PDO::FETCH_ASSOC);

    // si la recuperation de l'utilisateur retourne un tableau vide 
    // Créer un nouvel utilisateur 


    //Envoi du message 

    if ($nickNameVerification) {
        $insertMessage = $pdo->prepare(
            'INSERT INTO `message`
            (`message`, `user_id`)
            VALUES
            (?, ?);
            ');
            
            $insertMessage->execute([ 
            $message,
            $nickNameVerification['id']
            ]);
    } 


    else { 
    $insertNickname = $pdo->prepare(
        'INSERT INTO user
    (nickname, ip_adress, color)
    VALUES
    (?,?,?);
    ');

    $insertNickname->execute([ 
    $nickname,
    $_SERVER['REMOTE_ADDR'],
    $color
    ]);

    $lastId= $pdo->lastInsertId();


    $insertMessage = $pdo->prepare(
    'INSERT INTO `message`
    (`user_id`, `message`)
    VALUES
    (?,?);
    ');

    $insertMessage->execute([ 
    $lastId,
    $message
    ]);
    } 
}