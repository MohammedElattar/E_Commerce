<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Orders</title>
    <link rel="apple-touch-icon" href="<?= APP_ASSETS ?>images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= APP_ASSETS ?>images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/pickers/flatpickr/flatpickr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/components.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/themes/dark-layout.css">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/plugins/forms/form-file-uploader.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <?= $this->view("admin/nav") ?>

    <!-- END: Header-->


    <?= $this->view("admin/sidebar") ?>

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Manage Orders</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="orders table text-center">
                                    <thead class="text-center">
                                        <tr>
                                            <th>id</th>
                                            <th>Client Name</th>
                                            <th>Qty</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="getOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Order Information</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Client Name</label>
                                            <input type="text" disabled value="Google" class="form-control" id ="client_name">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" disabled value="Google" class="form-control" id="client_email">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">City</label>
                                            <input type="text" disabled value="Google" class="form-control" id="client_city">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Address Name</label>
                                            <textarea type="text" disabled value="Google" class="form-control" id="client_address"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" disabled value="Google" class="form-control" id="client_phone">
                                        </div>
                                        <table class="table table-responsive text-center products-orders-table">
                                            <thead>
                                                <tr>
                                                    <td>Product Name</td>
                                                    <td>Qty</td>
                                                    <td>Price</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Basic table -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ms-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="<?= APP_ASSETS ?>vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/responsive.bootstrap5.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->
    <script src="<?= APP_ASSETS ?>vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/forms/select/select2.full.min.js"></script>
    <!-- BEGIN: Theme JS-->
    <script src="<?= APP_ASSETS ?>js/core/app-menu.js"></script>
    <script src="<?= APP_ASSETS ?>js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?= APP_ASSETS ?>js/scripts/tables/table-datatables-basic.js"></script>
    <script src="<?= APP_ASSETS ?>js/scripts/forms/form-number-input.js"></script>
    <script src="<?= APP_ASSETS ?>js/scripts/forms/form-select2.js"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>