app.controller('productsController', function ($rootScope, $scope, $http, $location, $window) {

    $scope.filters = undefined;

    $scope.init = function () {
        $("#overlay").fadeIn();
        $http.post(url + 'api/products/get_list', {
            filters: $scope.filters
        })
            .then(function (response) {
                $scope.data = response.data;
                $("#overlay").fadeOut();
            })
            .catch(function (e) {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };


    $scope.init();
});
