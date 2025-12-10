<?php
session_start();
include('navbar.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cadastro de Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container h-100 mt-4">
    <div class="row justify-content-center">
        <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-9 col-sm-12">
            <div class="text-center my-3">
                <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
            </div>
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <h1 class="fs-4 card-title fw-bold mb-4">Cadastro</h1>

                    <!-- Mensagem de cadastro -->
                    <?php 
                    if(isset($_SESSION['mensagem'])):
                    ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <?= $_SESSION['mensagem']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php 
                        unset($_SESSION['mensagem']);
                    endif;
                    ?>

                    <form action="cadastro.php" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" name="nome" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Data Nascimento</label>
                                <input type="date" class="form-control" name="nascimento" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Rua</label>
                                <input type="text" class="form-control" name="rua" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Número</label>
                                <input type="text" class="form-control" name="numero" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bairro</label>
                                <input type="text" class="form-control" name="bairro" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">CEP</label>
                                <input type="text" class="form-control" name="cep" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nome do Responsável</label>
                                <input type="text" class="form-control" name="responsavel" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tipo de Responsável</label>
                                <select class="form-select" name="tipo_responsavel" required>
                                    <option selected disabled value="">Selecione...</option>
                                    <option>Mãe</option>
                                    <option>Pai</option>
                                    <option>Avô/Avó</option>
                                    <option>Tio/Tia</option>
                                    <option>Outro</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Curso</label>
                                <select class="form-select" name="curso" required>
                                    <option selected disabled value="">Selecione o curso</option>
                                    <option>Desenvolvimento de Sistemas</option>
                                    <option>Enfermagem</option>
                                    <option>Informática</option>
                                    <option>Administração</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Cidade</label>
                                <input type="text" class="form-control" name="cidade" required>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
