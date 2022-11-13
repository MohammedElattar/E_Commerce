<?php
?>
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
    <title><?=$data['title']?></title>
    <link rel="apple-touch-icon" href="<?= APP_ASSETS ?>images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= APP_ASSETS ?>images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>vendors/css/extensions/sweetalert2.min.css">
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
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/plugins/extensions/ext-component-sweet-alerts.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_ASSETS ?>css/plugins/forms/form-validation.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?= ASSETS ?>css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
    <?= $this->view('admin/nav') ?>
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
                            <h2 class="content-header-title float-start mb-0">Account</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= ROOT ?>admin">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Account Settings </a>
                                    </li>
                                    <li class="breadcrumb-item active"> Account
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
                                <a class="nav-link active" href="<?= ROOT ?>admin/profile">
                                    <i data-feather="user" class="font-medium-3 me-50"></i>
                                    <span class="fw-bold">Account</span>
                                </a>
                            </li>
                            <!-- security -->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= ROOT ?>admin/profile/security">
                                    <i data-feather="lock" class="font-medium-3 me-50"></i>
                                    <span class="fw-bold">Security</span>
                                </a>
                            </li>
                        </ul>

                        <!-- profile -->
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Profile Details</h4>
                            </div>
                            <div class="card-body py-2 my-25">
                                <!-- header section -->
                                <div class="d-flex">
                                    <a href="#" class="me-25">
                                        <img src="<?= ROOT ?>uploads/users/<?= $_SESSION['data']['avatar'] ?>" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                                    </a>
                                    <!-- upload and reset button -->
                                    <div class="d-flex align-items-end mt-75 ms-1">
                                        <div>
                                            <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                                            <input type="file" id="account-upload" hidden accept="image/*" />
                                            <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>
                                        </div>
                                    </div>
                                    <!--/ upload and reset button -->
                                </div>
                                <!--/ header section -->

                                <!-- form -->
                                <form class="validate-form mt-2 pt-50" action="<?= ROOT ?>ajax/profile/edit">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="accountFirstName">First Name</label>
                                            <input type="text" class="form-control" id="accountFirstName" name="first_name" placeholder="John" value="<?= $_SESSION['data']['first_name'] ?>" data-msg="Please enter first name" />
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="accountLastName">Last Name</label>
                                            <input type="text" class="form-control" id="accountLastName" name="last_name" placeholder="Doe" value="<?= $_SESSION['data']['last_name'] ?>" data-msg="Please enter last name" />
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="accountEmail">Email</label>
                                            <input type="email" class="form-control" id="accountEmail" name="email" placeholder="Email" value="<?= $_SESSION['data']['email'] ?>" disabled />
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-1 me-1">Update Profile</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                                        </div>
                                    </div>
                                </form>
                                <!--/ form -->
                            </div>
                        </div>

                        <!-- deactivate account  -->
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Delete Account</h4>
                            </div>
                            <div class="card-body py-2 my-25">
                                <div class="alert alert-warning">
                                    <h4 class="alert-heading">Are you sure you want to delete your account?</h4>
                                    <div class="alert-body fw-normal">
                                        Once you delete your account, there is no going back. Please be certain.
                                    </div>
                                </div>

                                <form id="formAccountDeactivation" class="validate-form" onsubmit="return false">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" data-msg="Please confirm you want to delete account" />
                                        <label class="form-check-label font-small-3" for="accountActivation">
                                            I confirm my account deactivation
                                        </label>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-danger deactivate-account mt-1">Deactivate Account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--/ profile -->
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
    <script src="<?= APP_ASSETS ?>vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/forms/cleave/cleave.min.js"></script>
    <script src="<?= APP_ASSETS ?>vendors/js/forms/cleave/addons/cleave-phone.us.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?= APP_ASSETS ?>js/core/app-menu.js"></script>
    <script src="<?= APP_ASSETS ?>js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?= APP_ASSETS ?>js/scripts/pages/page-account-settings-account.js"></script>
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