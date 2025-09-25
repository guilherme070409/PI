<?php
session_start();
require_once '../model/categoria.php';
require_once '../model/videos.php';
require_once '../service/conexao.php';


  $titulo = $_POST['titulo'];
  $url = $_POST['url'];
  $categoria = $_POST['categoria'];
  $thumbnail = $_POST['thumbnail'];
  $descricao = $_POST['descricao'] ;
  
  
  
  $add_video = categoria :: cadastrar (
    $pdo,
    $categoria
  );

$my_categoria = categoria :: buscarcategoria($pdo, $categoria);

  $fk_categoria = $my_categoria['id'];



$add_video = videos::cadastrar (
        $pdo,
        $titulo,
        $url,
        $thumbnail,
        $descricao,
        $fk_categoria
);


 if ($add_video) {
        $_SESSION['msg'] = "Video adicionado!!";
        header('Location: ../view/Adm_page/index.php');
        exit();
    } else {
        $_SESSION['erro'] = "Erro ao adicionar o video.";
        header('Location: ../view/Adm_page/index.php');
        exit();
    }

?>