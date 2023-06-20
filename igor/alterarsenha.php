<?php
session_start();

// Verifique se o usuário está autenticado
if (!isset($_SESSION['nome'])) {
    header("Location: login.php"); // Redireciona para a página de login se não estiver autenticado
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Realize a conexão com o banco de dados
    $conexao = mysqli_connect('localhost', 'root', '', 'bancoa3','3306');

    // Verifique se a conexão foi estabelecida corretamente
    if (!$conexao) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Recupere os dados do formulário
    $novasenha = $_POST['nova_senha'];
    $confirmarsenha = $_POST['confirmar_senha'];

    // Verifique se a nova senha e a confirmação correspondem
    if ($novasenha !== $confirmarsenha) {
        die("A nova senha e a confirmação da senha não correspondem.");
    }

    // Execute a lógica para atualizar a senha no banco de dados
    $nomeUsuario = $_SESSION['nome']; // Assumindo que o campo 'nome' é usado como identificador único na tabela de usuários
    $senhaHash = $novasenha;

    $sql = "UPDATE login SET senha = '$senhaHash' WHERE nome = '$nomeUsuario'";
    if (mysqli_query($conexao, $sql)) {
        echo "Senha atualizada com sucesso!";
        echo '<br><br>';
        echo '<a href="login.php">Voltar para a página de login</a>'; // Botão para voltar para a página de login
    } else {
        echo "Erro ao atualizar a senha: " . mysqli_error($conexao);
    }

    // Feche a conexão com o banco de dados
    mysqli_close($conexao);
}
?>


<html>
<head>
  <style>
    body {
        margin: 0px;
    padding: 0px;
}    
body{
    background-position: 50
    color: black;
    font-family: arial;
    
    

}    
input{

    display: block;
    height: 55px;
    width: 300px;
    margin: 10px;
    border-radius: 30px;
    border: 1px solid black;
    font-size: 16pt;
    padding: 10px 20px;
    background-color: rgba(255,255,255,0.09);
    color: black;
}

div#corpo-form{
    /*background-color: yellow;\*/
    width: 420px;
    margin: 130px auto 0px auto;
}

div#corpo-form-Cad{
    /*background-color: yellow;\*/
    width: 420px;
    margin: 50px auto 0px auto;
}    


div#corpo-form h1, div#corpo-form-Cad h1{
    text-align: center;
    padding: 20px;

}

a{
    color: black;
    text-decoration: none;
    text-align: center;
    display: block;

}

a:hover{
    text-decoration: underline;
}

input[type=submit]{
    background-color: blue;
    border: none;
    cursor: pointer;

}

::-webkit-input-placeholder{
	color: #fff;
}
::-moz-placeholder{
	color: #fff;
}    
    
  </style>
</head>

<body>
  <center>
    
    <h1>Alterar Senha</h1>
    <form method="POST" action="alterarsenha.php">
      <label for="nova_senha">Nova senha:</label>
      <input type="password" name="nova_senha" id="nova_senha" required>

      <label for="confirmar_senha">Confirmar nova senha:</label>
      <input type="password" name="confirmar_senha" id="confirmar_senha" required>

      <input type="submit" value="Alterar Senha">
    </form>
  </center>
</body>

</html>