<div class="modal fade" id="modalContato" tabindex="-1" role="dialog" aria-labelledby="modalContatoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="addContatoForm">
                <input type="hidden" name="empresaId" value='<?php echo $linhaEmpresa['id'] ?>' />
                <input type="hidden" name="acao" value="adicionar" />
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
                                        <div class="form-group col-md-6">
                                            <label for="nome" id="labelNome" class="col-form-label">Nome</label>
                                            <input type="text" class="form-control" id="nome" name="nome" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="cidade" class="col-form-label">Cidade</label>
                                            <input type="text" class="form-control" id="cidade" name="cidade" value="" required>
                                        </div>
                                    </div> <!-- end card-body -->
                                </div>
                                <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="submitAddContato" class="btn btn-primary font-weight-bold">Adicionar</button>
                    </div>
            </form>
        </div>
    </div>
</div>