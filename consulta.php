<?php
include("conexao.php");

$resultado = null;
$nome_consulta = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_consulta = $_POST["nomeprod"];
    $sql = "SELECT * FROM produtos WHERE nomeprod LIKE ?";
    $stmt = $conexao->prepare($sql);
    $param_nome = "%" . $nome_consulta . "%";
    $stmt->bind_param("s", $param_nome);

    $stmt->execute();
    $resultado = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="mt-4">Consultar Produto por Nome</h2>

                <form action="consulta.php" method="POST">
                    <div class="mt-3 form-floating">
                        <input type="text" class="form-control" id="nomeprod" name="nomeprod" placeholder="Nome do produto" value="<?php echo htmlspecialchars($nome_consulta); ?>" required>
                        <label for="nomeprod">Nome do Produto:</label>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary form-control">Consultar</button>
                </form>
                <br>
                <a href="inicial.html" class="btn btn-secondary form-control">Voltar ao Início</a>
            </div>
        </div>
        
        <?php
        if ($resultado !== null):
        ?>
        <hr class="mt-5">
        <div class="row mt-4">
            <div class="col">
                <h3>Resultados da Busca</h3>
                <table class="table table-hover table-striped">
                    <thead style="background-color: #0d6efd; color: white; border-color: #0a58ca;">
                        <tr>
                            <th style="background-color: #0d6efd;">Código (ID)</th>
                            <th style="background-color: #0d6efd;">Nome Produto</th>
                            <th style="background-color: #0d6efd;">Categoria</th>
                            <th style="background-color: #0d6efd;">Valor (R$)</th>
                            <th style="background-color: #0d6efd;">Editar</th>
                            <th style="background-color: #0d6efd;">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($resultado->num_rows > 0) {
                            while($linha = $resultado->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $linha["id_prod"] . "</td>";
                                echo "<td>" . $linha["nomeprod"] . "</td>";
                                echo "<td>" . $linha["categorias"] . "</td>";
                                echo "<td> R$ " . number_format($linha["preco"], 2, ',', '.') . "</td>";
                                echo "<td>
                                        <a href='editar.php?id=" . $linha["id_prod"] . "' class='btn btn-warning btn-sm'>Editar</a>
                                      </td>";
                                echo "<td>
                                        <form action='excluir.php' method='POST' style='display:inline;'>
                                            <input type='hidden' name='id' value='" . $linha["id_prod"] . "'>
                                            <button type='submit' class='btn btn-danger btn-sm' onclick=\"return confirm('Tem certeza?');\">Excluir</button>
                                        </form>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>Nenhum produto encontrado com esse nome.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        endif; 
        $conexao->close();
        ?>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
