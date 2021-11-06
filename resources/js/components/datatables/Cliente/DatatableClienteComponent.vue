<template>
    <div class="row">
        <div class="col-md-12">
            <table
                id="tableClientes"
                class="table table-striped table-bordered table-hover"
                style="width: 100%"
            >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
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
            id: "",
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
                                    .post(route("cliente.destroy", $this.id))
                                    .then((value) => {
                                        console.log(value)
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
                    // swal("Poof! Your imaginary file has been deleted!", {
                    //     icon: "success",
                    // });
                } else {
                    swal("Cancelado", "No se ha eliminado", "error");
                }
            });
        });
        $(document).on("click", ".btn-edit", function (e) {
            var datos = $this.table.row($(this).closest("tr")).data();
        });
    },
    methods: {
        datosInicializado: function () {
            this.table = $("#tableClientes").DataTable({
                bPaginate: true,
                bLengthChange: true,
                bFilter: true,
                bInfo: true,
                bAutoWidth: false,
                processing: true,
                ajax: route("cliente.getList"),
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
                        data: "documento",
                        className: "text-left",
                    },
                    {
                        data: "nombre",
                        className: "text-left",
                    },
                    {
                        data: "direccion",
                        className: "text-left",
                    },
                    {
                        data: "telefono",
                        className: "text-left",
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function (data) {
                            return (
                                "<div class='btn-group' style='text-transform:capitalize;'><button data-toggle='dropdown' class='btn btn-danger  btn-sm  dropdown-toggle'><i class='fa fa-bars'></i></button><ul class='dropdown-menu'>" +
                                "<li><a class='dropdown-item btn-edit' href='" +
                                route("cliente.edit", data.id) +
                                "' title='Modificar' ><b><i class='fa fa-edit'></i>Editar</a></b></li>" +
                                "<li><a class='dropdown-item btn-delete'  title='Eliminar'><b><i class='fa fa-trash'></i> Eliminar</a></b></li>" +
                                "</ul></div>"
                            );
                            // return '<div class="dropdown"><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown button</button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div></div>';
                        },
                    },
                ],
            });
        },
    },
};
</script>
