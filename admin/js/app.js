//get the last value of the url
let urlNumber = window.location.href.split("/").length
let url = window.location.href.split("/", urlNumber)[urlNumber - 1].split("?")[0].split("#")[0]

/*if (url === "event-edit.php" || url === "event-add.php") {
    //Timepicker, Date range picker, Datemask
    $(function () {
        //translate
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '< Ant',
            nextText: 'Sig >',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd-mm-yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);
        $(function () {
            $("#date").datepicker();
        });
    })
}*/

if (url === "admin-list.php" || url === "event-list.php" ||
    url === "category-list.php" || url === "guests-list.php" ||
    url === "user-list.php") {
    //DataTables Translation
    $(function () {
        $('#registers').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                paginate: {
                    next: "Siguiente",
                    previous: "Anterior",
                    last: "Último",
                    first: "Primero"
                },
                info: "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros",
                infoFiltered: "(Filtrado de _MAX_ registros totales)",
                emptyTable: "No hay registros",
                infoEmpty: "0 registros",
                search: "Buscar:",
                sLengthMenu: "Ver _MENU_"
            }
        });
    });
}

if (url === "category-add.php" || url === "category-edit.php") { 
    $('#icon').iconpicker({ placement: "inline" })
    $('.iconpicker-search').attr("placeholder", "Filtro");
    
}