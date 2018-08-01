<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "cpp";
$tabela = "pacientes";
$conexao = mysqli_connect($host, $user, $pass) or die(mysqli_error($conexao));
mysqli_select_db($conexao,$banco) or die(mysqli_error($conexao));
mysqli_query($conexao,"SET NAMES 'utf8'");
mysqli_query($conexao,"SET character_set_connection=utf8");
mysqli_query($conexao,"SET character_set_client=utf8");
mysqli_query($conexao,"SET character_set_results=utf8");
?>


