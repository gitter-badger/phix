/* ИНИЦИАЛИЗАЦИЯ ПЛАГИНА DATATABLE */
$(document).ready(function() {
    $('table').DataTable({
        /*[[ order ]]*/
        /*[[ iDisplayLength ]]*/
        language: {
            url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json'
        },
        tableTools: {
            sSwfPath: "/assets/datatable/swf/copy_csv_xls_pdf.swf"
        },
        dom: 'T<"clear">lfrtip'
    });
});
