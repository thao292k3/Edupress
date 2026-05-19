@extends('backend.instructor.master')

@section('content')
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Khóa học</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm khóa học</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card col-md-12">
            <div class="card-body">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-4">Thêm khóa học</h5>
                        <a href="{{ route('instructor.course.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>

                    <form action="{{ route('instructor.course.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

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
                                <label class="form-label">Thể loại</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">-- Select --</option>
                                    @foreach ($all_categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Subcategory -->
                            <div class="col-md-6">
                                <label class="form-label">Danh mục con</label>
                                <select name="subcategory_id" class="form-select">
                                    <option value="">-- Select --</option>
                                    @foreach ($all_categories as $category)
                                        <optgroup label="{{ $category->name }}"> 
                                            @foreach ($subcategories->where('category_id', $category->id) as $sub)
                                                <option value="{{ $sub->id }}"
                                                    {{ isset($course) && $course->subcategory_id == $sub->id ? 'selected' : '' }}>
                                                    {{ $sub->name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Course Type -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Khóa học miễn phí</label>
                                <div class="col-sm-9 text-secondary">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_free" name="is_free"
                                            value="1"
                                            {{ old('is_free', $course->is_free ?? 0) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_free">Chọn nếu đây là khóa học miễn
                                            phí</label>
                                    </div>
                                    @error('is_free')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Course Name -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Tên khóa học</label>
                                <input type="text" class="form-control" name="course_name" id="course_name"
                                    placeholder="Enter name" value="{{ old('course_name') }}" required>
                            </div>

                            <!-- Course Slug -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Course Slug</label>
                                <input type="text" class="form-control" name="course_name_slug" id="slug"
                                    placeholder="Auto generated" value="{{ old('course_name_slug') }}" required>
                            </div>

                            <!-- Course Title -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Course Title</label>
                                <input type="text" class="form-control" name="course_title" placeholder="Enter title"
                                    value="{{ old('course_title') }}" required>
                            </div>

                            <!-- Level -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Mức độ</label>
                                <select name="level" class="form-select">
                                    <option value="">Choose</option>
                                    <option value="Beginner">Người bắt đầu</option>
                                    <option value="Intermediate">Cơ bản</option>
                                    <option value="Advanced">Nâng cao</option>
                                </select>
                            </div>

                            <!-- Duration -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Thời gian</label>
                                <input type="text" class="form-control" name="course_duration"
                                    placeholder="e.g. 6 hours">
                            </div>

                            <!-- Resources -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Tổng bài học</label>
                                <input type="number" class="form-control" name="resources">
                            </div>

                            <!-- Course Image -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Hình ảnh khóa học</label>
                                <input type="file" class="form-control" id="course_image" name="course_image"
                                    accept="image/*">
                                <img id="courseImagePreview" class="img-fluid mt-2 d-none" width="150">
                            </div>

                            <!-- Description -->
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Mô tả khóa học</label>
                                <textarea class="form-control editor" name="description" required>{{ old('description') }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="course_goal" class="form-label">Mục tiêu khóa học </label>
                                <div id="goalContainer">
                                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                                        <input type="text" class="form-control" name="course_goals[]"
                                            placeholder="Enter Course Goal" />
                                        <button type="button" id="addGoalInput" class="btn btn-primary">+</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Selling Price -->
                            <div id="paid_course_options">
                                <h5 class="mb-3 mt-3 text-secondary">Tuỳ chọn cho Khóa học Trả phí</h5>

                                <div class="row mb-3">

                                    <div class="col-md-6 ">
                                        <label class="form-label">Giá gốc</label>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="number" step="0.01" min="0" class="form-control"
                                                name="selling_price"
                                                value="{{ old('selling_price', $course->selling_price ?? '') }}"
                                                placeholder="1000000" />
                                            @error('selling_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Discount Price -->
                                    <div class="col-md-6">
                                        <label class="form-label">Giá giảm</label>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="number" step="0.01" min="0" class="form-control"
                                                name="discount_price"
                                                value="{{ old('discount_price', $course->discount_price ?? '') }}"
                                                placeholder="900000" />
                                            @error('discount_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">Thời gian học (tháng)</label>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="number" min="1" class="form-control"
                                                name="limit_duration_months"
                                                value="{{ old('limit_duration_months', $course->limit_duration_months ?? '') }}"
                                                placeholder="Để trống nếu là vĩnh viễn" />
                                            <small class="text-muted">Đặt số tháng học viên có thể truy cập khóa học này.
                                                Để trống cho vĩnh viễn.</small>
                                        </div>
                                    </div>

                                    <!-- Preview Count -->
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">Xem trước bài học</label>
                                        <input type="number" class="form-control" name="preview_count" value="1"
                                            min="1" max="200">
                                    </div>

                                    <!-- Pass Score -->
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">Điểm qua khóa học (%)</label>
                                        <input type="number" class="form-control" name="pass_score" value="60"
                                            min="1" max="100">
                                    </div>

                                    <!-- Certificate Enable -->
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">Chứng nhận</label>
                                        <select class="form-select" name="certificate">
                                            <option value="no">No</option>
                                            <option value="yes">Yes</option>
                                        </select>
                                    </div>

                                    <!-- Certificate Template -->
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">Hình ảnh giáy chứng nhận</label>
                                        <input type="file" class="form-control" name="certificate_template"
                                            accept="image/*,.pdf">
                                        <img id="certificatePreview" class="img-fluid mt-2 d-none" width="150">
                                    </div>

                                </div>


                                <hr>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <h5 class="text-primary mt-4">Lịch giải đáp thắc mắc (Giới hạn sĩ số)</h5>
                                        <div id="live-session-container">
                                            <div class="row g-2 mb-3 session-row border p-2">
                                                <div class="col-md-3">
                                                    <label class="form-label">Chủ đề</label>
                                                    <input type="text" name="live_sessions[0][topic]"
                                                        class="form-control" placeholder="Chủ đề">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Thời gian</label>
                                                    <input type="datetime-local" name="live_sessions[0][start_at]"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Tối thiểu</label>
                                                    <input type="number" name="live_sessions[0][min_participants]"
                                                        class="form-control" value="15">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Tối đa</label>
                                                    <input type="number" name="live_sessions[0][max_participants]"
                                                        class="form-control" value="20">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Link</label>
                                                    <input type="url" name="live_sessions[0][meeting_link]"
                                                        class="form-control" placeholder="Link Zoom">
                                                </div>
                                                <div class="col-12 text-end mt-1">
                                                    <button type="button" class="btn btn-danger btn-sm remove-row">Xóa
                                                        buổi này</button>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-outline-dark btn-sm" id="add-session-btn">+
                                            Thêm buổi học</button>
                                    </div>
                                </div>






                                <!-- Flags -->
                                <div class="col-md-6 mt-3">
                                    <label class="form-lable">Gắn nhãn</label>

                                    <div class="d-flex align-items-center gap-4 mt-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="bestseller"
                                                name="bestseller" value="yes"
                                                {{ old('bestseller', $course->bestseller ?? '') == 'yes' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="bestseller">Bán chạy nhất</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="featured"
                                                name="featured" value="yes"
                                                {{ old('featured', $course->featured ?? '') == 'yes' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="featured">Nổi bật</label>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="highestrated"
                                                name="highestrated" value="yes"
                                                {{ old('highestrated', $course->highestrated ?? '') == 'yes' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="highestrated">Đánh giá cao nhất</label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng thái Khóa học</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="0"
                                        {{ old('status', $course->status ?? 0) == 0 ? 'selected' : '' }}>
                                        0 - Nháp (Draft)
                                    </option>
                                    <option value="1"
                                        {{ old('status', $course->status ?? 0) == 1 ? 'selected' : '' }}>
                                        1 - Xuất bản (Published)
                                    </option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <!-- Submit -->
                            <div class="col-12 mt-4">
                                <button class="btn btn-primary">Tạo khóa học</button>
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
        // Auto slug
        document.getElementById("course_name")?.addEventListener("input", function() {
            document.getElementById("slug").value =
                this.value.toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
        });

        // Image Preview
        document.getElementById('course_image')?.addEventListener('change', e => {
            const preview = document.getElementById('courseImagePreview');
            preview.src = URL.createObjectURL(e.target.files[0]);
            preview.classList.remove('d-none');
        });

        // Certificate preview image only
        document.getElementById('certificate_template')?.addEventListener('change', e => {
            const preview = document.getElementById('certificatePreview');
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('d-none');
            } else preview.classList.add('d-none');
        });

        document.addEventListener('DOMContentLoaded', function() {
            const isFreeCheckbox = document.getElementById('is_free');
            const paidOptionsContainer = document.getElementById('paid_course_options');

            if (!isFreeCheckbox || !paidOptionsContainer) return;


            const inputsToReset = [
                document.querySelector('input[name="selling_price"]'),
                document.querySelector('input[name="discount_price"]'),
                document.getElementById('bestseller'),
                document.getElementById('featured'),
                document.getElementById('highestrated'),
                document.querySelector('input[name="limit_duration_months"]'),
            ];

            function togglePaidOptions() {
                if (isFreeCheckbox.checked) {

                    paidOptionsContainer.style.display = 'none';


                    inputsToReset.forEach(input => {
                        if (input) {
                            if (input.type === 'checkbox') {

                                input.checked = false;

                                input.value = '';
                            } else {

                                input.value = '';
                            }
                        }
                    });

                } else {

                    paidOptionsContainer.style.display = 'block';
                }
            }


            isFreeCheckbox.addEventListener('change', togglePaidOptions);
            togglePaidOptions();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const goalContainer = document.getElementById('goalContainer');
            const addGoalButton = document.getElementById('addGoalInput');


            function addGoalInput() {

                const newGoalRow = document.createElement('div');
                newGoalRow.style.display = 'flex';
                newGoalRow.style.alignItems = 'center';
                newGoalRow.style.gap = '10px';
                newGoalRow.style.marginBottom = '10px';
                newGoalRow.className = 'goal-input-row';


                newGoalRow.innerHTML = `
                    <input type="text" class="form-control" name="course_goals[]"
                        placeholder="Enter Course Goal" required />
                    <button type="button" class="btn btn-danger removeGoalInput">X</button>
                `;


                goalContainer.appendChild(newGoalRow);


                newGoalRow.querySelector('input').focus();
            }


            addGoalButton.addEventListener('click', addGoalInput);


            goalContainer.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('removeGoalInput')) {
                    const rows = goalContainer.querySelectorAll('.goal-input-row');


                    if (rows.length > 1) {
                        e.target.closest('.goal-input-row').remove();
                    } else {
                        alert('Bạn phải giữ lại ít nhất một Mục tiêu khóa học.');
                    }
                }
            });


            if (goalContainer.querySelectorAll('.goal-input-row').length === 0) {

                const firstGoal = goalContainer.querySelector('input[name="course_goals[]"]').closest('div');
                if (firstGoal) {
                    firstGoal.classList.add('goal-input-row');
                }
            }
        });



        // CKEditor
        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.replace('description', {
                height: 360
            });
        }

        let sIdx = 1;
        document.getElementById('add-session-btn').addEventListener('click', function() {
            let html = `
                <div class="row g-2 mb-3 session-row border p-2">
                    <div class="col-md-3"><input type="text" name="live_sessions[${sIdx}][topic]" class="form-control" placeholder="Chủ đề"></div>
                    <div class="col-md-3"><input type="datetime-local" name="live_sessions[${sIdx}][start_at]" class="form-control"></div>
                    <div class="col-md-2"><input type="number" name="live_sessions[${sIdx}][min_participants]" class="form-control" value="15"></div>
                    <div class="col-md-2"><input type="number" name="live_sessions[${sIdx}][max_participants]" class="form-control" value="20"></div>
                    <div class="col-md-2"><input type="url" name="live_sessions[${sIdx}][meeting_link]" class="form-control" placeholder="Link"></div>
                    <div class="col-12 text-end mt-1"><button type="button" class="btn btn-danger btn-sm remove-row">Xóa buổi này</button></div>
                </div>`;
            document.getElementById('live-session-container').insertAdjacentHTML('beforeend', html);
            sIdx++;
        });
    </script>
@endpush
