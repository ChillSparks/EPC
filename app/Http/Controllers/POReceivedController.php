<?php

namespace App\Http\Controllers;

use App\Checked;
use App\DOItem;
use App\POReceived;
use App\POReceivedDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
class POReceivedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = DB::table('po_contracts')->select('po_contracts.*')->get();
        return view('admin.check.index',compact('contracts'));
    }

    public function checkList(Request $request)
    {
        $id = $request->input('id');
        $contracts   = DB::table('po_contracts')
                        ->select('po_contracts.*')
                        ->where('po_contracts.id','=',$id)
                        ->get();
        $chk_lists = DB::table('po_received')
                    ->select('po_received.id as received_id','po_received.*','po_contracts.*')
                    ->leftJoin('po_contracts','po_received.po_id','=','po_contracts.id')
                    ->where('po_received.po_id','=',$id)
                    ->get(); 
        return view('admin.check.checkFormList',compact('chk_lists','contracts'));
    }
    public function printChecking($id)
    {
        $printData = [];
        $chk_lists   = DB::table('po_received')
                        ->select('po_received.id as received_id','po_received.po_id',
                        'po_received.chk_place','po_received.chk_date','po_received.vehicle_name',
                        'po_received.chk_remark','po_contracts.po_no','po_contracts.po_date',
                        'suppliers.name as supplier_name','po_contracts.do_no','po_contracts.do_date')
                        ->leftJoin('po_contracts','po_contracts.id','=','po_received.po_id')
                        ->leftJoin('suppliers','suppliers.id','=','po_contracts.supplier_id')
                        ->where('po_received.id','=',$id)
                        ->get(); 
                                           
        $chk_details = DB::table('po_received_details')
                        ->select('po_received_details.*','units.name as unit')
                        ->leftJoin('units','units.id','=','po_received_details.unit')
                        ->where('po_received_details.po_received_id','=',$id)
                        ->get();
        $total = DB::table('store')->where('store.po_received_id', '=', $id)->sum('amt');
        $printData['chk_lists'] = $chk_lists;
        $printData['chk_details'] = $chk_details;                   
        return view('admin.check.printChecking', compact('printData'));  
    }
    public function printForm16A($id)
    {
        $chk_lists   = DB::table('po_received')
                        ->select('po_received.*','po_contracts.po_no','po_contracts.po_date',
                        'suppliers.name as supplier_name','po_contracts.do_no','po_contracts.do_date')
                        ->leftJoin('po_contracts','po_contracts.id','=','po_received.po_id')
                        ->leftJoin('suppliers','suppliers.id','=','po_contracts.supplier_id')
                        ->where('po_received.id','=',$id)
                        ->get(); 
                                           
        $chk_details = DB::table('po_received_details')
                        ->select('po_received_details.*','units.name as unit')
                        ->leftJoin('units','units.id','=','po_received_details.unit')
                        ->where('po_received_details.po_received_id','=',$id)
                        ->get();
        $total = DB::table('store')->where('store.po_received_id', '=', $id)->sum('amt');
        $total = DB::table('store')->where('store.po_received_id', '=', $id)->sum('amt');
        $printData['chk_lists'] = $chk_lists;
        $printData['chk_details'] = $chk_details;                  
        return view('admin.check.form16_view', compact('printData'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create(Request  $request)
    {
        $id = $request->id;
        $contracts   = DB::table('po_contracts')
                        ->select('po_contracts.*','suppliers.name as supplier_name')
                        ->leftJoin('suppliers','suppliers.id','=','po_contracts.supplier_id')
                        ->where('po_contracts.id','=',$id)
                        ->get();
                        
        $item_details = DB::table('do_items')
                        ->select('do_items.*','units.name as unit')
                        ->leftJoin('units','units.id','=','do_items.unit')
                        ->where('do_items.po_id','=',$id)
                        ->where('do_items.l_qty','!=',0)
                        ->get();
        return view('admin.check.create',compact('contracts','item_details'));        
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
            'chk_place' => 'required|max:31'
           
        ],[
            'chk_place.required'=>'Checking Place is required.',
            'chk_place.max'=>'Maximum Character is 31.'
         
        ]);
        if ($validator->fails()) {
            return redirect('/admin/check/create?id='.$request->po_id)
            ->withErrors($validator,'update')->withInput();
        }
        $user = Auth::user();
        $po_rev = new POReceived();
        $po_rev->po_id = $request->po_id;
        $po_rev->chk_place = $request->chk_place;
        $po_rev->chk_date = $request->chk_date;
        $po_rev->chk_remark = $request->chk_remark;
        $po_rev->vehicle_name = $request->vehicle_name;
        $po_rev->created_by = $user->name;
        $po_rev->updated_by = $user->name;
        if($po_rev->save()){
            $dtDatas = json_decode($request->dt_data, true);
            foreach ($dtDatas as $key => $dtData) {
                $po_received_detail = new POReceivedDetail();
                $do_item = DB::table('do_items')->where('id', $dtData['id'])->first();
                $po_received_detail->po_received_id = $po_rev->id;
                $po_received_detail->po_received_po_id =$request->po_id;
                $po_received_detail->do_id =$do_item->id;
                $po_received_detail->item_name =$do_item->item_name;
                $po_received_detail->unit =$do_item->unit;
                $po_received_detail->qty = $dtData['r_qty'];
                $po_received_detail->price =$do_item->price;
                $po_received_detail->amt =$dtData['r_qty'] *$do_item->price;
                $po_received_detail->currency =$do_item->currency;
                $po_received_detail->brand =$do_item->brand;
                $po_received_detail->mfg_country =$do_item->mfg_country;
                $po_received_detail->mfg_company =$do_item->mfg_company;
                $po_received_detail->mfg_date =$do_item->mfg_date;
                $po_received_detail->manual_orignal_filename =$do_item->manual_orignal_filename;
                $po_received_detail->manual_filename =$do_item->manual_filename;
                $po_received_detail->created_by = $user->name;
                $po_received_detail->updated_by = $user->name;
                $do_items_update = DOItem::find($dtData['id']);
                if($po_received_detail->save()){
                    $do_items_update->received_flag = 1;
                    $do_items_update->l_qty = $do_item->l_qty-$dtData['r_qty'] ;
                    $do_items_update->save();
                }
            }
        }
        return redirect()->route('admin.check.formlist', ['id' => $request->po_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $chk_lists   = DB::table('po_received')
                        ->select('po_received.id as received_id','po_received.po_id',
                        'po_received.chk_place','po_received.chk_date','po_received.vehicle_name',
                        'po_received.chk_remark','po_contracts.po_no','po_contracts.po_date',
                        'suppliers.name as supplier_name','po_contracts.do_no','po_contracts.do_date')
                        ->leftJoin('po_contracts','po_contracts.id','=','po_received.po_id')
                        ->leftJoin('suppliers','suppliers.id','=','po_contracts.supplier_id')
                        ->where('po_received.id','=',$id)
                        ->get(); 
                                           
        $chk_details = DB::table('po_received_details')
                        ->select('po_received_details.*','units.name as unit')
                        ->leftJoin('units','units.id','=','po_received_details.unit')
                        ->where('po_received_details.po_received_id','=',$id)
                        ->get();
        return view('admin.check.details',compact('chk_lists','chk_details'));
    }
    public function editcheck($id)
    {
        $chk_lists   = DB::table('po_received')
                        ->select('po_received.id as received_id','po_received.po_id',
                        'po_received.chk_place','po_received.chk_date','po_received.vehicle_name',
                        'po_received.chk_remark','po_contracts.po_no','po_contracts.po_date',
                        'suppliers.name as supplier_name','po_contracts.do_no','po_contracts.do_date')
                        ->leftJoin('po_contracts','po_contracts.id','=','po_received.po_id')
                        ->leftJoin('suppliers','suppliers.id','=','po_contracts.supplier_id')
                        ->where('po_received.id','=',$id)
                        ->get(); 
                                           
        $chk_details = DB::table('do_items')
                        ->select('do_items.*','units.name as unit')
                        ->leftJoin('units','units.id','=','do_items.unit')
                        ->where('do_items.po_id','=',$id)
                        ->get();
               
        return view('admin.check.edit',compact('chk_lists','chk_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contracts = DB::table('po_contracts')
                    ->select('po_contracts.*','suppliers.name as s_name')
                    ->leftJoin('suppliers','suppliers.id','=','po_contracts.supplier_id')
                    ->where('po_contracts.id','=',$id)
                    ->get();
        $doItems = DB::table('do_items')
                    ->select('do_items.*','units.name as u_name','po_received_details.do_id as received_id')
                    ->leftJoin('units','do_items.unit','=','units.id')
                    ->leftJoin('po_received_details','do_items.id','=','po_received_details.do_id')
                    ->where('do_items.po_id','=',$id)
                    ->get();
        $chk_lists = DB::table('do_items')
                    ->select('po_received.id as invoice_no','po_received.*','po_contracts.*')
                    ->leftJoin('po_contracts','po_received.po_id','=','po_contracts.id')
                    ->where('po_received.po_id','=',$id)
                    ->get();
                
        return response()->json(['contracts'=>$contracts,'doItems'=>$doItems,'chk_lists'=>$chk_lists,'id'=>$id]); 
    }

    public function update(Request $request)
    {
        dd($request);
        $do_ids = preg_split ("/\,/",$request->dtData);

        $po_received = POReceived::findOrFail($request->po_received_id);
        $po_received->update($request->all('chk_place','chk_remark','vehicle_name'));

        foreach ($do_ids as $do_id){
            DB::table('do_items')->where('id', $do_id)->update(array('received_flag' => 0));
            DB::table('po_received_details')->where('do_id', $do_id)->delete();
            
        }
        $id = $request->po_id;
        $chk_lists = DB::table('po_received')
                    ->select('po_received.id as received_id','po_received.*','po_contracts.*')
                    ->leftJoin('po_contracts','po_received.po_id','=','po_contracts.id')
                    ->where('po_received.po_id','=',$id)
                    ->get(); 
                    $contracts   = DB::table('po_contracts')
                    ->select('po_contracts.*')
                    ->where('po_contracts.id','=',$request->po_id)
                    ->get();
        return view('admin.check.checkFormList',compact('chk_lists','contracts'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (! Gate::allows('checking_manage')) {
            return abort(401);
        }
        $po_id = DB::table('po_received')->where('po_received.id','=',$id)->pluck('po_id');
        $po = POReceived::findOrFail($id);
        DB::table('po_received_details')
        ->where('po_received_details.po_received_id','=',$id)
        ->where('po_received_details.po_received_po_id','=',$po_id[0])
        ->delete();
        if( $po->delete()){
            DB::table('do_items')->where('po_id',$po_id[0])->update(array('received_flag' => 0));
            DB::table('do_items')->where('po_id',$po_id[0])->update(["l_qty" => DB::raw("qty")]);
        }
        return redirect()->route('admin.check.index');
    }
}
