<?php
require_once(__DIR__."/../connection.php");
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
</head>

<body>
<?php 
if(!empty($_GET['error'])){
    echo '<div class="alert alert-danger " role="alert">'
    .$_GET['error']. 
    '</div>';
}
?>
 
 <form class='ingreser' action='/recuperation_donnees/validation.php'method="POST">
   
                <label class='nickname' for='nickname'>Pseudo</label>
                <input type='text' id='nickname' class='form-control' name='nickname' required>
                   
                <label class='password' for='password' >Mot Passe</label>
                <input type='password' id='password' class='form-control' name='password' required>
                <button class='btn btn-success'>Valider</button> 
</form> 

    
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js' integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script> 
</body>    
</html>
