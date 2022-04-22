$(document).ready(function () {
    $("#datatable").DataTable(),
        $("#datatable-buttons").DataTable({
        lengthChange: 1,
        buttons: [{
            extend: 'copy',
            text: 'Copy to clipboard',
            exportOptions: {
                columns: ':not(:last-child)',
            }
        },
            {
                extend: 'excel',
                text: 'Export to excel',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: 'pdf',
                text: 'Export to pdf',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
            }]
    }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),
        $(document).ready(function () {
        $("#datatable2").DataTable()
    })
});