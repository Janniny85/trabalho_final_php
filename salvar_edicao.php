<?php
session_start();
include('conexao.php');

$id = intval($_POST['id']);
$nome = $_POST['nome_completo'];
$cidade = $_POST['cidade'];
$curso = $_POST['curso_nome'];

$sql = "UPDATE cad_aluno SET 
        nome_completo='$nome',
        cidade='$cidade',
        curso_nome='$curso'
        WHERE id=$id";

if (mysqli_query($conexao, $sql)) {
    $_SESSION['mensagem'] = "Dados atualizados com sucesso!";
} else {
    $_SESSION['mensagem'] = "Erro ao atualizar!";
}

header("Location: tela_alunos.php");
exit();
?>
