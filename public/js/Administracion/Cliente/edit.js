$(document).ready(function () {
    $(".select2_form").select2({
        placeholder: "SELECCIONAR",
        allowClear: true,
        height: "200px",
        width: "100%",
    });
    verificarTipoDocumento();
});
$("#form").steps({
    bodyTag: "fieldset",
    transitionEffect: "fade",
    labels: {
        current: "actual paso:",
        pagination: "Paginación",
        finish: "Finalizar",
        next: "Siguiente",
        previous: "Anterior",
        loading: "Cargando ...",
    },
    onStepChanging: function (event, currentIndex, newIndex) {
        return true;
    },
    onStepChanged: function (event, currentIndex, priorIndex) {
        resizeJquerySteps();
    },
    onFinished: function (event, currentIndex) {
        var form = $(this);
        form.submit();
    },
});
$("#tipo_documento").on("change", verificarTipoDocumento);
resizeJquerySteps();
function verificarTipoDocumento() {
    var tipo_documento = $("#tipo_documento").val();
    if (tipo_documento == "DNI") {
        $(".div-ruc").hide();
        $(".div-dni").show();
    } else {
        $(".div-dni").hide();
        $(".div-ruc").show();
    }
}
function resizeJquerySteps() {
    $(".wizard .content").animate(
        { height: $(".body.current").outerHeight() },
        "slow"
    );
}
$("#departamento").on("change", getProvincias);
$("#provincia").on("change", getDistritos);
async function getProvincias() {
    var departamento = $("#departamento").val();
    await axios.get(route('ubigeo.getProvincias', departamento)).then((value) => {
        loading()
        $("#provincia").empty();
        var datos = value.data;
        datos.forEach((value, index, array) => {
            var newOption = new Option(value.nombre, value.id, false, false);
            $("#provincia")
                .append(newOption);
        });

        $("#provincia").trigger("change");
    })
}
function getDistritos() {
    var provincia = $("#provincia").val();
    axios.get(route('ubigeo.getDistritos', provincia)).then((value) => {
        $("#distrito").empty();
        var datos = value.data;
        datos.forEach((value, index, array) => {
            var newOption = new Option(value.nombre, value.id, false, false);
            $("#distrito")
                .append(newOption);
        });
        $("#distrito").trigger("change")
        loading()
    })
}
$("#consultarDocumento").on("click", function () {
    if ($("#numero_documento").val().length != 0) {
        var url = $("#tipo_documento").val() == "DNI" ? route('api.getDni', $("#numero_documento").val()) : route('api.getRuc', $("#numero_documento").val());
        var texto = $("#tipo_documento").val() == "DNI" ? 'Datos del Documento Dni' : 'Datos del Documento Ruc';
        swal({
            title: "¿Desea Consultar?",
            text: texto,
            icon: "warning",
            button: {
                text: "Buscar",
                closeModal: false,
            },
        })
            .then(() => {
                return fetch(url);
            })
            .then(results => {
                return results.json();
            })
            .then(json => {
                var datos = json.data;
                if ($("#tipo_documento").val() == "DNI") {
                    $("#nombres").val(datos.nombres)
                    $("#apellidos").val(datos.apellido_paterno + " " + datos.apellido_materno)
                    $("#direccion").val(datos.direccion)
                }
                else {
                    $("#nombre_comercial").val(datos.nombre_o_razon_social)
                    $("#razon_social").val(datos.nombre_o_razon_social)
                    $("#direccion").val(datos.direccion)
                }
                swal.close();
            })
            .catch(err => {
                if (err) {
                    swal("Oh no!", "Ocurrio un Error", "error");
                } else {
                    swal.stopLoading();
                    swal.close();
                }
            });

    }
    else {
        toastr.error("Ingrese el numero de documento");
    }

});
function loading() {
    $("#ibox1")
        .children(".ibox-content")
        .toggleClass("sk-loading");
}
