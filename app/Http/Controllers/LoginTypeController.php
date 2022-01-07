<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\users;
use App\CampaignRecipient;
use Illuminate\Support\Facades\Hash;

class LoginTypeController extends Controller
{

    public function __construct()
    {
        $this->user = new users;
        $this->campaignRecipient = new CampaignRecipient;
    }
	
	public function generate() {
		echo Hash::make('tahurebus123!');
	}

    public function loginCredentialCheck(Request $request)
    {
        $admin = \App\User::where('email', $request->email)->orWhere('phone',$request->phone)->first();
        if($admin)
        {
            return [
                "code" => 100,
				"type" => 'admin',
                "desc" => "password required"
            ];
        }
        

        $customer = \App\CampaignRecipient::where('campaign_recipient_credential', $request->email)->first();
        if ($customer) {
            session(['customerId' => $customer->campaign_recipient_id]);
            return [
                "code" => 200,
				"type" => "customer",
                "desc" => "customer loggin success"
            ];
        } 
          
        
        return [
                "code" => 400,
                "desc" => "not found"
        ];
        

        
    }
}
