<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;
use Datatables;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $button = '';
        $Options = Option::all();
        if ($request->ajax()) {
            $data = Expense::latest()->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a name="edit" id="' . $data->id . '"   Name_Expense="' . $data->Name . '" Option_id="' . $data->Option_id . '"  Option_Name="' . $data->Option->Name . '" Price="' . $data->Price . '"  class="edit btn btn-primary btn-sm edit_Expense"><span><i class="fas fa-edit"></i></span>تعديل</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" Name_Expense="' . $data->Name . '" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><span><i class="fas fa-trash-alt"></i></span>حدف</button>';
                    return $button;


                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('Pages.Expense.index', compact('Options'));
    }


    public function store(ExpenseRequest $request)
    {
        try {
            $Expense = new Expense();
            $Expense->Name = $request->Name;
            $Expense->Price = $request->Value;
            $Expense->Option_id = $request->Option_id;
            $Expense->save();
            toastr()->success('تم عملية اضافة المصروفات بنجاح');
            return redirect()->route('Expense.index');
        } catch (\Exception $ex) {
            toastr()->error('هناك خطا ما يرجىء المحاولة لاحقا ');
            return redirect()->route('Expense.index');

        }

    }

    public function edit($id)
    {
        $Expense = Expense::findOrFail($id);
        return view('Pages.Expense.edit', compact('Expense'));

    }

    public function update(ExpenseRequest $request)
    {
        try {
            $Expense = Expense::findOrFail($request->id);
            $Expense->Name = $request->Name;
            $Expense->Price = $request->Value;
            $Expense->Option_id = $request->Option_id;
            $Expense->save();
            toastr()->success('تم عملية تعديل المصروفات بنجاح');
            return redirect()->route('Expense.index');
        } catch (\Exception $ex) {
            toastr()->error('هناك خطا ما يرجىء المحاولة لاحقا ');
            return redirect()->route('Expense.index');
        }
    }

    public function destroy(Request $request)
    {

        Expense::where('id', $request->id)->delete();
        toastr()->success('تمت عملية التعديل بنجاح');
        return redirect()->route('Expense.index');
    }
}
