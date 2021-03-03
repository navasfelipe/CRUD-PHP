$(document).ready(function () {
    $("#submitAddEmpresa").click(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $.ajax({
            url: "Empresa/crud/addEmpresa.php",
            method: "POST",
            data: $("#addEmpresaForm").serialize(),
            success: function (response) {
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
});

function deletarEmpresa(id) {
    Swal.fire({
        title: "Remover Empresa?",
        text: "Esta ação não poderá ser desfeita",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim, Remover!",
        cancelButtonText: "Cancelar"
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: "Empresa/crud/deleteEmpresa.php",
                method: "POST",
                data: { id: id },
                success: function (response) {
                    if (response == "Ok") {
                        document.getElementById("empresa_" + id).remove();
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
            setTimeout(function () {
                window.location.reload(1);
            }, 2000);
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