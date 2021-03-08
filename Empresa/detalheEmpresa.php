<?php
include("../_top.php");
require_once('../bd/banco.php');
require_once('../Classes/ClassEmpresa.php');
require_once('../Classes/ClassContato.php');
?>

</br>
<?php
try {
    $instanciaEmpresa = new Empresa();
    $linhaEmpresa = $instanciaEmpresa->detalheEmpresa($_GET['id']);
    $instanciaContatos = new Contato();
    $linhasContatos = $instanciaContatos->listarContatos($_GET['id']);
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
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cpfCnpj" class="col-form-label">PF/PJ</label>
                                <select onchange="mudarPfPj(this.value)" id="pfPj" class="form-control selectpicker required" required name="pj" required>
                                    <?php
                                    if (!empty($linhaEmpresa['rg'])) {
                                    ?>
                                        <option value='true'>Pessoa Jurídica</option>
                                        <option value="false" selected>Pessoa Física</option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value='true' selected>Pessoa Jurídica</option>
                                        <option value="false">Pessoa Física</option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nome" id="labelNome" class="col-form-label">Nome Fantasia</label>
                                <input type="text" class="form-control" id="nome" name="nome" value='<?php echo $linhaEmpresa['nome'] ?>' required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cidade" class="col-form-label">Cidade</label>
                                <input type="text" class="form-control required" id="cidade" name="cidade" value='<?php echo $linhaEmpresa['cidade'] ?>' required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cpfCnpj" id="labelCpfCnpj" class="col-form-label">CNPJ</label>
                                <input type="text" class="form-control" id="cpfCnpj" name="cpfCnpj" value='<?php echo $linhaEmpresa['cpfCnpj'] ?>' required>
                            </div>
                        </div>
                        <div class="form-row" id="pf_invisible" style="display:none">
                            <div class="form-group col-md-6">
                                <label for="rg" class="col-form-label">Documento de Identidade</label>
                                <input type="text" class="form-control" id="rg" name="rg" value='<?php echo $linhaEmpresa['rg'] ?>'>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="dtNascimento" class="col-form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="dtNascimento" name="dtNascimento" value='<?php echo $linhaEmpresa['dtNascimento'] ?>'>
                            </div>
                        </div>
                        </br>
                        <div class="form-row">
                            <div class="form-group col-md-12 text-center">
                                <button type="submit" id="submitAtualizarEmpresa" class="btn btn-primary font-weight-bold">Atualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
}
?>
<div class="row pt-5 pb-5">
    <div class="col-12">
        <h4 class="text-center">Informações de Contatos</h4>
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#modalContato">
            Adicionar Contato
        </button>
        <div class="card">
            <table class="table table-striped pb-6 mb-4">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Data de Cadastro</th>
                        <th scope="col">Data de Atualização</th>
                        <th scope="col">Telefones</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($linhasContatos)) {
                        foreach ($linhasContatos as $linhaContato) {
                    ?>
                            <tr id='contato_<?php echo $linhaContato['id'] ?>'>
                                <th scope="row"><?php echo $linhaContato['id'] ?></th>
                                <td><?php echo $linhaContato['nome'] ?></td>
                                <td><?php echo $linhaContato['cidade'] ?></td>
                                <td><?php echo $linhaContato['dtCadastro'] ?></td>
                                <td><?php echo $linhaContato['dtAlteracao'] ?></td>
                                <td>
                                    <?php

                                    $instanciaContatos->listarTelefones($linhaContato['id']);
                                    if (!empty($linhasTelefones)) {
                                        foreach ($linhasTelefones as $telefone) {
                                            echo $telefone['numeroTelefone'];
                                            echo "<br />";
                                        }
                                    } else {
                                        echo 'Nenhum telefone cadastrado';
                                    }

                                    ?>
                                </td>
                                <td width=250>
                                    <a class="btn btn-primary" href='<?php echo 'detalheContato.php?id=' . $linhaContato['id'] . '' ?>'>Editar</a>
                                    <a class="btn btn-danger" href="javascript:void()" onclick='<?php echo 'deletarContato(' . $linhaContato['id'] . ' )' ?>'>Excluir</a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>

                        <tr>
                            <td colspan="6" class="text-center">Nenhum contato cadastrado</td>
                        </tr>
                        </ <?php
                        }
                            ?> </tbody>
            </table>

        </div>
    </div>
</div>

<script>
    window.onload = function() {
        var select = document.getElementById("pfPj");
        var valor = select.options[select.selectedIndex].value;
        var div = document.getElementById("pf_invisible")
        if (valor == "true") {
            $("#labelNome").html("");
            $("#labelNome").append("Nome fantasia");
            $("#labelCpfCnpj").html("");
            $("#labelCpfCnpj").append("CNPJ");
            div.style.display = "none";
        } else {
            $("#labelNome").html("");
            $("#labelNome").append("Nome completo");
            $("#labelCpfCnpj").html("");
            $("#labelCpfCnpj").append("CPF");
            div.style.display = "block";
        }
    };
</script>

<?php
include("../_bottom.php");
include('inc/_modalAddContato.php');
?>