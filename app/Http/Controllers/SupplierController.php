<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use App\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('setting_manage')) {
            return abort(401);
        }
        $suppliers = Supplier::all();
        return view('admin.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('setting_manage')) {
            return abort(401);
        }
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('setting_manage')) {
            return abort(401);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:40',
            'des' => 'required'
        ],[
            'name.required'=>'Name is required.',
            'name.max'=>'Maximum Character is 40',
            'des.required'=>'Description is required.'

        ]);
        if ($validator->fails()) {
            return redirect('/admin/supplier/create')
            ->withErrors($validator,'update')->withInput();
        }
        $user = Auth::user();
        $request->request->add(['created_by' => $user->name]);
        $request->request->add(['updated_by' => $user->name]);
        Supplier::create($request->all());

        return redirect()->route('admin.supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.supplier.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('setting_manage')) {
            return abort(401);
        }
        $suppliers = Supplier::findOrFail($id);

        return view('admin.supplier.edit', compact('suppliers'));
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
        if (! Gate::allows('setting_manage')) {
            return abort(401);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'des' => 'required'
        ],[
            'name.required'=>'Name is required.',
            'des.required'=>'Description is required.'

        ]);
        if ($validator->fails()) {
            return redirect('/admin/supplier/'.$id.'/edit')
            ->withErrors($validator,'update')->withInput();
        }
        $suppliers = Supplier::findOrFail($id);
        $user = Auth::user();
        $request->request->add(['updated_by' => $user->name]);
        $suppliers->update($request->all());

        return redirect()->route('admin.supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('setting_manage')) {
            return abort(401);
        }
        $suppliers = Supplier::findOrFail($id);
        $suppliers->delete();

        return redirect()->route('admin.supplier.index');
    }

            /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('setting_manage')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Supplier::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
