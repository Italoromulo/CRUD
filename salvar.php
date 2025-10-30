<?php
include("conexao.php"); //

// Validar se os dados vieram por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nomeprod = $_POST["nomeprod"]; //
    $preco = $_POST["preco"]; //
    $categorias = $_POST["categorias"]; //

    // Preparar o comando SQL
    $sql = "INSERT INTO produtos (nomeprod, preco, categorias) VALUES (?, ?, ?)"; //
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sds", $nomeprod, $preco, $categorias); //

    // --- INÍCIO DA MODIFICAÇÃO (try...catch) ---
    try {
        // Tenta executar o comando
        $stmt->execute();
        echo "<script>alert('Produto cadastrado com sucesso!');</script>";

    } catch (mysqli_sql_exception $e) {
        // Captura o erro do MySQL
        
        if ($e->getCode() == 1062) {
            // Erro 1062 é "Duplicate entry" (Entrada duplicada)
            echo "<script>alert('Erro: Já existe um produto cadastrado com esse nome.');</script>";
        } else {
            // Qualquer outro erro
            echo "<script>alert('Erro ao cadastrar produto: " . addslashes($e->getMessage()) . "');</script>";
        }
    }
    // --- FIM DA MODIFICAÇÃO ---
    
    $stmt->close();
    $conexao->close();

    // Redireciona de volta para a lista (se sucesso) ou cadastro (se erro)
    if (isset($e) && $e->getCode() == 1062) {
        echo "<script>window.location.href = 'cadastro.php';</script>"; // Se duplicado, volta pro cadastro
    } else {
        echo "<script>window.location.href = 'consul_todos.php';</script>"; // Se sucesso, vai pra lista
    }
    
} else {
    // Se não for POST, redireciona
    echo "<script>alert('Método de requisição inválido.');</script>";
    echo "<script>window.location.href = 'cadastro.php';</script>";
}
?>