<?php

require '../../bd/banco.php';
require 'ClassEmpresa.php';

if ($_POST['AddEmpresa'] == true) {
    $nome = $_POST['nome'];
    $cpfCnpj = $_POST['cpfCnpj'];
    $municipio = $_POST['municipio'];
    $rg = $_POST['rg'];
    $pj = $_POST['pj'];
    $dtNascimento = $_POST['dtNascimento'];
    $instance = new Empresa($nome, $cpfCnpj, $municipio, $rg, $pj, $dtNascimento);
    if ($validacao = $instance->ValidarDados()) {
        if (!$instance->EmpresaExiste()) {
            $instance->AddEmpresa();
        } else echo "Empresa já cadastrada";
    } else echo "Falha ao adicionar a empresa +" . $validacao;
    echo "Ok";
}
