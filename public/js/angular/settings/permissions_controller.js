app.controller('permissionsController', function ($rootScope, $scope, $http, $location, $window) {
    $scope.data = [];
    $scope.dropdowns ={};

    $scope.init = function () {
        $("#overlay").fadeIn();
        $http.get(url + 'api/permissions/get_list')
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

    $scope.getDropDowns = function () {
        $("#overlay").fadeIn();
        $http.get(url + 'api/common/modules/get_list')
            .then(function (response) {
                $scope.dropdowns.modules = response.data;
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

    $scope.addPermission = function ()
    {
        if (!$scope.modal_row.permissions_arr)
            $scope.modal_row.permissions_arr = [];
        $scope.modal_row.permissions_arr.push({id:null});
    };

    $scope.deletePermission = function (index)
    {
        $scope.modal_row.permissions_arr.splice(index, 1);
        $scope.modal_row.is_invalidated = 1;
    };

    $scope.action = function (permission_data = null, modal_id = null, action = null) {
        $("#overlay").fadeIn();
        $http.post(url + 'api/permissions/action', {
            data: permission_data,
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

    $scope.displayModules = function (list,selected,current)
    {
        selected = selected.map(x=>{return x.id});
        console.log(selected);
        return list.filter(x => {
            return (!selected.includes(x.id) || current === x.id);
        })
        // return list;
    };

    $scope.init();
    $scope.getDropDowns();
});
