<template>
    <div class="row">
        <div class="col-md-12">
            <table
                id="tableParqueos"
                class="table table-striped table-bordered table-hover"
                style="width: 100%"
            >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Simbolo</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div
            class="modal fade"
            id="modalEdit"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Editar una unidad de Medida
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Simbolo</label>
                            <input
                                type="text"
                                class="form-control form-control-sm"
                                :class="errores.simbolo.error ? 'is-invalid' : ''"
                                v-model="simbolo"
                            />
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errores.simbolo.error"
                            >
                                <strong>{{ errores.simbolo.mensaje }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="">Descripcion</label>
                            <textarea
                                cols="30"
                                rows="2"
                                v-model="descripcion"
                                class="form-control"
                                :class="
                                    errores.descripcion.error
                                        ? 'is-invalid'
                                        : ''
                                "
                            ></textarea>
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errores.descripcion.error"
                            >
                                <strong>{{
                                    errores.descripcion.mensaje
                                }}</strong>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Cerrar
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="editTipoEmpleado"
                        >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import "datatables.net-bs4";
import "datatables.net-buttons-bs4";
// require( 'jszip' );
// require( 'pdfmake' );
// require( 'datatables.net-bs4' )();
// require( 'datatables.net-buttons-bs4' )();
// require( 'datatables.net-buttons/js/buttons.colVis.js' )();
// require( 'datatables.net-buttons/js/buttons.html5.js' )();
// require( 'datatables.net-buttons/js/buttons.print.js' )();
export default {
    data() {
        return {
            simbolo: "",
            descripcion: "",
            id: "",
            errores: {
                simbolo: {
                    error: false,
                    mensaje: "",
                },
                descripcion: {
                    error: false,
                    mensaje: "",
                },
            },
            table: null,
        };
    },
    mounted() {
        var $this = this;
        this.datosInicializado();
        $(document).on("click", ".btn-delete", function (e) {
            var datos = $this.table.row($(this).closest("tr")).data();
            $this.id = datos.id;
            swal({
                title: "Estas seguro?",
                text: "Eliminar Registro!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    axios
                        .post(route("unidadMedida.destroy", $this.id))
                        .then((value) => {
                            if (value.data.success) {
                                $this.table.ajax.reload();
                            } else {
                                console.log(value.data.mensaje);
                                toastr.error("Ocurrio un Error", "Error");
                            }
                        })
                        .catch((value) => {
                            toastr.error(value);
                        });
                } else {
                    swal("Cancelado", "No se ha eliminado", "error");
                }
            });
        });
        $(document).on("click", ".btn-edit", function (e) {
            var datos = $this.table.row($(this).closest("tr")).data();
            $this.simbolo = datos.simbolo;
            $this.descripcion = datos.descripcion;
            $this.id = datos.id;
            $this.showModalEdit();
        });
    },
    methods: {
        showModalEdit: function () {
            this.limpiarErrores();
            $("#modalEdit").modal("show");
        },
        datosInicializado: function () {
            this.table = $("#tableParqueos").DataTable({
                bPaginate: true,
                bLengthChange: true,
                bFilter: true,
                bInfo: true,
                bAutoWidth: false,
                processing: true,
                ajax: route("unidadMedida.getList"),
                language: {
                    url: window.location.origin + "/Spanish.json",
                    // '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                },
                columns: [
                    {
                        data: "id",
                        className: "text-center",
                    },
                    {
                        data: "simbolo",
                        className: "text-left",
                    },
                    {
                        data: "descripcion",
                        className: "text-left",
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function (data) {
                            return (
                                "<div class='btn-group' style='text-transform:capitalize;'><button data-toggle='dropdown' class='btn btn-danger  btn-sm  dropdown-toggle'><i class='fa fa-bars'></i></button><ul class='dropdown-menu'>" +
                                "<li><a class='dropdown-item btn-edit' href='#' title='Modificar' ><b><i class='fa fa-edit'></i>Editar</a></b></li>" +
                                "<li><a class='dropdown-item btn-delete'  title='Eliminar'><b><i class='fa fa-trash'></i> Eliminar</a></b></li>" +
                                "</ul></div>"
                            );
                            // return '<div class="dropdown"><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown button</button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div></div>';
                        },
                    },
                ],
            });
        },
        editTipoEmpleado: function () {
            var $this = this;
            this.limpiarErrores();
            if (this.validaciones()) {
                var formdata = new FormData();
                formdata.append("simbolo", this.simbolo);
                formdata.append("descripcion", this.descripcion);
                axios
                    .post(route("unidadMedida.update", $this.id), formdata)
                    .then((value) => {
                        if (value.data.success) {
                            $this.table.ajax.reload();
                            $("#modalEdit").modal("hide");
                        } else {
                            console.log(value.data.mensaje);
                            toastr.error("Ocurrio un Error", "Error");
                        }
                    })
                    .catch((value) => {
                        toastr.error(value);
                    });
            }
        },
        recargar: function () {
            this.table.ajax.reload();
        },
        validaciones: function () {
            var $this = this;
            var resultado = true;
            if (this.simbolo.length == 0) {
                this.errores.simbolo.error = true;
                this.errores.simbolo.mensaje = "Falta ingresar simbolo";
                resultado = false;
            }
            if (this.descripcion.length == 0) {
                this.errores.descripcion.error = true;
                this.errores.descripcion.mensaje = "Falta ingresar descripcion";
                resultado = false;
            }
            return !resultado ? false : true;
        },
        limpiarErrores: function () {
            this.errores = {
                simbolo: {
                    error: false,
                    mensaje: "",
                },
                descripcion: {
                    error: false,
                    mensaje: "",
                },
            };
        },
    },
};
</script>
