
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
    <title>
        <?=$data['title']?>
    </title>
    <link rel="apple-touch-icon" href="<?= APP_ASSETS ?>images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= APP_ASSETS ?>images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?= APP_ASSETS ?>vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?= APP_ASSETS ?>vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?= APP_ASSETS ?>vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="<?= APP_ASSETS ?>vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/components.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/themes/dark-layout.css">
    <!-- BEGIN: Page CSS-->
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
                            <h2 class="content-header-title float-start mb-0">Users</h2>
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
                                <table class="users table text-center">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
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
                    
                    <?php if(isset($_SESSION['user']) && $_SESSION['user'][2]):?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser"
                        onclick="addUser()">
                        Add User
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex justify-content-center flex-wrap">
                                    <div class="alert alert-danger error-name" style="text-align:center;display:none;">Type A Valid Name</div>
                                    <div class="alert alert-danger error-username" style="text-align:center;display:none;">Type A Valid UserName</div>
                                    <div class="alert alert-danger error-email" style="text-align:center;display:none;">Type A Valid Email</div>
                                    <div class="alert alert-danger error-pass" style="text-align:center;display:none;">Type A Valid Password</div>
                                    <div class="alert alert-danger error-role" style="text-align:center;display:none;">Choose Valid Role</div>
                                    <div class="alert alert-danger error-username-exists" style="text-align:center;display:none;">This Username is Already In Use</div>
                                    <div class="alert alert-danger error-email-exists" style="text-align:center;display:none;">Email is already in use</div>
                                    <div class="alert alert-danger error-role-not-exists" style="text-align:center;display:none;">Role Not Exists</div>
                                    <div class="alert alert-success error-success" style="text-align:center;display:none;">User Added Successfully</div>
                                    </div>
                                    <form action="<?= ROOT ?>ajax/users/add" class="user-add">
                                        <div class="mb-3">
                                            <label for="product_name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="add_user_name" name="name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="useremail" name="email">
                                        </div>
                                        <div class="mb-1">
                                            <label for="roles" class="form-label">Roles</label>
                                            <select class="select2 form-select" name="role_id" id="roles_slct"></select>
                                        </div>
                                        <br>
                                        <input type="submit" value="Add User" class="btn btn-primary">
                                        <input type="reset" class="btn btn-danger">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user'][1]):?>

                    <!-- Modal -->
                    <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div class="d-flex justify-content-center flex-wrap">
                                    <div class="alert alert-danger error-edit-name" style="text-align:center;display:none;">Type A Valid Name</div>
                                    <div class="alert alert-danger error-edit-username" style="text-align:center;display:none;">Type A Valid UserName</div>
                                    <div class="alert alert-danger error-edit-email" style="text-align:center;display:none;">Type A Valid Email</div>
                                    <div class="alert alert-danger error-edit-pass" style="text-align:center;display:none;">Type A Valid Password</div>
                                    <div class="alert alert-danger error-edit-role" style="text-align:center;display:none;">Choose Valid Role</div>
                                    <div class="alert alert-danger error-edit-username-exists" style="text-align:center;display:none;">This Username is Already In Use</div>
                                    <div class="alert alert-danger error-edit-email-exists" style="text-align:center;display:none;">Email is already in use</div>
                                    <div class="alert alert-danger error-edit-role-not-exists" style="text-align:center;display:none;">Role Not Exists</div>
                                    <div class="alert alert-success error-edit-success" style="text-align:center;display:none;">User Added Successfully</div>
                                    </div>
                                    <form action="<?= ROOT ?>ajax/users/edit" class="user-edit" autocomplete="off">
                                        <div class="mb-3">
                                            <label for="product_name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name_edit" name="name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="edit_username" name="username">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Hidden For Security">
                                        </div>
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="edit_useremail" name="email">
                                        </div>
                                        <div class="mb-1">
                                            <label for="roles" class="form-label">Roles</label>
                                            <select class="select2 form-select" name="role_id"
                                                id="roles_slct_edit"></select>
                                        </div>
                                        <br>
                                        <input type="submit" value="Edit User" class="btn btn-primary">
                                        <input type="reset" class="btn btn-danger">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
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
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a
        class="ms-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a><span
        class="d-none d-sm-inline-block">, All rights Reserved</span></span><span
        class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->
    </body>
<!-- END: Body-->

</html>

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
    <script src="<?= APP_ASSETS ?>js/scripts/forms/form-file-uploader.js"></script>
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
