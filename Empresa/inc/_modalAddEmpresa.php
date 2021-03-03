<div class="modal fade" id="modalUnidade" tabindex="-1" role="dialog" aria-labelledby="modalUnidadeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="addEmpresaForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Empresas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="acao" value="adicionar" />
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="cpfCnpj" class="col-form-label">PF/PJ</label>
                                            <select onchange="mudarPfPj(this.value)" class="form-control selectpicker required" required name="pj" required>
                                                <option value='true'>Pessoa Jurídica</option>
                                                <option value="false">Pessoa Física</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nome" id="labelNome" class="col-form-label">Nome Fantasia</label>
                                            <input type="text" class="form-control" id="nome" name="nome" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="municipio" class="col-form-label">Cidade</label>
                                            <input type="text" class="form-control" id="municipio" name="municipio" value="" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="cpfCnpj" id="labelCpfCnpj" class="col-form-label">CNPJ</label>
                                            <input type="text" class="form-control" id="cpfCnpj" name="cpfCnpj" required>
                                        </div>
                                    </div>
                                    <div class="form-row" id="pf_invisible" style="display:none">
                                        <div class="form-group col-md-6">
                                            <label for="rg" class="col-form-label">Documento de Identidade</label>
                                            <input type="text" class="form-control" id="rg" name="rg">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="dtNascimento" class="col-form-label">Data de Nascimento</label>
                                            <input type="date" class="form-control" id="dtNascimento" name="dtNascimento">
                                        </div>
                                    </div>
                                </div> <!-- end card-body -->
                            </div>
                            <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="submitAddEmpresa" class="btn btn-primary font-weight-bold">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</div>