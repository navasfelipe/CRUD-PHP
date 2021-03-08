$(document).ready(function () {
    $("#submitAddEmpresa").click(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $.ajax({
            url: "/royal/acoes.php?modulo=empresa",
            method: "POST",
            data: $("#addEmpresaForm").serialize(),
            success: function (response) {
                console.log(response)
                if (response == "Ok") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Empresa cadastrada com sucesso!',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 3000
                    });
                } else {
                    console.log(response);
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 3000
                    })
                }
            }
        });
        setTimeout(function () {
            window.location.reload(1);
        }, 3000);
    });

    $("#submitAtualizarEmpresa").click(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $.ajax({
            url: "/royal/acoes.php?modulo=empresa",
            method: "POST",
            data: $("#atualizarEmpresaForm").serialize(),
            success: function (response) {
                if (response == "Ok") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Empresa atualizada com sucesso!',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 3000
                    });
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 3000
                    })
                }
            }
        });
    });

    $("#submitAddContato").click(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $.ajax({
            url: "/royal/acoes.php?modulo=contato",
            method: "POST",
            data: $("#addContatoForm").serialize(),
            success: function (response) {
                console.log(response)
                if (response == "Ok") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Contato cadastrado com sucesso!',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 3000
                    });
                } else {
                    console.log(response);
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 3000
                    })
                }
            }
        });
        setTimeout(function () {
            window.location.reload(1);
        }, 2000);
    });

    $("#submitAtualizarContato").click(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $.ajax({
            url: "/royal/acoes.php?modulo=contato",
            method: "POST",
            data: $("#atualizarContatoForm").serialize(),
            success: function (response) {
                console.log(response)
                if (response == "Ok") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Contato cadastrado com sucesso!',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 2000
                    });
                } else {
                    console.log(response);
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 2000
                    })
                }
            }
        });
        setTimeout(function () {
            window.location.reload(1);
        }, 1000);
    });

    $("#submitAddTelefone").click(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $.ajax({
            url: "/royal/acoes.php?modulo=contato",
            method: "POST",
            data: $("#addTelefone").serialize(),
            success: function (response) {
                console.log(response)
                if (response == "Ok") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Contato cadastrado com sucesso!',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 3000
                    });
                } else {
                    console.log(response);
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 3000
                    })
                }
            }
        });
        setTimeout(function () {
            window.location.reload(1);
        }, 1000);
    });
    $("#submitBusca").click(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $.ajax({
            url: "/royal/acoes.php?modulo=empresa",
            method: "POST",
            data: $("#formBusca").serialize(),
            success: function (response) {
                window.location.href = "/royal/Empresa/detalheEmpresa.php?id=" + response;

            }
        });
        setTimeout(function () {
            window.location.reload(1);
        }, 3000);
    });
});

function deletarEmpresa(id) {
    Swal.fire({
        title: "Remover Empresa?",
        text: "Esta ação não poderá ser desfeita e todos os contatos e telefones serão apagados",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim, Remover!",
        cancelButtonText: "Cancelar"
    }).then(function (result) {
        console.log(result)
        if (result.value) {
            $.ajax({
                url: "/royal/acoes.php?modulo=empresa",
                method: "POST",
                data: {
                    id: id,
                    acao: 'remover'
                },
                success: function (response) {
                    console.log(response)
                    if (response == "Ok") {
                        //document.getElementById("empresa_" + id).remove();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Empresa removida!',
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 2000
                        })
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 2000
                        })
                    }
                }
            });
            window.location.href = "/royal/index.php";
        }
    })
}

function deletarContato(id) {
    Swal.fire({
        title: "Remover Contato?",
        text: "Esta ação não poderá ser desfeita",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim, Remover!",
        cancelButtonText: "Cancelar"
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: "/royal/acoes.php?modulo=contato",
                method: "POST",
                data: {
                    id: id,
                    acao: 'remover'
                },
                success: function (response) {
                    if (response == "Ok") {
                        //document.getElementById("contato_" + id).remove();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Contato removido!',
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 2000
                        })
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 2000
                        })
                    }
                }
            });
            window.location.href = "/royal/index.php";
        }
    })
}

function deletarTelefone(id) {
    Swal.fire({
        title: "Remover Contato?",
        text: "Esta ação não poderá ser desfeita",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim, Remover!",
        cancelButtonText: "Cancelar"
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: "/royal/acoes.php?modulo=contato",
                method: "POST",
                data: {
                    id: id,
                    acao: 'removerTelefone'
                },
                success: function (response) {
                    if (response == "Ok") {
                        //document.getElementById("contato_" + id).remove();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Contato removido!',
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 2000
                        })
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 2000
                        })
                    }
                }
            });
            setTimeout(function () {
                window.location.reload(1);
            }, 1000);
        }
    })
}

function mudarPfPj(valor) {
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

}

$(function () {

    // Atribui
    $("#busca").autocomplete({
        minLength: 2,
        source: "/royal/acoes.php?modulo=busca"
    });
})
