<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class Payment
{
	protected $base_url = "https://api.flutterwave.com/v3";

	protected $secret_key;
	
	protected $http;
	
	public function __construct()
	{
        // dd(app()->environment('production') ? config("settings.flutter.secret_key_live") : config("settings.flutter.secret_key_test"));
		$this->secret_key =  app()->environment('production') ? config("settings.flutter.secret_key_live") : config("settings.flutter.secret_key_test");
		$this->http = Http::withHeaders([
            'Authorization' => "Bearer " . $this->secret_key,
            'Content-Type' => "application/json"
        ]);
	}

    public function pay($data)
    { 

        //     $data = [
        //     'tx_ref' => '123467',//system generatted ref
        //     'amount' => '100',
        //     'email' => 'olangdan17@gmail.com' ?: 'transaction@lifecare.com',
        //     'currency' => "NGN",
        //     'redirect_url' => route('validatetest'),
        //     'payment_options' =>  ["card", "banktransfer", "ussd", "account"],
        //     'customization' => [
        //         'descriptions' => 'Life Care Service Charge',
        //         "title" => "Life Care",
        //     ],
        //     'customer' => [
        //         'email' => 'olangdan17@gmail.com' ?: 'transaction@lifecare.com',
        //         'name' =>  'Life Care' ?: null
        //     ],
        //     'meta' => [
        //             'description' => "paymnet Descriptiono", 
        //             'client_id' => 'payer ID', 
        //             'date' => "payment date",
        //             'title' => "payment title", 
        //             'amount'=> "amoount"
        //             ], 
        // ];

        $response = $this->http->post("{$this->base_url}/payments", $data);

        $link = $response["data"]["link"];
        return $link;
    }
   
    public function verifyPayment($reference)
    {
        $response = $this->http->get("{$this->base_url}/transactions/{$reference}/verify");
	    
	    if($response["status"] == "error")
	    {
	        return response()->json(['status' => 400, 'title' => 'Oops', 'message' => $response["message"]]);
	    }
	    
	    return $response;
        
    }
    
}
