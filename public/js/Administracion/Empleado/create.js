$(document).ready(function () {
    $(".select2_form").select2({
        placeholder: "SELECCIONAR",
        allowClear: true,
        height: "200px",
        width: "100%",
    });
    verificarTipoDocumento();
    getProvincias();

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
function limpiar() {
    $(".logo").attr("src", "{{asset('storage/empresas/logos/default.jpg')}}");
    var fileName = "Seleccionar";
    $(".custom-file-label").addClass("selected").html(fileName);
    $("#logo").val("");
}
function seleccionarimagen() {
    var fileInput = document.getElementById("logo");
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png)$/i;
    $imagenPrevisualizacion = document.querySelector(".logo");
    if (allowedExtensions.exec(filePath)) {
        var userFile = document.getElementById("logo");
        userFile.src = URL.createObjectURL(event.target.files[0]);
        var data = userFile.src;
        $imagenPrevisualizacion.src = data;
        let fileName = $("#logo").val().split("\\").pop();
        $("#logo")
            .next(".custom-file-label")
            .addClass("selected")
            .html(fileName);
    } else {
        toastr.error(
            "Extensión inválida, formatos admitidos (.jpg . jpeg . png)",
            "Error"
        );
        $(".logo").attr(
            "src",
            "{{asset('storage/empresas/logos/default.png')}}"
        );
    }
}
$("#departamento").on("change", getProvincias);
$("#provincia").on("change", getDistritos);
async function getProvincias() {
    var departamento = $("#departamento").val();
    await axios.get(route('ubigeo.getProvincias', departamento)).then((value) => {
        loading()
        $("#provincia").empty();
        // $("#provincia")
        //     .val(null)
        //     .trigger("change");
        var datos = value.data;
        datos.forEach((value, index, array) => {
            var newOption = new Option(value.nombre, value.id, false, false);
            // Append it to the select
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
        // $("#distrito")
        //     .val(null)
        //     .trigger("change");
        var datos = value.data;
        datos.forEach((value, index, array) => {
            var newOption = new Option(value.nombre, value.id, false, false);
            // Append it to the select
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
            // button:"Consultar",
            //dangerMode: false,
        })
            .then(name => {
                if (!name) throw null;

                return fetch(`https://itunes.apple.com/search?term=${name}&entity=movie`);
            })
            .then(results => {
                return results.json();
            })
            .then(json => {
                const movie = json.results[0];

                if (!movie) {
                    return swal("No movie was found!");
                }

                const name = movie.trackName;
                const imageURL = movie.artworkUrl100;

                swal({
                    title: "Top result:",
                    text: name,
                    icon: imageURL,
                });
            })
            .catch(err => {
                if (err) {
                    swal("Oh noes!", "The AJAX request failed!", "error");
                } else {
                    swal.stopLoading();
                    swal.close();
                }
            });
        // .then(() => {
        //     return fetch(url);
        // }).then(results => {
        //     console.log(results.json())
        //     return results.json();
        // })
        //     .then(json => {
        //         console.log(json)
        //         swal.stopLoading();
        //         swal.close();
        //     })
        //     .catch(err => {
        //         console.log(err)
        //         if (err) {
        //             swal("Oh no!...", "Ocurrior un Problema ", "error");
        //         } else {
        //             swal.stopLoading();
        //             swal.close();
        //         }
        //     });
    }
    else {
        toastr.error("Ingrese el numero de documento");
    }
    // swal({
    //     title:"",
    //     text:"",
    //     icon: window.location.origin+"/img/loading.gif",
    //     buttons: false,
    //     closeOnClickOutside: false,
    //     // timer: 3000,
    //     //icon: "success"
    // });


});
function loading() {
    $("#ibox1")
        .children(".ibox-content")
        .toggleClass("sk-loading");
}
