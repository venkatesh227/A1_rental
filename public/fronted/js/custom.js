$(document).ready(function () {
    // $('.increment-btn').click(function (e) {
    //     e.preventDefault();
    //     var inc_value = parseInt($(this).closest('.product_data').find('.input-qty').val(), 10);
    //     console.log(inc_value);
    //     // return;
    //     inc_value = isNaN(inc_value) ? 0 : inc_value;

    //     inc_value++;
    //     $(this).closest('.product_data').find('.input-qty').val(inc_value);
    // });

    $('.increment-btn').click(function (e) {
        e.preventDefault();

        var $productData = $(this).closest('.product_data');
        var inc_value = parseInt($productData.find('.input-qty').val(), 10);
        var maxValue = parseInt($productData.find('.input-qty').attr('max'), 10);

        inc_value = isNaN(inc_value) ? 0 : inc_value;
        maxValue = isNaN(maxValue) ? 0 : maxValue;

        // Increment only if current value is less than max value
        if (maxValue != 0 && inc_value < maxValue) {
            inc_value++;
            $(this).closest('.product_data').find('.input-qty').val(inc_value);
        }
    });

    $('.decrement-btn').click(function (e) {
        e.preventDefault();
        // var inc_value = $('.input-qty').val();
        var dec_value = $(this).closest('.product_data').find('.input-qty').val();
        console.log(dec_value);
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.input-qty').val(value);
            // var inc_value = $('.input-qty').val(value);

        }

    });

    // add to cart
    $('.addToCartBtn').click(function (e) {
        e.preventDefault();
        var product_qty = $(this).closest('.product_data').find('.input-qty').val();
        var product_id = $('.prod_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
            },
            success: function (response) {
                if (response.redirect) {
                    swal({
                        title: "",
                        text: response.status,
                        icon: "info"
                    }).then(function () {
                        window.location.href = "/user-login";
                    });
                } else {
                    swal({
                        title: "",
                        text: response.status,
                        icon: "success"
                    }).then(function () {
                        location.reload();
                    });
                }
            }
        });

    });

    $('.delete-cart-item').click(function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();
        var productRow = $(this).closest('.product_data');
        $.ajax({
            method: "post",
            url: "delete-cart-item",
            data: {
                'prod_id': prod_id,
            },

            success: function (response) {
                productRow.fadeOut(500, function () {
                    $(this).remove();
                    swal("", response.status, "success");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                });
            }
        });
    });

    $('.changeqty').click(function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();

        var product_qty = $(this).closest('.product_data').find('.input-qty').val();
        // console.log(product_qty);
        // return;
        $.ajax({
            method: "POST",
            url: "update-cart",
            data: {
                'prod_id': prod_id,
                'product_qty': product_qty
            },
            dataType: "json",
            success: function (response) {
                window.location.reload(true);
            },
            error: function (xhr, status, error) {
                swal("Error occurred: " + error);
            }
        });
    });


});

function addToCartBtn(id) {
    var product_qty = 1
    var product_id = id;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: "/add-to-cart",
        data: {
            'product_id': product_id,
            'product_qty': product_qty,
        },
        success: function (response) {
            if (response.redirect) {
                swal({
                    title: "",
                    text: response.status,
                    icon: "info"
                }).then(function () {
                    window.location.href = "/user-login";
                });
            } else {
                swal({
                    title: "",
                    text: response.status,
                    icon: "success"
                }).then(function () {
                    location.reload();
                });
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}


function togglePassword() {
    var passwordField = document.getElementById('password');
    var toggleIcon = document.querySelector('.toggle-password');

    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = "password";
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}


