<?php

require 'bd/banco.php';
require 'Classes/ClassEmpresa.php';
require 'Classes/ClassContato.php';

if ($_GET['modulo'] == 'empresa') {

    if ($_POST['acao'] == 'adicionar') {
        $nome = $_POST['nome'];
        $cpfCnpj = $_POST['cpfCnpj'];
        $cidade = $_POST['cidade'];
        $rg = $_POST['rg'];
        $pj = $_POST['pj'];
        $dtNascimento = $_POST['dtNascimento'];
        $acao = $_POST['acao'];
        $instancia = new Empresa(null, $nome, $cpfCnpj, $cidade, $rg, $pj, $dtNascimento, $acao);
        try {
            if ($instancia->validarDados()) {
                if (!$instancia->empresaExiste($nome, $cpfCnpj)) {
                    $instancia->adicionarEmpresa();
                    echo "Ok";
                } else echo "Nome ou CPF/CNPJ já cadastrados";
            } else echo "Falha ao adicionar a empresa";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } elseif ($_POST['acao'] == 'remover') {
        $id = $_POST['id'];
        $instancia = new Empresa();
        $instanciaContatos = new Contato();
        try {
            $instanciaContatos->removerTodosContatosDaEmpresa($id);
            $instancia->removerEmpresa($id);
            echo "Ok";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } elseif ($_POST['acao'] == 'busca') {
        $nome = $_POST['busca'];
        $instancia = new Empresa();
        try {
            $retorno = $instancia->empresaId($nome);
            echo $retorno;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } elseif ($_POST['acao'] == 'atualizar') {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cpfCnpj = $_POST['cpfCnpj'];
        $cidade = $_POST['cidade'];
        $rg = $_POST['rg'];
        $pj = $_POST['pj'];
        $dtNascimento = $_POST['dtNascimento'];
        $acao = $_POST['acao'];
        $instancia = new Empresa($id, $nome, $cpfCnpj, $cidade, $rg, $pj, $dtNascimento, $acao);
        $instanciaContatos = new Contato();
        try {
            if ($instancia->validarDados()) {
                $resposta = $instancia->atualizarEmpresa();
                echo $resposta;
            } else echo "Falha ao adicionar a empresa";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
} else 

if ($_GET['modulo'] == 'contato') {
    if ($_POST['acao'] == 'adicionar') {
        $nome = $_POST['nome'];
        $empresaId = $_POST['empresaId'];
        $cidade = $_POST['cidade'];
        $instancia = new Contato(null, $nome, $empresaId, $cidade);
        try {
            if ($instancia->validarDados()) {
                if (!$instancia->contatoExiste($nome, $empresaId)) {
                    $retorno = $instancia->adicionarContato($empresaId);
                    if ($retorno == 1) echo "Ok";
                } else echo "Contato já cadastrado";
            } else echo "Falha ao adicionar o contato";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } elseif ($_POST['acao'] == 'atualizar') {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cidade = $_POST['cidade'];
        $instancia = new Contato();
        try {
            $instancia->atualizarContato($id, $nome, $cidade);
            echo "Ok";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } elseif ($_POST['acao'] == 'remover') {
        $id = $_POST['id'];
        $instancia = new Contato();
        try {
            $instancia->removerContato($id);
            echo "Ok";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } elseif ($_POST['acao'] == 'addTelefone') {
        $contatoId = $_POST['contatoId'];
        $numeroTelefone = $_POST['numeroTelefone'];
        $instancia = new Contato();
        try {
            $instancia->adicionarTelefone($contatoId, $numeroTelefone);
            echo "Ok";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } elseif ($_POST['acao'] == 'removerTelefone') {
        $id = $_POST['id'];
        $instancia = new Contato();
        try {
            $instancia->removerTelefone($id);
            echo "Ok";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
if ($_GET['modulo'] == 'busca') {
    $busca = $_GET['term'];
    $instancia = new Empresa();
    try {
        $resultado = $instancia->buscaEmpresa($busca);
        echo $resultado;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
