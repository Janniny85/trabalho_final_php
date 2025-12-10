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
