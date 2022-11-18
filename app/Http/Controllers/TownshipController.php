<?php

namespace App\Http\Controllers;

use App\Divisions;
use Illuminate\Support\Facades\Gate;
use App\Townships;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
class TownshipController extends Controller
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
                    ->select('townships.*','townships.des','divisions.name as division_name')
                    ->leftJoin('divisions','divisions.id','=','townships.division_id')
                    ->get();
        return view('admin.region.index', compact('townships','divisions'));
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
        $divisions = Divisions::pluck('name','id');
        return view('admin.region.townships.create', compact('divisions'));
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
        $user = Auth::user();
        $request->request->add(['created_by' => $user->name]);
        $request->request->add(['updated_by' => $user->name]);
        Townships::create($request->all());

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
        return view('admin.Township.index');
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
        $divisions = Divisions::pluck('name','id');
        $townships = Townships::findOrFail($id);

        return view('admin.region.Townships.edit', compact('divisions','townships'));
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
        $townships = Townships::findOrFail($id);
        $user = Auth::user();
        $request->request->add(['updated_by' => $user->name]);
        $townships->update($request->all());

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
        $townships = Townships::findOrFail($id);
        $townships->delete();

        return redirect()->route('admin.township.index');
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
            $entries = Townships::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
