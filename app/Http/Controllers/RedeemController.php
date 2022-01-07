<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RedeemController extends Controller
{
	public function index()
    {
		
		return view('redeem.index');
    }
	
	public function process($voucherNumber) {
		try {
			return view('redeem.result_progress');
		}catch(\Exception $e) {
			\Log::info($e->getMessage());
            return $err;
        }
	}
	
	private function addRecord($trxdata) {
		
	}
	
	private function balanceUpdate() {
		
	}
	
	public function redemResult() {
		
	}
}
