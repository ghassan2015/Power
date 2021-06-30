<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Expense;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Datatables;

class ExpenseController extends Controller
{

    public function index(Request $request)
    {
        $button = '';
        if ($request->ajax()) {
            $data = Expense::latest()->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a name="edit" href="' . url("/Dashboard/Expense/$data->id/edit") . '" . id="' . $data->id . '" class="edit btn btn-primary btn-sm"><span><i class="fas fa-edit"></i></span>تعديل</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><span><i class="fas fa-trash-alt"></i></span>حدف</button>';
                    return $button;


                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('Pages.Expense.index');
    }

    public function create()
    {
        return view('Pages.Expense.create');

    }

    public function store(Request $request)
    {
        try {
            $Expense = new Expense();
            $Expense->Name = $request->Name;
            $Expense->Price = $request->Value;
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

    public function update(Request $request, $id)
    {
        try {
            $Expense = Expense::findOrFail($id);
            $Expense->Name = $request->Name;
            $Expense->Price = $request->Value;
            $Expense->save();
            toastr()->success('تم عملية اضافة المصروفات بنجاح');
            return redirect()->route('Expense.index');
        } catch (\Exception $ex) {
            toastr()->error('هناك خطا ما يرجىء المحاولة لاحقا ');
            return redirect()->route('Expense.index');
        }
    }

    public function destroy($id)
    {

        $box = Expense::where('id', $id)->delete();
        toastr()->success('تمت عملية التعديل بنجاح');
        return redirect()->route('Expense.index');
    }
}
