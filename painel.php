<?php
session_start();
include('conexao.php');

// LISTA DOS CAMPOS OBRIGATÓRIOS
$campos = [
    'nome_completo', 'data_nasc', 'end_rua', 'end_num', 'end_bairro', 
    'end_cep', 'resp_nome', 'resp_tipo', 'curso_nome', 'cidade'
];

// Verifica se algum campo está vazio
foreach ($campos as $campo) {
    if (empty($_POST[$campo])) {
        $_SESSION['mensagem'] = "Preencha todos os campos!";
        header('Location: telacadastro.php');
        exit();
    }
}

// Coletando dados de forma segura
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
    $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
    header('Location: painel.php');
    exit();
} else {
    $_SESSION['mensagem'] = "Erro ao cadastrar: " . mysqli_error($conexao);
    header('Location: telacadastro.php');
    exit();
}
?>



cadastro.php
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


--
conexao.php
<?php
define('HOST', 'localhost'); // O VALOR DE HOST É O IP DO BANCO DE DADOS MYSQL
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'login');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die('Não foi possível conectar');
?>

editar_aluno.php
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


excluir_aluno.php
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


index.php
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="This is a login page template based on Bootstrap 5">
    <title>Bootstrap 5 Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                            <form action="login.php" method="POST" class="needs-validation" novalidate="" autocomplete="off">
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
                                    <div class="invalid-feedback">
                                        Email is invalid
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="password">Password</label>
                                        <a href="forgot.html" class="float-end">
                                            Forgot Password?
                                        </a>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="senha" required>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                        <label for="remember" class="form-check-label">Remember Me</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary ms-auto">
                                        Login
                                    </button>
                                </div> 
                            </form>
                        </div>
                        <div class="card-footer py-3 border-0">
                            <div class="text-center">
                                Don't have an account? <a href="telacadastro.php" class="text-dark">Create One</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-5 text-muted">
                        Copyright &copy; 2017-2021 &mdash; EEEP Mundo do Saber
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

login.php
<?php
session_start();
include('conexao.php');

if (empty($_POST['email']) || empty($_POST['senha'])) {
    header('Location: index.php');
    exit();
}

$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "SELECT user_id, user_email FROM users WHERE user_email = '$email' AND user_password = MD5('$senha')";
$result = mysqli_query($conexao, $query);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($conexao));
}

$row = mysqli_num_rows($result);

if ($row == 1) {
    $_SESSION['email'] = $email;
    header('Location: painel.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: index.php');
    exit();
}
?>

logout.php
<?php
session_start();
session_destroy();
header('Location: index.php');
exit();
?>

