<template>
    <div class="row">
        <div class="col-md-12">
            <table
                id="tableParqueos"
                class="table table-striped table-bordered table-hover"
                style="width: 100%"
            >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipo</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item,index) in productos" :key="item.id">
                        <td>{{index}}</td>
                        <td>{{item.tipo}}</td>
                        <td>{{item.descripcion}}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
// import 'jquery/dist/jquery.min.js';
// // import "datatables.net-dt/js/dataTables.dataTables"
// // import "datatables.net-dt/css/jquery.dataTables.min.css"
// import 'jzip/dist/jzip.min.js';
// import 'pdfmake/dist/pdfmake.min.js'
// import 'datatables.net-bs4/js/dataTables.bootstrap4'
import 'datatables.net-bs4'
// require( 'jszip' );
// require( 'pdfmake' );
// require( 'datatables.net-bs4' )();
// require( 'datatables.net-buttons-bs4' )();
// require( 'datatables.net-buttons/js/buttons.colVis.js' )();
// require( 'datatables.net-buttons/js/buttons.html5.js' )();
// require( 'datatables.net-buttons/js/buttons.print.js' )();
export default {
    props: ["productos"],
    // data()
    // {
    //     return {
    //         productos:[]
    //     }
    // },
    mounted() {
        $('#tableParqueos').DataTable(
            {
                language: {
                    url: window.location.origin+"/Spanish.json"
                    // '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                },
            }
        );
    },
};
</script>
