<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use App\TrxHistoryBalance;
use App\TrxGiftVouchers;
use DB;
use App\CartCustomer;
use App\Campaign;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->endpoint = env('PRZ_API_END').'api/internal/voucher-catalog';
		$this->headerkey = base64_encode('https://staging.prezent.id#'.date('Ymd'));
		$this->sdz_endp = env('SANDEZA_API_ENPOINT');
		$this->sdz_user = env('SANDEZA_API_USERNAME');
		$this->sdz_pss = env('SANDEZA_API_PASSWORD');
		$this->sdz_snd = env('SANDEZA_API_SENDER_ID');
		$this->sdz_tpl = env('SAMDEZA_API_TEMPLATE_ID');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
		if (!\Session::exists('customerId')) {
			return redirect()->route('login');
		}

		$cust = getCustomerLoggedIn(\Session::get('customerId'));
		$category = DB::table('md_voucher_category')->get();
        return view('customers.index',compact('category', 'cust'));
    }
	
	public function voucherDetail(Request $request) {
		$_voucher = Http::withHeaders([
			'api-key' => $this->headerkey
		])->get(env('PRZ_API_END').'api/internal/voucher-detail/'.$request->input("id").'',['voucher_id'=>$request->input("id")])->json();
		return $_voucher;
	}

	public function addToCart(Request $request)
	{
		$qty = 1;
		$isExist = CartCustomer::where('voucher_catalog_id', $request->id)->where('campaign_recipient_id', \Session::get('customerId'))->first();
		if($isExist)
		{
			$qty = $isExist->qty + 1;
			$isExist->qty = $qty;
			$isExist->save();
			return $isExist;
		}

		$cust = getCustomerLoggedIn(\Session::get('customerId'));
		$campaignEndDate = Campaign::where('campaign_id', $cust->campaign_id)->first();
		$campaignEndDate = $campaignEndDate->campaign_end_date;
		$cart = new CartCustomer();
		$cart->campaign_recipient_id = \Session::get('customerId');
		$cart->voucher_catalog_id =  $request->id;
		$cart->voucher_catalog_title = $request->title;
		$cart->voucher_catalog_main_image_url = $request->imageUrl;
		$cart->voucher_catalog_value_amount = $request->amount;
		$cart->qty = $qty;
		$cart->valid_end_date = $campaignEndDate;
		$cart->created_at = date('Y-m-d H:i:s');
		$cart->updated_at = date('Y-m-d H:i:s');
		$cart->save();

		return $cart;
	}

	public function getCartItem($id)
	{
		$data = CartCustomer::where('campaign_recipient_id', $id)->get();
		return $data;
	}

	public function cart($id)
	{
		if (!\Session::exists('customerId')) {
			return redirect()->route('login');
		}
		$cust = getCustomerLoggedIn(\Session::get('customerId'));

		$cart = CartCustomer::where('campaign_recipient_id', \Session::get('customerId'))->get();

		return view('customers.cart', compact('cust', 'cart'));
	}

	public function cartRemoveItem($id)
	{
		$cart = CartCustomer::where('cart_id', $id)->delete();
		return $cart;
	}
}
