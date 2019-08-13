<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!'); ?>
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; <a href="https://kilala.com.vn/" target="_blank" title="Kilala">kilala.com.vn</a> <?php echo date('Y') ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<!-- <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a> -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="/admin/login/?action=logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Select2 JavaScript-->
<script src="/assets/vendor/select2/select2.min.js"></script>

<!-- dropzone -->
<script src="/assets/vendor/dropzone/dist/min/dropzone.min.js"></script>

<!-- BigUpload-->
<script src="/vendor/BigUpload/js/main.js"></script>
<script type="text/javascript" charset="utf-8">
    bigUpload = new bigUpload();

    //The id of the file input
    bigUpload.inputField = 'file';

    //The id of the progress bar
    //Width of this element will change based on progress
    //Content of this element will display a percentage
    //See bigUpload.progressUpdate() to change this code
    bigUpload.progressBarField = 'progressBarFilled';

    //The id of the time remaining field
    //Content of this element will display the estimated time remaining for the upload
    //See bigUpload.progressUpdate() to change this code
    bigUpload.timeRemainingField = 'timeRemaining';

    //The id of the text response field
    //Content of this element will display the response from the server on success or error
    bigUpload.responseField = 'uploadResponse';

    //Size of file chunks to upload (in bytes)
    //Default: 1MB
    bigUpload.chunkSize = 1000000;

    //Max file size allowed (in bytes)
    //Default: 2GB
    bigUpload.maxFileSize = 2147483648;

    function upload(element) {
        $(element).attr("disabled", true);
        if (!$(element).closest('form').find('#file').val()) {
            $(element).closest('form').submit();
        }

        bigUpload.resetKey();
        bigUpload.processFiles();
    }
    function abort() {
        bigUpload.abortFileUpload();
    }
</script>

<!-- Custom scripts for all pages-->
<script src="/assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="/assets/js/demo/datatables-demo.js"></script>

<script src="/assets/js/select-checkboxs.js"></script>

<script src="/assets/js/custom.js"></script>

</body>

</html>
