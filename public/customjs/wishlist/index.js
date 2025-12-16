


$(document).ready(function () {
    console.debug('wishlist/index.js loaded');
    getWishlist();

});


$(document).on('click', '.wishlist-icon', function () {



    var courseId = $(this).data('course-id');
    var iconElement = $(this).find('i'); 
    var url = '/wishlist/add';

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            course_id: courseId,
            _token: $('meta[name="csrf-token"]').attr('content')


        },
        success: function (response) {
            console.log(response)
            console.debug('addToWishlist response:', response);
            Swal.fire({
                icon: response.status === 'success' ? 'success' : 'error',
                title: response.message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            
            if (response.status === 'success') {
                updateWishlistCount(response.wishlist_count);

               getWishlist();

                  
                iconElement.removeClass('la-heart-o').addClass('la-heart');


            }


        },
        error: function (xhr) {
            console.debug('addToWishlist error:', xhr);
            let message = 'Something went wrong!';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }

            Swal.fire({
                icon: 'error',
                title: message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        }
    });
});


function updateWishlistCount(count) {
    $('#wishlist-count').text(count);
}



function getWishlist(){

    var url = '/wishlist/all';

    $.ajax({
        url: url,
        type: 'GET',
        data: {

            _token: $('meta[name="csrf-token"]').attr('content')


        },
        success: function (response) {

             if (response.status === 'success') {
                console.debug('getWishlist response:', response);
                $('#wishlist-course').html(response.html);
            }


        },
        error: function (xhr) {
            console.debug('getWishlist error:', xhr);

            let message = 'Something went wrong!';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }
            console.error(message);


        }
    });


   

}






