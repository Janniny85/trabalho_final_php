<?php
session_start();
include('conexao.php');

// Verificação dos campos enviados
$campos = [
    'nome_completo', 'data_nasc', 'end_rua', 'end_num', 'end_bairro',
    'end_cep', 'resp_nome', 'resp_tipo', 'curso_nome', 'cidade'
];

foreach ($campos as $campo) {
    if (empty($_POST[$campo])) {
        $_SESSION['mensagem'] = "Preencha todos os campos!";
        header('Location: telaformulario.php');
        exit();
    }
}

// Coleta dos dados
$nome  = mysqli_real_escape_string($conexao, trim($_POST['nome_completo']));
$nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nasc']));
$rua = mysqli_real_escape_string($conexao, trim($_POST['end_rua']));
$numero = mysqli_real_escape_string($conexao, trim($_POST['end_num']));
$bairro = mysqli_real_escape_string($conexao, trim($_POST['end_bairro']));
$cep = mysqli_real_escape_string($conexao, trim($_POST['end_cep']));
$responsavel = mysqli_real_escape_string($conexao, trim($_POST['resp_nome']));
$tipo_responsavel = mysqli_real_escape_string($conexao, trim($_POST['resp_tipo']));
$curso = mysqli_real_escape_string($conexao, trim($_POST['curso_nome']));
$cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));

// INSERT
$sql = "INSERT INTO cad_aluno 
(nome_completo, data_nasc, end_rua, end_num, end_bairro, end_cep, resp_nome, resp_tipo, curso_nome, cidade) 
VALUES 
('$nome', '$nascimento', '$rua', '$numero', '$bairro', '$cep', '$responsavel', '$tipo_responsavel', '$curso', '$cidade')";

if (mysqli_query($conexao, $sql)) {
    $_SESSION['mensagem'] = "Cadastro realizado com sucesso! Faça login.";
    header('Location: index.php');
    exit();
} else {
    $_SESSION['mensagem'] = "Erro ao cadastrar: " . mysqli_error($conexao);
    header('Location: telaformulario.php');
    exit();
}
?>
