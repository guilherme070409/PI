<?php
require_once '../service/conexao.php';
require_once '../model/videos.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $titulo = $_POST['titulo'];
    $url = $_POST['url'];
    $categoria = $_POST['categoria'];
    $thumbnail = $_POST['thumbnail'];
    $descricao = $_POST['descricao'];

    $resultado = videos::editar($pdo, $id, $titulo, $url, $categoria, $thumbnail, $descricao);

    if ($resultado) {
        header("Location: ../view/admin/index.php?categoria=" . urlencode($categoria));
        exit;
    } else {
        echo "Erro ao editar vídeo.";
    }
}
