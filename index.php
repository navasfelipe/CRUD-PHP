<?php
include("_top.php");
?>



</br>
<div class="row">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUnidade">
        Adicionar Empresa
    </button>
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
            include 'bd/banco.php';
            $pdo = Banco::conectar();
            $sql = 'SELECT * FROM empresas ORDER BY id DESC';
            $collection = $pdo->query($sql)->fetchAll();
            if (count($collection) != 0 || !empty($collection)) {

                foreach ($collection as $row) {
                    if ($row['rg'] == null) {
                        echo '<tr id="empresa_' . $row['id'] . '">';
                        echo '<th scope="row">' . $row['id'] . '</th>';
                        echo '<td>' . $row['nome'] . '</td>';
                        echo '<td>' . $row['cpfCnpj'] . '</td>';
                        echo '<td>' . $row['municipio'] . '</td>';
                        echo '<td>' . 'N/A' . '</td>';
                        echo '<td>' . 'N/A' . '</td>';
                        echo '<td width=250>';
                        echo '<a class="btn btn-primary" href="Empresa/detalheEmpresa.php?id=' . $row['id'] . '">Info</a>';
                        echo ' ';
                        echo '<a class="btn btn-warning" href="update.php?id=' . $row['id'] . '">Atualizar</a>';
                        echo ' ';
                        echo '<a class="btn btn-danger" href="javascript:void()" onclick="deletarEmpresa(' . $row['id'] . ')">Excluir</a>';
                        echo '</td>';
                        echo '</tr>';
                    } else {
                        echo '<tr>';
                        echo '<th scope="row">' . $row['id'] . '</th>';
                        echo '<td>' . $row['nome'] . '</td>';
                        echo '<td>' . $row['cpfCnpj'] . '</td>';
                        echo '<td>' . $row['municipio'] . '</td>';
                        echo '<td>' . $row['rg'] . '</td>';
                        echo '<td>' . $row['dtNascimento'] . '</td>';
                        echo '<td width=250>';
                        echo '<a class="btn btn-primary" href="Empresa/detalheEmpresa.php?id=' . $row['id'] . '">Info</a>';
                        echo ' ';
                        echo '<a class="btn btn-warning" href="update.php?id=' . $row['id'] . '">Atualizar</a>';
                        echo ' ';
                        echo '<a class="btn btn-danger" href="javascript:void()" onclick="deletarEmpresa(' . $row['id'] . ')">Excluir</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                }
                Banco::desconectar();
            } else {
                echo
                "<tr>
                                <td colspan='6'>Nenhum registro encontrado</td>
                            </tr>";
            }
            ?>

        </tbody>
    </table>
</div>
<?php
include("Empresa/inc/_modalAddEmpresa.php");
//include("inc/_modalEditEmpresa.php");
?>

<?php
include("_bottom.php");
//include("inc/_modalEditEmpresa.php");
?>