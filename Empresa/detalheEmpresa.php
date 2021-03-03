<?php

require '../bd/banco.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //dados da empresa
    $sqlEmpresa = "SELECT * FROM empresas where id = ?";
    $qEmpresa = $pdo->prepare($sqlEmpresa);
    $qEmpresa->execute(array($id));
    $rowEmpresa = $qEmpresa->fetch(PDO::FETCH_ASSOC);

    //dados dos contatos
    $sqlContatos = "SELECT * FROM contatos where empresaId = ?";
    $qContatos = $pdo->prepare($sqlContatos);
    $qContatos->execute(array($rowEmpresa['id']));
    $rowContatos = $qContatos->fetchAll(PDO::FETCH_ASSOC);
    Banco::desconectar();
}
?>

<?php
include("../_top.php");
?>

</br>
<div class="row">
    <div class="col-lg-12 text-center">
        <h3 class="text-center">Informações gerais</h3>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF/CNPJ</th>
                <th scope="col">Município</th>
                <th scope="col">RG</th>
                <th scope="col">Data de Nascimento</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($rowEmpresa) != 0 || !empty($rowEmpresa)) {

                if ($rowEmpresa['rg'] == null) {
                    echo '<tr id="empresa_' . $rowEmpresa['id'] . '">';
                    echo '<th scope="row">' . $rowEmpresa['id'] . '</th>';
                    echo '<td>' . $rowEmpresa['nome'] . '</td>';
                    echo '<td>' . $rowEmpresa['cpfCnpj'] . '</td>';
                    echo '<td>' . $rowEmpresa['municipio'] . '</td>';
                    echo '<td>' . 'N/A' . '</td>';
                    echo '<td>' . 'N/A' . '</td>';
                    echo '<td width=250>';
                    echo '<a class="btn btn-primary" class="btn btn-primary" href="javascript:void()" data-toggle="modal" data-target="#modalEditEmpresa">Editar Empresa</a>';
                    echo ' ';
                    echo '<a class="btn btn-danger" href="javascript:void()" onclick="deletarEmpresa(' . $rowEmpresa['id'] . ')">Excluir</a>';
                    echo '</td>';
                    echo '</tr>';
                } else {
                    echo '<tr>';
                    echo '<th scope="row">' . $rowEmpresa['id'] . '</th>';
                    echo '<td>' . $rowEmpresa['nome'] . '</td>';
                    echo '<td>' . $rowEmpresa['cpfCnpj'] . '</td>';
                    echo '<td>' . $rowEmpresa['municipio'] . '</td>';
                    echo '<td>' . $rowEmpresa['rg'] . '</td>';
                    echo '<td>' . $rowEmpresa['dtNascimento'] . '</td>';
                    echo '<td width=250>';
                    echo '<a class="btn btn-primary" class="btn btn-primary" href="javascript:void()" data-toggle="modal" data-target="#modalEditEmpresa">Editar Empresa</a>';
                    echo ' ';
                    echo '<a class="btn btn-danger" href="javascript:void()" onclick="deletarEmpresa(' . $rowEmpresa['id'] . ')">Excluir</a>';
                    echo '</td>';
                    echo '</tr>';
                }

                Banco::desconectar();
            } else {
                echo
                "<tr class='text-center'>
                    <td colspan='6'>Nenhum registro encontrado</td>
                </tr>";
            }
            ?>

        </tbody>
    </table>
</div>
<div class="row pt-4">
    <div class="col-lg-12 text-center">
        <h3 class="text-center">Informações de contatos</h3>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Data e Hora de Cadastro</th>
                <th scope="col">Data e Hora de Alteração</th>
                <th scope="col">Telefones</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($rowContatos != null && (count($rowContatos) != 0 || !empty($rowContatos))) {
                for ($i = 0; $i < count($rowContatos); $i++) {
                    echo '<tr id="empresa_' . $rowContatos[$i]['id'] . '">';
                    echo '<th scope="row">' . $rowContatos[$i]['id'] . '</th>';
                    echo '<td>' . $rowContatos[$i]['nome'] . '</td>';
                    echo '<td>' . $rowContatos[$i]['dtCadastro'] . '</td>';
                    echo '<td>' . $rowContatos[$i]['dtAlteracao'] . '</td>';
                    $pdo = Banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sqlTelefones = "SELECT * FROM telefones where contatoId = ?";
                    $qTelefones = $pdo->prepare($sqlTelefones);
                    $qTelefones->execute(array($rowContatos[$i]['id']));
                    $rowTelefones = $qTelefones->fetchAll(PDO::FETCH_ASSOC);
                    Banco::desconectar();
                    echo '<td>';
                    for ($j = 0; $j < count($rowTelefones); $j++) {
                        echo $rowTelefones[$j]["numeroTelefone"];
                    }
                    echo '</td>';
                    echo '<td width=250>';
                    echo '<a class="btn btn-primary" class="btn btn-primary" href="javascript:void()" data-toggle="modal" data-target="#modalEditContato">Editar</a>';
                    echo ' ';
                    echo '<a class="btn btn-danger" href="javascript:void()" onclick="deletarContato(' . $rowContatos[$i]['id'] . ')">Excluir</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo
                "<tr class='text-center'>
                    <td colspan='5'>Nenhum registro encontrado</td>
                </tr>";
            }
            ?>

        </tbody>
    </table>
</div>

<?php

include("../_bottom.php");

?>