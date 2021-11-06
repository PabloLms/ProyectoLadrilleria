<template>
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10 col-md-10">
                <h2 style="text-transform: uppercase">
                    <b>Cliente</b>
                </h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a>Cliente</a>
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
                                        @click="storeCliente"
                                    >
                                        <i
                                            class="fa fa-plus"
                                            aria-hidden="true"
                                        ></i>
                                        Agregar Cliente
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <datatable-cliente-component></datatable-cliente-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import DatatableClienteComponent from "../../datatables/Cliente/DatatableClienteComponent.vue";

export default {
    components: { DatatableClienteComponent },

    data() {
        return {};
    },
    methods: {
        storeCliente: async function () {
                window.location.href = route("cliente.create");
        },
    },
};
</script>
