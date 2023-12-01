app.controller('integrationsController', function ($rootScope, $scope, $http, $location, $window) {
    $scope.data = {};
    $scope.tokens = [];
    $scope.integration_selected = {};
    $scope.modal_d = {};
    $scope.dropdowns = {};
    $scope.dropdowns.expiration = [
        {id: 1, value: 7, title: '7 days'},
        {id: 2, value: 30, title: '30 days'},
        {id: 3, value: 60, title: '60 days'},
        {id: 4, value: 90, title: '90 days'},
        {id: 5, value: 0, title: 'Custom...'},
        {id: 6, value: null, title: 'No expiration'}
    ];
    $scope.new_token = {};
    $scope.new_token.value = 30;
    $scope.new_token.name = undefined;
    $scope.new_token.expiry_date = undefined;
    $scope.new_token.expiry_message = undefined;
    $scope.new_token.select_expiry_date = undefined;
    $scope.new_token_result = undefined;

    $scope.init = function () {
        $("#overlay").fadeIn();
        $scope.updateExpiryDate();
        $http.get(url + 'api/integrations/get_list')
            .then(function (response) {
                $scope.data = response.data.data;
                $scope.tokens = response.data.tokens;
                $("#overlay").fadeOut();
            })
            .catch(function () {
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.updateExpiryDate = function () {
        if ($scope.new_token.value === null) {
            $scope.new_token.expiry_date = undefined;
            $scope.new_token.expiry_message = 'never';
        } else if ($scope.new_token.value === 0) {
            $scope.new_token.expiry_date = undefined;
            if ($scope.new_token.select_expiry_date) {
                let expiry_date = moment($scope.new_token.select_expiry_date, "DD-MM-YYYY");
                $scope.new_token.expiry_date = expiry_date.format('YYYY-MM-DD');
                $scope.new_token.expiry_message = expiry_date.format('LLLL');
            } else {
                $scope.new_token.expiry_message = 'date selection';
            }
        } else {
            let expiry_date = moment().add($scope.new_token.value, 'days');
            $scope.new_token.expiry_date = expiry_date.format('YYYY-MM-DD');
            $scope.new_token.expiry_message = expiry_date.format('LLLL');
        }
    };

    $scope.openActionToken = function (action, row) {
        $scope.modal_d.title = action;
        $scope.modal_d.action = action;
        $scope.modal_d.body = "Do you really want to delete this token? Any application or scripts using this token will no longer be able to access. You can not undo this action.";
        $scope.modal_row = row;
        $("#modal-delete-token").modal("show");
    };

    $scope.actionToken = function (for_what, data) {
        $("#overlay").fadeIn();
        $http.post(url + 'api/integrations/generate_token', {
            for_what: for_what,
            data: data
        })
            .then(function (response) {
                $scope.tokens = response.data.tokens;
                $scope.new_token_result = response.data.new_token;
                $scope.errors = undefined;
                $("#modal-delete-token").modal("hide");
                $("#overlay").fadeOut();
            })
            .catch(function (e) {
                $scope.errors = e.data.errors;
                $("#modal-delete-token").modal("hide");
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.action = function (for_what) {
        $("#overlay").fadeIn();
        $http.post(url + 'api/integrations/action', {
            data: (for_what === 'update_integration' ? $scope.integration_selected : $scope.data),
            for_what: for_what
        })
            .then(function (response) {
                $scope.data = response.data.data;
                if (for_what === 'update_integration')
                    $("#integrationModal").modal("hide");
                successMsg("Success");
                $("#overlay").fadeOut();
            })
            .catch(function () {
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.openNewIntegration = function () {
        $scope.integration_selected = {};
        $scope.integration_selected.fields = [];
        $("#integrationModal").modal("show");
    };

    $scope.editIntegration = function (integration_group) {
        $scope.integration_selected.integration_name = JSON.parse(JSON.stringify(integration_group[0].integration_name));
        $scope.integration_selected.fields = JSON.parse(JSON.stringify(integration_group));
        $("#integrationModal").modal("show");
    };

    $scope.addIntegrationField = function () {
        $scope.integration_selected.fields.push({code: ''});
    };

    $scope.deleteIntegrationField = function (index) {
        $scope.integration_selected.fields.splice(index, 1);
    };

    $scope.integration_test = {
        'integration_name': '<integration_name>',
        'fields': {
            'message': '',
            'otp': '0000',
            'name': '<Name>',
            'count': '<count>',
            'phone': '<phone>',
            'email': '<email>',
            'product_name': '<product_name>',
        }
    };

    $scope.openTestIntegration = function (key, val) {
        $scope.integration_test.integration_name = key;
        $scope.integration_test.fields.code = val.code;
        $scope.integration_test.fields.message = val.value;
        $("#testModal").modal("show");
    };

    $scope.testIntegration = function () {
        $("#overlay").fadeIn();
        $http.post(url + 'api/integrations/test', {
            data: $scope.integration_test
        })
            .then(function (response) {
                $scope.data = response.data.data;
                $("#testModal").modal("hide");
                successMsg("Success");
                $("#overlay").fadeOut();
            })
            .catch(function () {
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.copyClipboard = function () {
        var input = document.querySelector('#copy-input');
        input.select();
        input.setSelectionRange(0, input.value.length + 1);
        try {
            var success = document.execCommand('copy');
            if (success) {
                $('#copy-button').trigger('copied', ['Copied!']);
            } else {
                $('#copy-button').trigger('copied', ['Copy with Ctrl-c']);
            }
            navigator.clipboard.writeText(input.value).then(function () {
                $('#copy-button').trigger('copied', ['Copied!']);
            }, function (err) {
                $('#copy-button').trigger('copied', ['Copy with Ctrl-c']);
            });
        } catch (err) {
            $('#copy-button').trigger('copied', ['Copy with Ctrl-c']);
        }
    };

    $scope.init();

    $(document).ready(function () {
        // Initialize the tooltip.
        $('#copy-button').tooltip();
        // Handler for updating the tooltip message.
        $('#copy-button').bind('copied', function (event, message) {
            $(this).attr('title', message)
                .attr('data-bs-original-title', message)
                .tooltip('show');
        });
    });
});

app.filter('formatDateStamp', function () {
    return function (datetime) {
        if (datetime)
            return moment(datetime).format('LLLL');
        else
            return 'Never';
    };
});