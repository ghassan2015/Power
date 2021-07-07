<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CounterRequest;
use App\Models\Box;
use App\Models\Counter;
use App\Models\Customer;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Validation\Rule;

class CounterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $Boxs = Box::all();
        if ($request->ajax()) {
            $data = Counter::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('Name_Location', function (Counter $counter) {
                    return $counter->Box->Name;
                })
                ->addColumn('Location', function (Counter $counter) {
                    return $counter->Box->Location;
                })
                ->addColumn('Status', function (Counter $counter) {
                    return $counter->getActive();
                })
                ->addColumn('action', function ($data) {

                    $button = '<a name="edit"  id="' . $data->id . '" Name_Counter="' . $data->Name . '"  Counter_Box_id="' . $data->Box_id . '" Counter_active="' . $data->is_active . '" Counter_Box_Name="' . $data->Box->Name . '" class="edit btn btn-primary btn-sm edit_Counter"><span><i class="fas fa-edit"></i></span>تعديل</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '"  Name_Counter="' . $data->Name . '" class="delete btn btn-danger btn-sm"><span><i class="fas fa-trash-alt"></i></span>حدف</button>';
                    return $button;
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Pages.Counter.Counters', compact('Boxs'));
    }

    public function create()
    {

        $data['Counters'] = Counter::all();
        $data['Boxs'] = Box::all();
        return view('Pages.Counter.create', $data);
    }

    public function store(CounterRequest $request)
    {

        try {
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);
            $Counter = new Counter();
            $Counter->Name = $request->Name;
            $Counter->Box_id = $request->Box_id;
            $Counter->active = $request->active;
//            Counter::create($request->except('_token'));
            $Counter->save();
            toastr()->success('تمت عملية  الاضافة بنجاح');
            return redirect()->route('Counters.index');
        } catch (\Exception $exception) {
            toastr()->error('لم تتم عملية  الاضافة بنجاح');
            return redirect()->route('Counters.index');
        }

    }


    public function edit($id)
    {

        $data['counter'] = Counter::findOrFail($id);
        $data['Boxs'] = Box::all();

        return view('Pages.Counter.edit', $data);

    }

    public function update(Request $request)
    {
        try {
            $counter = Counter::findOrFail($request->id);
            $request->validate([
                'Box_id' => 'required',
                'Name' => ['required', Rule::unique('Counters')->ignore($counter->id),],
            ]);

            if (!$request->has('active'))
                $request->request->add(['active' => 0]);
            else
                $request->request->add(['active' => 1]);

            $counter->update($request->all());
            toastr()->success('تمت عملية  التعديل بنجاح');
            return redirect()->route('Counters.index');

        } catch (\Exception  $exception) {
            toastr()->success('هناك خطا ما يرجى المحاولة فيما بعد');
            return redirect()->route('Counters.index');

        }
    }


    public function destroy(Request $request)
    {
        try {
            $Customer = Customer::where('Counter_id', $request->id)->get();

            if ($Customer)
                toastr()->error('لم تتم عملية الحذف هذا العنصر بنجاح بسبب وجود مستخدم');
            else {
                Counter::where('id', $request->id)->delete();
                toastr()->success('تمت عملية التعديل بنجاح');
            }
            return redirect()->route('Counters.index');

        } catch (\Exception $exception) {
            toastr()->error('لم تتم عملية الحذف هذا العنصر بنجاح');
            return redirect()->route('Counters.index');

        }


    }
}
