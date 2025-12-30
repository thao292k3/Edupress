<?php


use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AdminCourseController;
use App\Http\Controllers\backend\AdminInsuctorController;
use App\Http\Controllers\backend\BackendOrderController;
use App\Http\Controllers\backend\BlogController;
use App\Http\Controllers\backend\CommentModerationController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\CourseContentController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\CourseSectionController;
use App\Http\Controllers\backend\CourseVideoController;
use App\Http\Controllers\backend\InfoController;
use App\Http\Controllers\backend\InstructorController;
use App\Http\Controllers\backend\InstructorProfileController;
use App\Http\Controllers\backend\InstructorAssessmentController;
use App\Http\Controllers\backend\InstructorStatsController;
use App\Http\Controllers\backend\LessonController;
use App\Http\Controllers\backend\LessonProgressController;
use App\Http\Controllers\backend\LiveSessionController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\PartnerController;
use App\Http\Controllers\backend\PayController;
use App\Http\Controllers\backend\PayrollController;
use App\Http\Controllers\backend\QuestionController;
use App\Http\Controllers\backend\QuizController;
use App\Http\Controllers\Backend\RevenueController;
use App\Http\Controllers\backend\ReviewController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\SiteSetingController;
use App\Http\Controllers\backend\SiteSettingController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\SubcategoryController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\UserProfileController;
use App\Http\Controllers\frontend\BlogCommentController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\FrontenDashboardController;
use App\Http\Controllers\frontend\LectureController;
use App\Http\Controllers\frontend\SocialController;
use App\Http\Controllers\frontend\WishlistController;
use App\Http\Controllers\frontend\CourseController as FrontCourseController;
use App\Http\Controllers\frontend\LessonController as FrontLessonController;
use App\Http\Controllers\Frontend\QuizAttemptController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillAssessmentController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/auth/google', [SocialController::class, 'googleLogin'])->name('auth.google');
Route::get('/auth/google-callback', [SocialController::class, 'googleAuthentication'])->name('auth.google-callback');
Route::post('/auth/firebase/google', [SocialController::class, 'firebaseGoogleLogin']);

//Admin Login 
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'destroy'])->name('logout');
    Route::post('/export', [AdminController::class, 'export'])->name('export');

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
    Route::get('/all/instructor', [AdminInsuctorController::class, 'index'])
    ->name('all.instructor');

    Route::post('/update/instructor/status', [AdminInsuctorController::class, 'updateInstructorStatus'])
    ->name('update.instructor.status');


     /*  order controller  */
    Route::resource('order', BackendOrderController::class);

     /* control Course  */
    Route::resource('course', AdminCourseController::class);
    Route::post('/course-status', [AdminCourseController::class, 'courseStatus'])->name('course.status');
     /*  Setting Controller */
    Route::get('/mail-setting', [SettingController::class, 'mailSetting'])->name('mailSetting');
    Route::put('/mail-settings/update', [SettingController::class, 'updateMailSettings'])->name('mail.settings.update');

    Route::get('/stripe-setting', [SettingController::class, 'stripeSetting'])->name('stripeSetting');
    Route::post('/stripe-settings/update', [SettingController::class, 'updateStripeSettings'])->name('stripe.settings.update');

    Route::get('/google-setting', [SettingController::class, 'googleSetting'])->name('googleSetting ');
    Route::post('/google-settings/update', [SettingController::class, 'updateGoogleSettings'])->name('google.settings.update');


    
   /* Manage Partner  */

    Route::resource('partner', PartnerController::class);

     /* Manage Site Seetings */
    Route::resource('site-setting', SiteSetingController::class);



    Route::resource('blog', BlogController::class);

    // Comment moderation
    Route::get('/comments/pending', [CommentModerationController::class, 'index'])->name('comments.pending');
    Route::post('/comments/{id}/approve', [CommentModerationController::class, 'approve'])->name('comments.approve');
    Route::post('/comments/{id}/reject', [CommentModerationController::class, 'reject'])->name('comments.reject');

    Route::get('/review/pending', [ReviewController::class, 'pendingReview'])->name('review.pending');
    Route::get('/review/active', [ReviewController::class, 'activeReview'])->name('review.active');
    Route::post('/review/update-status', [ReviewController::class, 'updateReviewStatus'])->name('review.update.status');
    Route::get('/review/delete/{id}', [ReviewController::class, 'deleteReview'])->name('review.delete');


    Route::get('/admin/report/earnings', [AdminController::class, 'adminAllEarnings'])->name('all.earnings');
    Route::get('/admin/pay/instructor/{id}', [AdminController::class, 'updatePaymentStatus'])->name('pay.instructor');

    Route::prefix('payroll')->name('payroll.')->group(function() {
        Route::get('/index', [PayrollController::class, 'index'])->name('index');
        Route::get('/create', [PayrollController::class, 'create'])->name('create');
        Route::post('/store', [PayrollController::class, 'store'])->name('store');
        Route::get('/show/{id}', [PayrollController::class, 'show'])->name('show');
       
        Route::get('/payroll/delete/{id}', [PayrollController::class, 'destroy'])->name('delete');
       
        Route::get('/admin/payroll/edit/{id}', [PayrollController::class, 'edit'])->name('edit');


        Route::post('/admin/payroll/update/{id}', [PayrollController::class, 'update'])->name('update');
        Route::get('/payroll/update-status/{id}', [PayrollController::class, 'updateStatus'])->name('updateStatus');
        Route::post('/upload-receipt/{id}', [PayrollController::class, 'uploadReceipt'])->name('upload_receipt');
        Route::post('/export', [PayrollController::class, 'export'])->name('export');

        Route::get('/payroll/generate-receipt/{id}', [PayrollController::class, 'adminGenerateReceipt'])->name('generate_receipt');
    });


       Route::prefix('revenue')->name('revenue.')->group(function() {
        Route::get('/index', [RevenueController::class, 'index'])->name('index');
        Route::get('/export', [RevenueController::class, 'exportExcel'])->name('export');
        });
        
   
    
});



    

