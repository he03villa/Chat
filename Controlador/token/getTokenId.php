<?php
    require '../../Modelo/Token.php';
    $user = $_GET['user'];
    $token = new Token();
    $res = $token->getTokenId($user);
    if($res){
        echo $res['tokens'];
    }
    else echo json_encode(array('resultado'=>'El usuario no existe'));
?>