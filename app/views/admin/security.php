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
    <title>Security - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="<?= APP_ASSETS ?>images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= APP_ASSETS ?>images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/forms/select/select2.min.css">
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

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <?= $this->view("admin/nav") ?>
    <?= $this->view('admin/sidebar') ?>
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Security</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= ROOT ?>admin">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Account Settings</a>
                                    </li>
                                    <li class="breadcrumb-item active">Security
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills mb-2">
                            <!-- account -->
                            <li class="nav-item">
                                <a class="nav-link" href="<?=ROOT?>admin/profile">
                                    <i data-feather="user" class="font-medium-3 me-50"></i>
                                    <span class="fw-bold">Account</span>
                                </a>
                            </li>
                            <!-- security -->
                            <li class="nav-item">
                                <a class="nav-link active" href="page-account-settings-security.html">
                                    <i data-feather="lock" class="font-medium-3 me-50"></i>
                                    <span class="fw-bold">Security</span>
                                </a>
                            </li>

                        </ul>

                        <!-- security -->

                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Change Password</h4>
                            </div>
                            <div class="card-body pt-1">
                                <!-- form -->
                                <form class="validate-form" action="<?=ROOT?>ajax/profile/edit_password">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="account-old-password">Current password</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" name="old-pass" class="form-control" id="account-old-password" name="password" placeholder="Enter current password" data-msg="Please current password" />
                                                <div class="input-group-text cursor-pointer">
                                                    <i data-feather="eye"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="account-new-password">New Password</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" name="new-pass" id="account-new-password" name="new-password" class="form-control" placeholder="Enter new password" />
                                                <div class="input-group-text cursor-pointer">
                                                    <i data-feather="eye"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="account-retype-new-password">Retype New Password</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" name="repeat-new-pass" class="form-control" id="account-retype-new-password" name="confirm-new-password" placeholder="Confirm your new password" />
                                                <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="fw-bolder">Password requirements:</p>
                                            <ul class="ps-1 ms-25">
                                                <li class="mb-50">Minimum 8 characters long - the more, the better</li>
                                                <li class="mb-50">At least one lowercase character</li>
                                                <li>At least one number, symbol, or whitespace character</li>
                                            </ul>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary me-1 mt-1">Save changes</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                                        </div>
                                    </div>
                                </form>
                                <!--/ form -->
                            </div>
                        </div>

                        <!--/ security -->
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
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ms-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="<?= APP_ASSETS ?>vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?= APP_ASSETS ?>vendors/js/forms/select/select2.full.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/forms/cleave/cleave.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/forms/cleave/addons/cleave-phone.us.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?= APP_ASSETS ?>js/core/app-menu.js"></script>
    <script src="<?= APP_ASSETS ?>js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->

    <script src="<?= APP_ASSETS ?>js/scripts/pages/page-account-settings-security.js"></script>
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