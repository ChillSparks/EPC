<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index()
    {
        $store_items = Store::all();
        return view('admin.store.index', compact('store_items'));
    }
    public function search()
    {
        $columns = [
            '0' => " ",
            '1' => "item_name",
            '2' => "store_code",
            '3' => "warehouse",
            '4' => "unit",
            '5' => "price",
            '6' => "brand",
            '7' => "mfg_country",
            '8' => "mfg_company",
            '9' => "mfg_date",
            '10' => "created_at",
        ];
        $store_items = DB::table('store')->select('store.*', 'units.name as unit')
            ->leftJoin('units', 'units.id', '=', 'store.unit')->get();
        return view('admin.store.search', compact('store_items', 'columns'));
    }
    public function stockSearch(Request $request)
    {
        if (!empty($request->search_target) && !empty($request->search_value)) {
            switch ($request->search_target) {
                case 'item_name':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('item_name', 'LIKE', $request->search_value)
                        ->get();
                    break;
                case 'store_code':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('store_code', 'LIKE', '%' . $request->search_value . '%')
                        ->get();
                    break;
                case 'warehouse':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('warehouse', 'LIKE', '%' . $request->search_value . '%')
                        ->get();
                    break;
                case 'unit':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('unit', 'LIKE', '%' . $request->search_value . '%')
                        ->get();
                    break;
                case 'price':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('price', 'LIKE', '%' . $request->search_value . '%')
                        ->get();
                    break;
                case 'brand':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('brand', 'LIKE', '%' . $request->search_value . '%')
                        ->get();
                    break;
                case 'mfg_country':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('mfg_country', 'LIKE', '%' . $request->search_value . '%')
                        ->get();
                case 'mfg_company':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('mfg_company', 'LIKE', '%' . $request->search_value . '%')
                        ->get();
                    break;
                case 'mfg_date':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->whereDate('mfg_date', 'LIKE', '%' . $request->search_value . '%')
                        ->get();
                    break;
                case 'created_at':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->whereDate('created_at', 'LIKE', '%' . $request->search_value . '%')
                        ->get();
                    break;
                default:
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')->get();
                    break;
            }
        }elseif (!empty($request->search_target) && !empty($request->search_value) && !empty($request->from_date) && !empty($request->to_date)) {
            switch ($request->search_target) {
                case 'item_name':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('item_name', 'LIKE', $request->search_value)
                        ->whereDate('created_at', '>=', $request->from_date)
                        ->whereDate('created_at', '<=', $request->to_date)
                        ->get();
                    break;
                case 'store_code':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('store_code', 'LIKE', '%' . $request->search_value . '%')
                        ->whereDate('created_at', '>=', $request->from_date)
                        ->whereDate('created_at', '<=', $request->to_date)
                        ->get();
                    break;
                case 'warehouse':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('warehouse', 'LIKE', '%' . $request->search_value . '%')
                        ->whereDate('created_at', '>=', $request->from_date)
                        ->whereDate('created_at', '<=', $request->to_date)
                        ->get();
                    break;
                case 'unit':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('unit', 'LIKE', '%' . $request->search_value . '%')
                        ->whereDate('created_at', '>=', $request->from_date)
                        ->whereDate('created_at', '<=', $request->to_date)
                        ->get();
                    break;
                case 'price':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('price', 'LIKE', '%' . $request->search_value . '%')
                        ->whereDate('created_at', '>=', $request->from_date)
                        ->whereDate('created_at', '<=', $request->to_date)
                        ->get();
                    break;
                case 'brand':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('brand', 'LIKE', '%' . $request->search_value . '%')
                        ->whereDate('created_at', '>=', $request->from_date)
                        ->whereDate('created_at', '<=', $request->to_date)
                        ->get();
                    break;
                case 'mfg_country':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('mfg_country', 'LIKE', '%' . $request->search_value . '%')
                        ->whereDate('created_at', '>=', $request->from_date)
                        ->whereDate('created_at', '<=', $request->to_date)
                        ->get();
                case 'mfg_company':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->where('mfg_company', 'LIKE', '%' . $request->search_value . '%')
                        ->whereDate('created_at', '>=', $request->from_date)
                        ->whereDate('created_at', '<=', $request->to_date)
                        ->get();
                    break;
                case 'mfg_date':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->whereDate('mfg_date', 'LIKE', '%' . $request->search_value . '%')
                        ->whereDate('created_at', '>=', $request->from_date)
                        ->whereDate('created_at', '<=', $request->to_date)
                        ->get();
                    break;
                case 'created_at':
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')
                        ->whereDate('created_at', 'LIKE', '%' . $request->search_value . '%')
                        ->whereDate('created_at', '>=', $request->from_date)
                        ->whereDate('created_at', '<=', $request->to_date)
                        ->get();
                    break;
                default:
                    $store = DB::table('store')->select('store.*', 'units.name as unit')
                        ->leftJoin('units', 'units.id', '=', 'store.unit')->get();
                    break;
            }
        }elseif(!empty($request->from_date) && !empty($request->to_date)){
            $store = DB::table('store')->select('store.*', 'units.name as unit')
            ->leftJoin('units', 'units.id', '=', 'store.unit')
            ->whereDate('created_at', '>=', '2019-10-02')
            ->whereDate('created_at', '<=', '2019-10-03')
            ->get();
        }
        else {
            $store = DB::table('store')->select('store.*', 'units.name as unit')
                ->leftJoin('units', 'units.id', '=', 'store.unit')->get();
        }
        return response()->json(['data' => $store]);
    }
    public function exportFile($type)
    {
        $products = Product::get()->toArray();
        return \Excel::create('store', function ($excel) use ($products) {
            $excel->sheet('sheet name', function ($sheet) use ($products) {
                $sheet->fromArray($products);
            });
        })->download($type);
    }
}
