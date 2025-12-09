<?php


use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AdminInsuctorController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\CourseSectionController;
use App\Http\Controllers\backend\CourseVideoController;
use App\Http\Controllers\backend\InfoController;
use App\Http\Controllers\backend\InstructorController;
use App\Http\Controllers\backend\InstructorProfileController;
use App\Http\Controllers\backend\LessonController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\SubcategoryController;
use App\Http\Controllers\frontend\FrontenDashboardController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Admin Login 
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'destroy'])->name('logout');

    //Profile Routes
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::post('/profile/store', [AdminProfileController::class, 'store'])->name('profile.store');
    Route::get('/setting', [AdminProfileController::class, 'setting'])->name('setting');
    Route::post('/password/setting', [AdminProfileController::class, 'passwordSetting'])->name('passwordSetting');

    //Category Management
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubcategoryController::class);

    //Manage Slider Controller
    Route::resource('slider', SliderController::class);

    //Manage InfoBox Controller
    Route::resource('info', InfoController::class);

      //Controller instructor 

    Route::resource('instructor', AdminInsuctorController::class);
    Route::post('/update-status',[AdminInsuctorController::class,'updateStatus'])->name('instructor.status');
    Route::get('instructor-active-list', [AdminInsuctorController::class, 'instructorActive'])->name('instructor.active');
    
});

// //Instructor Login 
// Route::get('/instructor/login', [InstructorController::class, 'login'])->name('instructor.login');

// Route::middleware(['auth', 'verified', 'role:instructor'])->prefix('instructor')->name('instructor.')->group(function () {
//     Route::get('/dashboard', [InstructorController::class, 'dashboard'])->name('dashboard');
//     Route::post('/logout', [InstructorController::class, 'destroy'])->name('logout');

//     //Profile Routes
//     Route::get('/profile', [InstructorProfileController::class, 'index'])->name('profile');
//     Route::post('/profile/store', [InstructorProfileController::class, 'store'])->name('profile.store');
//     Route::get('/setting', [InstructorProfileController::class, 'setting'])->name('setting');
//     Route::post('/password/setting', [InstructorProfileController::class, 'passwordSetting'])->name('passwordSetting');

//     //Manage Courses
//     Route::resource('course', CourseController::class);

//     // Manage Course Videos
// Route::post('/course/{course}/videos', [CourseVideoController::class, 'store'])->name('course.videos.store');
// Route::delete('/course/videos/{video}', [CourseVideoController::class, 'destroy'])->name('course.videos.destroy');
    

// });


//Instructor Login 
    Route::get('/instructor/login', [InstructorController::class, 'login'])
        ->name('instructor.login');

    Route::middleware(['auth', 'verified', 'role:instructor'])
        ->prefix('instructor')
        ->name('instructor.')
        ->group(function () {

            // Dashboard
            Route::get('/dashboard', [InstructorController::class, 'dashboard'])
                ->name('dashboard');
            Route::post('/logout', [InstructorController::class, 'destroy'])
                ->name('logout');

            // Profile
            Route::get('/profile', [InstructorProfileController::class, 'index'])
                ->name('profile');
            Route::post('/profile/store', [InstructorProfileController::class, 'store'])
                ->name('profile.store');
            Route::get('/setting', [InstructorProfileController::class, 'setting'])
                ->name('setting');
            Route::post('/password/setting', [InstructorProfileController::class, 'passwordSetting'])
                ->name('passwordSetting');


           
            Route::resource('course', CourseController::class);


           
            Route::resource('course-sections', CourseSectionController::class);

            // List sections of a course
            Route::get('/course/{course}/sections',
                [CourseSectionController::class, 'index']
            )->name('course-section.index');

            // Single section detail
            Route::get('/course/{course}/section/{section}',
                [CourseSectionController::class, 'show']
            )->name('course-section.show');


           
            Route::post('/course/{course}/section/{section}/videos',
                [CourseVideoController::class, 'store']
            )->name('course-section.videos.store');


            
            Route::post('/course/{course}/videos', 
                [CourseVideoController::class, 'storeOld']
            )->name('course.videos.store');

            Route::delete('/course/videos/{video}', 
                [CourseVideoController::class,'destroy']
            )->name('course.videos.destroy');


            //LESSONS
                Route::prefix('lessons')->name('lessons.')->group(function () {
            Route::get('/', [LessonController::class, 'index'])->name('index');
            Route::get('/create', [LessonController::class, 'create'])->name('create');
            Route::post('/store', [LessonController::class, 'store'])->name('store');
            Route::get('/{lesson}/edit', [LessonController::class, 'edit'])->name('edit');
            Route::put('/{lesson}', [LessonController::class, 'update'])->name('update');
            Route::delete('/{lesson}', [LessonController::class, 'destroy'])->name('destroy');
            
            Route::post('/sort', [LessonController::class, 'sort'])->name('sort');
    });                             

        
    Route::prefix('videos')->name('videos.')->group(function () {

        // Danh sách video
        Route::get('/', [CourseVideoController::class, 'index'])->name('index');

        // Upload + thêm mới video
        Route::get('/create', [CourseVideoController::class, 'create'])->name('create');
        Route::post('/store', [CourseVideoController::class, 'store'])->name('store');

        // Xóa video
        Route::delete('/{video}', [CourseVideoController::class, 'destroy'])->name('destroy');
    });
});
//Frontend Routers

Route::get('/', [FrontenDashboardController::class, 'home'])->name('frontend.home');


require __DIR__.'/auth.php';
