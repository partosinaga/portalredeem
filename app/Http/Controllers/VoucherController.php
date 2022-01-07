<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\TrxHistoryBalance;
use App\TrxGiftVouchers;

class VoucherController extends Controller
{
	
    public function __construct()
    {
		$this->endpoint = env('PRZ_API_END').'api/internal/voucher-catalog';
		$this->headerkey = env('PRZ_API_KEY');
		$this->sdz_endp = env('SANDEZA_API_ENPOINT');
		$this->sdz_user = env('SANDEZA_API_USERNAME');
		$this->sdz_pss = env('SANDEZA_API_PASSWORD');
		$this->sdz_snd = env('SANDEZA_API_SENDER_ID');
		$this->sdz_tpl = env('SAMDEZA_API_TEMPLATE_ID');
    }
	
	public function index() {		
		$_vouchers = Http::withHeaders([
			'api-key' => $this->headerkey
		])->post($this->endpoint);
		$vouchers = json_decode($_vouchers);
		return view('voucher.index',$vouchers);
	}
	 
	public function sendGift(Request $request) {
		// $_voucher = Http::withHeaders([
		// 	'api-key' => $this->headerkey
		// ])->get(env('PRZ_API_END').'api/internal/voucher-detail/'.$request->input("id").'',['voucher_id'=>$request->input("id")])->json();
		// return view('voucher.send_idx',compact('_voucher'));

		$voucher = Http::withHeaders([
			'api-key' => $this->headerkey
		])->get(env('PRZ_API_END').'api/internal/voucher-detail/'.$request->input("voucher_id").'',['voucher_id'=>$request->input("voucher_id")])->json();
		
		$voucher = $voucher['data'];
		return view('voucher.voucher_send', compact('voucher'));
	}
	
	public function sendGiftProcess(Request $request) {
		return redirect()->route('voucher.send.result');
	}
	
	private function sendSMS() {
		
	}
	
	public function sendGiftResult() {
		return view('voucher.send_result');
	}
	
	private function updateBalance($campaignId,$senderId,$amount,$trx_type) {
		$trx = new TrxHistoryBalance;
		$trx->campaign_id = $campaignId;
		$trx->amount = $amount;
		$trx->cretated_by = $senderId;
		$trx->save();
	}
}