navbar.php
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title></title>

    <style>
        .navbar-custom {
            background-color: #000; /* Preto elegante */
        }
        .navbar-custom .nav-link {
            color: #ddd !important;
            font-weight: 500;
        }
        .navbar-custom .nav-link:hover {
            color: #fff !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
        <div class="container-fluid">

            <a class="navbar-brand fw-bold text-white" href="index.php"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarNav" aria-controls="navbarNav" 
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                
                <!-- Links principais -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="telacadastro.php">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tela_alunos.php">Alunos</a>
                    </li>
                </ul>

                <!-- Botão Sair -->
                <div class="d-flex">
                    <a href="logout.php" class="btn btn-danger fw-bold px-4">Sair</a>
                </div>
                
            </div>
        </div>
    </nav>
</body>
</html>



painel.php
<?php
session_start();
include('conexao.php'); // conexão com o banco
include('navbar.php');

// ================================
// ==== Função para contar por curso ====
function getQtdPorCurso($conexao, $curso_nome) {
    $query = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM cad_aluno WHERE curso_nome = '$curso_nome'");
    return mysqli_fetch_assoc($query)['total'] ?? 0;
}

// 1. TOTAL DE ALUNOS
$qtdAlunos = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT COUNT(*) AS total FROM cad_aluno"))['total'];

// 2-5. QUANTIDADE DE ALUNOS POR CURSO
$qtdDS = getQtdPorCurso($conexao, 'Desenvolvimento de Sistemas');
$qtdINFO = getQtdPorCurso($conexao, 'Informática');
$qtdADM = getQtdPorCurso($conexao, 'Administração');
$qtdENFE = getQtdPorCurso($conexao, 'Enfermagem');

// 6. DISTRIBUIÇÃO DE CURSOS (GRÁFICO PIZZA)
$cursoQuery = mysqli_query($conexao, "SELECT curso_nome, COUNT(*) AS total FROM cad_aluno GROUP BY curso_nome");
$cursos = [];
$cursosQtd = [];
while($row = mysqli_fetch_assoc($cursoQuery)) {
    $cursos[] = $row["curso_nome"];
    $cursosQtd[] = $row["total"];
}

// 7. ALUNOS POR CIDADE (GRÁFICO BARRA)
$cidadeQuery = mysqli_query($conexao, "SELECT cidade, COUNT(*) AS total FROM cad_aluno GROUP BY cidade ORDER BY total DESC");
$cidades = [];
$cidadesQtd = [];
while($row = mysqli_fetch_assoc($cidadeQuery)) {
    $cidades[] = $row["cidade"];
    $cidadesQtd[] = $row["total"];
}

// 8. ALUNOS POR BAIRRO (GRÁFICO BARRA, TOP 10)
$bairroQuery = mysqli_query($conexao, "SELECT end_bairro, COUNT(*) AS total FROM cad_aluno GROUP BY end_bairro ORDER BY total DESC LIMIT 10");
$bairros = [];
$bairrosQtd = [];
while($row = mysqli_fetch_assoc($bairroQuery)) {
    $bairros[] = $row["end_bairro"];
    $bairrosQtd[] = $row["total"];
}

// 9. TIPO DE RESPONSÁVEL (GRÁFICO DOUGHNUT)
$responsavelQuery = mysqli_query($conexao, "SELECT resp_tipo, COUNT(*) AS total FROM cad_aluno GROUP BY resp_tipo");
$responsavel = [];
$responsavelQtd = [];
while($row = mysqli_fetch_assoc($responsavelQuery)) {
    $responsavel[] = $row["resp_tipo"];
    $responsavelQtd[] = $row["total"];
}

// 10. CURSO MAIS POPULAR
$cursoPopularQuery = mysqli_query($conexao, "SELECT curso_nome, COUNT(*) AS total FROM cad_aluno GROUP BY curso_nome ORDER BY total DESC LIMIT 1");
$cursoPopularRow = mysqli_fetch_assoc($cursoPopularQuery);
$cursoPopularNome = $cursoPopularRow['curso_nome'] ?? 'Nenhum';
$cursoPopularQtd = $cursoPopularRow['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel de Alunos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    body { background-color: #f5f7fb; }
    .card-dashboard { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-bottom: 20px; }
    .titulo-card { font-size: 16px; font-weight: 600; margin-bottom: 5px; }
    .valor-card { font-size: 35px; font-weight: bold; color: #007bff; }
    .card-ds .valor-card { color: #28a745; }
    .card-info .valor-card { color: #ffc107; }
    .card-adm .valor-card { color: #dc3545; }
    .card-enfe .valor-card { color: #17a2b8; }
    canvas { height: 250px !important; }
</style>
</head>
<body>

<div class="container mt-4">

    <!-- CARDS -->
    <div class="row text-center g-4 justify-content-center">
        <div class="col-md-2 col-sm-6"><div class="card-dashboard"><div class="titulo-card">Total de Alunos</div><div class="valor-card"><?= $qtdAlunos ?></div></div></div>
        <div class="col-md-2 col-sm-6"><div class="card-dashboard card-ds"><div class="titulo-card">Desenvolvimento de Sistemas</div><div class="valor-card"><?= $qtdDS ?></div></div></div>
        <div class="col-md-2 col-sm-6"><div class="card-dashboard card-info"><div class="titulo-card">Informática</div><div class="valor-card"><?= $qtdINFO ?></div></div></div>
        <div class="col-md-2 col-sm-6"><div class="card-dashboard card-adm"><div class="titulo-card">Administração</div><div class="valor-card"><?= $qtdADM ?></div></div></div>
        <div class="col-md-2 col-sm-6"><div class="card-dashboard card-enfe"><div class="titulo-card">Enfermagem</div><div class="valor-card"><?= $qtdENFE ?></div></div></div>
    </div>
    <hr>

    <!-- GRÁFICOS -->
    <div class="row text-center g-4">
        <div class="col-md-3"><div class="card-dashboard"><div class="titulo-card">Distribuição de Cursos</div><canvas id="graficoCurso"></canvas></div></div>
        <div class="col-md-3"><div class="card-dashboard"><div class="titulo-card">Tipo de Responsável</div><canvas id="graficoResponsavel"></canvas></div></div>
        <div class="col-md-3"><div class="card-dashboard"><div class="titulo-card">Alunos por Cidade</div><canvas id="graficoCidade"></canvas></div></div>
        <div class="col-md-3"><div class="card-dashboard"><div class="titulo-card">Alunos por Bairro (Top 10)</div><canvas id="graficoBairro"></canvas></div></div>
    </div>

    <div class="row text-center g-4 mt-2">
        <div class="col-md-6">
            <div class="card-dashboard">
                <div class="titulo-card">Curso Mais Popular</div>
                <canvas id="graficoCursoPopular"></canvas>
            </div>
        </div>
    </div>

</div>

<script>
const cores = ['#28a745','#ffc107','#dc3545','#17a2b8','#6f42c1','#fd7e14','#007bff','#e83e8c'];

// Gráfico de Cursos
new Chart(document.getElementById('graficoCurso'), {
    type: 'pie',
    data: { labels: <?= json_encode($cursos) ?>, datasets:[{ data: <?= json_encode($cursosQtd) ?>, backgroundColor: cores }] },
    options: { responsive:true, maintainAspectRatio:false }
});

// Gráfico Tipo de Responsável
new Chart(document.getElementById('graficoResponsavel'), {
    type: 'doughnut',
    data: { labels: <?= json_encode($responsavel) ?>, datasets:[{ data: <?= json_encode($responsavelQtd) ?>, backgroundColor: cores }] },
    options: { responsive:true, maintainAspectRatio:false }
});

// Gráfico Alunos por Cidade
new Chart(document.getElementById('graficoCidade'), {
    type: 'bar',
    data: { labels: <?= json_encode($cidades) ?>, datasets:[{ label:'Alunos', data: <?= json_encode($cidadesQtd) ?>, backgroundColor:'#007bff' }] },
    options: { responsive:true, maintainAspectRatio:false, scales:{ y:{ beginAtZero:true } }, plugins:{ legend:{ display:false } } }
});

// Gráfico Alunos por Bairro
new Chart(document.getElementById('graficoBairro'), {
    type: 'bar',
    data: { labels: <?= json_encode($bairros) ?>, datasets:[{ label:'Alunos', data: <?= json_encode($bairrosQtd) ?>, backgroundColor:'#28a745' }] },
    options: { responsive:true, maintainAspectRatio:false, scales:{ y:{ beginAtZero:true }, x:{ ticks:{ autoSkip:false, maxRotation:45, minRotation:45 } } }, plugins:{ legend:{ display:false } } }
});

// Gráfico Curso Mais Popular
new Chart(document.getElementById('graficoCursoPopular'), {
    type: 'bar',
    data: {
        labels: [<?= json_encode($cursoPopularNome) ?>],
        datasets: [{
            label: 'Quantidade de Alunos',
            data: [<?= json_encode($cursoPopularQtd) ?>],
            backgroundColor: '#fcf8cbec'
        }]
    },
    options: {
        responsive:true,
        maintainAspectRatio:false,
        scales: { y: { beginAtZero:true } }
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
