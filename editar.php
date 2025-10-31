<?php
include("conexao.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM produtos WHERE id_prod = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $produto = $resultado->fetch_assoc();
    } else {
        echo "<script>
            alert('Produto não encontrado.');
            window.location.href = 'consul_todos.php';
        </script>";
        exit;
    }
    $stmt->close();
} else {
    echo "<script>
        alert('ID do produto não informado.');
        window.location.href = 'consul_todos.php';
    </script>";
    exit;
}
$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="mt-3">Editar Produto</h2>
                
                <form method="post" action="atualizar.php">
                    
                    <input type="hidden" name="id_prod" value="<?php echo $produto['id_prod']; ?>">
                    
                    <div class="mt-3 form-floating">
                        <input type="text" class="form-control" id="nomeprod" name="nomeprod" value="<?php echo htmlspecialchars($produto['nomeprod']); ?>" required>
                        <label for="nomeprod" class="form-label">Nome do produto</label>
                    </div>

                    <div class="mt-3 form-floating">
                        <input type="number" class="form-control" id="preco" name="preco" step="0.01" min="0" value="<?php echo $produto['preco']; ?>" required>
                        <label for="preco" class="form-label">Valor (R$)</label>
                    </div>

                    <div class="mt-3 form-floating">
                        <input type="text" class="form-control" id="categorias" name="categorias" value="<?php echo htmlspecialchars($produto['categorias']); ?>" required>
                        <label for="categorias" class="form-label">Categoria</label>
                    </div>
                    
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary form-control">Salvar Alterações</button>
                    </div>
                </form>
                
                <a href="consul_todos.php" class="btn btn-secondary mt-3">Cancelar e Voltar</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
