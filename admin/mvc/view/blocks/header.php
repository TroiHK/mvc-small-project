<?php if (!defined('PATH_SYSTEM')) die('Bad requested!'); ?>
<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE ?>">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KILALA BackNumber Systems</title>

    <!-- Custom fonts for this template -->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Select2 styles for this template -->
    <link href="/assets/vendor/select2/select2.min.css" rel="stylesheet">
    <link href="/vendor/BigUpload/style.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script>
        var pageLength = <?php echo isset($_SESSION['setting']['row']) && !empty($_SESSION['setting']['row']) ? $_SESSION['setting']['row'] : 10 ?>

        if (localStorage.getItem("row")) {
            pageLength = localStorage.getItem("row");
        }
    </script>

</head>

<body id="page-top" class="loading sidebar-toggled" style="overflow-y:scroll;">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Main Content -->
        <div id="content-wrapper" class="d-flex flex-column">