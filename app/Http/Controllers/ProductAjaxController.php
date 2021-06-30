<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Http\Request;
use DataTables;

class ProductAjaxController extends Controller
{

    public function index()
    {
//        $products = Counter::latest()->get();
//
//        if ($request->ajax()) {
//            $model = Counter::with('Box');
//            return Datatables::eloquent($model)
//                ->addColumn('Name_Location', function (Counter $counter) {
//                    return $counter->Box->Name;
//                })
//                ->addColumn('Location', function (Counter $counter) {
//                    return $counter->Box->Location;
//                })
//                ->addColumn('Status', function (Counter $counter) {
//                    return $counter->active();
//                })
//                ->addColumn('action', function ($row) {
//
//                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
//
//                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
//
//                    return $btn;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//        }

        return view('Pages.Expenses.index');
    }


    public function store(Request $request)
    {
        Counter::updateOrCreate(['id' => $request->product_id],
            ['name' => $request->name, 'detail' => $request->detail]);

        return response()->json(['success' => 'Product saved successfully.']);
    }


    public function edit($id)
    {
        $product = Counter::find($id);
        return response()->json($product);
    }


    public function destroy($id)
    {
        Counter::find($id)->delete();

        return response()->json(['success' => 'Product deleted successfully.']);
    }
}
