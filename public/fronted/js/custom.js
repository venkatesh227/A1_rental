$(document).ready(function() {
    $('.increment-btn').click(function(e) {
        e.preventDefault();
        var inc_value = parseInt($(this).closest('.product_data').find('.input-qty').val(), 10);
        inc_value = isNaN(inc_value) ? 0 : inc_value;
    
        inc_value++;
        $(this).closest('.product_data').find('.input-qty').val(inc_value);
    });
    
    $('.decrement-btn').click(function(e) {
        e.preventDefault();
        // var inc_value = $('.input-qty').val();
        var dec_value = $(this).closest('.product_data').find('.input-qty').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.input-qty').val(value);
            // var inc_value = $('.input-qty').val(value);

        }

    });
    $('.addToCartBtn').click(function(e) {
        e.preventDefault();
        var product_qty = $('.input-qty').val();
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

            success: function(response) {
                swal(response.status);
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
        $.ajax({
            method: "post",
            url: "delete-cart-item",
            data: {
                'prod_id' : prod_id,
            },
        
            success: function (response) {
                window.location.reload();
                swal("",response.status,"success");
               
                
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
    
        $.ajax({
            method: "POST",
            url: "update-cart", 
            data: {
                'prod_id': prod_id,
                'product_qty': product_qty
            },
            dataType: "json",
            success: function (response) {
                swal(response.status, function(){
                    window.location.reload(true); 
                });
            },
            error: function(xhr, status, error) {
                swal("Error occurred: " + error); 
            }
        });
    });
    
    
        
    
});