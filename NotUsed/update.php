<?php

require '../../db/banco.php';


if (empty($_GET['id'])) {
    echo "Id nulo";
    die();
}

$erro = "Erro no(s) campo(s): ";

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (empty($_POST['nome'])) {
            $erro .= 'nome';
            $validacao = False;
        }


        if (empty($_POST['cpfCnpj'])) {
            $erro .= ' + CPF/CNPJ';
            $validacao = False;
        }


        if (empty($_POST['municipio'])) {
            $erro .= ' + Município';
            $validacao = False;
        }


        if (empty($_POST['rg']) && $_POST['pj'] == false) {
            $erro .= ' + RG';
                $validacao = False;
        }


        if (empty($_POST['dtNascimento']) && $_POST['pj'] == false) {
            $erro .= ' + Data de Nascimento';
            $validacao = False;
        }
    

    // update data
        if ($validacao) {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE empresas  set nome = ?, cpfCnpj = ?, municipio = ?, rg = ?, dtNascimento = ? WHERE id = ?";
            $q  = $pdo->prepare($sql);
            $q->execute(array($_POST['nome'], $_POST['cpfCnpj'], $_POST['municipio'], $_POST['rg'], $_POST['dtNascimento'], $_POST['id']));
            Banco::desconectar();
            echo ("Ok");
        }
        } else {
            echo $erro;
        }
}
?>