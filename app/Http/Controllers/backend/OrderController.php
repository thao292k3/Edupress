<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
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

    private function createOrder($paymentId){

         
         $stripeData = session('stripe_data'); 
        
         foreach ($stripeData['course_id'] as $index => $courseId) {
             Order::create([
                 'payment_id' => $paymentId, 
                 'user_id' => auth()->user()->id, 
                 'course_id' => $courseId,
                 'instructor_id' => $stripeData['instructor_id'][$index], 
                 'course_title' => $stripeData['course_name'][$index],
                 'price' => $stripeData['course_price'][$index],
             ]);
         }

    }
}
