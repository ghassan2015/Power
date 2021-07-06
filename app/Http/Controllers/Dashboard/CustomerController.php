<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Box;
use App\Models\Counter;
use App\Models\Customer;
use App\Models\State;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $options = '';
        if ($request->ajax()) {
            $data = Customer::latest()->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '&nbsp;&nbsp;&nbsp<a class="edit btn btn-primary btn-sm"  id="' . $data->id . '" href="' . url("Dashboard/Customer/$data->id/edit") . '"><i class="fas fa-user-edit"></i> تعديل </a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><span><i class="fas fa-user-minus"></i></span>حذف</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);

        }

        return view('Pages.Customers.index');
    }


    public function getRegister()
    {
        $States = State::all();
        $Boxes = Box::all();
        $Counters = Counter::all();
        return view('Customer.auth.register', compact('States', 'Boxes', 'Counters'));
    }

    protected function create(CustomerRequest $request)
    {
        try {
            $Customer = new Customer();
            $Customer->Name = $request->Name;
            $Customer->password = Hash::make($request->password);
            $Customer->email = $request->Email;
            $Customer->Phone = $request->Phone;
            $Customer->Price = $request->Price;
            $Customer->State_id = $request->State_id;
            $Customer->Address = $request->Address;
            $Customer->Box_id = $request->Box_id;
            $Customer->Counter_id = $request->Counter_id;
//            $Customer->user_id = Auth::id();
            $Customer->Status = $request->Status;
            $Customer->save();
            toastr()->success('تم اضافة المستخدم بنجاح ');
            return redirect()->route('Customer.getRegister');
        } catch (\Exception $e) {
            toastr()->error('هناك خطا ما يرجى المحاولة لاحقا');
            return redirect()->route('Customer.getRegister');

        }

    }

    public function getcounter($id)
    {
        return $list_counter = Counter::where("Box_id", $id)->pluck("Name", "id");

        return $list_counter;

    }

    public function show($id)
    {
        $user = Customer::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $Customer = Customer::find($id);
        $Boxes = Box::all();
        $Counter = Counter::all();
        $States = State::all();
        return view('Pages.Customers.edit', compact('Customer', 'Boxes', 'Counter', 'States'));
    }


    public function update(CustomerRequest $request, $id)
    {

        if (!$request->has('Status'))
            $request->request->add(['Status' => 0]);
        else
            $request->request->add(['Status' => 1]);
        $input = $request->all();

        try {
            $Customer = Customer::findOrFail($id);
            $Customer->Name = $request->Name;
            $Customer->email = $request->Email;
            $Customer->Phone = $request->Phone;
            $Customer->Price = $request->Price;
            $Customer->State_id = $request->State_id;
            $Customer->Address = $request->Address;
            $Customer->Counter_id = $request->Counter_id;
            $Customer->Status = $request->Status;
            $Customer->save();
            toastr()->success('تم اضافة المستخدم بنجاح ');
            return redirect()->route('Customers.index');
        } catch (\Exception $e) {
            return $e;
            toastr()->error('هناك خطا ما يرجى المحاولة لاحقا');
            return redirect()->route('Customers.index');

        }
    }


    public function destroy($id)
    {
        Customer::find($id)->delete();
        return redirect()->route('Customers.index')->with('success', 'تم حذف المشترك بنجاح');
    }

}
