/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from "vue";
import helperJs from "./helpers.js";
require("./bootstrap");

window.Vue = require("vue").default;
const plugin = {
    install() {
        Vue.helperJs = helperJs;
        Vue.prototype.$helperJs = helperJs;
    },
};
Vue.use(plugin);
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
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component(
    "tipoempleadoindex-component",
    require("./components/administracion/tipoEmpleado/TipoEmpleadoIndexComponent.vue")
        .default
);
Vue.component(
    "empleadoindex-component",
    require("./components/administracion/Empleado/EmpleadoIndexComponent.vue")
        .default
);
Vue.component(
    "empleadocreate-component",
    require("./components/administracion/Empleado/EmpleadoCreateComponent.vue")
        .default
);
Vue.component(
    "apiindex-component",
    require("./components/administracion/Api/ApiIndexComponent.vue")
        .default
);
//Datatable

Vue.component(
    "datatabletipoempleado-component",
    require("./components/datatables/tipoEmpleado/DatatableTipoEmpleadoComponent.vue")
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
)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
});
