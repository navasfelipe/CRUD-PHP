<?php

require '../../bd/banco.php';

if (!empty($_POST)) {
    //Delete do banco:
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM empresas where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_POST['id']));
    Banco::desconectar();
    echo "Empresa excluida com sucesso";
}
