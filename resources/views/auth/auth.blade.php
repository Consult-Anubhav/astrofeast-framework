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
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta
        name="description"
        content="Astrofeast Admin Portal"
    />
    <link rel="apple-touch-icon" sizes="76x76" href="/favicon.svg">
    <link rel="icon" type="image/png" href="/favicon.svg">
    <title>Astrofeast - Portal</title>

    <!-- CSS Files -->
    <link id="pagestyle" href="{{env('APP_URL')}}/assets/css/material-dashboard.css" rel="stylesheet"/>
    <!-- Nucleo Icons -->
    <link href="{{env('APP_URL')}}/assets/css/nucleo-icons.css" rel="stylesheet"/>
    <link href="{{env('APP_URL')}}/assets/css/nucleo-svg.css" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

</head>

<body class="bg-gray-200">

<main class="main-content mt-0">
    <div class="page-header align-items-start min-vh-100"
         style="background: linear-gradient(to right,#f75984,#7a00c1);">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <div class="row mx-2">
{{--                                    <div class="col-12 col-sm-6 text-center px-2 pb-2 py-sm-0">--}}
{{--                                        <a class="btn btn-link p-0 m-0 h-100 d-flex justify-content-center align-items-center"--}}
{{--                                           href="javascript:;">--}}
{{--                                            --}}{{--                                            <img src="/assets/img/icons/strapi.png" style="max-height: 40px; max-width: 100px;">--}}
{{--                                            <svg width="120" height="60" viewBox="0 0 876 212" fill="none"--}}
{{--                                                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                                                <path--}}
{{--                                                    d="M843.999 31.1105C847.584 34.7076 851.817 36.5061 856.699 36.5061C861.733 36.5061 866.042 34.7076 869.627 31.1105C873.212 27.5135 875.004 23.2659 875.004 18.3678C875.004 13.4697 873.212 9.18393 869.627 5.51035C866.042 1.83676 861.733 0 856.699 0C851.817 0 847.584 1.83676 843.999 5.51035C840.414 9.18393 838.622 13.4697 838.622 18.3678C838.622 23.2659 840.414 27.5135 843.999 31.1105Z"--}}
{{--                                                    fill="#212067"/>--}}
{{--                                                <path--}}
{{--                                                    d="M457.976 78.0742C457.976 78.4502 457.671 78.7551 457.295 78.7551H432.119V126.511C432.119 130.491 433.111 133.399 435.094 135.236C437.077 137.073 439.975 138.106 443.789 138.336C447.278 138.546 451.533 138.532 456.554 138.293L456.683 138.287L456.915 138.276L457.259 138.258C457.649 138.238 457.976 138.549 457.976 138.939V164.475C457.976 164.822 457.715 165.113 457.371 165.151C457.203 165.169 457.034 165.188 456.909 165.201C437.185 167.311 423.24 165.359 415.072 159.344C406.758 153.221 402.601 142.277 402.601 126.511V78.7551H383.375C382.999 78.7551 382.694 78.4502 382.694 78.0742V50.9659C382.694 50.5899 382.999 50.285 383.375 50.285H402.601V31.3231C402.601 30.7838 402.92 30.2952 403.413 30.0773L431.163 17.8223C431.613 17.6235 432.119 17.9531 432.119 18.4452V50.285H457.295C457.671 50.285 457.976 50.5899 457.976 50.9659V78.0742Z"--}}
{{--                                                    fill="#212067"/>--}}
{{--                                                <path--}}
{{--                                                    d="M511.501 70.0289C514.247 62.6817 518.785 57.1714 525.116 53.4978C530.909 50.1359 537.31 48.3124 544.317 48.0271C544.656 48.0134 545.175 48.0032 545.594 47.9966C545.973 47.9906 546.282 48.2965 546.282 48.6753V79.8299C546.282 80.4804 545.717 80.981 545.069 80.9222C536.557 80.1498 528.914 82.029 522.141 86.5599C515.048 91.3049 511.501 99.1877 511.501 110.208V164.401C511.501 164.777 511.196 165.082 510.82 165.082H482.664C482.288 165.082 481.983 164.777 481.983 164.401V50.9644C481.983 50.5883 482.288 50.2834 482.664 50.2834H510.82C511.196 50.2834 511.501 50.5883 511.501 50.9644V70.0289Z"--}}
{{--                                                    fill="#212067"/>--}}
{{--                                                <path fill-rule="evenodd" clip-rule="evenodd"--}}
{{--                                                      d="M651.074 50.2815C650.698 50.2815 650.393 50.5864 650.393 50.9625V63.8278C641.545 52.654 629.113 47.0672 613.095 47.0672C597.84 47.0672 584.76 52.9218 573.852 64.6314C562.945 76.3409 557.492 90.6907 557.492 107.681C557.492 124.671 562.945 139.021 573.852 150.731C584.76 162.44 597.84 168.295 613.095 168.295C629.113 168.295 641.545 162.708 650.393 151.534V164.4C650.393 164.776 650.698 165.08 651.074 165.08H679.23C679.606 165.08 679.911 164.776 679.911 164.4V50.9625C679.911 50.5864 679.606 50.2815 679.23 50.2815H651.074ZM595.931 131.101C601.881 137.071 609.432 140.056 618.585 140.056C627.738 140.056 635.327 137.033 641.352 130.987C647.378 124.941 650.391 117.173 650.391 107.682C650.391 98.1924 647.378 90.4244 641.352 84.3783C635.327 78.3322 627.738 75.3092 618.585 75.3092C609.432 75.3092 601.881 78.3322 595.931 84.3783C589.982 90.4244 587.007 98.1924 587.007 107.682C587.007 117.173 589.982 124.979 595.931 131.101Z"--}}
{{--                                                      fill="#212067"/>--}}
{{--                                                <path fill-rule="evenodd" clip-rule="evenodd"--}}
{{--                                                      d="M808.117 64.6314C797.21 52.9218 784.052 47.0672 768.645 47.0672C752.628 47.0672 740.271 52.654 731.576 63.8278V50.9625C731.576 50.5864 731.271 50.2815 730.895 50.2815H702.739C702.363 50.2815 702.058 50.5864 702.058 50.9625V210.319C702.058 210.695 702.363 211 702.739 211H730.895C731.271 211 731.576 210.695 731.576 210.319V151.534C740.271 162.708 752.628 168.295 768.645 168.295C784.052 168.295 797.21 162.44 808.117 150.731C819.024 139.021 824.477 124.671 824.477 107.681C824.477 90.6907 819.024 76.3409 808.117 64.6314ZM740.498 131.101C746.447 137.071 753.998 140.056 763.151 140.056C772.304 140.056 779.893 137.033 785.919 130.987C791.944 124.941 794.957 117.173 794.957 107.682C794.957 98.1924 791.944 90.4244 785.919 84.3783C779.893 78.3322 772.304 75.3092 763.151 75.3092C753.998 75.3092 746.447 78.3322 740.498 84.3783C734.548 90.4244 731.574 98.1924 731.574 107.682C731.574 117.173 734.548 124.979 740.498 131.101Z"--}}
{{--                                                      fill="#212067"/>--}}
{{--                                                <path--}}
{{--                                                    d="M842.738 165.083C842.362 165.083 842.057 164.778 842.057 164.402V50.965C842.057 50.5889 842.362 50.284 842.738 50.284H870.894C871.27 50.284 871.575 50.5889 871.575 50.965V164.402C871.575 164.778 871.27 165.083 870.894 165.083H842.738Z"--}}
{{--                                                    fill="#212067"/>--}}
{{--                                                <path--}}
{{--                                                    d="M315.839 90.3462C311.796 88.4329 309.775 85.9456 309.775 82.8843C309.775 79.976 311.033 77.6801 313.55 75.9963C316.067 74.3126 319.233 73.4708 323.046 73.4708C330.359 73.4708 335.884 76.3311 339.619 82.0518C339.88 82.4509 340.387 82.6124 340.823 82.419L365.727 71.3636C366.098 71.199 366.244 70.7491 366.037 70.3998C365.763 69.9356 365.401 69.3304 365.161 68.9516C360.892 62.2184 355.37 57.2025 348.446 53.381C340.818 49.1716 332.352 47.067 323.046 47.067C310.69 47.067 300.355 50.3196 292.041 56.8249C283.727 63.3302 279.57 72.2462 279.57 83.5731C279.57 91.0733 281.592 97.3107 285.634 102.285C289.677 107.26 294.596 110.895 300.393 113.191C306.19 115.487 311.987 117.4 317.784 118.931C323.58 120.462 328.5 122.184 332.543 124.097C336.585 126.01 338.606 128.498 338.606 131.559C338.606 138.141 333.343 141.432 322.818 141.432C312.798 141.432 305.855 137.716 301.988 130.286C301.656 129.647 300.896 129.355 300.238 129.648L275.404 140.689C275.054 140.844 274.901 141.258 275.067 141.603C275.168 141.811 275.274 142.029 275.351 142.184C284.03 159.591 299.852 168.295 322.818 168.295C335.937 168.295 346.882 165.119 355.653 158.766C364.425 152.414 368.811 143.345 368.811 131.559C368.811 123.753 366.789 117.247 362.747 112.043C358.704 106.839 353.785 103.127 347.988 100.908C342.191 98.6883 336.394 96.8515 330.598 95.3974C324.801 93.9432 319.881 92.2595 315.839 90.3462Z"--}}
{{--                                                    fill="#212067"/>--}}
{{--                                                <path--}}
{{--                                                    d="M0 73.4933C0 38.8482 0 21.5257 10.7628 10.7628C21.5257 0 38.8482 0 73.4933 0H138.507C173.152 0 190.474 0 201.237 10.7628C212 21.5257 212 38.8482 212 73.4933V138.507C212 173.152 212 190.474 201.237 201.237C190.474 212 173.152 212 138.507 212H73.4933C38.8482 212 21.5257 212 10.7628 201.237C0 190.474 0 173.152 0 138.507V73.4933Z"--}}
{{--                                                    fill="#4945FF"/>--}}
{{--                                                <path fill-rule="evenodd" clip-rule="evenodd"--}}
{{--                                                      d="M146.28 64.3066H74.9062V100.7H111.3V137.093L147.693 137.093V65.72C147.693 64.9394 147.06 64.3066 146.28 64.3066Z"--}}
{{--                                                      fill="white"/>--}}
{{--                                                <rect x="109.886" y="100.7" width="1.41333" height="1.41333"--}}
{{--                                                      fill="white"/>--}}
{{--                                                <path--}}
{{--                                                    d="M74.9062 100.7H109.886C110.667 100.7 111.3 101.333 111.3 102.113V137.093H76.3196C75.539 137.093 74.9062 136.461 74.9062 135.68V100.7Z"--}}
{{--                                                    fill="#9593FF"/>--}}
{{--                                                <path--}}
{{--                                                    d="M111.3 137.093H147.693L112.506 172.28C112.061 172.725 111.3 172.41 111.3 171.781V137.093Z"--}}
{{--                                                    fill="#9593FF"/>--}}
{{--                                                <path--}}
{{--                                                    d="M74.9061 100.7H40.2188C39.5893 100.7 39.274 99.9388 39.7191 99.4936L74.9061 64.3066V100.7Z"--}}
{{--                                                    fill="#9593FF"/>--}}
{{--                                            </svg>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
                                    <div class="col-12 text-center px-2 pt-2 py-sm-0">
                                        <a class="btn btn-link p-0 m-0 h-100 d-flex justify-content-center align-items-center"
                                           href="{{env('APP_DOMAIN')}}/minio">
                                            {{--                                            <img src="/assets/img/icons/minio.png" style="max-height: 40px; max-width: 100px;">--}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="60">
                                                <path
                                                    d="M22.702 8.096l6.358 10.397a.12.12 0 0 1 0 .139.12.12 0 0 1-.166 0l-8.207-8.586z"
                                                    fill="#f05a28"/>
                                                <path
                                                    d="M8.664 36.062a28.29 28.29 0 0 1 5.601-7.957 28.65 28.65 0 0 1 2.773-2.458v6.072zm-4.852 5.6l13.244-6.747V50.34l2.985 3.92V33.39l1.848-.924c2.54-1.28 4.323-3.685 4.8-6.486s-.382-5.668-2.342-7.728l-6.84-7.126c-.56-.6-.527-1.556.074-2.126.614-.567 1.57-.534 2.144.074l.924.998 2.042-1.96c-2.412-3.133-5.37-2.773-7.09-1.174-1.744 1.644-1.827 4.4-.185 6.137l6.876 7.162c1.273 1.357 1.863 3.217 1.605 5.06s-1.338 3.47-2.935 4.423l-.924.48v-9.74a31.18 31.18 0 0 0-16.229 21.21"
                                                    fill="#010000"/>
                                                <path
                                                    d="M31.9 20.252h4.638l5.053 8.145 5.053-8.145h4.6V39.56H47.03V26.964L41.6 35.26h-.075l-5.43-8.22v12.52h-4.148zm24.36 0h4.223V39.56H56.27zm9.06 0h3.922l9.05 11.916V20.252h4.26V39.56h-3.62L69.58 27.266V39.56h-4.223zm22.02 0h4.3V39.56h-4.223zm18.6 19.684a10.94 10.94 0 0 1-4.148-.754 10.46 10.46 0 0 1-3.243-2.112 8.98 8.98 0 0 1-2.112-3.168c-.5-1.218-.767-2.526-.754-3.846a9.7 9.7 0 0 1 .754-3.846 9.95 9.95 0 0 1 5.43-5.355 11.06 11.06 0 0 1 8.22 0 10.46 10.46 0 0 1 3.243 2.112 8.98 8.98 0 0 1 2.112 3.168c.5 1.218.767 2.526.754 3.846a9.7 9.7 0 0 1-.754 3.846 9.95 9.95 0 0 1-5.43 5.355 10.83 10.83 0 0 1-4.073.754zm.075-3.922a6.13 6.13 0 0 0 2.338-.453c.677-.313 1.3-.747 1.8-1.282 1.07-1.145 1.665-2.655 1.66-4.223a5.72 5.72 0 0 0-.528-2.49 5.68 5.68 0 0 0-3.092-3.243 6.27 6.27 0 0 0-4.676 0c-.677.313-1.3.747-1.8 1.282-1.07 1.145-1.665 2.655-1.66 4.223a6.13 6.13 0 0 0 .453 2.338 5.68 5.68 0 0 0 3.092 3.243c.744.393 1.572.6 2.413.603z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-2 h-100">
                            <div class="col-12 text-center px-2 pt-4">
                                <h4 class="font-weight-bolder text-primary">Sign In</h4>
                            </div>
                        </div>
                        <!-- Sign In -->
                        <div class="card-body">
                            <form role="form" class="text-start" method="post" action="/admin/guest/api/signin">
                                @csrf
                                @if(is_array($errors) && count($errors) > 0)
                                    <div class="alert alert-light text-danger" role="alert">
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($errors as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="input-group input-group-outline mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                           required>
                                </div>
                                <div class="form-check form-switch d-flex align-items-center mb-3">
                                    <input class="form-check-input" type="checkbox" name="remember_me" value="1">
                                    <label class="form-check-label mb-0 ms-3" for="rememberMe">Remember me</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign in
                                    </button>
                                </div>
                                <div class="d-flex justify-content-center items-center">
                                    <a href="{{ env('APP_URL') }}/authorized/google">
                                        <img
                                            src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
                                    </a>
                                </div>
                                <p class="mt-4 text-sm text-center">
                                    Forgot Password?
                                    <a href="javascript:;" class="text-primary text-gradient font-weight-bold"
                                       ng-click="form_type = 'signup'">Reset</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>

</html>
