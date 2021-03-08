<?php
require_once('../bd/banco.php');
$pdo = Banco::conectar();
$sqlEmpresas = 'SELECT * FROM empresas ORDER BY id DESC';
$empresas = $pdo->query($sqlEmpresas)->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($empresas);

$sqlContatos = 'SELECT * FROM contatos ORDER BY empresaId DESC';
$contatos = $pdo->query($sqlContatos)->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($contatos);

$sqlTelefones = 'SELECT * FROM telefones ORDER BY contatoId DESC';
$telefones = $pdo->query($sqlTelefones)->fetchAll(PDO::FETCH_ASSOC);
Banco::desconectar();
echo json_encode($telefones);
