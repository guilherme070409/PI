<?php
session_start();

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Área Admin</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Coming+Soon&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Cpolygon points='32,4 39,24 60,24 42,38 48,58 32,46 16,58 22,38 4,24 25,24' fill='%23FFD700' stroke='%23000' stroke-width='2'/%3E%3C/svg%3E'>
</head>
<body class="admin-body" style="font-family: 'Coming Soon', cursive;">
    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <span class="logo"><i class=""></i> MundoKids Admin</span>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-item active"><a href="#"><i class="fas fa-home"></i> Início</a></li>
            <li class="menu-item"><a href="#"><i class="fas fa-users"></i> Usuários</a></li>
            <li class="menu-item"><a href="#"><i class="fas fa-boxes"></i> Conteúdos</a></li>
            <li class="menu-item"><a href="#"><i class="fas fa-cogs"></i> Configurações</a></li>
            <li class="menu-item"><a href="#"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
        </ul>
    </aside>

    <main class="admin-main">
        <header class="admin-header">
            <div class="header-left">
                <h1>Bem-vindo, <?php echo isset($_SESSION['admin_nome']) ? htmlspecialchars($_SESSION['admin_nome']) : 'Administrador'; ?>!</h1>
            </div>
            <div class="user-profile">
                <img src="../assets/img/favicon.png" alt="Avatar" class="avatar">
                <div class="user-info">
                    <span class="user-name"><?php echo isset($_SESSION['admin_nome']) ? htmlspecialchars($_SESSION['admin_nome']) : 'Administrador'; ?></span>
                    <span class="user-role"><?php echo isset($_SESSION['admin_cargo'])  ? htmlspecialchars($_SESSION['admin_cargo']) : 'Administrador';?></span>
                </div>
            </div>
        </header>

        <section class="dashboard-content">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-info">
                        <h3>120</h3>
                        <p>Usuários</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-paint-brush"></i></div>
                    <div class="stat-info">
                        <h3>48</h3>
                        <p>Atividades</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-gamepad"></i></div>
                    <div class="stat-info">
                        <h3>23</h3>
                        <p>Jogos</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-video"></i></div>
                    <div class="stat-info">
                        <h3>36</h3>
                        <p>Vídeos</p>
                    </div>
                </div>
            </div>

            <div class="quick-actions">
                <h2>Conteúdo Kids</h2>
                <div class="actions-grid">
                    <div class="action-card kids-card">
                        <i class="fas fa-paint-brush kids-icon"></i>
                        <h3>Atividades</h3>
                        <p>Gerencie atividades criativas para as crianças.</p>
                        <button class="btn-action">Ver Atividades</button>
                    </div>
                    <div class="action-card kids-card">
                        <i class="fas fa-gamepad kids-icon"></i>
                        <h3>Jogos</h3>
                        <p>Adicione ou edite jogos divertidos e educativos.</p>
                        <button class="btn-action">Ver Jogos</button>
                    </div>
                    <div class="action-card kids-card">
                        <i class="fas fa-pencil-alt kids-icon"></i>
                        <h3>Desenhos</h3>
                        <p>Gerencie desenhos para colorir e criar.</p>
                        <button class="btn-action">Ver Desenhos</button>
                    </div>
                    <div class="action-card kids-card">
                        <i class="fas fa-video kids-icon"></i>
                        <h3>Vídeos</h3>
                        <p>Adicione vídeos educativos e divertidos.</p>
                        <button class="btn-action">Ver Vídeos</button>
                    </div>
                </div>
            </div>

            <div class="content-sections">
                <div class="section-card">
                    <div class="section-header">
                        <h3>Últimas Atividades</h3>
                        <a href="#" class="btn-link">Ver todas</a>
                    </div>
                    <div class="content-grid">
                        <div class="content-item">
                            <div class="content-thumbnail activity"><i class="fas fa-paint-brush"></i></div>
                            <div class="content-info">
                                <h4>Pintura de Animais</h4>
                                <p>Atividade de colorir animais da fazenda.</p>
                            </div>
                        </div>
                        <div class="content-item">
                            <div class="content-thumbnail activity"><i class="fas fa-puzzle-piece"></i></div>
                            <div class="content-info">
                                <h4>Quebra-cabeça</h4>
                                <p>Monte o quebra-cabeça dos personagens.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-card">
                    <div class="section-header">
                        <h3>Novos Jogos</h3>
                        <a href="#" class="btn-link">Ver todos</a>
                    </div>
                    <div class="content-grid">
                        <div class="content-item">
                            <div class="content-thumbnail"><i class="fas fa-gamepad"></i></div>
                            <div class="content-info">
                                <h4>Jogo da Memória</h4>
                                <p>Encontre os pares de cartas divertidas.</p>
                            </div>
                        </div>
                        <div class="content-item">
                            <div class="content-thumbnail"><i class="fas fa-rocket"></i></div>
                            <div class="content-info">
                                <h4>Corrida Espacial</h4>
                                <p>Ajude o foguete a chegar ao espaço!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-card">
                    <div class="section-header">
                        <h3>Desenhos para Colorir</h3>
                        <a href="#" class="btn-link">Ver todos</a>
                    </div>
                    <div class="content-grid">
                        <div class="content-item">
                            <div class="content-thumbnail"><i class="fas fa-pencil-alt"></i></div>
                            <div class="content-info">
                                <h4>Dinossauro</h4>
                                <p>Desenho de dinossauro para colorir.</p>
                            </div>
                        </div>
                        <div class="content-item">
                            <div class="content-thumbnail"><i class="fas fa-tree"></i></div>
                            <div class="content-info">
                                <h4>Floresta Encantada</h4>
                                <p>Desenho de floresta para colorir.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-card">
                    <div class="section-header">
                        <h3>Vídeos Recentes</h3>
                        <a href="#" class="btn-link">Ver todos</a>
                    </div>
                    <div class="content-grid">
                        <div class="content-item">
                            <div class="content-thumbnail"><i class="fas fa-video"></i></div>
                            <div class="content-info">
                                <h4>Aprendendo as Cores</h4>
                                <p>Vídeo educativo sobre as cores.</p>
                            </div>
                        </div>
                        <div class="content-item">
                            <div class="content-thumbnail"><i class="fas fa-music"></i></div>
                            <div class="content-info">
                                <h4>Música dos Números</h4>
                                <p>Canção divertida para aprender a contar.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
