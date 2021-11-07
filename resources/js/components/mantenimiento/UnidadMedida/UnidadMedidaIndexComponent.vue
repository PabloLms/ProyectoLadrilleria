<template>
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10 col-md-10">
                <h2 style="text-transform: uppercase">
                    <b>Unidad de Medida</b>
                </h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a>Unidad de Medida</a>
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
                                        Agregar Unidad de Medida
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <!-- <datatableunidadMedida-component ref="datatableUnidadMedida"
                                ></datatableunidadMedida-component> -->
                                <datatable-unidad-medida-component ref="datatableUnidadMedida"></datatable-unidad-medida-component>
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
                            Crear un nueva Unidad de Medida
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
                            @click="storeUnidadMedida"
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
import DatatableUnidadMedidaComponent from "../../datatables/UnidadMedida/DatatableUnidadMedidaComponent.vue";

export default {
    components: { DatatableUnidadMedidaComponent },
    data() {
        return {
            simbolo: "",
            descripcion: "",
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
        };
    },
    mounted() {},
    methods: {
        openModalStore: function () {
            this.limpiarErrores();
            $("#modalCreate").modal("show");
        },
        storeUnidadMedida: function () {
            this.limpiarErrores();
            var $this = this;
            if (this.validaciones()) {
                var formdata = new FormData();
                formdata.append("simbolo", this.simbolo);
                formdata.append("descripcion", this.descripcion);
                axios
                    .post(route("unidadMedida.store"), formdata)
                    .then((value) => {
                        if (value.data.success) {
                            $this.$refs.datatableUnidadMedida.recargar();
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
        limpiarModalCreate: function () {
            this.simbolo = "";
            this.descripcion = "";
            this.limpiarErrores();
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
