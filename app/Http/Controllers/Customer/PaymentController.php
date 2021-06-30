<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    public function index(Request $request)
    {

        $button = '';
        $user = auth('customer')->user()->id;
        $Customer = Customer::find($user);
        $Counter_id = $Customer->Counter->id;
        $invoice_id = Invoice::find($Counter_id);
        $invoice_id = $invoice_id->id;


        if ($request->ajax()) {
            $data = Payment::where('Invoice_id', $invoice_id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {

                    $button = '<a name="edit" href="' . url("/Dashboard/Payment/$data->id/show") . '" . id="' . $data->id . '" class="edit btn btn-secondary btn-sm"><span><i class="fa fa-eye" aria-hidden="true"></i></span>عرض</a>';
                    $button .= '&nbsp;&nbsp';
                    $button = $button . '<a name="edit" href="' . url("/Dashboard/Payment/$data->id/edit") . '" . id="' . $data->id . '" class="edit btn btn-primary btn-sm"><span><i class="fas fa-edit"></i></span>تعديل</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><span><i class="fas fa-trash-alt"></i></span>حدف</button>';
                    return $button;


                })
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('Pages.Customers.Payment.index');
    }

}


