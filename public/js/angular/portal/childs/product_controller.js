app.controller('productController', function ($rootScope, $scope, $http) {

    $scope.data = {};
    $scope.filters = undefined;
    $scope.categories = [];
    $scope.data.meta_tags = undefined;
    $scope.slug = new URLSearchParams(window.location.search).get("slug");

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
        // onKeyup: function (e) {
        //     $scope.data.invalid_basic_info = true
        // }
    };

    $scope.init = function () {
        $("#overlay").fadeIn();
        $http.post(url + 'api/product/get_details', {
            slug: $scope.slug
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
        $http.post(url + 'api/product/action', {
            for_what: for_what,
            for_section: for_section,
            id: id,
            data: $scope.data,
            slug: $scope.slug
        })
            .then(function (response) {
                $scope.data = response.data;
                successMsg("Success");
                if ($scope.slug !== $scope.data.slug) {
                    let url = window.location.toString();
                    window.location = url.replace('?slug=' + $scope.slug, '?slug=' + $scope.data.slug);
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
        formData.has('for_what') ? formData.set('for_what', 'product') : formData.append('for_what', 'product');
        formData.has('id') ? formData.set('id', $scope.data.id) : formData.append('id', $scope.data.id);
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

    $scope.searchReq = undefined;

    $scope.search = function (for_what, term) {
        if ($scope.searchTimeout) {
            clearTimeout($scope.searchTimeout);
        }
        if ($scope.searchReq) {
            $scope.searchReq.abort();
        }

        let link = undefined;
        if (for_what === 'Category')
            link = 'api/common/search_category';
        else
            link = 'api/common/search_metatag';

        $scope.searchTimeout = setTimeout(function () {
            if (term.length > 2) {
                $http.post(url + link, {
                    term: term
                })
                    .then(function (response) {
                        if (for_what === 'Category')
                            $scope.categories = response.data;
                        else
                            $scope.meta_tags = response.data;
                    })
                    .catch(function (e) {
                    });
            } else {
                $scope.data.meta_tags = undefined;
            }
        }, 500);
    };

    $scope.addMetaTag = function (tag) {
        let flag = false;
        if ($scope.data.meta_keywords) {
            if ($scope.data.meta_keywords.includes(',' + tag + ','))
                flag = true;
            else if ($scope.data.meta_keywords.includes(tag + ','))
                flag = true;
            else if ($scope.data.meta_keywords.includes(',' + tag))
                flag = true;
            else if ($scope.data.meta_keywords === tag)
                flag = true;
        }
        if (flag === false)
            $scope.data.meta_keywords = ($scope.data.meta_keywords ? $scope.data.meta_keywords + ',' : '') + tag;
        $scope.data.meta_tags = undefined;
    };

    $scope.addCategory = function (category) {
        if ($scope.data.categories) {
            let category_index = undefined;
            let value = $scope.data.categories.find((item, index) => {
                if (item.name === category.name) {
                    category_index = index;
                    return true;
                }
                return false;
            });
            if (category_index === undefined)
                $scope.data.categories.push(category);
        }
        $scope.data.category = undefined;
    };

    $scope.deleteMetaTag = function (tag) {
        if ($scope.data.meta_keywords.includes(',' + tag + ','))
            $scope.data.meta_keywords = $scope.data.meta_keywords.replace(',' + tag + ',', ',');
        else if ($scope.data.meta_keywords.includes(tag + ','))
            $scope.data.meta_keywords = $scope.data.meta_keywords.replace(tag + ',', '');
        else if ($scope.data.meta_keywords.includes(',' + tag))
            $scope.data.meta_keywords = $scope.data.meta_keywords.replace(',' + tag, '');
        else if ($scope.data.meta_keywords === tag)
            $scope.data.meta_keywords = '';

        if ($scope.data.meta_keywords === '')
            $scope.data.meta_keywords = undefined;
    };

    $scope.deleteCategory = function (category) {
        if ($scope.data.categories && $scope.data.categories.length > 0) {
            let category_index = undefined;
            let value = $scope.data.categories.find((item, index) => {
                if (item.name === category) {
                    category_index = index;
                    return true;
                }
                return false;
            });
            if (category_index !== undefined)
                $scope.data.categories.splice(category_index, 1);
        }
    };

    $scope.openImage = function (image) {
        $scope.modal_row = {};
        $scope.modal_row.src = image.original_url;
        $scope.modal_row.alt = $scope.data.name + '_image';
        $('#imageModal').modal('show');
    };

    $scope.init();
});
