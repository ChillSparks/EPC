<?php

namespace App\Http\Controllers;

use App\Divisions;
use App\StockIssue;
use App\StockRequest;
use App\StockRequestDetails;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class StockRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stockRequest()
    {
        $stock_requests = DB::table('stock_request')->select('*')->get();
        return view('admin.stock_request.stock-25A', compact('stock_requests'));
    }
    public function getTownshipList(Request $request)
    {
        $townships = DB::table("townships")->where('townships.division_id', '=', $request->id)->pluck("name", "id");
        return response()->json($townships);
    }

    public function stockRequestCreate()
    {
        $data = DB::table('stock_request')->latest('id')->first();
        if ($data == null) {
            $last_id = "C - " . sprintf('%06s', 1);
        } else {
            $id = StockRequest::latest()->first()->id;
            $last_id = "C - " . sprintf('%06s', ($id + 1));
        }
        $divisions = DB::table("divisions")->pluck("name", "id");
        $store_items = DB::table('store')->select('store.*', 'units.name as unit')
            ->leftJoin('units', 'units.id', 'store.unit')
            ->get();
        return view('admin.stock_request.request_create', compact('last_id', 'store_items', 'divisions'));
    }
    public function stockRequestStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'l_no' => 'required|max:18',
            'to_dept' => 'required|max:40',
            'req_date' => 'required|date_format:"Y-m-d"',
            'con_date' => 'required|date_format:"Y-m-d"',
            'division' => 'required',
            'dt_data' => 'required|min:3',
            'remark'=>'max:75',
            'reason'=>'max:75'

        ], [
            'l_no.required' => 'Letter No. is required.',
            'l_no.max'=>'Maximum Character is 18.',
            'to_dept.max'=>'Maximum Character is 40',
            'remark.max'=>'Maximum Character is 75.',
            'reason.max'=>'Maximum Character is 75.',
            'to_dept.required' => 'Department is required.',
            'req_date.required' => 'Date is required.',
            'con_date.required' => 'Confirm Date is required.',
            'req_date.date_format' => 'Invalid date format.',
            'con_date.date_format' => 'Invalid confirm date format.',
            'division.required' => 'Division is required.',
            'dt_data.min' => 'Checked Item Required.'

        ]);
        if ($validator->fails()) {
            return redirect('/admin/request/create')
                ->withErrors($validator, 'update')->withInput();
        }
        $user = Auth::user();
        $stock_request = new StockRequest();
        $stock_request->voucher_no = $request->v_no;
        $stock_request->l_no = $request->l_no;
        $stock_request->date = $request->req_date;
        $stock_request->confirm_date = $request->con_date;
        $stock_request->dept_biz_name = $request->to_dept;
        $stock_request->reason = $request->reason;
        $stock_request->division = $request->division;
        $stock_request->township = $request->township;
        $stock_request->remark = $request->remark;
        $stock_request->created_by = $user->name;
        $stock_request->updated_by = $user->name;
        if ($stock_request->save()) {
            $dtDatas = json_decode($request->dt_data, true);
            foreach ($dtDatas as $key => $dtData) {
                $stock_request_details = new StockRequestDetails();
                $store = Store::find($dtData['id']);
                $stock_request_details->stock_request_id = $stock_request->id;
                $stock_request_details->store_id = $store->id;
                $stock_request_details->store_id = $store->id;
                $stock_request_details->stock_code = $store->store_code;
                $stock_request_details->item_name = $store->item_name;
                $stock_request_details->unit = $store->unit;
                $stock_request_details->qty = $store->qty;
                $stock_request_details->price = $store->price;
                $stock_request_details->amt = $store->amt;
                $stock_request_details->save();
            }
        }
        return redirect()->route('admin.stock.request');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stockIssue()
    {
        return view('admin.stock_request.stock-25B');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function stockRequestDetails($id)
    {
        $stock_requests = DB::table('stock_request')
            ->select('stock_request.*')
            ->where('stock_request.id', $id)
            ->get();
        $stock_requests_details = DB::table('stock_request_details')
            ->select('stock_request_details.*', 'units.name as unit')
            ->leftJoin('units', 'units.id', 'stock_request_details.unit')
            ->where('stock_request_details.stock_request_id', $id)
            ->get();
        return view('admin.stock_request.stock_request_confirm', compact('stock_requests', 'stock_requests_details'));
    }

    public function printRequest($id)
    {
        $stock_requests = DB::table('stock_request')
            ->select('stock_request.*')
            ->where('stock_request.id', $id)
            ->get();
        $stock_requests_details = DB::table('stock_request_details')
            ->select('stock_request_details.*', 'units.name as unit')
            ->leftJoin('units', 'units.id', 'stock_request_details.unit')
            ->where('stock_request_details.stock_request_id', $id)
            ->get();

        $printData['stock_requests'] = $stock_requests;
        $printData['stock_details'] = $stock_requests_details;
        return view('admin.stock_request.form25A_view', compact('printData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(DB::table('stock_request')->where('stock_request.id','=',$id)->where('stock_request.issue_create_flag','=',0)->delete()){
            DB::table('stock_request_details')->where('stock_request_details.stock_request_id','=',$id)->delete();
            return redirect()->route('admin.stock.request');
        }else{
            session()->flash('message', 'You can not delete Issue Created record!');
            return redirect()->route('admin.stock.request');
        }
        // $stock_requests = DB::table('stock_request')->select('*')->get();
        
    }
    public function firstApproved(Request $request)
    {
        $id = $request->id;
        $stock_requests = StockRequest::find($id);
        $stock_requests->approved_level_1 = $request->isApproved;
        $stock_requests->status = 1;
        $stock_requests->save();
        $stock_requests = DB::table('stock_request')
            ->select('stock_request.*')
            ->where('stock_request.id', $id)
            ->get();
        $stock_requests_details = DB::table('stock_request_details')
            ->select('stock_request_details.*')
            ->where('stock_request_details.stock_request_id', $id)
            ->get();
        return view('admin.stock_request.stock_request_confirm', compact('stock_requests', 'stock_requests_details'));
    }
    public function secondApproved(Request $request)
    {
        $id = $request->id;
        $stock_requests = StockRequest::find($id);
        $stock_requests->approved_level_2 = $request->isApproved;
        $stock_requests->save();
        $stock_requests = DB::table('stock_request')
            ->select('stock_request.*')
            ->where('stock_request.id', $id)
            ->get();
        $stock_requests_details = DB::table('stock_request_details')
            ->select('stock_request_details.*')
            ->where('stock_request_details.stock_request_id', $id)
            ->get();
        return view('admin.stock_request.stock_request_confirm', compact('stock_requests', 'stock_requests_details'));
    }
}
