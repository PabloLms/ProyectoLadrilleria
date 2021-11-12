<template>
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10 col-md-10">
                <h2 style="text-transform: uppercase">
                    <b>Tipos de Producto</b>
                </h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a>Tipos de Producto</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Inicio</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-right mb-2">
                                    <button
                                        type="button"
                                        class="btn btn-primary btn-agregar"
                                        @click="openModalStore"
                                    >
                                        <i
                                            class="fa fa-plus"
                                            aria-hidden="true"
                                        ></i>
                                        Agregar Tipo de Producto
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <datatable-tipo-producto-component
                                    ref="datatableTipoProducto"
                                >
                                </datatable-tipo-producto-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="modal fade"
            id="modalCreate"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Crear un nuevo Tipo de Producto
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
                            <label for="">Tipo</label>
                            <input
                                type="text"
                                class="form-control form-control-sm"
                                :class="errores.tipo.error ? 'is-invalid' : ''"
                                v-model="tipo"
                            />
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errores.tipo.error"
                            >
                                <strong>{{ errores.tipo.mensaje }}</strong>
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
                            @click="storeTipoProducto"
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
import DatatableTipoProductoComponent from "../../datatables/TipoProducto/DatatableTipoProductoComponent.vue";
export default {
    components: { DatatableTipoProductoComponent },
    data() {
        return {
            tipo: "",
            errores: {
                tipo: {
                    error: false,
                    mensaje: "",
                },
            },
        };
    },
    mounted() {},
    methods: {
        openModalStore: function () {
            this.limpiarErrores();
            $("#modalCreate").modal("show");
        },
        storeTipoProducto: function () {
            this.limpiarErrores();
            var $this = this;
            if (this.validaciones()) {
                var formdata = new FormData();
                formdata.append("tipo", this.tipo);
                axios
                    .post(route("tipoProducto.store"), formdata)
                    .then((value) => {
                        if (value.data.success) {
                            $this.$refs.datatableTipoProducto.recargar();
                            $this.limpiarModalCreate();
                            $("#modalCreate").modal("hide");
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
        validaciones: function () {
            var $this = this;
            var resultado = true;
            if (this.tipo.length == 0) {
                this.errores.tipo.error = true;
                this.errores.tipo.mensaje = "Falta ingresar tipo";
                resultado = false;
            }
            return !resultado ? false : true;
        },
        limpiarModalCreate: function () {
            this.tipo = "";
            this.limpiarErrores();
        },
        limpiarErrores: function () {
            this.errores = {
                tipo: {
                    error: false,
                    mensaje: "",
                }
            };
        },
    },
};
</script>
