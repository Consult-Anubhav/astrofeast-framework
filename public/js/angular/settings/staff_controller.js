app.controller('staffController', function ($rootScope, $scope, $http, $location, $window) {
    $scope.data = [];
    $scope.modal_row = {};
    $scope.errors = [];
    $scope.dropdowns = {};

    $scope.init = function () {
        $("#overlay").fadeIn();
        $http.get(url + 'api/staff/get_list')
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
        $http.get(url + 'api/common/roles/get_list')
            .then(function (response) {
                $scope.dropdowns.roles = response.data;
                $("#overlay").fadeOut();
            })
            .catch(function (e) {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.action = function (staff_data = null, modal_id = null, action = null) {
        $("#overlay").fadeIn();
        $http.post(url + 'api/staff/action', {
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

    $scope.editModal = function (t = null)
    {
        $scope.modal_row = JSON.parse(JSON.stringify(t));
        $scope.modal_d.id = 'editStaffModal';
        $('#editStaffModal').modal('show');
    };

    $scope.deleteModal = function (t = null)
    {
        $('#modal-action').modal('show');
        // action(t, null, 'delete')
    };

    $scope.addRole = function ()
    {
        if (!$scope.modal_row.roles_arr)
            $scope.modal_row.roles_arr = [];

        $scope.modal_row.roles_arr.push({id:null});
    };

    $scope.deleteRole = function (index)
    {
        $scope.modal_row.roles_arr.splice(index, 1);
        $scope.modal_row.is_invalidated = 1;
    };

    $scope.displayRoles = function (list,selected,current)
    {
        selected = selected.map(x=>{return x.id});
        console.log(selected);
        return list.filter(x => {
            return (!selected.includes(x.id) || current === x.id);
        })
    };

    $scope.init();
    $scope.getDropDowns();
});
//
// app.filter('displayRoles', function () {
//     return function (list,selected,current) {
//         selected = selected.map(x=>{return x.id});
//         console.log(selected);
//         return list.filter(x => {
//             return (!selected.includes(x.id) || current === x.id);
//         })
//     }
// });
