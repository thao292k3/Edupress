/* auto generate slug   */

$(document).ready(function () {
    // Listen for input changes in the "name" field
    $('#name').on('input', function () {
        var name = $(this).val();
        var slug = name.toLowerCase() // Convert to lowercase
            .replace(/ /g, '-')       // Replace spaces with hyphens
            .replace(/[^\w-]+/g, ''); // Remove non-word characters
        $('#slug').val(slug);        // Set the slug input value
    });
});


/*   Dynamic form addd */


        /* ========== 1. Preview video file upload ========== */
        $(document).ready(function () {
            $('#video_file').on('change', function (e) {
                const file = e.target.files[0];

                if (file) {
                    const validTypes = ['video/mp4', 'video/webm', 'video/ogg'];
                    if (!validTypes.includes(file.type)) {
                        alert('Please upload a valid video file (MP4, WebM, OGG).');
                        $(this).val('');
                        return;
                    }

                    const preview = document.getElementById('videoFilePreview');
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = 'block';
                    preview.load();
                    preview.onloadeddata = function () {
                        URL.revokeObjectURL(this.src);
                    };
                }
            });
        });


        /* ========== 2. Add multiple YouTube URLs ========== */
        $('#addVideo').on('click', function () {
            $('#videoInputs').append(`
                <div class="input-group mb-2">
                    <input type="url" name="video_urls[]" class="form-control" placeholder="Enter YouTube URL" required>
                    <button type="button" class="btn btn-danger removeVideo">X</button>
                </div>
                <iframe class="video-preview" style="width:100%; height:350px; display:none; margin-bottom:10px;" frameborder="0" allowfullscreen></iframe>
            `);
        });

        /* Remove YouTube URL input */
        $(document).on('click', '.removeVideo', function () {
            $(this).closest('.input-group').next('.video-preview').remove();
            $(this).closest('.input-group').remove();
        });


        /* ========== 3. Preview YouTube URL automatically ========== */
        $(document).on("input", "input[name='video_urls[]']", function () {
            let url = $(this).val();
            let embedUrl = "";

            if (url.includes("youtube.com/watch?v=")) {
                embedUrl = url.replace("watch?v=", "embed/");
            } else if (url.includes("youtu.be/")) {
                embedUrl = url.replace("youtu.be/", "youtube.com/embed/");
            }

            let preview = $(this).closest('.input-group').next('.video-preview');

            if (embedUrl !== "") {
                preview.attr("src", embedUrl).show();
            } else {
                preview.hide();
            }
        });



    /* dynamic dependent jquery   */

    $(document).ready(function () {
        $('#category').on('change', function () {
            var categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: '/instructor/get-subcategories/' + categoryId,
                    type: 'GET',

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Dynamically fetch CSRF token
                    },

                    success: function (data) {

                        console.log(data);
                        $('#subcategory').empty(); // Clear previous options
                        $('#subcategory').append('<option value="" disabled selected>Select a subcategory</option>');

                        $.each(data, function (key, value) {
                            $('#subcategory').append('<option value="' + parseInt(value.id) + '">' + value.name + '</option>');
                        });
                    },
                    error: function () {
                        alert('Failed to load subcategories.');
                    }
                });
            } else {
                $('#subcategory').empty();
                $('#subcategory').append('<option value="" disabled selected>Select a subcategory</option>');
            }
        });
    });



    /* video Preview  */


    $(document).ready(function () {
        $('#video').on('change', function (e) {
            const file = e.target.files[0];

            if (file) {
                const fileType = file.type;
                const validTypes = ['video/mp4', 'video/webm', 'video/ogg'];

                // Validate the file type
                if (!validTypes.includes(fileType)) {
                    alert('Please upload a valid video file (MP4, WebM, OGG).');
                    $('#video').val(''); // Clear the input
                    return;
                }

                // Show video preview
                const videoPreview = document.getElementById('videoPreview');
                videoPreview.src = URL.createObjectURL(file);
                videoPreview.style.display = 'block';
                videoPreview.load();
                videoPreview.onloadeddata = function () {
                    URL.revokeObjectURL(this.src); // Free up memory
                };
            }
        });
    });


