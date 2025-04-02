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
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="./img/favicon.webp" class="rounded me-2 logo-toast" alt="">
                <strong class="me-auto">Imovel Guide</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div id="text-toast" class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>

    <script src="toasts.js"></script>

    <?php
    session_start(); 
    if(isset($_SESSION['msg'])){
        if($_SESSION['msg']!=null || $_SESSION['msg']!=""){
            $msg = $_SESSION['msg'];
            echo "<script>fShowToast('$msg')</script>";
            $_SESSION['msg'] = "";
        }
    }
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 my-3">
                <h3 class="text-center">Cadastro de Corretor</h3>
                <form class="row g-3 needs-validation my-2" action="." method="post" novalidate>
                    <div class="col-12">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" name="name" class="form-control" id="name" minlength="2" required>
                        <div class="invalid-feedback">Tamanho do nome inválido.</div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="number" name="cpf" class="form-control" id="cpf" min="10000000000" max="99999999999" required>
                        <div class="invalid-feedback">Tamanho do CPF inválido.</div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="creci" class="form-label">Creci</label>
                        <input type="text" name="creci" class="form-control" id="creci" minlength="2" required>
                        <div class="invalid-feedback">Tamanho do Creci inválido.</div>
                    </div>
                    <div class="col-12">
                        <button name="Cadastrar" class="w-100 btn btn-primary toast-trigger" type="submit">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabel">Excluir corretor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Deseja mesmo excluir os dados desse corretor?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a id="link-delete" href="" class="btn btn-danger">Excluir</a>
            </div>
            </div>
        </div>
    </div>

    <script src="formsValidation.js"></script>

    <?php
    if (isset($_POST["Cadastrar"])){
        extract($_POST);
        if ($name != null && $cpf != null && $creci != null) {
            require('connect.php');

            if(mysqli_query($con, "INSERT INTO `corretores`(`id`, `name`, `cpf`, `creci`) VALUES ('', '$name', '$cpf', '$creci')")){
                $_SESSION["msg"] = "Corretor cadastrado com sucesso!";
            } else {
                $_SESSION["msg"] = "Não foi possível cadastrar o corretor!";
            }
            
            header('location: ./');
        }
    }

    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 my-3">
                <h3>Lista de Corretores</h3>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                        <th>Id</th>
                        <th class="text-start">Nome</th>
                        <th>CPF</th>
                        <th>Creci</th>
                        <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require('connect.php');
                        $corretores = mysqli_query($con, "SELECT * FROM `corretores`");
                        while($corretor = mysqli_fetch_array($corretores)){
                            echo "<tr class='text-center align-middle'>
                                <td>".$corretor['id']."</td>
                                <td class='text-start'>".$corretor['name']."</td>
                                <td>".$corretor['cpf']."</td>
                                <td>".$corretor['creci']."</td>
                                <td>
                                    <a href='edit.php?id=".$corretor['id']."' class='btn btn-yellow m-1'><i class='bi bi-pencil-fill'></i></a>
                                    <a class='btn btn-red m-1' data-bs-toggle='modal' 
                                        data-bs-target='#confirmModal' onClick='changeLinkDelete(".$corretor['id'].")'>
                                        <i class='bi bi-trash-fill'></i>
                                    </a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>