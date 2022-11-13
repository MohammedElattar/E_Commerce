<?php
    $allData = [
        "role"=> 
            ["name"=>"Role Management" , "read"=>"roles_sRead","write"=>"roles_sWrite" , "create"=>"roles_sCreate"],
        "user"=>
            ["name"=>"User Management" , "read"=>"userRead","write"=>"userWrite" , "create"=>"userCreate"] ,
        "categories"=>
            ["name"=>"Category Management" , "read"=>"categoriesRead","write"=>"categoriesWrite" , "create"=>"categoriesCreate"],
        "products"=>
            ["name"=>"Product Management" , "read"=>"productsRead","write"=>"productsWrite" , "create"=>"productsCreate"],
        "orders"=>
            ["name"=>"Order Management" , "read"=>"ordersRead","write"=>"ordersWrite" , "create"=>"ordersCreate"],
        "db"=>
            ["name"=>"Database Management" , "read"=>"dbRead","write"=>"dbWrite" , "create"=>"dbCreate"]
    ]

?>

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
    <title>Roles - Vuexy - Bootstrap HTML admin template</title>
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
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/components.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/plugins/forms/form-validation.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <?= $this->view('admin/nav') ?>
    <?= $this->view("admin/sidebar") ?>
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <h3>Roles List</h3>
                <p class="mb-2">
                    A role provided access to predefined menus and features so that depending <br />
                    on assigned role an administrator can have access to what he need
                </p>

                <!-- Role cards -->
                <div class="row roles-list justify-content-center">
                </div>
                <!--/ Role cards -->

                <h3 class="mt-50" style="width:30%;margin:1px auto;">Total users with their roles</h3>
                <p class="mb-2" style="width:57%;margin:15px auto;">Find all of your company’s administrator accounts
                    and their associate roles.</p>
                <!-- Add Role Modal -->
                <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-5 pb-5">
                                <div class="text-center mb-4">
                                    <h1 class="role-title">Add New Role</h1>
                                    <p>Set role permissions</p>
                                </div>
                                <!-- Add role form -->
                                <form id="addRoleForm" action="<?= ROOT ?>ajax/roles/add" class="row"
                                    onsubmit="addRole(event)">
                                    <div class="col-12">
                                        <label class="form-label" for="modalRoleName">Role Name</label>
                                        <input type="text" id="modalRoleName" name="name" class="form-control"
                                            placeholder="Enter role name" tabindex="-1"
                                            data-msg="Please enter role name" />
                                    </div>
                                    <div class="col-12">
                                        <h4 class="mt-2 pt-50">Role Permissions</h4>
                                        <!-- Permission table -->
                                        <div class="table-responsive">
                                            <table class="table table-flush-spacing">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-nowrap fw-bolder">
                                                            Administrator Access
                                                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Allows a full access to the system">
                                                                <i data-feather="info"></i>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="selectAll" />
                                                                <label class="form-check-label" for="selectAll"> Select
                                                                    All </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php foreach($allData as $i):?>
                                                    <tr>
                                                        <td class="text-nowrap fw-bolder"><?=$i['name'] ?></td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="<?= $i['read'] ?>" name="<?= $i['read'] ?>" />
                                                                    <label class="form-check-label"
                                                                        for="<?= $i['read'] ?>"> Read </label>
                                                                </div>
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="<?= $i['write'] ?>"
                                                                        name="<?= $i['write'] ?>" />
                                                                    <label class="form-check-label"
                                                                        for="<?= $i['write'] ?>"> Write </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="<?= $i['create'] ?>"
                                                                        name="<?= $i['create'] ?>" />
                                                                    <label class="form-check-label"
                                                                        for="<?= $i['create'] ?>"> Create </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach;?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Permission table -->
                                    </div>
                                    <div class="col-12 text-center mt-2">
                                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            Discard
                                        </button>
                                    </div>
                                </form>
                                <!--/ Add role form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Add Role Modal -->
                <!-- Edit Role Modal -->
                <div class="modal fade" id="editRole" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-5 pb-5">
                                <div class="text-center mb-4">
                                    <h1 class="role-title">Edit Role</h1>
                                    <p>Modify role permissions</p>
                                </div>
                                <!-- Add role form -->
                                <form id="editRoleForm" action="<?= ROOT ?>ajax/roles/edit" class="row">
                                    <div class="col-12">
                                        <label class="form-label" for="modalRoleName">Role Name</label>
                                        <input type="text" id="modalRoleName" name="name" class="form-control"
                                            placeholder="Enter role name" tabindex="-1"
                                            data-msg="Please enter role name" />
                                    </div>
                                    <div class="col-12">
                                        <h4 class="mt-2 pt-50">Role Permissions</h4>
                                        <!-- Permission table -->
                                        <div class="table-responsive">
                                            <table class="table table-flush-spacing">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-nowrap fw-bolder">
                                                            Administrator Access
                                                            <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Allows a full access to the system">
                                                                <i data-feather="info"></i>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="selectAll" />
                                                                <label class="form-check-label" for="selectAll"> Select
                                                                    All </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php foreach($allData as $i):?>
                                                    <tr>
                                                        <td class="text-nowrap fw-bolder"><?=$i['name'] ?></td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="<?= $i['read'] ?>" name="<?= $i['read'] ?>" />
                                                                    <label class="form-check-label"
                                                                        for="<?= $i['read'] ?>"> Read </label>
                                                                </div>
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="<?= $i['write'] ?>"
                                                                        name="<?= $i['write'] ?>" />
                                                                    <label class="form-check-label"
                                                                        for="<?= $i['write'] ?>"> Write </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="<?= $i['create'] ?>"
                                                                        name="<?= $i['create'] ?>" />
                                                                    <label class="form-check-label"
                                                                        for="<?= $i['create'] ?>"> Create </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach;?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Permission table -->
                                    </div>
                                    <div class="col-12 text-center mt-2">
                                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            Discard
                                        </button>
                                    </div>
                                </form>
                                <!--/ Add role form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ edit Role Modal -->

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card" style="width: 64%;margin: 1px auto;">
                        <table class="roles-table table text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
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


    <!-- BEGIN: Vendor JS-->
    <script src="<?= APP_ASSETS ?>vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/responsive.bootstrap5.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/buttons.bootstrap5.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?= APP_ASSETS ?>js/core/app-menu.js"></script>
    <script src="<?= APP_ASSETS ?>js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?= APP_ASSETS ?>js/scripts/pages/modal-add-role.js"></script>
    <script src="<?= APP_ASSETS ?>js/scripts/pages/app-access-roles.js"></script>
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