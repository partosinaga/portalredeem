<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use App\users;
use App\Industry;
use App\Regional;
use DB;
use DataTables;
use App\Campaign;
use Illuminate\Support\Str;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->client = new Client;
    }

    public function index()
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Client' => route('clients.index'),
            'List' => '#'
        ];
        return view('clients.index', compact('breadcrumb'));
    }

    public function clientDatatable()
    {
        $data = DB::table('md_client as c')
            ->select(
                'c.client_id',
                'c.client_title',
                'u.email',
                'u.phone',
                'i.industry_title'
            )
            ->Leftjoin('users as u', 'u.id', 'c.client_user_in_charge')
            ->leftJoin('md_industry as i', 'i.industry_id', 'c.client_industry')
            ->orderBy('c.client_id', 'DESC')
            ->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '<td class="dt-left dtr-control">'.
                    '<label class="checkbox checkbox-single">'.
                        '<input type="checkbox" value="'.$data->client_id.'" id="'.$data->client_id.'" class="checkable">'.
                        '<span></span>'.
                    '</label></td>';
            })
        ->make(true);
    }

    public function create()
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Client' => route('clients.index'),
            'List' => route('clients.index'),
            'Create' => '#'
        ];

        $header = [
            'assets/css/pages/wizard/wizard-3.css'
        ];
        $footer = [
            'assets/js/pages/custom/wizard/wizard-3.js',
            'assets/js/pages/crud/file-upload/image-input.js'
        ];

        $user = users::get();
        $industry = Industry::get();
        return view('clients.create', compact('header', 'footer', 'user', 'industry', 'breadcrumb'));
    }

    public function clientInfoStore(Request $request)
    {
        $client = new Client;
        $client->client_title = $request->company_name;
        $client->client_legal_title = $request->company_legal_name;
        $client->client_user_in_charge = $request->user_pic;
        $client->client_industry = $request->industry;
        $client->client_employee_size = $request->company_size;

        if($request->company_logo)
        {
            $file = $request->file('company_logo');
            $PATH = 'assets/images/clients';
            $newName = Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move($PATH, $newName);
            $client->client_image_logo = $newName;
        }
        
        $client->created_at = date('Y-m-d H:i:s');
        $client->updated_at = date('Y-m-d H:i:s');
        $client->created_by = \Auth::user()->email;
        $client->save();


        return redirect()->route('clients.billing', $client->client_id);
    }
    
    public function clientBilling($clientId, Request $request)
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Client' => route('clients.index'),
            'List' => route('clients.index'),
            'Create' => '#'
        ];
        $header = [
            'assets/css/pages/wizard/wizard-3.css'
        ];
        $footer = [
            'assets/js/pages/custom/wizard/wizard-3.js',
        ];
        $province = Regional::whereNull('parent_region_id')->get();
        $region = [];
        return view('clients.clients_billing', compact('header', 'footer', 'clientId', 'province', 'region', 'breadcrumb'));
    }
    
    public function clientBillingStore($clientId, Request $request)
    {
        $client = $this->client->where('client_id', $clientId)->first();
        if(!$client)
        {
            return redirect()->route('clients.index')->with(['message' => 'Client not found', 'type' => 'danger']);
        }
        $npwp = implode("-", $request->npwp);

        $client->client_tax_no = $npwp;
        $client->client_billing_address_line_1 = $request->address_1;
        $client->client_billing_address_line_2 = $request->address_2;
        $client->client_province = $request->province;
        $client->client_city = $request->city;
        $client->client_area = $request->area;
        $client->client_postal_code = $request->zip_code;
        $client->client_bank_title = $request->bank_name;
        $client->client_bank_branch = $request->branch;
        $client->client_bank_account_number = $request->account_number;
        $client->client_bank_account_name = $request->account_name;
        $client->save();

        return redirect()->route('clients.setting', $clientId);
    }

    public function clientSetting($clientId, Request $request)
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Client' => route('clients.index'),
            'List' => route('clients.index'),
            'Create' => '#'
        ];
        $header = [
            'assets/css/pages/wizard/wizard-3.css'
        ];
        $footer = [
            'assets/js/pages/custom/wizard/wizard-3.js',
        ];
        return view('clients.clients_setting', compact('header', 'footer', 'clientId', 'breadcrumb'));
    }

    public function clientSettingStore($clientId, Request $request)
    {
        $client = $this->client->where('client_id', $clientId)->first();
        if(!$client)
        {
            return redirect()->route('clients.index')->with(['message' => 'Client not found', 'type' => 'danger']);
        }

        $client->client_allow_postpaid = $request->is_allow_postpaid;
        $client->client_outstanding_limit = $request->outstanding_limit;
        $client->save();

        return redirect()->route('clients.index')->with(['message' => 'Success create new client', 'type' => 'success']);
    }

    public function getCity(Request $request)
    {
        return Regional::where('parent_region_id', $request->parentId)->get();
    }

    public function getArea(Request $request)
    {
        return Regional::where('parent_region_id', $request->parentId)->get();
    }

    public function clientEdit($clientId)
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Client' => route('clients.index'),
            'List' => route('clients.index'),
            'Edit' => '#'
        ];
        $client = $this->client->where('client_id', $clientId)->first();
        if(!$client)
        {
            return redirect()->route('clients.index')->with(['message' => 'Client not found', 'type' => 'danger']);
        }

        $header = [
            'assets/css/pages/wizard/wizard-3.css'
        ];
        $footer = [
            'assets/js/pages/custom/wizard/wizard-3.js',
            'assets/js/pages/crud/file-upload/image-input.js'
        ];

        $user = users::get();
        $industry = Industry::get();
        return view('clients.create', compact('header', 'footer', 'user', 'industry', 'clientId', 'client', 'breadcrumb'));
    }

    public function clientInfoUpdate($clientId, Request $request)
    {
        $client = $this->client->where('client_id', $clientId)->first();
        if(!$client)
        {
            return redirect()->route('clients.index')->with(['message' => 'Client not found', 'type' => 'danger']);
        }
        $client->client_title = $request->company_name;
        $client->client_legal_title = $request->company_legal_name;
        $client->client_user_in_charge = $request->user_pic;
        $client->client_industry = $request->industry;
        $client->client_employee_size = $request->company_size;

        if($request->company_logo)
        {
            $file = $request->file('company_logo');
            $PATH = 'assets/images/clients';
            $newName = Str::random(10).'.'.$file->getClientOriginalExtension();
            $file->move($PATH, $newName);
            $client->client_image_logo = $newName;
        }

        $client->updated_at = date('Y-m-d H:i:s');
        $client->created_by = \Auth::user()->email;
        $client->save();

        return redirect()->route('clients.billing.edit', $clientId);
    }

    public function clientBillingEdit($clientId, Request $request)
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Client' => route('clients.index'),
            'List' => route('clients.index'),
            'Edit' => '#'
        ];
        $client = $this->client->where('client_id', $clientId)->first();
        if(!$client)
        {
            return redirect()->route('clients.index')->with(['message' => 'Client not found', 'type' => 'danger']);
        }
        $header = [
            'assets/css/pages/wizard/wizard-3.css'
        ];
        $footer = [
            'assets/js/pages/custom/wizard/wizard-3.js',
        ];
        $province = Regional::whereNull('parent_region_id')->get();
        $region = Regional::whereNotNull('parent_region_id')->get();
        return view('clients.clients_billing', compact('header', 'footer', 'clientId', 'province', 'client', 'region', 'breadcrumb'));
    }

    public function clientBillingUpdate($clientId, Request $request)
    {
        $client = $this->client->where('client_id', $clientId)->first();
        if(!$client)
        {
            return redirect()->route('clients.index')->with(['message' => 'Client not found', 'type' => 'danger']);
        }
        $npwp = implode("-", $request->npwp);

        $client->client_tax_no = $npwp;
        $client->client_billing_address_line_1 = $request->address_1;
        $client->client_billing_address_line_2 = $request->address_2;
        $client->client_province = $request->province;
        $client->client_city = $request->city;
        $client->client_area = $request->area;
        $client->client_postal_code = $request->zip_code;
        $client->client_bank_title = $request->bank_name;
        $client->client_bank_branch = $request->branch;
        $client->client_bank_account_number = $request->account_number;
        $client->client_bank_account_name = $request->account_name;
        $client->save();

        return redirect()->route('clients.setting.edit', $clientId);
    }


    public function clientSettingEdit($clientId, Request $request)
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Client' => route('clients.index'),
            'List' => route('clients.index'),
            'Edit' => '#'
        ];
        $client = $this->client->where('client_id', $clientId)->first();
        if(!$client)
        {
            return redirect()->route('clients.index')->with(['message' => 'Client not found', 'type' => 'danger']);
        }
        $header = [
            'assets/css/pages/wizard/wizard-3.css'
        ];
        $footer = [
            'assets/js/pages/custom/wizard/wizard-3.js',
        ];
        return view('clients.clients_setting', compact('header', 'footer', 'clientId', 'client', 'breadcrumb'));
    }

    public function clientSettingUpdate($clientId, Request $request)
    {
        $client = $this->client->where('client_id', $clientId)->first();
        if(!$client)
        {
            return redirect()->route('clients.index')->with(['message' => 'Client not found', 'type' => 'danger']);
        }

        $client->client_allow_postpaid = $request->is_allow_postpaid;
        $client->client_outstanding_limit = $request->outstanding_limit;
        $client->save();

        return redirect()->route('clients.index')->with(['message' => 'Success update client', 'type' => 'success']);
    }

    public function clientDelete($clientId)
    {
        try {
            DB::beginTransaction();
            $isCampaignExist = Campaign::where('client_id', $clientId)->count();
            if($isCampaignExist > 0) //cek kalau client tsb udah punya campaign apa blm
            {
                return response()->json(400);
            }
            $this->client->where('client_id', $clientId)->delete();
            DB::commit();
            return response()->json(200);
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function clientDetail($clientId)
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Client' => route('clients.index'),
            'List' => route('clients.index'),
            'Detail' => '#'
        ];
        $client = DB::table('vw_client_details')->where('client_id', $clientId)->first();
        return view('clients.details', compact('client', 'breadcrumb'));
    }
	
	// check client bank account for deposit top up
	public function getBank(Request $request) {
		try {
			$id = $request->id;
			$data = Client::where('client_id',$id)->first();
			return [
				'bank_title' => $data->client_bank_title,
				'bank_branch' => $data->client_bank_branch,
				'account_number' => $data->client_bank_account_number,
				'account_name' => $data->client_bank_account_name
			];
		}
		catch(\Exception $e) {
			echo $e->getMessage();
		}
	}
}
