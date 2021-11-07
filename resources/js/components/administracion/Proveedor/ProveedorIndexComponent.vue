<template>
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10 col-md-10">
                <h2 style="text-transform: uppercase">
                    <b>Proveedor</b>
                </h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a>Proveedor</a>
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
                                        @click="storeProveedor"
                                    >
                                        <i
                                            class="fa fa-plus"
                                            aria-hidden="true"
                                        ></i>
                                        Agregar Proveedor
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <datatable-proveedor-component></datatable-proveedor-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import DatatableProveedorComponent from "../../datatables/Proveedor/DatatableProveedorComponent.vue";
export default {
    components: { DatatableProveedorComponent },
    data() {
        return {};
    },
    methods:{
        storeProveedor: async function()
        {
                window.location.href=route('proveedor.create');
        }
    }
};
</script>
