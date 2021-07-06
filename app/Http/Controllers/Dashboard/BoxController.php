<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoxRequest;
use App\Models\Box;
use App\Models\Counter;
use App\Models\Customer;
use App\Models\State;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade as PDF;


class BoxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $button = '';
        $States = State::all();
        if ($request->ajax()) {
            $data = Box::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('State', function ($data) {
                    return $data->State->Name;
                })
                ->addColumn('action', function ($data) {

                    $button = '<a name="edit" href="' . url("/Dashboard/Boxs/$data->id/edit") . '" . id="' . $data->id . '" class="edit btn btn-primary btn-sm"><span><i class="fas fa-edit"></i></span>تعديل</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><span><i class="fas fa-trash-alt"></i></span>حدف</button>';
                    return $button;


                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('Pages.Boxs.index', compact('States'));

    }


    public function create()
    {
        //
    }


    public function store(BoxRequest $request)
    {

        $validated = $request->validated();

        try {
            $Box = new Box();
            $Box->Name = $request->Name;
            $Box->Location = $request->Location;
            $Box->State_id = $request->State_id;
            $Box->save();
            toastr()->success('تمت عملية الاضافة بنجاح');
            return redirect()->route('Boxs.index');

        } catch (\Exception $e) {
            toastr()->error('هناك خطا ما يرجى المحاولة لاحقا');
            return redirect()->route('Boxs.index');

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $States = State::all();
        $box = Box::find($id);
        if (!$box) {
            toastr()->error('هذا الصندوق غير موجود حاول مرة اخرى');
            return redirect()->route('Boxs.index');
        }
        return view('Pages.Boxs.edit', compact('box', 'States'));

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
//        return  $request;


        $Box = Box::findOrFail($id);

        //  $validated = $request->validated();
        $request->validate([
            'Location' => 'required',
            'Name' => ['required', Rule::unique('boxes')->ignore($Box->id),],
        ]);

        if (!$Box) {
            toastr()->error('هذا الصندوق غير موجود حاول مرة اخرى');
            return redirect()->route('Boxs.index');
        }
        $Box->Name = $request->Name;
        $Box->Location = $request->Location;
        $Box->State_id = $request->State_id;
        $Box->save();
        toastr()->success('تمت عملية التعديل بنجاح');
        return redirect()->route('Boxs.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Counter = Counter::where('Box_id', $id)->get();
        if ($Counter) {
            toastr()->error('لم تتم عملية الحذف هذا العنصر بنجاح بسبب وجود');

        } else {
            $box = Box::where('id', $id)->delete();

        }


        toastr()->success('تمت عملية التعديل بنجاح');
        return redirect()->route('Boxs.index');
    }

    public function createPDF()
    {
        // retreive all records from db
        $States = State::all();

        // share data to view
        view()->share('States', $States);
        $pdf = PDF::loadView('Pages.Boxs.index', $States)->setOptions(['defaultFont' => 'sans-serif']);;

        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }
}
