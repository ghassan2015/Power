<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Rules\MathOldUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function Profile()
    {
        $user_id = auth('customer')->id();
        $user = Customer::findOrFail($user_id);
        return view('Pages.Customers.Profile.account-information', compact('user'));

    }

    public function UpdateProfile(Request $request, $id)
    {
        $user_id = auth('customer')->id();

        $user = Customer::find($user_id);
        $request->validate([
            'email' => ['required', 'email:rfc,dns', Rule::unique('customers')->ignore($user->id),],
            'Name' => ['required', 'string', 'max:255',]
        ]);
        try {
            $input = $request->all();

            $user->update($input);
            toastr()->success('تم تعديل البيانات بنجاح');
            return redirect()->back();
        } catch (\Exception $exception) {
            toastr()->error('هناك خطا لم يتم حفظ البيانات بنجاح');
            return redirect()->back();

        }
    }

    public function changePassword()
    {
        return view('Pages.Customers.Profile.change-password');

    }


    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MathOldUser],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        try {


            Customer::find(auth('customer')->user()->id)->update(['password' => Hash::make($request->new_password)]);
            toastr()->success(' يتم حفظ البيانات بنجاح');
            return redirect()->back();

        } catch (\Exception $exception) {
            return $exception;
            toastr()->error('هناك خطا لم يتم حفظ البيانات بنجاح');
            return redirect()->back();

        }

    }

    public function logout()
    {

        $gaurd = $this->getGaurd();
        $gaurd->logout();

        return redirect()->route('Customer.login');
    }

    private function getGaurd()
    {
        return auth()->guard('customer');
    }


}
