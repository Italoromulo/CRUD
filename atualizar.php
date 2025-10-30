<?php
include("conexao.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id_prod"];
    $nomeprod = $_POST["nomeprod"];
    $preco = $_POST["preco"];
    $categorias = $_POST["categorias"];
    $sql = "UPDATE produtos SET 
                nomeprod = ?,
                preco = ?,
                categorias = ?
            WHERE id_prod = ?"; 

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sdsi", $nomeprod, $preco, $categorias, $id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Produto atualizado com sucesso!');
            window.location.href = 'consul_todos.php'; 
        </script>";
    } else {
        echo "<script>
            alert('Erro ao atualizar produto: " . addslashes($stmt->error) . "');
            window.location.href = 'consul_todos.php';
        </script>";
    }
    $stmt->close();
} else {
    echo "<script>
        alert('Requisição inválida.');
        window.location.href = 'consul_todos.php';
    </script>";
}
$conexao->close();
?>