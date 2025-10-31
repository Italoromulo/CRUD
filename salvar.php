<?php
include("conexao.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nomeprod = $_POST["nomeprod"];
    $preco = $_POST["preco"];
    $categorias = $_POST["categorias"];
    $sql = "INSERT INTO produtos (nomeprod, preco, categorias) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sds", $nomeprod, $preco, $categorias);
    try {
        $stmt->execute();
        echo "<script>alert('Produto cadastrado com sucesso!');</script>";

    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            echo "<script>alert('Erro: Já existe um produto cadastrado com esse nome.');</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar produto: " . addslashes($e->getMessage()) . "');</script>";
        }
    }  
    $stmt->close();
    $conexao->close();
    if (isset($e) && $e->getCode() == 1062) {
        echo "<script>window.location.href = 'cadastro.php';</script>";
    } else {
        echo "<script>window.location.href = 'consul_todos.php';</script>";
    }
    
} else {
    echo "<script>alert('Método de requisição inválido.');</script>";
    echo "<script>window.location.href = 'cadastro.php';</script>";
}
?>
