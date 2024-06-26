<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../Login/login.php");
    exit();
}
require "../Conexao/Conexao.php";

// Obtém o email da sessão
$email = $_SESSION['email'];

// Consulta para obter o id_func do usuário
$comando = "SELECT id_func FROM usuario WHERE email = '$email'";
$resultado = mysqli_query($conexao, $comando);

if ($resultado) {
    $usuario = mysqli_fetch_assoc($resultado);
    if ($usuario['id_func'] == 5) {
        header("Location: ../index.php");
        exit();
    }
} else {
    $_SESSION['erro'] = "Erro na consulta ao banco de dados";
    header("Location: ../Login/login.php");
    exit();
}

// Consulta para obter os banners da tabela UserForm
$sql = "SELECT IdUserForm, Titulo, Descricao, DtInicio, DtFinal, HrIni, HrFinal, pubAlv FROM UserForm";
$result = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banners</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="#"><img class="back-button" src="icons/back-button.svg" alt="Voltar"></a>
        <img src="icons/ifsp_logo_itp.png" alt="Instituto Federal" class="logo">
    </header>
    <div class="container">
        <h1>Ola <span><?php echo $_SESSION['nome']; ?>!</span></h1>
        <div class="banners">
            <h2>Banners</h2>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='banner'>";
                    echo "<a href='detalhes_banner.php?id=" . $row["IdUserForm"] . "'>";
                    echo "<h2>Responsável: " . $row["pubAlv"] . "</h2>";
                    echo "<h2>Título: " . $row["Titulo"] . "</h2>";
                    echo "<h2>Data de Entrada: " . $row["DtInicio"] . "</h2>";
                    echo "<h2>Data de Saída: " . $row["DtFinal"] . "</h2>";
                    echo "<h2>Hora de Entrada: " . $row["HrIni"] . "</h2>";
                    echo "<h2>Hora de Saída: " . $row["HrFinal"] . "</h2>";
                    echo "<h2>Descrição: " . $row["Descricao"] . "</h2>";
                    echo "</a>";
                    echo "</div>";
                }
            } else {
                echo "0 results";
            }
            mysqli_close($conexao);
            ?>
        </div>
    </div>
</body>
</html>
