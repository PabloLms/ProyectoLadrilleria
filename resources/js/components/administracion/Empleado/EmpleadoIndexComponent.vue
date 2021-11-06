<template>
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10 col-md-10">
                <h2 style="text-transform: uppercase">
                    <b>Empleado</b>
                </h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">
                        <a>Empleado</a>
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
                                        @click="storeEmpleado"
                                    >
                                        <i
                                            class="fa fa-plus"
                                            aria-hidden="true"
                                        ></i>
                                        Agregar Empleado
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <datatable-empleado-component></datatable-empleado-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import DatatableEmpleadoComponent from "../../datatables/Empleado/DatatableEmpleadoComponent.vue";
export default {
    components: { DatatableEmpleadoComponent },
    data() {
        return {};
    },
    methods:{
        storeEmpleado: async function()
        {
            var result=await this.$helperJs.verificarExistenciaTipoEmpleado()
            if(result.data.success)
            {
                window.location.href=route('empleado.create');
            }
            else{
                toastr.error(result.data.mensaje,"Error");
            }
        }
    }
};
</script>
