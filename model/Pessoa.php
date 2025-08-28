<?php
class pessoa
{
   
    public static function cadastrar($pdo, $nomePai, $nomeMae, $telefone, $dataNascimento,)
    {
        $stmt = $pdo->prepare("INSERT INTO pessoa (nome_pai, nome_mae, telefone,data_nascimento) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $nomePai,
            $nomeMae,
            $telefone,
            $dataNascimento
        ]);

      
        return $pdo->lastInsertId();
    }
}
?>