<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\InstructorEarning;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Payroll;
use App\Models\User;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    

    public function order(OrderRequest $request)
    {

        session()->put('stripe_data', $request->validated());
       
        return $this->paymentService->processPayment($request->validated());
    }

     public function success(Request $request)
    {
        
        $sessionId = $request->query('session_id');
        $stripe = new StripeClient(config('stripe.stripe_sk'));

        try {
            
            $session = $stripe->checkout->sessions->retrieve($sessionId);
            $paymentIntent = $stripe->paymentIntents->retrieve($session->payment_intent);

            

            $stripe_data = session()->get('stripe_data');

            $paymentData = $stripe_data;

            
          //  PaymentSuccessful::dispatch($paymentData);

            
            $this->createPayment($session, $paymentIntent);

            
            $guestToken = $request->cookie('guest_token') ?? Str::uuid();
            Cart::where('guest_token', $guestToken)->delete();

            
            session()->forget('coupon','stripe_data');

            return redirect('/')->with('success', 'Course purchase successfully');


            // return view('frontend.pages.checkout.stripe.success', ['session' => $session]);
        } catch (\Exception $e) {

            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function cancel()
    {

        return view('frontend.pages.checkout.stripe.cancel');
    }


    private function createPayment($session, $paymentIntent)
    {
        
        $currency = strtolower($session->currency);

        
        $zeroDecimalCurrencies = ['vnd', 'jpy', 'krw', 'bif', 'clp', 'djf', 'gnf', 'kmf', 'mga', 'pyg', 'rwf', 'ugx', 'vuv', 'xaf', 'xof', 'xpf'];

        if (in_array($currency, $zeroDecimalCurrencies)) {
            
            $totalAmount = $session->amount_total;
        } else {
            
            $totalAmount = $session->amount_total / 100;
        }
        
        
        $payment = Payment::create([
            'transaction_id' => $paymentIntent->id,
            'name' => $session->customer_details->name, 
            'email' => $session->customer_email, 
            
        
            'total_amount' => $totalAmount, 
            
            'payment_type' => 'stripe', 
            'invoice_no' => 'INV-' . strtoupper(uniqid()), 
            'order_date' => now()->toDateString(),
            'order_month' => now()->format('F'),
            'order_year' => now()->year,
            'status' => 'completed', 
        ]);

        
        $this->createOrder($payment->id);
    }

    private function createOrder($paymentId) {
        $stripeData = session('stripe_data'); 
        $totalCouponDiscount = session('coupon', 0);
        $totalCartPrice = array_sum($stripeData['course_price']);
        
        foreach ($stripeData['course_id'] as $index => $courseId) {
            $originalPrice = $stripeData['course_price'][$index];
            $instructorId = $stripeData['instructor_id'][$index];

            
            $instructor = \App\Models\User::find($instructorId);
            $commissionRate = $instructor->commission_rate ?? 40; 

            
            $couponForThisCourse = 0;
            if ($totalCouponDiscount > 0 && $totalCartPrice > 0) {
                $couponForThisCourse = ($originalPrice / $totalCartPrice) * $totalCouponDiscount;
            }
            $actualRevenue = $originalPrice - $couponForThisCourse;

            
            $adminAmount = ($actualRevenue * $commissionRate) / 100; 
            $instructorAmount = $actualRevenue - $adminAmount;      

            
            $order = Order::create([
                'payment_id' => $paymentId, 
                'user_id' => auth()->user()->id, 
                'course_id' => $courseId,
                'instructor_id' => $instructorId, 
                'course_title' => $stripeData['course_name'][$index],
                'price' => $originalPrice,
            ]);

            
            InstructorEarning::create([
                'instructor_id' => $order->instructor_id,
                'order_id' => $order->id,
                'course_id' => $order->course_id,
                'total_price' => $actualRevenue,        
                'admin_commission' => $adminAmount,    
                'instructor_amount' => $instructorAmount, 
                'payment_status' => 'pending',          
            ]);

            
            $this->handleEnrollment($courseId, $originalPrice);
        }
    }

    public function enrollCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        
        
        $exists = CourseEnrollment::where('user_id', auth()->id())->where('course_id', $id)->exists();
        if ($exists) {
            return redirect()->route('frontend.my.courses')->with('info', 'Bạn đã đăng ký khóa học này rồi.');
        }

        if ($course->selling_price <= 0) {
            
            CourseEnrollment::create([
                'user_id' => auth()->id(),
                'course_id' => $id,
                'price' => 0,
                'payment_status' => 'paid', 
                'enrolled_at' => now(),
            ]);

            return redirect()->route('frontend.my.courses')->with('success', 'Đăng ký khóa học thành công!');
        }

        return redirect()->back()->with('error', 'Khóa học này không miễn phí.');
    }

   

    public function store(Request $request) {
        $instructor = User::findOrFail($request->instructor_id);
        
    
        $courseRevenue = InstructorEarning::where('instructor_id', $instructor->id)
                            ->where('payment_status', 'pending')
                            ->sum('instructor_amount');

        $payroll = Payroll::create([
            'instructor_id'   => $instructor->id,
            'payroll_month'   => $request->month,
            'fixed_salary'    => $instructor->fixed_salary, 
            'support_fee'     => $request->support_fee,    
            'course_revenue'  => $courseRevenue,
            'total_amount'    => $courseRevenue + $instructor->fixed_salary + $request->support_fee,
            'status'          => 'draft'
        ]);

        return redirect()->route('admin.payroll.index')->with('success', 'Đã tạo bảng lương nháp!');
    }

    private function handleEnrollment($courseId, $originalPrice) {
    $exists = CourseEnrollment::where('user_id', auth()->id())
                ->where('course_id', $courseId)
                ->exists();

    if (!$exists) {
        CourseEnrollment::create([
            'user_id' => auth()->id(),
            'course_id' => $courseId,
            'price' => $originalPrice,
            'payment_status' => 'paid',
            'enrolled_at' => now(),
        ]);
    }
}
}
