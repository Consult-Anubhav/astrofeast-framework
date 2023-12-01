<!--
=========================================================
* Material Dashboard 2 - v3.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.head')
</head>

<body class="g-sidenav-show bg-gray-200 {{$user->dark_mode ? 'dark-version' : ''}}" ng-app="Astrofeast"
      ng-controller="globalController">

<div id="overlay" style="z-index: 1000000000">
    <div id="overlay_text" class="">
        <i class="fa fa-spinner fa-spin spin-big"></i>
    </div>
</div>

@include('layouts.partials.sidebar_settings')

<main class="main-content position-relative min-height-vh-100 h-100 border-radius-lg ">

    @include('layouts.partials.navbar')

    @yield('main-content')

    {{--    <div class="container-fluid pb-4 px-4">--}}

    {{--        @include('layouts.partials.footer')--}}

    {{--    </div>--}}
</main>

@include('layouts.partials.js')

</body>

</html>
