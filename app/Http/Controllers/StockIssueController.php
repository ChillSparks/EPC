<?php

namespace App\Http\Controllers;

use App\StockIssue;
use App\Store;
use App\StockIssueDetail;
use App\StockRequest;
use App\StockRequestDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StockIssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock_requests = DB::table('stock_request')->where('status', '=', 1)->get();
        return view('admin.stockIssue.index', compact('stock_requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $stock_requests = DB::table('stock_request')
            ->select('stock_request.*', 'divisions.name as division')
            ->leftJoin('divisions', 'divisions.id', '=', 'stock_request.division')
            ->where('stock_request.id', '=', $id)
            ->get();
        $stock_requests_details = DB::table('stock_request_details')
            ->select('stock_request_details.*', 'units.name as unit')
            ->leftJoin('units', 'units.id', 'stock_request_details.unit')
            ->where('stock_request_details.stock_request_id', '=', $id)
            ->get();
        $data = DB::table('stock_issue')->latest('id')->first();
        if ($data == null) {
            $last_id = "B - " . sprintf('%06s', 1);
        } else {
            $id = StockRequest::latest()->first()->id;
            $last_id = "B - " . sprintf('%06s', ($id + 1));
        }
        return view('admin.stockIssue.stock_issue_create', compact('stock_requests', 'stock_requests_details', 'last_id'));
    }
    public function confirmDetails($id)
    {
        $stock_issues = DB::table('stock_issue')
            ->select('stock_issue.*')
            ->where('stock_issue.stock_req_id', '=', $id)
            ->get();
        $stock_issue = DB::table('stock_issue')
            ->where('stock_issue.stock_req_id', '=', $id)
            ->first();
        $stock_issue_details = DB::table('stock_issue_details')
            ->select('stock_issue_details.*', 'units.name as unit')
            ->leftJoin('units', 'units.id', 'stock_issue_details.unit')
            ->where('stock_issue_details.stock_issue_id', '=', $stock_issue->id)
            ->get();
        $data = DB::table('stock_issue')->latest('id')->first();
        if ($data == null) {
            $last_id = "B - " . sprintf('%06s', 1);
        } else {
            $id = StockRequest::latest()->first()->id;
            $last_id = "B - " . sprintf('%06s', ($id + 1));
        }
        return view('admin.stockIssue.stock_issue_confirm', compact('stock_issues', 'stock_issue_details', 'last_id'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'req_date' => 'required|date_format:"Y-m-d"',
            'issue_no' => 'required',
            'issue_date' => 'required|date_format:"Y-m-d"',
            'to_dept' => 'required',
            'division' => 'required',
            'township' => 'required',

        ], [
            'req.required' => '25-A date is required.',
            'req.date_format' => 'Invalid EPS 25-A date format',
            'issue_no.required' => 'Issue No. is required.',
            'issue.required' => 'Issue Date is required.',
            'issue.date_format' => 'Invalid EPS 25-B date format',
            'to_dept.required' => 'Department is required.',
            'division.required' => 'Division is required',
            'township.required' => 'Township is required'

        ]);
        if ($validator->fails()) {
            return redirect('/admin/issue/' . $request->request_id)
                ->withErrors($validator, 'update')->withInput();
        }
        $user = Auth::user();
        $stock_issue = new StockIssue();
        $stock_issue->stock_req_id = $request->request_id;
        $stock_issue->req_voucher_no = $request->req_voucher_no;
        $stock_issue->req_date = $request->req_date;
        $stock_issue->issue_no = $request->issue_no;
        $stock_issue->l_no=$request->l_no;
        $stock_issue->issue_date = $request->issue_date;
        $stock_issue->to_dept = $request->to_dept;
        $stock_issue->division = $request->division;
        $stock_issue->township = $request->township;
        $stock_issue->reason = $request->reason;
        $stock_issue->remark = $request->remark;
        $stock_issue->issue_flag = 1;
        DB::table('stock_request')
            ->where('voucher_no', '=', $request->req_voucher_no)
            ->update(['stock_request.issue_create_flag' => '1']);
        $stock_issue->created_by = $user->name;
        $stock_issue->updated_by = $user->name;
        $stock_issue->save();
        if ($stock_issue->save()) {
            $ids = $request->stock_req_detail_id;
            foreach ($ids as $key => $id) {
                $stock_request_details = new StockIssueDetail();
                $stock_details = StockRequestDetails::find($id);
                $remaining_stock =DB::table('store')->select('qty')->where('store.id','=',$stock_details->store_id)->first();
                if($remaining_stock <=$stock_details->qty ){
                    session()->flash('message', 'There is no Stock!');
                    return redirect()->route('admin.stock_issue.index');
                }else{
                    if ($stock_details) {
                        $stock_request_details->stock_issue_id = $stock_issue->id;
                        $stock_request_details->stock_code     = $stock_details->stock_code;
                        $stock_request_details->item_name = $stock_details->item_name;
                        $stock_request_details->unit = $stock_details->unit;
                        $stock_request_details->qty = $stock_details->qty;
                        $stock_request_details->price = $stock_details->price;
                        $stock_request_details->amt = $stock_details->amt;
                        
                        DB::table('store')
                            ->leftJoin('stock_request_details', 'stock_request_details.store_id', '=', 'store.id')
                            ->where('store.id', $stock_details->store_id)
                            ->update(array(
                                'store.qty' => DB::raw('store.qty - stock_request_details.qty'),
                            ));
                        if ($stock_details->qty) {
                            $stock_request_details->save();
                        }
                    }
                    return redirect()->route('admin.stock_issue.index');
                }
            }
        }  
    }
    public function printIssue($id)
    {
        $stock_issues = DB::table('stock_issue')
            ->select('stock_issue.*')
            ->where('stock_issue.id', '=', $id)
            ->get();
        $stock_issue_details = DB::table('stock_issue_details')
            ->select('stock_issue_details.*', 'units.name as unit')
            ->leftJoin('units', 'units.id', 'stock_issue_details.unit')
            ->where('stock_issue_details.stock_issue_id', '=', $id)
            ->get();

        $printData['stock_issues'] = $stock_issues;
        $printData['stock_details'] = $stock_issue_details;
        return view('admin.stockIssue.form25B_view', compact('printData'));
    }
    public function firstApproved(Request $request)
    {
        $id = $request->id;
        $stock_issues = StockIssue::find($id);
        $stock_issues->approved_level_1 = $request->isApproved;
        $stock_issues->status = 1;
        $stock_issues->save();
        $stock_issues = DB::table('stock_issue')
            ->select('stock_issue.*')
            ->where('stock_issue.id', $id)
            ->get();
        $stock_issues_details = DB::table('stock_issue_details')
            ->select('stock_issue_details.*')
            ->where('stock_issue_details.stock_issue_id', $id)
            ->get();
        return view('admin.stockIssue.stock_issue_confirm', compact('stock_issues', 'stock_issues_details'));
    }
}
