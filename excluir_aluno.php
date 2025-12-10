<?php
session_start();
include('conexao.php');

if (!isset($_GET['id'])) {
    $_SESSION['mensagem'] = "ID não informado!";
    header("Location: tela_alunos.php");
    exit();
}

$id = intval($_GET['id']);

$sql = "DELETE FROM cad_aluno WHERE id = $id";

if (mysqli_query($conexao, $sql)) {
    $_SESSION['mensagem'] = "Aluno excluído com sucesso!";
} else {
    $_SESSION['mensagem'] = "Erro ao excluir!";
}

header("Location: tela_alunos.php");
exit();
?>
