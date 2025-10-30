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

    <style>
        /* ===== TEMA DARK PARA O PROJETO DE PC ===== */

        /* --- TEMA GERAL --- */
        body {
            background-color: #121212;
            /* Fundo escuro */
            color: #e0e0e0;
            /* Texto claro */
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        /* --- TÍTULOS --- */
        h2,
        h3 {
            color: #ffffff;
            /* Azul primário do Bootstrap como destaque */
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 10px;
        }

        /* --- CARD (Tela Inicial) --- */
        .card {
            background-color: #1e1e1e;
            /* Fundo do card mais claro */
            border: 1px solid #444;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        .card-header {
            background-color: #0d6efd;
            color: white;
            font-size: 1.25rem;
            font-weight: bold;
            border-bottom: none;
            border-radius: 10px 10px 0 0 !important;
        }

        /* --- BOTÕES --- */
        /* Remove a cor de fundo padrão e adiciona transição */
        .btn {
            border: none;
            transition: all 0.2s ease-in-out;
            font-weight: 500;
        }

        .btn:hover {
            transform: translateY(-2px);
            /* Efeito de "levantar" */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        /* Botões da tela inicial */
        .d-grid .btn-primary {
            background-color: #0d6efd;
        }

        .d-grid .btn-info {
            background-color: #315CFD;
            /* Tom de azul do seu 'style' antigo */
        }

        .d-grid .btn-secondary {
            background-color: #4a67ff;
            /* Tom de azul do seu 'style' antigo */
        }

        /* Botões da tabela (Editar/Excluir) */
        .btn-warning {
            color: #121212;
            /* Texto escuro para botão amarelo */
        }

        /* --- FORMULÁRIOS (Cadastro, Editar, Consulta) --- */
        .form-control {
            background-color: #2b2b2b;
            /* Fundo do input */
            color: #e0e0e0;
            /* Texto do input */
            border: 1px solid #555;
        }

        .form-control:focus {
            background-color: #333;
            color: #e0e0e0;
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        /* Cor do texto do 'label' flutuante */
        .form-floating>label {
            color: #aaa;
        }

        /* Cor do 'label' quando o campo está focado ou preenchido */
        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label {
            color: #0d6efd;
        }

        /* --- TABELA (Consultar Todos, Resultado Consulta) --- */
        .table {
            color: #e0e0e0;
            /* Texto da tabela */
            background-color: #1e1e1e;
            border-color: #444;
        }

        /* Remove as classes de 'light' do bootstrap */
        .table-light,
        .table-light>th,
        .table-light>td {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        /* Cabeçalho da Tabela */
        .table>thead {
            background-color: #0d6efd !important;
            /* Força o fundo azul */
        }

        .table>thead th {
            color: white !important;
            /* Força o texto branco */
            border-color: #0a58ca;
        }

        /* Efeito de listra */
        .table-striped>tbody>tr:nth-of-type(odd)>* {
            background-color: #2b2b2b;
            color: #e0e0e0;
        }

        /* Efeito de hover */
        .table-hover>tbody>tr:hover>* {
            background-color: #3c3c3c;
            color: #f0f0f0;
        }
    </style>

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