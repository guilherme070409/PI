<?php
session_start();
require_once __DIR__ . '/../service/conexao.php';
require_once __DIR__ . '/../model/videos.php';
require_once __DIR__ . '/../model/categoria.php'; // <<< incluído

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $titulo = $_POST['titulo'];
    $url = $_POST['url'];
    $fk_categoria = $_POST['categoria']; // agora deve ser o ID da categoria
    $thumbnail = $_POST['thumbnail'];
    $descricao = $_POST['descricao'];

    $resultado = videos::editar($pdo, $id, $titulo, $url, $fk_categoria, $thumbnail, $descricao);

    if ($resultado) {
        header("Location: ../view/admin/index.php");
        exit;
    } else {
        echo "Erro ao editar vídeo.";
    }
}
