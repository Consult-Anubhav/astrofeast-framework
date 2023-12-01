app.controller('categoriesController', function ($rootScope, $scope, $http, $location, $window, $compile) {

    $scope.data = [];

    $scope.categories = {
        id: 0,
        title: 'root',
        childrens: []
    };

    $scope.init = function () {
        $("#overlay").fadeIn();
        $http.get(url + 'api/categories/get_list')
            .then(function (response) {
                $scope.data = response.data;
                $scope.data = $scope.data.map((child, index) => {
                    return {...child, index: index};
                })
                $scope.categories.childrens = $scope.makeHierarchy($scope.data, null);
                $scope.hierarchyGroup($scope.categories, '#hierarchy');
                $scope.hierarchyToggle();
                $compile(angular.element($('#hierarchy')))($scope);
                $("#overlay").fadeOut();
            })
            .catch(function (e) {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.makeHierarchy = function (list, parent_id) {
        return list.map(child => {
            if (child.parent_id === parent_id)
                return {
                    id: child.id,
                    index: child.index,
                    title: child.name,
                    childrens: $scope.makeHierarchy(list, child.id)
                };
        }).filter(child => {
            return child !== undefined;
        });
    };

    $scope.hierarchyGroup = function (object, id) {
        let group_id = 'hierarchy_' + object.id + '_group';
        let hgroup = '<ul class="nested" id=' + group_id + '></ul>';
        $(id).append(hgroup);
        if (object.childrens) {
            object.childrens.forEach(child => {
                $scope.hierarchyNode(child, '#' + group_id);
            });
        }
    };

    $scope.hierarchyNode = function (object, id) {
        let node_id = 'hierarchy_' + object.id + '_node';
        let hnode = '<li id=' + node_id + '></li>';
        let dnode = '<i class="material-icons opacity-10 fspx-14 cursor-pointer taxon-delete" ' +
'                       ng-click="deleteTaxon(' + object.id + ')">delete</i>';
        $(id).append(hnode);
        let blob = '<div class="form-check d-flex align-items-center taxon ' + (object.childrens && object.childrens.length > 0 ? 'p-0 ' : 'no-') + 'caret" style="margin-bottom: 0;">'
            + '<input className="form-check-input" type="checkbox" style="margin-right: 5px;" '
            + 'ng-true-value="1" ng-false-value="0" ng-model="data[' + object.index + '].selected" ng-indeterminate="data[' + object.index + '].selected === 2" '
            + 'ng-change="runThis(' + object.id + ', ' + 'data[' + object.index + ']' + ', data[' + object.index + '].selected)" />'
            + '<label className="form-check-label" style="margin-bottom: 0;">' + object.title + '</label>'
            + (object.childrens && object.childrens.length > 0 ? '' : dnode) + '</div>';
        $('#' + node_id).append(blob);
        if (object.childrens && object.childrens.length > 0)
            $scope.hierarchyGroup(object, '#' + node_id);
    };

    $scope.hierarchyToggle = function () {
        let toggler = $(".caret");
        let toggler_label = $(".caret label");
        for (let i = 0; i < toggler.length; i++) {
            toggler_label[i].addEventListener("click", function (index = i, ele = toggler[i]) {
                if (ele.classList.contains("caret-down")) {
                    ele.classList.remove("caret-down");
                    ele.parentElement.querySelector(".nested").classList.remove("active");
                } else {
                    ele.classList.add("caret-down");
                    ele.parentElement.querySelector(".nested").classList.add("active");
                }
            });
        }
    };

    $scope.runThis = function (parent_id, row, value) {
        $scope.checkTaxons($scope.data, row, parent_id, value);
        $scope.checkParents($scope.data, row, parent_id, value);
    };

    $scope.checkTaxons = function (list, row, parent_id, value) {
        list.forEach(child => {
            if (child.parent_id === parent_id) {
                child.selected = value;
                let childrens = list.filter(item => {
                    return item.parent_id === child.id;
                })
                if (childrens.length > 0)
                    $scope.checkTaxons(list, child, child.id, value);
            }
        })
    };

    $scope.checkParents = function (list, row, parent_id, value) {
        list.forEach(child => {
            if (child.id === row.parent_id) {
                let childrens = list.filter(item => {
                    return item.parent_id === child.id;
                });
                let selected_childrens = list.filter(item => {
                    return (item.parent_id === child.id && item.selected === 1);
                });
                let half_selected_childrens = list.filter(item => {
                    return (item.parent_id === child.id && item.selected === 2);
                });
                if (childrens.length > 0 && selected_childrens.length === 0 && half_selected_childrens.length === 0)
                    child.selected = 0;
                else if ((childrens.length > selected_childrens.length) || half_selected_childrens.length > 0)
                    child.selected = 2;
                else
                    child.selected = 1;
                if (row.parent_id)
                    $scope.checkParents(list, child, child.id, value);
            }
        })
    };

    $scope.init();
})
;
