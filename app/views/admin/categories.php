<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Categories</title>
    <link rel="apple-touch-icon" href="<?= APP_ASSETS ?>images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= APP_ASSETS ?>images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?= APP_ASSETS ?>vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?= APP_ASSETS ?>vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?= APP_ASSETS ?>vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?= APP_ASSETS ?>vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
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
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

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
                            <h2 class="content-header-title float-start mb-0">Categories</h2>
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
                                <table class="datatables-basic table text-center">
                                    <thead class="text-center">
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th>
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
                    <!-- Modal to add new record -->
                    <!-- Button trigger modal -->
                    <?php if (isset($_SESSION['category']) && $_SESSION['category'][2]):?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategory">
                        Add Category
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Insert New Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= ROOT ?>ajax/categories/add" class="category-add" onsubmit="addCategory(event)">
                                        <div class="mb-3">
                                            <div class="alert alert-danger text-center name" style="display:none;">Name Must Have Only Characters</div>
                                            <div class="alert alert-danger text-center exists" style="display:none;">This Category Is Already Exists</div>
                                            <div class="alert alert-success text-center success" style="display:none;">Added Successfully</div>
                                            <label for="cat_name" class="form-label">Category Name</label>
                                            <input type="text" class="form-control" id="add_cat_name" name="name">
                                        </div>
                                        <input type="submit" value="Add Category" class="btn btn-primary">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['category']) && $_SESSION['category'][1]):?>

                    <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= ROOT ?>ajax/categories/edit" class="category-edit">
                                        <div class="mb-3">
                                        <div class="alert alert-danger text-center edit-name" style="display:none;">Name Must Have Only Characters</div>
                                            <div class="alert alert-danger text-center edit-exists" style="display:none;">This Category Is Already Exists</div>
                                            <div class="alert alert-success text-center edit-success" style="display:none;">Updated Successfully</div>
                                            <label for="cat_name" class="form-label">Category Name</label>
                                            <input type="text" class="form-control" id="edit_cat_name" name="name">
                                        </div>
                                        <input type="submit" value="Edit Category" class="btn btn-primary">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif?>
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

    <!-- BEGIN: Theme JS-->
    <script src="<?= APP_ASSETS ?>js/core/app-menu.js"></script>
    <script src="<?= APP_ASSETS ?>js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?= APP_ASSETS ?>js/scripts/tables/table-datatables-basic.js"></script>
    <script>

    </script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function () {
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