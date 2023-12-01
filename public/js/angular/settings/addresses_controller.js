app.controller('addressesController', function ($rootScope, $scope, $http, $location, $window) {

    $scope.for_what = 'regions';
    // pagination
    $scope.pagination = {};
    $scope.new_per_page = 25;
    $scope.page_size = [10, 25, 50, 100, 250, 500];

    $scope.init = function () {
        $scope.getRegions();
    };

    $scope.getRegions = function (pageNumber = 1) {
        $scope.for_what = 'regions';
        $("#overlay").fadeIn();
        $http.post(url + 'api/addresses/regions/get_list' + '?page=' + pageNumber, {
            page_size: $scope.new_per_page
        })
            .then(function (response) {
                $scope.pagination = response.data.data;
                $("#overlay").fadeOut();
            })
            .catch(function (e) {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.getProvinces = function (pageNumber = 1) {
        $scope.for_what = 'provinces';
        $("#overlay").fadeIn();
        $http.post(url + 'api/addresses/provinces/get_list' + '?page=' + pageNumber, {
            page_size: $scope.new_per_page
        })
            .then(function (response) {
                $scope.pagination = response.data.data;
                $("#overlay").fadeOut();
            })
            .catch(function (e) {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.getAddresses = function (pageNumber = 1) {
        $scope.for_what = 'addresses';
        $("#overlay").fadeIn();
        $http.post(url + 'api/addresses/get_list' + '?page=' + pageNumber, {
            page_size: $scope.new_per_page
        })
            .then(function (response) {
                $scope.pagination = response.data.data;
                $("#overlay").fadeOut();
            })
            .catch(function (e) {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.goPaginateData = function (pageNumber = 1)
    {
        if ($scope.for_what === 'addresses')
            $scope.getAddresses(pageNumber);
        else if ($scope.for_what === 'provinces')
            $scope.getProvinces(pageNumber);
        else
            $scope.getRegions(pageNumber);
    };

    $scope.calcPaginateData = function ()
    {
        let dividend = $scope.pagination.from - 1;
        let page_number = Math.floor(dividend / $scope.new_per_page) + 1;
        $scope.goPaginateData(page_number);
    };

    $scope.init();
});
