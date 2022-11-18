<?php

namespace App\Http\Controllers;

use App\POReceived;
use App\POReceivedDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ToCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $to_chk_lists = DB::table('po_received')
                        ->select('po_received.*','po_contracts.po_no as po_no',
                        'po_contracts.po_date as po_date','po_contracts.do_no as do_no',
                        'po_contracts.do_date as do_date','po_contracts.remark as remark','suppliers.name as supplier')
                        ->leftJoin('po_contracts','po_contracts.id','=','po_received.po_id')
                        ->leftJoin('suppliers','po_contracts.supplier_id','=','suppliers.id')
                        ->where('po_received.done','=',0)
                        ->get(); 
        return view('admin.tocheck.index', compact('to_chk_lists'));
    }
    public function detail(Request $request)
    {
        $id = $request->check;
        $order_received_infos= DB::table('po_received')
                                ->select('po_received.*','po_contracts.po_no as po_no',
                                'po_contracts.po_date as po_date','po_contracts.do_no as do_no',
                                'po_contracts.do_date as do_date','po_contracts.remark as remark',
                                'suppliers.name as supplier','suppliers.name as supplier')
                                ->leftJoin('po_contracts','po_contracts.id','=','po_received.po_id')
                                ->leftJoin('suppliers','po_contracts.supplier_id','=','suppliers.id')
                                ->where('po_received.id','=',$id)
                                ->get(); 
        $to_checkitems       = DB::table('po_received_details')
                                ->select('po_received_details.*','units.name as unit')
                                ->leftJoin('units','units.id','=','po_received_details.unit')
                                ->where('po_received_details.po_received_id','=',$id)
                                ->get(); 
        return view('admin.tocheck.details', compact('order_received_infos','to_checkitems'));        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function checkerConfrim(Request $request)
    {
       
        $id = $request->check;
        $order_received_infos= DB::table('po_received')
                                ->select('po_received.*','po_contracts.po_no as po_no',
                                'po_contracts.po_date as po_date','po_contracts.do_no as do_no',
                                'po_contracts.do_date as do_date','po_contracts.remark as remark',
                                'suppliers.name as supplier','suppliers.name as supplier')
                                ->leftJoin('po_contracts','po_contracts.id','=','po_received.po_id')
                                ->leftJoin('suppliers','po_contracts.supplier_id','=','suppliers.id')
                                ->where('po_received.id','=',$id)
                                ->get(); 
        $to_checkitems       = DB::table('po_received_details')
                                ->select('po_received_details.*','units.name as unit')
                                ->leftJoin('units','units.id','=','po_received_details.unit')
                                ->where('po_received_details.po_received_id','=',$id)
                                ->get(); 
        return view('admin.tocheck.checked_details', compact('order_received_infos','to_checkitems'));   
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
            'dt_data'=>'required|min:3',
         
        ],[
            'dt_data.min'=>'Checked Item Required.',
           
        ]);
        if ($validator->fails()) {
            return redirect('/admin/tocheck/items?check='.$request->rev_id)
            ->withErrors($validator,'update')->withInput();
        }
        $received_order = POReceived::find($request->rev_id);
        // Make sure you've got the received_order model
        if($received_order) {
            $received_order->net_amt = $request->net_amt;
            $received_order->rev_amt = $request->rev_amt;
            $received_order->red_amt = $request->red_amt;
            $received_order->excess_amt = $request->excess_amt;
            $received_order->damage_amt = $request->damage_amt;
            $received_order->chk_box_no = $request->chk_box_no;
            $received_order->chk_remark = $request->chk_remark;
            $received_order->checker = 1;
            if($received_order->save()){
                $dtDatas = json_decode($request->dt_data, true);
                foreach ($dtDatas as $key => $dtData) {
                    $received_order_details = POReceivedDetail::find($dtData['id']);
                    if($received_order_details){
                        $received_order_details->r_qty = $dtData['r_qty'];
                        $received_order_details->item_remark = $dtData['r_remark'];
                        $received_order_details->save();
                    }
                }                  
            }
        }
        return redirect()->route('admin.tocheck.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        //
    }

    public function firstApproved(Request $request)
    {
        $id = $request->id;
        $received_order = POReceived::find($id);
        $received_order->approved_level_1 = $request->isApproved;
        $received_order->done = 1;
        $received_order->save();
        $order_received_infos= DB::table('po_received')
                            ->select('po_received.*','po_contracts.po_no as po_no',
                            'po_contracts.po_date as po_date','po_contracts.do_no as do_no',
                            'po_contracts.do_date as do_date','po_contracts.remark as remark',
                            'suppliers.name as supplier','suppliers.name as supplier')
                            ->leftJoin('po_contracts','po_contracts.id','=','po_received.po_id')
                            ->leftJoin('suppliers','po_contracts.supplier_id','=','suppliers.id')
                            ->where('po_received.id','=',$id)
                            ->get(); 
        $to_checkitems  = DB::table('po_received_details')
                ->select('po_received_details.*','units.name as unit')
                ->leftJoin('units','units.id','=','po_received_details.unit')
                ->where('po_received_details.po_received_id','=',$id)
                ->get(); 
         return view('admin.tocheck.checked_details', compact('order_received_infos','to_checkitems'));  
    }
    public function secondApproved(Request $request)
    {
        $id = $request->id;
        $received_order = POReceived::find($id);
        $received_order->approved_level_2 = $request->isApproved;
        $received_order->save();
        $order_received_infos= DB::table('po_received')
                            ->select('po_received.*','po_contracts.po_no as po_no',
                            'po_contracts.po_date as po_date','po_contracts.do_no as do_no',
                            'po_contracts.do_date as do_date','po_contracts.remark as remark',
                            'suppliers.name as supplier','suppliers.name as supplier')
                            ->leftJoin('po_contracts','po_contracts.id','=','po_received.po_id')
                            ->leftJoin('suppliers','po_contracts.supplier_id','=','suppliers.id')
                            ->where('po_received.id','=',$id)
                            ->get(); 
        $to_checkitems = DB::table('po_received_details')
                            ->select('po_received_details.*','units.name as unit')
                            ->leftJoin('units','units.id','=','po_received_details.unit')
                            ->where('po_received_details.po_received_id','=',$id)
                            ->get(); 
        return view('admin.tocheck.checked_details', compact('order_received_infos','to_checkitems')); 
    }
}
