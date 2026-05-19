<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class ZaloPayRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    // public function handlePayment(array $data)
    // {
    //     $config = config('zalopay');
    //     $order_id = rand(0, 1000000); 
        
    //     $order = [
    //         "app_id" => $config['app_id'],
    //         "app_time" => round(microtime(true) * 1000), 
    //         "app_trans_id" => date("ymd") . "_" . $order_id,
    //         "app_user" => $data['email'],
    //         "item" => json_encode($data['course_id']), 
    //         "embed_data" => json_encode(['redirecturl' => route('success')]),
    //         "amount" => (int) $data['total_price'],
    //         "description" => "Thanh toan don hang #" . $order_id,
    //         "bank_code" => "zalopayapp", 
    //     ];

        
    //     $data_mac = $order['app_id'] . "|" . $order['app_trans_id'] . "|" . $order['app_user'] . "|" . $order['amount'] . "|" . $order['app_time'] . "|" . $order['embed_data'] . "|" . $order['item'];
    //     $order["mac"] = hash_hmac("sha256", $data_mac, $config['key1']);

        
    //     $response = Http::asForm()->post($config['endpoint'], $order);
    //     $result = $response->json();

    //     if (isset($result['return_code']) && $result['return_code'] == 1) {
           
    //         return redirect($result['order_url']);
    //     }

    //     return back()->withErrors(['msg' => 'ZaloPay Error: ' . $result['return_message']]);
    // }
}
