const app = angular.module('Astrofeast',
    [
        'ngRoute',
        'summernote'
    ], function ($interpolateProvider, $locationProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');

        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        });

    });

const url = $('#app_path').val();
