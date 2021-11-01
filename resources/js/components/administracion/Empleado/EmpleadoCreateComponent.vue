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
                        <strong>Create</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <h2>Crear Empleado</h2>
                        <form id="form" action="#" class="wizard-big" v-if="render">
                            <h1>Datos Personales</h1>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for=""
                                                    >Tipo de Documento</label
                                                >
                                                <select id="tipo_documento">
                                                    <option value="DNI">
                                                        Dni
                                                    </option>
                                                    <option value="RUC">
                                                        Ruc
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for=""
                                                    >Numero de Documento</label
                                                >
                                                <input
                                                    v-model="tipo_documento"
                                                    type="text"
                                                    name="numero_documento"
                                                    id="numero_documento"
                                                    class="form-control"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label for="">Direccion</label>
                                                <input
                                                    type="text"
                                                    name="direccion"
                                                    id="direccion"
                                                    class="form-control"
                                                />
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Telefono</label>
                                                <input
                                                    type="number"
                                                    name="telefono"
                                                    id="telefono"
                                                    class="form-control"
                                                />
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for=""
                                                    >Fecha Nacimiento</label
                                                >
                                                <input
                                                    type="date"
                                                    name="fecha_nacimiento"
                                                    id="fecha_nacimiento"
                                                    class="form-control"
                                                />
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="">Genero</label>
                                                <select
                                                    name="genero"
                                                    id="genero"
                                                    class="
                                                        select2_form
                                                        form-control
                                                    "
                                                >
                                                    <option value="M">
                                                        Masculino
                                                    </option>
                                                    <option value="F">
                                                        Femenino
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for=""
                                                    >Estado Civil</label
                                                >
                                                <select
                                                    name="estado_civil"
                                                    id="estado_civil"
                                                    class="
                                                        select2_form
                                                        form-control
                                                    "
                                                >
                                                    <option value="Casado">
                                                        Casado
                                                    </option>
                                                    <option value="Viudo">
                                                        Viudo
                                                    </option>
                                                    <option value="Soltero">
                                                        Soltero
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <h1>Datos de Usuario</h1>
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6"></div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import "jquery-steps/build/jquery.steps.min.js";
// import "select2/dist/js/select2.min.js";
export default {
    data() {
        return {
            render:false,
            tipo_documento: "RUC",
        };
    },
    created() {},
    beforeMount() {},
    mounted() {
        $("#form").steps({
            bodyTag: "fieldset",
            onStepChanging: function (event, currentIndex, newIndex) {
                return true;
            },
            onFinished: function (event, currentIndex) {
                var form = $(this);
                form.submit();
            },
        });
this.$forceUpdate();
this.tipo_documento = "ff";
        //
        // $(".select2_form").select2();
    },
    updated()
    {

        this.$nextTick(() => {
            this.render=true
            this.tipo_documento = "ff";
            console.log(this.tipo_documento);
        });
    },

    methods: {
        changeTipoDocumento: function () {
            console.log("ff");
        },
    },
};
</script>
