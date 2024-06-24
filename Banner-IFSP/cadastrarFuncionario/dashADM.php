<?php

require "conexao.php";

$sql = "SELECT Id, nomeFunc FROM funcao";
$result = $conn->query($sql);

$funcoes = [];
if ($result === false) {
    echo "Error: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $funcoes[] = $row;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anuncios</title>
    <style>
        /* Inclua aqui o seu código de estilo existente */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: var(--grey--if);
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        header {
            width: 100%;
            padding: 4vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: var(--white--if);
            border-bottom: 1px solid var(--border--if);
            /* position: sticky; */
            top: 0;
        }

        .back-button {
            width: 44px;
            text-decoration: none;
            color: var(--black--if);
        }

        .logo {
            width: 90px;
            height: 90px;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: var(--white--if);
            padding: 2px; /* Adiciona um padding para dar um espaçamento interno */
            margin-top: -10vh;
        }

        .container h1 {
            font-size: 86px;
            color: #0E194D;
        }

        .container .descer {
            font-size: 86px;
            color:#008000;
            margin-right: 30vh;
            margin-top: -2vh;
        }

        form {
            align-items: start;
            display: flex;
            flex-direction: column;
            margin-top: 1vh;
        }

        form input {
            width: 50vh;
            padding: 1vh;
        }

        form label {
            margin-top: 5%;
            margin-bottom: 1%;
        }

        form textarea {
            padding: 3vh;
            width: 50vh;
        }

        form select {
            padding: 1vh;
            width: 50vh;
        }

        .hidden-upload {
            display: none;
        }

        .custom-upload {
            border: 1px solid black;
            padding: 1vh;
            border-radius: 1vh;
        }

        form button {
            margin-top: 1vh;
            margin-bottom: 1vh;
            color: white;
            background-color:#008000 ;
            font-weight: bold;
            border: none;
            border-radius: 2vh;
            width: 40%;
            padding: 1vh;   
        }
    </style>
    <script>
        function validateForm() {
            var nome = document.getElementById('nome').value;
            var prontuario = document.getElementById('prontuario').value;
            var cpf = document.getElementById('cpf').value;
            var email = document.getElementById('email').value;
            var senha = document.getElementById('senha').value;
            var senhaconfrimada = document.getElementById('senhaconfrimada').value;
            var funcao = document.getElementById('funcao').value;

            if (!nome || !prontuario || !cpf || !email || !senha || !senhaconfrimada || !funcao) {
                alert('Por favor, preencha todos os campos.');
                return false;
            }

            if (senha !== senhaconfrimada) {
                alert('As senhas não coincidem.');
                return false;
            }

            var cpfPattern = /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/;
            if (!cpfPattern.test(cpf)) {
                alert('Por favor, insira um CPF válido no formato XXX.XXX.XXX-XX.');
                return false;
            }

            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert('Por favor, insira um email válido.');
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <header>
        <a href="#"><img class="back-button" src="assets/back-button.svg" alt="Voltar"></a>
        <img src="assets/ifsp_logo_itp.png" alt="Instituto Federal" class="logo">
    </header>
    <div class="container">
        <h1>Cadastre-se</h1>
        <h1 class="descer">Aqui</h1>
        <form action="dashADMBack.php" method="post" onsubmit="return validateForm();">
            <label for="nome">Nome completo:</label>
            <input type="text" id="nome" name="nome" placeholder="Ex: Lucas Oliveira Ortins">

            <label for="prontuario">Prontuario:</label>
            <input type="text" id="prontuario" name="prontuario" placeholder="Ex: IT3434XXXX">

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" placeholder="Ex: 784.930.023-90">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Ex: aluno@ifsp.edu.gov.br">

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha">

            <label for="senhaconfrimada">Confirme sua senha: </label>
            <input type="password" id="senhaconfrimada" name="senhaconfrimada">

            <label for="funcao">Função:</label>
            <select id="funcao" name="funcao">
                <?php foreach ($funcoes as $funcao): ?>
                    <option value="<?php echo htmlspecialchars($funcao['Id']); ?>"><?php echo htmlspecialchars($funcao['nomeFunc']); ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
