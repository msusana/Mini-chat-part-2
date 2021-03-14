<?php 
require_once(__DIR__."/../connection.php");
$stmt2 = $pdo->prepare("SELECT nickname, color FROM user");
$stmt2->execute(); 
$result2 = $stmt2->fetchAll();
foreach($result2 as $user) 
{ ?>
<p class='user'><span class='icono' style="background-color: <?=$user['color']?>;">🙂</span> <?=$user['nickname']?></p>
<?php }
?>