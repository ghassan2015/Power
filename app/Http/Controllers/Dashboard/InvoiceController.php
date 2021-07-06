<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Box;
use App\Models\Counter;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\Console\Input\Input;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $button = '';
        //       $States = State::all();
        if ($request->ajax()) {
            $data = Invoice::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a name="edit" href="' . url("/Dashboard/Invoice/$data->id/show") . '" . id="' . $data->id . '" class="edit btn btn-dark btn-sm"><span> <i class="fa fa-eye" aria-hidden="true"></i>عرض</span></a>';

                    $button .= '&nbsp;&nbsp;';

                    $button = $button . '<a name="edit" href="' . url("/Dashboard/Invoice/$data->id/edit") . '" . id="' . $data->id . '" class="edit btn btn-primary btn-sm"><span><i class="fas fa-edit"></i></span>تعديل</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><span><i class="fas fa-trash-alt"></i></span>حدف</button>';
                    return $button;


                })
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('Pages.Invoice.index');
    }


    public
    function create()
    {
        Customer::with(['Counter'])->get();
        $Inovices = Customer::with(['Counter'])->get();
//        $counter = $Inovices->Counter;
//        return $counter->Customer;
        return view('Pages.Invoice.Add_invoice', compact('Inovices'));

    }


    public
    function store(InvoiceRequest $request)
    {

        $data = $request->except('_token');
        $Customer_ids = $data['Customer_id'];
        $Names = $data['Name'];
        $previous_reading = $data['previous_reading'];
        $current_reading = $data['current_reading'];
        $Total = $data['Total'];
        try {
            foreach ($Customer_ids as $key => $value) {
                $Invoice = new Invoice();
                $Invoice->Name = $Names[$key];
                $Invoice->previous_reading = $previous_reading[$key];
                $Invoice->current_reading = $current_reading[$key];
                $Invoice->Total = $Total[$key];
                $Invoice->Customer_id = $Customer_ids[$key];
                $Invoice->save();
            }
            return redirect()->route('Invoice.index');
        } catch (\Exception $exception) {
            return $exception;
        }

    }


    public function show($id)
    {
        $inovice = Invoice::with('Customer')->findOrFail($id);
        if (!$inovice) {
            toastr()->error('هذا الصندوق غير موجود حاول مرة اخرى');
            return redirect()->route('Invoice.index');
        }
        return view('Pages.Invoice.show', compact('inovice'));

        //
    }


    public
    function edit($id)
    {
        $inovice = Invoice::with('Customer')->findOrFail($id);
        if (!$inovice) {
            toastr()->error('هذا الصندوق غير موجود حاول مرة اخرى');
            return redirect()->route('Invoice.index');
        }
        return view('Pages.Invoice.edit_invoice', compact('inovice'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "current_reading" => "required",
            "Customer_id" => "required",
            "previous_reading" => "required",
            "Total" => "required",
        ]);
        try {

            $Invoice = Invoice::findOrFail($id);
            $Invoice->Customer_id = $request->Customer_id;
            $Invoice->Name = $request->Name;
            $Invoice->previous_reading = $request->previous_reading;
            $Invoice->current_reading = $request->current_reading;
            $Invoice->Total = $request->Total;
            $Invoice->save();
            toastr()->success('تمت عملية  التعديل بنجاح');
            return redirect()->route('Invoice.index');
        } catch (\Exception $exception) {
            toastr()->success('هناك خطا ما يرجى المحاولة لاحقا');
            return redirect()->route('Invoice.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        try {
            $counter = Invoice::findOrFail($id)->delete();
            toastr()->success('تمت عملية الحذف بنجاح');
            return redirect()->route('Invoice.index');


        } catch (\Exception $exception) {
            toastr()->error('لم تتمت عملية الحذف بنجاح ');
            return redirect()->route('Counters.index');

        }
    }

    public
    function driven(Request $request)
    {

        if ($request->ajax()) {
            $data = Invoice::where('Status', 1)->get();
            return Datatables::of($data)
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

        return view('Pages.Invoice.driven');
    }

    public
    function unpaid(Request $request)
    {

        if ($request->ajax()) {
            $data = Invoice::where('Status', 0)->get();
            return Datatables::of($data)
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

        return view('Pages.Invoice.unpaid');
    }

}
