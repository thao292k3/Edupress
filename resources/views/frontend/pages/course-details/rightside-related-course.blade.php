<div class="card card-item">
    <div class="card-body">
        <h3 class="card-title fs-18 pb-2">Related Courses</h3>
        <div class="divider"><span></span></div>
        @php
          $related_course = \App\Models\Course::where('subcategory_id', $course->subcategory_id)->take(3)->get();

        @endphp

        @foreach($related_course as $course)
        <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
            <a href="course-details.html" class="media-img">
                <img class="card-img-top lazy" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 150 150'%3E%3Crect fill='%23f0f0f0' width='150' height='150'/%3E%3C/svg%3E" 
                    data-src="{{ asset($course->course_image) }}" 
                    alt="Card image cap" loading="lazy">
            </a>
            <div class="media-body">
                <h5 class="fs-15">
                    <a href="course-details.html">{{\Illuminate\Support\Str::limit($course->course_name, 50)}}</a>
                </h5>
                <span class="d-block lh-18 py-1 fs-14">{{$course['user']['name']}}</span>
                
            </div>
        </div><!-- end media -->
        @endforeach

        <div class="view-all-course-btn-box">
            <a href="#" class="btn theme-btn w-100">View All Courses <i
                    class="la la-arrow-right icon ml-1"></i></a>
        </div>
    </div>
</div><!-- end card -->
