<?php
// Se o usuário enviou o formulário
if (isset($_POST['submit'])) {
  // Cria variáveis com o nome do atributo 'name' dos inputs do formulário
  extract($_POST);
}

function validaCampo(string $valorCampo, string $tipoCampo = ""){
    switch($tipoCampo){
        case 'email':
            if (filter_var($valorCampo, FILTER_VALIDATE_EMAIL)){
                return true;
            }
            break;
        case 'telefone':
            if (preg_match('/^\(\d\d\)\s[9]?\d\d\d\d-\d\d\d\d$/', $valorCampo)){
                return true;
            }
            break;
        case 'cep':
            if (!preg_match('/^[0-9]{5}-?[0-9]{3}$/', $valorCampo)) {
                return true;
            }
            break;
        default:
            if (!empty(trim($valorCampo))) {
                return true;
            }
    }
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
    <div class="row">
        <div class="col-3 border pt-3">
            <h2 class="text-center mb-4">Dados Informados</h2>
            <?php if(isset($_POST['submit'])): ?>
                <div class="dados-cadastro">
                    <?php if(isset($nome) && validaCampo($nome)): ?>
                        <p><strong>Nome:</strong> <?php echo htmlspecialchars($nome); ?></p>
                    <?php endif; ?>
                    
                    <?php if(isset($sobrenome) && validaCampo($sobrenome)): ?>
                        <p><strong>Sobrenome:</strong> <?php echo htmlspecialchars($sobrenome); ?></p>
                    <?php endif; ?>
                    
                    <?php if(isset($telefone) && validaCampo($telefone)): ?>
                        <p><strong>Telefone:</strong> <?php echo htmlspecialchars($telefone); ?></p>
                    <?php endif; ?>
                    
                    <?php if(isset($email) && validaCampo($email, 'email')): ?>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                    <?php endif; ?>
                    
                    <?php if(isset($cep) && validaCampo($cep)): ?>
                        <p><strong>CEP:</strong> <?php echo htmlspecialchars($cep); ?></p>
                    <?php endif; ?>
                    
                    <?php if(isset($rua) && validaCampo($rua)): ?>
                        <p><strong>Rua:</strong> <?php echo htmlspecialchars($rua); ?></p>
                    <?php endif; ?>
                    
                    <?php if(isset($numero) && validaCampo($numero)): ?>
                        <p><strong>Número:</strong> <?php echo htmlspecialchars($numero); ?></p>
                    <?php endif; ?>
                    
                    <?php if(isset($bairro) && validaCampo($bairro)): ?>
                        <p><strong>Bairro:</strong> <?php echo htmlspecialchars($bairro); ?></p>
                    <?php endif; ?>
                    
                    <?php if(isset($complemento) && !empty(trim($complemento))): ?>
                        <p><strong>Complemento:</strong> <?php echo htmlspecialchars($complemento); ?></p>
                    <?php endif; ?>
                    
                    <?php if(isset($estado) && validaCampo($estado)): ?>
                        <p><strong>Estado:</strong> <?php echo htmlspecialchars($estado); ?></p>
                    <?php endif; ?>
                    
                    <?php if(isset($cidade) && validaCampo($cidade)): ?>
                        <p><strong>Cidade:</strong> <?php echo htmlspecialchars($cidade); ?></p>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p class="text-center">Nenhum dado cadastrado ainda.</p>
            <?php endif; ?>
        </div>
        <div class="col-8 mt-4">
            <div class="h1 text-center">
                Cadastre-se
            </div>
            <form action="index.php" method="post">
                <div class="row mt-4">
                    <div class="col-6">
                        <input type="text" class="form-control <?php echo (isset($_POST['nome']) 
                        && !validaCampo($_POST['nome']) ? 'is-invalid' : '')?>" 
                        name="nome" placeholder="Nome" value="<?php echo (isset($nome) ? $nome : '') ?>" >
                        <div class="invalid-feedback">
                            Digite seu nome
                        </div>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control <?php echo (isset($_POST['sobrenome']) && !validaCampo($_POST['sobrenome']) ? 'is-invalid' : '')?>" name="sobrenome" placeholder="Sobrenome" value="<?php echo (isset($sobrenome) ? $sobrenome : '') ?>" >
                        <div class="invalid-feedback">
                            Digite seu sobrenome
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <input type="text" class="form-control  <?php echo (isset($_POST['telefone']) && !validaCampo($_POST['telefone']) ? 'is-invalid' : '')?>" name="telefone" placeholder="Telefone" pattern="\(\d{2}\)\s9?\d{4}-\d{4}" value="<?php echo (isset($telefone) ? $telefone : '') ?>" >
                        <div class="invalid-feedback">
                            Telefone inválido
                        </div>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control <?php echo (isset($_POST['email']) 
                        && !validaCampo($_POST['email'], 'email') ? 'is-invalid' : '')?>" 
                        name="email" placeholder="E-mail" value="<?php echo (isset($email) ? $email : '') ?>" >
                        <div class="invalid-feedback">
                            Digite um email válido
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="input-group has-validation">
                            <input type="text" class="form-control <?php echo (isset($_POST['cep']) && !validaCampo($_POST['cep']) ? 'is-invalid' : '')?>" name="cep" placeholder="CEP" pattern="[\d]{5}-[\d]{3}" value="<?php echo (isset($cep) ? $cep : '') ?>">
                            <div class="invalid-feedback">
                                CEP inválido
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-9">
                        <input type="text" class="form-control <?php echo (isset($_POST['rua']) && !validaCampo($_POST['rua']) ? 'is-invalid' : '')?>" name="rua" placeholder="Rua" value="<?php echo (isset($rua) ? $rua : '') ?>">
                        <div class="invalid-feedback">
                            Digite sua rua
                        </div>
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control <?php echo (isset($_POST['numero']) && !validaCampo($_POST['numero']) ? 'is-invalid' : '')?>" name="numero" placeholder="Nº" value="<?php echo (isset($numero) ? $numero : '') ?>">
                        <div class="invalid-feedback">
                            Digite o número de sua moradia
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <input type="text" class="form-control <?php echo (isset($_POST['bairro']) && !validaCampo($_POST['bairro']) ? 'is-invalid' : '')?>" name="bairro" placeholder="Bairro" value="<?php echo (isset($bairro) ? $bairro : '') ?>">
                        <div class="invalid-feedback">
                            Digite seu bairro
                        </div>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" name="complemento" placeholder="Complemento" value="<?php echo (isset($complemento) ? $complemento : '') ?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <select class="form-select <?php echo (isset($_POST['estado']) && !validaCampo($_POST['estado']) ? 'is-invalid' : '')?>" id="estado" name="estado">
                            <option value="">Selecione o estado</option>
                        </select>
                        <div class="invalid-feedback">
                            Selecione um estado
                        </div>
                    </div>
                    <div class="col-6">
                        <select class="form-select <?php echo (isset($_POST['cidade']) && !validaCampo($_POST['cidade']) ? 'is-invalid' : '')?>" id="cidade" name="cidade">
                            <option value="">Selecione a cidade</option>
                        </select>
                        <div class="invalid-feedback">
                            Selecione uma cidade
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <input type="submit" class="btn btn-primary form-control" name="submit" value="Enviar">
                    </div>
                </div>
            </form>
    </div>
            
        
</div>

</body>

</html>
