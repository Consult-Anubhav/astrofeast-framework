<!-- Navbar -->
<nav
    class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky"
    style="box-shadow: none!important;top: 1.5rem !important;" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">Astrofeast</li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
            </ol>
            <h6 class="font-weight-bolder text-capitalize mb-0">{{ str_replace('_', ' ', Request::segment(1)) }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item d-flex align-items-center">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="dark-version-visible"
                               ng-click="toggleDarkMode('toggle')" style="margin-top: 3px"
                            {{$user->dark_mode ? 'checked' : ''}}>
                        <i class="material-icons opacity-10">brightness_medium</i>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
