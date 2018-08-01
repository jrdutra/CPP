<?php
$host = "mysql.hostinger.com.br";
$user = "u249001907_cpp";
$pass = "Jrcdutra1";
$banco = "u249001907_cpp";
$tabela = "pacientes";
$conexao = mysqli_connect($host, $user, $pass) or die(mysqli_error($conexao));
mysqli_select_db($conexao,$banco) or die(mysqli_error($conexao));
mysqli_query($conexao,"SET NAMES 'utf8'");
mysqli_query($conexao,"SET character_set_connection=utf8");
mysqli_query($conexao,"SET character_set_client=utf8");
mysqli_query($conexao,"SET character_set_results=utf8");
?>


