<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use DataTables;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $options = '';
        if ($request->ajax()) {
            $data = Customer::with('State')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a class="edit btn btn-primary btn-sm"  id="' . $data->id . '" href="' . url("/Classrooms/$data->id/edit") . '"><i class="la la-edit"></i> سش </a>';
                    $button = '<a class="edit btn btn-primary btn-sm"  id="' . $data->id . '" href="' . url("/Classrooms/$data->id/edit") . '"><i class="la la-edit"></i> تعديل </a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('Customer.index');
    }



}
