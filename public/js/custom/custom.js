
$(function ()
{
    $("body").on("focus", ".datepicker", function ()
    {
        $(this).datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            autoclose: true
        });
    });

    $("body").on("focus", ".no-future-dates-datepicker", function ()
    {
        $(this).datepicker({
            dateFormat: "dd-mm-yy",
            maxDate: "today",
            changeMonth: true,
            changeYear: true,
            autoclose: true
        });
    });

    $("body").on("focus", ".no-past-dates-datepicker", function ()
    {
        $(this).datepicker({
            dateFormat: "dd-mm-yy",
            minDate: "today",
            changeMonth: true,
            changeYear: true,
            autoclose: true
        });
    });

    $('body').on('focus', ".clockpicker", function ()
    {
        var value = $(this).val();

        $(this).clockpicker({
            autoclose: true,
            twelvehour: true
        });
    });
});

function successMsg(message)
{
    Toastify({
        text: message,
        duration: 3000,
        // destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        // close: true,
        gravity: "top", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
        // onClick: function(){} // Callback after click
    }).showToast();
}

function failureMsg(message)
{
    Toastify({
        text: message,
        duration: 3000,
        // destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        // close: true,
        gravity: "top", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #b00900, #b07200)",
        },
        // onClick: function(){} // Callback after click
    }).showToast();
}
