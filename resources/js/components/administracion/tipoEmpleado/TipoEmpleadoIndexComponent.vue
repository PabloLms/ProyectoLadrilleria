<template>
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10 col-md-10">
                <h2 style="text-transform: uppercase">
                    <b>Tipos de Empleado</b>
                </h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a>Tipos de Empleado</a>
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
                                        Agregar Tipo de Empleado
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <datatabletipoempleado-component
                                    :productos="productos"
                                ></datatabletipoempleado-component>
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
                            Crear un nuevo Tipo de Empleado
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
                            <input type="text" class="form-control form-control-sm" v-model="tipo">
                        </div>
                        <div class="form-group">
                            <label for="">Descripcion</label>
                            <textarea cols="30" rows="2" v-model="descripcion" class="form-control"></textarea>
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
                        <button type="button" class="btn btn-primary">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import DatatableTipoEmpleadoComponent from "../../datatables/tipoEmpleado/DatatableTipoEmpleadoComponent.vue";
export default {
    components: { DatatableTipoEmpleadoComponent },
    data() {
        return {
            tipo:"",
            descripcion:"",
            productos: [],
        };
    },
    mounted() {},
    methods: {
        openModalStore: function () {
            $("#modalCreate").modal("show");
        },
    },
};
</script>
