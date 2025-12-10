<?php
session_start();
include('conexao.php');

if (!isset($_GET['id'])) {
    $_SESSION['mensagem'] = "ID não informado!";
    header("Location: tela_alunos.php");
    exit();
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM cad_aluno WHERE id = $id";
$result = mysqli_query($conexao, $sql);
$aluno = mysqli_fetch_assoc($result);

if (!$aluno) {
    $_SESSION['mensagem'] = "Aluno não encontrado!";
    header("Location: tela_alunos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
    <h2>Editar Aluno</h2>

    <form action="salvar_edicao.php" method="POST">
        <input type="hidden" name="id" value="<?= $aluno['id'] ?>">

        <label>Nome:</label>
        <input type="text" name="nome_completo" class="form-control" value="<?= $aluno['nome_completo'] ?>">

        <label>Cidade:</label>
        <input type="text" name="cidade" class="form-control" value="<?= $aluno['cidade'] ?>">

        <label>Curso:</label>
        <input type="text" name="curso_nome" class="form-control" value="<?= $aluno['curso_nome'] ?>">

        <button type="submit" class="btn btn-primary mt-3">Salvar</button>
    </form>

</div>

</body>
</html>