// Instructor Login
Route::get('/instructor/login', [InstructorController::class, 'login'])
    ->name('instructor.login');

Route::middleware(['auth', 'verified', 'role:instructor'])
    ->prefix('instructor')
    ->name('instructor.')
    ->group(function () {

        // Dashboard & Auth
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


        // QUẢN LÝ KHÓA HỌC (Resource)
        Route::resource('course', CourseController::class);

        // THÊM ROUTE XEM TIẾN ĐỘ VÀO ĐÂY 
        Route::get('/course/{course}/students', [CourseController::class, 'showCourseStudents'])
             ->name('course.students.progress'); 

        // QUẢN LÝ SECTION 

        Route::resource('course-section', CourseSectionController::class);
        
        Route::get('/course/{course}/sections', [CourseSectionController::class, 'index'])
        ->name('course.sections.index');
       
        Route::get('course/{course}/content', [CourseContentController::class, 'index'])
            ->name('course.content');

        Route::post('course/sections/store', [CourseSectionController::class, 'store'])
        ->name('sections.store');

        Route::post('course/sections/sort', [CourseContentController::class, 'sortSections'])
        ->name('sections.sort');


        // QUẢN LÝ VIDEO 
        
        Route::post('/course/{course}/sections/{section}/videos', 
            [CourseVideoController::class, 'storeSectionVideo'] 
        )->name('course.sections.videos.store'); 

        Route::post('/course/{course}/videos', 
            [CourseVideoController::class, 'storeOld']
        )->name('course.videos.store');

        Route::prefix('videos')->name('videos.')->group(function () {
            Route::get('/', [CourseVideoController::class, 'index'])->name('index');
            Route::get('/create', [CourseVideoController::class, 'create'])->name('create');
            
            Route::post('/', [CourseVideoController::class, 'store'])->name('store'); 
            
            Route::delete('/{video}', [CourseVideoController::class, 'destroy'])->name('destroy'); 
        });

        // QUẢN LÝ LESSONS (Resource-like grouping)
        Route::prefix('lessons')->name('lessons.')->group(function () {
            Route::get('/', [LessonController::class, 'index'])->name('index');
            Route::get('/create', [LessonController::class, 'create'])->name('create');
            Route::post('/store', [LessonController::class, 'store'])->name('store');
            Route::get('/{lesson}/edit', [LessonController::class, 'edit'])->name('edit');
            Route::put('/{lesson}', [LessonController::class, 'update'])->name('update');
            Route::delete('/{lesson}', [LessonController::class, 'destroy'])->name('destroy');
            Route::post('/sort', [LessonController::class, 'sort'])->name('sort');
            Route::post('/mark-lesson-completed', [LessonController::class, 'markCompleted']);
            
        });

        Route::resource('quizzes', QuizController::class, [
         'names' => 'quizzes'
        ]);

        // Instructor-managed skill assessment questions
        Route::resource('assessments', InstructorAssessmentController::class);

        Route::resource('quizzes.questions', QuestionController::class, [
            'names' => 'quizzes.questions',
            'parameters' => [
            'questions' => 'question' 
            ]
        ])->except(['index']); 

        Route::resource('live-sessions', LiveSessionController::class, [
        'names' => 'live-sessions'
    ]);

    Route::get('/live-join/{live_session}', [AttendanceController::class, 'joinSession'])
     ->name('live.join')
     ->middleware('auth');  

    Route::resource('coupon', CouponController::class);

    Route::get('/instructor/report/earnings', [InstructorStatsController::class, 'instructorEarnings'])->name('instructor.earnings');

    Route::get('/instructor/withdrawal', [InstructorController::class, 'withdrawalIndex'])->name('instructor.withdrawal.index');
    Route::post('/instructor/withdrawal/request', [InstructorController::class, 'withdrawalRequest'])->name('instructor.withdrawal.request');

    Route::prefix('payroll')->name('payroll.')->group(function() {
        Route::get('/index', [PayrollController::class, 'instructorIndex'])->name('index');
        Route::get('/show/{id}', [PayrollController::class, 'instructorShow'])->name('show');
        Route::post('/confirm/{id}', [PayrollController::class, 'confirmPayroll'])->name('confirm');
        Route::get('/payroll/details/{id}', [PayrollController::class, 'instructorPayrollShow'])->name('show');
    });

    Route::get('/instructor/certificate/download/{courseId}/{userId}', [CourseController::class, 'downloadCertificate'])
    ->name('certificate.download');


    Route::post('/instructor/approve-certificate/{courseId}/{userId}', [CourseController::class, 'approveCertificate'])
    ->name('certificate.approve');

});


