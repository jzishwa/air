<div class="main">
    <nav class="navbar navbar-expand navbar-theme">
        <a class="sidebar-toggle d-flex mr-2">
            <i class="hamburger align-self-center"></i>
        </a>

        <form class="form-inline d-none d-sm-inline-block">
            <input class="form-control form-control-lite" type="text" placeholder="Search projects...">
        </form>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown ml-lg-2">
                    <a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-toggle="dropdown">
                        <i class="align-middle fas fa-cog"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= BASEURL ?>/pengguna"><i class="align-middle mr-1 fas fa-fw fa-user"></i>Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= BASEURL; ?>/home/logout"><i class="align-middle mr-1 fas fa-fw fa-arrow-alt-circle-right"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>

    </nav>