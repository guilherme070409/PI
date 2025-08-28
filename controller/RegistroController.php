<?php
session_start();
require_once '../model/Usuarios.php';
require_once '../model/Pessoa.php';
require_once '../service/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $is_adm = 2;
    $nome           = $_POST['fullName']         ?? '';
    $nomePai        = $_POST['fatherName']       ?? '';
    $nomeMae        = $_POST['motherName']       ?? '';
    $email          = $_POST['yourEmail']        ?? '';
    $telefone       = $_POST['telefone']         ?? '';
    $dataNascimento = $_POST['data_nascimento']  ?? '';
    $senha          = $_POST['password']         ?? '';
    $confirmarSenha = $_POST['confirmPassword']  ?? '';


    if ($senha !== $confirmarSenha) {
        $_SESSION['msg'] = "As senhas não estão iguais!";
        header('Location: ../view/registro.php');
        exit();
    }

    $registroFeito = pessoa::cadastrar(
        $pdo,
        $nomePai,
        $nomeMae,
        $telefone,
        $dataNascimento,
    );
       $registroFeito = usuario::cadastrar(
        $pdo,
        $email,
        $senha,
        $is_adm,
        $nome,
    );
    

    if ($registroFeito) {
        $_SESSION['msg'] = "Registro feito com sucesso!";
        header('Location: ../view/login.php');
        exit();
    } else {
        $_SESSION['erro'] = "Erro ao registrar usuário.";
        header('Location: ../view/registro.php');
        exit();
    }
}
?>