//user Route

Route::middleware(['auth', 'verified', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [UserController::class, 'destroy'])
        ->name('logout');
      

    //Profile

    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
    Route::post('/profile/store', [UserProfileController::class, 'store'])->name('profile.store');
    Route::get('/setting', [UserProfileController::class, 'setting'])->name('setting');
    Route::post('/password/setting', [UserProfileController::class, 'passwordSetting'])->name('passwordSetting');

    /* Wishlist controller */

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('/wishlist-data', [WishlistController::class, 'getWishlist']);
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    Route::post('/store/review', [ReviewController::class, 'storeReview'])->name('store.review');
    
});

     
     
//Frontend Routers

Route::get('/', [FrontenDashboardController::class, 'home'])->name('frontend.home');
Route::get('/category/{id}', [FrontenDashboardController::class, 'CategoryCourse'])
    ->name('category.course');
// Posts page (frontend)
Route::get('/posts', [FrontenDashboardController::class, 'posts'])->name('frontend.posts');
Route::get('/posts/{slug}', [FrontenDashboardController::class, 'blogShow'])->name('frontend.blog.show');

// Blog comments
Route::post('/posts/{slug}/comments', [BlogCommentController::class, 'store'])->name('frontend.blog.comment.store');
Route::post('/comments/{id}/helpful', [BlogCommentController::class, 'helpful'])->name('frontend.blog.comment.helpful');
Route::get('/course-details/{slug}', [FrontenDashboardController::class, 'view'])->name('course-details');


// Frontend course list
Route::get('/courses', [FrontCourseController::class, 'index'])->name('frontend.courses');

// Lesson detail (player) route
Route::get('/lesson/{id}', [FrontLessonController::class, 'show'])->name('frontend.lesson.show');
// Mark lesson as watched (AJAX)
Route::post('/lesson/{id}/watched', [FrontLessonController::class, 'markWatched'])->name('frontend.lesson.watched');


Route::get('/assessment', [SkillAssessmentController::class, 'showAssessment'])->name('assessment.show');
Route::post('/assessment/submit', [SkillAssessmentController::class, 'submitAssessment'])->name('assessment.submit');

Route::get('/course/{id}/test', [SkillAssessmentController::class, 'showCourseTest'])->name('course.test');
Route::post('/course/{id}/test/submit', [SkillAssessmentController::class, 'submitCourseTest'])->name('course.test.submit');

// My courses (requires auth)
Route::middleware('auth')->get('/my-courses', [FrontCourseController::class, 'myCourses'])->name('frontend.my.courses');

/* wishlist controller  */

Route::get('/wishlist/all', [WishlistController::class, 'allWishlist']);
Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist']);

/* Cart Controller */
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/all', [CartController::class, 'cartAll']);
Route::get('/fetch/cart', [CartController::class, 'fetchCart']);
Route::post('/remove/cart', [CartController::class, 'removeCart']);

/*  Checkout */
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
// Coupon Apply

Route::post('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply.coupon');

Route::post('/user/account/delete', [UserController::class, 'deleteAccount'])->name('user.account.delete');  

// Checkout coupon
Route::post('/apply-checkout-coupon', [CouponController::class, 'applyCheckoutCoupon'])->name('checkoutCoupon');

/* Auth Protected Route */

Route::middleware('auth')->group(function () {

    /* Order  */
    Route::post('/order', [OrderController::class, 'order'])->name('order');
    Route::get('/payment-success', [OrderController::class, 'success'])->name('success');
    Route::get('/payment-cancel', [OrderController::class, 'cancel'])->name('cancel');
    //Route::resource('rating', RatingController::class);
    Route::post('/enroll-course/{id}', [OrderController::class, 'enrollCourse'])->name('enroll.course');
});

Route::post('/lesson/update-progress', [LessonProgressController::class, 'updateVideoProgress'])->name('update.video.progress');


Route::get('/join-session/{id}', [LiveSessionController::class, 'joinSession'])->name('join.session');



// 1. Trang vào làm bài
Route::get('/quiz/take/{id}', [QuizAttemptController::class, 'takeQuiz'])->name('quiz.take');

// 2. Trang xử lý nộp bài 
Route::post('/quiz/submit/{id}', [QuizAttemptController::class, 'submitQuiz'])->name('quiz.submit');

// 3. Trang hiển thị kết quả
Route::get('/quiz/result/{result_id}', [QuizAttemptController::class, 'showResult'])->name('quiz.result');


require __DIR__.'/auth.php';
