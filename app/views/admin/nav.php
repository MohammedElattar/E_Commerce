<!-- BEGIN: Header-->
<?php
$img = substr_count($_SESSION['data']['avatar'], 'https') ? $_SESSION['data']['avatar'] : 'Nice';
echo $img;
?>
<input type="hidden" value="<?= CWD ?>" id="cwd">
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-dark navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <ul class="nav navbar-nav align-items-center ms-auto">

            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="sun"></i></a></li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">
                            <?= $_SESSION['data']['first_name'] . " " . $_SESSION['data']['last_name'] ?>
                        </span><span class="user-status">
                            <?= $_SESSION['data']['rule'] ?>
                        </span></div><span class="avatar"><img class="round" src="<?= ROOT ?>uploads/users/<?= $_SESSION['data']['avatar'] ?>" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user"><a class="dropdown-item" href="<?= ROOT ?>admin/profile"><i class="me-50" data-feather="user"></i>
                        Profile</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="<?= ROOT ?>admin/logout"><i class="me-50" data-feather="power"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- END: Header-->