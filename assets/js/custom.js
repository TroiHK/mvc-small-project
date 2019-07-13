$(document).ready(function(){
    // delete-item
    $('.delete-item').on('click', function() {
        $('.wrap-delete-item .btn-delete').attr('href', $(this).attr('data-href'));
    });

    // edit-item
    $('.edit-item').on('click', function() {

    });
});