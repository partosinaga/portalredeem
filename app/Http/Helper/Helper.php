<?php
function formatRupiah($moneyInput)
{
    $moneyOutput = number_format($moneyInput);
    return 'Rp'. $moneyOutput;
}

function formatDateTime($date)
{
    $newDate = date('d M Y H:i:s', strtotime($date));
    return $newDate;
}

function datetimePickerFormat($date)
{
    $newDate = date('m/d/Y h:i:s A', strtotime($date));
    return $newDate;
}

function sendEmailViaSandezaPrimaryBackup($email, $phoneNumber, $password, $subject = '[Prezent - Portal Redeem] Account Activation')
{
    
    $datetime = date('YmdHis');
    $request = [
        "type" => 1,
        "username" => env('SANDEZA_API_USERNAME'),
        "ref_id" => "prtlrdm".$datetime.rand(9999999999, 1000000000),
        "time" => $datetime,
        "signature" => hash('sha256', env('SANDEZA_API_USERNAME').env('SANDEZA_API_PASSWORD').$datetime),
        "subject" => $subject,
        "sender_id" => ENV('SANDEZA_API_SENDER_ID'),
        "channel" => [
            "email" => [
                "email"=> $email,
                "message"=> "email:$email;password:$password",
                "attachment"=>"",
                "template_id"=> env('SAMDEZA_API_TEMPLATE_ID'),
                "tipe"=> "template",
                "backup_on"=> "1",
                "backup_exp"=> "0"
            ],
            "sms"=>[
                "msisdn"=>$phoneNumber,
                "message"=>"[SECRET] - This is your password: ".$password.", go to ".env('APP_URL'). " for login." ,
                "backup_on"=>"",
                "backup_exp"=>""
            ]
        ]
    ];
    \Log::channel('user_activation')->info('========================================================================================');
    \Log::channel('user_activation')->info('EMAIL - REQUEST ['.$email.'] - BODY REQUEST: '. json_encode($request));
    
    $client = new \GuzzleHttp\Client();
    $response = $client->post(env('SANDEZA_API_ENPOINT'), [
        \GuzzleHttp\RequestOptions::JSON => $request
    ]);
    
    $response = $response->getBody()->getContents();
    \Log::channel('user_activation')->info('EMAIL - RESPONSE ['.$email.'] - BODY RESPONSE: '. json_encode($response));
    \Log::channel('user_activation')->info('========================================================================================');
    return $response;
}

function sendEmailViaSandeza($email, $password, $subject = '[Prezent - Portal Redeem] Notification')
{
    
    $datetime = date('YmdHis');
    $request = [
        "type" => 2,
        "username" => env('SANDEZA_API_USERNAME'),
        "ref_id" => "prtlrdm".$datetime.rand(9999999999, 1000000000),
        "time" => $datetime,
        "signature" => hash('sha256', env('SANDEZA_API_USERNAME').env('SANDEZA_API_PASSWORD').$datetime),
        "subject" => $subject,
        "sender_id" => ENV('SANDEZA_API_SENDER_ID'),
        "channel" => [
            "email" => [
                "email"=> $email,
                "message"=> "email:$email;password:$password",
                "attachment"=>"",
                "template_id"=> env('SAMDEZA_API_TEMPLATE_ID'),
                "tipe"=> "template",
                "backup_on"=> "1",
                "backup_exp"=> "0"
            ]
        ]
    ];
    \Log::channel('user_activation')->info('========================================================================================');
    \Log::channel('user_activation')->info('EMAIL - REQUEST ['.$email.'] - BODY REQUEST: '. json_encode($request));
    
    $client = new \GuzzleHttp\Client();
    $response = $client->post(env('SANDEZA_API_ENPOINT'), [
        \GuzzleHttp\RequestOptions::JSON => $request
    ]);
    
    $response = $response->getBody()->getContents();
    \Log::channel('user_activation')->info('EMAIL - RESPONSE ['.$email.'] - BODY RESPONSE: '. json_encode($response));
    \Log::channel('user_activation')->info('========================================================================================');
    return $response;
}

function isAllowed($menu, $action)
{
    $isAllowed = DB::table('vw_roles_grant_menu')
        ->where('roles_id', \Auth::user()->roles_id)
        ->where('menu_title', $menu)
        ->where('menu_action_title', $action)->first();
    if($isAllowed)
    {
        return true;
    }
    return false;
}

function getCustomerLoggedIn($campaignRecipientId)
{
    return \App\CampaignRecipient::where('campaign_recipient_id', $campaignRecipientId)->first();
}