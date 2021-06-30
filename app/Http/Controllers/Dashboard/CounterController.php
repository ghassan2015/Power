<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CounterRequest;
use App\Models\Box;
use App\Models\Counter;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Validation\Rule;

class CounterController extends Controller
{
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

                    $button = '<a name="edit" href="' . url("/Dashboard/Counters/$data->id/edit") . '" . id="' . $data->id . '" class="edit btn btn-primary btn-sm"><span><i class="fas fa-edit"></i></span>تعديل</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><span><i class="fas fa-trash-alt"></i></span>حدف</button>';
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

        if (!$request->has('active'))
            $request->request->add(['active' => 0]);
        else
            $request->request->add(['active' => 1]);


        $category = Counter::create($request->except('_token'));
        toastr()->success('تمت عملية  الاضافة بنجاح');
        return redirect()->route('Counters.index');


    }


    public function edit($id)
    {

        $data['counter'] = Counter::findOrFail($id);
        $data['Boxs'] = Box::all();

        return view('Pages.Counter.edit', $data);

    }

    public function update(Request $request, $id)
    {

        try {
            $counter = Counter::findOrFail($id);
            $request->validate([
                'Box_id' => 'required',
                'Name' => ['required', Rule::unique('Counters')->ignore($counter->id),],
            ]);

            if (!$request->has('active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $counter->update($request->all());

            toastr()->success('تمت عملية  التعديل بنجاح');
            return redirect()->route('Counters.index');

        } catch (\Exception  $exception) {
            return $exception;
            toastr()->success('هناك خطا ما يرجى المحاولة فيما بعد');
            return redirect()->route('Counters.index');

        }
    }


    public function destroy($id)

    {
        try {
            $counter = Counter::findOrFail($id)->delete();
            toastr()->success('تمت عملية الحذف بنجاح');
            return redirect()->route('Counters.index');


        } catch (\Exception $exception) {

        }
//        $message = array('message' => 'Success!', 'title' => 'Delete');
//        return response()->json($message);

    }
}
