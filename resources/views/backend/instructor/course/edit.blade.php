@extends('backend.instructor.master')

@section('content')
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Course</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Course</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card col-md-12">
            <div class="card-body">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-4">Edit Course</h5>
                        <a href="{{ route('instructor.course.index') }}" class="btn btn-primary">Back</a>
                    </div>

                    <form action="{{ route('instructor.course.update', $course->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Error --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">

                            <!-- Category -->
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">-- Select --</option>
                                    @foreach ($all_categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $course->category_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Subcategory -->
                            <div class="col-md-6">
                                <label class="form-label">Subcategory</label>
                                <select name="subcategory_id" class="form-select">
                                    <option value="">-- Select --</option>
                                    @foreach ($subcategories as $sub)
                                        <option value="{{ $sub->id }}"
                                            {{ $course->subcategory_id == $sub->id ? 'selected' : '' }}>
                                            {{ $sub->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Course Type -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Course Type</label>
                                <select name="is_free" class="form-select">
                                    <option value="1" {{ $course->is_free == 1 ? 'selected' : '' }}>Free</option>
                                    <option value="0" {{ $course->is_free == 0 ? 'selected' : '' }}>Paid</option>
                                </select>
                            </div>

                            <!-- Course Name -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Course Name</label>
                                <input type="text" class="form-control" name="course_name" id="course_name"
                                    placeholder="Enter name" value="{{ old('course_name', $course->course_name) }}"
                                    required>
                            </div>

                            <!-- Course Slug -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Course Slug</label>
                                <input type="text" class="form-control" name="course_name_slug" id="slug"
                                    placeholder="Auto generated"
                                    value="{{ old('course_name_slug', $course->course_name_slug) }}" required>
                            </div>

                            <!-- Course Title -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Course Title</label>
                                <input type="text" class="form-control" name="course_title" id="course_title"
                                    placeholder="Enter title" value="{{ old('course_title', $course->course_title) }}"
                                    required>
                            </div>

                            <!-- Level -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Level</label>
                                <select name="course_level" class="form-select">
                                    <option value="Beginner" {{ $course->course_level == 'Beginner' ? 'selected' : '' }}>
                                        Beginner</option>
                                    <option value="Intermediate"
                                        {{ $course->course_level == 'Intermediate' ? 'selected' : '' }}>Intermediate
                                    </option>
                                    <option value="Advanced" {{ $course->course_level == 'Advanced' ? 'selected' : '' }}>
                                        Advanced</option>
                                </select>
                            </div>

                            <!-- Duration -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Duration</label>
                                <input type="text" class="form-control" name="course_duration" placeholder="e.g. 6 hours"
                                    value="{{ old('course_duration', $course->course_duration) }}">
                            </div>

                            <!-- Selling Price -->
                            <div class="col-md-3 mt-3">
                                <label class="form-label">Selling Price</label>
                                <input type="number" class="form-control" name="selling_price" step="0.01"
                                    value="{{ old('selling_price', $course->selling_price) }}">
                            </div>

                            <!-- Discount Price -->
                            <div class="col-md-3 mt-3">
                                <label class="form-label">Discount Price</label>
                                <input type="number" class="form-control" name="discount_price" step="0.01"
                                    value="{{ old('discount_price', $course->discount_price) }}">
                            </div>

                            <!-- Preview Count -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Preview Lessons</label>
                                <input type="number" class="form-control" name="preview_count"
                                    value="{{ max(1, old('preview_count', $course->preview_count)) }}" min="1"
                                    max="200">
                            </div>

                            {{-- @php
                                $isFree = old('is_free', $course->is_free);
                                $totalLessons = $course->videos->count();
                                $maxPreview = $isFree ? max($totalLessons, 1) : 10;

                                $previewValue = old('preview_count', $course->preview_count ?? 1);
                                if ($previewValue > $maxPreview) {
                                    $previewValue = $maxPreview;
                                }
                            @endphp

                            <div class="col-md-6 mt-3">
                                <label class="form-label">Preview Lessons</label>
                                <input type="number" class="form-control" name="preview_count" value="{{ $previewValue }}"
                                    min="1" max="{{ $maxPreview }}">
                            </div> --}}


                            <!-- Pass Score -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Pass Score (%)</label>
                                <input type="number" class="form-control" name="pass_score"
                                    value="{{ old('pass_score', $course->pass_score) }}" min="1" max="100">
                            </div>

                            <!-- Resources -->
                            <div class="col-md-6 mt-3">
                                <label for="resources" class="form-label">Resources</label>
                                <input type="text" name="resources" class="form-control"
                                    value="{{ old('resources', $course->resources) }}">
                            </div>

                            <!-- Course Image -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Course Image</label>
                                <input type="file" name="course_image" id="course_image" class="form-control"
                                    accept="image/*">
                                @if ($course->course_image)
                                    <img src="/{{ $course->course_image }}" class="img-fluid mt-2" width="150"
                                        id="imagePreviewOld">
                                @endif
                                <img id="imagePreview" class="img-fluid mt-2 d-none" width="150">

                            </div>


                            <!-- Certificate -->
                            <div class="col-md-6 mt-3">
                                <label for="certificate" class="form-label">Certificate</label>
                                <select class="form-select" name="certificate" id="certificate" required>
                                    <option value="" disabled {{ $course->certificate == null ? 'selected' : '' }}>
                                        Select</option>
                                    <option value="yes" {{ $course->certificate == 'yes' ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="no" {{ $course->certificate == 'no' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                            </div>


                            <!-- Description -->
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control editor" name="description" required>{{ old('description', $course->description) }}</textarea>
                            </div>

                            <!-- Upload Video File (single) -->
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Upload Video File (optional)</label>
                                <input type="file" id="video_file" name="video_file" class="form-control"
                                    value="{{ old('video_file', $course->video_url) }}" accept="video/*">
                                <video id="videoFilePreview"
                                    style="display:none; width:100%; height:350px; margin-top:10px;" controls></video>
                            </div>

                            <!-- Multiple YouTube URLs -->
                            <div class="col-md-12 mt-3">
                                <label class="form-label">YouTube Video URLs (you can add many)</label>

                                <div id="videoInputs">

                                    @foreach ($course->videos as $video)
                                        <div class="input-group mb-2 video-input-row">
                                            <input type="url" name="video_urls[]" class="form-control"
                                                value="{{ old('video_urls', $video->video_url) }}">
                                            <button type="button" class="btn btn-danger removeVideo">X</button>
                                        </div>
                                    @endforeach

                                    @if ($course->videos->count() == 0)
                                        <div class="input-group mb-2 video-input-row">
                                            <input type="url" name="video_urls[]" class="form-control"
                                                value="">
                                            <button type="button" class="btn btn-danger removeVideo"
                                                style="display:none">X</button>
                                        </div>
                                    @endif


                                </div>


                                <div class="mt-2">
                                    <button type="button" id="addVideo" class="btn btn-success">Add More Video</button>
                                    <small class="text-muted ms-2">Max <span id="maxCountLabel">20</span> URLs.</small>
                                </div>
                            </div>

                            <!-- Certificate Template -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Certificate Template</label>
                                <input type="file" class="form-control" id="certificate_template"
                                    name="certificate_template" accept="image/*,.pdf">

                                @if ($course->certificate_template)
                                    @if (Str::endsWith($course->certificate_template, ['.jpg', '.jpeg', '.png', '.webp']))
                                        <img src="/{{ $course->certificate_template }}" width="200"
                                            class="img-fluid mt-2 rounded border">
                                    @else
                                        <p class="mt-2">Current file: {{ basename($course->certificate_template) }}</p>
                                    @endif
                                @endif

                                <img id="certificatePreview" class="img-fluid mt-2 d-none" width="200">
                            </div>

                            <!-- Flags -->
                            <div class="d-flex align-items-center gap-5 mt-3">

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="bestseller" name="bestseller"
                                        value="yes" {{ $course->bestseller == 'yes' ? 'checked' : '' }}>
                                    <label for="bestseller" class="form-check-label">Bestseller</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="featured" name="featured"
                                        value="yes" {{ $course->featured == 'yes' ? 'checked' : '' }}>
                                    <label for="featured" class="form-check-label">Featured</label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="highestrated"
                                        name="highestrated" value="yes"
                                        {{ $course->highestrated == 'yes' ? 'checked' : '' }}>
                                    <label for="highestrated" class="form-check-label">Highest Rated</label>
                                </div>

                            </div>


                        </div>


                        <!-- Submit -->
                        <div class="col-12 mt-4">
                            <button class="btn btn-primary">Update Course</button>
                        </div>

                </div>
                </form>

            </div>

        </div>
    </div>

    </div>
@endsection

@push('scripts')
    <script>
        // --- Auto slug from course_name (keeps course_name and course_title separate) ---
        (function() {
            const nameInput = document.getElementById("course_name");
            const slugInput = document.getElementById("slug");
            if (nameInput && slugInput) {
                nameInput.addEventListener("input", function() {
                    let slug = this.value.toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/(^-|-$)/g, '');
                    slugInput.value = slug;
                });
            }
        })();

        // --- Image preview ---
        document.getElementById('course_image')?.addEventListener('change', e => {
            const preview = document.getElementById('courseImagePreview');
            if (e.target.files && e.target.files[0]) {
                preview.src = URL.createObjectURL(e.target.files[0]);
                preview.classList.remove('d-none');
            } else {
                preview.classList.add('d-none');
            }
        });

        // --- Certificate preview (image only) ---
        document.getElementById('certificate_template')?.addEventListener('change', e => {
            const preview = document.getElementById('certificatePreview');
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('d-none');
            } else {
                preview.classList.add('d-none'); // pdf -> don't preview image
            }
        });

        // --- Video file preview ---
        document.getElementById('video_file')?.addEventListener('change', e => {
            const preview = document.getElementById('videoFilePreview');
            const file = e.target.files[0];
            if (!file) {
                preview.style.display = 'none';
                preview.src = '';
                return;
            }
            const validTypes = ['video/mp4', 'video/webm', 'video/ogg'];
            if (!validTypes.includes(file.type)) {
                alert('Please upload a valid video file (MP4, WebM, OGG).');
                e.target.value = '';
                preview.style.display = 'none';
                return;
            }
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        });

        // --- Dynamic add/remove YouTube URL inputs ---
        (function() {
            const maxCount = 100;
            const videoInputs = document.getElementById('videoInputs');
            const addBtn = document.getElementById('addVideo');
            const maxLabel = document.getElementById('maxCountLabel');
            maxLabel.textContent = maxCount;

            function updateRemoveButtons() {
                const rows = videoInputs.querySelectorAll('.video-input-row');
                rows.forEach((row, idx) => {
                    const btn = row.querySelector('.removeVideo');
                    // show remove only if more than 1 row
                    if (btn) btn.style.display = rows.length > 1 ? 'inline-block' : 'none';
                });
            }

            addBtn.addEventListener('click', function() {
                const current = videoInputs.querySelectorAll('.video-input-row').length;
                if (current >= maxCount) {
                    alert('Maximum number of video URLs reached (' + maxCount + ').');
                    return;
                }

                const newRow = document.createElement('div');
                newRow.className = 'input-group mb-2 video-input-row';
                newRow.innerHTML = `
                <input type="url" name="video_urls[]" class="form-control" placeholder="https://youtube.com/..." required>
                <button type="button" class="btn btn-danger removeVideo">X</button>
            `;
                videoInputs.appendChild(newRow);
                updateRemoveButtons();
            });

            // event delegation for remove buttons
            videoInputs.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('removeVideo')) {
                    const rows = videoInputs.querySelectorAll('.video-input-row');
                    if (rows.length <= 1) return; // keep at least one
                    e.target.closest('.video-input-row').remove();
                    updateRemoveButtons();
                }
            });

            // init
            updateRemoveButtons();
        })();

        // --- CKEditor init ---
        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.replace('description', {
                height: 360
            });
        }
    </script>
@endpush
