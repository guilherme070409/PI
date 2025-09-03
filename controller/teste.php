<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exemplo de Vídeos</title>
    <style>
        .video-card {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
            width: 300px;
        }
        .like-btn {
            cursor: pointer;
            padding: 5px 10px;
            border: none;
            background-color: #ff6b6b;
            color: white;
            border-radius: 5px;
        }
        .like-btn:hover {
            background-color: #ff4c4c;
        }
    </style>
</head>
<body>

<h1>Meus Vídeos</h1>

<!-- Card de vídeo 1 -->
<div class="video-card">
    <h2>Toy Story</h2>
    <video width="280" controls>
        <source src="videos/toystory.mp4" type="video/mp4">
    </video>
    <br>
    <button class="like-btn" data-video-id="1">❤️ Curtir</button>
    <span id="likes-count-1">0</span> likes
</div>

<!-- Card de vídeo 2 -->
<div class="video-card">
    <h2>Rei Leão</h2>
    <video width="280" controls>
        <source src="videos/reileao.mp4" type="video/mp4">
    </video>
    <br>
    <button class="like-btn" data-video-id="2">❤️ Curtir</button>
    <span id="likes-count-2">0</span> likes
</div>

<script>
document.querySelectorAll('.like-btn').forEach(button => {
    button.addEventListener('click', function() {
        const videoId = this.dataset.videoId;

        fetch('curtir.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id_video=' + videoId
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                // Atualiza o contador
                document.getElementById('likes-count-' + videoId).textContent = data.total_likes;
                // Alterna o texto do botão
                this.textContent = data.curtido ? '💔 Descurtir' : '❤️ Curtir';
            } else {
                alert(data.message);
            }
        })
        .catch(err => console.error('Erro:', err));
    });
});
</script>

</body>
</html>
