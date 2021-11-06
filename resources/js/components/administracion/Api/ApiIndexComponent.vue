<template>
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10 col-md-10">
                <h2 style="text-transform: uppercase">
                    <b>Api</b>
                </h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a>Apis</a>
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
                                    <!-- <button
                                        type="button"
                                        class="btn btn-primary btn-agregar "
                                        @click="openModalStore"
                                    >
                                        <i
                                            class="fa fa-plus"
                                            aria-hidden="true"
                                        ></i>
                                        Agregar Api
                                    </button> -->
                                </div>
                            </div>
                            <div class="col-md-12">
                                <datatable-api-component
                                    ref="datatableApi"
                                ></datatable-api-component>
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
                            Crear credenciales de Api
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
                            <label for="">Http</label>
                            <input
                                type="text"
                                class="form-control form-control-sm"
                                :class="errores.http.error ? 'is-invalid' : ''"
                                v-model="http"
                            />
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errores.http.error"
                            >
                                <strong>{{ errores.http.mensaje }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="">Token</label>
                            <textarea
                                cols="30"
                                rows="2"
                                v-model="token"
                                class="form-control"
                                :class="errores.token.error ? 'is-invalid' : ''"
                            ></textarea>
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errores.token.error"
                            >
                                <strong>{{ errores.token.mensaje }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="">descripcion</label>
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
                            @click="storeApi"
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
import DatatableApiComponent from "../../datatables/Api/DatatableApiComponent.vue";
export default {
    components: { DatatableApiComponent },
    data() {
        return {
            http: "",
            token: "",
            descripcion: "",
            errores: {
                http: {
                    error: false,
                    mensaje: "",
                },
                token: {
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
        storeApi: function () {
            this.limpiarErrores();
            var $this = this;
            if (this.validaciones()) {
                var formdata = new FormData();
                formdata.append("http", this.http);
                formdata.append("token", this.token);
                formdata.append("descripcion", this.descripcion);
                axios
                    .post(route("api.store"), formdata)
                    .then((value) => {
                        if (value.data.success) {
                            $this.$refs.datatableApi.recargar();
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
            if (this.http.length == 0) {
                this.errores.http.error = true;
                this.errores.http.mensaje = "Falta ingresar http";
                resultado = false;
            }
            if (this.token.length == 0) {
                this.errores.token.error = true;
                this.errores.token.mensaje = "Falta ingresar token";
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
            this.http = "";
            this.token = "";
            this.descripcion = "";
            this.limpiarErrores();
        },
        limpiarErrores: function () {
            this.errores = {
                http: {
                    error: false,
                    mensaje: "",
                },
                token: {
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
