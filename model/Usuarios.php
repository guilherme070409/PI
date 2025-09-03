<?php
class usuario
{
    public static function buscarPorEmail($pdo, $email)
    {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function cadastrar($pdo, $email, $senha, $is_adm, $nome_de_usuario)
    {
        $stmt = $pdo->prepare("INSERT INTO usuarios (email, senha, is_adm, nome_de_usuario) VALUES (?, ?, ?,?)");
        return $stmt->execute([
            $email,
            password_hash($senha, PASSWORD_DEFAULT),
            $is_adm,  
            $nome_de_usuario
        ]);
    }

    public static function alterarSenha($pdo, $email, $novaSenha)
    {
        $stmt = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
        return $stmt->execute([
            password_hash($novaSenha, PASSWORD_DEFAULT),
            $email
        ]);
   }
   public static function buscarPorId($pdo, $id)
{
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}
?>
