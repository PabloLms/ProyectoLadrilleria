$(document).ready(function () {
    $(".select2_form").select2({
        placeholder: "SELECCIONAR",
        allowClear: true,
        height: "200px",
        width: "100%",
    });
    $(".div-ruc").css("display", "none");
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
        loading: "Cargando ..."
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
$("#tipo_documento").on("change", function () {
    var tipo_documento = $("#tipo_documento").val();
    if (tipo_documento == "DNI") {
        $(".div-ruc").hide();
        $(".div-dni").show();
    } else {
        $(".div-dni").hide();
        $(".div-ruc").show();
    }
});
resizeJquerySteps();
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
