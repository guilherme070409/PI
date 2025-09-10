<?php
require_once '../service/conexao.php';  // conexão com o banco
require_once '../model/videos.php';      // classe videos

// Pega o nome da categoria via GET, ex: ?categoria=Animacoes
$nome_categoria = $_GET['categoria']  ?? "Todos";

// Só lista vídeos se a categoria estiver definida
if ($nome_categoria != "Todos") {
    $lista_videos = videos::listarPorNomeCategoria($pdo, $nome_categoria);
} else {
    
    $lista_videos = videos :: listar($pdo); // nenhum vídeo se não houver categoria

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vídeos - <?php echo htmlspecialchars($nome_categoria ?? ''); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .videos-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .video-card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .video-card iframe {
            width: 100%;
            height: 200px;
            border: none;
        }
        .video-info {
            padding: 10px;
        }
        .video-info h3 {
            font-size: 16px;
            margin: 0 0 5px;
        }
        .video-info p {
            font-size: 14px;
            margin: 2px 0;
            color: #555;
        }
    </style>
</head>
<body>
<form action="card.php" method= get>
     <div class="linha-form">
                
       <button type=submit name=categoria value="Todos">Todos</button>                     
 <button type=submit value="animacoes" name=categoria>Animaçoes</button>
 <button type=submit name=categoria value="filmes-infantis">filmes infantis</button>
<button type=submit name=categoria value="aventuras">aventuras</button>
<button type=submit name=categoria value="comedia-humor">Comedia e humor</button>
<button type=submit name=categoria value="mundo-imaginacao">Mundo da imaginação</button>
                            </select>
                        </div>
</form>
<h2>Vídeos da categoria: <?php echo htmlspecialchars($nome_categoria ?? 'Nenhuma'); ?></h2>

<div class="videos-container">
<?php if (!empty($lista_videos) && is_array($lista_videos)): ?>
    <?php foreach($lista_videos as $video): ?>
        <div class="video-card">
            <iframe src="<?php echo htmlspecialchars($video['url']); ?>" 
                    title="<?php echo htmlspecialchars($video['titulo']); ?>" 
                    allowfullscreen>
            </iframe>
            <div class="video-info">
                <h3><?php echo htmlspecialchars($video['titulo']); ?></h3>
                <p>Categoria: <?php echo htmlspecialchars($video['nome_da_categoria']); ?></p>
                <p><?php echo htmlspecialchars($video['descricao']); ?></p>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Nenhum vídeo encontrado para esta categoria.</p>
<?php endif; ?>
</div>

</body>
</html>
