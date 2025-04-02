<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Lista de Corretores</title>
</head>
<body>
    <?php
    session_start();
    $id = $_GET['id'];
    require('connect.php');
    $corretores = mysqli_query($con, "SELECT * FROM `corretores` WHERE `id` = '$id'");
    $corretor = mysqli_fetch_array($corretores);
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 my-3">
                <h3 class="text-center">Atualizar cadastro do Corretor</h3>
                <form class="row g-3 needs-validation my-2" method="post" novalidate>
                    <div class="col-12">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" name="name" class="form-control" id="name" minlength="2" 
                            value="<?php echo $corretor['name']; ?>" required>
                        <div class="invalid-feedback">Tamanho do nome inválido.</div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="number" name="cpf" class="form-control" id="cpf" min="10000000000" max="99999999999" 
                            value="<?php echo $corretor['cpf']; ?>" required>
                        <div class="invalid-feedback">Tamanho do CPF inválido.</div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="creci" class="form-label">Creci</label>
                        <input type="text" name="creci" class="form-control" id="creci" minlength="2"
                            value="<?php echo $corretor['creci']; ?>" required>
                        <div class="invalid-feedback">Tamanho do Creci inválido.</div>
                    </div>
                    <div class="col-12">
                        <button name="Salvar" class="w-100 btn btn-primary toast-trigger" type="submit">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="formsValidation.js"></script>

    <?php
    if (isset($_POST["Salvar"])){
        extract($_POST);
        if ($name != null && $cpf != null && $creci != null) {
            require('connect.php');

            if(mysqli_query($con, "UPDATE `corretores` SET `name` = '$name', `cpf` = '$cpf', `creci` = '$creci' WHERE `corretores`.`id` = $id")){
                $_SESSION["msg"] = "Dados do corretor atualizados com sucesso!";
            } else {
                $_SESSION["msg"] = "Não foi possível atualizar os dados do corretor!";
            }
            
            header('location: ./');
        }
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>