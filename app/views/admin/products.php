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
    <title>Products</title>
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
                            <h2 class="content-header-title float-start mb-0">Products</h2>
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
                                <table class="products table text-center">
                                    <thead class="text-center">
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Images</th>
                                            <th>Category</th>
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
                    <?php if (isset($_SESSION['product']) && $_SESSION['product'][2]) : ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProduct" onclick="addProduct()">
                            Add Product
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Insert New Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <style>
                                            .products-errors div {
                                                display: none;
                                            }
                                        </style>
                                        <div cass="d-flex flex-wrap justify-content-center text-center products-errors">
                                            <div class="alert alert-danger error-name" style="text-align:center;display:none;">Type A Valid Product Name</div>
                                            <div class="alert alert-danger error-category" style="text-align:center;display:none;">You Must Select One Enabled Category</div>
                                            <div class="alert alert-danger error-description" style="text-align:center;display:none;">Add Your Product Description</div>
                                            <div class="alert alert-danger error-quantity" style="text-align:center;display:none;">Quantity Must Be Greater Than Zero</div>
                                            <div class="alert alert-danger error-price" style="text-align:center;display:none;">Price Must Be Greater Than Zero</div>
                                            <div class="alert alert-danger error-discount" style="text-align:center;display:none;">Discount Must Be Greater Than Or Equal Zero , Less Than Or Equal 100</div>
                                            <div class="alert alert-danger error-photos" style="text-align:center;display:none;">You Have To Select At Least One Image For Your Product</div>
                                            <div class="alert alert-danger error-prod-exists" style="text-align:center;display:none;">This Product Is Already Exists</div>
                                            <div class="alert alert-success error-success" style="text-align:center;display:none;">Product Added Successfully</div>
                                        </div>
                                        <form action="<?= ROOT ?>ajax/products/add" class="product-add" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="product_name" class="form-label">Product Name</label>
                                                <input type="text" class="form-control" id="add_prod_name" name="name">
                                            </div>
                                            <div class="mb-1">
                                                <label for="category_name" class="form-label">Category</label>
                                                <select class="select2 form-select" name="cat_id" id="category_name"></select>
                                            </div>
                                            <div class="mb-1">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea name="description" id="description" class="form-control" cols="10" rows="10"></textarea>
                                            </div>
                                            <div class="mb-1">
                                                <label for="quantity" class="form-label">Quantity</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="number" name="quantity" value="1" />
                                                </div>
                                            </div>
                                            <label for="price" class="form-label">Price</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="price" data-bts-step="0.5" data-bts-decimals="1" value='1' />
                                            </div>
                                            <div class="mb-1">
                                                <label for="discount" class="form-label">Discount in %</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="number" class="touchspin" name="discount" value='0' />
                                                </div>
                                            </div>
                                            <div class="mb-1">
                                                <label for="images" class="form-label">Images</label>
                                                <input type="file" class="form-control" id="images" multiple>
                                            </div>
                                            <input type="submit" value="Add Product" class="btn btn-primary">
                                            <input type="reset" class="btn btn-danger">

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <?php if (isset($_SESSION['product']) && $_SESSION['product'][1]) : ?>
                        <div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit New Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div cass="d-flex flex-wrap justify-content-center text-center products-errors">
                                            <div class="alert alert-danger error-edit-name" style="text-align:center;display:none;">Type A Valid Product Name</div>
                                            <div class="alert alert-danger error-edit-category" style="text-align:center;display:none;">You Must Select One Enabled Category</div>
                                            <div class="alert alert-danger error-edit-description" style="text-align:center;display:none;">Add Your Product Description</div>
                                            <div class="alert alert-danger error-edit-quantity" style="text-align:center;display:none;">Quantity Must Be Greater Than Zero</div>
                                            <div class="alert alert-danger error-edit-price" style="text-align:center;display:none;">Price Must Be Greater Than Zero</div>
                                            <div class="alert alert-danger error-edit-discount" style="text-align:center;display:none;">Discount Must Be Greater Than Or Equal Zero , Less Than Or Equal 100</div>
                                            <div class="alert alert-danger error-edit-photos" style="text-align:center;display:none;">You Have To Select At Least One Image For Your Product</div>
                                            <div class="alert alert-danger error-edit-prod-exists" style="text-align:center;display:none;">This Product Is Already Exists</div>
                                            <div class="alert alert-success error-edit-success" style="text-align:center;display:none;">Product Updated Successfully</div>
                                        </div>
                                        <form action="<?= ROOT ?>ajax/products/edit" class="product-edit" enctype="multipart/form-data" onsubmit='editProductSubmit(event)'>
                                            <div class="mb-3">
                                                <label for="product_name" class="form-label">Product Name</label>
                                                <input type="text" class="form-control" id="edit_prod_name" name="name">
                                            </div>
                                            <div class="mb-1">
                                                <label for="category_name" class="form-label">Category</label>
                                                <select class="select2 form-select" name="cat_id" id="category_name_edit"></select>
                                            </div>
                                            <div class="mb-1">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea name="description" id="description" class="form-control" cols="10" rows="10"></textarea>
                                            </div>
                                            <div class="mb-1">
                                                <label for="quantity" class="form-label">Quantity</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="number" name="quantity" value="1">
                                                </div>
                                            </div>
                                            <label for="price" class="form-label">Price</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="price" value="1" data-bts-step="0.5" data-bts-decimals="1" />
                                            </div>
                                            <div class="mb-1">
                                                <label for="discount" class="form-label">Discount in %</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="number" name="discount" />
                                                </div>
                                            </div>
                                            <div class="mb-1">
                                                <label for="images" class="form-label">Images</label>
                                                <input type="file" class="form-control" id="images" multiple>
                                            </div>
                                            <input type="submit" value="Edit Product" class="btn btn-primary edit-product-btn">
                                            <input type="reset" class="btn btn-danger">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
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
    <script src="<?= APP_ASSETS ?>vendors/js/file-uploaders/dropzone.min.js"></script>
    <!-- BEGIN: Theme JS-->
    <script src="<?= APP_ASSETS ?>js/core/app-menu.js"></script>
    <script src="<?= APP_ASSETS ?>js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?= APP_ASSETS ?>js/scripts/tables/table-datatables-basic.js"></script>
    <script src="<?= APP_ASSETS ?>js/scripts/forms/form-number-input.js"></script>
    <script src="<?= APP_ASSETS ?>js/scripts/forms/form-select2.js"></script>
    <script src="<?= APP_ASSETS ?>js/scripts/forms/form-file-uploader.js"></script>
    <script src="<?= ASSETS ?>js/scripts.js"></script>
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