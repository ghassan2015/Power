<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use App\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $button = '';

        if ($request->ajax()) {
            $data = Payment::with('Invoice')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('Invoice', function ($data) {

                    return $data->Invoice->Name;

                })
                ->addColumn('Paid', function ($data) {

                    return $data->Paid;

                })
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
        return view('Pages.Payment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Invoices = Invoice::all();
        return view('Pages.Payment.create', compact('Invoices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $Payment = new Payment();
            $Payment->Name = $request->Name;
            $Payment->Paid = $request->Paid;
            $Payment->Invoice_id = $request->Inovie_id;
            $Payment->User_id = Auth::id();
            $Payment->save();

            $invoice = Invoice::find($request->Inovie_id);
            $num = $invoice->Remainder - $request->Paid;
            if ($num == 0) {

                $invoice->update([
                    'Remainder' => $num,
                    'Status' => 1

                ]);

            } else {
                $invoice->update([
                    'Remainder' => $num,
                    'Status' => 1

                ]);
            }

            DB::commit();
            toastr()->success('تم اضافة الدفعة بنجاح');
            return redirect()->route('Payment.index');

        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('هناك خطا ما يرجى المحاولة لاحقا');
            return redirect()->route('Payment.index');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        return view('Pages.Payment.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $Invoices = Invoice::all();
        return view('Pages.Payment.edit', compact('payment', 'Invoices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $Payment = Payment::findOrFail($id);
            $Payment->Name = $request->Name;
            $Payment->Paid = $request->Paid;
            $Payment->Invoice_id = $request->Inovie_id;
            $Payment->User_id = Auth::id();
            $Payment->save();

            $invoice = Invoice::find($request->Inovie_id);
            $num = $invoice->Remainder - $request->Paid;
            if ($num == 0) {

                $invoice->update([
                    'Remainder' => $num,
                    'Status' => 1

                ]);

            } else {
                $invoice->update([
                    'Remainder' => $num,
                    'Status' => 1

                ]);
            }
            DB::commit();
            toastr()->success('تم تعديل الدفعة بنجاح');
            return redirect()->route('Payment.index');

        } catch (\Exception $e) {
            return $e;
            DB::rollBack();
            toastr()->error('هناك خطا ما يرجى المحاولة لاحقا');
            return redirect()->route('Payment.index');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function Get_Invoice($id)
    {

        return $list_counter = Invoice::where("id", $id)->pluck("Remainder", "id");

        return $list_counter;

    }

}
