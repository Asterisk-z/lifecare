<?php

namespace App\Repositories;

use App\Interfaces\PaymentRepositoryInterface;
use Illuminate\Support\Facades\Http;

class FlutterRepository implements PaymentRepositoryInterface
{
	protected $base_url = "https://api.flutterwave.com/v3";

	protected $secret_key;
	
	protected $http;
	
	public function __construct()
	{
        dd(app()->environment('production') ? config("settings.flutter.secret_key_live") : config("settings.flutter.secret_key_test"));
		$this->secret_key =  app()->environment('production') ? config("settings.flutter.secret_key_live") : config("settings.flutter.secret_key_test");
		$this->http = Http::withHeaders([
            'Authorization' => "Bearer " . $this->secret_key,
            'Content-Type' => "application/json"
        ]);
	}
	
	protected static function computeTransactionFee($amount)
    {
        $amount = intval(str_ireplace(',', '', $amount));
        $charge = ($amount * (2 / 100));
        return  $charge > 2500 ? 2500 : $charge;
    }

	
	public function showBanks($country="NG")
	{
	    $response = $this->http->get("{$this->base_url}/banks/{$country}");
        
        return json_decode($response->body());
	}

	public function transfer($data)
	{
		$response = $this->http->post("{$this->base_url}/transfers", $data);
        
        return json_decode($response->body());
	}
	
	public function pay($data)
	{
        $data = [
            'tx_ref' => $data['reference'],
            'amount' => ($data['amount'] + self::computeTransactionFee($data['amount'])),
            'email' => $data['email'] ?: 'transaction@lifecare.com',
            'currency' => "NGN",
            'redirect_url' => $data['callback'],
            'payment_options' => $data['payment_options'],
            'customization' => [
                'descriptions' => 'Life Care Service Charge',
                "title" => "Life Care",
            ],
            'customer' => [
                'email' => $data['email'] ?: 'transaction@lifecare.com',
                'name' =>  'Life Care' ?: null
            ],
            'meta' => $data['metadata'],
        ];

        $response = $this->http->post("{$this->base_url}/payments", $data);

        $link = $response["data"]["link"];
        dd($link);
        
       return response()->json(['status' => 200, 'icon' => 'success', 'title' => 'successful', 'message' => $link]);
	}
	
	public function verifyPayment ($id)
	{
	    $response = $this->http->get("{$this->base_url}/transactions/{$id}/verify");
	    
	    if($response["status"] == "error")
	    {
	        return response()->json(['status' => 400, 'title' => 'Oops', 'message' => $response["message"]]);
	    }
	    
	    return $response;
	}



    public function verifyAccount($data) {
        $response = $this->http->post("{$this->base_url}/accounts/resolve", $data);
        $response = json_decode($response->body());
        if($response->status == "success") {
            return ["status" => $response->status,"user" => $response->data, "message" => $response->message];
        }

        return [
            'message' => $response->message,
            "status" => $response->status,
        ];
    }
}
?>
