<?php

require '../../bd/banco.php';
require 'ClassEmpresa.php';

if ($_POST['acao'] == 'adicionar') {
    $nome = $_POST['nome'];
    $cpfCnpj = $_POST['cpfCnpj'];
    $municipio = $_POST['municipio'];
    $rg = $_POST['rg'];
    $pj = $_POST['pj'];
    $dtNascimento = $_POST['dtNascimento'];
    $acao = $_POST['acao'];
    $instance = new Empresa(null, $nome, $cpfCnpj, $municipio, $rg, $pj, $dtNascimento, $acao);
    try {
        if ($instance->ValidarDados()) {
            if (!$instance->EmpresaExiste()) {
                $instance->AddEmpresa();
                echo "Ok";
            } else echo "Empresa já cadastrada";
        } else echo "Falha ao adicionar a empresa";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} elseif ($_POST['acao'] == 'remover') {
    $id = $_POST['id'];
    $instance = new Empresa($nome, $cpfCnpj, $municipio, $rg, $pj, $dtNascimento);
    try {
        if ($instance->ValidarDados()) {
            if (!$instance->EmpresaExiste()) {
                $instance->AddEmpresa();
            } else echo "Empresa já cadastrada";
        } else echo "Falha ao adicionar a empresa +" . $validacao;
        echo "Ok";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
