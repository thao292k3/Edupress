<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin: 0; }
        body { 
            font-family: 'DejaVu Sans', sans-serif; 
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }
        .certificate-container {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
        }
        /* Lấy ảnh từ database làm nền */
        .bg-image {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: -1;
        }
        .student-name {
            position: absolute;
            top: 45%; /* Bạn điều chỉnh % này cho khớp với vị trí dòng trống trên ảnh của bạn */
            left: 0; width: 100%;
            font-size: 35px;
            font-weight: bold;
            color: #333;
        }
        .date {
            position: absolute;
            top: 80%; /* Điều chỉnh theo vị trí ngày tháng trên ảnh */
            left: 0; width: 100%;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
    @if($course->certificate_template)
       
        <img src="{{ public_path($course->certificate_template) }}" class="bg-image">
    @else
        
        <img src="{{ public_path('uploads/certificates/default.jpg') }}" class="bg-image">
    @endif

    <div class="student-name">{{ $user->name }}</div>
    <div class="course-title">{{ $course->course_name }}</div>
    <div class="date">{{ date('d/m/Y') }}</div>
</div>
</body>
</html>