<?php
$mostrarDados = false;
$dados = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $mostrarDados = true;
    
    // Capturar todos os dados do POST
    $dados = [
        'Nome' => $_POST['nome'] ?? 'Não informado',
        'Sobrenome' => $_POST['Sobrenome'] ?? 'Não informado',
        'Telefone' => $_POST['telefone'] ?? 'Não informado',
        'Email' => $_POST['email'] ?? 'Não informado',
        'CEP' => $_POST['cep'] ?? 'Não informado',
        'Rua' => $_POST['rua'] ?? 'Não informado',
        'Número' => $_POST['numero'] ?? 'Não informado',
        'Bairro' => $_POST['bairro'] ?? 'Não informado',
        'Complemento' => $_POST['complemento'] ?? 'Não informado',
        'Estado' => $_POST['estado'] ?? 'Não informado',
        'Cidade' => $_POST['cidade'] ?? 'Não informado'
    ];
}
?>

<!DOCTYPE html>
<html lang="pt" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="javascript.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="style.css">
    <title>Cadastro</title>
</head>

<body>
    <?php if ($mostrarDados): ?>
        <div class="container mt-4">
            <div class="alert alert-success">
                <h4>Dados enviados com sucesso!</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Campo</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dados as $campo => $valor): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($campo); ?></td>
                                <td><?php echo htmlspecialchars($valor); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-3">
                <a href="index.php" class="btn btn-primary">Voltar ao formulário</a>
            </div>
        </div>
    <?php endif; ?>
    
    <?php if (!$mostrarDados): ?>
    <div class="row">
        <div class="col-3 h2 text-center border pt-5">
            Barra lateral
        </div>
        <div class="col-8 mt-4">
            <div class="h1 text-center">
                Cadastre-se
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="row mt-4">
                    <div class="col-6">
                        <input type="text" class="form-control cont" name="nome" placeholder="Nome" required>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control cont" name="Sobrenome" placeholder="Sobrenome" required>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <input type="text" class="form-control cont" name="telefone" placeholder="Telefone" required>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control cont" name="email" placeholder="E-mail" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="input-group has-validation">
                            <input type="text" class="form-control cont" name="cep" placeholder="CEP" pattern="[\d]{5}-[\d]{3}" required>
                            <div class="invalid-feedback">
                                CEP inválido
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <input type="text" class="form-control cont" name="rua" placeholder="Rua" required>
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control cont" name="numero" placeholder="Nº" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <input type="text" class="form-control cont" name="bairro" placeholder="Bairro" required>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" name="complemento" placeholder="Complemento">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <select class="form-select" id="estado" name="estado" required>
                            <option value="">Selecione o estado</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <select class="form-select" id="cidade" name="cidade" required>
                            <option value="">Selecione a cidade</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <input type="submit" name="submit" class="btn btn-primary form-control" value="Enviar">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>