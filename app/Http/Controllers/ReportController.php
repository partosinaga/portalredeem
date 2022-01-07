<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class ReportController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Report' => route('reports.index'),
            'List' => '#'
        ];
        return view('reports.list', compact('breadcrumb'));
    }

    public function reportListDatatable(Request $request)
    {
        $data = DB::table('vw_campaign_list')->orderBy('campaign_id', 'DESC')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '<td class="dt-left dtr-control">'.
                    '<label class="checkbox checkbox-single">'.
                        '<input type="checkbox" value="'.$data->campaign_id.'" id="'.$data->campaign_id.'" class="checkable">'.
                        '<span></span>'.
                    '</label></td>';
            })
            ->addColumn('period_start', function ($data) {
                return formatDateTime($data->campaign_start_date);
            })
            ->addColumn('period_end', function ($data) {
                return formatDateTime($data->campaign_end_date);
            })
            ->make(true);
    }

    public function reportDetail($campaignId)
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Report' => route('reports.index'),
            'List' => route('reports.index'),
            'Generated Voucher' => '#'
        ];

        $voucher = DB::table('bsn_campaign_vouchers')
            ->select('campaign_voucher_id', 'voucher_catalog_title')
            ->where('campaign_id', $campaignId)
            ->get();
        return view('reports.details', compact('campaignId', 'voucher', 'breadcrumb'));
    }

    public function reportDetailDatatable($campaignId, Request $request)
    {
        $data = DB::table('vw_campaign_detail_report');
        $data->where('campaign_id', $campaignId);
        $voucherStatus = $request->voucherStatus;
        if($voucherStatus!='' && $voucherStatus != 'ALL'){
            $data->where('voucher_status', '=', "$voucherStatus");
        }

        $voucherTitle = $request->voucher;
        if($voucherTitle !='' && $voucherTitle != 'ALL'){
            $data->where('campaign_voucher_id', '=', $voucherTitle);
        }

        $data->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('redeem_date', function ($data) {
                return formatDateTime($data->redeem_date);
            })
            ->addColumn('generated_date', function ($data) {
                return formatDateTime($data->generated_date);
            })
            ->addColumn('voucher_price', function ($data) {
                return formatRupiah($data->voucher_price);
            })
            ->make(true);
    }
}
