<?php

namespace App\Http\Controllers;

use App\POContract;
use App\Supplier;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Validator;

class POContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('pocontract_manage')) {
            return abort(401);
        }

        $contracts = DB::table('po_contracts')
        ->select('po_contracts.*','suppliers.name as supplier_name')
        ->leftJoin('suppliers','po_contracts.supplier_id','=','suppliers.id')
        ->orderBy('id', 'DESC')
        ->get();
       return view('admin.pocontract.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers =Supplier::pluck('name','id');
        return view('admin.pocontract.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('pocontract_manage')) {
            return abort(401);
        }
        $validator = Validator::make($request->all(), [
            'po_no' => 'required|max:45',
            'do_no'=>'max:45',
            'po_date' => 'required|date_format:"Y-m-d"',
            'do_date' => 'required|date_format:"Y-m-d"'
        ],[
            'po_no.required'=>'PO Contract No. is required.',
            'do_no.required'=>'DO No. is required',
            'do_no.max'=>'Maximum Character is 45',
            'po_no.max'=>'Maximum Character is 45.',
            'po_date.required'=>'PO Contract Date is required.',
            'do_date.required'=>'DO Date is required.',
            'po_date.date_format'=>'Invalid PO Date Format.',
            'do_date.date_format'=>'Invalid DO Date Format.'

        ]);
        if ($validator->fails()) {
            return redirect('/admin/pocontract/create')
            ->withErrors($validator,'update')->withInput();
        }

        $user = Auth::user();
        $request->request->add(['created_by' => $user->name]);
        $request->request->add(['updated_by' => $user->name]);
        POContract::create($request->all()); 
        return redirect()->route('admin.pocontract.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('pocontract_manage')) {
            return abort(401);
        }
        $suppliers =Supplier::pluck('name','id');
        $contracts = POContract::findOrFail($id);
        return view('admin.pocontract.edit', compact('suppliers','contracts'));
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
        if (! Gate::allows('pocontract_manage')) {
            return abort(401);
        }
        $validator = Validator::make($request->all(), [
            'po_no' => 'required|max:45',
            'po_date' => 'required|date_format:"Y-m-d"',
            'do_no' => 'required',
            'do_date' => 'required|date_format:"Y-m-d"'
        ],[
            'po_no.required'=>'PO Contract No. is required.',
            'po_no.max'=>'Maximum Character is 45.',
            'po_date.required'=>'PO Contract Date is required.',
            'do_no.required'=>'DO No. is required.',
            'do_date.required'=>'DO Date is required.',
            'po_date.date_format'=>'Invalid PO Date Format.',
            'do_date.date_format'=>'Invalid DO Date Format.'

        ]);
        if ($validator->fails()) {
            return redirect('/admin/pocontract/'.$id.'/edit')
            ->withErrors($validator,'update')->withInput();
        }
        $contracts = POContract::findOrFail($id);
        $user = Auth::user();
        $request->request->add(['updated_by' => $user->name]);
        $contracts->update($request->all());

        return redirect()->route('admin.pocontract.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('pocontract_manage')) {
            return abort(401);
        }
        $contracts = POContract::findOrFail($id);
        $contracts->delete();
        DB::table('do_items')->where('po_id', $id)->delete();
        DB::table('po_received')->where('po_id', $id)->delete();
        DB::table('po_received_details')->where('po_received_po_id', $id)->delete();

        return redirect()->route('admin.pocontract.index');
    }

        /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('pocontract_manage')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = POContractd::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
