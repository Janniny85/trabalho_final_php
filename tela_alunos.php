<?php
session_start();
include('navbar.php'); 
include('conexao.php');

// Recebe filtros da busca
$busca_nome = isset($_GET['nome']) ? $_GET['nome'] : '';
$busca_cidade = isset($_GET['cidade']) ? $_GET['cidade'] : '';
$busca_curso = isset($_GET['curso']) ? $_GET['curso'] : '';


// Monta a SQL com filtros
$sql = "SELECT id, nome_completo, cidade, curso_nome FROM cad_aluno WHERE 1=1";

if (!empty($busca_nome)) {
    $sql .= " AND nome_completo LIKE '%" . mysqli_real_escape_string($conexao, $busca_nome) . "%'";
}

if (!empty($busca_cidade)) {
    $sql .= " AND cidade LIKE '%" . mysqli_real_escape_string($conexao, $busca_cidade) . "%'";
}

if (!empty($busca_curso)) {
    $sql .= " AND curso_nome LIKE '%" . mysqli_real_escape_string($conexao, $busca_curso) . "%'";
}


$result = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center mb-4">Alunos Cadastrados</h2>

    <?php if(isset($_SESSION['mensagem'])): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensagem']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php unset($_SESSION['mensagem']); endif; ?>


    <!-- ------------------------------- -->
    <!--      FORMULÁRIO DE BUSCA       -->
    <!-- ------------------------------- -->
   <form method="GET" class="row g-3 mb-4">
    <div class="col-md-4">
        <input type="text" name="nome" class="form-control" placeholder="Buscar por nome"
               value="<?= htmlspecialchars($busca_nome); ?>">
    </div>

    <div class="col-md-4">
        <input type="text" name="cidade" class="form-control" placeholder="Buscar por cidade"
               value="<?= htmlspecialchars($busca_cidade); ?>">
    </div>

    <div class="col-md-3">
        <input type="text" name="curso" class="form-control" placeholder="Buscar por curso"
               value="<?= htmlspecialchars($busca_curso); ?>">
    </div>

    <div class="col-md-1 d-grid">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form>


    <!-- ------------------------------- -->
    <!--         TABELA DE ALUNOS        -->
    <!-- ------------------------------- -->
    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>Nome do Aluno</th>
                <th>Cidade</th>
                <th>Curso</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['nome_completo']; ?></td>
                <td><?= $row['cidade']; ?></td>
                <td><?= $row['curso_nome']; ?></td>
               <td>
    <a href="editar_aluno.php?id=<?= $row['id']; ?>" 
       class="btn btn-outline-secondary btn-sm">Editar</a>

    <a href="excluir_aluno.php?id=<?= $row['id']; ?>" 
       class="btn btn-outline-danger btn-sm"
       onclick="return confirm('Tem certeza que deseja excluir este aluno?');">
       Excluir
    </a>
</td>

            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
