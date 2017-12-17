<?php
    require '../../Modelo/Token.php';
    $token = new Token();
    $res = $token->Lista();
    echo json_encode($res);
?>