app.controller('rolesController', function ($rootScope, $scope, $http, $location, $window) {
    $scope.data = [];
    $scope.modal_row = {};
    $scope.errors = [];

    $scope.init = function () {
        $("#overlay").fadeIn();
        $http.get(url + 'api/common/roles/get_list')
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

    $scope.editModal = function (t = null, id = null)
    {
        $scope.modal_row = JSON.parse(JSON.stringify(t));
        $scope.modal_id = id;
        $('#'+id).modal('show');
    };

    $scope.action = function (staff_data = null, modal_id = null, action = null) {
        $("#overlay").fadeIn();
        $http.post(url + 'api/roles/action', {
            data: staff_data,
            id: modal_id,
            for_what: action
        })
            .then(function (response) {
                $scope.modal_row = response.data;
                $scope.init();
                if (modal_id)
                    $('#'+modal_id).modal('hide');
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
