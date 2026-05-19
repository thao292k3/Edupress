  <!-- Modal -->
  <div class="modal fade modal-container" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header border-bottom-gray">
                  <div class="pr-2">
                      <p class="pb-2 font-weight-semi-bold">Course Preview</p>
                      <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="previewModalTitle">
                          {{ $course->course_name }}</h5>
                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true" class="la la-times"></span>
                  </button>
              </div><!-- end modal-header -->
              <div class="modal-body">

                  <div class="col-md-12 mt-3">
                      <input type="hidden" class="form-control video_url" name="url"
                          placeholder="Enter the YouTube video URL" value="{{ old('url', $preview_video_url ?? '') }}"
                          required>

                      <iframe class="videoPreview" style="margin-top: 15px; width: 100%; height: 500px; border-radius: 8px;" frameborder="0"
                          allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>

                  </div>


              </div><!-- end modal-body -->
          </div><!-- end modal-content -->
      </div><!-- end modal-dialog -->
  </div><!-- end modal -->

  <style>
      /* Modal Fix */
      .modal-content {
          background-color: #ffffff;
          border: 1px solid #e0e0e0;
          border-radius: 8px;
      }

      .modal-header {
          background-color: #f8f9fa;
          border-bottom: 1px solid #e0e0e0 !important;
      }

      .modal-body {
          background-color: #ffffff;
          padding: 20px;
      }

      /* Backdrop fix for dark background */
      .modal.show .modal-backdrop {
          background-color: rgba(0, 0, 0, 0.5);
      }

      .modal-lg {
          max-width: 900px;
      }

      .videoPreview {
          background-color: #ffffff;
          border-radius: 8px;
      }

      @media (max-width: 768px) {
          .modal-dialog {
              margin: 10px;
          }

          .videoPreview {
              height: 300px !important;
          }
      }
  </style>

  @push('scripts')
      <script>
          document.addEventListener("DOMContentLoaded", function() {
              let videoInputs = document.querySelectorAll(".video_url"); 

              videoInputs.forEach(videoInput => {
                  let videoPreview = videoInput.closest('.col-md-12').querySelector(
                  ".videoPreview"); 

                  
                  function extractYouTubeVideoID(url) {
                      let regex =
                          /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
                      let match = url.match(regex);
                      return match ? match[1] : null;
                  }

                  
                  function updateVideoPreview() {
                      let url = videoInput.value;
                      let videoId = extractYouTubeVideoID(url);

                      if (videoId) {
                          videoPreview.src = `https://www.youtube.com/embed/${videoId}`;
                          videoPreview.style.display = "block";
                      } else {
                          videoPreview.src = "";
                          videoPreview.style.display = "none";
                      }
                  }

                  
                  videoInput.addEventListener("input", updateVideoPreview);

                 
                  if (videoInput.value.trim() !== "") {
                      updateVideoPreview();
                  }
              });

              // Fix backdrop color
              $('#previewModal').on('show.bs.modal', function () {
                  $('body').css('overflow', 'hidden');
              });

              $('#previewModal').on('hide.bs.modal', function () {
                  $('body').css('overflow', 'auto');
              });
          });
      </script>
  @endpush
