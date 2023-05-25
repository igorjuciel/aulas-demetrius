<?php

include('conexao.php');

$login = isset($_POST['login']) ? $_POST['login'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';
$select = "select nome, login, senha from login where login = '$login' and senha = '$senha'";
$query=mysqli_query($conexao, $select);
$dados=mysqli_fetch_row ($query);
session_start();
$_SESSION['nome'] = $dados [0];

if ($login == $dados[1] && $senha == $dados[2]){
   header ('location:index.php');
}else { 
   header ('location:login.php');
}


?>     
