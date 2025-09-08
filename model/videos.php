<?php
class videos

{
   
    public static function cadastrar($pdo,$titulo,$url,$thumbnail,$descricao)
    {
        $stmt = $pdo->prepare("INSERT INTO videos (titulo, url, thumbnail, descricao) VALUES (:titulo, :url, :thumbnail, :descricao)");
        return $stmt->execute([
           ':titulo'    => $titulo,
            ':url'       => $url,
            ':thumbnail' => $thumbnail,
            ':descricao' => $descricao
        ]);

    }
}
?>
