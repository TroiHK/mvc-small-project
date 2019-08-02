$(document).ready(function(){
    var selectAll = $("#selectAll");

    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Select/Deselect checkboxes
    selectAll.on('click', function(){
        var checkboxVisible = $('table tbody input[type="checkbox"]');

        if($(this).prop("checked")){
            checkboxVisible.each(function(){
                $(this).prop("checked", true);
            });
        } else {
            checkboxVisible.each(function(){
                $(this).prop("checked", false);
            });
        }
    });
    
    $(document).on('click','.paginate_button:not(.active) .page-link',function(){
        var checkboxVisible = $('table tbody input[type="checkbox"]');
        checkboxVisible.each(function(){
            $(this).prop("checked", false);
        });

        if ( selectAll.prop("checked") ) {
            selectAll.prop("checked", false);
        }
    });

    $(document).on('click','table tbody input[type="checkbox"]',function(){
        if(!$(this).prop("checked")){
            selectAll.prop("checked", false);
        }
    });

    // delete multi item
    $('.btn-deleteArr').on('click', function() {
        var dataCheckbox = [];
        var checkboxVisible = $('table tbody input[type="checkbox"]:checked');

        checkboxVisible.each(function(){
            dataCheckbox.push($(this).val());
        });

        var parent = $(this).attr('href');
        $(parent + ' .btn-delete').attr('href', $(this).attr('data-href') + dataCheckbox);
    });
});