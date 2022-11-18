<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\DOItem;
use App\Unit;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Currency;

class DOItemController extends Controller
{

    public function createItems($id)
    {
        $contracts = DB::table('po_contracts')->select('id', 'po_no')->where('id', '=', $id)->get();
        foreach ($contracts as $key => $contract) {
            $po_no = $contract->po_no;
            $id    = $contract->id;
        }
        $units = Unit::pluck('name', 'id');
        $doItems = DB::table('do_items')
            ->select('do_items.*', 'units.name as unit')
            ->leftJoin('units', 'do_items.unit', '=', 'units.id')
            ->where('do_items.po_id', '=', $id)
            ->get();
        $currency = Currency::all('name');
        return view('admin.doitems.index', compact('doItems', 'units', 'po_no', 'id', 'currency'));
    }
    public function store(Request $request)
    {
        if (!Gate::allows('pocontract_manage')) {
            return abort(401);
        }
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|max:255',
            'unit' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        if ($validator->passes()) {
            $user = Auth::user();
            $doItems = new DOItem();
            $doItems->po_id = $request->get('po_id');
            $doItems->item_name = $request->get('item_name');
            $doItems->unit = $request->get('unit');
            $doItems->qty = $request->get('qty');
            $doItems->l_qty = $request->get('qty');
            $doItems->price = $request->get('price');
            $doItems->currency = $request->get('cur');
            $doItems->amt = $request->get('qty') * $request->get('price');
            $doItems->brand = $request->get('brand');
            $doItems->mfg_country = $request->get('mfg_country');
            $doItems->mfg_company = $request->get('mfg_company');
            $doItems->mfg_date = $request->get('mfg_date');
            $doItems->created_by = $user->name;
            $doItems->updated_by = $user->name;
            if ($request->hasFile('manual')) {
                $file = $request->file('manual');
                $extension = $file->getClientOriginalExtension();
                Storage::disk('public')->put($file->getFilename() . '.' . $extension,  File::get($file));
                $doItems->manual_orignal_filename = $file->getClientOriginalName();
                $doItems->manual_filename = $file->getFilename() . '.' . $extension;
            } else {
                $doItems->manual_orignal_filename = null;
                $doItems->manual_filename = null;
            }
            $result = $doItems->save();
            return Response::json(['success' => 'success']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }

    public function edit($id)
    {
        if (!Gate::allows('pocontract_manage')) {
            return abort(401);
        }
        $edit_doItem = DOItem::all()->where('id', $id);
        return view('admin.doitems.index', compact('edit_doItem'));
    }
    public function update(Request $request)
    {
        if (!Gate::allows('pocontract_manage')) {
            return abort(401);
        }
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|max:255',
            'unit' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        if ($validator->passes()) {
            $user = Auth::user();
            $doitems = DOItem::find($request->do_id);
            $doitems->po_id = $request->po_id;
            $doitems->item_name = $request->item_name;
            $doitems->unit = $request->unit;
            $doitems->qty = $request->qty;
            $doitems->l_qty = $request->qty;
            $doitems->price = $request->price;
            $doitems->amt = $request->price * $request->qty;
            $doitems->brand = $request->price;
            $doitems->mfg_country = $request->mfg_country;
            $doitems->mfg_company = $request->mfg_company;
            $doitems->mfg_date = $request->mfg_date;
            $doitems->updated_by = $user->name;
            if ($request->hasFile('manual')) {
                $file = $request->file('manual');
                $extension = $file->getClientOriginalExtension();
                Storage::disk('public')->put($file->getFilename() . '.' . $extension,  File::get($file));
                $doitems->manual_orignal_filename = $file->getClientOriginalName();
                $doitems->manual_filename = $file->getFilename() . '.' . $extension;
            } else {
                $doitems->manual_orignal_filename = null;
                $doitems->manual_filename = null;
            }
            $doitems->save();
            return Response::json(['success' => 'success']);
        }
        return Response::json(['errors' => $validator->errors()]);
    }
    public function destroy($id)
    {
        if (!Gate::allows('pocontract_manage')) {
            return abort(401);
        }
        DB::table('do_items')->where('id', $id)->delete();

        return redirect()->route('admin.pocontract.index');
    }
}
