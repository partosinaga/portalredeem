<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MdDeposit;
use App\TrxHistoryBalance;
use App\DepositTopupHistory;
use App\Client;
use App\Campaign;
use DataTables;
use DB;

class DepositController extends Controller
{
    
	public function index() {
		$breadcrumb = [
            'Home' => route('home'),
            'Balance' => '#',
            'Top Up Balance History' => '#'
        ];
		$records = MdDeposit::get();
		foreach($records as $r) {
			$r->client_name = Client::where('client_id',$r->client_id)->first()->client_title;
			$r->rupiah = number_format($r->deposit_amount,0,'.','.');
		}
		return view('balance.index',compact('records', 'breadcrumb'));
	}

	public function balanceDatatable(Request $request)
	{
		$data = DB::table('md_client_deposit as a')
			->join('md_client as b', 'a.client_id', 'b.client_id')
			->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '<td class="dt-left dtr-control">'.
                    '<label class="checkbox checkbox-single">'.
                        '<input type="checkbox" value="'.$data->deposit_id.'" id="'.$data->deposit_id.'" status="'.$data->deposit_status.'" class="checkable">'.
                        '<span></span>'.
                    '</label></td>';
            })

            ->addColumn('deposit_amount', function ($data) {
                return formatRupiah($data->deposit_amount);
            })
            ->addColumn('deposit_payment_date', function ($data) {
                return formatDateTime($data->deposit_payment_date);
            })
            ->make(true);
	}

	public function edit($id) {
		$breadcrumb = [
            'Home' => route('home'),
            'Balance' => '#',
            'Top Up Balance History' => route('balance.index'),
			'Edit' => '#'
        ];
		$d = MdDeposit::where('deposit_id',$id)->first();
		$clients = client::select('client_id','client_title')->orderBy('client_title','asc')->get();
		$title = 'Edit Balance';
		return view('balance.edit',compact('title','clients','d', 'breadcrumb'));
	}
	
	public function update(Request $request) {
		$id = $request->input('id');
		$res = MdDeposit::where('deposit_id',$id)->update([
			'client_id' => $request->input('client_id'),
			'deposit_payment_date' => date('Y-m-d H:i:s',strtotime($request->input('deposit_payment_date'))),
			'deposit_type' => $request->input('deposit_transaction_type'),
			'deposit_document_number' => $request->input('deposit_document_number'),
			'deposit_receipt_number' => $request->input('deposit_receipt_number'),
			'deposit_amount' => $request->input('deposit_amount'),
			'deposit_description' => $request->input('deposit_description'),
		]);
		return redirect()->route('balance.index');
	}
	
	public function detail(Request $request) {
		$id = $request->id;
		$data = MdDeposit::where('deposit_id',$id)->first();
		return $data;
	}
	
	public function history()
	{
		$breadcrumb = [
            'Home' => route('home'),
            'Balance' => '#',
            'Campaign Balance History' => '#'
        ];
		return view('balance.history',compact('breadcrumb'));
	}
	
	public function historyDatatable(Request $request)
	{
		$data = DB::table('trx_client_history_deposit as a')
			->join ('bsn_campaign as c', 'c.campaign_id', 'a.campaign_id')
			->get();
		return Datatables::of($data)
			->addIndexColumn()
			
			->addColumn('amount', function ($data) {
				return formatRupiah($data->amount);
			})
			->addColumn('created_at', function ($data) {
				return formatDateTime($data->created_at);
			})
			->make(true);
	}
	
	public function topup() {
		$clients = client::select('client_id','client_title')->orderBy('client_title','asc')->get();
		$title = 'Top Up Balance';
		return view('balance.topup',compact('title','clients'));
	}
	
	public function topupProcess(Request $request) {
		$deposit = new MdDeposit;
		$deposit->client_id = $request->input('client_id');
		$deposit->deposit_payment_date = date('Y-m-d H:i:s',strtotime($request->input('deposit_payment_date')));
		$deposit->deposit_type = $request->input('deposit_transaction_type');
		$deposit->deposit_document_number = $request->input('deposit_document_number');
		$deposit->deposit_receipt_number = $request->input('deposit_receipt_number');
		$deposit->deposit_amount = $request->input('deposit_amount');
		$deposit->deposit_description = $request->input('deposit_description');
		$deposit->deposit_status = 'WAITING VERIFICATION';
		$deposit->save();
		$trx_id = $deposit->id;
		
		return redirect()->route('balance.index');
	}
	
	public function approval($id) {
		 $res = MdDeposit::where('deposit_id',$id)
		 ->update([
			'deposit_status' => 'APPROVED'
		 ]);
		 if($res) {
			 $message = '';
		 }
		 else {
			 $message = '';
		 }
		return redirect()->route('balance.index');
	}
	
	public function reject($id) {
		 $res = MdDeposit::where('deposit_id',$id)
		 ->update([
			'deposit_status' => 'REJECT'
		 ]);
		 if($res) {
			 $message = '';
		 }
		 else {
			 $message = '';
		 }
		return redirect()->route('balance.index');
	}
	
	public function remove($id) {
		 $res = MdDeposit::where('deposit_id',$id)
		 ->delete();
		 if($res) {
			 $message = '';
		 }
		 else {
			 $message = '';
		 }
		return redirect()->route('balance.index');
	}
	
	public function search(Request $request) {
		$id = $request->input('query');
		$records = MdDeposit::where('deposit_payment_date','LIKE',"%$id%")
		->orWhere('deposit_receipt_number','LIKE',"%$id%")
		->orWhere('deposit_amount','LIKE',"%$id%")
		->orWhere('deposit_description','LIKE',"%$id%")
		->orWhere('deposit_status','LIKE',"%$id%")
		->orWhere('deposit_type','LIKE',"%$id%")
		 ->get();
		foreach($records as $r) {
			$r->client_name = Client::where('client_id',$r->client_id)->first()->client_title;
			$r->rupiah = number_format($r->deposit_amount,0,'.','.');
		}
		return view('balance.index',compact('records'));
	}
}
