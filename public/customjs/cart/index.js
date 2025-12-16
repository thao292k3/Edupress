
function formatToVND(amount) {
    if (amount === null || amount === undefined) {
        return '0 VND';
    }
    
    return amount.toLocaleString('vi-VN') + ' VND';
    

    
}

$(document).ready(function () {
    getCart();
});

$(document).on('click', '.add-to-cart-btn', function () {
    var courseId = $(this).data('course-id'); 
    var quantity = 1; 

    $.ajax({
        url: '/cart/add',
        method: 'POST',
        data: {
            course_id: courseId,
            quantity: quantity,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.status === 'success') {

                getCart();
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: response.message,
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false,
                });

                if (response.cart_item) {
                    $('.cart-count').text(response.cart_item.quantity);
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: response.message,
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    showConfirmButton: false,
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Something went wrong!',
                text: xhr.responseJSON?.message || error,
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false,
            });
        }
    });
});


function getCart(){

    var url = '/cart/all';

    $.ajax({
        url: url,
        type: 'GET',
        data: {

            _token: $('meta[name="csrf-token"]').attr('content')


        },
        success: function (response) {

             if (response.status === 'success') {
                
                $('#cart').html(response.html);
            }

        },
        error: function (xhr) {

            let message = 'Something went wrong!';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }
            console.error(message);


        }
    });

}

$(document).ready(function () {


    fetchCart();

    function fetchCart() {

        var url = '/fetch/cart';

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')

            },
            success: function (response) {

                if (response.status === 'success') {
                    
                    $('#cart-main-content').html(response.html);
                }

            },
            error: function (xhr) {

                let message = 'Something went wrong!';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                console.error(message);

            }
        });

    }

    $(document).on('click', '.remove-course-btn', function() {

        var id = $(this).data('id');
        var url = '/remove/cart'; 
        $.ajax({

            url: url,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id
            },

            success: function(response) {
                if (response.status === 'success') {

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Course removed successfully!',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    fetchCart(); 

                    getCart();  

                }
            },
            error: function(xhr) {
                let message = 'Something went wrong!';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                console.error(message);
            }


        })

    })

});








