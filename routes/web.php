<?php


use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\AdminCourseController;
use App\Http\Controllers\backend\AdminInsuctorController;
use App\Http\Controllers\backend\BackendOrderController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\CourseContentController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\CourseSectionController;
use App\Http\Controllers\backend\CourseVideoController;
use App\Http\Controllers\backend\InfoController;
use App\Http\Controllers\backend\InstructorController;
use App\Http\Controllers\backend\InstructorProfileController;

use App\Http\Controllers\backend\LessonController;
use App\Http\Controllers\backend\LiveSessionController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\PartnerController;
use App\Http\Controllers\backend\QuestionController;
use App\Http\Controllers\backend\QuizController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\SiteSettingController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\SubcategoryController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\UserProfileController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\FrontenDashboardController;
use App\Http\Controllers\frontend\LectureController;
use App\Http\Controllers\frontend\SocialController;
use App\Http\Controllers\frontend\WishlistController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/auth/google', [SocialController::class, 'googleLogin'])->name('auth.google');
Route::get('/auth/google-callback', [SocialController::class, 'googleAuthentication'])->name('auth.google-callback');

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
    Route::resource('site-setting', SiteSettingController::class);


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
        });

        Route::resource('quizzes', QuizController::class, [
         'names' => 'quizzes'
        ]);

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
});

     
     
//Frontend Routers

Route::get('/', [FrontenDashboardController::class, 'home'])->name('frontend.home');

Route::get('/course-details/{slug}', [FrontenDashboardController::class, 'view'])->name('course-details');

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

// Checkout coupon
Route::post('/apply-checkout-coupon', [CouponController::class, 'applyCheckoutCoupon'])->name('checkoutCoupon');

/* Auth Protected Route */

Route::middleware('auth')->group(function () {

    /* Order  */
    Route::post('/order', [OrderController::class, 'order'])->name('order');
    Route::get('/payment-success', [OrderController::class, 'success'])->name('success');
    Route::get('/payment-cancel', [OrderController::class, 'cancel'])->name('cancel');
    //Route::resource('rating', RatingController::class);
});

require __DIR__.'/auth.php';
