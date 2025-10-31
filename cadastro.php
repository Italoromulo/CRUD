<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de peças de PC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mt-3">Cadastro de produtos</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                
                <form method="POST" action="salvar.php">
                    
                    <div class="mt-3 form-floating">
                        <input type="text" class="form-control" id="nomeprod" name="nomeprod" placeholder="Nome do produto" required>
                        <label for="nomeprod" class="form-label">Nome do produto</label>
                    </div>

                    <div class="mt-3 form-floating">
                        <input type="number" class="form-control" id="preco" name="preco" step="0.01" min="0" placeholder="Valor" required>
                        <label for="preco" class="form-label">Valor (R$)</label>
                    </div>

                    <div class="mt-3 form-floating">
                        <input type="text" class="form-control" id="categorias" name="categorias" placeholder="Categoria" required>
                        <label for="categorias" class="form-label">Categoria (ex: Placa de Vídeo, Processador)</label>
                    </div>
                    
                    <div class="mt-3 form-floating">
                        <div class="row">
                            <div class="col"><button type="reset" class="btn btn-secondary form-control">Limpar</button></div>
                            <div class="col"><button type="submit" class="btn btn-primary form-control">Salvar Produto</button></div>
                        </div>
                    </div>
                </form>
                
                <a href="inicial.html" class="btn btn-secondary mt-3">Voltar ao Início</a>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
