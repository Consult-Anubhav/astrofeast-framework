app.controller('globalController', function ($rootScope, $scope, $http, $location, $window) {
    $scope.global_user = undefined;

    $scope.init = function () {
        // $scope.globalGetUserData();
    };

    $scope.toggleDarkMode = function (dark_mode = null) {
        if ($("body").hasClass("dark-version")) {
            $('body').removeClass("dark-version");
        } else {
            $('body').addClass("dark-version");
        }

        $("#overlay").fadeIn();
        $http.post(url + 'api/dark_mode_toggle', {
            dark_mode: dark_mode
        })
            .then(function (response) {
                $scope.global_user = response.data;

                let already_dark_mode = $("body").hasClass("dark-version");

                if ($scope.global_user.dark_mode) {
                    if (already_dark_mode)
                        $('body').addClass("dark-version");
                } else {
                    if (!already_dark_mode)
                        $('body').removeClass("dark-version");
                }

                $("#overlay").fadeOut();
            })
            .catch(function (e) {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.openLink = function (link, prefix = null) {
        window.open(url + (prefix ? prefix + '/' + link : link), '_self');
    }

    $scope.init();
});
