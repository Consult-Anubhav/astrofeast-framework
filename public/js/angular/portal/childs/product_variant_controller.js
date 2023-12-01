app.controller('productVariantController', function ($rootScope, $scope, $http) {

    $scope.filters = undefined;
    $scope.data = {};
    $scope.modal_row = {};
    $scope.slug = new URLSearchParams(window.location.search).get("slug");
    $scope.sku = new URLSearchParams(window.location.search).get("sku");

    $scope.state_options = [
        {is_published: -1, value: 'schedule', title: 'Schedule'},
        {is_published: -1, value: 'draft', title: 'Draft'},
        {is_published: 0, value: 'draft', title: 'Draft'},
        {is_published: 1, value: 'inactive', title: 'Inactive'},
        {is_published: 1, value: 'active', title: 'Active'},
        {is_published: 1, value: 'unavailable', title: 'Unavailable'},
        {is_published: 1, value: 'retired', title: 'Retired'}
    ];

    $scope.summernote_options = {
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['fontname', ['fontname']],
            ['height', ['height']],
            ['font', ['strikethrough', 'superscript', 'subscript']]
        ],
        height: 250,
        // onKeyup: function(e) {
        //     $scope.data.invalid_basic_info = true
        // }
    };

    $scope.init = function () {
        $("#overlay").fadeIn();
        $http.post(url + 'api/product_variant/get_details', {
            slug: $scope.slug,
            sku: $scope.sku
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

    $scope.action = function (for_what, for_section, id = null) {
        $("#overlay").fadeIn();
        $http.post(url + 'api/product_variant/action', {
            for_what: for_what,
            for_section: for_section,
            data: $scope.data,
            id: id,
            slug: $scope.slug,
            sku: $scope.sku
        })
            .then(function (response) {
                $scope.data = response.data;
                successMsg("Success");
                if ($scope.sku !== $scope.data.sku) {
                    let url = window.location.toString();
                    window.location = url.replace('?sku=' + $scope.sku, '?sku=' + $scope.data.sku);
                }
                $("#overlay").fadeOut();
            })
            .catch(function (e) {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    let formData = new FormData();

    $scope.setDocument = function (files) {
        formData.has('for_what') ? formData.set('for_what', 'product_variant') : formData.append('for_what', 'product_variant');
        formData.has('id') ? formData.set('id', $scope.data.id) : formData.append('id', $scope.data.id);
        formData.has('sku') ? formData.set('sku', $scope.data.sku) : formData.append('sku', $scope.data.sku);
        formData.has('slug') ? formData.set('slug', $scope.slug) : formData.append('slug', $scope.slug);
        formData.has('image') ? formData.set('image', files[0]) : formData.append('image', files[0]);

        $http({
            method: 'POST',
            url: url + 'api/common/upload',
            headers: {
                'Content-Type': undefined
            },
            data: formData
        })
            .then(function (response) {
                $scope.data = response.data;
                $scope.errors = [];
                $('#file_select').val('');
                successMsg("Success");
                $("#overlay").fadeOut();
            })
            .catch(function (e) {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.chooseDocument = function () {
        $('#file_select').click();
    };

    $scope.openImage = function (image) {
        $scope.modal_row = {};
        $scope.modal_row.src = image.original_url;
        $scope.modal_row.alt = $scope.data.name + '_image';
        $('#imageModal').modal('show');
    };

    $scope.init();
});
