/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from "vue";
import helperJs from "./helpers.js";
import vSelect from "vue-select";
// import LottieAnimation from "lottie-vuejs/src/LottieAnimation.vue"
Vue.component("v-select", vSelect);
require("./bootstrap");

window.Vue = require("vue").default;
const plugin = {
    install() {
        Vue.helperJs = helperJs;
        Vue.prototype.$helperJs = helperJs;
    },
};
Vue.use(plugin);
// Vue.use(LottieAnimation);
// const $ = require("jquery");
// window.$ = $;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "tipoempleadoindex-component",
    require("./components/administracion/tipoEmpleado/TipoEmpleadoIndexComponent.vue")
        .default
);
Vue.component(
    "tipoproductoindex-component",
    require("./components/ventas/tipoProducto/TipoProductoIndexComponent.vue")
        .default
);
Vue.component(
    "empresapersonalindex-component",
    require("./components/mantenimiento/EmpresaPersonal/EmpresaPersonalIndexComponent.vue")
        .default
);
Vue.component(
    "unidadmedidaindex-component",
    require("./components/mantenimiento/UnidadMedida/UnidadMedidaIndexComponent.vue")
        .default
);
Vue.component(
    "empleado-index-component",
    require("./components/administracion/Empleado/EmpleadoIndexComponent.vue")
        .default
);
Vue.component(
    "empleadocreate-component",
    require("./components/administracion/Empleado/EmpleadoCreateComponent.vue")
        .default
);
Vue.component(
    "api-index-component",
    require("./components/administracion/Api/ApiIndexComponent.vue").default
);
Vue.component(
    "cliente-index-component",
    require("./components/administracion/Cliente/ClienteIndexComponent.vue")
        .default
);
Vue.component(
    "proveedor-index-component",
    require("./components/administracion/Proveedor/ProveedorIndexComponent.vue")
        .default
);
Vue.component(
    "almacenindex-component",
    require("./components/mantenimiento/Almacen/AlmacenIndexComponent.vue")
        .default
);
Vue.component(
    "productoindex-component",
    require("./components/ventas/Producto/ProductoIndexComponent.vue").default
);
//Datatable

Vue.component(
    "datatabletipoempleado-component",
    require("./components/datatables/tipoEmpleado/DatatableTipoEmpleadoComponent.vue")
        .default
);
Vue.component(
    "datatabletipoproducto-component",
    require("./components/datatables/TipoProducto/DatatableTipoProductoComponent.vue")
        .default
);
Vue.component(
    "datatableempleado-component",
    require("./components/datatables/Empleado/DatatableEmpleadoComponent.vue")
        .default
);
Vue.component(
    "datatableapi-component",
    require("./components/datatables/Api/DatatableApiComponent.vue")
);
Vue.component(
    "datatablecliente-component",
    require("./components/datatables/Cliente/DatatableClienteComponent.vue")
);
Vue.component(
    "datatableproveedor-component",
    require("./components/datatables/Proveedor/DatatableProveedorComponent.vue")
);
Vue.component(
    "datatableunidadmedida-component",
    require("./components/datatables/UnidadMedida/DatatableUnidadMedidaComponent.vue")
);
Vue.component(
    "datatablealmacen-component",
    require("./components/datatables/Almacen/DatatableAlmacenComponent.vue")
);
//List
Vue.component(
    "producto-lista-component",
    require("./components/ventas/Producto/ProductoListaComponent.vue")
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
});
