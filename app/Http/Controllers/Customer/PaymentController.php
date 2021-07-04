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
        $invoice_id = Invoice::where('Counter_id', $Counter_id)->pluck('id', 'Name', 'Paid');

        $data = Payment::whereIn('Invoice_id', $invoice_id)->get();
        if ($request->ajax()) {
            $data = Payment::whereIn('Invoice_id', $invoice_id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('Invoice', function ($data) {

                    return $data->Invoice->Name;

                })
                ->addColumn('Paid', function ($data) {

                    return $data->Paid;

                })
                ->addColumn('action', function ($data) {

                    $button = '<a name="edit" href="' . url("/Customers/Payment/$data->id/show") . '" . id="' . $data->id . '" class="edit btn btn-secondary btn-sm"><span><i class="fa fa-eye" aria-hidden="true"></i></span>عرض</a>';
                    $button .= '&nbsp;&nbsp';
                    return $button;


                })
                ->rawColumns(['action'])
                ->make(true);

        }


        return view('Pages.Customers.Payment.index');
    }

    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        return view('Pages.Customers.Payment.show', compact('payment'));
    }

}



