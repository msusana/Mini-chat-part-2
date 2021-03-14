<?php 
require_once(__DIR__."/../connection.php");

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