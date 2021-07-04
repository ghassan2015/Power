<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {

        $user = auth('customer')->user();

        $counter_id = $user->Counter->id;

        if ($request->ajax()) {
            $data = Invoice::where('Counter_id', $counter_id)->get();
            return DataTables::of($data)
                ->addColumn('Name', function (Invoice $invoice) {
                    return $invoice->Name;
                })
                ->addColumn('Name_Location', function (Invoice $invoice) {
                    return $invoice->Counter->Name;
                })
                ->addColumn('Location', function (Invoice $invoice) {
                    return $invoice->Counter->Box->Name;
                })->addColumn('action', function ($data) {

                    $button = '<a name="edit" href="' . url("/Dashboard/Invoice/$data->id/edit") . '" . id="' . $data->id . '" class="edit btn btn-primary btn-sm"><span><i class="fas fa-edit"></i></span>تعديل</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><span><i class="fas fa-trash-alt"></i></span>حدف</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('Pages.Invoice.index');
    }
}
