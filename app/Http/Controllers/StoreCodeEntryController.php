<?php

namespace App\Http\Controllers;

use App\POReceivedDetail;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreCodeEntryController extends Controller
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
                        ->where('po_received.done','=',1)
                        ->get(); 
        return view('admin.storecode.index', compact('to_chk_lists'));
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
        $to_checkitems      =DB::table('po_received_details')
                                ->select('po_received_details.*','units.name as unit')
                                ->leftJoin('units','units.id','=','po_received_details.unit')
                                ->where('po_received_details.po_received_id','=',$id)
                                ->where('po_received_details.store_flag','=',0)
                                ->get(); 
        $store_items        =DB::table('store')
                                ->select('*')
                                ->where('store.po_received_id','=',$id)
                                ->get();

        return view('admin.storecode.itemdetails', compact('order_received_infos','to_checkitems','store_items'));        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $received_details = POReceivedDetail::find($request->id);
        $store_items=new Store();
        $store_items->po_received_id=$received_details->po_received_id;
        $store_items->po_received_po_id=$received_details->po_received_po_id;
        $store_items->item_name=$received_details->item_name;
        $store_items->store_code =$request->stock_code;
        $store_items->warehouse  =$request->warehouse;
        $store_items->unit=$received_details->unit;
        $store_items->qty=$received_details->r_qty;
        $store_items->price=$received_details->price;       
        $store_items->amt=$received_details->amt;
        $store_items->brand=$received_details->brand;
        $store_items->mfg_country=$received_details->mfg_country;
        $store_items->mfg_company=$received_details->mfg_company;
        $store_items->mfg_date=$received_details->mfg_date;
        $store_items->manual_original_filename=$received_details->manual_orignal_filename;
        $store_items->manual_filename=$received_details->manual_filename;
        $store_items->item_remark=$received_details->item_remark;
        $store_items->created_at=$received_details->created_at;
        $store_items->updated_at=$received_details->updated_at;
        if($store_items->save()){
            DB::table('po_received_details')->where('id',$request->id)->update(array('store_flag'=>1));
        }     
        return response()->json(['data'=>'Your Stock Code Created Sucessfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        
    }

    public function printGR(Request $request,$id){
        $printData = [];
        $po = DB::table('po_received')
                        ->select('po_received.*','po_contracts.po_no as po_no',
                        'po_contracts.po_date as po_date','po_contracts.do_no as do_no',
                        'po_contracts.do_date as do_date','po_contracts.remark as remark','suppliers.name as supplier')
                        ->leftJoin('po_contracts','po_contracts.id','=','po_received.po_id')
                        ->leftJoin('suppliers','po_contracts.supplier_id','=','suppliers.id')
                        ->where('po_received.done','=',1)
                        ->where('po_received.id','=',$id)
                        ->get(); 


        $po_items = DB::table('store')
                        ->select('store.*','units.name as unit')
                        ->leftJoin('units','units.id','=','store.unit')
                        ->where('store.po_received_id','=',$id)
                        ->get();
        $total = DB::table('store')->where('store.po_received_id', '=', $id)->sum('amt');
        $printData['tot_amt'] = $total;
        $printData['po'] = $po;
        $printData['po_items'] = $po_items;                     
        return view('admin.storecode.printGR', compact('printData'));        
    }
}
