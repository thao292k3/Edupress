<?php


namespace App\Services;

use App\Repositories\StripeRepository;
use App\Repositories\ZaloPayRepository;


class PaymentService
{
    protected $stripeRepository;

    public function __construct(StripeRepository $stripeRepository)
    {
        $this->stripeRepository = $stripeRepository;
        

    }

    public function processPayment(array $data)
    {
        switch ($data['payment_type']) {
            // case 'zalopay':
            // return $this->zaloPayRepository->handlePayment($data);

            case 'stripe':
                return $this->stripeRepository->handlePayment($data);

            case 'paypal':
                return "paypal";

            case 'razorpay':
                return "razorpay";    

            default:
                throw new \Exception('Unsupported payment type');
        }
    }
}