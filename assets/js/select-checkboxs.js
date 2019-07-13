$(document).ready(function(){
    var selectAll = $("#selectAll");
    var dataCheckbox = [];
    var checkboxVisible = $('table tbody input[type="checkbox"]');
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();
    
    // Select/Deselect checkboxes
    selectAll.on('click', function(){
        if($(this).prop("checked")){
            checkboxVisible.each(function(){
                $(this).prop("checked", true);
                dataCheckbox.push($(this).val());
            });
        } else {
            checkboxVisible.each(function(){
                $(this).prop("checked", false);
            });
            dataCheckbox = [];
        }
    });

    checkboxVisible.on('click', function(){
        if(!$(this).prop("checked")){
            selectAll.prop("checked", false);
            dataCheckbox.splice( dataCheckbox.indexOf($(this).val()), 1 );
        } else {
            dataCheckbox.push($(this).val());
        }
    });

    // dataTables_paginate
    $('.dataTables_paginate .page-item:not(.active) .page-link').on('click', function () {
        console.log(checkboxVisible);
        checkboxVisible = $('table tbody input[type="checkbox"]');

        checkboxVisible.each(function(){
            $(this).prop("checked", false);
        });

        if ( selectAll.prop("checked") ) {
            selectAll.prop("checked", false);
        }
    });

    // delete multi item
    $('.btn-deleteArr').on('click', function() {
        var parent = $(this).attr('href');
        $(parent + ' .btn-delete').attr('href', $(this).attr('data-href') + dataCheckbox);
    });
});