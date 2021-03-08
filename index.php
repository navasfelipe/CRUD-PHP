<?php
include("_top.php");
require_once('bd/banco.php');
require_once('Classes/ClassEmpresa.php');
?>

</br>
<div class="row">
    <div class="col-lg-6  mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUnidade">
            Adicionar Empresa
        </button>
    </div>
    <div class="col-lg-6  mb-3 text-right">
        <form id="formBusca">
            <input type="hidden" name="acao" id="acao" value="busca">
            <input type="text" name="busca" class="form" id="busca" placeholder="Pesquisar por Nome, CPF ou CNPJ">

            <input type="submit" name="submitBusca" id="submitBusca" value="Pesquisar">
        </form>
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
            $instancia = new Empresa();
            $linhasEmpresas = $instancia->listarEmpresas();
            if (count($linhasEmpresas) != 0 || !empty($linhasEmpresas)) {
                foreach ($linhasEmpresas as $linha) {
                    if ($linha['rg'] == null) {
            ?>
                        <tr id='<?php echo "empresa_" . $linha['id'] ?>'>
                            <th scope="row"><?php echo $linha['id'] ?></th>
                            <td><?php echo $linha['nome'] ?></td>
                            <td><?php echo $linha['cpfCnpj'] ?></td>
                            <td><?php echo $linha['cidade'] ?></td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td width=250>
                                <a class="btn btn-primary" href="Empresa/detalheEmpresa.php?id=<?php echo $linha['id'] ?>">Info</a>
                                &nbsp;
                                <a class="btn btn-danger" href="javascript:void()" onclick='<?php echo 'deletarEmpresa(' . $linha['id'] . ')' ?>'>Excluir</a>
                            </td>
                        </tr>
                    <?php
                    } else {
                    ?>
                        <tr id='<?php echo "empresa_" . $linha['id'] ?>'>
                            <th scope="row"><?php echo $linha['id'] ?></th>
                            <td><?php echo $linha['nome'] ?></td>
                            <td><?php echo $linha['cpfCnpj'] ?></td>
                            <td><?php echo $linha['cidade'] ?></td>
                            <td><?php echo $linha['rg'] ?></td>
                            <td><?php echo $linha['dtNascimento'] ?></td>
                            <td width=250>
                                <a class="btn btn-primary" href="Empresa/detalheEmpresa.php?id=<?php echo $linha['id'] ?>">Info</a>
                                &nbsp;
                                <a class="btn btn-danger" href="javascript:void()" onclick='<?php echo 'deletarEmpresa(' . $linha['id'] . ')' ?>'>Excluir</a>
                            </td>
                        </tr>
            <?php
                    }
                }
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