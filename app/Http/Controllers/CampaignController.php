<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\CampaignRecipient;
use App\Campaign;
use DB;
use DataTables;
use App\ClientHistoryDeposit;
use App\CampaignReject;

class CampaignController extends Controller
{
    
    public function __construct()
    {
        $this->client = new Client;
        $this->campaign = new Campaign;
        $this->campaignRecipient = new CampaignRecipient;
        $this->clientHistoryBalance = new ClientHistoryDeposit;
    }

    public function index()
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Campaign' => route('campaign.index'),
            'List' => '#'
        ];
        return view('campaigns.list', compact('breadcrumb'));
    }

    public function campaignDatatable(Request $request)
    {
        $data = DB::table('bsn_campaign as b')
            ->join('md_client as c', 'c.client_id', 'b.client_id')
            ->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '<td class="dt-left dtr-control">'.
                    '<label class="checkbox checkbox-single">'.
                        '<input type="checkbox" value="'.$data->campaign_id.'" id="'.$data->campaign_id.'" status="'.$data->campaign_status.'" class="checkable">'.
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

    public function create()
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Campaign' => route('campaign.index'),
            'List' => route('campaign.index'),
            'Create' => '#'
        ];
        $header = [
            'assets/css/pages/wizard/wizard-3.css'
        ];
        $footer = [
            'assets/js/pages/custom/wizard/wizard-3.js',
        ];
        $client = $this->client->select('client_id', 'client_title')->get();
        return view('campaigns.create', compact('header', 'footer', 'client', 'breadcrumb'));
    }

    public function campaignProfileStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $campaign = new Campaign;
            $campaign->campaign_title = $request->campaign_title;
            $campaign->client_id = $request->client_id;
            $campaign->campaign_start_date = date('Y-m-d H:i:s', strtotime($request->campaign_validity_start));
            $campaign->campaign_end_date = date('Y-m-d H:i:s', strtotime($request->campaign_validity_end));
            $campaign->campaign_status = 'DRAFT';
            $campaign->created_at = date('Y-m-d H:i:s');
            $campaign->updated_at = date('Y-m-d H:i:s');
            $campaign->created_by = \Auth::user()->email;
            $campaign->save();

            $recipient = $request->recipient_list;
            $recipient = str_replace("\r", '', $recipient); // remove enter
            $recipient = explode("\n", $recipient); // break into array
            foreach ($recipient as $val) {
                $explode = explode('#', $val);

                $campaignRecipient = new CampaignRecipient;
                $campaignRecipient->campaign_id = $campaign->campaign_id;
                $campaignRecipient->campaign_recipient_name = $explode[0];
                $campaignRecipient->campaign_recipient_credential = $explode[1];
                $campaignRecipient->campaign_recipient_balance = (int)$explode[2];
                $campaignRecipient->campaign_recipient_current_balance = (int)$explode[2];
                $campaignRecipient->created_at = date('Y-m-d H:i:s');
                $campaignRecipient->updated_at = date('Y-m-d H:i:s');
                $campaignRecipient->created_by = \Auth::user()->email;
                $campaignRecipient->save();
            }
            DB::commit();
            return redirect()->route('campaign.message.voucher', $campaign->campaign_id);

        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function campaignMessageVoucher($id)
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Campaign' => route('campaign.index'),
            'List' => route('campaign.index'),
            'Create' => '#'
        ];
        $header = ['assets/css/pages/wizard/wizard-3.css'];
        $campaign = $this->campaign->where('campaign_id', $id)->first();
        if(!$campaign || $campaign->campaign_status != 'DRAFT')
        {
            return redirect()->route('campaign.index')->with(['message' => 'Campaign not found', 'type' => 'danger']);
        }
        $campaignId = $id;
        return view('campaigns.campaign_voucher_message', compact('header', 'campaignId', 'breadcrumb'));
    }
    
    public function campaignMessageVoucherStore($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $campaign = $this->campaign->where('campaign_id', $id)->first();
            $campaign->campaign_message_title = $request->message_title;
            $campaign->campaign_message = $request->message;
            $campaign->campaign_bg_color = $request->bg_color;
            $campaign->campaign_font_color = $request->font_color;
            $campaign->save();
            DB::commit();

            return redirect()->route('campaign.checkout', $campaign->campaign_id);

        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function campaignCheckout($id)
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Campaign' => route('campaign.index'),
            'List' => route('campaign.index'),
            'Create' => '#'
        ];
        $campaign = $this->campaign->where('campaign_id', $id)->first();
        if(!$campaign || $campaign->campaign_status != 'DRAFT')
        {
            return redirect()->route('campaign.index')->with(['message' => 'Campaign not found or invalid campaign status detected', 'type' => 'danger']);
        }

        $header = ['assets/css/pages/wizard/wizard-3.css'];
        $client = $this->client->where('client_id', $campaign->client_id)->first();
        $recipient = $this->campaignRecipient->where('campaign_id', $id)->get();
        

        return view('campaigns.campaign_checkout', compact('header', 'campaign', 'client', 'recipient', 'breadcrumb'));
    }

    public function campaignCheckoutStore($id)
    {
        $campaign = $this->campaign->where('campaign_id', $id)->first();
        if(!$campaign || $campaign->campaign_status != 'DRAFT')
        {
            return redirect()->route('campaign.index')->with(['message' => 'Campaign not found', 'type' => 'danger']);
        }
        $campaign->campaign_status = 'WAITING VERIFICATION';
        $campaign->save();
        return redirect()->route('campaign.index')->with(['message' => 'Success create campaign, waiting for approval', 'type' => 'success']);;
    }

    public function campaignEdit($campaignId)
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Campaign' => route('campaign.index'),
            'List' => route('campaign.index'),
            'Edit' => '#'
        ];
        $campaign = $this->campaign->where('campaign_id', $campaignId)->first();
        if(!$campaign || $campaign->campaign_status != 'DRAFT')
        {
            return redirect()->route('campaign.index')->with(['message' => 'Only DRAFT campaign can be edited', 'type' => 'danger']);
        }
        $header = ['assets/css/pages/wizard/wizard-3.css'];
        $client = $this->client->select('client_id', 'client_title')->get();
        $recipient = $this->campaignRecipient
            ->select('campaign_recipient_name', 'campaign_recipient_credential', 'campaign_recipient_balance')
            ->where('campaign_id', $campaignId)->get();
        $strRecipient= '';
        foreach ($recipient as $val) {
            $strRecipient .= $val->campaign_recipient_name.'#'.$val->campaign_recipient_credential.'#'.$val->campaign_recipient_balance."\r\n";
        }
        return view('campaigns.create', compact('header', 'client', 'campaignId', 'campaign', 'strRecipient', 'breadcrumb')); 
    }

    public function campaignEditStore($campaignId, Request $request)
    {
        try {
            DB::beginTransaction();

            $campaign = $this->campaign->where('campaign_id', $campaignId)->first();
            if(!$campaign || $campaign->campaign_status != 'DRAFT')
            {
                return redirect()->route('campaign.index')->with(['message' => 'Campaign not found or invalid campaign status detected', 'type' => 'danger']);
            }
            $campaign->campaign_title = $request->campaign_title;
            $campaign->client_id = $request->client_id;
            $campaign->campaign_start_date = date('Y-m-d H:i:s', strtotime($request->campaign_validity_start));
            $campaign->campaign_end_date = date('Y-m-d H:i:s', strtotime($request->campaign_validity_end));
            $campaign->updated_at = date('Y-m-d H:i:s');
            $campaign->created_by = \Auth::user()->email;
            $campaign->save();

            // delete all existing recipient and re insert new one
            $campaignRecipient = $this->campaignRecipient->where('campaign_id', $campaignId)->delete();

            $recipient = $request->recipient_list;
            $recipient = str_replace("\r", '', $recipient); // remove enter
            $recipient = explode("\n", $recipient); // break into array
            foreach ($recipient as $val) {
                $explode = explode('#', $val);

                $campaignRecipient = new CampaignRecipient;
                $campaignRecipient->campaign_id = $campaignId;
                $campaignRecipient->campaign_recipient_name = $explode[0];
                $campaignRecipient->campaign_recipient_credential = $explode[1];
                $campaignRecipient->campaign_recipient_balance = (int)$explode[2];
                $campaignRecipient->created_at = $campaign->created_at;
                $campaignRecipient->updated_at = date('Y-m-d H:i:s');
                $campaignRecipient->created_by = \Auth::user()->email;
                $campaignRecipient->save();
            }
            DB::commit();
            return redirect()->route('campaign.edit.message.voucher', $campaign->campaign_id);

        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function campaignEditMessageVoucher($campaignId)
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Campaign' => route('campaign.index'),
            'List' => route('campaign.index'),
            'Edit' => '#'
        ];
        $campaign = $this->campaign->where('campaign_id', $campaignId)->first();
        if(!$campaign || $campaign->campaign_status != 'DRAFT')
        {
            return redirect()->route('campaign.index')->with(['message' => 'Campaign not found or invalid campaign status detected', 'type' => 'danger']);
        }
        $header = ['assets/css/pages/wizard/wizard-3.css'];


        return view('campaigns.campaign_voucher_message', compact('header', 'campaignId', 'campaign', 'breadcrumb'));
    }

    public function campaignEditStoreMessageVoucher($campaignId, Request $request)
    {
        try {
            DB::beginTransaction();
            $campaign = $this->campaign->where('campaign_id', $campaignId)->first();
            if(!$campaign || $campaign->campaign_status != 'DRAFT')
            {
                return redirect()->route('campaign.index')->with(['message' => 'Campaign not found or invalid campaign status detected', 'type' => 'danger']);
            }

            $campaign->campaign_message_title = $request->message_title;
            $campaign->campaign_message = $request->message;
            $campaign->campaign_bg_color = $request->bg_color;
            $campaign->campaign_font_color = $request->font_color;
            $campaign->updated_at = date('Y-m-d H:i:s');
            $campaign->save();
            DB::commit();

            return redirect()->route('campaign.checkout', $campaign->campaign_id);

        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function campaignDetail($campaignId)
    {
        $breadcrumb = [
            'Home' => route('home'),
            'Campaign' => route('campaign.index'),
            'List' => route('campaign.index'),
            'Detail' => '#'
        ];

        $header = ['assets/css/pages/wizard/wizard-3.css'];
        $campaign = DB::table('bsn_campaign as b')
            ->join('md_client as m', 'm.client_id', 'b.client_id')
            ->where('b.campaign_id', $campaignId)
            ->first();

        $reason = '';
        if ($campaign->campaign_status == 'REJECTED') {
            $reason = CampaignReject::where('campaign_id', $campaignId)->select('campaign_reject_reason', 'created_at')->first();
        }

        $client = $this->client->where('client_id', $campaign->client_id)->first();
        $recipientTotal = $this->campaignRecipient->where('campaign_id', $campaignId)->count();
        
        return view('campaigns.campaign_detail', compact('header', 'campaign', 'client', 'recipientTotal', 'breadcrumb', 'reason'));
    }

    public function campaignRecipientDatatable(Request $request)
    {
        $recipient = DB::table('vw_customer_balance_report_summary')->where('campaign_id', $request->campaignId)->orderBy('campaign_recipient_id', 'ASC')->get();
        return Datatables::of($recipient)
            ->addIndexColumn()
            ->addColumn('starting_reward', function($recipient){
                return formatRupiah($recipient->starting_reward);
            })
            ->addColumn('remaining_reward', function($recipient){
                return formatRupiah($recipient->remaining_reward);
            })
            ->addColumn('actual_usage', function($recipient){
                return formatRupiah($recipient->actual_usage);
            })
            ->make(true);
    }

    public function campaignDelete($campaignId)
    {
        try {
            DB::beginTransaction();
            $campaign = $this->campaign->where('campaign_id', $campaignId)->delete();
            if($campaign)
            {
                $recipient = $this->campaignRecipient->where('campaign_id', $campaignId)->delete();
            }
            DB::commit();
            return response()->json(200);
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function campaignApprove($campaignId)
    {
        try {
            DB::beginTransaction();
            $campaign = $this->campaign->where('campaign_id', $campaignId)->first();
            if(!$campaign || $campaign->campaign_status != 'WAITING VERIFICATION')
            {
                return redirect()->route('campaign.index')->with(['message' => 'Campaign not found or already approved before', 'type' => 'danger']);
            }

            $campaign->campaign_status = 'RELEASED';
            $campaign->save();


            // get total amount campaign
            $totalAmount = $this->campaignRecipient->where('campaign_id', $campaignId)->sum('campaign_recipient_balance');
            // insert into trx_client_history_deposit
            $deposit = new ClientHistoryDeposit;
            $deposit->campaign_id = $campaignId;
            $deposit->amount = $totalAmount;
            $deposit->created_at = date('Y-m-d H:i:s');
            $deposit->updated_at = date('Y-m-d H:i:s');
            $deposit->created_by = \Auth::user()->email;
            $deposit->save();

            DB::commit();
            return response()->json(200);
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function campaignReject(Request $request)
    {
        try {
            DB::beginTransaction();
                $reject = new CampaignReject;
                $reject->campaign_reject_reason = $request->reject_reason;
                $reject->campaign_id = $request->campaign_id;
                $reject->created_at = date('Y-m-d H:i:s');
                $reject->updated_at = date('Y-m-d H:i:s');
                $reject->created_by = \Auth::user()->email;
                $reject->save();

                $campaign = $this->campaign->where('campaign_id', $request->campaign_id)->first();
                $campaign->campaign_status = 'REJECTED';
                $campaign->save();
            DB::commit();
            return redirect()->route('campaign.index')->with(['message' => 'Campaign success rejected', 'type' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('campaign.index')->with(['message' => 'Failed, try again later'. $e, 'type' => 'danger']);
        }
    }
}
 