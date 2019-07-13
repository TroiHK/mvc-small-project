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
});
