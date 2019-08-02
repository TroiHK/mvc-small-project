// Call the dataTables jQuery plugin
$(document).ready(function () {
    $('.dataTable').DataTable();

    $('.dataTable-checkbox, .dataTable-notOrder').DataTable({
        // "columnDefs": [ {
        //   "targets": 'nosort',
        //   "orderable": false,
        //   "searchable": false
        // } ],
        // "order": [],
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": pageLength * 1,
        "ordering": false,
        "autoWidth": false,
        "stateSave": true
    });

    $('.dataTable-ajax').DataTable({
        "ajax": $(this).attr('data-ajax'),
        "deferRender": true,
        "ordering": false,
        "autoWidth": false,
        "stateSave": true
    });

    $('.dataTable-nosearchlenght').DataTable({
        "pageLength": -1,
        "ordering": false,
        "lengthChange": false,
        "searching": false,
    });
});
