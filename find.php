<?php
 $pdo = new PDO("mysql:host=localhost; dbname=db_sac; charset=utf8;", "root", "011224", $opcoes);
 $dados = $pdo->prepare("SELECT nome_cliente FROM cliente");
 $dados->execute();
 echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
 ?>