$(document).ready(function () {
    // delete-item
    $(document).on('click','.delete-item',function(){
        $('.wrap-delete-item .btn-delete').attr('href', $(this).attr('data-href'));
    });

    // showPdf-item
    $(document).on('click', '.show-pdf', function(){
        var dataImages = $(this).attr('data-images').split(",");
        var dataTexts = $(this).attr('data-texts').split(",");
        var pdfPage = $(this).attr('data-pdf-page').split("~");
        var pdfLink = '';
        var htmlBody = '';
        var htmlFooter = '';
        var imgdownload = '';
        var multiImage = false;
        var modalBody = $('#showPdfModal .modal-body');
        var modalFooter = $('#showPdfModal .modal-footer');

        modalBody.empty();
        modalFooter.empty();

        if ( dataImages.length > 1 ) {

            multiImage = true;

            htmlBody += '<div id="pdf-slide" class="carousel slide" data-ride="carousel" data-wrap="false" data-interval="false">';

            htmlBody += '<div class="carousel-inner">';
            for (var i = 0; i < dataImages.length; i++) {
                htmlBody += '<div class="carousel-item' + (i == 0 ? ' active' : '') + '">';
                htmlBody += '<img class="img-fluid" src="/' + dataImages[i] + '" alt="' + dataImages[i] + 's">';
                htmlBody += '</div>';
            }
            htmlBody += '</div>';

            htmlBody += '<a class="carousel-control-prev" href="#pdf-slide" data-slide="prev">';
            htmlBody += '<span class="carousel-control-prev-icon"></span>';
            htmlBody += '</a>';
            htmlBody += '<a class="carousel-control-next" href="#pdf-slide" data-slide="next">';
            htmlBody += '<span class="carousel-control-next-icon"></span>';
            htmlBody += '</a>';

            htmlBody += '<div class="page-number">';
            htmlBody += pdfPage[0];
            htmlBody += '</div>';

            htmlBody += '</div>';

        } else {
            htmlBody = '<img class="img-fluid" src="/' + dataImages[0] + '" alt="' + dataImages[0] + '" />';
            imgdownload += 'href="/' + dataImages[0] + '" download';
        }

        htmlFooter += '<div class="row">';
        htmlFooter += '<div class="col-auto">';
        htmlFooter += '<span style="margin-right: 10px;">' + dataTexts[0] + ': ' + $(this).attr('data-vol-id') + '</span>';
        htmlFooter += '<span style="margin-right: 10px;">' + dataTexts[1] + ': ' + $(this).attr('data-pdf-page') + '</span>';
        htmlFooter += '<span>' + dataTexts[2] + ': ' + $(this).attr('data-book-page') + '</span>';
        htmlFooter += '</div>';
        htmlFooter += '<div class="col-auto ml-auto">';
        htmlFooter += '<a' + ( multiImage ? ' class="download-all" href="#"' : '' ) + ' style="margin-right: 20px;"' + ( !multiImage ? ' ' + imgdownload : '' ) + '>';
        htmlFooter += '<i class="fas fa-cloud-download-alt text-primary"></i>';
        htmlFooter += '</a>';
        pdfLink = '/admin/pdf.php?q=' + $(this).attr('data-vol') + '#page=';
        htmlFooter += '<a class="pdf-link" href="/admin/pdf.php?q=' + $(this).attr('data-vol') + '#page=' + pdfPage[0] + '" target="_blank"><i class="far fa-file-pdf text-danger"></i></a>';
        htmlFooter += '</div>';
        htmlFooter += '<div class="d-none" id="img-download">';
        htmlFooter += '<ul class="d-flex flex-center justify-content-center mb-0"><li><a class="btn-download-single" href="/' + dataImages[0] + '" download>' + dataTexts[3] + '</a></li>';
        htmlFooter += '<li class="ml-5"><a class="btn-download-all" target="_blank" href="/admin/download-all.php?q=' + dataImages + '">' + dataTexts[4] + '</a></li></ul>';
        htmlFooter += '</div>';
        htmlFooter += '</div>';

        modalBody.removeClass('loadding').html(htmlBody);
        modalFooter.html(htmlFooter);

        $('#pdf-slide').bind('slide.bs.carousel', function (e) {
            if ( e.direction == 'left' ) {
                var number1 = ($('.page-number').html()*1) + 1;
                $('.page-number').html(number1);
                $('#showPdfModal .pdf-link').attr('href', pdfLink + number1);
                $('#showPdfModal .btn-download-single').attr('href', '/' + dataImages[number1 - pdfPage[0]*1]);
            }
            if ( e.direction == 'right' ) {
                var number2 = ($('.page-number').html()*1) - 1;
                $('.page-number').html(number2);
                $('#showPdfModal .pdf-link').attr('href', pdfLink + number2);
                $('#showPdfModal .btn-download-single').attr('href', '/' + dataImages[number2 - pdfPage[0]*1]);
            }
        });
    });

    $(document).on('click', '.download-all', function() {
        $('#img-download').toggleClass('d-none');
        return false;
    });

    // edit-item
    $('.edit-item').on('click', function () {

    });

    // select2
    $('.select2').select2();

    $('.dataTables_wrapper .custom-select').change(function(){
        localStorage.setItem("row", $(this).val());
    });
});

$(window).on("load", function () {
    $('body').removeClass('loading');
})