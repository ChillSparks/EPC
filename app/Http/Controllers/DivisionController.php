<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use App\Divisions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class DivisionController extends Controller
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
        $divisions = Divisions::all();
        $townships = DB::table('townships')
                    ->select('townships.*','divisions.name as division_name')
                    ->leftJoin('divisions','divisions.id','=','townships.division_id')
                    ->get();
        return view('admin.region.index', compact('divisions','townships'));
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
        return view('admin.region.divisions.create');
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
            'name' => 'required',
            'des' => 'required'
        ],[
            'name.required'=>'Division Name is required.',
            'des.required'=>'Description is required.'
        ]);
        if ($validator->fails()) {
            return redirect('/admin/division/create')
            ->withErrors($validator,'update')->withInput();
        }
        $user = Auth::user();
        $request->request->add(['created_by' => $user->name]);
        $request->request->add(['updated_by' => $user->name]);
        Divisions::create($request->all());

        return redirect()->route('admin.division.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.divisions.index');
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
        $divisions = Divisions::findOrFail($id);

        return view('admin.region.divisions.edit', compact('divisions'));
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
            'name.required'=>'Division Name is required.',
            'des.required'=>'Description is required.'
        ]);
        if ($validator->fails()) {
            return redirect('/admin/division/'.$id.'/edit')
            ->withErrors($validator,'update')->withInput();
        }
        $divisions = Divisions::findOrFail($id);
        $user = Auth::user();
        $request->request->add(['updated_by' => $user->name]);
        $divisions->update($request->all());

        return redirect()->route('admin.division.index');
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
        $division = Divisions::findOrFail($id);
        $division->delete();

        return redirect()->route('admin.division.index');
    }

            /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        dd($request);
        if (! Gate::allows('setting_manage')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Townships::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
