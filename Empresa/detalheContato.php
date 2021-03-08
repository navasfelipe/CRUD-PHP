<?php
include("../_top.php");
require_once('../bd/banco.php');
require_once('../Classes/ClassEmpresa.php');
require_once('../Classes/ClassContato.php');
?>

</br>
<?php
try {

    $instanciaContatos = new Contato();
    $linhaContato = $instanciaContatos->detalheContato($_GET['id']);
    $linhasTelefones = $instanciaContatos->listarTelefones($linhaContato['id']);
    $instanciaEmpresa = new Empresa();
    $linhaEmpresa = $instanciaEmpresa->detalheEmpresa($linhaContato['empresaId']);
} catch (Exception $e) {
    echo $e;
}
if (!empty($instanciaEmpresa)) {
?>
    <div class="row">
        <div class="col-12">
            <h4 class="text-center">Informações Gerais</h4>
            <form id="atualizarEmpresaForm">
                <input type="hidden" name="acao" value="atualizar" />
                <input type="hidden" name="id" value='<?php echo $linhaEmpresa['id'] ?>' />
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped pb-6 mb-4">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Cidade</th>

                                    <?php
                                    if (!empty($linhaEmpresa['rg'])) {
                                    ?><th scope="col">CPF</th>
                                        <th scope="col">Documento de Identidade</th>
                                        <th scope="col">Data de Nascimento</th>
                                    <?php
                                    } else {
                                    ?>
                                        <th scope="col">CNPJ</th>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($linhaEmpresa)) {

                                ?>
                                    <tr id='contato_<?php echo $linhaEmpresa['id'] ?>'>
                                        <th scope="row"><?php echo $linhaEmpresa['id'] ?></th>
                                        <td><?php echo $linhaEmpresa['nome'] ?></td>
                                        <td><?php echo $linhaEmpresa['cidade'] ?></td>
                                        <td><?php echo $linhaEmpresa['cpfCnpj'] ?></td>
                                        <?php
                                        if (!empty($linhaEmpresa['rg'])) {
                                        ?>
                                            <td><?php echo $linhaEmpresa['rg'] ?></td>
                                            <td><?php echo $linhaEmpresa['dtNascimento'] ?></td>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                <?php

                                } else {
                                ?>

                                    <tr>
                                        <td colspan="6" class="text-center">Nenhum contato cadastrado</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
}
?>
<div class="row mb-5 mt-5">
    <div class="col-12">
        <h4 class="text-center">Informações do Contato</h4>
        <form id="atualizarContatoForm">
            <input type="hidden" name="acao" value="atualizar" />
            <input type="hidden" name="id" value='<?php echo $linhaContato['id'] ?>' />
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nome" id="labelNome" class="col-form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" value='<?php echo $linhaContato['nome'] ?>' required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cidade" class="col-form-label">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" value='<?php echo $linhaContato['cidade'] ?>' required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cidade" class="col-form-label">Data de Cadastro</label>
                            <p class="bold"><?php $dataHora = DateTime::createFromFormat('Y-m-d H:i:s', $linhaContato['dtCadastro']);
                                            echo $dataHora->format('d-m-Y H:i'); ?></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cidade" class="col-form-label">Data de Alteração</label>
                            <p class="bold"><?php $dataHora = DateTime::createFromFormat('Y-m-d H:i:s', $linhaContato['dtAlteracao']);
                                            echo $dataHora->format('d-m-Y H:i'); ?></p>
                        </div>
                    </div>
                </div>
                </br>
                <div class="form-row">
                    <div class="form-group col-md-12 text-center">
                        <button type="button" id="submitAtualizarContato" class="btn btn-primary font-weight-bold">Atualizar</button>
                        <a href="javascript:void()" onclick='<?php echo 'deletarContato(' . $linhaContato['id'] . ')' ?>' class="btn btn-danger font-weight-bold">Excluir</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row my-5">
    <div class="col-12">
        <h4 class="text-center">Telefones</h4>
        <button type="button" class="btn btn-primary m-4" data-toggle="modal" data-target="#modalTelefone">
            Adicionar Telefone
        </button>
        <form id="atualizarEmpresaForm">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped pb-6 mb-4">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Data de Cadastro</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($linhasTelefones)) {
                                for ($j = 0; $j < count($linhasTelefones); $j++) {
                            ?>
                                    <tr id='telefone_<?php echo $linhasTelefones[$j]['id'] ?>'>
                                        <th scope="row"><?php echo $linhasTelefones[$j]['id'] ?></th>
                                        <td><?php echo $linhasTelefones[$j]['numeroTelefone'] ?></td>
                                        <td><?php $dataHora = DateTime::createFromFormat('Y-m-d H:i:s', $linhasTelefones[$j]['dtCadastro']);
                                            echo $dataHora->format('d-m-Y H:i'); ?></td>
                                        <td width=250>
                                            <a class="btn btn-danger" href="javascript:void()" onclick='<?php echo 'deletarTelefone(' . $linhasTelefones[$j]['id'] . ' )' ?>'>Excluir</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>

                                <tr>
                                    <td colspan="6" class="text-center">Nenhum telefone cadastrado</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include("../_bottom.php");
//include('inc/_modalAddTelefone.php');
?>
<div class="modal fade" id="modalTelefone" tabindex="-1" role="dialog" aria-labelledby="modalTelefoneLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="addTelefone">
                <input type="hidden" name="contatoId" value='<?php echo $linhaContato['id'] ?>' />
                <input type="hidden" name="acao" value="addTelefone" />
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Contato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="numeroTelefone" class="col-form-label">Número do Telefone</label>
                                            <input type="text" class="form-control" id="numeroTelefone" name="numeroTelefone" value="" required>
                                        </div>
                                    </div> <!-- end card-body -->
                                </div>
                                <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="submitAddTelefone" class="btn btn-primary font-weight-bold">Adicionar</button>
                    </div>
            </form>
        </div>
    </div>
</div>