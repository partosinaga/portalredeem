<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class Dashboard extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->endpoint = env('PRZ_API_END') . 'api/internal/voucher-catalog';
    $this->headerkey = base64_encode('https://staging.prezent.id#' . date('Ymd'));
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {

    $category = DB::table('md_voucher_category')->get();
    return view('home', compact('category'));
  }

  public function getPrezentVoucher(Request $request)
  {
    $page = $request->page != '' ? "?page=" . $request->page : '';
    $getVoucher = \Http::withHeaders([
      'api-key' => $this->headerkey
    ])->post($this->endpoint . $page, [])->json();
    $vouchers = $getVoucher['data']['data'];
    $navigation = [
      'next' => substr($getVoucher['data']['next_page_url'], -1),
      'previous' => substr($getVoucher['data']['prev_page_url'], -1),
      'totalPage' => $getVoucher['data']['last_page'],
    ];
    return [
      "vouchers" => $vouchers,
      "nav" => $navigation,
    ];
  }

  public function getPrezentVoucherDetail(Request $request)
  {
    $_voucher = \Http::withHeaders([
      'api-key' => $this->headerkey
    ])->get(env('PRZ_API_END') . 'api/internal/voucher-detail/' . $request->input("id") . '', ['voucher_id' => $request->input("id")])->json();
    return $_voucher;
  }

  public function getPrezentVoucherFiltered(Request $request)
  {

    $getVoucher = \Http::withHeaders([
      'api-key' => $this->headerkey
    ])->post($this->endpoint, [
      'voucher_catalog_category_pid' => $request->category,
      'voucher_catalog_tags' => $request->tag,
      'voucher_value' => $request->value
    ])->json();
    
    $vouchers = $getVoucher['data']['data'];
    $navigation = [
      'next' => substr($getVoucher['data']['next_page_url'], -1),
      'previous' => substr($getVoucher['data']['prev_page_url'], -1),
      'totalPage' => $getVoucher['data']['last_page'],
    ];
    
    return [
      "vouchers" => $vouchers,
      "nav" => $navigation,
    ];

  }

}
